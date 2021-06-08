<?php 


/*

	First of all, if using this settings, disable Custom Layout groups from Page Settings

*/


add_filter('WPBC_group_builder__layout', function($fields){

	
	$page_for_posts = get_option( 'page_for_posts' );
	if( !empty($_GET['post']) && $_GET['post'] == $page_for_posts){
		$remove = array(

			// Removing Main Navbar tab and groups
			// 'field_layout_main_navbar_template__tab',
			// 'field_layout_main_navbar_template', 

			// Removing Main Footer tab and groups
			// 'field_layout_footer__tab',
			// 'field_layout_footer_template',

			// Removing Custom Layout tab and groups
			'field_custom_layout__tab',
				'field_custom_layout__enable',
				'field_custom_layout__custom_location',
				'field_custom_layout__container_type', 
		);
 
		foreach ($fields as $k => $field) {
			$key = $field['key']; 
			// check
			if (in_array($key, $remove)) {
				unset($fields[$k]);
			}
	} // end foreach

	}
	
	return $fields; 

},9999,1); 


function wpbc_theme_settings__layout_icon(){
	$icon = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
		<path fill="none" d="M0,0h24v24H0V0z"/>
		<g>
			<path fill="var(--primary)" d="M8,11v3H4v-3H8 M9,10H3v5h6V10L9,10z"/>
		</g>
		<g>
			<rect fill="var(--primary)" x="10" y="11" width="12" height="3"/>
			<path fill="var(--primary)" d="M21,11v3H11v-3H21 M22,10H10v5h12V10L22,10z"/>
		</g>
		<g>
			<path d="M21,6v2H4V6H21 M22,5H3v4h19V5L22,5z"/>
		</g>
		<g>
			<path d="M21,17v1H4v-1H21 M22,16H3v3h19V16L22,16z"/>
		</g>
		</svg>';
	return $icon;
}

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__layout_tab', 0, 1);  

function wpbc_theme_settings__layout_tab($fields) { 
	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__layout_tab',
			'label' => wpbc_theme_settings__layout_icon().' '._x('Layout','bootclean'), 
		)
	); 
	$fields = apply_filters('wpbc/filter/theme_settings/fields/layout',$fields);
	return $fields;
}  

add_filter('wpbc/filter/theme_settings/fields/layout', 'wpbc_theme_settings__layout__fields', 10, 1); 


function wpbc_theme_settings__layout__fields($fields){

	$field_name = 'layout';

	$fields[] = WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__layout_message',
			'label' => wpbc_theme_settings__layout_icon().' '._x('Layout Settings','bootclean'), 
		)
	);  

	$WPBC_get_layout_locations = WPBC_get_layout_locations(); 

	foreach ($WPBC_get_layout_locations as $key => $value) {  

		$sub_fields = WPBC_acf_make_layout_sub_fields_groups('layout', $key);
		 
		/*
		$fields[] = WPBC_acf_make_accordion_field(array(
			'key' => 'field_layout__accordion'.$key,
			'label' => '<u>'.strtoupper($key).'</u>',
			'multi_expand' => 1,
		));
		*/

		$fields[] = WPBC_acf_make_group_field(array(
			'name' => 'layout__'.$key,
			'label' => '<u>'.strtoupper($key).'</u>',
			'sub_fields' => $sub_fields, 
			'hide_help_tip' => true,
			'class' => '', // wpbc-acf-no-label
			'instructions' => $WPBC_get_layout_locations[$key]['options']['label'].' '.$WPBC_get_layout_locations[$key]['options']['description'],
		));

	} 

	//$fields[] = WPBC_acf_make_layout_sub_fields_groups('layout');

	return $fields;
}

function WPBC_acf_make_layout_sub_fields_groups($field_name='', $key=''){
 	
	$max_content_areas = WPBC_get_main_container_max_content_areas(); 
	$WPBC_get_layout_locations = WPBC_get_layout_locations(); 
	$custom_layout__custom_location_choices = WPBC_get_layout_locations_for_acf(); 
	$custom_layout__container_type_choices = WPBC_get_layout_container_type_choices();

 	$sub_fields = array();

 		$sub_fields = array(); 

			$sub_fields[] = WPBC_acf_make_radio_field(array(
				'name' => $field_name.'__location',
				'label' => '<small>Layout</small>',
				'class' => 'radio-as-thumb',
				'default_value' => $WPBC_get_layout_locations[$key]['id'],	
				'choices' => $custom_layout__custom_location_choices,
			));

			$sub_fields[] = WPBC_acf_make_radio_field(array(
				'name' => $field_name.'__container_type',
				'label' => '<small>Container Type</small>',
				'class' => 'radio-with-thumb',
				'default_value' => $WPBC_get_layout_locations[$key]['args']['container_type'],	
				'choices' => $custom_layout__container_type_choices,
			));

			$sub_fields[] = WPBC_acf_make_message_field(array(
				'key' => 'field_'.$field_name.'__location_info',
				'label' => 'Defaults',
				'message' => '<small>Defaults, Layout: <u>'.$WPBC_get_layout_locations[$key]['id'].'</u> Container type: <u>'.$WPBC_get_layout_locations[$key]['args']['container_type'].'</u></small>',
				'class' => 'wpbc-acf-no-label',
			));

			for ($i=0; $i < $max_content_areas; $i++) { 

				$label = 'Container CLASS';
				if($i>0){
					$label = 'Secondary Area '.$i.' CLASS';
				}
				/*
				$sub_fields[] = WPBC_acf_make_text_field(array(
					'name' => 'layout_location_class__'.$key.'_'.$i,
					'label' => $label,
					'class' => '', 
				));
				*/
			} 

			/*
			$structure_main_container = WPBC_get_layout_structure_main_container($WPBC_get_layout_locations[$key]['id']); 

			//$location_info = $key.'<br>';
			//$location_info .= 'max_content_areas: '.$max_content_areas.'<br>';
			$location_info .= 'id: '.$structure_main_container['id'].'<br>';
			$location_info .= 'content_areas: '.$structure_main_container['content_areas'].'<br>';

			$sub_fields[] = WPBC_acf_make_message_field(array(
				'key' => 'field_layout_location_info__'.$key,
				'label' => 'Info',
				'class' => '', 
				'message' => $location_info,
			));
			*/
		// $sub_fields = WPBC_acf_make_layout_sub_fields_groups('layout');

 	return $sub_fields;

}  


/* 

	Filter this options 

*/
 

add_filter('wpbc/filter/layout/location', function($layout, $template, $using_theme_settings, $using_page_settings){  

	$layout_settings = WPBC_get_theme_settings('layout__'.$template);
	if(!empty($layout_settings) && empty($using_page_settings)){
		$layout = $layout_settings['layout__location'];
	}

	return $layout;

},10,4);

add_filter('wpbc/filter/layout/container_type', function($container_type, $template, $using_theme_settings, $using_page_settings){

	$layout_settings = WPBC_get_theme_settings('layout__'.$template);
	if(!empty($layout_settings) && empty($using_page_settings)){
		$container_type = $layout_settings['layout__container_type'];
	}

	return $container_type;
},10,4);