<?php

/*
 * Bootclean Woocommerce
 * Custom functions and shortcodes
 *
*/


/*****************************
 * WooCommerce Cart Contents *
 */

/*
 * Function for WooCommerce Cart Contents as Nav link
 */
function WPBC_woo_cart_btn_link(){
	$cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
  $cart_url = wc_get_cart_url();  // Set Cart URL 
  ?>
<a class="cart-contents nav-link" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart', 'woocommerce' ); ?>"><?php _e( 'Cart', 'woocommerce' ); ?> 
<?php if ( $cart_count > 0 ) { ?>
    <span class="cart-contents-count badge badge-primary"><?php echo $cart_count; ?></span>
<?php }else{ ?>
<span class="cart-contents-count badge badge-primary empty"><?php echo $cart_count; ?></span>
<?php } ?>
</a>
  <?php
}

/**
* Create Shortcode for WooCommerce Cart Menu Item
	[WPBC_woo_cart_btn]
*/
add_shortcode ('WPBC_woo_cart_btn', 'WPBC_woo_cart_btn_FX' ); 
function WPBC_woo_cart_btn_FX() {
	ob_start(); ?><li><?php WPBC_woo_cart_btn_link(); ?></li><?php 
  return ob_get_clean(); 
}

/**
 * Add AJAX Shortcode when cart contents update
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'WPBC_woo_cart_btn__ajax' ); 
function WPBC_woo_cart_btn__ajax( $fragments ) { 
    ob_start();
    WPBC_woo_cart_btn_link();
    $fragments['a.cart-contents'] = ob_get_clean(); 	
    return $fragments;
}

/*
 * WooCommerce Cart Contents *
 *****************************/