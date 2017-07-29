<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>

<div class="popup-actions">
	<?php if( $cart ) : ?>
		<a class="<?php echo apply_filters( 'yith_wacp_go_cart_class', 'button go-cart' ) ?>" href="<?php echo $cart_url; ?>"><?php echo get_option( 'yith-wacp-text-go-cart', '' ) ?></a>
	<?php endif ?>
	<?php if( $checkout ) : ?>
		<a class="<?php echo apply_filters( 'yith_wacp_go_checkout_class', 'button go-checkout' ) ?>" href="<?php echo $checkout_url; ?>"><?php echo get_option( 'yith-wacp-text-go-checkout', '' ) ?></a>
	<?php endif ?>
	<?php if( $continue ) : ?>
		<a class="<?php echo apply_filters( 'yith_wacp_continue_shopping_class', 'button continue-shopping' ) ?>" href="<?php echo $continue_shopping_url ?>"><?php echo get_option( 'yith-wacp-text-continue-shopping', '' ) ?></a>
	<?php endif; ?>
</div>