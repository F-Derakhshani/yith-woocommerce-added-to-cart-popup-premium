<?php
/**
 * GENERAL ARRAY OPTIONS
 */

$general = array(

	'general'  => array(

		array(
			'title' => __( 'General Options', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'title',
			'desc' => '',
			'id' => 'yith-wacp-general-options'
		),

		array(
			'name'      => __( 'Popup Size', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'      => __( 'Set popup size.', 'yith-woocommerce-added-to-cart-popup' ),
			'type'      => 'yith_wacp_box_size',
			'default'   => array(
				'width'     => '700',
				'height'    => '700'
			),
			'id'        => 'yith-wacp-box-size'
		),

		array(
			'name'      => __( 'Popup Animation', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'      => __( 'Select popup animation', 'yith-woocommerce-added-to-cart-popup' ),
			'type'      => 'select',
			'options'   => array(
				'fade-in'   => __( 'Fade In', 'yith-woocommerce-added-to-cart-popup' ),
				'slide-in-right' => __( 'Slide In (Right)', 'yith-woocommerce-added-to-cart-popup' ),
				'slide-in-left' => __( 'Slide In (Left)', 'yith-woocommerce-added-to-cart-popup' ),
				'slide-in-bottom' => __( 'Slide In (Bottom)', 'yith-woocommerce-added-to-cart-popup' ),
				'slide-in-top' => __( 'Slide In (Top)', 'yith-woocommerce-added-to-cart-popup' ),
				'tred-flip-h' => __( '3D Flip (Horizontal)', 'yith-woocommerce-added-to-cart-popup' ),
				'tred-flip-v' => __( '3D Flip (Vertical)', 'yith-woocommerce-added-to-cart-popup' ),
				'scale-up' => __( 'Scale Up', 'yith-woocommerce-added-to-cart-popup' ),
			),
			'default'   => 'fade-in',
			'id'        => 'yith-wacp-box-animation'
		),

		array(
			'name' => __( 'Enable Popup', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'On Archive Page', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'checkbox',
			'default'   => 'yes',
			'id'        => 'yith-wacp-enable-on-archive',
			'checkboxgroup' => 'start'
		),

		array(
			'name' => '',
			'desc'  => __( 'On Single Product Page', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'checkbox',
			'default'   => 'yes',
			'id'        => 'yith-wacp-enable-on-single',
			'checkboxgroup' => 'end'
		),

		array(
			'name' => __( 'Popup message', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => '',
			'type'  => 'text',
			'default' => __( 'Product successfully added to your cart!', 'yith-woocommerce-added-to-cart-popup' ),
			'id'    => 'yith-wacp-popup-message'
		),

		array(
			'name' => __( 'Select content', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose whether to show the added product or the cart', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'select',
			'options'   => array(
				'product'   => __( 'Added product', 'yith-woocommerce-added-to-cart-popup' ),
				'cart'   => __( 'Cart', 'yith-woocommerce-added-to-cart-popup' ),
			),
			'default'   => 'product',
			'id' => 'yith-wacp-layout-popup'
		),

		array(
			'name' => __( 'Show product thumbnail', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show the product thumbnail in the popup', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'checkbox',
			'default'   => 'yes',
			'id' => 'yith-wacp-show-thumbnail'
		),

		array(
			'id'        => 'yith-wacp-image-size',
			'name'      => __( 'Thumbnail Size', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'      => sprintf( __( 'Set image size (in px). After changing these settings, you may need to %s.', 'yith-woocommerce-added-to-cart-popup' ), '<a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/">' . __( 'regenerate your thumbnails', 'yith-woocommerce-added-to-cart-popup' ) . '</a>' ),
			'type'      => 'yith_wacp_image_size',
			'default'   => array(
				'width'     => '170',
				'height'    => '170',
				'crop'      => 1
			),
			'custom_attributes' => array(
				'data-deps_id' => 'yith-wacp-show-thumbnail'
			)
		),

		array(
			'name' => __( 'Show product variations', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show product variations details ( only available of variable product ).', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'checkbox',
			'default'   => 'yes',
			'id' => 'yith-wacp-show-product-variation'
		),

		array(
			'name' => __( 'Show cart total', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show cart total in the popup', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'checkbox',
			'default'   => 'yes',
			'id' => 'yith-wacp-show-cart-totals'
		),

		array(
			'name' => __( 'Show shipping fees', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show shipping fees in the popup', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'checkbox',
			'default'   => 'yes',
			'id' => 'yith-wacp-show-cart-shipping'
		),
		
		array(
			'name' => __( 'Show tax amount', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show tax cart amount in the popup', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'checkbox',
			'default'   => 'yes',
			'id' => 'yith-wacp-show-cart-tax'
		),

		array(
			'name' => __( 'Show "View Cart" Button', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show "View Cart" button in the popup', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'checkbox',
			'default'   => 'yes',
			'id' => 'yith-wacp-show-go-cart'
		),

		array(
			'name' => __( '"View Cart" Button Text', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Text for "View Cart" button', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'text',
			'default'   => __( 'View Cart', 'yith-woocommerce-added-to-cart-popup' ),
			'id' => 'yith-wacp-text-go-cart',
			'custom_attributes' => array(
				'data-deps_id'  => 'yith-wacp-show-go-cart'
			)
		),

		array(
			'name' => __( 'Show "Continue Shopping" Button', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show "Continue Shopping" button in the popup', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'checkbox',
			'default'   => 'yes',
			'id' => 'yith-wacp-show-continue-shopping'
		),

		array(
			'name' => __( '"Continue Shopping" Button Text', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Text for "Continue Shopping" button', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'text',
			'default'   => __( 'Continue Shopping', 'yith-woocommerce-added-to-cart-popup' ),
			'id' => 'yith-wacp-text-continue-shopping',
			'custom_attributes' => array(
				'data-deps_id'  => 'yith-wacp-show-continue-shopping'
			)
		),

		array(
			'name' => __( 'Show "Go to Checkout" Button', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show "Go to Checkout" button in the popup', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'checkbox',
			'default'   => 'yes',
			'id' => 'yith-wacp-show-go-checkout'
		),

		array(
			'name' => __( '"Go to Checkout" Button Text', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Text for "Go to Checkout" button', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'text',
			'default'   => __( 'Checkout', 'yith-woocommerce-added-to-cart-popup' ),
			'id' => 'yith-wacp-text-go-checkout',
			'custom_attributes' => array(
				'data-deps_id'  => 'yith-wacp-show-go-checkout'
			)
		),

		array(
			'name' => __( 'Enable on mobile', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Enable the plugin features on mobile devices', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'checkbox',
			'default'   => 'yes',
			'id'    => 'yith-wacp-enable-mobile'
		),

		array(
			'type'      => 'sectionend',
			'id'        => 'yith-wacp-general-options'
		),

		array(
			'title' => __( 'Suggested Products', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'title',
			'desc' => '',
			'id' => 'yith-wacp-related-options'
		),

		array(
			'name' => __( 'Show suggested products', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose to show suggested products in popup.', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'checkbox',
			'default'   => 'yes',
			'id'    => 'yith-wacp-show-related'
		),

		array(
			'name' => __( '"Suggested Products" title', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'The title for "Suggested Products" section.', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'text',
			'default'   => __( 'Suggested Products', 'yith-woocommerce-added-to-cart-popup' ),
			'id'    => 'yith-wacp-related-title',
			'custom_attributes' => array(
				'data-deps_id'  => 'yith-wacp-show-related'
			)
		),

		array(
			'name' => __( 'Number of suggested products', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose how many suggested products to show', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'number',
			'default'   => 4,
			'id'    => 'yith-wacp-related-number',
			'custom_attributes' => array(
				'min'   => 1,
				'data-deps_id'  => 'yith-wacp-show-related'
			)
		),

		array(
			'name' => __( 'Columns of suggested products', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose how many columns to show in suggested products', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'yith_wacp_slider',
			'default' => 4,
			'min'   => 2,
			'max'   => 6,
			'step'  => 1,
			'id'    => 'yith-wacp-related-columns',
			'custom_attributes' => array(
				'data-deps_id'  => 'yith-wacp-show-related'
			)
		),

		array(
			'id'   => 'yith-wacp-suggested-products-type',
			'name'  => __( 'Suggested products type', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Select suggested products type.', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'select',
			'options' => array(
				'related'   => __( 'Related Products', 'yith-woocommerce-added-to-cart-popup' ),
				'crossell'  => __( 'Cross-sell Products', 'yith-woocommerce-added-to-cart-popup' ),
				'upsell'    => __( 'Up-sell Products', 'yith-woocommerce-added-to-cart-popup' )
			),
			'default'   => 'related',
			'custom_attributes' => array(
				'data-deps_id'  => 'yith-wacp-show-related'
			)
		),

		array(
			'id'   => 'yith-wacp-related-products',
			'name'  => __( 'Select products', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Select suggested products. If filled, these settings will override what set in the above option.', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'yith_wacp_select_prod',
			'default'   => '',
			'custom_attributes' => array(
				'data-deps_id'  => 'yith-wacp-show-related'
			)
		),
		
		array(
			'id'   => 'yith-wacp-suggested-add-to-cart',
			'name'  => __( 'Show "Add to cart" button', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Show the "add to cart" button for suggested products.', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'checkbox',
			'default'   => 'yes',
		),

		array(
			'type'      => 'sectionend',
			'id'        => 'yith-wacp-related-options'
		),
	)
);

return apply_filters( 'yith_wacp_panel_general_options', $general );