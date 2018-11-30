<?php  

$images_uri = BC_URI.'/core/assets/images/';

$options_navbar = array();
$options_navbar_obj = get_posts( 'post_type=wpbc_template&sort_column=post_parent,menu_order&numberposts=-1' );
$options_navbar['0'] = 'None'; 
foreach ($options_navbar_obj as $page) {
	$options_navbar[$page->ID] = $page->post_title;
}

$options_page_header = array();
$options_page_header_obj = get_posts( 'post_type=wpbc_template&sort_column=post_parent,menu_order&numberposts=-1' );
$options_page_header['0'] = 'None'; 
foreach ($options_page_header_obj as $page) {
	$options_page_header[$page->ID] = $page->post_title;
}

$options_footer = array();
$options_footer_obj = get_posts( 'post_type=wpbc_template&sort_column=post_parent,menu_order&numberposts=-1' );
$options_footer['0'] = 'None'; 
foreach ($options_footer_obj as $page) {
	$options_footer[$page->ID] = $page->post_title;
}

$options_wpbc_template = array();
$options_wpbc_template_obj = get_posts( 'post_type=wpbc_template&sort_column=post_parent,menu_order&numberposts=-1' );
$options_wpbc_template['0'] = 'None'; 
foreach ($options_wpbc_template_obj as $page) {
	$options_wpbc_template[$page->ID] = $page->post_title;
}  

global $WPBC_VERSION; 

// $main_navbar here
include('layout/main_navbar.php'); 

// $main_page_header here
include('layout/main_page_header.php'); 

// $main_content here
if ( version_compare( $WPBC_VERSION, '9.0.0', '>' ) ) { 
	$main_content = '';
}else{
	include('layout/main_content.php');  
}

// $main_content_builder here NEW since 9.0.1 Future replacement for many layout things.

if ( version_compare( $WPBC_VERSION, '9.0.0', '>' ) ) { 
	include('layout/main_content_builder.php');  
	include('layout/main_content_areas.php');  
}else{
	$main_content_builder = '';
	$main_content_areas = '';
}

// $main_footer here
include('layout/main_footer.php');  

// Merge all those fileds into one...
$fields = array();

if(!empty($main_content_builder)) $fields = array_merge( $fields, $main_content_builder); 
if(!empty($main_content_areas)) $fields = array_merge( $fields, $main_content_areas); 

if(!empty($main_navbar)) $fields = array_merge( $fields, $main_navbar); 

if(!empty($main_page_header)) $fields = array_merge( $fields, $main_page_header); 

if(!empty($main_content)) $fields = array_merge( $fields, $main_content); 

if(!empty($main_footer)) $fields = array_merge( $fields, $main_footer);  

// Create the Group

$icon = WPBC_get_svg_icons('md-grid'); 
WPBC_set_option_group( 'layout', 'Layout', $icon, $fields ); 


// -------------------------------------------------------------------------- //


// NOT USED AT ALL
$layout_main_content_choices = WPBC_get_layout_main_content_choices(); 
$layout_main_content_type_choices = array (
	'container-none' => 'None',
	'container' => 'Static',
	'container-fluid' => 'Fluid',
);
// NOT USED AT ALL


/* NOT USED YET */

// layout_preview : not in use yet, use a field like this to output:
	/*
	 array(
		//'name' => "Main Content", 
		'id' => 'bc-options--layout--main-content',
		'std' => 'default',
		'type' => "radio",
		'hide-reset'=> true,
		'no_esc_html' => true,
		'horizontal' => true,
		'options' => $layout_main_content_choices,
		'width' => '100%',
		'class' => 'radio-as-thumb',
		'input_label' => true,
		'options_class' => 'wpbc-input-as-thumb'
	),
	 */

// 