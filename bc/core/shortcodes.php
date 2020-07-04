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