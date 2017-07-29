<?php
/*  Copyright 2013  Your Inspiration Themes  (email : plugins@yithemes.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Admin Premium class
 *
 * @author Yithemes
 * @package YITH WooCommerce Added to Cart Popup Premium
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WACP' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WACP_Admin_Premium' ) ) {
	/**
	 * Admin class.
	 * The class manage all the admin behaviors.
	 *
	 * @since 1.0.0
	 */
	class YITH_WACP_Admin_Premium extends YITH_WACP_Admin {

		/**
		 * Single instance of the class
		 *
		 * @var \YITH_WACP_Admin_Premium
		 * @since 1.0.0
		 */
		protected static $instance;

		/**
		 * Plugin version
		 *
		 * @var string
		 * @since 1.0.0
		 */
		public $version = YITH_WACP_VERSION;

		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_WACP_Admin_Premium
		 * @since 1.0.0
		 */
		public static function get_instance(){
			if( is_null( self::$instance ) ){
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @access public
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct();

			// register plugin to licence/update system
			add_action( 'wp_loaded', array( $this, 'register_plugin_for_activation' ), 99 );
			add_action( 'admin_init', array( $this, 'register_plugin_for_updates' ) );

			// add custom popup size
			add_action( 'woocommerce_admin_field_yith_wacp_box_size', array( $this, 'set_box_size' ), 10, 1 );

			/** add custom slider type */
			add_action( 'woocommerce_admin_field_yith_wacp_slider', array( $this, 'admin_fields_slider' ), 10, 1 );

			// add custom image size type
			add_action( 'woocommerce_admin_field_yith_wacp_image_size', array( $this, 'custom_image_size' ), 10, 1 );

			// select product
			add_action( 'woocommerce_admin_field_yith_wacp_select_prod', array( $this, 'yith_wacp_select_prod' ), 10, 1 );
			// sanitize option value for select categories
			add_filter( 'woocommerce_admin_settings_sanitize_option_yith-wacp-related-products', array( $this, 'sanitize_option_products' ), 10, 3 );

			// add tabs
			add_filter( 'yith-wacp-admin-tabs', array( $this, 'add_tabs' ), 1 );

			// add exclusions tables
			add_action( 'yith_wacp_exclusions_prod_table', array( $this, 'exclusions_prod_table' ) );
			add_action( 'yith_wacp_exclusions_cat_table', array( $this, 'exclusions_cat_table' ) );

			// enqueue style premium
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_premium' ) );
		}

		/**
		 * Register plugins for activation tab
		 *
		 * @return void
		 * @since 2.0.0
		 */
		public function register_plugin_for_activation() {
			if ( ! class_exists( 'YIT_Plugin_Licence' ) ) {
				require_once( YITH_WACP_DIR . 'plugin-fw/licence/lib/yit-licence.php' );
				require_once( YITH_WACP_DIR . 'plugin-fw/licence/lib/yit-plugin-licence.php' );
			}

			YIT_Plugin_Licence()->register( YITH_WACP_INIT, YITH_WACP_SECRET_KEY, YITH_WACP_SLUG );
		}

		/**
		 * Register plugins for update tab
		 *
		 * @return void
		 * @since 2.0.0
		 */
		public function register_plugin_for_updates() {
			if( ! class_exists( 'YIT_Plugin_Licence' ) ){
				require_once( YITH_WACP_DIR . 'plugin-fw/lib/yit-upgrade.php' );
			}

			YIT_Upgrade()->register( YITH_WACP_SLUG, YITH_WACP_INIT );
		}

		/**
		 * Add box size to standard WC types
		 *
		 * @since 1.0.0
		 * @access public
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function set_box_size( $value ){

			$option_values = get_option( $value['id'] );
			$width  = isset( $option_values['width'] ) ? $option_values['width'] : $value['default']['width'];
			$height = isset( $option_values['height'] ) ? $option_values['height'] : $value['default']['height'];

			?><tr valign="top">
			<th scope="row" class="titledesc"><?php echo esc_html( $value['title'] ) ?></th>
			<td class="forminp yith_box_size_settings">

				<input name="<?php echo esc_attr( $value['id'] ); ?>[width]" id="<?php echo esc_attr( $value['id'] ); ?>-width" type="text" size="3" value="<?php echo $width; ?>" />
				&times;
				<input name="<?php echo esc_attr( $value['id'] ); ?>[height]" id="<?php echo esc_attr( $value['id'] ); ?>-height" type="text" size="3" value="<?php echo $height; ?>" />px

				<div><span class="description"><?php echo $value['desc'] ?></span></div>

			</td>
			</tr><?php

		}

		/**
		 * Add premium tabs in settings panel
		 *
		 * @since 1.0.0
		 * @param mixed $tabs
		 * @return mixed
		 * @author Francesco Licandro
		 */
		public function add_tabs( $tabs ) {
			$tabs['style'] = __( 'Style', 'yith-woocommerce-added-to-cart-popup' );
			$tabs['exclusions-prod'] = __( 'Product Exclusion List', 'yith-woocommerce-added-to-cart-popup' );
			$tabs['exclusions-cat'] = __( 'Category Exclusion List', 'yith-woocommerce-added-to-cart-popup' );

			return $tabs;
		}

		/**
		 * Add products exclusion table
		 *
		 * @access public
		 * @since 1.0.0
		 * @author Francesco Licandro
		 */
		public function exclusions_prod_table() {

			$table = new YITH_WACP_Exclusions_Prod_Table();
			$table->prepare_items();

			if( file_exists( YITH_WACP_TEMPLATE_PATH . '/admin/exclusions-prod-table.php' ) ) {
				include_once( YITH_WACP_TEMPLATE_PATH . '/admin/exclusions-prod-table.php' );
			}
		}

		/**
		 * Add categories exclusion table
		 *
		 * @access public
		 * @since 1.0.0
		 * @author Francesco Licandro
		 */
		public function exclusions_cat_table() {

			$table = new YITH_WACP_Exclusions_Cat_Table();
			$table->prepare_items();

			if( file_exists( YITH_WACP_TEMPLATE_PATH . '/admin/exclusions-cat-table.php' ) ) {
				include_once( YITH_WACP_TEMPLATE_PATH . '/admin/exclusions-cat-table.php' );
			}
		}

		/**
		 * Enqueue premium styles and scripts
		 *
		 * @access public
		 * @since 1.0.0
		 * @author Francesco Licandro
		 */
		public function enqueue_scripts_premium() {

			$min = ( ! defined('SCRIPT_DEBUG') || ! SCRIPT_DEBUG ) ? '.min' : '';

			wp_register_style( 'yith-wacp-admin-style', YITH_WACP_ASSETS_URL . '/css/wacp-admin.css', false, 'all' );
			wp_register_script( 'yith-wacp-admin-scripts', YITH_WACP_ASSETS_URL . '/js/wacp-admin'. $min . '.js', array( 'jquery', 'jquery-ui-slider' ), $this->version, true );

			if ( isset( $_GET['page'] ) && $_GET['page'] == $this->_panel_page ) {
				wp_enqueue_style( 'yith-wacp-admin-style' );
				wp_enqueue_script( 'jquery-ui-slider' );
				wp_enqueue_script( 'yith-wacp-admin-scripts' );
			}
		}

		/**
		 * Add custom image size to standard WC types
		 *
		 * @since 1.0.0
		 * @access public
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function custom_image_size( $value ){

			$option_values = get_option( $value['id'] );
			$width  = isset( $option_values['width'] ) ? $option_values['width'] : $value['default']['width'];
			$height = isset( $option_values['height'] ) ? $option_values['height'] : $value['default']['height'];
			$crop   = isset( $option_values['crop'] ) ? $option_values['crop'] : $value['default']['crop'];

			?><tr valign="top">
			<th scope="row" class="titledesc"><?php echo esc_html( $value['title'] ) ?></th>
			<td class="forminp yith_image_size_settings"
				<?php if( isset( $value['custom_attributes'] ) ) {
					foreach( $value['custom_attributes'] as $key => $data ) {
						echo ' ' . $key .'="' . $data . '"';
					}
				} ?>
				>
				<input name="<?php echo esc_attr( $value['id'] ); ?>[width]" id="<?php echo esc_attr( $value['id'] ); ?>-width" type="text" size="3" value="<?php echo $width; ?>" /> &times; <input name="<?php echo esc_attr( $value['id'] ); ?>[height]" id="<?php echo esc_attr( $value['id'] ); ?>-height" type="text" size="3" value="<?php echo $height; ?>" />px

				<label><input name="<?php echo esc_attr( $value['id'] ); ?>[crop]" id="<?php echo esc_attr( $value['id'] ); ?>-crop" type="checkbox" value="1" <?php checked( 1, $crop ); ?> /> <?php _e( 'Do you want to hard crop the image?', 'yith-woocommerce-added-to-cart-popup' ); ?></label>

				<div><span class="description"><?php echo $value['desc'] ?></span></div>

			</td>
			</tr><?php

		}

		/**
		 * Create slider type
		 *
		 * @access public
		 * @param array $value
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function admin_fields_slider( $value ) {

			$slider_value = get_option( $value['id'], $value['default'] );

			?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
				</th>
				<td class="forminp"
					<?php if( isset( $value['custom_attributes'] ) ) {
						foreach( $value['custom_attributes'] as $key => $data ) {
							echo ' ' . $key .'="' . $data . '"';
						}
					} ?>
					>
					<div id="<?php echo esc_attr( $value['id'] ); ?>_slider" class="yith_woocommerce_slider" style="width: 300px; float: left;"></div>
					<div id="<?php echo esc_attr( $value['id'] ); ?>_value" class="yith_woocommerce_slider_value ui-state-default ui-corner-all"><?php echo $slider_value ?></div>
					<input name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" type="hidden" value="<?php echo $slider_value ?>" />
					<span class="description"><?php echo $value['desc']; ?></span>
				</td>
			</tr>



			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_attr( $value['id'] ); ?>_slider').slider({
						min  : <?php echo $value['min'] ?>,
						max  : <?php echo $value['max'] ?>,
						step : <?php echo $value['step'] ?>,
						value: <?php echo $slider_value ?>,
						slide: function (event, ui) {
							$("#<?php echo esc_attr( $value['id'] ); ?>").val(ui.value);
							$("#<?php echo esc_attr( $value['id'] ); ?>_value").text(ui.value);
						}
					});
				});
			</script>

			<?php
		}

		/**
		 * Add select product ajax in plugin settings
		 *
		 * @since 1.0.0
		 * @param mixed $value
		 * @author Francesco Licandro
		 */
		public function yith_wacp_select_prod( $value ) {


			$products = get_option( $value['id'], $value['default'] );

			// build data selected array
			$data_selected   = array();
			! is_array( $products ) && $products = explode( ',', $products );

			foreach ( $products as $product_id ) {
				$product = wc_get_product( $product_id );
				if ( $product ) {
					$data_selected[ $product_id ] = $product->get_formatted_name();
				}
			}

			?>

			<tr valign="top">
				<th scope="row" class="image_upload">
					<label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
				</th>
				<td class="forminp yith_wacp_select_prod">

					<?php yit_add_select2_fields( array(
						'style' 			=> 'width: 50%;',
						'class'				=> 'wc-product-search',
						'id'				=> $value['id'],
						'name'				=> $value['id'],
						'data-placeholder' 	=> __( 'Search product...', 'yith-woocommerce-added-to-cart-popup' ),
						'data-multiple'		=> true,
						'data-action'		=> 'woocommerce_json_search_products',
						'custom-attributes' => $value['custom_attributes'],
						'data-selected'		=> $data_selected,
						'value'				=> implode( ',', $products )
					) );
					?>

					<span class="description"><?php echo $value['desc'] ?></span>
				</td>
			</tr>

		<?php
		}


		/**
		 * Sanitize option for select products
		 *
		 * @since 1.1.0
		 * @author Francesco Licandro
		 * @param mixed $value
		 * @param array $option
		 * @param mixed $raw_value
		 * @return mixed
		 */
		public function sanitize_option_products( $value, $option, $raw_value ) {
			return is_null( $value ) ? array() : $value;
		}
	}
}
/**
 * Unique access to instance of YITH_WACP_Admin_Premium class
 *
 * @return \YITH_WACP_Admin_Premium
 * @since 1.0.0
 */
function YITH_WACP_Admin_Premium(){
	return YITH_WACP_Admin_Premium::get_instance();
}