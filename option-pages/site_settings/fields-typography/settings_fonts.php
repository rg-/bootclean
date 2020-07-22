<?php 

add_filter('wpbc/filter/theme_settings/fields/typography', 'wpbc_theme_settings__typography__settings_fonts', 2, 1);

function wpbc_theme_settings__typography__settings_fonts($fields) {

	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_settings_fonts_subtitle',
			'label' => _x('Fonts Settings','bootclean'),
			'message' => 'Choose where and how to apply fonts on the front-end side.',
		)
	);

	// _print_code(_test());

	return $fields;
}