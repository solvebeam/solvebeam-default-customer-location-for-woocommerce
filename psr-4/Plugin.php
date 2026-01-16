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

/**
 * Plugin class
 */
final class Plugin {
	const OPTION_NAME = 'solvebeam_default_customer_location';

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
		\add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		add_filter( 'woocommerce_customer_default_location', [ $this, 'get_default_location' ] );
		add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
	}

	public function get_default_location( $location ) {
		$option = get_option( self::OPTION_NAME );

		if ( ! empty( $option ) ) {
			return $option;
		}

		return $location;
	}

	public function add_settings_page() {
		add_submenu_page(
			'woocommerce',
			__( 'Default Customer Location', 'solvebeam-default-customer-location-for-woocommerce' ),
			__( 'Default Customer Location', 'solvebeam-default-customer-location-for-woocommerce' ),
			'manage_woocommerce',
			'solvebeam-default-customer-location',
			[ $this, 'render_settings_page' ]
		);
	}

	public function register_settings() {
		register_setting(
			'solvebeam_default_customer_location',
			self::OPTION_NAME,
			[
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '',
			]
		);
	}

	public function render_settings_page() {
		$countries = WC()->countries->get_countries();
		$value     = get_option( self::OPTION_NAME );
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Default Customer Location', 'solvebeam-default-customer-location-for-woocommerce' ); ?></h1>

			<p>
				<?php esc_html_e( 'This plugin allows you to set the "Default customer location" that WooCommerce uses for tax, pricing, and shipping calculations.', 'solvebeam-default-customer-location-for-woocommerce' ); ?>
			</p>

			<form method="post" action="options.php">
				<?php settings_fields( 'solvebeam_default_customer_location' ); ?>

				<table class="form-table" role="presentation">
					<tr>
						<th scope="row">
							<label for="solvebeam_default_customer_location">
								<?php esc_html_e( 'Default customer location', 'solvebeam-default-customer-location-for-woocommerce' ); ?>
							</label>
						</th>
						<td>
							<select name="<?php echo esc_attr( self::OPTION_NAME ); ?>" id="solvebeam_default_customer_location">
								<option value="">
									<?php esc_html_e( 'WooCommerce default', 'solvebeam-default-customer-location-for-woocommerce' ); ?>
								</option>
								<?php foreach ( $countries as $code => $label ) : ?>
									<option value="<?php echo esc_attr( $code ); ?>" <?php selected( $value, $code ); ?>>
										<?php echo esc_html( $label ); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<p class="description">
								<?php esc_html_e( 'This determines the location WooCommerce assumes for visitors before they enter their address. It affects taxes, prices, and shipping zones.', 'solvebeam-default-customer-location-for-woocommerce' ); ?>
							</p>
						</td>
					</tr>
				</table>

				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
