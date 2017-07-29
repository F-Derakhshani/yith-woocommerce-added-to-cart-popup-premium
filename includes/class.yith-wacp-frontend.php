<?php
/**
 * Frontend class
 *
 * @author Yithemes
 * @package YITH WooCommerce Added to Cart Popup
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WACP' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WACP_Frontend' ) ) {
	/**
	 * Frontend class.
	 * The class manage all the frontend behaviors.
	 *
	 * @since 1.0.0
	 */
	class YITH_WACP_Frontend {

		/**
		 * Single instance of the class
		 *
		 * @var \YITH_WACP_Frontend
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
		 * @return \YITH_WACP_Frontend
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

			// enqueue scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );
			// load template
			add_action( 'wp_footer', array( $this, 'load_template' ) );
			
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'add_to_cart_success_ajax' ), 99, 1 );
		}

		/**
		 * Enqueue scripts
		 *
		 * @since 1.0.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function enqueue_scripts(){

			$paths      = apply_filters( 'yith_wacp_stylesheet_paths', array( WC()->template_path() . 'yith-wacp-frontend.css', 'yith-wacp-frontend.css' ) );
			$located    = locate_template( $paths, false, false );
			$search     = array( get_stylesheet_directory(), get_template_directory() );
			$replace    = array( get_stylesheet_directory_uri(), get_template_directory_uri() );
			$stylesheet = ! empty( $located ) ? str_replace( $search, $replace, $located ) : YITH_WACP_ASSETS_URL . '/css/wacp-frontend.css';
			$min        = ( ! defined('SCRIPT_DEBUG') || ! SCRIPT_DEBUG ) ? '.min' : '';

			wp_enqueue_style( 'yith-wacp-frontend', $stylesheet );

			wp_register_script( 'yith-wacp-frontend-script', YITH_WACP_ASSETS_URL . '/js/wacp-frontend' . $min .'.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( 'yith-wacp-frontend-script' );

			$background         = get_option( "yith-wacp-button-background" );
			$background_hover   = get_option( "yith-wacp-button-background-hover" );
			$text_color         = get_option( "yith-wacp-button-text" );
			$text_color_hover   = get_option( "yith-wacp-button-text-hover" );

			$inline_css = "
                #yith-wacp-popup .yith-wacp-content a.button {
                        background: {$background};
                        color: {$text_color};
                }
                #yith-wacp-popup .yith-wacp-content a.button:hover {
                        background: {$background_hover};
                        color: {$text_color_hover};
                }";

			wp_add_inline_style( 'yith-wacp-frontend', $inline_css );

		}

		/**
		 * Load popup template
		 *
		 * @since 1.0.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function load_template() {

			$args = apply_filters( 'yith_wacp_popup_template_args', array(
				'animation' => 'fade-in'
			) );

			wc_get_template( 'yith-wacp-popup.php', $args, '', YITH_WACP_DIR . 'templates/' );
		}

		/**
	     * Added to cart success popup box
	     *
	     * @param array
	     * @return array
	     * @since 1.0.0
	     * @author Francesco Licandro <francesco.licandro@yithemes.com>
	     */
		public function add_to_cart_success_ajax( $datas ) {

			$view_cart  = get_option( 'yith-wacp-show-go-cart' ) == 'yes';
			$continue   = get_option( 'yith-wacp-show-continue-shopping' ) == 'yes';
			$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();

			// add to cart popup
			ob_start();
			?>

			<?php if ( isset( $_REQUEST['product_id'] ) ): ?>

				<div class="product-info">
					<p><?php echo get_the_title( $_REQUEST['product_id'] ) . ' ' . __( 'was added to your cart', 'yith-woocommerce-added-to-cart-popup' ) ?></p>
				</div>

			<?php else: ?>

				<p><?php _e( 'Added to your cart', 'yith-woocommerce-added-to-cart-popup' ) ?></p>

			<?php endif ?>

			<div class="actions">
				<?php if( $view_cart ) : ?>
					<a class="<?php echo apply_filters( 'yith_wacp_go_cart_class', 'button go-cart' ) ?>" href="<?php echo $cart_url; ?>"><?php _e( 'View cart', 'yith-woocommerce-added-to-cart-popup' ) ?></a>
				<?php endif ?>
				<?php if( $continue ) : ?>
					<a class="<?php echo apply_filters( 'yith_wacp_continue_shopping_class', 'button continue-shopping' ) ?>" href="#"><?php _e( 'Continue shopping', 'yith-woocommerce-added-to-cart-popup' ) ?></a>
				<?php endif; ?>
			</div>

			<?php
			$datas['yith_wacp_message'] = ob_get_clean();

			return $datas;
		}
	}
}
/**
 * Unique access to instance of YITH_WACP_Frontend class
 *
 * @return \YITH_WACP_Frontend
 * @since 1.0.0
 */
function YITH_WACP_Frontend(){
	return YITH_WACP_Frontend::get_instance();
}