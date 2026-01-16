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
	 * @param string|null $plugin_file The plugin file.
	 * @return self A single instance of this class.
	 */
	public static function instance( $plugin_file = null ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $plugin_file );
		}

		return self::$instance;
	}

	/**
	 * Construct.
	 *
	 * @param string $plugin_file The plugin file.
	 */
	private function __construct(
		/**
		 * Plugin file.
		 */
		private string $plugin_file
	) {
		\add_action( 'plugins_loaded', $this->plugins_loaded( ... ) );
	}

	/**
	 * Plugins loaded.
	 *
	 * @return void
	 */
	public function plugins_loaded() {
		if ( ! \class_exists( WooCommerce::class ) ) {
			return;
		}

		\add_filter( 'plugin_action_links_' . \plugin_basename( $this->plugin_file ), $this->add_plugin_action_links( ... ) );
		\add_filter( 'woocommerce_customer_default_location', $this->get_default_location( ... ), 10, 2 );
		\add_filter( 'woocommerce_get_settings_general', $this->add_default_customer_location_setting( ... ), 10, 1 );
	}

	/**
	 * Add plugin action links.
	 *
	 * @param array $links The existing links.
	 * @return array The modified links.
	 */
	public function add_plugin_action_links( $links ) {
		$settings_link = \sprintf(
			'<a href="%s">%s</a>',
			\esc_url( \admin_url( 'admin.php?page=wc-settings&tab=general#solvebeam_woocommerce_default_customer_location' ) ),
			\esc_html__( 'Settings', 'solvebeam-default-customer-location-for-woocommerce' )
		);

		\array_unshift( $links, $settings_link );

		return $links;
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
