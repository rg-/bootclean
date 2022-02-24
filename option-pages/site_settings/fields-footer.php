<?php

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__footer_tab', 0, 1);  

function wpbc_theme_settings__footer_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__footer_tab',
			'label' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path fill="none" d="M0,0h24v24H0V0z"/>
<g>
	<path d="M8,11v3H4v-3H8 M9,10H3v5h6V10L9,10z"/>
</g>
<g>
	<path d="M21,11v3H11v-3H21 M22,10H10v5h12V10L22,10z"/>
</g>
<g>
	<path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z"/>
</g>
<rect fill="var(--primary)" x="3" y="16" width="19" height="3"/>
</svg> '._x('Footer','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/footer',$fields);
	return $fields;
}  

add_filter('wpbc/filter/theme_settings/fields/footer', 'wpbc_theme_settings__footer__subtitle', 0, 1);
function wpbc_theme_settings__footer__subtitle($fields){
	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__footer_subtitle',
			'label' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path fill="none" d="M0,0h24v24H0V0z"/>
<g>
	<path d="M8,11v3H4v-3H8 M9,10H3v5h6V10L9,10z"/>
</g>
<g>
	<path d="M21,11v3H11v-3H21 M22,10H10v5h12V10L22,10z"/>
</g>
<g>
	<path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z"/>
</g>
<rect x="3" y="16" width="19" height="3"/>
</svg> '. _x('Footer Options','bootclean'),  
		)
	); 
	return $fields;
}


add_filter('wpbc/filter/theme_settings/fields/footer', 'wpbc_theme_settings__footer_defaults', 10, 1);
function wpbc_theme_settings__footer_defaults($fields){

	$fields[] = WPBC_acf_make_true_false_field(
			array( 
				'name' => 'footer__use',
				'label' => _x('Visble','bootclean'), 
				'default_value' => 1,
				'width' => '15'
			)
		);  

	$fields[] = WPBC_acf_make_radio_field(
		array( 
			'name' => 'footer_template_type',
			'label' => _x('Footer Type','bootclean'), 
			'default_value' => 'default',
			'choices' => array (
				'default' => 'Default',
				'template' => 'Template',
				'template-part' => 'Template Part (php)',
				'custom' => 'Custom HTML', 
			),
			'default_value' => 'default',
			'class' => 'wpbc-radio-as-btn as-btn-danger',
			'width' => '85'
		),
		true
	);  

	$fields[] =  WPBC_acf_make_post_object_wpbc_template(
		array( 
			'name' => 'footer_template',
			'label' => _x('Footer template','bootclean'),
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_footer_template_type',
						'operator' => '==',
						'value' => 'template',
					),
				), 
			),
		)
	); 

	$fields[] =  WPBC_acf_make_select_template_part_field(
		array( 
			'name' => 'footer_template_part',
			'label' => _x('Footer template part','bootclean'),
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_footer_template_type',
						'operator' => '==',
						'value' => 'template-part',
					),
				), 
			),
		)
	); 

	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'footer_custom_html',
			'label' => _x('Footer Custom Html','bootclean'),
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_footer_template_type',
						'operator' => '==',
						'value' => 'custom',
					),
				), 
			),
		)
	);  

	return $fields;
} 