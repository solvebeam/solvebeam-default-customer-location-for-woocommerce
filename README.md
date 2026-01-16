# SolveBeam Default Customer Location for WooCommerce

Set the default customer location in WooCommerce using a simple admin setting. This location is used by WooCommerce to calculate taxes, pricing, and shipping before the customer enters their own address.

## Why this plugin

WooCommerce's "Default customer location" setting determines how taxes, pricing (e.g., including/excluding tax), and shipping zones are applied for first-time visitors. This setting can be based on geolocation, the shop's base address, or be disabled.

This plugin adds a simple option to override this setting with a specific country of your choice, without needing geolocation services or code snippets.

## Features

- Set a default customer location (country) for all visitors
- Overrides the "Default customer location" in WooCommerce settings
- Affects taxes, pricing, and shipping zone calculations
- Simple settings page under **WooCommerce > Default Customer Location**
- Lightweight, no-bloat, and no frontend assets

## Usage

1. Install and activate the plugin
2. Go to **WooCommerce > Default Customer Location**
3. Select the default country
4. Save changes

## Technical details

- Uses the `woocommerce_customer_default_location` filter
- Countries loaded via `WC_Countries`
- Fully namespaced and follows WordPress coding standards

## License

GPL-2.0-or-later  
Copyright © SolveBeam
