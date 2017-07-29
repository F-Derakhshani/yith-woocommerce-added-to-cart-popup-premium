<?php
/**
 * Admin View: Exclusions List Table
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$list_query_args = array(
	'page' => $_GET['page'],
	'tab'  => $_GET['tab']
);

$list_url = add_query_arg( $list_query_args, admin_url( 'admin.php' ) );

?>
<div class="wrap">
	<div class="icon32 icon32-posts-post" id="icon-edit"><br /></div>
	<h2><?php _e( 'Product exclusion list', 'yith-woocommerce-added-to-cart-popup' ); ?></h2>

	<?php if ( ! empty( $notice ) ) : ?>
		<div id="notice" class="error below-h2"><p><?php echo $notice; ?></p></div>
	<?php endif;

	if ( ! empty( $message ) ) : ?>
		<div id="message" class="updated below-h2"><p><?php echo $message; ?></p></div>
	<?php endif;

	?>
	<form id="yith-add-exclusion-prod" method="POST">
		<input type="hidden" name="_nonce" value="<?php echo wp_create_nonce( 'yith_wacp_add_exclusions_prod' ); ?>" />
		<label for="add_products"><?php _e( 'Select products to exclude', 'yith-woocommerce-added-to-cart-popup' ); ?></label>
		<?php yit_add_select2_fields( array(
			'style' 			=> 'width: 300px;display: inline-block;',
			'class'				=> 'wc-product-search',
			'id'				=> 'add_products',
			'name'				=> 'add_products',
			'data-placeholder' 	=> __( 'Search product...', 'yith-woocommerce-added-to-cart-popup' ),
			'data-multiple'		=> true,
			'data-action'		=> 'yith_wacp_search_products',
		) );
		?>
		<input type="submit" value="<?php _e( 'Exclude', 'yith-woocommerce-added-to-cart-popup' ); ?>" id="add" class="button" name="add">
	</form>

	<?php $table->display(); ?>

</div>