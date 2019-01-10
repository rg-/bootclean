<?php

/*
	
	#############
	wpbc_resource
	#############

*/ 

add_action('init', 'wpbc_create_post_type_resource' ); 

function wpbc_create_post_type_resource(){

	$slug = 'wpbc_resource';
	$rewrite_slug = 'wpbc_resource';

	register_post_type( $slug,
		array(
			'labels' => array(
				'name' => __( 'Resources', 'bootclean' ),
				'singular_name' => __( 'Resource', 'bootclean' ),
				'edit_item' => __( 'Edit Resource', 'bootclean' ),
				'new_item' => __( 'New Resource', 'bootclean' ),
				'view_item' => __( 'View Resource', 'bootclean' ),
			),
		'public' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'supports' => array('title', 'excerpt' ),
		'menu_icon' => 'dashicons-admin-multisite',  // Icon Path
		
		/**/
		'rewrite' => array( 
			'slug' => $rewrite_slug,
			'with_front' => false
		), 
		
		//'rewrite' => false,
		)
	);

	register_taxonomy(
		'wpbc_resource_type',
		array( 'wpbc_resource' ),
		array(
			'label' => __('Resource Type','bootclean'),
			'labels' => array(
				'add_new_item' => __('Add Resource Type','bootclean'),
			),  
			
			'public' => true, 
			'hierarchical' => true,
			'sort' => true,
			'show_ui' => true,
		      'show_in_quick_edit' => true,
		      //'meta_box_cb' => 'post_categories_meta_box',
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'rewrite' => false, 
			'query_var' => false, 
			//'rewrite' => array( 'slug' => 'operation', 'with_front' => true ),
		)
	);

	register_taxonomy(
		'wpbc_resource_category',
		array( 'wpbc_resource' ),
		array(
			'label' => __('Resource Category','bootclean'),
			'labels' => array(
				'add_new_item' => __('Add Resource Category','bootclean'),
			),  
			
			'public' => true, 
			'hierarchical' => true,
			'sort' => true,
			'show_ui' => true,
		      'show_in_quick_edit' => true,
		      //'meta_box_cb' => 'post_categories_meta_box',
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'rewrite' => false, 
			'query_var' => false, 
			//'rewrite' => array( 'slug' => 'operation', 'with_front' => true ),
		)
	); 


	// Template part

	add_filter('wpbc/filter/layout/locations', function($locations){ 
		
		$post_type = get_post_type();

		if( $post_type  == 'wpbc_resource' ){ 
			$locations['single']['id'] = 'a1'; 
		}

		return $locations;

	},10,1);

}


// acf form
add_filter('wpbc/filter/acf/form/settings', function($settings, $post_type){
 
	if( $post_type  == 'wpbc_resource' ){ 
		$settings = array( 
			'post_title' => true, 
		);
	}
	return $settings;

}, 10, 2);

/*
	
	##############
	Some functions
	##############

*/

function WPBC_include_resource_part($template){
	
	$inc = false; 

	$file_uri = get_template_directory_uri().'/bc/core/addons/wpbc_resource/templates/'.$template;
	$file_path = get_template_directory().'/bc/core/addons/wpbc_resource/templates/'.$template;
	
	$child_file_uri = get_stylesheet_directory_uri().'/template-parts/wpbc_resource/'.$template;
	$child_file_path = get_stylesheet_directory().'/template-parts/wpbc_resource/'.$template; 
	
	if( file_exists( $child_file_path.'.php' ) ){
		$inc = $child_file_path.'.php'; 
	}else{
		if( file_exists( $file_path.'.php' ) ){
			$inc = $file_path.'.php'; 
		}
	}

	return $inc;

}

/*

	##########################
	'wpbc/filter/layout' Parts
	##########################

	<-

	apply_filters('wpbc/filter/layout/'.$main_key.'/content-area/shortcode/'.$name, $shortcode, $value);
	
		$main_key = layout name
		$name = conten area name

		See template-parts/layout/structure/ layouts files to better understand
		Each template name is the "main_key", each layout has one or more content areas,
		each content area has a name. That is. 

		The $value parameter will return an array, same array used on the layout previously described.

		The $shortcode param will return something like:

		[WPBC_get_template name="layout/main-content"/]

		You can filter that and return something else.

	->

*/
add_filter('wpbc/filter/layout/a1/content-area/shortcode/area-main',function($shortcode, $value){
	$post_type = get_post_type(); 
	if( $post_type  == 'wpbc_resource' && is_singular('wpbc_resource') ){  
		$inc = WPBC_include_resource_part('resource-single'); 
		if(!empty($inc)){
			ob_start();  
			include ($inc);
			$shortcode = ob_get_contents();
			ob_end_clean();  
		} 
	}

	return $shortcode;
},10,2);


function WPBC_get_resources_FX($atts, $content = null){
	$out = '';
	extract(shortcode_atts(array(  
		'taxonomy' => '',
		'meta' => '',
		'args' => '',
	), $atts));

	$query = array(
		'post_type' => 'wpbc_resource',
	);
	$query_posts = new WP_Query( $query ); 
	if( $query_posts->have_posts() ){
		while ( $query_posts->have_posts() ) {  
			$query_posts->the_post();  
			$inc = WPBC_include_resource_part('resource'); 
			if(!empty($inc)){
				include ($inc);
			} 
		}
		wp_reset_postdata();
	}
}
add_shortcode('WPBC_get_resources', 'WPBC_get_resources_FX');

function WPBC_resource_template__path($post_id){

	$wpbc_resource_github_file = WPBC_get_field('wpbc_resource_github_file');

	$icon = WPBC_get_svg_img('logo-github', array(
		'width'=>'18px',
		'height'=>'18px',
		'color'=>'black'
	));

	echo '<a href="'.$wpbc_resource_github_file.'" target="_blank">'.$icon.' '.$wpbc_resource_github_file.'</a>';
}

function WPBC_resource_template__terms($post_id){

	echo WPBC_get_the_terms(array(
			'taxonomy' => 'wpbc_resource_category',
			'post_id'=> $post_id,
			'before' => __('Category: ','bootclean'),
		));
	echo " | ";
	echo WPBC_get_the_terms(array(
			'taxonomy' => 'wpbc_resource_type',
			'post_id'=> $post_id,
			'before' => __('Type: ','bootclean'),
		)); 

}
 

/*
	
	########
	ACF part
	########

*/

if( function_exists('acf_add_local_field_group') ):

$group_wpbc_resource_metadata = array( 

	array (
		'key' => 'field_wpbc_resource_desc',
		'label' => __('Description','bootclean'),
		'name' => 'wpbc_resource_desc',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'html_code', // For codemirror
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'new_lines' => '',
	),

	array (
		'key' => 'field_wpbc_resource_code',
		'label' => __('Code','bootclean'),
		'name' => 'wpbc_resource_code',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'html_code', // For codemirror
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'new_lines' => '',
	), 

	array (
		'key' => 'field_wpbc_resource_github_file',
		'label' => 'Github File Path',
		'name' => 'wpbc_resource_github_file',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	),
	array (
		'key' => 'field_wpbc_resource_github_file_vars',
		'label' => 'Github File Path Vars',
		'name' => 'wpbc_resource_github_file_vars',
		'type' => 'text',
		'instructions' => 'Ej: slice=18:31',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	),

);

acf_add_local_field_group(array(
	'key' => 'group_wpbc_resource_metadata',
	'title' => __('Resource Metadata','bootclean'),
	'fields' => $group_wpbc_resource_metadata,
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'wpbc_resource',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;