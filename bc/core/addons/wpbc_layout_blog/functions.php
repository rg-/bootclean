<?php

function is_blog ($type='', $post_type = 'post') {
	global  $post;
	$posttype = get_post_type($post);

	if($type=='single'){
		return ( is_single() && ( $posttype == $post_type)  ) ? true : false ;
	} elseif ($type=='archive') {
		return ( is_archive() && ( $posttype == $post_type)  ) ? true : false ;
	} elseif ($type=='category') {
		return ( is_category() && ( $posttype == $post_type)  ) ? true : false ;	
	} elseif ($type=='tag') {
		return ( is_tag() && ( $posttype == $post_type)  ) ? true : false ;	
	}else{
		return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag() || is_search() )) && ( $posttype == $post_type)  ) ? true : false ;
	} 
}

function WPBC_if_is_post_type_layout($single=false, $post_type){
	$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings();
	if( is_blog('',$post_type) && !empty($WPBC_layout_posts_page) ){  
		if( !$single && !is_single() ){
			return true;
		}
	}
}

function WPBC_get_layout_posts_query($query_args){

	if( $query_args['posts_per_page_type'] == 'default' ){
		$query_args['posts_per_page'] = get_option('posts_per_page');
	} 

	$post_types = $query_args['post_types'];
	$post_types = explode(',', $post_types);
	$query_args['post_type'] = $post_types;

	unset($query_args['post_query_separator']);
	//unset($query_args['posts_per_page_type']);
	unset($query_args['post_types']); 
	 
	return apply_filters('WPBC_get_layout_posts_query', $query_args);
}

function WPBC_get_layout_posts_page_settings($post_type='post'){

	if($post_type == 'post'){
		$layout_name = 'layout_posts_page';
	} else {
		$layout_name = 'layout_'.$post_type;
	}
	$style = WPBC_get_theme_settings($layout_name.'__style');
	$style_args = WPBC_get_theme_settings($layout_name.'__style_options');
		$style_args = WPBC_get_flex_layout_cleaned( $style_args, $layout_name.'__');
	$query_args = WPBC_get_theme_settings($layout_name.'__query');  
	$pagination = WPBC_get_theme_settings($layout_name.'__pagination');
		$pagination = WPBC_get_flex_layout_cleaned( $pagination, $layout_name.'__');

	$query_args_ = WPBC_get_flex_layout_cleaned( $query_args, $layout_name.'__');
	$query_args = WPBC_get_layout_posts_query($query_args_); 

	$row_args = 'data-type="'.$style.'"';
	if($style == 'masonry'){  
		$row_args .= ' data-wpbc-masonry="cols" ';
		$style_args['row_class'] .= ' wpbc-masonry-row';
		$style_args['item_class'] .= ' wpbc-masonry-item';
	}
	$style_args['row_args'] = $row_args;

	$ui_layout_args = array(
		// 'paged' => $paged,
		'style' => $style,
		'query' => $query_args,
		'style_args' => $style_args, 
		'pagination' => $pagination,
	);

	return apply_filters('WPBC_get_layout_posts_page_settings', $ui_layout_args);
}

function WPBC_group_builder__layout_posts_page($fields = array()){  	
	return apply_filters('WPBC_group_builder__layout_posts_page', $fields);
} 

function WPBC_layout_posts_page_templates(){
	$layout_header_templates = array(
		array(
			'template' => 'single',
			'key' => 'posts_page',
			'label' => 'Single Posts',
		),
		array(
			'template' => 'category',
			'key' => 'category',
			'label' => 'Category Pages',
		),
		array(
			'template' => 'tag',
			'key' => 'tag',
			'label' => 'Tag Pages',
		),
		array(
			'template' => 'archive',
			'key' => 'archive',
			'label' => 'Archive Pages',
		),
	);
	return $layout_header_templates;
}