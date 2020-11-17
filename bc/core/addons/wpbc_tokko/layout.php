<?php 

/*

	Single Property 

*/ 

/* 
	@hooked 'wpbc/layout/start' 
*/ 

function tokko_get_property_single(){ 
	WPBC_get_template_part('wpbc_tokko/property-single'); 
} 

function tokko_get_development_single(){ 
	WPBC_get_template_part('wpbc_tokko/development-single'); 
} 



/* 
	@hooked 'wpbc/layout/end' 
*/ 
add_action('wpbc/layout/body/end', 'tokko_get_property_single_modals', 41);
function tokko_get_property_single_modals(){ 
	WPBC_get_template_part('wpbc_tokko/property-single/modals');
}

/*
	
	@hooked 'tokko/property-single/content'

		'WPBC_tokko_property_single_header' 10
		'WPBC_tokko_property_single_content' 20

*/

	add_action('tokko/property-single/content', 'WPBC_tokko_property_single_header',10,1);
	function WPBC_tokko_property_single_header($property){
		WPBC_get_template_part('wpbc_tokko/property-single/header', $property);
	}

		/*
		
		images
		features
		basic-info
		surfaces
		description
		services
		rooms
		aditionals

		*/
		add_action('tokko/property-single/content/col', 'WPBC_tokko_property_single_content_col_images',10,1);
			function WPBC_tokko_property_single_content_col_images($property){
				WPBC_get_template_part('wpbc_tokko/property-single/images', $property);
			}
		add_action('tokko/property-single/content/col', 'WPBC_tokko_property_single_content_col_features',20,1);
			function WPBC_tokko_property_single_content_col_features($property){
				WPBC_get_template_part('wpbc_tokko/property-single/features', $property);
			}
		add_action('tokko/property-single/content/col', 'WPBC_tokko_property_single_content_col_basicinfo',30,1);
			function WPBC_tokko_property_single_content_col_basicinfo($property){
				WPBC_get_template_part('wpbc_tokko/property-single/basic-info', $property);
			}
		add_action('tokko/property-single/content/col', 'WPBC_tokko_property_single_content_col_surfaces',40,1);
			function WPBC_tokko_property_single_content_col_surfaces($property){
				WPBC_get_template_part('wpbc_tokko/property-single/surfaces', $property);
			}
		add_action('tokko/property-single/content/col', 'WPBC_tokko_property_single_content_col_description',50,1);
			function WPBC_tokko_property_single_content_col_description($property){
				WPBC_get_template_part('wpbc_tokko/property-single/description', $property);
			}
		add_action('tokko/property-single/content/col', 'WPBC_tokko_property_single_content_col_services',60,1);
			function WPBC_tokko_property_single_content_col_services($property){
				WPBC_get_template_part('wpbc_tokko/property-single/services', $property);
			}
		add_action('tokko/property-single/content/col', 'WPBC_tokko_property_single_content_col_rooms',70,1);
			function WPBC_tokko_property_single_content_col_rooms($property){
				WPBC_get_template_part('wpbc_tokko/property-single/rooms', $property);
			}
		add_action('tokko/property-single/content/col', 'WPBC_tokko_property_single_content_col_aditionals',80,1);
			function WPBC_tokko_property_single_content_col_aditionals($property){
				WPBC_get_template_part('wpbc_tokko/property-single/aditionals', $property);
			}

	add_action('tokko/property-single/content', 'WPBC_tokko_property_single_content',20,1);
	function WPBC_tokko_property_single_content($property){
		WPBC_get_template_part('wpbc_tokko/property-single/content', $property);
	}

		// tokko/property-single/content/aside

		add_action('tokko/property-single/content/aside', 'WPBC_tokko_property_single_content_prices',10,1);
			function WPBC_tokko_property_single_content_prices($property){
				WPBC_get_template_part('wpbc_tokko/property-single/prices', $property);
			}
		add_action('tokko/property-single/content/aside', 'WPBC_tokko_property_single_content_map',20,1);
			function WPBC_tokko_property_single_content_map($property){
				WPBC_get_template_part('wpbc_tokko/property-single/map', $property);
			}
/*
	
	@hooked 'tokko/development-single/content'

		'WPBC_tokko_development_single_header' 10
		'WPBC_tokko_development_single_content' 20

*/

	add_action('tokko/development-single/content', 'WPBC_tokko_development_single_header',10,1);
	function WPBC_tokko_development_single_header($property){
		WPBC_get_template_part('wpbc_tokko/development-single/header', $property);
	}   

		add_action('tokko/development-single/content/col', 'WPBC_tokko_property_single_content_col_images',10,1);
		add_action('tokko/development-single/content/col', 'WPBC_tokko_property_single_content_col_basicinfo',20,1);
		add_action('tokko/development-single/content/col', 'WPBC_tokko_property_single_content_col_description',30,1);

	add_action('tokko/development-single/content', 'WPBC_tokko_development_single_content',20,1);
	function WPBC_tokko_development_single_content($property){
		WPBC_get_template_part('wpbc_tokko/development-single/content', $property);
	}
		add_action('tokko/development-single/content/aside', 'WPBC_tokko_property_single_content_map',10,1);
			 

/*

	Properties results (loop)

	@hooked 'tokko/get_properties/before'

		'tokko_get_properties_result_detail' 10
	
	@hooked 'tokko/get_properties/after'

		'tokko_get_properties_pagination' 10
		'tokko_get_properties_result_detail' 20

*/

//add_action('tokko/get_properties/before', 'tokko_get_properties_result_detail', 10, 4);
add_action('tokko/get_properties/after', 'tokko_get_properties_pagination', 10, 4);
add_action('tokko/get_properties/after', 'tokko_get_properties_result_detail', 20, 4);

function tokko_get_properties_pagination($search, $use_query_vars, $pagination, $result_detail){
	if($pagination){
		WPBC_get_template_part('wpbc_tokko/properties/pagination', array(
			'search' => $search, 
			'use_query_vars' => $use_query_vars,
		));
	}
}

function tokko_get_properties_result_detail($search, $use_query_vars, $pagination, $result_detail){
	if($result_detail){
		WPBC_get_template_part('wpbc_tokko/properties/result_detail', array(
			'search' => $search, 
			'use_query_vars' => $use_query_vars,
		));
	}
} 