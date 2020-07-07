<?php 


// -------------------------------------------------------------------------- //
if( function_exists('acf_add_local_field_group') ){ 
	
	/*
	
		#Page Settings group | For all pages/post... etc, will hold the main configuration for that post
		
		Need no main nav? Here is the area
		Need custom footer? Here
		Need custom pageheader/slider? here
		Need custom widget areas? here....
		
		Got the idea right?
		
	*/   

	$WPBC_group_builder__layout_posts_page = WPBC_group_builder__layout_posts_page(); 
	$WPBC_group_builder__layout_posts_page_locations = array( 
		array(
			array(
				'param' => 'page_type',
				'operator' => '==',
				'value' => 'posts_page',
			), 
		),
	); 

	acf_add_local_field_group(array( 
		'key' => 'group_builder__layout_posts_page',
		'title' => 'Posts & Archive Layout Settings',
		'fields' => $WPBC_group_builder__layout_posts_page,
		'location' => $WPBC_group_builder__layout_posts_page_locations,
		'menu_order' => 2,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => ( !empty( $WPBC_group_builder__layout_posts_page ) ? 1 : 0 ),
		'description' => '',
	)); 

	$WPBC_group_builder__layout = WPBC_group_builder__layout(); 
	$WPBC_group_builder__layout_locations = array( 
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				), 
			),
	); 
	$WPBC_group_builder__layout_locations = apply_filters('wpbc/filter/acf/builder/layout_locations',$WPBC_group_builder__layout_locations);
	
	acf_add_local_field_group(array(
		'key' => 'group_builder__layout',
		'title' => 'Page Settings',
		'fields' => $WPBC_group_builder__layout,
		'location' => $WPBC_group_builder__layout_locations,
		'menu_order' => 1,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => ( !empty( $WPBC_group_builder__layout ) ? 1 : 0 ),
		'description' => '',
	)); 
	
	// #Page Settings group <<<
}
// -------------------------------------------------------------------------- // 