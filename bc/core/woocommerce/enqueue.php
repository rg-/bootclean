<?php

function WPBC_woocommerce_enqueue_scripts(){

	$uri = get_template_directory_uri().'/bc/core/woocommerce/assets/css/wpbc-woocommerce.css';
	$uri = apply_filters('wpbc/filter/enqueue/woocommerce/css',$uri);
	wp_register_style( 'wpbc-woocommerce', $uri, array(), '1');
	wp_enqueue_style( 'wpbc-woocommerce' );  

}

add_action( 'wp_enqueue_scripts', 'WPBC_woocommerce_enqueue_scripts' );