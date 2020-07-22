<?php

/*

	Custom Fonts

*/

add_filter('wpbc/filter/theme_settings/fields/typography', 'wpbc_theme_settings__typography__custom_fonts', 0, 1);

function wpbc_theme_settings__typography__custom_fonts($fields){ 

	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_custom_fonts_subtitle',
			'label' => _x('Custom Fonts','bootclean'),
			'message' => 'Upload your custom fonts and generate the @font-face family needed.',
		)
	); 

	$custom_fonts_sub_fields = array();
	$custom_fonts_sub_fields[] = WPBC_acf_make_text_field(
		array(
			'name' => 'font-family',
			'label' => _x('Font family','bootclean'),
			'width' => '70%',
		)
	); 

	$custom_fonts_sub_fields[] = WPBC_acf_make_select_field(
		array(
			'name' => 'font-generic-family',
			'label' => _x('Generic family','bootclean'),
			'width' => '30%',
			'choices' =>  WPBC_acf_get__choices__font_generic_family(),
			'default_value' =>  WPBC_acf_get__choices__font_generic_family(true),
		)
	);

	$custom_fonts_sub_fields[] = WPBC_acf_make_select_field(
		array(
			'name' => 'font-weight',
			'label' => _x('Font weight','bootclean'),
			'width' => '50%',
			'choices' =>  WPBC_acf_get__choices__font_weight(),
			'default_value' =>  WPBC_acf_get__choices__font_weight(true),
		)
	);

	$custom_fonts_sub_fields[] = WPBC_acf_make_select_field(
		array(
			'name' => 'font-style',
			'label' => _x('Font style','bootclean'),
			'width' => '50%',
			'choices' =>  WPBC_acf_get__choices__font_style(),
			'default_value' =>  WPBC_acf_get__choices__font_style(true),
		)
	);

	$custom_fonts_sub_fields[] = WPBC_acf_make_message_field(
		array(
			'key' => 'src-set',
			'label' => 'Source set',  
			'message' => 'Url for each src used',
		)
	);

	$custom_fonts_sub_fields[] = WPBC_acf_make_text_field(
		array(
			'name' => 'src-eot',
			'label' => '', 
			'prepend' => 'EOT',
		)
	);

	$custom_fonts_sub_fields[] = WPBC_acf_make_text_field(
		array(
			'name' => 'src-woff',
			'label' => '', 
			'prepend' => 'WOFF',
		)
	);

	$custom_fonts_sub_fields[] = WPBC_acf_make_text_field(
		array(
			'name' => 'src-woff2',
			'label' => '', 
			'prepend' => 'WOFF2',
		)
	); 

	$custom_fonts_sub_fields[] = WPBC_acf_make_text_field(
		array(
			'name' => 'src-ttf',
			'label' => '', 
			'prepend' => 'TTF',
		)
	);

	$custom_fonts_sub_fields[] = WPBC_acf_make_text_field(
		array(
			'name' => 'src-svg',
			'label' => '', 
			'prepend' => 'SVG',
		)
	);
	
	$fields[] =  WPBC_acf_make_repeater_field(
		array(
			'is_option' => true,
			'name' => 'wpbc_theme_settings__typography_custom_fonts',
			'label' =>  _x('Add Font Families','bootclean'),
			'sub_fields' => $custom_fonts_sub_fields,
			'button_label' => _x('Add Font','bootclean'),
			'collapsed' => 'field_font-family',
		)
	);

	return $fields;
}