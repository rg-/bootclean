<?php

/*
	
	SHORTCODE

*/

function WPBC_get_template_parts_template_builer($part){
	$out = '';
	
	$file_uri = get_template_directory_uri().'/template-parts/template-types';
	$file_path = get_template_directory().'/template-parts/template-types';
	
	$child_file_uri = get_stylesheet_directory_uri().'/template-parts/template-types';
	$child_file_path = get_stylesheet_directory().'/template-parts/template-types';
	
	$inc = false;
	
	if( file_exists( $child_file_path.'/'.$part.'.php' ) ){
		$inc = $child_file_path.'/'.$part.'.php'; 
	}else{
		if( file_exists( $file_path.'/'.$part.'.php' ) ){
			$inc = $file_path.'/'.$part.'.php'; 
		}
	}
	if($inc) return $inc; 
} 

function WPBC_get_template_FX($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => 0,
		"name" => '', 
		"args" => '',
	), $atts));
	$out = '';
	if($id!=0 && get_post_type($id) == WPBC_template_builder__post_type_name() ){ 
		$post = get_post($id); 
		//$out = $post->post_content; 
		ob_start(); 
		$template_id = $id;
		$template_type = 'default';
		$default_template_types = WPBC_template_builder__taxonomy_type_terms();
		if(!empty($default_template_types)){
			foreach($default_template_types as $k=>$v){ 
				if(has_term( $v['slug'], WPBC_template_builder__taxonomy_type_name(), $post ) ){
					$template_type = $v['slug'];
				}
			}
		} 
		
		$file = WPBC_get_template_parts_template_builer($template_type);
		if(!empty($file)){
			include ($file); 
		} 
		$out = ob_get_contents();
		ob_end_clean(); 
		/// $out .= WPBC_get_edit_template_builder( $template_id,'','','from-shortcode type-'.$template_type.'' );
	}else{
		if($name){  
			$out = WPBC_get_template_parts($name, $args);
		}
	}
	$out = do_shortcode($out);
	return apply_filters('WPBC_get_template__out', $out); 
} 

add_shortcode('WPBC_get_template', 'WPBC_get_template_FX');


function WPBC_get_template_theme_FX($atts, $content = null) {
	extract(shortcode_atts(array( 
		"name" => '',  
	), $atts));
	$out = '';
	if($name){  
		$out = WPBC_get_template_parts($name, array(
			'folder_part' => 'template-parts/theme'
		));
	}

	$out = do_shortcode($out);
	return apply_filters('WPBC_get_template_theme__out', $out); 
} 

add_shortcode('WPBC_get_template_theme', 'WPBC_get_template_theme_FX');


function WPBC_get_template_ajax_FX($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"id" => 0,
		"name" => '', 
		"min_height" => '',
		"type" => 'inview',
		"label" => __('Load more','bootclean'),
		"class" => '',
		"btn_class" => 'btn btn-primary',
		"target_content" => '',
		"args" => ''
	), $atts));

	$ajaxurl = admin_url('admin-ajax.php');
	$extra_attrs = '';
	$extra_btn_attrs = '';
	if( $id && !$name ){
		$string = '&id='.$id.'';
	}
	if( $name && !$id ){
		$string = '&name='.$name.'';
	}
	if( $args ){
		$string .= '&args='.$args.'';
	}
	$style = '';
	if($min_height){
		$style = 'min-height:'.$min_height.';';
	}
	if( $type == 'inview' ){
		$out = '<div class="'.$class.'" data-min-height="'.$min_height.'" data-inview="load" data-ajax-target="'.$ajaxurl.'?action=get_template'.$string.'"></div>';
	}
	if( $type == 'toggle' || $type == 'toggle-click' ){
		if(!empty($target_content)){
			$extra_attrs .= ' data-ajax-target-content="'.$target_content.'"';
		}
		if($type == 'toggle-click'){
			$extra_btn_attrs .= ' data-inview="click"';
		}

		if(!empty($label)){
			$label = '<a href="[data-ajax-target]" data-toggle="ajax-load" '.$extra_btn_attrs.' class="'.$btn_class.'">'.$label.'</a>';
		}else{
			$label = $content;
		} 

		$out = '<div class="'.$class.'" data-min-height="'.$min_height.'" data-toggle="load" data-ajax-target="'.$ajaxurl.'?action=get_template'.$string.'" '.$extra_attrs.'>'.$label.'</div>';
	}
	return $out;

}

add_shortcode('WPBC_get_template_ajax', 'WPBC_get_template_ajax_FX');


function WPBC_get_stylesheet_directory_uri_FX($atts, $content = null){
	return MAIN_THEME_URI;
}

add_shortcode('WPBC_get_stylesheet_directory_uri', 'WPBC_get_stylesheet_directory_uri_FX');


function WPBC_get_attachment_image_FX($atts, $content = null){
	extract(shortcode_atts(array(
		"id" => 0,
		"size" => 'thumbnail', 
		"icon" => false,
		"attr" => '',
		"class" => '',
		"retina" => false,
	), $atts));

	if(!empty($id)){

		$image_meta = wp_get_attachment_metadata( $id );
		$width = $image_meta['width'];
		$height = $image_meta['height'];
		if($retina){
			$width = $width/2;
			$height = $height/2; 
			$alt = trim( strip_tags( get_post_meta( $id, '_wp_attachment_image_alt', true ) ) );
			$src = wp_get_attachment_image_src( $id, $size, $icon ); 
			$hwstring = image_hwstring($width, $height);
			$url = '<img src="'.$src[0].'" '.$hwstring.' alt="'.$alt.'" class="'.$class.'" />';
		}else{
			$url = wp_get_attachment_image( $id, $size, $icon, $attr ); 
		}
 		$edit_this = WPBC_get_edit_template_builder($id, '', '', $class='edit-image');
		$url = $url.$edit_this;
		//print_r($image_meta);
		
		return $url;
	}
}

add_shortcode('WPBC_get_attachment_image', 'WPBC_get_attachment_image_FX');

function WPBC_get_attachment_image_src_FX($atts, $content = null){
	extract(shortcode_atts(array(
		"id" => 0,
		"size" => 'thumbnail', 
		"icon" => false,
	), $atts));

	if(!empty($id)){
		$url = wp_get_attachment_image_src( $id, $size, $icon ); 
		return $url;
	}
}

add_shortcode('WPBC_get_attachment_image_src', 'WPBC_get_attachment_image_src_FX');

/*

	Wrong name, clone and fix on future version 10.

	New function WPBC_wp_nav_menu_FX()

	Shortcode OK [WPBC_wp_nav_menu /]

*/
function WPBC_wp_nav_menu_FX($atts, $content = null){
	return WPBC_wp_nav_menuwp_nav_menu_FX($atts, $content);
}
function WPBC_wp_nav_menuwp_nav_menu_FX($atts, $content = null){
	extract(shortcode_atts(array(
		"theme_location" => '',
		"menu_name" => false,
		"nav_title_class" => 'nav-title',
		"nav_title_before" => '',
		"nav_title_after" => '',
		"as_collapse" => false,
		"collapse_toggle_class" => 'nav-title',
		"collapse_toggle_before" => '',
		"collapse_toggle_after" => '',
		"collapse_class" => 'd-md-block',
		"collapse_data_parent" => '',

	), $atts));

	$atts = apply_filters('WPBC_wp_nav_menu/atts', $atts);

	if(!empty($theme_location)){
		
		$n_name = WPBC_get_nav_menu_name($theme_location);
		$nav_title_name = !empty($n_name) ? $n_name : '';
		$menu_object = WPBC_get_nav_menu_object($theme_location);

		$menu_id = 'nav_menu_'.$menu_object->term_id.'_'.$menu_object->slug;

		$wp_nav_menu = '';  
		$wp_nav_menu_before = '';
		$wp_nav_menu_after = ''; 

		$menu_before = '';
		$menu_after = ''; 

		$nav_title = '';  

		$nav_title_name = $nav_title_before.$nav_title_name.$nav_title_after;

		if(!empty($as_collapse)){ 

			$atts['container_class'] = 'card-body'; 
			
			$menu_before = '<div class="nav_menu_collapse">';
			$menu_after = '</div>'; 

			$collapse_data_parent = !empty($collapse_data_parent) ? 'data-parent="'.$collapse_data_parent.'"' : '';

			$wp_nav_menu_before = '<div '.$collapse_data_parent.' class="collapse_menu collapse '.$collapse_class.'" id="'.$menu_id.'"><div class="card">';
			$wp_nav_menu_after = '</div></div>'; 
			$nav_title .= '<a class="collapsed '.$collapse_toggle_class.'" data-toggle="collapse" href="#'.$menu_id.'" role="button" aria-expanded="false" aria-controls="'.$menu_id.'">'.$collapse_toggle_before.$nav_title_name.$collapse_toggle_after.'</a>';

		}

		if(!empty($menu_name)){ 
			$nav_title .= '<h3 class="'.$nav_title_class.'">'.$nav_title_name.'</h3>';
		} 
		
		ob_start();   
		wp_nav_menu($atts);
		$wp_nav_menu .= ob_get_contents();
		ob_end_clean(); 
		return $menu_before.$nav_title.$wp_nav_menu_before.$wp_nav_menu.$wp_nav_menu_after.$menu_after;
	}
}

add_shortcode('WPBC_wp_nav_menuwp_nav_menu', 'WPBC_wp_nav_menuwp_nav_menu_FX');
add_shortcode('WPBC_wp_nav_menu', 'WPBC_wp_nav_menu_FX');

function WPBC_get_post_title_FX($atts, $content = null){
	global $post;
	if(!empty($post)){
		return get_the_title($post);
	}
}
add_shortcode('WPBC_get_post_title', 'WPBC_get_post_title_FX');