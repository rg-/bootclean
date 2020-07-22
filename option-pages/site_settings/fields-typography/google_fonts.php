<?php

add_filter('wpbc/filter/theme_settings/fields/typography', 'wpbc_theme_settings__typography__google_fonts', 1, 1);

function wpbc_theme_settings__typography__google_fonts($fields){

	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_google_fonts_subtitle',
			'label' => _x('Google Fonts','bootclean'),
			'message' => 'Embed Google fonts the right way.',
		)
	);

	return $fields;
}