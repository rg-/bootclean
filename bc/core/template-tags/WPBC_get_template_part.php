<?php 




/*

	WPBC_get_template_part()
	
	@package bootclean
	@subpackage template-tags
	@function WPBC_get_template_part
	@since Bootclean 9.0
	
	get_template_part but passing filter to add/remove and pass parameters as well,
	that means, you can pass parameters to filters that are inside some template part. Great!

*/  

// get_template_part( 'template-parts/navbar', 'main' );



/*

	Example passing params for inside filters:
	
	WPBC_get_template_part__filtered('template-parts/header-post_title', array(
					'add_filter' => 'WPBC_post_header_title_class',
					'callback' => 'bg-orange'
				));

*/

function WPBC_get_template_part__filtered($template, $args=false){
	global $_h; 
	$has_filter = false;
	if($args){ 
		extract($args);
		
		$has_filter = ($add_filter && $callback) ? true : false;
		$_h = $callback ? $callback : '';  
		if($has_filter){
			$n = function(){
				global $_h; return $_h;
			};
			add_filter($add_filter, $n);
			get_template_part( $template );  
			remove_filter($add_filter, $n);
			$n = null;
		}else{
			get_template_part( $template ); 
		} 
		
	}else{
		get_template_part( $template ); 
	}
	$_h = null;
}


/*
	
	Alternative way to pass params.
	
	Change filters values on template parts on the fly, ex:
	
	The $e function as a variable, is crucial for the remove_filter to take place.
	
	$e = function(){ return 'bg-primary'; };
	add_filter('WPBC_post_header_title_class', $e);
	get_template_part('template-parts/header-post_title'); 
	remove_filter('WPBC_post_header_title_class',$e);

*/

function add_many_filters($filters){
	if($filters){
		foreach($filters as $k=>$v){
			global $v;
			$vv = function(){
				global $v; return $v;
			};
			add_filter($k, $vv);
			$vv = null;
		}
	}
}
function remove_many_filters($filters){
	if($filters){
		foreach($filters as $k){
			remove_filter($k, function(){});
		}
	}
}