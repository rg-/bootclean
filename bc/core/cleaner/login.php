<?php

/*
	Apply the things behind....
*/

if( apply_filters('BC_cleaner__login', '__return_true') ){

	$enable = BC_get_option('bc-options--admin-login--enable');

	if(!empty($enable)){
		add_action( 'login_head', 'BC_custom_login_logo' );
		add_filter( 'login_headerurl', 'BC_custom_login_headerurl' );
		add_filter( 'login_headertitle', 'BC_custom_login_headertitle');
	}
}

/**
 * Insert custom login logo
 */


/*

	Example setting a default option from functions:

	add_filter('WPBC_set_default_option__'.'bc-options--layout--main-footer',function($option, $k){
		$option['std'] = '1';
		return $option;
	}, 10, 2);

*/

/*

	If parent Bootclean theme actived, use this for default login screen.

*/
if(!is_child_theme()){

	add_filter('WPBC_set_default_option__'.'bc-options--admin-login--enable',function($option, $k){
		$option['std'] = '1';
		return $option;
	}, 10, 2);


	add_filter('WPBC_set_default_option__'.'bc-options--admin-login--brand-logo',function($option, $k){
		$option['std'] = THEME_URI.'/images/theme/bootclean-iso-color-@2.png';
		return $option;
	}, 10, 2); 

	add_filter('WPBC_set_default_option__'.'bc-options--admin-login--brand-logo-width',function($option, $k){
		$option['std'] = '136';
		return $option;
	}, 10, 2);

	add_filter('WPBC_set_default_option__'.'bc-options--admin-login--brand-logo-height',function($option, $k){
		$option['std'] = '152';
		return $option;
	}, 10, 2);

}

 
function BC_custom_login_logo(){

	// OLD WAY
	// $root = BC_theme_root();  
	 
	$style = '<style>';
	
	$background = BC_get_option('bc-options--admin-login--body-background'); 
		$body_background = !empty($background['color']) ? $background['color'] : '';
		$body_repeat = !empty($background['repeat']) ? $background['repeat'] : 'no-repeat';
		$body_position = !empty($background['position']) ? $background['position'] : 'center center';
		$body_attachment = !empty($background['attachment']) ? $background['attachment'] : 'scroll';
		$body_size = !empty($background['size']) ? $background['size'] : 'cover';
		$body_image = !empty($background['image']) ? $background['image'] : '';
	
	// $body_background = BC_get_option('bc-options--admin-login--body-background-color', $root['wp']['login']['body-background-color']);

	$body_text = BC_get_option('bc-options--admin-login--body-text-color');	
	$body_text_hover = BC_get_option('bc-options--admin-login--body-text-color-hover');	
	
	$style .= 'body{ '; 
		if(!empty($body_background)){
			$style .= 'background-color: '.$body_background.';';
		}
		if(!empty($body_repeat)){
			$style .= 'background-repeat: '.$body_repeat.';';
		}
		if(!empty($body_position)){
			$style .= 'background-position: '.$body_position.';';
		}
		if(!empty($body_attachment)){
			$style .= 'background-attachment: '.$body_attachment.';';
		}
		if(!empty($body_size)){
			$style .= 'background-size: '.$body_size.';';
		}
		if(!empty($body_image)){
			$style .= 'background-image: url('.$body_image.');';
		}
		if(!empty($body_text)){
			$style .= 'color: '.$body_text.';';
		}
				
	$style .= '}'; 
	if(!empty($body_text)){
		$style .= '.login #backtoblog a, .login #nav a{ color: '.$body_text.'; }'; 
	}
	if(!empty($body_text_hover)){
		$style .= '.login #backtoblog a:hover, .login #nav a:hover{ color: '.$body_text_hover.'; }'; 
	}	
	
	$logo = BC_get_option('bc-options--admin-login--brand-logo'); 
	$logo_w = BC_get_option('bc-options--admin-login--brand-logo-width');
	$logo_h = BC_get_option('bc-options--admin-login--brand-logo-height');
	
	if(!empty($logo)){
		$style .= 	'.login h1 a { 
						background-image: url('.$logo.') !important; 
						background-size: '.$logo_w.'px '.$logo_h.'px; 
						width: '.$logo_w.'px; 
						height: '.$logo_h.'px; 
						display:block; 
					}'; 
	}
	
	$login_form_background = BC_get_option('bc-options--admin-login--form-background');
	$login_form_color = BC_get_option('bc-options--admin-login--form-color');
	
	$style .= '.login form{';
		if(!empty($login_form_background)){
			$style .= 'background-color: '.$login_form_background.';'; 
		}
	$style .= '}';
	
	$style .= '.login label{';
		if(!empty($login_form_color)){
			$style .= 'color: '.$login_form_color.';'; 
		}
	$style .= '}';
	
	$button_background = BC_get_option('bc-options--admin-login--button-background');
	$button_border_color = BC_get_option('bc-options--admin-login--button-border-color');
	$button_color = BC_get_option('bc-options--admin-login--button-color');
	
	$style .= '.wp-core-ui .button-primary{';
		if(!empty($button_background)){
			$style .= 'background: '.$button_background.';'; 
		}
		if(!empty($button_border_color)){
			$style .= 'border-color: '.$button_border_color.';'; 
		}
		if(!empty($button_color)){
			$style .= 'color: '.$button_color.';'; 
		}
	$style .= '}';
	
	$button_background_hover = BC_get_option('bc-options--admin-login--button-background-hover');
	$button_border_color_hover = BC_get_option('bc-options--admin-login--button-border-color-hover');
	$button_color_hover = BC_get_option('bc-options--admin-login--button-color-hover');
	
	$style .= '.wp-core-ui .button:hover, .wp-core-ui .button:focus{';
		if(!empty($button_background_hover)){
			$style .= 'background: '.$button_background_hover.'!important;'; 
		}
		if(!empty($button_border_color_hover)){
			$style .= 'border-color: '.$button_border_color_hover.'!important;'; 
		}
		if(!empty($button_color_hover)){
			$style .= 'color: '.$button_color_hover.'!important;'; 
		}
	$style .= '}';
	$style .= '.wp-core-ui .button{
		box-shadow:none;
		text-shadow:none;
		border-radius:0;
	}';
	
	$style .= '</style>'; 

	echo $style;

	$custom_css = BC_get_option('bc-options--admin-login--custom-css');
	if(!empty($custom_css)){
		echo '<style>';
		echo $custom_css;
		echo '</style>';
	}
}


/*
	Logo url and title, defaults are WP and wordpress.org.....
*/
function BC_custom_login_headerurl($url) {
     return get_bloginfo('url');
} 
function BC_custom_login_headertitle(){
     return __('Back to','bootclean').' '.get_bloginfo('name');
} 