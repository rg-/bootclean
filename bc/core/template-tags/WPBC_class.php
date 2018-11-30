<?php
/*

	WPBC_class()
	
	@package bootclean
	@subpackage WPBC_class
	@function _WPBC_class
		@function_ WPBC_class_container
		@function_ WPBC_class_row
		@function_ WPBC_class_col_content
		@function_ WPBC_class_col_sidebar
	@since Bootclean 9.0
	
	get_template_part but passing filter to add/remove and pass parameters as well,
	that means, you can pass parameters to filters that are inside some template part. Great!

*/ 

function WPBC_get_template_body_class(){
	$layout_code_body_class = WPBC_get_field('layout_code_body_class');
	$class = apply_filters('wpbc/filter/layout/body_class', $layout_code_body_class); 
	return $class;
}

add_filter( 'body_class', function( $classes ) {

	// layout_code_body_class
	$body_class = WPBC_get_template_body_class();

	return array_merge( $classes, array( $body_class ) ); 
} );

if(!function_exists('WPBC_layout__container_class')){
	
	function WPBC_layout__container_class(){
		
		$template_momentum_args = array( 
		
			// body main structure defaults
			'main_content' => array(
				'id' => 'main-content',
				'class' => 'content-wrap',
				'wrap' => array(
					'id' => 'main-content-wrap',
					'class' => ''
				)
			), 

		);

		$container = WPBC_get_layout_main_content_classes(); 
		$args = wp_parse_args( $container, $template_momentum_args );
		
 		$args = apply_filters('wpbc/filter/layout/start/defaults', $args); 
		return $args;
		
	} 
	
} 
 
function _WPBC_class($p='container', $e='class', $echo=true){
	$template_momentum_args = WPBC_layout__container_class();
	if(!$echo){
		return !empty($template_momentum_args[$p][$e]) ? $template_momentum_args[$p][$e] : '';
	}else{
		echo !empty($template_momentum_args[$p][$e]) ? $template_momentum_args[$p][$e] : '';
	} 
}

function WPBC_class_main_content($class=''){
	echo _WPBC_class('main_content', 'class', false);
}
function WPBC_class_main_content_wrap($class=''){ 
	$wrap = _WPBC_class('main_content', 'wrap', false);
	echo !empty($wrap['class']) ? $wrap['class'] : '';
}

function WPBC_class_container_block($class=''){
	echo _WPBC_class('container', 'block_class', false);
}
function WPBC_class_container($class=''){
	echo _WPBC_class('container', 'class', false);
}
function WPBC_class_row($class=''){
	echo _WPBC_class('container', 'row', false);
}
function WPBC_class_col_content($class=''){
	$c = _WPBC_class('container', 'col_content', false);
	echo 'bc-content '.$c;
}
function WPBC_class_col_sidebar($class=''){ 
	$c = _WPBC_class('container', 'col_sidebar', false);
	echo 'bc-sidebar '.$c;
}