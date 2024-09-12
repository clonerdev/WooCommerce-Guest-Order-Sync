# WooCommerce Guest Order Sync

| 🇺🇸 [English](README.md) | 🇮🇷 [Persian](README-FA.md) |
|--------------------------|----------------------------|
<br>

Sync WooCommerce guest orders with user profiles based on phone numbers. Special support for Iranian phone numbers.

## Description
The WooCommerce Guest Order Sync plugin allows you to sync guest orders with user profiles based on phone numbers, with special support for Iranian numbers. The plugin ensures that orders placed by guests are linked to their user accounts if they have already registered or will register in the future.

### Features
- Phone number normalization for continuous comparison
- Support for Iranian phone numbers
- Sync guest orders with existing user profiles
- Store guest orders for future sync when the user registers or logs in
- Display detailed notes for synced orders

## FAQ

### How does the plugin normalize phone numbers?
The plugin removes all non-numeric characters and adds the Iranian country code (+98) when necessary.

### Does the plugin work with other phone number formats?
Currently, the plugin specifically supports Iranian numbers, but it can be extended to support other formats.

### Are guest orders automatically synced when a user registers?
Yes, if a guest places an order using a phone number that is later used for registration, the order will be synced with the user profile.

## Changelog

### 1.8
- Improved performance on sites with CDN or caching systems: Utilizing the Transient API, user and order query results are cached, enhancing plugin performance, especially on sites using caching or CDNs.
- Compatibility with newer PHP versions: The plugin is now compatible with PHP 8.x and higher, ensuring smoother performance on modern server environments.
- Overall performance improvements: Even on non-cached or CDN sites, the plugin operates more efficiently.

### 1.7.1
- Fixed issues related to invalid URIs and missing license declaration.
- Added valid GPL-2.0+ license declaration.
- Updated function and variable names to use unique prefixes.

### 1.7.0
- Improved performance by caching user and order query results.
- Added validation and sanitization for phone numbers.
- Enhanced security by restricting access to critical functions.
- Optimized the guest order syncing processes.

### 1.6.0
- Initial release with basic functionality to sync guest orders with user profiles based on phone numbers.
- Added phone number normalization for continuous comparison.
- Supported Iranian phone numbers.
- Synced guest orders with existing user profiles based on phone numbers.
- Stored guest orders for future sync upon user registration or login.
- Displayed detailed notes for synced orders.
- Improved security by adding nonce validation for form submissions.
- Boosted performance by caching user query results.
- Added detailed logs for troubleshooting and debugging.

### 1.5.0
- Enhanced the phone number normalization process.
- Added support for different phone number formats.
- Improved order notes to display the customer's login status.
- Fixed minor bugs and improved overall stability.

### 1.4.0
- Added guest order syncing upon user registration.
- Improved the process of linking guest orders to registered users.
- Updated order notes to display syncing status more accurately.
- Minor performance improvements and code optimization.

### 1.3.0
- Introduced the initial version of guest order syncing based on phone numbers.
- Added basic phone number normalization.
- Initial support for Iranian phone numbers.
- Implemented guest order syncing with user profiles.
- Added order notes to display syncing status.
- Initial performance improvements and bug fixes.

### About the Author
Ali Karimi is a web developer with extensive experience in WordPress and WooCommerce. He specializes in developing custom plugins and themes to enhance WordPress site functionality. For more information, visit [Nedaye Web](https://nedayeweb.ir).

### Support
For support, please visit the [Support Forum](https://wordpress.org/support/plugin/guest-order-sync) or contact us via [Nedaye Web](https://nedayeweb.ir).

### Documentation
You can find the complete plugin documentation [here](https://github.com/clonerdev/WooCommerce-Guest-Order-Sync).

### Contributions
We welcome contributions to the plugin. Please submit issues or pull requests on [GitHub](https://github.com/clonerdev/WooCommerce-Guest-Order-Sync).

### License
This plugin is licensed under GPLv2 or later. For more information, please visit the [License Page](https://www.gnu.org/licenses/gpl-2.0.html).