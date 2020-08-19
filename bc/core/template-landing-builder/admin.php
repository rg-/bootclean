<?php

/*

	Exclude gutenberg from landing template

*/

add_filter('wpbc/filter/gutenberg/excluded_templates', function ($excluded_templates){
	$excluded_templates[] = '_template_landing_builder.php'; 
	return $excluded_templates;
},10,1);

 
function WPBC_template_landing_remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true); 

        switch ($template) {
            case '_template_landing_builder.php': 
            remove_post_type_support('page', 'editor');
            break;
            default :
            // Don't remove any other template.
            break;
        }
    }
}
add_action('init', 'WPBC_template_landing_remove_editor');


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

	$exclude = apply_filters('wpbc/filter/template-landing/exclude_page_settings', 0);
	if(!$exclude){
		$locations[0][] = WPBC_template_landing_exclude_locations();
	}
	
	return $locations; 
},10,1);  

/* Disable Secondary Content on Landing Template */
add_filter('wpbc/filter/acf/builder/secondary_layout_locations', function($locations){ 
	$locations[0][] = WPBC_template_landing_exclude_locations();
	return $locations; 
},10,1);  