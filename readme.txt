=== SolveBeam Default Customer Location for WooCommerce ===
Contributors: solvebeam
Tags: woocommerce, location, country, tax, pricing, shipping, default customer location
Requires at least: 6.2
Tested up to: 6.5
Requires PHP: 8.3
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Set the default customer location in WooCommerce using a simple admin setting. This location is used by WooCommerce to calculate taxes, pricing, and shipping before the customer enters their own address.

== Description ==

SolveBeam Default Customer Location for WooCommerce lets you set a default country that WooCommerce uses for tax, pricing, and shipping calculations for all visitors.

WooCommerce's "Default customer location" setting determines how taxes, pricing (e.g., including/excluding tax), and shipping zones are applied for first-time visitors. This setting can be based on geolocation, the shop's base address, or be disabled. This plugin adds a simple option to override this setting with a specific country of your choice, without needing geolocation services or code snippets.

Features:
* Set a default customer location (country) for all visitors
* Overrides the "Default customer location" in WooCommerce settings
* Affects taxes, pricing, and shipping zone calculations
* Simple settings page under **WooCommerce > Default Customer Location**
* Lightweight, no-bloat, and no frontend assets

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the "Plugins" menu in WordPress
3. Go to **WooCommerce > Default Customer Location**
4. Select the country you want to use as the default
5. Save changes

== Frequently Asked Questions ==

= How does this differ from the "Default customer location" setting in WooCommerce? =
This plugin provides a simple way to force a specific country as the default location, overriding the standard WooCommerce options (like "Shop base address" or "Geolocate"). It ensures all visitors are treated as if they are from that country until they provide their own address.

= Does this plugin affect customer saved addresses? =
No. Once a customer logs in or enters their address at checkout, their own information will be used. This plugin only sets the default for visitors who have not yet provided location data.

= What is the "default customer location" used for? =
WooCommerce uses it to determine:
*   Which tax rates to apply.
*   Whether to display prices with or without tax.
*   Which shipping zones and methods are available.

== Screenshots ==

1. Settings page under WooCommerce > Default Customer Location

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release.
