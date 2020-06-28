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


		// Customizations disabled by default just in case need other customization
		$WPBC_woocommerce_customize = apply_filters('wpbc/filter/woocommerce/enable_customise',false);
		if(!empty($WPBC_woocommerce_customize)){
	    include('woocommerce/init.php'); 
	    include('woocommerce/enqueue.php'); 
	    include('woocommerce/layout.php'); 
	    include('woocommerce/layout-templates.php');
    } 
}