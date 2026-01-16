<?php
/**
 * Plugin
 *
 * @author    SolveBeam
 * @copyright 2026 SolveBeam
 * @license   GPL-2.0-or-later
 * @package   SolveBeam\WooCommerceDefaultCustomerLocation
 */

namespace SolveBeam\WooCommerceDefaultCustomerLocation;

use WooCommerce;

/**
 * Plugin class
 */
final class Plugin {
	/**
	 * Instance.
	 *
	 * @var self
	 */
	protected static $instance = null;

	/**
	 * Return instance of this class.
	 *
	 * @return self A single instance of this class.
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Construct.
	 */
	private function __construct() {
		\add_action( 'plugins_loaded', $this->init( ... ) );
	}

	/**
	 * Initialize plugin.
	 *
	 * @return void
	 */
	public function init() {
		if ( ! \class_exists( WooCommerce::class ) ) {
			return;
		}

		\add_filter( 'woocommerce_customer_default_location', $this->get_default_location( ... ), 10, 2 );
		\add_filter( 'woocommerce_get_settings_general', $this->add_default_customer_location_setting( ... ), 10, 1 );
	}

	/**
	 * Get the default location.
	 *
	 * Only overrides the default location if the WooCommerce "Default customer location"
	 * is set to "Shop country/region" (`base`).
	 *
	 * @param string $location The default location.
	 * @return string The modified default location.
	 */
	private function get_default_location( $location ) {
		$default_customer_address = \get_option( 'woocommerce_default_customer_address' );

		/**
		 * No location by default.
		 *
		 * @link https://github.com/woocommerce/woocommerce/blob/1791b9aaca1b055d5197ab325aa8f9efcc8f1615/plugins/woocommerce/includes/admin/settings/class-wc-settings-general.php#L232-L245
		 */
		if ( '' === $default_customer_address ) {
			return $location;
		}

		$override_location = \get_option( 'solvebeam_woocommerce_default_customer_location' );

		if ( '' === $override_location ) {
			return $location;
		}

		return $override_location;
	}

	/**
	 * Add the default customer location setting to the WooCommerce general settings.
	 *
	 * @param array $settings The existing settings.
	 * @return array The modified settings.
	 */
	private function add_default_customer_location_setting( $settings ) {
		$new_settings = [];

		$new_setting = [
			'title'    => __( 'Override shop country/region for customer location', 'solvebeam-default-customer-location-for-woocommerce' ),
			'desc'     => __( "Use this setting when the 'Default customer location' above is set to 'Shop country/region', but you want to set a different default location for customers. For example, if your store is based in the Netherlands, but you primarily sell to customers in Germany, select 'Germany' here. New visitors will then immediately see prices and shipping options applicable to Germany.", 'solvebeam-default-customer-location-for-woocommerce' ),
			'desc_tip' => \__( 'This setting is added by the <i>SolveBeam Default Customer Location for WooCommerce</i> plugin.', 'solvebeam-default-customer-location-for-woocommerce' ),
			'id'       => 'solvebeam_woocommerce_default_customer_location',
			'type'     => 'single_select_country',
			'default'  => \get_option( 'woocommerce_default_country' ),
		];

		foreach ( $settings as $setting ) {
			$new_settings[] = $setting;

			if ( isset( $setting['id'] ) && 'woocommerce_default_customer_address' === $setting['id'] ) {
				$new_settings[] = $new_setting;
			}
		}

		return $new_settings;
	}
}
