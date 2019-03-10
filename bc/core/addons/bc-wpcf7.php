<?php

/*

	Contact Form 7 things


	@added: Version: 9.0.5
	
*/

/*

	Filter content form result.

	TODO, add after/before filters to append, prepend things on child themes.

*/
add_filter( 'wpcf7_form_elements', 'WPBC_wpcf7_form_elements' );
function WPBC_wpcf7_form_elements( $content ) {
	// global $wpcf7_contact_form;
	
	// $rl_pfind = '/<p>/';
	// $rl_preplace = '<p class="wpcf7-form-text bg-danger">';
	// $content = preg_replace( $rl_pfind, $rl_preplace, $content, 2 );

	// $content = '<div class="bg-success text-white">'.$content.'</div>';

	// Find/replace bootstrap classes
	// $control_text = array('wpcf7-text','form-controlarea');
	// $bootstrap_control = 'form-control';
	// $content = str_replace($control_text, $bootstrap_control, $content);

	return $content;	
}

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter( 'wpcf7_default_template', 'WPBC_wpcf7_default_template', 10, 2 );
function WPBC_wpcf7_default_template($template, $prop){
	if($prop == 'form'){

		$form_control_class = 'class:form-control';
		$form_btn_class = 'class:btn class:btn-primary';

		$template = '<div class="form-group has-icon">'.PHP_EOL;
		$template .= '<span class="fa fa-user form-control-icon"></span>'.PHP_EOL;
		$template .= '[text* your-name '.$form_control_class.' placeholder "Your Name"]'.PHP_EOL;
		$template .= '</div>'.PHP_EOL; 

		$template .= '<div class="form-group has-icon">'.PHP_EOL;
		$template .= '<span class="fa fa-envelope form-control-icon"></span>'.PHP_EOL;
		$template .= '[email* your-email '.$form_control_class.' placeholder "Your Email"]'.PHP_EOL;
		$template .= '</div>'.PHP_EOL;

		$template .= '<div class="form-group has-icon">'.PHP_EOL;
		$template .= '<span class="fa fa-at form-control-icon"></span>'.PHP_EOL;
		$template .= '[text your-subject '.$form_control_class.' placeholder "Your Subject"]'.PHP_EOL;
		$template .= '</div>'.PHP_EOL;

		$template .= '<div class="form-group has-icon">'.PHP_EOL;
		$template .= '<span class="fa fa-comment-alt form-control-icon"></span>'.PHP_EOL;
		$template .= '[textarea your-message '.$form_control_class.' placeholder "Your Message"]'.PHP_EOL;
		$template .= '</div>'.PHP_EOL;

		$template .= '<div class="form-group">'.PHP_EOL;
		$template .= '[submit '.$form_btn_class.' "Submit"]'.PHP_EOL;
		$template .= '</div>'.PHP_EOL; 
	}
	return $template; 
}  