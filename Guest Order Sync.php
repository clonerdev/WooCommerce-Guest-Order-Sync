<?php
/**
 * Plugin Name: Guest Order Sync
 * Plugin URI: https://github.com/clonerdev/WooCommerce-Guest-Order-Sync
 * Description: Sync guest orders with user profiles based on phone number. Supports Iranian phone numbers and multiple stores. Optimized for sites with or without CDN and caching, and compatible with PHP 8.x.
 * Version: 1.8
 * Author: Ali Karimi | Nedaye Web
 * Author URI: https://nedayeweb.ir
 * WC requires at least: 6.4
 * Requires PHP: 7.4
 * Tested up to: 6.6.2
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Normalize phone number format to ensure consistent comparison
function gos_normalize_phone_number($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);

    if (substr($phone, 0, 2) == '98') {
        $phone = substr($phone, 2);
    } elseif (substr($phone, 0, 3) == '0098') {
        $phone = substr($phone, 4);
    } elseif (substr($phone, 0, 1) == '0') {
        $phone = substr($phone, 1);
    }

    return '98' . $phone;
}

// Validate and sanitize phone number
function gos_validate_and_sanitize_phone_number($phone) {
    $normalized_phone = gos_normalize_phone_number($phone);
    if (!preg_match('/^98[0-9]{10}$/', $normalized_phone)) {
        return false;
    }
    return $normalized_phone;
}

// Function to handle caching for sites with or without CDN
function gos_handle_caching($cache_key, $callback) {
    // Check if cache exists
    $cached_data = get_transient($cache_key);

    // If cache does not exist, run the callback and cache the result
    if ($cached_data === false) {
        $data = call_user_func($callback);
        set_transient($cache_key, $data, 12 * HOUR_IN_SECONDS); // Cache data for 12 hours
        return $data;
    }

    return $cached_data;
}

// Sync guest orders with user profiles based on phone number
function gos_sync_guest_orders_with_profile($order_id) {
    if (!current_user_can('edit_shop_orders')) {
        return;
    }

    $order = wc_get_order($order_id);

    // Try to get the phone number from both fields
    $billing_phone = sanitize_text_field($order->get_billing_phone());
    $digits_phone = sanitize_text_field(get_post_meta($order_id, 'digits_phone', true));

    $phone = $digits_phone ?: $billing_phone;

    if (empty($phone)) {
        return;
    }

    $normalized_phone = gos_validate_and_sanitize_phone_number($phone);
    if (!$normalized_phone) {
        return;
    }

    // Cache user lookup results for better performance on sites with CDN or caching
    $cache_key = 'gos_user_' . $normalized_phone;
    $user_id = gos_handle_caching($cache_key, function() use ($normalized_phone) {
        // Check if the phone number matches an existing user's phone number
        $users = get_users(array(
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'billing_phone',
                    'value' => $normalized_phone,
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'digits_phone',
                    'value' => $normalized_phone,
                    'compare' => 'LIKE'
                )
            ),
            'number' => 1
        ));

        return !empty($users) ? $users[0]->ID : 0;
    });

    if ($user_id > 0) {
        $order->set_customer_id($user_id);
        $order->save();
        $order->add_order_note('سفارش با پروفایل همگام‌سازی شد (کاربر قبلاً ثبت‌نام کرده است).');
    } else {
        $order->update_meta_data('_guest_phone', $normalized_phone);
        $order->save();
        $order->add_order_note('سفارش به عنوان سفارش مهمان ذخیره شد.');
    }
}
add_action('woocommerce_checkout_order_processed', 'gos_sync_guest_orders_with_profile', 10, 1);

// Sync past guest orders with the user's profile upon registration
function gos_sync_guest_orders_on_registration($user_id) {
    if (!current_user_can('edit_users')) {
        return;
    }

    // Try to get the phone number from both fields
    $billing_phone = sanitize_text_field(get_user_meta($user_id, 'billing_phone', true));
    $digits_phone = sanitize_text_field(get_user_meta($user_id, 'digits_phone', true));

    $phone = $digits_phone ?: $billing_phone;

    if (empty($phone)) {
        return;
    }

    $normalized_phone = gos_validate_and_sanitize_phone_number($phone);
    if (!$normalized_phone) {
        return;
    }

    // Find all orders that were placed with the guest phone number
    $args = array(
        'limit' => -1,
        'status' => 'any',
        'meta_query' => array(
            array(
                'key' => '_guest_phone',
                'value' => $normalized_phone,
                'compare' => 'LIKE'
            )
        )
    );

    $orders = wc_get_orders($args);

    // Link the found orders to the newly registered user
    foreach ($orders as $order) {
        $order->set_customer_id($user_id);
        $order->delete_meta_data('_guest_phone');
        $order->save();
        $order->add_order_note('سفارش مهمان با پروفایل همگام‌سازی شد (کاربر بعداً ثبت‌نام کرده است).');
    }
}
add_action('user_register', 'gos_sync_guest_orders_on_registration', 10, 1);

// Sync past guest orders with the user's profile upon login
function gos_sync_guest_orders_on_login($user_login, $user) {
    if (!current_user_can('edit_shop_orders')) {
        return;
    }

    $user_id = $user->ID;

    // Try to get the phone number from both fields
    $billing_phone = sanitize_text_field(get_user_meta($user_id, 'billing_phone', true));
    $digits_phone = sanitize_text_field(get_user_meta($user_id, 'digits_phone', true));

    $phone = $digits_phone ?: $billing_phone;

    if (empty($phone)) {
        return;
    }

    $normalized_phone = gos_validate_and_sanitize_phone_number($phone);
    if (!$normalized_phone) {
        return;
    }

    // Cache orders lookup for better performance on sites with CDN or caching
    $cache_key = 'gos_orders_' . $normalized_phone;
    $orders = gos_handle_caching($cache_key, function() use ($normalized_phone) {
        $args = array(
            'limit' => -1,
            'status' => 'any',
            'meta_query' => array(
                array(
                    'key' => '_guest_phone',
                    'value' => $normalized_phone,
                    'compare' => 'LIKE'
                )
            )
        );

        return wc_get_orders($args);
    });

    // Link the found orders to the logged-in user
    foreach ($orders as $order) {
        $order->set_customer_id($user_id);
        $order->delete_meta_data('_guest_phone');
        $order->save();
        $order->add_order_note('سفارش مهمان با پروفایل همگام‌سازی شد (کاربر بعداً وارد شده است).');
    }
}
add_action('wp_login', 'gos_sync_guest_orders_on_login', 10, 2);
