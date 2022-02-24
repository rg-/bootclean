<?php 
/*
	wpbc_branding
*/

add_filter('wpbc/filter/theme_settings/fields/general', 'wpbc_theme_settings__general__branding', 10, 1);

function wpbc_theme_settings__general__branding($fields){

	$field_name = 'wpbc_branding'; 
	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_'.$field_name.'__subtitle',
			'label' => _x('Branding','bootclean'), 
		)
	);   
	$fields[] =  WPBC_acf_make_image_field(
		array(
			'name' => $field_name.'__logotipe_image',
			'label' => _x('Logotype image','bootclean'), 
			'preview_size' => 'large',
		),
		true
	);   

	$fields[] =  WPBC_acf_make_url_field(
		array(
			'name' => $field_name.'__logotipe_url',
			'label' => _x('Logotype image url','bootclean'), 
			'preview_size' => 'large',
		),
		true
	);   

	return $fields;
}

/*
	wpbc_branding Front End
*/

/*
	
	main-navbar

*/
add_filter('wpbc/filter/layout/main-navbar/defaults', function($args){

	$logotipe_image = WPBC_get_theme_settings('wpbc_branding__logotipe_image');
	$logotipe_url = WPBC_get_theme_settings('wpbc_branding__logotipe_url');

	$custom_width = 150; // TODO 

	if( !empty($logotipe_image) ){ 

		$url = $logotipe_image['url'];
		$w = $logotipe_image['width'];
		$h = $logotipe_image['height']; 

		
		$custom_height = ($custom_width * $h) / $w;   

		//$args['navbar_brand']['class'] = 'py-3';
		//$args['navbar_brand']['attrs'] = ' data-affix-removeclass="" data-affix-addclass="" ';  
	  
		$args['navbar_brand']['title'] = '<img width="'.$custom_width.'" src="'.$url.'" alt=" " data-affix-addclass=""/>';

	}

	if( !empty($logotipe_url) ){ 

		$args['navbar_brand']['title'] = '<img width="'.$custom_width.'" src="'.$logotipe_url.'" alt=" " data-affix-addclass=""/>';

	}

	return $args;

}, 20,1);  

/*
	
	custom login

*/
add_filter('wpbc/filter/custom_login/default_args', function($args){
	/* EX */

	$logotipe_image = WPBC_get_theme_settings('wpbc_branding__logotipe_image');
	$logotipe_url = WPBC_get_theme_settings('wpbc_branding__logotipe_url');

	$custom_width = 150; // TODO 

	if( !empty($logotipe_url) ){ 

		$args['login_brand'] = array(
			'background-image' => $logotipe_url,
			'background-size' => $custom_width.'px auto',
			'width' => $custom_width.'px',
			'height' => '53px',
		);

	} 
	
	return $args;

},10,1); 