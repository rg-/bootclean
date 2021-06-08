<?php



add_filter('WPBC_group_builder__layout_posts_page', function($fields){
	 
	/*
	$fields[] = WPBC_acf_make_tab_field(array(
		'key' => 'layout_posts_page__tab',
		'label' => 'General Settings',
		'placement' => 'top', 
	));
	$fields[] = WPBC_acf_make_message_field(array(
		'key' =>  'layout_posts_page__message',
		'message' => 'Choose how your post will look like. This settings will not apply on single posts pages.'
	));
	$content_sub_fields = WPBC_acf_make_layout_posts_advanced('layout_posts_page', true);
	foreach ($content_sub_fields as $key => $value) {
		$fields[] = $value;
	}
	*/

	$layout_header_templates = WPBC_layout_posts_page_templates();

	foreach ($layout_header_templates as $key => $value) {
		
		$fields[] = WPBC_acf_make_tab_field(array(
			'key' => 'layout_header_template_'.$value['key'].'__tab',
			'label' => $value['label'],
			'placement' => 'top',
		));

			$fields[] = WPBC_acf_make_radio_field(array(
				'name' => 'layout_header_template_'.$value['key'].'__type',
				'label' => 'Page Header Type', 
				'choices' => array (
					'none' => 'None',
					'page_settings' => 'Same as this page',
					'template' => 'Template'
				),
				'default_value' => 'none',
				'width' => '50%',
				'class' => 'wpbc-radio-as-btn show-radio'
			)); 

			$fields[] = WPBC_acf_make_select_field(array(
				'name' => 'layout_header_template_'.$value['key'].'',
				'label' => 'Page Header Template',
				'width' => '50%',
				'allow_null' => 1, 
				'ui' => 1, 
				'return_format' => 'value',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_layout_header_template_'.$value['key'].'__type',
							'operator' => '==',
							'value' => 'template',
						),
					), 
				),
			)); 

			$content_areas = WPBC_get_main_container_max_content_areas();

			for ($i=1; $i < $content_areas; $i++) { 

				$fields[] = WPBC_acf_make_message_field(array(
					'key' => 'field_layout_secondary_content_'.$value['key'].'__message_'.$i,
					'label' => 'Secondary Content Area '.$i.' Type', 
					'width' => '100%',

					'show_if' => $i,
				));

				$fields[] = WPBC_acf_make_radio_field(array(
					'name' => 'layout_secondary_content_'.$value['key'].'__type_'.$i,
					'label' => 'Secondary Content Area '.$i.' Type', 
					'choices' => array (
						'none' => 'None',
						'page_settings' => 'Same as this page',
						'template' => 'Template',
						'widget_area' => 'Widget Area'
					),
					'default_value' => 'none',
					'width' => '70%',
					'class' => 'wpbc-radio-as-btn show-radio wpbc-acf-no-label',

					'show_if' => $i,
				));

				$fields[] = WPBC_acf_make_post_object_wpbc_template(array(
					'name' => 'layout_secondary_content_'.$value['key'].'_'.$i,
					'label' => 'Secondary Content Area '.$i.' Template',
					'width' => '30%',
					'allow_null' => 1, 
					'ui' => 1, 
					'return_format' => 'id',
					'class' => 'wpbc-acf-no-label',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_layout_secondary_content_'.$value['key'].'__type_'.$i,
								'operator' => '==',
								'value' => 'template',
							),
						), 
					),

					'show_if' => $i,
				)); 

				$fields[] = WPBC_acf_make_select_widgets_areas_field(array(
					'label' => 'Choose Widget Area',
					'name' => 'layout_secondary_content_'.$value['key'].'__widget_area_'.$i,
					'class' => 'wpbc-acf-no-label',
					'width' => '30%',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_layout_secondary_content_'.$value['key'].'__type_'.$i,
								'operator' => '==',
								'value' => 'widget_area',
							),
						), 
					),

					'show_if' => $i,
				)); 

			} 

	} 
	
	return $fields;

},10,1);  


if( function_exists('acf_add_local_field_group') ){

	$WPBC_group_builder__layout_posts_page = WPBC_group_builder__layout_posts_page(); 
	$WPBC_group_builder__layout_posts_page_locations = array( 
		array(
			array(
				'param' => 'page_type',
				'operator' => '==',
				'value' => 'posts_page',
			), 
		),
	); 

	acf_add_local_field_group(array( 
		'key' => 'group_builder__layout_posts_page',
		'title' => 'Posts & Archive Layout Settings',
		'fields' => $WPBC_group_builder__layout_posts_page,
		'location' => $WPBC_group_builder__layout_posts_page_locations,
		'menu_order' => 4,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => ( !empty( $WPBC_group_builder__layout_posts_page ) ? 1 : 0 ),
		'description' => '',
	)); 


	add_filter('WPBC_group_builder__admin_styles', function($groups){
		$groups[] = '#acf-group_builder__layout_posts_page';
		return $groups;

	},10,1);

}  

add_filter('acf/prepare_field', function($field){
	$return = true;
	$page_for_posts = get_option( 'page_for_posts' );
	if( !empty($_GET['post']) && $_GET['post'] == $page_for_posts){

		if(!empty($field['show_if'])){

			

			$page_for_posts = get_option( 'page_for_posts' );
			$layout = WPBC_get_layout_structure_build_layout($page_for_posts);   
			$layout_defaults = WPBC_layout_struture__defaults(); 
			$content_areas = $layout_defaults['main_container'][$layout]['content_areas'];

			$field['label'] .= ' show_if: '.$field['show_if'] . ' content_areas: ' . $content_areas;

			if($content_areas == 1){
				if( $field['show_if'] == 1 || $field['show_if'] == 2 ){
					$return = false;
				}
			}
			if($content_areas == 2){
				if( $field['show_if'] == 2 ){
					$return = false;
				}
			}
			if($content_areas == 3){

			}

			}
			
	}

	if($return){
		return $field;
	}else{
		return false;
	}

},10,1);  



/* 
	
	Debug thigs using this:

*/
add_action('wpbc/layout/start', function($out){


},10,1); 