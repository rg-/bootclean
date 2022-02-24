<?php

/* HERE all the functions and filters to build the div structure globaly */

function WPBC_make_div_start($key='', $value='', $count='', $structure_id=''){

	$value = apply_filters('wpbc/filter/layout/main_container/args?='.$key.'', $value);

	$value = apply_filters('wpbc/filter/layout/'.$structure_id.'/main_container/args', $value); 

	$id = !empty($value['id']) ? ' id="'.$value['id'].'" ' : ''; 

	$value = apply_filters('wpbc/filter/layout/main_container/args', $value, $structure_id, $value['id']);
	
	$class  = !empty($value['class']) ? $value['class'] : '';
	
	if(!empty( $value['container_type'] )){
		$container_type = $value['container_type'];

		if($container_type == 'fluid'){
			$class .= ' container-fluid';
		}
		if($container_type == 'fixed'){
			$class .= ' container';
		}
		if($container_type == 'fixed-left'){
			$class .= ' container container-left';
		}
		if($container_type == 'fixed-right'){
			$class .= ' container container-right';
		}
		if($container_type == 'none'){
			$class .= '';
		}
		$class .= ' -'.$value['container_type'];
	}
	
	$area_name = '';
	if(!empty($value['area-name'])){
		$area_name = $value['area-name'];
		//$class = apply_filters('wpbc/filter/layout/main_container/area-name/'.$value['area-name'].'/class', $class);
		$class = apply_filters('wpbc/filter/layout/'.$structure_id.'/main_container/area-name/'.$value['area-name'].'/class', $class);
		// or
		$class = apply_filters('wpbc/filter/layout/class/?area-name='.$value['area-name'], $class, $structure_id, $key);
	} 
	// ej: 'wpbc/filter/layout/class/?id=main-container-areas'
	$class = apply_filters('wpbc/filter/layout/class/?id='.$value['id'], $class, $structure_id, $key); 

	// or use this one generaly (not recomened)
	$class = apply_filters('wpbc/filter/layout/main_container/class', $class, $structure_id, $value['id'], $area_name);

	$class = ' class="'.$structure_id.' '.$class.'" ';
	
	$attrs = !empty($value['attrs']) ? ' '.$value['attrs'].' ' : '';
	// ej: 'wpbc/filter/layout/attrs/id/main-container-areas'
	$attrs = apply_filters('wpbc/filter/layout/attrs/?id='.$value['id'], $attrs, $structure_id, $key);
	
	$type = !empty($value['type']) ? ' data-type="'.$value['type'].'" ' : '';

	$container_type = !empty($value['container_type']) ? ' data-container-type="'.$value['container_type'].'" ' : '';
	
	$data = $id.$class.$attrs;
	
	$tag = !empty($value['tag']) ? $value['tag'] : 'div';
	
	$index = ' data-index="'.$count.'" ';
	
	$areaname = !empty($value['area-name']) ? ' data-area-name="'.$value['area-name'].'" ' : '';
	
	$layout_template = ' data-struture="'. $structure_id .'" data-layout="'.$key.'" ';

	return "<$tag $layout_template $data $type $container_type $index $areaname>";
}
function WPBC_make_div_end($key='', $value='', $count='', $section=''){
	$tag = !empty($value['tag']) ? $value['tag'] : 'div';

	$out = apply_filters('wpbc/filter/layout/'.$section.'/end', '');

	return $out."</$tag><!-- HERE DIV $section END -->";
}

function WPBC_make_div_inner($key='', $value='', $count='', $main_key){
	$out = '';
	$shortcode = '';
	$name = '';
	if(!empty($value['shortcode'])){
		$shortcode = !empty($value['shortcode']) ? $value['shortcode'] : '';
		if(!empty($value['is-main'])){
			$shortcode = apply_filters('wpbc/filter/layout/is-main', $shortcode);
		} 
	} 
	if(!empty($value['content-area'])){ 
		$name = !empty($value['content-area']['name']) ? $value['content-area']['name'] : '';
		$shortcode = !empty($value['content-area']['shortcode']) ? $value['content-area']['shortcode'] : ''; 
	}
	$shortcode = apply_filters('wpbc/filter/layout/content-area/shortcode/'.$name, $shortcode, $key, $value);
	$shortcode = apply_filters('wpbc/filter/layout/'.$main_key.'/content-area/shortcode/'.$name, $shortcode, $value);
	$out .= do_shortcode($shortcode);
	return $out;
} 


function WPBC_layout_struture__build($section=''){ 
	$layout_defaults = WPBC_layout_struture__defaults();
	$args = WPBC_filter_layout_structure_build($layout_defaults, $section);

	if('main_container'==$section){
		//echo "section: ".$section."<br>"; 
		//echo "<pre>";
		//print_r( $args );
		//echo "</pre>";  
	}
	$out = '';
	$count = 0;
	foreach ($args as $key => $value) { 

		$structure_id = $key;

		$out .= WPBC_make_div_start($key, $value, $count, $structure_id); 

		$out .= WPBC_make_div_inner($key, $value, $count, $key);  

		$ccount = 0;

		if(!empty($value['content'])){
			$content = $value['content'];  
			foreach ($content as $kkey => $vvalue) {
				$out .= WPBC_make_div_start($kkey, $vvalue, $ccount, $structure_id); 
				$out .= WPBC_make_div_inner($kkey, $vvalue, $ccount, $key);  
				
				$cccount = 0;

				if(!empty($vvalue['content'])){
					$ccontent = $vvalue['content'];
					foreach ($ccontent as $kkkey => $vvvalue) {
						
						$out .= WPBC_make_div_start($kkkey, $vvvalue, $cccount, $structure_id);

						$out .= WPBC_make_div_inner($kkkey, $vvvalue, $cccount, $key); 
						// Posible 4 Level ?? 
						$out .= WPBC_make_div_end($kkkey, $vvvalue, $cccount, $section); 

						$cccount++;
					}
				}

				$out .= WPBC_make_div_end($kkey, $vvalue, $count, $section); 
				$ccount++;
			} 
		}

		$out .= WPBC_make_div_end($key, $value, $count, $section); 
		$count++;
	}
	// _print_code($section);
	$out = apply_filters('wpbc/filter/layout/'.$section.'/html', $out); // USED ??

	echo $out;
}



function WPBC_filter_layout_structure_build($args, $section=''){
	// This one in resume will apply right before font-end output
	// Here i will decide if use custom settings, options settings or default ones (same default option ones)
	$sections = WPBC_layout_sections(); 
	foreach ($sections as $key => $value) { 
	 	$args[$key] = apply_filters('wpbc/filter/layout/struture/?section='.$key, $args[$key]);
	} 
	
	$args = apply_filters('wpbc/filter/layout/struture', $args); 
	if(!empty($section)){
		return $args[$section]; 
	} else{
		return $args; 
	} 
	
} 

function WPBC_layout_sections(){
	$sections = array();  
	return apply_filters('wpbc/filter/layout/sections', $sections);
} 

function WPBC_get_layout_locations(){
	$location_rules = array(); 
	return apply_filters('wpbc/filter/layout/locations', $location_rules);
}

function WPBC_layout_struture__defaults(){  
	$defaults = WPBC_layout_sections();  
	$args = apply_filters('wpbc/filter/layout/struture/defaults', $defaults);
	$args = wp_parse_args( $args, $defaults ); 
	return $args;
}

function WPBC_get_layout_structure_main_container($key='a1'){
	$sections = WPBC_layout_sections(); 
	$e = apply_filters('wpbc/filter/layout/struture/defaults', $sections);
  return $e['main_container'][$key];
}

function WPBC_searchByKey($array, $needle, &$results) {
	if (is_array($array)) {
		foreach ($array as $item) {
			if (isset($item[$needle])) {
				$results[] = $item[$needle];
				continue;
			}
			if (is_array($item)) {
				WPBC_searchByKey($item, $needle, $results);
			}
		}
	}
	return $results;
}


function WPBC_get_layout_structure_path($child=false){
	$path_base = '/template-parts/layout/structure/';
	if(!$child){
		$path = get_template_directory().$path_base;
	}else{
		$path = get_stylesheet_directory().$path_base;
	} 
	return $path;
}

function WPBC_is_page_template( $template = '', $id = '' ) {
    if ( ! is_singular() ) {
        return false;
    }
 
 	$id = !empty($id) ? $id : get_queried_object_id();

    $page_template = get_page_template_slug( $id );
 
    if ( empty( $template ) )
        return (bool) $page_template;
 
    if ( $template == $page_template )
        return true;
 
    if ( is_array( $template ) ) {
        if ( ( in_array( 'default', $template, true ) && ! $page_template )
            || in_array( $page_template, $template, true )
        ) {
            return true;
        }
    }
 
    return ( 'default' === $template && ! $page_template );
}

function WPBC_get_layout_structure_build_layout($id=''){

	$template = WPBC_get_template();
	$post_type = get_post_type();

	

	// home, when root, page for post, front page or none
	// home-blog when default settings and no front page or page for post selected
	// blog when viewing the blog page if using page for post option 

	$layout = 'defaults';
	if( WPBC_is_page_template('_template_builder.php', $id) ){ 
		$template = '_template_builder';
	} 
	if ( get_post_meta( $id, '_wp_page_template', true ) ){
		$template = get_post_meta( $id, '_wp_page_template', true );
		$template = str_replace('.php', '', $template);
	}
	
	if( $id == get_option('page_for_posts') ){
		$template = 'blog'; 
	}
	
	$locations = WPBC_get_layout_locations();  
	//_print_code($locations);
	if( !empty($locations[$template]['id']) ){
		$path = WPBC_get_layout_structure_path();
		if( file_exists( $path.$locations[$template]['id'].'.php') ){
			$layout = $locations[$template]['id']; 
		}
		
	} 

	/* Theme Options PART */
	$custom_layout_locations__enable = WPBC_get_option('custom_layout_locations__enable');
	// custom_layout__custom_locations__builder
	if(!empty($custom_layout_locations__enable)){
		$layout = WPBC_get_option('custom_layout__custom_locations__'.$template ); // ?? 
	} 

	/* NEW v 11.00 */
	$using_theme_settings = false;
	$theme_settings_location = WPBC_get_option('layout_location__'.$template );
	if( isset($theme_settings_location['layout_location__'.$template]) && $theme_settings_location['layout_location__'.$template]){
		$using_theme_settings = true;
		$layout = $theme_settings_location['layout_location__'.$template]; 
	} 
	/* NEW v 11.00 */

	/* ACF PART */
	$using_page_settings = false; 

	if(!empty($id)){
		$custom_layout__enable = WPBC_get_field('custom_layout__enable', $id);
		$custom_layout__custom_location = WPBC_get_field('custom_layout__custom_location', $id);
	}else{
		$custom_layout__enable = WPBC_get_field('custom_layout__enable');
		$custom_layout__custom_location = WPBC_get_field('custom_layout__custom_location');
	}
	 
	if(!empty($custom_layout__enable)){ 
		if(!empty($custom_layout__custom_location)){ 
			$using_page_settings = true;
			$layout = $custom_layout__custom_location; 
		} 
	}
 
	if(''==$layout){
		$layout = 'defaults'; // Yes again, if anything fails, use defaults.
	} 
	
	$layout = apply_filters('wpbc/filter/layout/location', $layout, $template, $using_theme_settings, $using_page_settings);

	return $layout;
}

function WPBC_get_layout_using_settings($section=''){
	$layout = WPBC_get_layout_structure_build_layout();
	$layout_defaults = WPBC_layout_struture__defaults();
	$layout_args = WPBC_filter_layout_structure_build( $layout_defaults );
	if(!empty($layout_args[$section][$layout]['using_settings'])){
		return $layout_args[$section][$layout]['using_settings'];
	} 
}


function WPBC_get_main_container_max_content_areas($return=''){ 
	$layout_defaults = WPBC_layout_struture__defaults();
	$temp = array();
	foreach($layout_defaults as $k=>$v){ 
		$main_container = $layout_defaults['main_container'];
		foreach($main_container as $k=>$v){ 
			$temp[$k] = $v['content_areas']; 
		}  
	}
	if($return=='array'){
		return $temp;
	}else{
		return max($temp);
	}   

}


function WPBC_get_layout_locations_for_acf(){
		$layout_defaults = WPBC_layout_struture__defaults();
		$main_container = $layout_defaults['main_container'];
		$test_array = array(); 
		foreach ($main_container as $key => $value) {
			if($key!='defaults'){ 
				//$icon = WPBC_get_option('custom_layout_preview__'.$key);
				$img_path = get_template_directory_uri();
				$icon = $img_path.'/template-parts/layout/structure/'.$key.'.png';
				$test_array[$key] = '<img title="'.$key.'" src="'.$icon.'" width="50" class=""/><small style="margin:auto;">'.$key.'</small>';
			}
		}
		return $test_array;
	}

function WPBC_get_layout_container_type_choices($args=array()){

	$width = !empty($args['width']) ? $args['width'] : '24';

	$img_path = get_template_directory_uri(); 

	$choices = array(
		'none',
		'fixed',
		'fixed-left',
		'fixed-right',
		'fluid',
	);

	$custom_layout__container_type_choices = array();
	foreach ($choices as $choice) {
		$custom_layout__container_type_choices[$choice] = '<img src="'.$img_path.'/bc/core/assets/images/layout_'.$choice.'.png'.'" width="'.$width.'" class=""/> <small style="margin:auto;">'.$choice.'</small>';
	} 
	return $custom_layout__container_type_choices;
}


/* SEE THIS ONE HERE ????? */

function WPBC_get_main_container_content_areas($args){ 
	// Extreme importan function to get an array with content areas used.
	// Here you will be able to access, shortcode, id, area-name and son one for each layout.
	// Args can be all defaults, or just the args used on page.
	global $WPBC_layout_content_areas;
	$WPBC_layout_content_areas = array(); 
	//$layout_defaults = WPBC_layout_struture__defaults(); 
	//$layout_args = WPBC_filter_layout_structure_build( $layout_defaults ); 
	function findKey($arr, $key, $WWW){
	$count = 0; 
		$temp = array(); 
		global $WPBC_layout_content_areas; 
	    foreach($arr as $k => $value){
		    if( $k != 'using_settings' || $k != 'options'){
		        if($k==$key) { 
		        	$temp[$k] = $value;  
		        }
		        if(is_array($value)){
		        	$count++;
		        	$find = findKey($value, $key, $count);
	         		if($find) {
	         			$temp[$count] = $find;
	         			if(!empty($value[$key])){
	         				$WPBC_layout_content_areas[$k] = $value;
	         			} 
	         		}
		        } 
		        
	        }  
	    } 
	    return $temp;
	} 

	$o = findKey( $args['main_container'], 'content-area', $WPBC_layout_content_areas);
	return $WPBC_layout_content_areas;
}