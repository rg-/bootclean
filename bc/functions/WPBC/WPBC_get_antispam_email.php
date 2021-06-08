<?php

if(!function_exists('WPBC_get_antispam_email')){ 

	add_shortcode ('antispam_email', 'WPBC_get_antispam_email' ); 
	function WPBC_get_antispam_email( $atts, $content = null ) {  
	  $defs = array(
	    'email' => '',
	    'class' => '',
	    'label' => '',
	  ); 
	  $args = shortcode_atts($defs, $atts); 

	  $out = '';
	  if(!empty($args['email'])){

	  	$email = str_replace('@', '(at)', $args['email']);
			$email = str_replace('.', '(dot)', $email);
			$email = 'mailto:'.$email;
			if(!empty($args['label'])){
				$label = $args['label'];
			}else{
				$label = $args['email'];
			}
	    $out = '<a class="antispam '.$args['class'].'" href="'.$email.'">'.$label.'</a>';
	  }

	  return $out;  
	} 

}