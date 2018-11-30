<?php

/*
 * 
 *	WPBC_enqueue_scripts__head_scripts 
 *
*/ 

/*
	// Example
	add_filter('WPBC_enqueue_scripts__head_scripts', function($styles){

		$styles['xxxx'] = array( 
			'src'=>'css/xxx.css'
		);

		return $styles;

	});
*/

		
// sripts on head-styles
$h_scripts = array(

	'html5shiv'=>	array( 
		'src'=>'js/html5shiv/html5shiv.min.js',
		'conditional'=>'lt IE 9'
	),
	'respond'=>	array( 
		'src'=>'js/respond/respond.min.js',
		'conditional'=>'lt IE 9'
	)

);

if(isset($h_scripts)){ 
	foreach($h_scripts as $k=>$v){ 
		if(isset($v['conditional'])){
			wp_enqueue_script( $k, THEME_URI . '/'.$v['src'].'');
			wp_script_add_data( $k, 'conditional', $v['conditional']);
		}else{
			wp_register_script( ''.$k.'', THEME_URI . '/'.$v['src'].'', array(), __scripts_version(), false );
			wp_enqueue_script( ''.$k.'' );
		} 
	} 
}  