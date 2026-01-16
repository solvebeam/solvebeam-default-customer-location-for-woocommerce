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
	const OPTION_NAME = 'solvebeam_default_checkout_country';

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

		add_filter( 'default_checkout_billing_country', [ $this, 'get_default_country' ] );
		add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
	}

	public function get_default_country( $country ) {
		$option = get_option( self::OPTION_NAME );

		if ( ! empty( $option ) ) {
			return $option;
		}

		return $country;
	}

	public function add_settings_page() {
		add_submenu_page(
			'woocommerce',
			__( 'Default Checkout Country', 'solvebeam-default-checkout-country' ),
			__( 'Default Checkout Country', 'solvebeam-default-checkout-country' ),
			'manage_woocommerce',
			'solvebeam-default-checkout-country',
			[ $this, 'render_settings_page' ]
		);
	}

	public function register_settings() {
		register_setting(
			'solvebeam_default_checkout_country',
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
			<h1><?php esc_html_e( 'Default Checkout Country', 'solvebeam-default-checkout-country' ); ?></h1>

			<form method="post" action="options.php">
				<?php settings_fields( 'solvebeam_default_checkout_country' ); ?>

				<table class="form-table" role="presentation">
					<tr>
						<th scope="row">
							<label for="solvebeam_default_checkout_country">
								<?php esc_html_e( 'Default billing country', 'solvebeam-default-checkout-country' ); ?>
							</label>
						</th>
						<td>
							<select name="<?php echo esc_attr( self::OPTION_NAME ); ?>" id="solvebeam_default_checkout_country">
								<option value="">
									<?php esc_html_e( 'WooCommerce default', 'solvebeam-default-checkout-country' ); ?>
								</option>
								<?php foreach ( $countries as $code => $label ) : ?>
									<option value="<?php echo esc_attr( $code ); ?>" <?php selected( $value, $code ); ?>>
										<?php echo esc_html( $label ); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<p class="description">
								<?php esc_html_e( 'This country will be preselected on the WooCommerce checkout page.', 'solvebeam-default-checkout-country' ); ?>
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
