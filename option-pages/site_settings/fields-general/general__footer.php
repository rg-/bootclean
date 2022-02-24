<?php


add_filter('wpbc/filter/theme_settings/fields/general', 'WPBC_theme_settings__general__footer', 10, 1);

function WPBC_theme_settings__general__footer($fields){ 

	$fields[] =  WPBC_acf_make_textarea_field(
		array( 
			'name' => 'general_footer_copyright',
			'label' => _x('Copyright text','bootclean'),  
		)
	); 

	return $fields;

}

/* FRONT END FILTERS/ACTIONS FOR THIS SETTINGS */

add_filter('wpbc/filter/component/wp-footer/args', function($args){
	if(!empty($args['is_main'])){
		$footer_copyright = WPBC_get_theme_settings('general_footer_copyright');
		if(!empty($footer_copyright)){
			$args['default_content'] = $footer_copyright;
		}
	}
	return $args;
},10,1);