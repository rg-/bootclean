<?php

/*

	WPBC_version_compare

*/

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) { 
	require BC_WP_DIR . '/core/back-compat.php';
}


if ( ! function_exists( 'is_plugin_active_for_network' ) || ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

function WPBC_is_acf(){
	if( function_exists('get_field') ){
		return true;
	}else{
		return false;
	}
} 

//add_action( 'admin_init', function(){
	
	add_action( 'admin_notices', function (){
		
		$acf_version = get_option('acf_version'); 
		 
		if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) { 
		
			if ( version_compare( $acf_version, '5', '<' ) ) { 
				$message = sprintf( __( 'Bootclean requires at least ACF version 5. You are running version %s. Please upgrade and try again.', 'bootclean' ), $acf_version );
				$class = 'error';
				printf( '<div class="'.$class.'"><p>%s</p></div>', $message );
			}
			
		}else{ 
	 
			if ( ! get_option('WPBC_dismissed-acf_warning', FALSE ) ) { 
			
			?>
			<div class="notice notice-warning is-dismissible" data-option="WPBC_dismissed-acf_warning" data-option-update="1" data-option-hide-notice="1">
			<p><?php _e( '<b>Bootclean</b> uses ACF for better customization experience, without it you will loose many extra features.', 'bootclean'); ?></p>
			</div>
			<?php
			
			} 
			
		}
		
	} );  
	
//},999); 