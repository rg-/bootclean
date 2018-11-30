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