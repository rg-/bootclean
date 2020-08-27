<?php

/*
	
	TODOING....

	- meta on pages, cats, so on to make some private or not depending on... 

*/


/* ACF part */ 
 
function WPBC_group_builder__layout__private_areas($fields){ 
	 

	// WPBC_private_areas__type()

	if( WPBC_private_areas__type() == 1 ){ // future versions could have more types, currenty just 1

		$select_field = array (
			'key' => 'field_layout_private_area__allow_page',
			'label' => 'Make page Public anyway?',
			'name' => 'private_area__allow_page',
			'type' => 'true_false', 
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'wpbc-true_false-ui',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		);

		$msg = 'You are using Private Areas addon. This page is only visible for allowed logged users.'; 
		$get_woo_conditions = WPBC_private_areas_get_woo_conditions();  
		$icon = WPBC_get_svg_icon('lock');

		if(isset($_GET['post'])){
			$post_id = $_GET['post'];
			$allowed_by_settings = WPBC_private_areas_is_visible_settings($post_id);
			if($allowed_by_settings){
				$icon = WPBC_get_svg_icon('lock_open');

				$msg = '<span class="wpbc-badge">'.__('This page is', 'bootclean') .' <b>'. __('PUBLIC', 'bootclean').'</b></span> <br><br>';
				$msg .=  __('This page has been configured to bypass the Private Area feature.', 'bootclean');

				$menu_slug = 'wpbc-private-areas-settings';
				$url = admin_url( 'admin.php?page=' . $menu_slug );
				$msg .= '<br><br> '.__('Go to settings if you need to change this', 'bootclean').' > <a class="wpbc-btn-small button" href="'.$url.'"><small>'.__('PRIVATE AREAS', 'bootclean').'</small></a>';

				$select_field = array (
					'key' => 'field_layout_private_area__allow_page',
					'label' => 'Make page Public anyway?',
					'name' => 'private_area__allow_page',
					'type' => 'number',
					'default_value' => 1,
					'readonly' => true, 
					'wrapper' => array (
						'width' => '',
						'class' => 'wpbc-hidden-input wpbc-field-no-label',
						'id' => '', 
					),
				);
			}
		}  

		$fields[] = array (
			'key' => 'field_layout_private_area__allow_message',
			'label' => '',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'wpbc-field-no-label',
				'id' => '',
			),
			'message' => $msg,
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		);

		$fields[] = $select_field;
	}

	return $fields;
}

/* Adding the meta box into builder group */

// add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__private_areas', 0, 1);

/* Adding a meta box group into pages */
function WPBC_private_areas_location_post_types(){
	return apply_filters('wpbc/filter/private_areas/location_post_types',array());
}
function WPBC_private_areas_group_location(){
	
	$location = array(); 
	
	$location_post_types = WPBC_private_areas_location_post_types();

	if(!empty($location_post_types)){
		foreach ($location_post_types as $type) {
			$location[] = array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => $type,
				)
			);
		}
	}
	return apply_filters('wpbc/filter/private_areas/group_location',$location); 

}

$location = WPBC_private_areas_group_location();

if( function_exists('acf_add_local_field_group') ):

	$group_post_type_fields = array();
	$group_post_type_fields = WPBC_group_builder__layout__private_areas($group_post_type_fields);

	$icon = WPBC_get_svg_icon('lock');   

	acf_add_local_field_group(array(
		'key' => 'group_post_type_private_areas_settings',
		'title' => $icon.' Private Areas Settings',
		'fields' => $group_post_type_fields,
		'location' => $location,
		'menu_order' => 2,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

endif;

add_action('after_setup_theme', function() use ($location){ 

	

}, 10); 

/*

	Admin Columns for Page post type

*/

$location_post_types = WPBC_private_areas_location_post_types();
if(!empty($location_post_types)){
	foreach ($location_post_types as $type) {
		add_filter( 'manage_'.$type.'_posts_columns', 'wpbc_private_areas_manage_pages_columns',10,1 );

		add_filter( 'manage_edit-'.$type.'_sortable_columns', 'wpbc_private_areas_manage_pages_sortable_columns' );

		add_action( 'manage_'.$type.'_posts_custom_column', 'wpbc_private_areas__manage_pages_custom_column', 10, 2 );
	} 
}  

function wpbc_private_areas_manage_pages_columns( $defaults ) { 
	$defaults['private_area__allow_page'] = __('Private', 'bootclean');  
	return $defaults;
}

function wpbc_private_areas_manage_pages_sortable_columns($defaults){
	$defaults['private_area__allow_page'] = __('Private', 'bootclean');
	return $defaults;
}

function wpbc_private_areas__manage_pages_custom_column( $column_name, $id ){ 
	if ( $column_name === 'private_area__allow_page' ) {

		$private_area__allow_page = get_post_meta($id, 'private_area__allow_page', true);
		// echo $private_area__allow_page;
		if(WPBC_private_areas__if_allowed_page($id)){
			echo WPBC_get_svg_icon('lock_open','#8ed74e').'<br><small>Public page</small>';
		} else {
			echo WPBC_get_svg_icon('lock','#c14e33').'<br><small>Private page</small>';
		} 
	}
}

// NOT USED ??
// Should be using 
add_action( 'pre_get_posts', 'wpbc_private_areas__manage_pages_custom_column_query' );
function wpbc_private_areas__manage_pages_custom_column_query( $query ){
    $orderby = $query->get( 'orderby' ); 
    global $pagenow;
    if ( !is_admin() )
        return;
 
    $location_post_types = WPBC_private_areas_location_post_types();
    if ( 'Private' == $orderby && 'edit.php' == $pagenow && in_array( $_GET['post_type'], $location_post_types) ) { 
        $meta_query = array(
            'relation' => 'OR',
            array(
                'key' => 'private_area__allow_page',
                'compare' => 'NOT EXISTS', // see note above
            ),
            array(
                'key' => 'private_area__allow_page',
            ),
        ); 
        $query->set( 'meta_query', $meta_query ); 
        //$query->set( 'meta_key', 'private_area__allow_page' );
        $query->set( 'orderby', 'meta_value' );
    }
} 