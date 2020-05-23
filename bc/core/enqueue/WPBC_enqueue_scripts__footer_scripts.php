<?php

/*
 * 
 *	WPBC_enqueue_scripts__footer_scripts 
 *
*/  

		
$scripts = array( 
	'jquery'=>	array( 
		'src'=> THEME_URI .'/js/jquery.min.3.1.1.js',
		'dependence' => array()
	),
	
	'bootstrap'=>	array( 
		'src'=> THEME_URI .'/js/bootstrap.bundle.min.js',
		'dependence' => array('jquery')
	),
	
	'main'=>	array( 
		'src'=> THEME_URI .'/js/main.js',
		'dependence' => array('bootstrap')
	)
	
	//'custom'=>	array( 
			//'src'=>'js/custom.js'
	//)
	
); 
$scripts = apply_filters('WPBC_enqueue_scripts__footer_scripts', $scripts); 
if(isset($scripts)){ 
	foreach($scripts as $k=>$v){ 
		$dependence = !empty($v['dependence']) ? $v['dependence'] : array();
		wp_register_script( ''.$k.'',  $v['src'], $dependence, __scripts_version(), true );
		wp_enqueue_script( ''.$k.'' );
	} 
}   