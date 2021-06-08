<?php 


function WPBC_group_builder__layout($fields = array()){  
	return apply_filters('WPBC_group_builder__layout', $fields);
}  



/*

	Add choices into select for wpbc_template post type
	
	So, convert all those select fields (by name) into
	post type "wpbc_template" post filter.

*/
add_filter('acf/load_field', 'field_layout_header_template__load_defaults');

function field_layout_header_template__load_defaults($field){ 

	$check = array(
		'layout_header_template_posts_page',
		'layout_header_template_category',
		'layout_header_template_tag',
		'layout_header_template_archive',

		'layout_main_navbar_template',
		'layout_header_template',
		'layout_footer_template',
	);
	if( $field['type'] == 'select' && in_array($field["name"], $check)){

		$field['choices'] = array(); 
		$field['choices']['none'] = 'None'; 
		$query = new WP_Query(array(
		    'post_type' => 'wpbc_template',
		    'post_status' => 'publish',
		    'posts_per_page' => -1,
		));  
		while ($query->have_posts()) {
		    $query->the_post();
		    $post_id = get_the_ID();
		    $field['choices'][$post_id] = get_the_title(); 
		} 
		wp_reset_query(); 

	}

	
	return $field;
}