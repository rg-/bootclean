<?php

add_filter('wpbc/filter/theme_settings/fields/general', 'WPBC_theme_settings__general__social', 10, 1);

function WPBC_theme_settings__general__social($fields){ 
	
	/* OLD WAY
	$fields[] = WPBC_acf_make_social_group_field(array(
		'name' => 'general_social',
		'label' => __('Social network','bootclean'), 
	));
	*/

	/*
		NEW WAY by flex
		filter apply_filters('wpbc/filter/settings/social_networks', $social)
		where each $social is like array('Facebook','facebook'),
	*/
		
	$fields[] = WPBC_acf_make_flexible_social_field(array(
		'name' => 'general_flex_social',
		'label' => __('Social network','bootclean'), 
	));

	return $fields;

}