<?php

/*
	Remove default content container action and insert custom one

	WPBC_layout_struture__main_pageheader - 20
	WPBC_layout_struture__main_container - 40

	Note the index number!!

*/

add_action('wpbc/layout/start',function(){
	
	if( is_page_template('_template_landing_builder.php') ){ 
		remove_action('wpbc/layout/start', 'WPBC_layout_struture__main_pageheader', 20);
		add_action('wpbc/layout/start', 'WPBC_template_landing__main_pageheader',20);
		remove_action('wpbc/layout/start', 'WPBC_layout_struture__main_container', 40); 

		add_action('wpbc/layout/start', 'WPBC_template_landing__main_container',40);  
	
	}

},1);

/*

	Add a custom location form template builder system

*/

add_filter('wpbc/filter/layout/locations', function($locations){ 
	$locations = array( 
		'_template_landing_builder' => array(
			'id' => 'a1',
			'options' => array(
				'label' => 'Template for Landing Pages',
				'description' => 'Defaults used if none of the rest conditions applys.'
			),
			'args' => array(
				'container_type' => 'none'
			)
		), 
	);
	return $locations;
},10,1); 

/* 

	Change default layout locations for landing template

*/

add_filter('wpbc/filter/layout/locations', function($locations){
	if( is_page_template('_template_landing_builder.php') ){
		$locations['home']['id'] = 'a1'; 
		$locations['page']['id'] = 'a1'; 
		$locations['single']['id'] = 'a1';
	} 
	return $locations;  
}, 20,1 );