<?php

function WPBC_template_export_installed(){
	$template_export = apply_filters('wpbc/filter/template_export/installed', 0);
	return $template_export;
}

function wpbc_template_export_code(){

	// http://findnerd.com/list/view/Export-Post-Data-into-json-file-and-Import-Post-into-other-website-/22524/

	if(!empty($_GET['post'])){

		$id = $_GET['post'];
		$data = get_post_meta($id);
  	$post = get_post($id);
		
		$out = ''; 

		ob_start();
		$temp_post = array(
			'post_title' => $post->post_title,
			'post_status' => 'draft',
			'post_type' => $post->post_type,
		);
		
		$temp_data = array();
		foreach ($data as $key => $value) {
			$temp_data[$key] = $value;
		}
		$temp_post['meta_input'] = $temp_data; 

		$out = ob_get_contents();
		ob_end_clean();

		$encoded = htmlspecialchars(json_encode($temp_post), ENT_QUOTES, 'UTF-8');

		$out = '<textarea rows="6" id="wpbc_template_export_code_JSON_META">'.$encoded.'</textarea>'; 

		return $out;

	} 

}

if( function_exists('acf_add_local_field_group') && WPBC_template_export_installed() ){

	acf_add_local_field_group(array(
	'key' => 'group_wpbc_template_export',
	'title' => 'Export',
	'fields' => array( 
		array (
			'key' => 'field_wpbc_template_export_code',
			'label' => __('Export JSON Code','bootclean'),
			'name' => 'wpbc_template_export_code',
			'type' => 'message',
			'message' => wpbc_template_export_code(),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			), 
		),
	), 
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'wpbc_template',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 100,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

}