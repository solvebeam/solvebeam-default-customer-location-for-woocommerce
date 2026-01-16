# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 1.0.0 - 2026-01-16

- **Initial Release**
- Complete refactor from a checkout-only focus to managing the WooCommerce-wide "Default customer location."
- Changed filter from `default_checkout_billing_country` to `woocommerce_customer_default_location`.
- Updated namespace, option names, and all user-facing text to reflect the new scope.
- The plugin now affects taxes, pricing, and shipping zones, not just the checkout country.
