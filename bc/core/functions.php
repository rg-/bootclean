<?php

/**
 * Bootclean main functions
 *
 * @package bootclean
 * @subpackage core functions
 */ 

include('functions/WPBC_layout.php'); 

/*
	Get a menu name by menu location
*/
function WPBC_get_nav_menu_name($menu_location){ 
	if(!empty($menu_location)){
		$menu_locations = get_nav_menu_locations(); 
		$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null); 
		$menu_name = (isset($menu_object->name) ? $menu_object->name : ''); 
		return esc_html($menu_name);
	}
}
/*
	Get a menu $menu_object by menu location
*/
function WPBC_get_nav_menu_object($menu_location){ 
	if(!empty($menu_location)){
		$menu_locations = get_nav_menu_locations(); 
		$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);  
		return $menu_object;
	}
}

// NOT USED
function WPBC_pre_layout_main_content_choices($choices=array()){
	
	$iu = BC_URI.'core/assets/images/';

	$choices = array(
		//
		'default' => array(
			'name' => 'Default', 
			'icon' => '',
			'description' => 'No classes used.',
			'classes' => array(
				'container' => array( 
					'class' => '',
					'row' => '',
					'col_content' => '',
					'col_sidebar' => '', 
				), 
			),
		),
		//
		'1col-fixed' => array(
			'name' => '1 Column | 2 Areas',  
			'icon' => '<img width="56" src="'.$iu.'1col.png"/>',
			'description' => 'Main content and secondary content 100% with. Secondary content behind Main.',
			'classes' => array(
				'container' => array( 
					'class' => '',
					'row' => 'row',
					'col_content' => 'col-12',
					'col_sidebar' => 'col-12', 
				), 
			),
		),
		//
		//
		'1colwt-fixed' => array(
			'name' => '1 Column | 2 Areas',  
			'icon' => '<img width="56" src="'.$iu.'1colwt.png"/>',
			'description' => 'Main content and secondary content 100% with. Secondary content above Main.',
			'classes' => array(
				'container' => array( 
					'class' => '',
					'row' => 'row',
					'col_content' => 'col-12 order-1',
					'col_sidebar' => 'col-12 order-0', 
				), 
			),
		),
		//
		'2c-l-fixed' => array(
			'name' => '2 Columns | 2 Areas',  
			'icon' => '<img width="56" src="'.$iu.'2cl.png"/>',
			'description' => 'Main content on the right. Secondary on the left.',
			'classes' => array(
				'container' => array( 
					'class' => '',
					'row' => 'row flex-xl-nowrap',
					'col_content' => 'col-12 col-sm-8 order-sm-1',
					'col_sidebar' => 'col-12 col-sm-4 order-sm-0', 
				), 
			),
		),
		//
		'2c-r-fixed' => array(
			'name' => '2 Columns | 2 Areas',  
			'icon' => '<img width="56" src="'.$iu.'2cr.png"/>',
			'description' => 'Main content on the left. Secondary on the right.',
			'classes' => array(
				'container' => array( 
					'class' => '',
					'row' => 'row flex-xl-nowrap',
					'col_content' => 'col-12 col-sm-8',
					'col_sidebar' => 'col-12 col-sm-4', 
				), 
			),
		),
		//

	);

	// Can add/remove/reorder choices using this filter, take care.
	$choices = apply_filters('wpbc/filter/options/layout/main-content/defaults', $choices); 
	return $choices;
}

// NOT USED
function WPBC_get_layout_main_content_choices( $as_img=false, $show_none=false ){ 
	$choices = array();
	$temp = WPBC_pre_layout_main_content_choices(); 
	foreach ($temp as $key => $value) { 
		$name = !empty($value['name']) ? '<span class="wpbc-input-as-thumb--name">'.$value['name'].'</span>' : '';
		$icon = !empty($value['icon']) ? '<span class="wpbc-input-as-thumb--icon">'.$value['icon'].'</span>' : '';
		$description = !empty($value['description']) ? '<span class="wpbc-input-as-thumb--description">'.$value['description'].'</span>' : ''; 
		$compound_value = $icon.$name.$description;
		$choices[$key] = $compound_value; 
	}  
	return apply_filters('wpbc/filter/layout/main-content/choices', $choices);  
}

/*
	BC_get_root_colors()
	
	Get root.css variables, parse and return as array

*/

function WPBC_root_css(){
	$file = MAIN_THEME_PATH.'/css/root.css';
	return apply_filters('WPBC_root_css',$file); 
}


function WPBC_get_body_data_config(){
	$body_data_config = '';
	$css_root = WPBC_get_ob_contents(WPBC_root_css());
	if(!empty($css_root)){ 
		$css = BC_css_parser($css_root);
		if(!empty($css)){
			$body_data_config = json_encode($css[":root"],true);
		} 
	}
	echo $body_data_config;
}

function BC_get_root_colors_each($args=array()){ 
	$var = $args['var'] ? $args['var'] : false;
	$remove_units =  $args['remove_units'] ? $args['remove_units'] : false; 
	$css_root = WPBC_get_ob_contents(WPBC_root_css());  
	$return = '';
	if(!empty($css_root)){
		$css = BC_css_parser($css_root);
		if(!empty($css)){
			$breakpoint = $css[":root_colors_each"]; 
			if(!empty($breakpoint)){
				$filter = array();
				foreach($breakpoint as $k=>$v){
					$k = str_replace('--','',$k);
					if($remove_units){
						//$v = preg_replace('/[^0-9.]+/', '', $v); 
					}
					$filter[$k] = $v;
				} 
				if($var){
					$return = $filter[$var];  
				}else{
					$return = $filter; 
				}
			}
		}
	}  
	return $return; 
} 
function BC_get_root_breakpoint($args=array()){ 
	$var = !empty($args['var']) ? $args['var'] : false;
	$remove_units =  !empty($args['remove_units']) ? $args['remove_units'] : false; 
	$css_root = WPBC_get_ob_contents(WPBC_root_css());  
	$return = '';
	if(!empty($css_root)){
		$css = BC_css_parser($css_root);
		if(!empty($css)){
			$breakpoint = $css[":root_breakpoint"]; 
			if(!empty($breakpoint)){
				$filter = array();
				foreach($breakpoint as $k=>$v){
					$k = str_replace('--breakpoint-','',$k);
					if($remove_units){
						$v = preg_replace('/[^0-9.]+/', '', $v); 
					}
					$filter[$k] = $v;
				} 
				if($var){
					$return = $filter[$var];  
				}else{
					$return = $filter; 
				}
			}
		}
	}  
	return $return; 
} 

function BC_get_root_colors($var=false){
	$css_root = WPBC_get_ob_contents(WPBC_root_css()); 
	$css = BC_css_parser($css_root);
	if($var){
		if(isset($css[":root_colors"][$var])){
			return $css[":root_colors"][$var]; 
		}
	}else{
		if(isset($css[":root_colors"])){
			return $css[":root_colors"]; 
		}
	} 
} 

// Bssed on hex color, find key value, color "name" like "--primary"
function BC_get_reverse_root_colors($HEX=''){
	$root_colors = BC_get_root_colors();  
	foreach($root_colors as $k=>$v){
		if($v===$HEX){
			return $k;
		}
	} 
}

function __BC_get_root_colors_palette($max=7){ 
	$css = BC_get_root_colors();
	if(isset($css)){
		$out = '[';
		$count = 0;
		foreach($css as $k=>$v){
			$name = str_replace('--','',$k);
			$value = $v;  
			if($count<=$max || $max == 'all'){
				$out .= "'".$v."',";
			}
			$count++;
		}
		$out = rtrim($out, ',') . ']';
		return $out; 
	}
}

function __BC_get_root_colors_palette_tiny($json=false){ 
	$css = BC_get_root_colors();
	if(isset($css)){
		$out = '';
		if($json) $out .= '[';
		$count = 0;
		foreach($css as $k=>$v){
			$name = str_replace('--','',$k);
			$v = str_replace('#','',$v);  
			$out .= '"'.$v.'", "'.$name.'",';
			$count++;
		}
		$out = rtrim($out, ',') . '';
		if($json) $out .= ']';
		return $out; 
	}
}

function __BC_get_root_colors_X(){ 
	$css = BC_get_root_colors();
	if(isset($css)){
		$out = '';
		$count = 0;
		foreach($css as $k=>$v){
			$name = str_replace('--','',$k);
			$value = $v; 
			$out .= '<span style=" display:inline-block; margin:10px;  text-align:center; "><span style="display:block; background-color:'.$v.'; padding:5px;  width:40px; height:40px; margin:.3em; border:1px solid #eee;"></span>'.$name.' <br><small style="font-size:10px; padding:4px 2px; display:block;">'.$v.'</small></span>';
			if($count==7){
				$out .= '<br>';
			} 
			$count++;
		}
		return $out; 
	}
}


function WPBC_get_svg_icons($icon='', $color='black'){
	/*
	$icons = array();
	$svg_assets = get_template_directory().'/bc/core/assets/svg';
	foreach (glob($svg_assets."/*.svg") as $filename)
	{
		$file = basename($filename, ".svg");
		$file = str_replace('_ionicons_svg_','',$file);
		$icons[$file] = WPBC_file_get_contents($filename);
	}
	*/
	if($icon){
		$svg_assets = get_template_directory().'/bc/core/assets/svg';
		$icon_file = WPBC_get_ob_contents( $svg_assets . '/' . $icon . '.svg');
		$i = str_replace('path','path fill="'.$color.'"',$icon_file); 
		return $i;
	} 
	
}

function WPBC_get_svg_img($icon='', $atts=array()){ 

	extract(shortcode_atts(array(
		'alt' => ' ',
		'color' => '',
		'width' => '',
		'height' => '', 
		'class' => '',
		//'data_src_type' => 'data:image/svg+xml;utf8,'
		'data_src_type' => 'base64',
		'return' => 'img'
	), $atts)); 
	
	$attrs = "alt='{$alt}'";
	$attrs .= $width ? " width='{$width}' height='{$height}'" : ''; 
	if(!$icon) return;  
	$data_svg = WPBC_get_svg_icons($icon, $color);
	
	if($data_src_type == 'base64'){
		$url = 'data:image/svg+xml;base64,' . base64_encode($data_svg);
	}
	if($data_src_type == 'utf8'){
		$url = 'data:image/svg+xml;utf8,' . utf8_encode($data_svg);
	}
	
	if($return == 'img'){
		$out = "<img class='". $class ." wpbc_svg_img' src='". $url ."' ".$attrs."/>"; 
	}
	if($return == 'src'){
		$out = $url;
	}
	return $out;
}



/*

	Enable/disable addons

	Functions should go here sinde this file load first of all

*/

/* post_type */

function WPBC_enable_post_type_realstate(){ 
	$enable = apply_filters('wpbc/filter/post_types/enable/realstate', 0);
	return $enable;
}

function WPBC_enable_post_type_realstate_op(){  
	return apply_filters('wpbc/filter/post_types/options/realstate/disable', 0);
}

function WPBC_enable_post_type_resource(){ 
	$enable = apply_filters('wpbc/filter/post_types/enable/resource', 0);
	return $enable;
}

function WPBC_enable_post_type_resource_op(){  
	return apply_filters('wpbc/filter/post_types/options/resource/disable', 0);
}

/* advanced */

function WPBC_enable_cleaner_updates_notifications(){ 
	$enable = apply_filters('wpbc/filter/cleaner/updates/notifications', 0);
	return $enable;
}
function WPBC_enable_cleaner_updates_notifications_op(){ 
	$enable = apply_filters('wpbc/filter/cleaner/updates/notifications/disable', 0);
	return $enable;
}

function WPBC_enable_cleaner_updates_checks(){ 
	$enable = apply_filters('wpbc/filter/cleaner/updates/checks', 0);
	return $enable;
}
function WPBC_enable_cleaner_updates_checks_op(){ 
	$enable = apply_filters('wpbc/filter/cleaner/updates/checks/disable', 0);
	return $enable;
}