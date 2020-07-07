<?php

/*
	
*/ 


 

add_shortcode ('WPBC_embed_responsive_image', 'WPBC_embed_responsive_image_FX' ); 
function WPBC_embed_responsive_image_FX( $atts, $content = null ) {  
  $defs = array(); 
  $args = array_merge($defs, $atts);
  ob_start(); 
  WPBC_get_template_part('shortcodes/WPBC_embed_responsive_image', array( 
    'params' => $args, 
  )); 
  return ob_get_clean();  
}



add_shortcode ('m-icon-svg', 'WPBC_m_icon_svg_FX' ); 
function WPBC_m_icon_svg_FX( $atts, $content = null ) {  
  $defs = array(
  	'icon' => '',
  ); 
  $args = array_merge($defs, $atts);
  
  $out = '';
  if(!empty($args['icon'])){
  	$out = '<i class="m-icon-svg" style="background-image:url('.get_template_directory_uri().'/bc/core/assets/svg/'.$args['icon'].'.svg);"></i>';
  }

  return $out;  
} 