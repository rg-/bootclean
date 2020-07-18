<?php

/*

fields-general.php

	This should be the same structure for all settings fields used.


	First a group title, then a tab, then the fields filtered on another filter so:

	- Group Title -> message field
	- Tab -> tab field
		-> here the filter for fileds, where [settings-name] is the thing to change, like:

		$fields = apply_filters('wpbc/filter/theme_settings/fields/[settings-name]',$fields);

	- Use then that filter for the rest of fields used.

	This way i could then filter those fields or not on child themes, adding, removing, etc. without conflicting with the priority used on the first main filter 'wpbc/filter/theme_settings/fields'
	Tha filter must be used only for adding entire groups, and then, ..... like i said above!

	'wpbc/filter/theme_settings/fields'

*/
 
add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__general_tab', 0, 1);  

function wpbc_theme_settings__general_tab($fields){ 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__general_tab',
			'label' => _x('General Options','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/general',$fields);
	return $fields;
}  


/*

	Preloading

*/

add_filter('wpbc/filter/theme_settings/fields/general', 'wpbc_theme_settings__general__preloading', 10, 1); 

function wpbc_theme_settings__general__preloading($fields){
	
	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__general_preloading_type',
			'label' => _x('Page Preload Settings','bootclean'), 
		)
	);  

	$fields[] =  WPBC_acf_make_preloaders_field(
		array(
			'name' => 'wpbc_theme_settings__general_preloading_default',
			'label' => _x('Preloader','bootclean'), 
		),
		true
	); 

	$fields[] =  WPBC_acf_make_image_field(
		array(
			'name' => 'wpbc_theme_settings__general_preloading_image',
			'label' => _x('Preload image','bootclean'), 
		),
		true
	); 

	return $fields;
}   