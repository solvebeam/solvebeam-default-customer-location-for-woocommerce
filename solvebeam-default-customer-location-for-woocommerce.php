<?php
/**
 * SolveBeam Default Customer Location for WooCommerce
 *
 * @author    SolveBeam
 * @copyright 2026 SolveBeam
 * @license   GPL-2.0-or-later
 * @package   SolveBeam\WooCommerceDefaultCustomerLocation
 *
 * @wordpress-plugin
 * Plugin Name:       SolveBeam Default Customer Location for WooCommerce
 * Plugin URI:        https://www.solvebeam.com/
 * Description:       Override the default customer location used by WooCommerce for taxes, pricing, and checkout.
 * Version:           1.0.0
 * Requires at least: 6.2
 * Requires PHP:      8.3
 * Author:            SolveBeam
 * Author URI:        https://www.solvebeam.com/
 * Text Domain:       solvebeam-default-customer-location-for-woocommerce
 * Domain Path:       /languages/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Requires Plugins:  woocommerce
 * GitHub URI:        https://github.com/solvebeam/solvebeam-default-customer-location-for-woocommerce
 */

declare(strict_types=1);

namespace SolveBeam\WooCommerceDefaultCustomerLocation;

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
		\load_plugin_textdomain( 'solvebeam-default-customer-location-for-woocommerce', false, \dirname( \plugin_basename( __FILE__ ) ) . '/languages' );
	}
);

Plugin::instance( __FILE__ );
