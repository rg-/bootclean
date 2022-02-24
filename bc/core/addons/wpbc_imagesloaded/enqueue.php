<?php


add_action( 'wp_enqueue_scripts', 'WPBC_imagesloaded_enqueue_scripts', 0 );

function WPBC_imagesloaded_enqueue_scripts(){ 

	wp_register_script( 'wpbc-imagesloaded-js', THEME_URI .'/bc/core/addons/wpbc_imagesloaded/assets/imagesloaded.pkgd.min.js', array('jquery'), __scripts_version(), true);
		wp_enqueue_script( 'wpbc-imagesloaded-js' ); 

}


if( true == apply_filters('wpbc/filter/is_inview/init', 0) ){
 

}