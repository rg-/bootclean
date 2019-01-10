<?php

/*
 * 
 *	WPBC_enqueue_scripts__footer_scripts 
 *
*/ 

/*
	// Example
	add_filter('WPBC_enqueue_scripts__footer_scripts', function($styles){

		$styles['xxxx'] = array( 
			'src'=>'css/xxx.css'
		);

		return $styles;

	});
*/

		
$scripts = array( 
	'jquery'=>	array( 
		'src'=>'js/jquery.min.3.1.1.js',
		'dependence' => array()
	),
	
	'bootstrap'=>	array( 
		'src'=>'js/bootstrap.min.js',
		'dependence' => array('jquery')
	),
	
	'main'=>	array( 
		'src'=>'js/main.js',
		'dependence' => array('bootstrap')
	)
	
	//'custom'=>	array( 
			//'src'=>'js/custom.js'
	//)
	
); 
if(isset($scripts)){ 
	foreach($scripts as $k=>$v){ 
		wp_register_script( ''.$k.'', THEME_URI . '/'.$v['src'].'', $v['dependence'], __scripts_version(), true );
		wp_enqueue_script( ''.$k.'' );
	} 
}   