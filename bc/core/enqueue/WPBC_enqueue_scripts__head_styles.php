<?php

/*
 * 
 *	WPBC_enqueue_scripts__head_styles 
 *
*/ 

/*
	// Example
	add_filter('WPBC_enqueue_scripts__head_styles.php', function($styles){

		$styles['xxxx'] = array( 
			'src'=>'css/xxx.css'
		);

		return $styles;

	});
*/

$styles = array(
	
	'main'=>	array( 
		'src'=>'css/main.css'
	), 
	
	'addons'=>	array( 
		'src'=>'css/addons.css'
	), 
	
	'custom'=>	array( 
		'src'=>'css/custom.css'
	)

);

$styles = apply_filters('WPBC_enqueue_scripts__head_styles', $styles);

if(!is_child_theme()){ 
	$styles_uri = THEME_URI;
}else{
	$styles_uri = CHILD_THEME_URI;
}
$styles_uri = apply_filters('BC_enqueue_scripts__styles_uri', $styles_uri); 
if(isset($styles)){ 
	foreach($styles as $k=>$v){
		wp_register_style( ''.$k.'', $styles_uri . '/'.$v['src'].'', array(), __scripts_version() ); 
		wp_enqueue_style( ''.$k.'' ); 
	} 
}  