<?php

/*

	Exclude gutenberg from landing template

*/

add_filter('wpbc/filter/gutenberg/excluded_templates', function ($excluded_templates){
	$excluded_templates[] = '_template_landing_builder.php'; 
	return $excluded_templates;
},10,1);


/*

	Exclude _template_landing from builder locations

*/

function WPBC_template_landing_exclude_locations(){
	$location = array(
		'param' => 'page_template',
		'operator' => '!=',
		'value' => '_template_landing_builder.php',
	);
	return $location;
}
/* Disable Page Settings on Landing Template */
add_filter('wpbc/filter/acf/builder/layout_locations', function($locations){  
	$locations[0][] = WPBC_template_landing_exclude_locations();
	return $locations; 
},10,1);  

/* Disable Secondary Content on Landing Template */
add_filter('wpbc/filter/acf/builder/secondary_layout_locations', function($locations){ 
	$locations[0][] = WPBC_template_landing_exclude_locations();
	return $locations; 
},10,1);  