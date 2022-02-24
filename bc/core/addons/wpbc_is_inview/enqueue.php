<?php


add_action( 'wp_enqueue_scripts', 'WPBC_is_inview_enqueue_scripts', 0 );

function WPBC_is_inview_enqueue_scripts(){


	wp_register_style( 'wpbc-is-inview-css', THEME_URI . '/bc/core/addons/wpbc_is_inview/assets/is-inview.css', array(), __scripts_version() ); 
		wp_enqueue_style( 'wpbc-is-inview-css' ); 

	wp_register_script( 'wpbc-is-inview-js', THEME_URI .'/bc/core/addons/wpbc_is_inview/assets/is-inview.js', array('jquery'), __scripts_version(), true);
		wp_enqueue_script( 'wpbc-is-inview-js' );

	//wp_register_script( 'wpbc-is-inview-js-lzsrc', THEME_URI .'/bc/core/addons/wpbc_is_inview/assets/is-inview-lazysrc.js', array('wpbc-is-inview-js'), __scripts_version(), true);
		//wp_enqueue_script( 'wpbc-is-inview-js-lzsrc' );

	//wp_register_script( 'wpbc-is-inview-js-lzbg', THEME_URI .'/bc/core/addons/wpbc_is_inview/assets/is-inview-lazybackground.js', array('wpbc-is-inview-js'), __scripts_version(), true);
		//wp_enqueue_script( 'wpbc-is-inview-js-lzbg' ); 

	if( true == apply_filters('wpbc/filter/is_inview/init', 0) ){

		// $('[data-is-inview]').is_inview(); 
		wp_register_script( 'wpbc-is-inview-init-js', THEME_URI .'/bc/core/addons/wpbc_is_inview/assets/is-inview-init.js', array('jquery','wpbc-is-inview-js'), __scripts_version(), true);
			wp_enqueue_script( 'wpbc-is-inview-init-js' );
	}

}