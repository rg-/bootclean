<?php

/*
 * 
 *	WPBC_enqueue_scripts__fonts 
 *
*/ 

/*
	// Example
	add_filter('BC_enqueue_scripts__fonts', function($fonts){

		$fonts['fontawesome-all'] = array( 
			'src'=>'css/fontawesome/all.min.css'
		);

		return $fonts;

	});
*/
	

$fonts = apply_filters('BC_enqueue_scripts__fonts', array()); 
$fonts_uri = apply_filters('BC_enqueue_scripts__fonts_uri', get_template_directory_uri() ); 
 
if(!empty($fonts)){ 
	foreach($fonts as $k=>$v){
		wp_register_style( ''.$k.'-font', $fonts_uri . '/'.$v['src'].'', array(), __scripts_version() );
		wp_enqueue_style( ''.$k.'-font' ); 
	} 
} 