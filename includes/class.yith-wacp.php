<?php
/**
 * Main class
 *
 * @author Yithemes
 * @package YITH WooCommerce Added to Cart Popup
 * @version 1.0.0
 */


if ( ! defined( 'YITH_WACP' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WACP' ) ) {
	/**
	 * YITH WooCommerce Added to Cart Popup
	 *
	 * @since 1.0.0
	 */
	class YITH_WACP {

		/**
		 * Single instance of the class
		 *
		 * @var \YITH_WACP
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
		 * @return \YITH_WACP
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
		 * @return mixed YITH_WACP_Admin | YITH_WACP_Frontend
		 * @since 1.0.0
		 */
		public function __construct() {

			// Load Plugin Framework
			add_action( 'after_setup_theme', array( $this, 'plugin_fw_loader' ), 1 );

			// Class admin
			if ( $this->is_admin() ) {

				// require admin class
				require_once( 'class.yith-wacp-admin.php' );
				require_once( 'class.yith-wacp-admin-premium.php' );

				// table
				require_once( 'class.yith-wacp-exclusions-handler.php' );
				require_once( 'admin-tables/class.yith-wacp-exclusions-prod-table.php' );
				require_once( 'admin-tables/class.yith-wacp-exclusions-cat-table.php' );

				YITH_WACP_Admin_Premium();
				YITH_WACP_Exclusions_Handler();
			}
			elseif( $this->load_frontend() ) {

				// require frontend class
				require_once( 'class.yith-wacp-frontend.php' );
				require_once( 'class.yith-wacp-frontend-premium.php' );

				YITH_WACP_Frontend_Premium();
			}

			// load integrations class with YITH WooCommerce Cart Messages Premium
			if( defined( 'YITH_YWCM_PREMIUM' ) && 'YITH_YWCM_PREMIUM' ) {
				require_once( 'integrations/class.yith-wacp-ywcm-integration.php' );
			}


			add_action( 'init', array( $this, 'register_size' ) );
		}

		/**
		 * Load Plugin Framework
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 * @author Andrea Grillo <andrea.grillo@yithemes.com>
		 */
		public function plugin_fw_loader() {
			if ( ! defined( 'YIT_CORE_PLUGIN' ) ) {
				global $plugin_fw_data;
				if( ! empty( $plugin_fw_data ) ){
					$plugin_fw_file = array_shift( $plugin_fw_data );
					require_once( $plugin_fw_file );
				}
			}
		}

		/**
		 * Check if is admin
		 * 
		 * @since 1.1.0
		 * @access public
		 * @author Francesco Licandro
		 * @return boolean
		 */
		public function is_admin(){
			$context_check = isset( $_REQUEST['context'] ) && $_REQUEST['context'] == 'frontend';	
			$is_admin = is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX && $context_check );
			return apply_filters( 'yith_wacp_check_is_admin', $is_admin );
		}

        /**
         * Check if load or not frontend class
         *
         * @since 1.2.0
         * @author Francesco Licandro
         * @return boolean
         */
        public function load_frontend(){
	        $is_one_click = isset( $_REQUEST['_yith_wocc_one_click'] ) && $_REQUEST['_yith_wocc_one_click'] == 'is_one_click';
	        $load = ( ! wp_is_mobile() || get_option( 'yith-wacp-enable-mobile' ) != 'no' ) && ! $is_one_click;
	        return apply_filters( 'yith_wacp_check_load_frontend', $load );
        }
		
		/**
		 * Register size
		 *
		 * @access public
		 * @since 1.0.0
		 * @author Francesco Licandro
		 */
		public function register_size() {
			// set image size
			$size   = get_option( 'yith-wacp-image-size' );
			$width  = isset( $size['width'] ) ? $size['width'] : 0;
			$height = isset( $size['height'] ) ? $size['height'] : 0;
			$crop   = isset( $size['crop'] ) ? $size['crop'] : false;

			add_image_size( 'yith_wacp_image_size', $width, $height, $crop );
		}
	}
}

/**
 * Unique access to instance of YITH_WACP class
 *
 * @return \YITH_WACP
 * @since 1.0.0
 */
function YITH_WACP(){
	return YITH_WACP::get_instance();
}