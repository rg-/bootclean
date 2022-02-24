<?php

function WPBC_woocommerce_enqueue_scripts(){

	$uri = get_template_directory_uri().'/bc/core/woocommerce/assets/css/wpbc-woocommerce.css';
	$uri = apply_filters('wpbc/filter/enqueue/woocommerce/css',$uri);
	
	// Not used
	//wp_register_style( 'wpbc-woocommerce', $uri, array(), '1');
	//wp_enqueue_style( 'wpbc-woocommerce' );  


	$js_uri = get_template_directory_uri().'/bc/core/woocommerce/assets/js/wpbc-woocommerce.js';
	$js_uri = apply_filters('wpbc/filter/enqueue/woocommerce/js',$js_uri);
	wp_register_script( 'wpbc-woocommerce-js',  $js_uri, array('bootstrap'), __scripts_version(), true );
	wp_enqueue_script( 'wpbc-woocommerce-js' );
}

add_action( 'wp_enqueue_scripts', 'WPBC_woocommerce_enqueue_scripts' );