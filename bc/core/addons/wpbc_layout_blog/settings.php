<?php

/*
 *
 * OK $types
 *
 */

/* CUSTOM TAB/FIELDS SECTION */    

add_filter('wpbc/filter/theme_settings/fields', function ($fields){ 

	$types = WPBC_get_layout_posts_post_types();

	foreach ($types as $post_type) {
		
		$fields[] = WPBC_acf_make_tab_field(
			array( 
				'key' => 'field_wpbc_theme_settings__post_type_'.$post_type.'_tab',
				'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg> '._x('Post_type:','bootclean').' '.$post_type, 
			)
		); 

		$fields[] = WPBC_acf_make_subtitle_field(
			array( 
				'key' => 'field_wpbc_theme_settings__post_type_'.$post_type.'_message',
				'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg> '._x('Post_type:','bootclean').' '.$post_type, 
				'message' => 'Adjust the way post will loop, type, style, template and some query adjustments. This settings will apply to blog pages, single, archive, category, tags, search results, etc. ',
			)
		); 

		if($post_type == 'post'){
			$layout_name = 'layout_posts_page';
		}else{
			$layout_name = 'layout_'.$post_type;

			$fields[] = WPBC_acf_make_post_object_field(array(
				'name' => $layout_name.'_front_page',
				'label' => _x('Front page:','bootclean'),
				'post_type' => array( 'page' ),
				'multiple' => 0,
			));

		}

		$fields = apply_filters('wpbc/filter/theme_settings/fields/post_type_post/pre', $fields, $layout_name, $post_type);

		$content_sub_fields = WPBC_acf_make_layout_posts_advanced($layout_name, true);
		foreach ($content_sub_fields as $key => $value) {
			$fields[] = $value; 
		}

		$fields = apply_filters('wpbc/filter/theme_settings/fields/post_type_post', $fields, $post_type);

	}

	return $fields;

}, 20, 1); 