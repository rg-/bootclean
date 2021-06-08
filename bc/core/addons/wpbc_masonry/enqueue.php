<?php

function WPBC_get_masonry_settings(){

	$settings = array(

		'enqueue_custom_js' => true,

		'MasonryParams' => array(
			'itemSelector' => '.wpbc-masonry-item',
		  'columnWidth' => '.wpbc-masonry-sizer',
		  'gutter' => 0, 
		),

	);

	return apply_filters('wpbc/filter/masonry/settings', $settings);

}

add_action( 'wp_enqueue_scripts', 'WPBC_masonry_enqueue_scripts', 0 );

function WPBC_masonry_enqueue_scripts(){  

	wp_register_script( 'wpbc-masonry-js', THEME_URI .'/bc/core/addons/wpbc_masonry/assets/masonry.pkgd.min.js', array(), __scripts_version(), true);
		wp_enqueue_script( 'wpbc-masonry-js' );

	wp_register_script( 'wpbc-multipleFilterMasonry-js', THEME_URI .'/bc/core/addons/wpbc_masonry/assets/multipleFilterMasonry.js', array(), __scripts_version(), true);
		wp_enqueue_script( 'wpbc-multipleFilterMasonry-js' );


	$settings = WPBC_get_masonry_settings();

	if( $settings['enqueue_custom_js'] ){

		wp_register_script( 'wpbc-masonry-custom-js', THEME_URI .'/bc/core/addons/wpbc_masonry/assets/masonry-custom.js', array('wpbc-masonry-js'), __scripts_version(), true);
			wp_enqueue_script( 'wpbc-masonry-custom-js' );

		wp_localize_script( 'wpbc-masonry-custom-js', 'wpbc_masonry_custom_object',
	        array( 
	            'MasonryParams' => $settings['MasonryParams']
	        )
	    );

	}

}