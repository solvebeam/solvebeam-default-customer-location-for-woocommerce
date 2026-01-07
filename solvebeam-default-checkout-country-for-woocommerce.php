<?php
/**
 * SolveBeam Default Checkout Country for WooCommerce
 *
 * @author    SolveBeam
 * @copyright 2026 SolveBeam
 * @license   GPL-2.0-or-later
 * @package   SolveBeam\WooCommerceDefaultCheckoutCountry
 *
 * @wordpress-plugin
 * Plugin Name:       SolveBeam Default Checkout Country for WooCommerce
 * Plugin URI:        https://www.solvebeam.com/
 * Description:       Allows you to set a default billing country for the WooCommerce checkout using a simple setting.
 * Version:           1.0.0
 * Requires at least: 6.2
 * Requires PHP:      8.2
 * Author:            SolveBeam
 * Author URI:        https://www.solvebeam.com/
 * Text Domain:       solvebeam-default-checkout-country-for-woocommerce
 * Domain Path:       /languages/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Requires Plugins:  woocommerce
 * GitHub URI:        https://github.com/solvebeam/solvebeam-default-checkout-country-for-woocommerce
 */

namespace SolveBeam\WooCommerceDefaultCheckoutCountry;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoload.
 */
$autoload_path = __DIR__ . '/vendor/autoload_packages.php';

if ( \file_exists( $autoload_path ) ) {
	require_once $autoload_path;
}

/**
 * Bootstrap.
 */
\add_action(
	'plugins_loaded',
	function () {
		\load_plugin_textdomain( 'solvebeam-default-checkout-country-for-woocommerce', false, \dirname( \plugin_basename( __FILE__ ) ) . '/languages' );
	}
);

Plugin::instance()->setup();
