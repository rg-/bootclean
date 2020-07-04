<?php

/* 

	WPBC_woocommerce

	added jun 2020 

*/

// Add new constant that returns true if WooCommerce is active
define( 'WPBC_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) ); 

function WPBC_is_woocommerce_active(){
	if ( WPBC_WOOCOMMERCE_ACTIVE ) {
		return true;
	}else{
		return false;
	}
} 

/* Safe use Woo conditionals */ 

if ( WPBC_WOOCOMMERCE_ACTIVE ) {
		
		// Make theme compatible with Woocomerce
		add_action( 'after_setup_theme', function() {
			add_theme_support( 'woocommerce' );
		} );
		// $path defaults to 'woocommerce/' (in your theme folder)
		add_filter( 'woocommerce_template_path', function( $path ){
				$custom_path_parent = get_template_directory() . '/template-parts/woocommerce/';
		    $custom_path_child = get_stylesheet_directory() . '/template-parts/woocommerce/';
		    return ( file_exists( $custom_path_parent ) || file_exists( $custom_path_child ) ) ? 'template-parts/woocommerce/' : $path;
		}, 10);

		// Customizations disabled by default just in case need other customization
		$WPBC_woocommerce_customize = apply_filters('wpbc/filter/woocommerce/enable_customise',false);
		if(!empty($WPBC_woocommerce_customize)){
	    include('woocommerce/functions.php');
	    include('woocommerce/init.php'); 
	    include('woocommerce/acf.php'); 
	    include('woocommerce/enqueue.php'); 
	    include('woocommerce/layout.php'); 
	    include('woocommerce/layout-templates.php');
    } 
} 



/*
	
	// SEE
	// https://docs.woocommerce.com/document/conditional-tags/ 
	// https://www.businessbloomer.com/woocommerce-how-to-enable-catalog-mode/
	// https://wordpress.org/plugins/repeat-order-for-woocommerce/

	// favoritos usando WPBC addon ?
	
	// Shop Steps

		> choose something before shop that condition or print additional messages,
		or filter by categories, or by price, or by something
		the "catalogue" shop where you can add to cart x products

		>So, you can not add to cart in normal catalogue/shop, but yes once you 
	pass the step 1

*/