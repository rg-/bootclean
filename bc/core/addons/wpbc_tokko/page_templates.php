<?php

add_filter( 'display_post_states', 'tokko_property_single_post_state', 10, 2 );

function tokko_property_single_post_state( $post_states, $post ) {

	$wpbc_tokko_post_object_single_property = WPBC_get_field('wpbc_tokko_post_object_single_property','options'); 

	$wpbc_tokko_post_object_single_development = WPBC_get_field('wpbc_tokko_post_object_single_development','options'); 

	if( $post->ID == $wpbc_tokko_post_object_single_property ) {
		$post_states[] = '<br><span class="wpbc-badge">Tokko</span> Property Single Template';
	}

	if( $post->ID == $wpbc_tokko_post_object_single_development ) {
		$post_states[] = '<br><span class="wpbc-badge">Tokko</span> Development Single Template';
	}

	return $post_states;
}

add_action('admin_head',function(){
	$wpbc_tokko_post_object_single_property = WPBC_get_field('wpbc_tokko_post_object_single_property','options'); 
	$wpbc_tokko_post_object_single_development = WPBC_get_field('wpbc_tokko_post_object_single_development','options'); 
	?>
<style>
	#the-list #post-<?php echo $wpbc_tokko_post_object_single_property; ?> th{
		border-left:4px solid var(--primary); 
	}
	#the-list #post-<?php echo $wpbc_tokko_post_object_single_development; ?> th{
		border-left:4px solid var(--primary); 
	}
</style>
	<?php
}); 


function WPBC_template_tokko_remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        
        $template = get_post_meta($id, '_wp_page_template', true); 

        switch ($template) {
            case '_template_tokko_property_single.php': 
            remove_post_type_support('page', 'editor');
            remove_post_type_support('page', 'thumbnail');
            remove_post_type_support('page', 'page-attributes');
            // remove_meta_box( 'pageparentdiv', null, 'side' );
            break;
            case '_template_tokko_development_single.php': 
            remove_post_type_support('page', 'editor');
            remove_post_type_support('page', 'thumbnail');
            remove_post_type_support('page', 'page-attributes');
            // remove_meta_box( 'pageparentdiv', null, 'side' );
            break;
            default :
            // Don't remove any other template.
            break;
        }
    }
}
add_action('init', 'WPBC_template_tokko_remove_editor');

add_action('add_meta_boxes', 'tokko_property_single_page_template', 10, 2);

function tokko_property_single_page_template($post_type, $post){

	$wpbc_tokko_post_object_single_property = WPBC_get_field('wpbc_tokko_post_object_single_property','options');
	if( $post->ID == $wpbc_tokko_post_object_single_property ) { 
		update_post_meta($post->ID, '_wp_page_template', '_template_tokko_property_single.php');
	}else{ 
		//update_post_meta($post->ID, '_wp_page_template', '');
	}

	$wpbc_tokko_post_object_single_development = WPBC_get_field('wpbc_tokko_post_object_single_development','options'); 
	if( $post->ID == $wpbc_tokko_post_object_single_development ) { 
		update_post_meta($post->ID, '_wp_page_template', '_template_tokko_development_single.php');
	}else{ 
		//update_post_meta($post->ID, '_wp_page_template', '');
	}

}
 

/* 
	Exclude gutenberg 
*/

add_filter('wpbc/filter/gutenberg/excluded_templates', function ($excluded_templates){
	$excluded_templates[] = '_template_tokko_property_single.php';
	$excluded_templates[] = '_template_tokko_development_single.php'; 
	return $excluded_templates;
},10,1); 


/* Exclude from builder locations  */ 
function WPBC_template_tokko_exclude_locations($template){
	$location = array(
		'param' => 'page_template',
		'operator' => '!=',
		'value' => $template,
	);  
	return $location;
} 
/* Disable Page Settings Template */
add_filter('wpbc/filter/acf/builder/layout_locations', function($locations){  
	$locations[0][] = WPBC_template_tokko_exclude_locations('_template_tokko_property_single.php');
	$locations[0][] = WPBC_template_tokko_exclude_locations('_template_tokko_development_single.php');
	return $locations; 
},10,1);   
/* Disable Secondary Content Template */
add_filter('wpbc/filter/acf/builder/secondary_layout_locations', function($locations){ 
	$locations[0][] = WPBC_template_tokko_exclude_locations('_template_tokko_property_single.php');
	$locations[0][] = WPBC_template_tokko_exclude_locations('_template_tokko_development_single.php');
	return $locations; 
},10,1);  



/* ACF PART */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_acf_tokko_property_single',
	'title' => 'Template Options',
	'fields' => array(
		array(
			'key' => 'field_tokko_property_single__message',
			'label' => '',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'This is the Single Property Template, there are no options available on this setup.',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_template',
				'operator' => '==',
				'value' => '_template_tokko_property_single.php',
			), 
		),
		array(
			array(
				'param' => 'post_template',
				'operator' => '==',
				'value' => '_template_tokko_development_single.php',
			), 
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;