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
function WPBC_woo_cart_btn_link($args=array()){
	$cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
  $cart_url = wc_get_cart_url();  // Set Cart URL 

  $args = array(
    'class' => 'nav-link',
    'label' => __( 'Cart', 'woocommerce' ),
    'href' => $cart_url,
    'title' => __( 'View your shopping cart', 'woocommerce' ),
    'count_class' => 'badge badge-primary',
    'count_empty_class' => 'badge badge-primary',
    'atts' => ''
  );

  $args = apply_filters('wpbc/filter/woocommerce/cart_btn_link',$args);

  ?>
<a class="cart-contents <?php echo $args['class']; ?>" <?php echo $args['atts']; ?> href="<?php echo $args['href']; ?>" title="<?php echo $args['title']; ?>"><?php echo $args['label']; ?> 
<?php if ( $cart_count > 0 ) { ?>
    <span class="cart-contents-count <?php echo $args['count_class']; ?>"><?php echo $cart_count; ?></span>
<?php }else{ ?>
    <span class="cart-contents-count <?php echo $args['count_empty_class']; ?> empty"><?php echo $cart_count; ?></span>
<?php } ?>
</a>
  <?php
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

/**
* Create Shortcode for WooCommerce Cart Menu Item
  [WPBC_woo_cart_btn]
*/
add_shortcode ('WPBC_woo_cart_btn', 'WPBC_woo_cart_btn_FX' ); 
function WPBC_woo_cart_btn_FX() {
  ob_start();
  WPBC_woo_cart_btn_link();
  return ob_get_clean(); 
}

/**
* Create Shortcode for WC_Widget_Cart
  Will output the WPBC_woo_mini_cart widget
  [WPBC_woo_mini_cart]
*/
add_shortcode ('WPBC_woo_mini_cart', 'WPBC_woo_mini_cart_FX' ); 
function WPBC_woo_mini_cart_FX() { 
  $widget = 'WC_Widget_Cart';
  $instance = array(
    //'title' => '',
  );
  $args = array();
  ob_start(); 
  the_widget($widget, $instance, $args);
  return ob_get_clean(); 
}


add_shortcode ('WPBC_woo_myaccount_btn', 'WPBC_woo_myaccount_btn_FX' ); 
function WPBC_woo_myaccount_btn_FX( $atts, $content = null ) {  
  $args = shortcode_atts(array(
  ), $atts); 
  /**/
  ob_start(); 
  WPBC_get_template_part('shortcodes/woocommerce/WPBC_woo_myaccount_btn', array( 
    'params' => $args, 
  )); 
  return ob_get_clean();  
}


add_shortcode ('WPBC_woo_products', 'WPBC_woo_products_FX' ); 
function WPBC_woo_products_FX( $atts, $content = null ) {  
  $args = shortcode_atts(array( 
    'posts_per_page' => 3,
  ), $atts); 
  /**/
  ob_start(); 
  WPBC_get_template_part('shortcodes/woocommerce/WPBC_woo_products', array( 
    'params' => $args, 
  )); 
  return ob_get_clean();  
}


add_shortcode ('WPBC_woo_products_slider', 'WPBC_woo_products_slider_FX' ); 
function WPBC_woo_products_slider_FX( $atts, $content = null ) {  
  $args = shortcode_atts(array( 
    'posts_per_page' => 12,
  ), $atts); 
  /**/
  ob_start(); 
  WPBC_get_template_part('shortcodes/woocommerce/WPBC_woo_products_slider', array( 
    'params' => $args, 
  )); 
  return ob_get_clean(); 
  
}

add_shortcode ('WPBC_woo_product_page_header', 'WPBC_woo_product_page_header_FX' ); 
function WPBC_woo_product_page_header_FX( $atts, $content = null ) {   
  $defs    = array( 
    'type' => 'none', 
  ); 
  $args = array_merge($defs, $atts);
  /**/
  ob_start(); 
  WPBC_get_template_part('shortcodes/woocommerce/WPBC_woo_product_page_header', array( 
    'params' => $args, 
  )); 
  return ob_get_clean();  
}