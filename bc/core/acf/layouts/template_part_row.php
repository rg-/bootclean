<?php

// Adding reusable field just in case, key__r_wpbc_template_part

function WPBC_acf_reusables_fields_part_args_sub_fields(){
	$sub_fields = array();
	return apply_filters('wpbc/acf/reusables/template_part_args/sub_fields', $sub_fields);
}

add_filter('WPBC_acf_reusables_fields', function($fields){ 

	/* 
	UNIQUE key please!! 
	*/ 

	$fields[] = array(
		'key' => 'key__r_wpbc_template_part',
		// 'label' => 'Content', // I dont need label, it´s a tab
		'name' => 'content',
		'type' => 'select',
		'instructions' => __('Files under "template-parts/theme/" folder. (php only)','bootclean'),
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'template_part_select',
			'id' => '',
		),
		'choices' => array (),
		'default_value' => array (),
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 0,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',

		'as_template_part_select' => 1 // Custom not ACF part
	); 
	$part_args_sub_fields = WPBC_acf_reusables_fields_part_args_sub_fields();

	$fields[] = array(
		'key' => 'key__r_wpbc_template_part_args_T',
		'label' => __('Template Content', 'bootclean'),
		'name' => 'template_part_args_T',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $part_args_sub_fields,
	);

	
	$fields[] = array(
		'key' => 'key__r_wpbc_template_part_args',
		'label' => __('Template Content', 'bootclean'),
		'name' => 'template_part_args',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $part_args_sub_fields,
	);
	
	
	/*

	Dynamic Template Arguments

	Enabled/Disabled by filter

	*/
	$use_builder_layout_row_data = true;
	$use_builder_layout_row_data = apply_filters('wpbc/acf/reusables/template_part_args/use_builder_layout_row_data', $use_builder_layout_row_data);
	if($use_builder_layout_row_data){  

		$fields[] = array(
			'key' => 'key__r_wpbc_template_args',
			'label' => __('Dynamic Template Arguments', 'bootclean'),
			'name' => 'args',
			'type' => 'repeater',
			'instructions' => 'Arguments passed will be accesible on template part file by: wpbc_get_template_part_row_args($args).',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => __('Add Argument','bootclean'),
			'sub_fields' => array (

				array (
					'key' => 'field_wpbc_template_args_type',
					'label' => 'Type',
					'name' => 'args_type',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '20',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'text' => __('Text','bootclean'),
						'html' => __('Html','bootclean'),
						'image' => __('Image','bootclean'),
						'file' => __('File','bootclean'),
					),
					'default_value' => array (
						0 => 'text',
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),

				array (
					'key' => 'field_wpbc_template_args_key',
					'label' => 'Key',
					'name' => 'args_key',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '20',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'default',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),

				/* ------ */
				

				array (
					'key' => 'field_wpbc_template_args_value',
					'label' => 'Value',
					'name' => 'args_value',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_template_args_type',
								'operator' => '==',
								'value' => 'text',
							),
						), 
					),
					'wrapper' => array (
						'width' => '60',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'default',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),

				array (
					'key' => 'field_wpbc_template_args_value__html',
					'label' => 'Value',
					'name' => 'args_value___html',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_template_args_type',
								'operator' => '==',
								'value' => 'html',
							),
						), 
					),
					'wrapper' => array (
						'width' => '60',
						'class' => 'codemirror-custom-field md',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),

				array (
					'key' => 'field_wpbc_template_args_value__image',
					'label' => __('Image','bootclean'),
					'name' => 'args_value__image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_template_args_type',
								'operator' => '==',
								'value' => 'image',
							),
						), 
					),
					'wrapper' => array (
						'width' => '60',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'id',
					'preview_size' => 'thumbnail',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),

				array(
					'key' => 'field_wpbc_template_args_value__file',
					'label' => __('File','bootclean'),
					'name' => 'args_value__file',
					'type' => 'file',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_template_args_type',
								'operator' => '==',
								'value' => 'file',
							),
						), 
					),
					'wrapper' => array (
						'width' => '60',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'id',
					'library' => 'all',
					'min_size' => '',
					'max_size' => '',
					'mime_types' => '',
				),

				/* ------ */

			),
		);
	} // if enabled by filter END 
	// Dynamic Template Arguments END

	return $fields;

}, 10, 1);

function WPBC_acf_get_template_part_folder(){
	$temp_folder = 'theme';
		$temp_folder = apply_filters('wpbc/acf/template_parts_select/folder', $temp_folder);
		return $temp_folder; 
}

function WPBC_acf_as_template_part_select( $field ) { 
	if( !empty( $field['as_template_part_select'] ) ){ 
		$files = array(); 

		$temp_folder = WPBC_acf_get_template_part_folder();

		$temp_files = glob(MAIN_THEME_PATH.'/template-parts/'.$temp_folder.'/*.php');
		foreach($temp_files as $file) { 
			$file_slug = str_replace('.php', '', basename($file));
			$files[] = array('name'=>basename($file),'file'=>$file_slug);
		} 
		$field['choices'][0] = 'None';
		foreach($files as $item){  
			$field['choices'][$item['file']] = $item['name'];  
		} 
	}
    return $field;	
} 
add_filter( 'acf/load_field/type=select', 'WPBC_acf_as_template_part_select', 10, 4 );


function WPBC_group_builder__layout_template_part_row_clone($clone = array()){  

	$clone = array(
		0 => 'key__r_tab__content',
		1 => 'key__r_wpbc_template_part', // The reusable added
		2 => 'key__r_wpbc_template_part_args', // The reusable added
		3 => 'key__r_wpbc_template_args', // The reusable added
		4 => 'key__r_tab__settings',
		5 => 'key__r_builder_classes_group',
		6 => 'key__r_tab__advanced',
		7 => 'key__r_wpbc__advanced_group_inview', 
	);

	return apply_filters('WPBC_group_builder__layout_template_part_row_clone', $clone);
}

add_filter('WPBC_acf_builder_layouts', function($layouts){

	$layouts['layout_template_part_row'] =  array(
		'key' => 'layout_template_part_row',
		'name' => 'template_part_row',
		'label' => '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path class="path" fill="#fff" d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg></i>'.' template-parts/theme',
		'display' => 'block',
		'sub_fields' => array(
			array(
				'key' => 'key__layout_template_part_row__content',
				'label' => 'Content',
				'name' => 'content',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => WPBC_group_builder__layout_template_part_row_clone(),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;

},10,1); 


function WPBC_get_builder_layout_row_data($p, $layout_count=0, $part=''){

	if(is_array($p)){
	 	$post_id = isset($p['template_post_id']) ? $p['template_post_id'] : $p['post_id'];
		$layout_count = $p['layout_count'];
	}else{
		$post_id = $p;
		$layout_count = $layout_count; 
	}  
	if( isset($_GET['template_id']) && isset($_GET['layout_count']) ){
		$post_id = $_GET['template_id'];
		$layout_count = $_GET['layout_count'];  

	}

	$fields = get_fields($post_id); 

	/*

	$part can be

		acf_fc_layout
		content
		args
		r_builder_classes_group

		r_wpbc__advanced_group_inview

	*/

	if( !empty($fields) && !empty($fields['content_rows'][$layout_count]) ){

		$content_row = $fields['content_rows'][$layout_count];  

		if(!empty($content_row)){
			if($part && !empty($content_row[$part]) ){
				$r = $content_row[$part];
			}else{ 
				$r = $content_row;
			}
			$r['post_id'] = $post_id; 
			$r['layout_count'] = $layout_count; 
			return $r;
		} 
		
	}
}

function wpbc_get_template_part_row_args($ar=''){

	if(!empty($ar)){

		/*

		OLD way that will not work on ajax calls.

		*/

		return wpbc_get_template_part_row_template_args($ar);

	} else {

		/*

		This one will work when receiving $_GET parameters from ajax calls too

		*/
		$post_id = $_GET['post_id'];
		$layout_count = $_GET['layout_count']; 
		$fields = get_fields($post_id); 
		$passed_args = array(); 
		// $content_row = WPBC_get_builder_layout_row_data($post_id, $layout_count);
		if( !empty($fields) && !empty($fields['content_rows'][$layout_count]) ){

			$content_row = $fields['content_rows'][$layout_count]; 
 
			if(!empty($content_row)){
				$this_template_args = $content_row['args']; 
				foreach ($this_template_args as $k => $v) {
					if($v['args_type'] == 'text') $passed_args[$v['args_key']] = $v['args_value'];
					if($v['args_type'] == 'image') $passed_args[$v['args_key']] = $v['args_value__image'];
					if($v['args_type'] == 'file') $passed_args[$v['args_key']] = $v['args_value__file'];
					if($v['args_type'] == 'html') $passed_args[$v['args_key']] = $v['args_value___html'];
				} 
			}
			$passed_args = apply_filters('wpbc/get/template/part/row/template_args', $passed_args, $post_id); 
			//return($passed_args);

			return $passed_args;
			
			//return $fields['content_rows'][$layout_count]['args'];
			
		}

	}

	

	// echo "<code>INSIDE FUNCTION: </code>".$post_id;

}

function wpbc_get_template_part_row_template_args($args){
	$passed_args = array();

	extract($passed_args);
	
	$post_id = $args["template_post_id"]; 
	$this_template_args = get_sub_field('key__layout_template_part_row__content_'.'key__r_wpbc_template_args', $post_id);
	if(!empty($this_template_args)){
		foreach ($this_template_args as $key => $value) {  
			if($value['field_wpbc_template_args_type'] == 'text'){
				$v = $value['field_wpbc_template_args_value'];
			}
			if($value['field_wpbc_template_args_type'] == 'image'){
				$v = $value['field_wpbc_template_args_value__image'];
			}
			if($value['field_wpbc_template_args_type'] == 'file'){
				$v = $value['field_wpbc_template_args_value__file'];
			}
			if($value['field_wpbc_template_args_type'] == 'html'){
				$v = $value['field_wpbc_template_args_value__html'];
			} 
			$passed_args[$value['field_wpbc_template_args_key']] = $v;
		} 
	}
	$passed_args = apply_filters('wpbc/get/template/part/row/template_args', $passed_args, $post_id); 
	return $passed_args;
}
