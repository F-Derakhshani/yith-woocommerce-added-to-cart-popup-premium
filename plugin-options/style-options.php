<?php
/**
 * STYLE ARRAY OPTIONS
 */

$style = array(

	'style'  => array(

		array(
			'title' => __( 'Style Options', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'title',
			'desc' => '',
			'id' => 'yith-wacp-style-options'
		),

		array(
			'name' => __( 'Overlay color', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose popup overlay color', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'color',
			'default' => '#000000',
			'id'    => 'yith-wacp-overlay-color'
		),

		array(
			'name' => __( 'Overlay opacity', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose popup overlay opacity (from 0 to 1)', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'yith_wacp_slider',
			'default' => 0.8,
			'min'   => 0,
			'max'   => 1,
			'step'  => 0.1,
			'id'    => 'yith-wacp-overlay-opacity'
		),

		array(
			'name'  => __( 'Popup background', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Choose popup background color', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default'   => '#ffffff',
			'id'    => 'yith-wacp-popup-background'
		),

		array(
			'name' => __( 'Closing link color', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose closing link color', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'color',
			'default' => '#ffffff',
			'id'    => 'yith-wacp-close-color'
		),

		array(
			'name' => __( 'Closing link hover color', 'yith-woocommerce-added-to-cart-popup' ),
			'desc' => __( 'Choose closing link hover color', 'yith-woocommerce-added-to-cart-popup' ),
			'type' => 'color',
			'default' => '#c0c0c0',
			'id'    => 'yith-wacp-close-color-hover'
		),

		array(
			'name'  => __( 'Message Text Color', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Choose popup message text color', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default' => '#000000',
			'id'    => 'yith-wacp-message-text-color'
		),

		array(
			'name'  => __( 'Message Background Color', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Choose popup message background color', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default' => '#e6ffc5',
			'id'    => 'yith-wacp-message-background-color'
		),

		array(
			'name'  => __( 'Message Icon', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Upload a popup message icon (suggested size 25x25 px)', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'yith_wacp_upload',
			'default' => YITH_WACP_ASSETS_URL . '/images/message-icon.png',
			'id'    => 'yith-wacp-message-icon'
		),

		array(
			'name'  => __( 'Product Name', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Choose color for product name', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default' => '#000000',
			'id'    => 'yith-wacp-product-name-color'
		),

		array(
			'name'  => __( 'Product Name Hover', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Choose hover color for product name', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default' => '#565656',
			'id'    => 'yith-wacp-product-name-color-hover'
		),

		array(
			'name'  => __( 'Product Price', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Choose color for product price', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default' => '#565656',
			'id'    => 'yith-wacp-product-price-color'
		),

		array(
			'name'  => __( 'Total and Shipping label', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Choose color for total and shipping label', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default' => '#565656',
			'id'    => 'yith-wacp-cart-info-label-color'
		),

		array(
			'name'  => __( 'Total and Shipping amount', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Choose color for total and shipping amount', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default' => '#000000',
			'id'    => 'yith-wacp-cart-info-amount-color'
		),

		array(
			'name' => __( 'Button Background', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Select the button background color', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default'   => '#ebe9eb',
			'id'    => 'yith-wacp-button-background'
		),

		array(
			'name' => __( 'Button Background on Hover', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Select the button background color on mouseover', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default'   => '#dad8da',
			'id'    => 'yith-wacp-button-background-hover'
		),

		array(
			'name' => __( 'Button Text', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Select the color of the text of the button', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default'   => '#515151',
			'id'    => 'yith-wacp-button-text'
		),

		array(
			'name' => __( 'Button Text on Hover', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Select the color of the text of the button on mouseover', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default'   => '#515151',
			'id'    => 'yith-wacp-button-text-hover'
		),

		array(
			'name' => __( 'Related Title', 'yith-woocommerce-added-to-cart-popup' ),
			'desc'  => __( 'Select the color of the related product section title', 'yith-woocommerce-added-to-cart-popup' ),
			'type'  => 'color',
			'default'   => '#565656',
			'id'    => 'yith-wacp-related-title-color'
		),

		array(
			'type'      => 'sectionend',
			'id'        => 'yith-wacp-style-options'
		)
	)
);

return apply_filters( 'yith_wacp_panel_style_options', $style );