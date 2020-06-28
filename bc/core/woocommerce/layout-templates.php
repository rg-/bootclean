<?php

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

/**
 * Filter woocommerce_loop_add_to_cart_link
 */
add_filter( 'woocommerce_loop_add_to_cart_link', function($link, $product, $args){ 
	return $link;
},10, 3);




/*

	Add WooCommerce Cart Icon to Menu with Cart Item Count

*/
/**
* Create Shortcode for WooCommerce Cart Menu Item
*/
add_shortcode ('WPBC_woo_cart_btn', 'WPBC_woo_cart_btn_FX' ); 
function WPBC_woo_cart_btn_FX() {
	ob_start(); 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL 
        ?>
        <li><a class="cart-contents nav-link" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart', 'bootclean' ); ?>"><?php _e( 'Cart', 'bootclean' ); ?> 
	    	<?php if ( $cart_count > 0 ) { ?>
            <span class="cart-contents-count badge badge-primary"><?php echo $cart_count; ?></span>
        <?php }else{ ?>
		    <span class="cart-contents-count badge badge-primary empty"><?php echo $cart_count; ?></span>
		    <?php } ?>
        </a></li>
        <?php 
    return ob_get_clean(); 
}

/**
 * Add AJAX Shortcode when cart contents update
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'WPBC_woo_cart_btn__ajax' ); 
function WPBC_woo_cart_btn__ajax( $fragments ) { 
    ob_start(); 
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url(); 
    ?>
    <a class="cart-contents nav-link" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart', 'bootclean' ); ?>"><?php _e( 'Cart', 'bootclean' ); ?> 
		<?php if ( $cart_count > 0 ) { ?>
    <span class="cart-contents-count badge badge-primary"><?php echo $cart_count; ?></span>
    <?php }else{ ?>
    <span class="cart-contents-count badge badge-primary empty"><?php echo $cart_count; ?></span>
    <?php } ?>
  	</a>
    <?php 
    $fragments['a.cart-contents'] = ob_get_clean(); 	
    return $fragments;
}

/**
 * Add WooCommerce Cart Menu Item Shortcode to particular menu
 */  
add_filter('wp_nav_menu_items', 'WPBC_woo_cart_btn__nav', 10, 2);
function WPBC_woo_cart_btn__nav($items, $args){
    if( $args->theme_location == 'primary' ){
        $items .=  '[WPBC_woo_cart_btn]';
    }
    return $items;
}