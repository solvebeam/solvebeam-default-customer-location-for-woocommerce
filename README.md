# SolveBeam Default Checkout Country for WooCommerce

A minimal WooCommerce plugin that allows you to set a default billing country for the checkout page via a single setting.

## Why this plugin

WooCommerce documents how to change the default state and country on the checkout using a PHP snippet. This plugin provides the same functionality without requiring users to edit theme files or write code.

## Features

- Set a default billing country for WooCommerce checkout
- Uses the official WooCommerce filter
- One setting only
- No frontend assets
- Lightweight and future-proof

## Usage

1. Install and activate the plugin
2. Go to **WooCommerce > Default Checkout Country**
3. Select the default country
4. Save changes

## Technical details

- Uses `default_checkout_billing_country`
- Countries loaded via `WC_Countries`
- Namespaced and prefixed with SolveBeam

## License

GPL-2.0-or-later  
Copyright © SolveBeam
