<?php

/*

	bootclean
	> woocommerce
		> init

*/


// Remove all Woo Styles
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/* or specific */
add_filter( 'woocommerce_enqueue_styles', 'wpex_remove_woo_styles' );
function wpex_remove_woo_styles( $styles ) {
	// unset( $styles['woocommerce-general'] );
	// unset( $styles['woocommerce-layout'] );
	// unset( $styles['woocommerce-smallscreen'] );
	return $styles;
}

/*
	Enable WooCommerce Product Gallery, Zoom & Lightbox (v3.0+)
*/

//add_theme_support( 'wc-product-gallery-slider' );
//add_theme_support( 'wc-product-gallery-zoom' );
//add_theme_support( 'wc-product-gallery-lightbox' ); 



/** 
 * Redirect to shop after login. 
 * 
 * @param $redirect 
 * @param $user 
 * 
 * @return false|string 
 */ 

function WPBC_woocommerce_login_redirect( $redirect, $user ) { 
    $redirect_page_id = url_to_postid( $redirect ); 
    $checkout_page_id = wc_get_page_id( 'checkout' ); 
    if( $redirect_page_id == $checkout_page_id ) { 
        $login_redirect = $redirect; 
    }else{
    	//$login_redirect = wc_get_page_permalink( 'shop' ); 
    	$login_redirect = $redirect;
    }
    return apply_filters('WPBC/filter/woocommerce/login_redirect', $login_redirect);
} 
add_filter( 'woocommerce_login_redirect', 'WPBC_woocommerce_login_redirect',10,2 );