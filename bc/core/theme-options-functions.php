<?php

// theme-options.php OLD placed

function optionsframework_option_name() {
	// Change this to use your theme slug
	return apply_filters('BC_theme_options_option_name','bootclean-options-theme');
} 

function optionsframework_menu_slug() {
	// Change this to use your theme slug
	return apply_filters('BC_theme_options_menu_slug','bootclean-theme-options');
} 

global $bootclean_theme_root;
$bootclean_theme_root = BC_theme_root();
global $bootclean_options; 
$bootclean_options = array();  

/*

	Used to create an Option Group

	See: core/theme-options-defaults/[group.php]

*/
function WPBC_set_option_group( $layout_id, $layout_name, $icon='', $fields=array() ){

	$group_start = array( 
		array(
			'icon-name' => $icon,
			'name' => $layout_name,
			'type' => 'heading'
		) 
	);

	$group_end = array( 
		array( 
			'type' => 'heading-end'
		) 
	);

	// merge all 
	$args = array();
	$args = array_merge( $args, $group_start);
	$args = array_merge( $args, $fields);
	$args = array_merge( $args, $group_end);

	$args = apply_filters('wpbc/filter/option-group/'.$layout_id, $args);
	
	BC_set_bootclean_options($layout_id, $args);

}

function BC_set_bootclean_options($group, $arr){
	global $bootclean_options;
	$bootclean_options[$group] = $arr;
}

function BC_get_bootclean_options($group=false){
	global $bootclean_options;
	if(!$group) {
		return $bootclean_options;
	}else{
		if(isset( $bootclean_options[$group] )){
			return $bootclean_options[$group];
		}
	}
} 

function optionsframework_options(){ 
	$options = array(); 
	$to_merge = BC_get_bootclean_options();
	if(isset($to_merge)){
		//$to_merge = array_reverse($to_merge);
		foreach($to_merge as $group){ 
			$options = array_merge( $group, $options); 
		}
	}  
	$options = apply_filters('WPBC_set_default_options',$options); 
	return $options; 
}

/*

	Default options here, each file has it´s own enable/disable on back-end filter like:
	
	apply_filters('BC_theme_options__admin_settings', '__return_true');
	
	So you can then disable it on a child theme using something like:
	
	add_filter('BC_theme_options__admin_settings', '__return_false');

*/
 

add_filter('WPBC_set_default_options',function($options){
	$temp = $options;
	foreach($options as $k=>$v){ 
		if( !empty($v['id']) && has_filter('WPBC_set_default_option__'.$v['id']) ){
			$temp[$k] = apply_filters( 'WPBC_set_default_option__'.$v['id'], $v, $v['id'] );
		} 
	} 
	return $temp;
});
/*
	Example to change default value for a particular "key" option field.
	The values like "std" needs to be re-saved, that is "restore defaults" button.
*/
/*
add_filter('WPBC_set_default_option__'.'bc-options--layout--main-navbar',function($option, $k){
	$option['std'] = '1';
	return $option;
}, 10, 2);
*/

function WPBC_get_default_options() {
	$default_options = BC_get_bootclean_options();
	$output = array(); 
	foreach ( (array) $default_options as $group ) {
		 
		if ( !empty($v['type']) && has_filter( 'of_sanitize_' . $option['type'] ) ) {
		//	$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
		}
		$options = $group;
		if( !empty( $options ) ){
			foreach($options as $k=>$v){
				if(!empty($v['id']) && !empty($v['std']) && !empty($v['type'])){
					// If option has id and std and type values, push into output
					$output[$v['id']] = $v['std'];
				}
				
			}  
		}
	}
	return $output;
}

// REMOVE NEXT VERSION 
// Loads options.php from child or parent theme NOT USED
if(file_exists( get_template_directory_uri() . '/options.php' )){
	//$optionsfile = locate_template( 'options.php' );
	//load_template( $optionsfile );
}



// theme-options/options-framework OLD placed 

/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */ 
 
function WPBC_is_options_page_enabled(){
	if( is_child_theme() ){
		$use_admin_menu = false;
	}else{
		$use_admin_menu = true;
	}
	return apply_filters( 'WPBC_options_show_menu', $use_admin_menu ); 
}
 
if ( ! function_exists( 'WPBC_get_all_options' ) ) {
	function WPBC_get_all_options() {
		$name = optionsframework_option_name();
		$option = get_option($name);
		return $option; 
	}
}
if ( ! function_exists( 'WPBC_get_option' ) ) {
	function WPBC_get_option( $name, $default = false ) {
		$option = of_get_option($name, $default);
		return $option; 
	}
}
if ( ! function_exists( 'BC_get_option' ) ) {
	function BC_get_option( $name, $default = false ) {
		$option = of_get_option($name, $default);
		return $option; 
	}
}
if ( ! function_exists( 'of_get_option' ) ) :
function of_get_option( $name, $default = false ) {

	$option_name = '';

	// Gets option name as defined in the theme
	if ( function_exists( 'optionsframework_option_name' ) ) {
		$option_name = optionsframework_option_name();
	}

	// Fallback option name
	if ( '' == $option_name ) {
		$option_name = get_option( 'stylesheet' );
		$option_name = preg_replace( "/\W/", "_", strtolower( $option_name ) );
	}

	// Get option settings from database
	$options = get_option( $option_name );

	// Return specific option
	if ( isset( $options[$name] ) ) {
		return $options[$name];
	}

	return $default;
}
endif;