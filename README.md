# WooCommerce Guest Order Sync

| 🇺🇸 [English](README.md) | 🇮🇷 [Persian](README-FA.md) |
|--------------------------|----------------------------|
<br>

Sync guest orders with user profiles based on phone number. Supports Iranian phone numbers.

## Description

WooCommerce Guest Order Sync allows you to sync guest orders with user profiles based on their phone number, with specific support for Iranian phone numbers. This ensures that orders placed by guests are linked to their user accounts if they have previously registered or will register in the future.

### Features

- Normalization of phone numbers for consistent comparison
- Support for Iranian phone numbers
- Syncing guest orders with existing user profiles
- Saving guest orders for future syncing upon user registration or login
- Displaying detailed order notes for synced orders

## Frequently Asked Questions

### How does the plugin normalize phone numbers?

The plugin removes any non-numeric characters and adds the Iranian country code (98) if necessary.

### Does the plugin work with other phone number formats?

Currently, the plugin specifically supports Iranian phone numbers, but it can be extended to support other formats.

### Will guest orders be synced automatically when a user registers?

Yes, if a guest places an order with a phone number that matches the phone number used during registration, the order will be synced with the user profile.

## Changelog

### 1.7.1

- Fixed issues with invalid URIs and missing license declaration.
- Added a valid GPL-2.0+ license declaration.
- Updated function and variable names to use unique prefixes.

### 1.7.0

- Improved performance by caching user and order query results.
- Added validation and sanitization for phone numbers.
- Enhanced security by limiting access to critical functions.
- Optimized order synchronization processes.

### 1.6.0

- Initial release with basic functionality for syncing guest orders with user profiles based on phone number.
- Added normalization of phone numbers for consistent comparison.
- Support for Iranian phone numbers.
- Syncing guest orders with existing user profiles based on phone number.
- Saving guest orders for future syncing upon user registration or login.
- Displaying detailed order notes for synced orders.
- Improved security by adding nonce verification for form submissions.
- Improved performance by caching user query results.
- Added detailed logging for troubleshooting and debugging.

### 1.5.0

- Enhanced the phone number normalization process.
- Added support for phone numbers with different formats.
- Improved order note details to include login status of the customer.
- Fixed minor bugs and improved overall stability.

### 1.4.0

- Added functionality to sync guest orders upon user registration.
- Improved the process of linking guest orders to registered users.
- Updated order notes to reflect the syncing status accurately.
- Minor performance improvements and code optimizations.

### 1.3.0

- Introduced initial version of guest order syncing based on phone number.
- Basic phone number normalization added.
- Added initial support for Iranian phone numbers.
- Implemented syncing of guest orders with user profiles.
- Added order notes to indicate the syncing status.
- Initial performance improvements and bug fixes.

## Upgrade Notice

### 1.7.1

Ensure you upgrade to this version to fix issues related to invalid URIs and missing license declaration.

### 1.7.0

Ensure you upgrade to this version to benefit from improved performance, enhanced security, and optimized order synchronization processes.

### 1.6.0

Ensure you upgrade to this version to start syncing guest orders with user profiles based on phone numbers and enjoy improved performance and security features.

### 1.5.0

This version enhances phone number normalization and improves order note details. Update to benefit from these improvements and bug fixes.

### 1.4.0

Upgrade to this version to automatically sync guest orders upon user registration and benefit from improved order linking and performance.

### 1.3.0

Initial release of Guest Order Sync with basic syncing functionality based on phone numbers.

## Additional Information

### About the Author

Ali Karimi is a web developer with extensive experience in WordPress and WooCommerce. He specializes in developing custom plugins and themes to enhance the functionality of WordPress sites. Visit [Nedaye Web](https://nedayeweb.ir) for more information.

### Support

For support, please visit the [support forum](https://wordpress.org/support/plugin/guest-order-sync) or contact us via [Nedaye Web](https://nedayeweb.ir).

### Documentation

Comprehensive documentation for the plugin can be found [here](https://github.com/clonerdev/WooCommerce-Guest-Order-Sync).

### Contributions

We welcome contributions to the plugin. Please feel free to submit issues or pull requests on [GitHub](https://github.com/clonerdev/WooCommerce-Guest-Order-Sync).

### License

This plugin is licensed under the GPLv2 or later. For more information, please visit the [license page](https://www.gnu.org/licenses/gpl-2.0.html).
