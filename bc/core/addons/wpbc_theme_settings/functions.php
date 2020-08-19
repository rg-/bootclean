<?php


function WPBC_get_theme_settings_option($option){ 
	return WPBC_get_field('field_wpbc_theme_settings__'.$option, 'options');
}
function WPBC_get_theme_settings_options_by($option_prefix=''){ 
	global $wpdb;  
	$option_like = 'options_wpbc_theme_settings__'.$option_prefix.'%';
	$options_select_merge = array();
	$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}options WHERE option_name like '$option_like'", OBJECT );
	if(!empty($results)){
		foreach ($results as $key => $value) {  
			$options_select_merge[$value->option_name] = $value->option_value;
		}
	}
	return $options_select_merge;
}


function WPBC_include_option_page($template){
	
	$inc = false; 

	$file_uri = get_template_directory_uri().'/option-pages/'.$template;
	$file_path = get_template_directory().'/option-pages/'.$template;
	
	$child_file_uri = get_stylesheet_directory_uri().'/option-pages/'.$template;
	$child_file_path = get_stylesheet_directory().'/option-pages/'.$template; 
	
	if( file_exists( $child_file_path.'.php' ) ){
		$inc = $child_file_path.'.php'; 
	}else{
		if( file_exists( $file_path.'.php' ) ){
			$inc = $file_path.'.php'; 
		}
	}
	if($inc){

		include($inc);
	}
}

// $key = "defaults", "_template_builer", "page", "post", "category", etc..
function WPBC_acf_get_layout_location_default_value($key){ 
	$locations = WPBC_get_layout_locations(); 
	if(!empty($locations[$key]['id'])){
		return $locations[$key]['id'];
	} 
}
function WPBC_acf_get_layout_container_type_default_value($key){ 
	$locations = WPBC_get_layout_locations(); 
	if(!empty($locations[$key]['args']['container_type'])){
		return $locations[$key]['args']['container_type'];
	}  
}

function WPBC_acf_get_layout_location_img($location){
	$img_path = get_template_directory_uri();
	$img = $img_path.'/template-parts/layout/structure/'.$location.'.png';
	return $img;
}

function WPBC_acf_make_layout_location_choices(){
	$layout_defaults = WPBC_layout_struture__defaults();
	$main_container = $layout_defaults['main_container'];
	$test_array = array(); 
	foreach ($main_container as $key => $value) {
		if($key!='defaults'){  
			$icon = WPBC_acf_get_layout_location_img($key);
			$test_array[$key] = '<span class="radio-as-thumb-img-label"><i>'.$key.'</i></span><img src="'.$icon.'" width="50" class="radio-as-thumb-img-thumb"/>';
		}
	}
	return $test_array;
}

function WPBC_acf_make_layout_container_type_choices(){
	$img_path = get_template_directory_uri();
	// $img_path = get_stylesheet_directory_uri();
	$type_choices = array(
		'none','fixed','fixed-left','fixed-right','fluid'
	);
	$container_type_choices = array(
		'none' => '<span class="radio-as-thumb-img-label"><i>none</i></span><img src="'.$img_path.'/bc/core/assets/images/layout_none.png'.'" width="50" class=""/>',
		'fixed'=> '<span class="radio-as-thumb-img-label"><i>fixed</i></span><img src="'.$img_path.'/bc/core/assets/images/layout_fixed.png'.'" width="50" class=""/>',
		'fixed-left'=> '<span class="radio-as-thumb-img-label"><i>fixed-left</i></span><img src="'.$img_path.'/bc/core/assets/images/layout_fixed-left.png'.'" width="50" class=""/>',
		'fixed-right'=> '<span class="radio-as-thumb-img-label"><i>fixed-right</i></span><img src="'.$img_path.'/bc/core/assets/images/layout_fixed-right.png'.'" width="50" class=""/>',
		'fluid'=> '<span class="radio-as-thumb-img-label"><i>fluid</i></span><img src="'.$img_path.'/bc/core/assets/images/layout_fluid.png'.'" width="50" class=""/>',
	);
	return $container_type_choices;
}

function WPBC_acf_make_layout_location_group($args){
	
	if(empty($args['key'])) return;
	$fields = array(); 

	$fields[] = array (
		'key' => 'field_layout_location__'.$args['key'],
		'label' => '',
		'name' => 'layout_location__'.$args['key'],
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '100%',
			'class' => 'radio-as-thumb advanced layout_location',
			'id' => '',
		),
		'default_value' => WPBC_acf_get_layout_location_default_value($args['key']),
		'choices' => WPBC_acf_make_layout_location_choices(),
		'allow_null' => 0,
		'other_choice' => 0,
		'save_other_choice' => 0, 
		'layout' => 'horizontal',
		'return_format' => 'value',
	);

	$fields[] = array (
		'key' => 'field_layout_container_type__'.$args['key'],
		'label' => 'Container Type',
		'name' => 'layout_container_type__'.$args['key'],
		'type' => 'radio',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '100%',
			'class' => 'radio-as-thumb advanced layout_container_type',
			'id' => '',
		),
		'default_value' => WPBC_acf_get_layout_container_type_default_value($args['key']),
		'choices' => WPBC_acf_make_layout_container_type_choices(),
		'allow_null' => 0,
		'other_choice' => 0,
		'save_other_choice' => 0, 
		'layout' => 'horizontal',
		'return_format' => 'value',
	);

	return $fields;
} 

function WPBC_get_theme_settings_prefilter($fields){
	$temp = array(); 
	foreach ($fields as $field) { 
		/*
		Check if field name has or not the "wpbc_theme_settings__", prefixed
		This is crucial for some functions/shortcodes to get data into front-end
		*/
		if (strpos($field['name'], 'wpbc_theme_settings__') !== false) { 
		}else{
			if($field['name']!='') {
				$field['is_option'] = true; 
				$field['name'] = 'wpbc_theme_settings__'.$field['name']; 
			}
		} 
		
		$temp[] = $field;
	}
	return $temp; 
}

function WBBC_get_theme_settings_show_helpers(){
	$show_helpers = apply_filters('wpbc/filter/theme_settigs/show_helpers', 0);
	return $show_helpers;
}

add_action('acf/render_field', 'WPBC_acf_theme_settings_render_field',29);
function WPBC_acf_theme_settings_render_field($field){
	$show_helpers = WBBC_get_theme_settings_show_helpers();
	if( !empty($field['is_option']) && $show_helpers ){ 
		$name = str_replace('wpbc_theme_settings__', '', $field['_name']);
		
		if ( $field['type'] == 'post_object' ) {
			return;
		}
		echo '<p class="wpbc-helper-tip"><input type="text" readonly class="wpbc-badge" style="margin-top:5px; background:#3db980; color:#fff; text-transform:none; border:0; width:100%; font-size:10px; padding:5px 4px; min-height: auto;" value="WPBC_get_theme_settings(\''.$name.'\')"></p>';
	} 
}

function WPBC_get_theme_settings($option=''){
	$settings_fields = WPBC_get_theme_settings_fields();
	if($option){
		$temp = get_field( 'wpbc_theme_settings__'.$option, 'option' );
	}else{
		$temp = array();
		foreach ($settings_fields as $field) {
			if(!empty($field['is_option'])){ 
				$temp[] = $field;
			}
		}
	}

	return $temp;
}
function WPBC_get_theme_settings_FX($atts, $content = null){
	extract(shortcode_atts(array( 
		'name'=> ''
	), $atts)); 
	if(!empty($name)){
		return WPBC_get_theme_settings($name);
	} 
}
add_shortcode('WPBC_get_theme_settings','WPBC_get_theme_settings_FX');

function WPBC_get_theme_settings_fields(){ 
	$fields = array();  
	$fields = apply_filters('wpbc/filter/theme_settings/fields',$fields);  
	return WPBC_get_theme_settings_prefilter($fields); 
}  

function WPBC_get_theme_settings_design_fields(){ 
	$fields = array();  
	$fields = apply_filters('wpbc/filter/theme_settings/design_fields',$fields); 
	return $fields; 
}  

$locations = WPBC_get_layout_locations(); 
foreach ($locations as $key => $value) { 
	add_filter('acf/load_field/key=field_wpbc_theme_settings__layout_location__accordion_'.$key, function($field) use ($key, $value){
		$location = get_field('layout_location__'.$key,'options');
		if(!$location){
			$location = $value['id'];
		}else{
			$location = $location['layout_location__'.$key]; 
		}
		$icon = WPBC_acf_get_layout_location_img($location);
		$icon = '<img src="'.$icon.'" width="28" class="icon"/>';
		$field['label'] = $field['label'].' '.$icon;
		return $field;
	},10,1);
} 