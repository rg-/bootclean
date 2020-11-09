<?php

add_filter('WPBC_acf_builder_layouts', 'build_ui_tokko_searchform',10,1); 

function build_ui_tokko_searchform($layouts){

	$content_sub_fields = array();   

		$content_sub_fields[] = WPBC_acf_make_select_field(
			array(
				'name'=>'ui-tokko-searchform_linked_results',
				'label' => 'Results on:',
				'choices' => array(
					0 => 'This page',
					1 => 'Internal page', 
				),
				'default_value' => 0,
				'width' => '20%', 
			)
		);

		$content_sub_fields[] = WPBC_acf_make_post_object_field(array(
			'name' => 'ui-tokko-searchform_linked_results_page',
			'label' => 'linked_results_page',
			'post_type' => array('page'),
			'width' => '20%', 
			'multiple' => 0,
			'conditional_logic' => array (
					array (
						array (
							'field' => 'field_ui-tokko-searchform_linked_results',
							'operator' => '==',
							'value' => 1,
						),
					), 
				),
		)); 
 
		$content_sub_fields[] = WPBC_acf_make_text_field(array(
			'name' => 'ui-tokko-searchform_linked_results_id',
			'label' => 'linked_results_id',
			'width' => '20%', 
			'default_value' => '',
			'prepend' => '#',
			'append' => '',
		)); 

		$content_sub_fields[] = WPBC_acf_make_select_field(array(
			'name' => 'ui-tokko-searchform_template',
			'label' => 'Form Template', 
			'width' => '20%',  
			'choices' => array (),
			'default_value' => array (),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
		));

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => 'ui-tokko-searchform',
		'layout_label' => '<i class="dot-badge"></i> Tokko Search Form',
		'content_sub_fields' => $content_sub_fields,
		'hide_section_title' => true,
		'hide_call_to_action' => true, 
		//'hide_options_all' => true,
	), $layouts);

	return $layouts;

}




// ui-tokko-searchform_template
function WPBC_tokko_acf_searchform_template( $field ) { 
	$files = array(); 

	$temp_folder = 'wpbc_tokko/form';

	$temp_files = glob(CHILD_PATH.'/template-parts/'.$temp_folder.'/*.php');
	foreach($temp_files as $file) { 
		$file_slug = str_replace('.php', '', basename($file));
		$files[$file_slug] = array('name'=>basename($file),'file'=>$file_slug);
	} 
	$temp_files = glob(PARENT_PATH.'/template-parts/'.$temp_folder.'/*.php');
	foreach($temp_files as $file) { 
		$file_slug = str_replace('.php', '', basename($file));
		$files[$file_slug] = array('name'=>basename($file),'file'=>$file_slug);
	} 

	//$field['choices'][0] = 'Default';
	foreach($files as $item){  
		$field['choices'][$item['file']] = $item['name'];  
	}

	$field['default_value'] = 'default';

  return $field;	
} 
add_filter( 'acf/load_field/key=field_ui-tokko-searchform_template', 'WPBC_tokko_acf_searchform_template', 10, 4 );