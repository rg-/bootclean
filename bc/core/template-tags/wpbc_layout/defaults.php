<?php

/**
 * WPBC_layout -> WPBC_layout_defaults
 *
 * @package WPBC_layout
 * @subpackage WPBC_layout_defaults
 * @since Bootclean 9.0
 */


/*
	This function will collect all customized setting for each page/post/so on...
*/

/*
add_action('wpbc/layout/body/start',function(){ 
	$test = WPBC_get_layout_customize();
	echo "<pre>";
	print_r($test);
	echo "</pre>";
},99,1);
*/

function WPBC_get_layout_customize(){ 
	global $post;
	global $wp_query; 
	$customs = array();
	
	// Using Admin Theme Options or Functions Theme coded options
	$customs['using_options'] = WPBC_is_options_page_enabled();

	// Using Admin Theme Options or Functions Theme coded options
	$layout_main_content = BC_get_option('bc-options--layout--main-content-custom'); 
	$customs['using_custom_options'] = !empty($layout_main_content) ? 1 : 0;
	
	// For main container
	$customs['main_container'] = WPBC_layout__container_class();
	
	// For main navbar:
	$customs['main_navbar'] = WPBC_layout__main_navbar_defaults();

	// For main page heaer:
	$customs['main_page_header'] = WPBC_layout__main_page_header_defaults();
	
	// For main footer:
	$customs['main_footer'] = WPBC_layout__main_footer_defaults();
	
	return $customs;
}    


function WPBC_get_layout_customize_use($args=array(), $layout){
	
	$use_custom_template = $args['use_custom_template'];
	$use_from_options = $args['use_from_options'];
	$use_template = $args['use_template'];

	$return = '';
	if( !empty($use_custom_template) ){
		$return = $use_custom_template; 
	}else{
		if( false == $use_from_options ){ 
		}else{
			if( false != $use_template ){ 
				$return = $use_template;
			} 
		}
	} 
	return $return; // template ID
}

function WPBC_if_has_layout($layout,$id){
	if($layout=='main_navbar'){
		$temp = WPBC_layout__main_navbar_defaults($id);
	}
	
	if($layout=='main_footer'){
		$temp = WPBC_layout__main_footer_defaults($id);
	}

	if( !empty($temp['template_id']) ){
		
		/* CHANGED 2020 08 19 */

		/*
		if( !empty($temp['use_custom_template']) && $temp['use_custom_template'] == 'none' ){
			return 2;
		}else{
			return 1;
		} 
		*/

		/* into this one, notice also y changed the return to $return so i can return it at the end */

		if( !empty($temp['use_custom_template']) && $temp['use_custom_template'] != 'none' ){
			$return = 2;
		}else{
			$return = 1;
		}
		if($temp['use_custom_template'] == 'none'){
			$return = 0;
		}

		/* CHANGED 2020 08 19 END */
	
	}else{

		

		
	} 

	if($layout=='main_page_header'){
		$temp = WPBC_layout__main_page_header_defaults($id); 
		if($layout=='main_page_header' && !empty($temp['type']) && $temp['type'] != 'none'){
			 
			if($temp['type']=='template'){
				$return = 1;
			}else{
				$return = 3;
			}
		}else{
			$return = 0;
		}
	}

	//_print_code($temp);
	return $return;

}

function WPBC_if_has_main_navbar($id){
	return WPBC_if_has_layout('main_navbar',$id); 
}

function WPBC_if_has_page_header($id){
	return WPBC_if_has_layout('main_page_header',$id); 
}

function WPBC_if_has_main_footer($id){
	return WPBC_if_has_layout('main_footer',$id); 
}

function WPBC_page_header_slick_item_before($item, $params){ 
	echo apply_filters('wpbc/page_header/slick/item/before', '');
}
function WPBC_page_header_slick_item_after($item, $params){ 
	echo apply_filters('wpbc/page_header/slick/item/after', '');
}

function WPBC_layout__main_page_header_defaults($post_id=''){ 

	$main_page_header = WPBC_get_option('bc-options--layout--main-page-header');
	$main_page_header_template = WPBC_get_option('bc-options--layout--main-page-header-template');

	$post_id = !empty($post_id) ? $post_id : WPBC_layout__get_id(); 
	$template_ID = false;
	$custom_html = false;
	$use_page_title = false;

	$layout_header_template_type = WPBC_get_field('layout_header_template_type', $post_id);
	$layout_header_template = WPBC_get_field('layout_header_template', $post_id);
	$custom_class = WPBC_get_field('layout_header_template_class', $post_id);

	if($layout_header_template_type == 'template'){
		if(!empty($layout_header_template)){
			$template_ID = WPBC_get_field('layout_header_template', $post_id);
		}else{
			$template_ID = false;
		} 
	}else{ 

		if($layout_header_template_type == 'html'){
		
			$template_ID = false;
			$custom_html = WPBC_get_field('layout_header_template_html', $post_id);
		
		}else{ 

			$template = WPBC_get_template();
			$page_for_posts = get_option( 'page_for_posts' ); 
			if( 'single' == $template ){ 
				$template_ID = WPBC_get_field('layout_header_template_posts_page', $page_for_posts);  
			}
			if( 'category' == $template ){ 
				$template_ID = WPBC_get_field('layout_header_template_category', $page_for_posts);  
			}
			if( 'tag' == $template ){ 
				$template_ID = WPBC_get_field('layout_header_template_tag', $page_for_posts);  
			}
			if( 'archive' == $template ){ 
				$template_ID = WPBC_get_field('layout_header_template_archive', $page_for_posts);  
			} 

		}

		if($layout_header_template_type == 'title'){ 
			$template_ID = false; 
			$$page_title_subtitle = '';
			$page_title_type = WPBC_get_field('layout_header_template_page_title_type', $post_id);
			if( $page_title_type ){
				$page_title_subtitle = WPBC_get_field('layout_header_template_page_title_subtitle', $post_id);
			}
			$page_title_custom = WPBC_get_field('layout_header_template_page_title_custom', $post_id);
			if( $page_title_custom ){
				$title = WPBC_get_field('layout_header_template_page_title_custom_title', $post_id);
			}else{
				$title = get_the_title($post_id);
			}
			$use_page_title = array(
				'title' => $title,
				'subtitle' => $page_title_subtitle,
				'container_class' => 'container',
				'row_class' => 'row',
				'col_class' => 'col-12 text-center',
			);
		}

	}  

	$params = array(
		'id'=> 'main-page-header', 
		'is_main' => true, 
		'use_from_options' => $main_page_header,
		'use_template' => $main_page_header_template, 
		'use_custom_template' => $template_ID,
		'use_custom_html' => $custom_html,
		'use_page_title' => $use_page_title, 
		'custom_attrs' => '',
		'custom_class' => $custom_class,
		'type' => $layout_header_template_type,
	); 

	$template_in_use_ID = WPBC_get_layout_customize_use($params, $params['id']);
	$params['template_id'] = $template_in_use_ID;
 
	$params = apply_filters('wpbc/filter/layout/main-page-header/defaults',$params);
	return $params;

} 

function WPBC_layout__main_navbar_defaults($post_id=''){
	
	$main_navbar = WPBC_get_option('bc-options--layout--main-navbar');
	$main_navbar_template = WPBC_get_option('bc-options--layout--main-navbar-template');
	
	//$post_id = WPBC_layout__get_id(); 
	$post_id = !empty($post_id) ? $post_id : WPBC_layout__get_id(); 

	$template_ID = false;
	$layout_main_navbar_template = WPBC_get_field('layout_main_navbar_template', $post_id);
	if(!empty($layout_main_navbar_template)){
		$template_ID = WPBC_get_field('layout_main_navbar_template', $post_id);
	}
	
	$params = array(
		'id'=> 'main-navbar',
		
		'is_main' => true,
		
		'use_from_options' => $main_navbar,
		'use_template' => $main_navbar_template,
		
		'use_custom_template' => $template_ID, 

		'wp_nav_menu' => array(
			'theme_location'=> 'primary',
		)
	
	); 

	$template_in_use_ID = WPBC_get_layout_customize_use($params, $params['id']);
	$params['template_id'] = $template_in_use_ID;

	$params = apply_filters('wpbc/filter/layout/main-navbar/defaults',$params);
	return $params;
} 

function WPBC_layout__main_footer_defaults($post_id=''){

	$post_id = !empty($post_id) ? $post_id : WPBC_layout__get_id();
	
	$main_footer = WPBC_get_option('bc-options--layout--main-footer');
	$main_footer_template = WPBC_get_option('bc-options--layout--main-footer-template');
	
	$template_ID = false;
	$layout_main_footer_template = WPBC_get_field('layout_footer_template', $post_id);
	if(!empty($layout_main_footer_template)){
		$template_ID = WPBC_get_field('layout_footer_template', $post_id);
	}

	$params = array(
		'id'=> 'main-footer', 
		'is_main' => true, 
		'use_from_options' => $main_footer,
		'use_template' => $main_footer_template, 

		'use_custom_template' => $template_ID, 
	
	);
	$template_in_use_ID = WPBC_get_layout_customize_use($params, $params['id']);
	$params['template_id'] = $template_in_use_ID;
	
	// OLD WPBC_layout__main_footer_defaults
	$params = apply_filters('wpbc/filter/layout/main-footer/defaults',$params);
	return $params;
}