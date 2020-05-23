<?php

/*
 * 
 *	WPBC_add_inline_style
 * 
 *  notice priority 998
 *
*/

function WPBC_add_inline_style(){ 
	$css = '';
	$css = apply_filters('WPBC_add_inline_style',$css);
	$handle = 'wpbc-inline-styles';  
	wp_register_style( $handle, false );
      wp_enqueue_style( $handle );
	wp_add_inline_style( $handle  , $css ); 
} 
add_action( 'wp_enqueue_scripts', 'WPBC_add_inline_style', 998 ); 

add_filter('WPBC_add_inline_style',function($css){

	$BC_get_root_breakpoint = BC_get_root_breakpoint();
	$post_id = WPBC_layout__get_id();
	$layout_code_styles = WPBC_get_field('code_styles', $post_id);

	$css = "/* wpbc-inline-styles for post layout__get_id: ".$post_id." */";
	if(!empty($layout_code_styles)){ 
	
		if(!empty($layout_code_styles['code_styles_all'])){ 
			$css .= $layout_code_styles['code_styles_all']. "\n"; 
		}
	
		if( $BC_get_root_breakpoint ){ 
			foreach($BC_get_root_breakpoint as $k=>$v){ 
				if(!empty($layout_code_styles['code_styles_'.$k.''])){
					$css .= '@media (min-width: '.$v.') {'. "\n";
					$css .= $layout_code_styles['code_styles_'.$k.'']. "\n";
					$css .= '}'. "\n";
				}
			}
		}  
		
	} 
	//$css .= 'body{background-color:red;}';
	return $css;
},10,1);

