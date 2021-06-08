<?php

function WPBC_acf_make_select_template_part_field($args,$is_registered_option=false){
	if(empty($args['name'])) return;

	$choices = array();

	$files = array();  
	$temp_folder = 'theme'; 
	$temp_files = glob(MAIN_THEME_PATH.'/template-parts/'.$temp_folder.'/*.php');

	foreach($temp_files as $file) { 
		$file_slug = str_replace('.php', '', basename($file));
		$files[] = array('name'=>basename($file),'file'=>$file_slug);
	} 

	$choices[0] = 'None';
	foreach($files as $item){  
		$choices[$item['file']] = $item['name'];  
	} 

	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Select Field',
		'name' => 'select_field',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => $choices,
		'default_value' => array (),
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 0,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',
	);
	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;
}