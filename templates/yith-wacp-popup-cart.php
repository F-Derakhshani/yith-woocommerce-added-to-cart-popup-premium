<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
/**
 * Popup cart template
 *
 * @version 1.2.1
 */

/**
 * @type $_product WC_Product
 */

// get cart info
$cart_info = yith_wacp_get_cart_info();
?>

<h3 class="cart-list-title"><?php echo apply_filters( 'yith_wacp_cart_popup_title', __( 'Your Cart', 'yith-woocommerce-added-to-cart-popup' ) ); ?></h3>

<table class="cart-list">
	<tbody>
	<?php foreach( WC()->cart->get_cart() as $item_key => $item ) : $_product = $item['data']; ?>
	<tr class="single-cart-item">

		<td class="item-remove">
			<a href="<?php echo esc_url( WC()->cart->get_remove_url( $item_key ) ) ?>" class="yith-wacp-remove-cart" title="<?php _e( 'Remove item', 'yith-woocommerce-added-to-cart-popup' ) ?>"
			   data-item_key="<?php echo $item_key ?>">X</a>
		</td>

		<?php if( $thumb ) : ?>
		<td class="item-thumb">
			<?php
			$thumbnail = $_product->get_image( 'shop_thumbnail' );

			if ( ! $_product->is_visible() ) {
				echo $thumbnail;
			} 
			else {
				printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink() ), $thumbnail );
			}
			?>
		</td>
		<?php endif; ?>

		<td class="item-info">
			<?php

            $_product_name = is_callable( array( $_product, 'get_name' ) ) ? $_product->get_name() : $_product->get_title();

			if ( $_product->is_visible() ) {
				echo '<a class="item-name" href="' . esc_url( $_product->get_permalink() ) . '">' . $_product_name . '</a>';
			}
			else {
				echo '<span class="item-name">' . $_product_name . '</span>';
			}

			echo '<span class="item-price">' . $item['quantity'] . ' x ' . WC()->cart->get_product_price( $_product ) . '</span>';

			// Meta data
			echo WC()->cart->get_item_data( $item );

			?>
		</td>

	</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php if( ( $cart_shipping || $cart_total || $cart_tax ) ) : ?>

<div class="cart-info">
	<?php if( $cart_shipping && isset( $cart_info['shipping'] ) ) :	?>
		<div class="cart-shipping">
			<?php echo __( 'Shipping Cost', 'yith-woocommerce-added-to-cart-popup' ) . ':' ?>
			<span class="shipping-cost">
					<?php echo $cart_info['shipping']; ?>
				</span>
		</div>
	<?php endif; ?>

	<?php if( $cart_tax && isset( $cart_info['tax'] ) ) :	?>
		<div class="cart-tax">
			<?php echo __( 'Tax Amount', 'yith-woocommerce-added-to-cart-popup' ) . ':' ?>
			<span class="tax-cost">
					<?php echo $cart_info['tax']; ?>
				</span>
		</div>
	<?php endif; ?>

	<?php if( $cart_total && isset( $cart_info['total'] ) ) : ?>
		<div class="cart-totals">
			<?php echo __( 'Cart Total', 'yith-woocommerce-added-to-cart-popup' ) . ':' ?>
			<span class="cart-cost">
					<?php echo $cart_info['total']; ?>
				</span>
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>