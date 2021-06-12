<?php

// move to WPBC_acf_make_*

function WPBC_acf_make_section_title_field($sub_fields, $args){  

	$conditional_logic = array();

	$sub_fields[] = WPBC_acf_make_text_field(array(
		'name' => $args['layout_name'].'__section-title-use',
		'label' => !empty($args['label']) ? $args['label'] : _x('Use Section Title?','bootclean'), 
		'width' => '100%',
		'default_value' => 1,
		'readonly' => 1,
		'class' => 'wpbc-hidden-field'
	));

	if(empty($args['hide_use'])){

		$sub_fields[] = WPBC_acf_make_true_false_field(array(
			'name' => $args['layout_name'].'__section-title-use',
			'label' => !empty($args['label']) ? $args['label'] : _x('Use Section Title?','bootclean'), 
			'width' => '100%',
			'default_value' => 0,
			'class' => 'wpbc-acf-flex-field right-label wpbc-true_false-ui wpbc-ui-mini'
		));

		$conditional_logic = array (
						array (
							array (
								'field' => 'field_'.$args['layout_name'].'__section-title-use',
								'operator' => '==',
								'value' => '1',
							),
						), 
					);
	}

		$sub_fields[] = WPBC_acf_make_group_text_settings_field(
			array(
				'name' => $args['layout_name'].'__section-title-settings',
				'label'=> __('Title settings','bootclean'),  
				'width' => '100%', 
				'class' => 'wpbc-section-title-settings wpbc-tab-small acf-group-seamless wpbc-field-no-label wpbc-field-no-padding-top wpbc-field-no-padding-bottom',
				'hide_use' => $args['hide_use'],
				'hide_responsive' => $args['hide_responsive'],
				'hide_align' => $args['hide_align'],
				'hide_color' => !empty($args['hide_color']) ? true : false,
				'conditional_logic' => $conditional_logic,
			)
		); 

		$sub_fields[] = WPBC_acf_make_textarea_field(
			array(
				'name' => $args['layout_name'].'__section-title',
				'label'=> __('Section Title','bootclean'), 
				'class' => 'wpbc-section-title wpbc-field-no-label wpbc-field-no-padding-top wpbc-field-no-border-top',
				'placeholder' => __('Section Title','bootclean'),  
				'rows' => '2', 
				'width' => '100%',
				'new_lines' => 0,
				'conditional_logic' => $conditional_logic,
			)
		); 

	return $sub_fields;

}

function WPBC_get_layout_fields(){

	$fields = array();
	$fields = apply_filters('wpbc/filter/acf/builder/flexible_content/layouts', $fields);
	return $fields; 
	
}

function WPBC_get_flex_layout_cleaned( $oldArr, $prefix ) { 

 	$copyArr = $oldArr;

  if( is_array( $oldArr) && count( $oldArr ) ) {
      foreach ( $oldArr as $k => $v ) {

          unset($copyArr[$k]); // removes old entries
          $newKey = str_replace( $prefix, '', $k );

          if( is_array( $v ) ) {
  					$copyArr[ $newKey ] = WPBC_get_flex_layout_cleaned( $v, $prefix );
          }
          else {
           	$copyArr[ $newKey ] = $v;
          }
      }
      return $copyArr;
  }

}

function WPBC_get_flex_layout_settings(){
	$row = get_row();  
	if(!empty($row)){
		$row_index = get_row_index();
		$section_settings = WPBC_get_flex_layout($row);
		if(!empty($section_settings)){
			$section_settings['row_index'] = $row_index;
			return $section_settings;
		} 
	}
}

function WPBC_get_flex_layout($row=array()){ 

	if(!empty($row)){  

		$layout = $row['acf_fc_layout'];
		$p = '';

		$row_cleaned = WPBC_get_flex_layout_cleaned($row, 'field_'.$layout.'__');  

		$section_settings = !empty($row_cleaned[$p.'section_settings']) ? $row_cleaned[$p.'section_settings'] : array();

		$attr = $section_settings[$p.'attributes'];

			$id = !empty($attr[$p.'attributes_id']) ? $attr[$p.'attributes_id'] : $layout.'-'.uniqid(); 
			$class = !empty($attr[$p.'attributes_class']) ? $attr[$p.'attributes_class'] : '';
			$classes = !empty($attr[$p.'attributes_classes']) ? $attr[$p.'attributes_classes'] : '';
			$default = !empty($attr[$p.'attributes_default']) ? $attr[$p.'attributes_default'] : '';
			$container_class = !empty($attr[$p.'attributes_container_class']) ? $attr[$p.'attributes_container_class'] : '';
			$row_class = !empty($attr[$p.'attributes_row_class']) ? $attr[$p.'attributes_row_class'] : '';
			$column_class = !empty($attr[$p.'attributes_column_class']) ? $attr[$p.'attributes_column_class'] : '';
			$data = !empty($attr[$p.'attributes_data']) ? $attr[$p.'attributes_data'] : '';

		$class .= ' '.$layout;

		$section_styles = !empty($row_cleaned[$p.'section_styles']) ? $row_cleaned[$p.'section_styles'] : array(); 

			$background_color = $section_styles['section_styles_background_color'];
			if( !empty($background_color) ){
				$class .= ' bg-'.$background_color;
			}
			$text_color = $section_styles['section_styles_text_color'];
			if( !empty($text_color) ){
				$class .= ' text-'.$text_color;
			}


			$has_background = false;

			$images = $section_styles['section_styles_images'];
			$html = $section_styles['section_styles_html'];
			if( !empty($images) || !empty($html) ){
				$class .= ' has-background';
				$has_background = true;
			}

		$return_settings = array(

			'layout' => $layout,
			'id' => $id,
			'class' => $class,
			'classes' => $classes,
			'default' => $default, // bootstrap?
			'container_class' => $container_class,
			'row_class' => $row_class,
			'column_class' => $column_class,
			'data' => $data,

			'section_styles' => $section_styles,
			'has_background' => $has_background
		);

		return $return_settings;
	}

}

function WPBC_get_flex_layout_field($name=null, $row_passed=null){
	if(!empty($name)){

		if(!empty($row_passed)){
			$row = $row_passed;
		}else{
			$row = get_row();  
		}
		
		$layout = $row['acf_fc_layout'];
		// $Tlayout = apply_filters('wpbc/template/builder/layout', $layout);
		
		$prefix = 'field_'.$layout.'__';

		// $returned_field = $row[$prefix.'__'.$name];

		$row = WPBC_get_flex_layout_cleaned($row, $prefix);   
		if(!empty($row[$name])){
			return $row[$name];
		}

	}
}

/* TODO move to general.php */
function WPBC_acf_get_dynamic_params_choices(){
	$choices = array(
				'text' => __('Text','bootclean'),
				'html' => __('Html','bootclean'),
				'image' => __('Image','bootclean'),
				'gallery' => __('Gallery','bootclean'),
				'file' => __('File','bootclean'),
				'template' => __('Template','bootclean'),
				'post_object' => __('Post Object','bootclean'),
			);
	return $choices;
}

function WPBC_acf_get_dynamic_params_conditional_logic($layout_name=null,$value='text'){
	if(!empty($layout_name)){
		$conditional = array(
			array(
				array(
					'field' => 'field_'.$layout_name.'__param_type',
					'operator' => '==',
					'value' => $value,
				),
			), 
		);
		return $conditional;
	}
}

function WPBC_acf_get_dynamic_params_sub_fields($layout_name){ 

	$fields = array();

		$fields[] = WPBC_acf_make_select_field(array(
			'name' => $layout_name.'__param_type',
			'label' => __('Type','bootclean'), 
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0, 
			'choices' => WPBC_acf_get_dynamic_params_choices(),
			'width' => '20',
			'default_value' => array(
				0 => 'text',
			),
		)); 

		$fields[] = WPBC_acf_make_text_field(array(
			'name' => $layout_name.'__param_key',
			'label' => __('Key','bootclean'), 
			'width' => '20',
		));

		$fields[] = WPBC_acf_make_text_field(array(
			'name' => $layout_name.'__param_value_text',
			'label' => __('Value','bootclean'), 
			'width' => '60',
			'conditional_logic' => WPBC_acf_get_dynamic_params_conditional_logic($layout_name, 'text'),
		));

		$fields[] = WPBC_acf_make_textarea_field(array(
			'name' => $layout_name.'__param_value_html',
			'label' => __('Value','bootclean'), 
			'width' => '60',
			'conditional_logic' => WPBC_acf_get_dynamic_params_conditional_logic($layout_name, 'html'),
		));

		$fields[] = WPBC_acf_make_image_field(array(
			'name' => $layout_name.'__param_value_image',
			'label' => __('Value','bootclean'), 
			'width' => '60',
			'conditional_logic' => WPBC_acf_get_dynamic_params_conditional_logic($layout_name, 'image'),
			'return_format' => 'id',
		));

		$fields[] = WPBC_acf_make_gallery_advanced_field(array(
			'name' => $layout_name.'__param_value_gallery',
			'label' => __('Value','bootclean'), 
			'width' => '60',
			'conditional_logic' => WPBC_acf_get_dynamic_params_conditional_logic($layout_name, 'gallery'),
			'button_label' => __('Add image','bootclean'),
		));

		$fields[] = WPBC_acf_make_file_field(array(
			'name' => $layout_name.'__param_value_file',
			'label' => __('Value','bootclean'), 
			'width' => '60',
			'conditional_logic' => WPBC_acf_get_dynamic_params_conditional_logic($layout_name, 'file'),
			'return_format' => 'id',
		));

		$fields[] = WPBC_acf_make_post_object_wpbc_template(array(
			'name' => $layout_name.'__param_value_template',
			'label' => __('Value','bootclean'), 
			'width' => '60',
			'conditional_logic' => WPBC_acf_get_dynamic_params_conditional_logic($layout_name, 'template'),
			'return_format' => 'id',
		));

		$fields[] = WPBC_acf_make_post_object_field(array(
			'name' => $layout_name.'__param_value_post_object',
			'label' => __('Value','bootclean'), 
			'width' => '60',
			'conditional_logic' => WPBC_acf_get_dynamic_params_conditional_logic($layout_name, 'post_object'),
			'return_format' => 'id',
		));

	return $fields;


}


function WPBC_get_dynamic_params($row_passed=null){
	if(!empty($row_passed)){
		$row = $row_passed;
	}else{
		$row = get_row();  
	}

	$dynamic_params = WPBC_get_flex_layout_field('dynamic_params', $row); 
	$temp = array();
	if(!empty($dynamic_params)){
		foreach ($dynamic_params as $key => $value) {
			# code...
			$temp[$value['param_key']] = array(
				'type' => $value['param_type'],
				'value' => $value['param_value_'.$value['param_type']],
			);
		}
	}

	return $temp; 

}


function WPBC_get_dynamic_param($param_key=null, $value=true, $row_passed=null){
	if(!empty($param_key)){
		$dynamic_params = WPBC_get_dynamic_params($row_passed);
		if($value){
			return $dynamic_params[$param_key]['value']; 
		}else{
			return $dynamic_params[$param_key]; 
		}
		
	}
}


/* Front end */

function WPBC_get_slick_options($settings){
 
	$slick_options = array();

	$settings__options = $settings['settings__options'];

	// make array empty first
	$breakpoints = array();
	// get if exists more breakpoints
	$breakpoints = $settings__options['settings__options__breakpoints'];  
	// insert XS as first, this is very important
	if(!empty($breakpoints)){
		array_unshift($breakpoints,'xs'); 
	}else{
		$breakpoints = array('xs');
	}
	$default_options = WPBC_acf_get_slick_settings_options_defaults();

	//_print_code($settings__options);
	
	foreach ($settings__options as $key => $value) { 
		$new_key = str_replace('settings__options__', '', $key); 
		if (strpos($key, 'tab') !== false) { 
		}else{ 
			foreach ($breakpoints as $k=>$point) {
				if (strpos($new_key, $point) !== false) {
			     $new_key_ = str_replace($point.'__', '', $new_key);  
			     foreach ($default_options as $ok => $ov) { 
			     		if($ov['key'] == $new_key_){
			     			if($ov['type'] == 'true_false'){
			     				$value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
			     			}
			     			if($ov['type'] == 'number'){
			     				$value = intval($value);
			     			}
			     		} 
			     } 
			     $slick_options[$point][$new_key_] = $value;
				} 
			}
		}  
	}

  $first_option = reset($slick_options);
  $first_key = key($slick_options);  

	$slick = $first_option;

	$responsive = array();

	$root_breakpoint = BC_get_root_breakpoint(array('remove_units'=>true)); 

	foreach ($slick_options as $key => $value) {
		if($key!=$first_key){ 
			$n = $root_breakpoint[$key];  
			$responsive[] = array(
				'breakpoint' => $n,
				'settings' => $value,
			);
		}
	}
	if(!empty($responsive)){
		$slick['mobileFirst'] = true;
		$slick['responsive'] = array_reverse($responsive);
	}

	//$slick['slidesToShow'] = 3;
	//$slick['slidesToScroll'] = 1;

	$slick = json_encode($slick); 

	return $slick;

}


function WPBC_get_slick_heights($settings){

	$settings__use_heights = $settings['settings__use_heights'];

	$settings__heights = $settings['settings__heights'];

	$settings__options = $settings['settings__options'];

	/* TODO, this should be WPBC_acf_get_breakpoints() ?? */
	$breakpoints = $settings__options['settings__options__breakpoints'];
	$breakpoints = WPBC_acf_get_breakpoints(); 

	$slick_heights = array();
	
	if($settings__use_heights){ // ONLY FOR THIS, see: field_ui_layout_slick__settings__use_heights

		foreach ($settings__heights as $key => $value) { 
			foreach ($breakpoints as $k=>$v) {

				$point = $v['key_prefix'];

				if($key == 'settings__heights__'.$point && !empty($value) ){
					$slick_heights[$point]['default'] = $value.$settings__heights['settings__heights__'.$point.'_unit'];
				}
				if($key == 'settings__heights__'.$point.'_min' && !empty($value) ){
					$slick_heights[$point]['min'] = $value.$settings__heights['settings__heights__'.$point.'_unit_min'];
				}
				if($key == 'settings__heights__'.$point.'_max' && !empty($value) ){
					$slick_heights[$point]['max'] = $value.$settings__heights['settings__heights__'.$point.'_unit_max'];
				}
			}  
		} 

	}

	$slick_heights = json_encode($slick_heights);

	return $slick_heights;

}

function WPBC_acf_get_slick_heights($name){

	$root_breakpoint = BC_get_root_breakpoint();

	$responsive_tabs_groups = WPBC_acf_get_breakpoints();
	
	$sub_fields = array();
	foreach ($responsive_tabs_groups as $key => $value) {
		
		$sub_fields[] = WPBC_acf_make_tab_field(array(
			'key' => $name.'__tab_'.$value['key_prefix'],
			'placement' => 'top',
			'label' => $value['label'] . ' <small>' . $root_breakpoint[$value['key_prefix']] . '</small>', 
		)); 

		$default_value = '';
		$default_unit = 'px';

		if($value['key_prefix']=='xs'){
			$default_value = '100';
			$default_unit = 'wh';
		} 

		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => $name.'__'.$value['key_prefix'],
			'label' => $value['label'].' - '._x('Height','bootclean'),
			'default_value' => $default_value,
			'min' => '0',
			'width' => '20%',
			'class' => 'wpbc-ui-mini',
		));
		$sub_fields[] = WPBC_acf_make_radio_units_field(array(
			'name' =>  $name.'__'.$value['key_prefix'].'_unit', 
			'width' => '80%',  
			'default_value' => $default_unit, 
			));

		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => $name.'__'.$value['key_prefix'].'_min',
			'label' => $value['label'].' - '._x('Min-Height','bootclean'),
			'default_value' => $default_value,
			'min' => '0',
			'width' => '20%',
			'class' => 'wpbc-ui-mini',
		));
		$sub_fields[] = WPBC_acf_make_radio_units_field(array(
			'name' =>  $name.'__'.$value['key_prefix'].'_unit'.'_min', 
			'width' => '80%',  
			'default_value' => $default_unit, 
			));

		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => $name.'__'.$value['key_prefix'].'_max',
			'label' => $value['label'].' - '._x('Max-Height','bootclean'),
			'default_value' => $default_value,
			'min' => '0',
			'width' => '20%',
			'class' => 'wpbc-ui-mini',
		));
		$sub_fields[] = WPBC_acf_make_radio_units_field(array(
			'name' =>  $name.'__'.$value['key_prefix'].'_unit'.'_max', 
			'width' => '80%',  
			'default_value' => $default_unit, 
		));

	}
	return $sub_fields;
} 

function WPBC_acf_get_slick_options($name){

	$root_breakpoint = BC_get_root_breakpoint();

	$responsive_tabs_groups = WPBC_acf_get_breakpoints();

	$sub_fields = array();

	$breakpoints_choices = array();
	foreach ($responsive_tabs_groups as $key => $value) {
		if( 'xs' != $value['key_prefix'] ){
			$breakpoints_choices[$value['key_prefix']] = $value['key_prefix'] . ' <small>' . $root_breakpoint[$value['key_prefix']] . '</small>';
		}
	}

	$sub_fields[] = WPBC_acf_make_checkbox_field( array(
		'name' => $name.'__breakpoints',
		'label'=>  __('Responsive Breakpoints','bootclean'),
		'instructions' => __('Enable/Disable options for different breakpoints.','bootclean'),
		'width' => '100%', 
		'choices' => $breakpoints_choices,
		'default_value' => 'xs', 
		'class' => 'wpbc-radio-as-btn show-radio as-btn-sm as-btn-danger wpbc-acf-left-label', 
	) );    

	foreach ($responsive_tabs_groups as $key => $value) {
		
		$label = $value['label'] . ' <small>' . $root_breakpoint[$value['key_prefix']] . '</small>';
		$conditional_logic_tab = array (
				array (
					array (
						'field' => 'field_'.$name.'__breakpoints',
						'operator' => '==',
						'value' => $value['key_prefix'],
					),
				), 
			);
		if( 'xs' == $value['key_prefix'] ){
			$label = __('DEFAULTS','bootclean');
			$conditional_logic_tab = 0;
		}

		$sub_fields[] = WPBC_acf_make_tab_field(array(
			'key' => $name.'__tab_'.$value['key_prefix'],
			'placement' => 'top',
			'label' => $label, 
			'conditional_logic' => $conditional_logic_tab,
		));  


		/**/

		$basic_options = WPBC_acf_get_slick_settings_options_defaults_by(array(
			'dots','arrows','fade','vertical', 'infinite', 'adaptiveHeight',
			'slidesToShow', 'slidesToScroll', 'rows', 'slidesPerRow',
		));

		$advanced_options = WPBC_acf_get_slick_settings_options_defaults_by(array( 
			'autoplay', 'autoplaySpeed', 'speed', 
			'pauseOnFocus', 'pauseOnHover', 'pauseOnDotsHover',
			'draggable', 'initialSlide', 'verticalSwiping', 
		));

		foreach ($basic_options as $k => $v) {
			if( $v['type'] == 'true_false' ){
				$sub_fields[] = WPBC_acf_make_true_false_field(array(
					'label' => strtoupper($v['key']),
					'name' => $name.'__'.$value['key_prefix'].'__'.$v['key'], 
					'class' => 'wpbc-true_false-ui wpbc-ui-mini ui-danger',
					'width' => '15',
					'default_value' => $v['default'],
				));
			}

			if( $v['type'] == 'number' ){
				$sub_fields[] = WPBC_acf_make_number_field(array(
					'label' => strtoupper($v['key']),
					'name' => $name.'__'.$value['key_prefix'].'__'.$v['key'], 
					'class' => 'wpbc-ui-mini ui-danger',
					'width' => '15',
					'default_value' => $v['default'],
				));
			}

		} 

		$sub_fields[] = WPBC_acf_make_message_field(array(
					'message' => 'Advanced Options',
					'key' => $name.'__'.$value['key_prefix'].'__advanced_options_message',  
					'class' => 'wpbc-acf-no-label',
					'width' => '100', 
				));  

		foreach ($advanced_options as $k => $v) {
			if( $v['type'] == 'true_false' ){
				$sub_fields[] = WPBC_acf_make_true_false_field(array(
					'label' => strtoupper($v['key']),
					'name' => $name.'__'.$value['key_prefix'].'__'.$v['key'], 
					'class' => 'wpbc-true_false-ui wpbc-ui-mini ui-danger',
					'width' => '15',
					'default_value' => $v['default'],
				));
			}

			if( $v['type'] == 'number' ){
				$sub_fields[] = WPBC_acf_make_number_field(array(
					'label' => strtoupper($v['key']),
					'name' => $name.'__'.$value['key_prefix'].'__'.$v['key'], 
					'class' => 'wpbc-ui-mini ui-danger',
					'width' => '15',
					'default_value' => $v['default'],
				));
			}

		}
		 

	} 

	return $sub_fields;

}

function WPBC_acf_get_slick_item_type_options($name){

	$sub_fields = array();

	$types_choices = WPBC_acf_get_slick_types_choices();

	foreach ($types_choices as $key => $value) {
		$sub_fields[] = WPBC_acf_make_tab_field(array(
			'key' => $name.'__tab_'.$key,
			'placement' => 'top',
			'label' => $value,
		));
	}
 

	return $sub_fields;

}

function WPBC_get_template_part_content_path(){
	$temp_folder = '/content'; 
	return $temp_folder;
}





function WPBC_acf_get_responsive_tabs_content($name){ 

	$root_breakpoint = BC_get_root_breakpoint();

	$responsive_tabs_groups = WPBC_acf_get_breakpoints();
	
	$sub_fields = array();
	foreach ($responsive_tabs_groups as $key => $value) {
		
		$sub_fields[] = WPBC_acf_make_tab_field(array(
			'key' => $name.'__tab_'.$value['key_prefix'],
			'placement' => 'top',
			'label' => $value['label'] . ' <small>' . $root_breakpoint[$value['key_prefix']] . '</small>', 
		)); 

		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => $name.'__'.$value['key_prefix'],
			'label' => $value['label'].' - '._x('Height','bootclean'),
			'default_value' => '',
			'min' => '0',
			'width' => '20%',
			'class' => 'wpbc-ui-mini',
		));

	}

	return $sub_fields;
} 



add_filter( 'acf/load_field/type=select', function ( $field ) { 

	if(!empty($field['as_ui_layout_posts_advanced'])){
		
		$files = array();  
		$temp_folder = '/template-parts' . WPBC_get_template_part_content_path(); 
		if($field['as_ui_layout_posts_advanced'] == 2){
			 $temp_folder = $temp_folder.'/taxonomy';
		}
		$temp_files = glob(CHILD_PATH.$temp_folder.'/*.php');
	
		foreach($temp_files as $file) { 
			$file_slug = str_replace('.php', '', basename($file));
			$files[] = array('name'=>basename($file),'file'=>$file_slug);
		} 
		$temp_files = glob(PARENT_PATH.$temp_folder.'/*.php');
		foreach($temp_files as $file) { 
			$file_slug = str_replace('.php', '', basename($file));
			$files[] = array('name'=>basename($file),'file'=>$file_slug);
		} 
 
		foreach($files as $item){  
			$field['choices'][$item['file']] = $item['name'];  
		} 
		
		$field['instructions'] = __('Folder:','bootclean').' "'.$temp_folder.'"';

		$field['default_value'] = 'card'; 

	}
	  
  return $field;	

}, 10, 4 );


// see WPBC_get_layout_posts_page_settings
function WPBC_get_ui_layout_posts_advanced_args(){

	if(!empty($row_passed)){
		$row = $row_passed;
	}else{
		$row = get_row();  
	}
 
	$row_index = get_row_index(); 

	$post_types = WPBC_get_flex_layout_field('post_types', $row);

	if($post_types == 'post'){
		$row_id = 'ui_layout_posts_advanced-'.$row_index;
	}else{
		$row_id = 'ui_layout_'.$post_types.'_advanced-'.$row_index;
	}
	

	$style = WPBC_get_flex_layout_field('style', $row); 
	$style_options = WPBC_get_flex_layout_field('style_options', $row); 
		$style_args = array(); 
		foreach ($style_options as $key => $value) {
			$style_args[ str_replace('field_', '', $key) ] = $value;
		} 

	$query = WPBC_get_flex_layout_field('query', $row);   

	$pagination = WPBC_get_flex_layout_field('pagination', $row); 
	$pagination_args = array(); 
	if(!empty($pagination)){
		foreach ($pagination as $key => $value) {
			$pagination_args[ str_replace('field_', '', $key) ] = $value;
		}
	}
	

	$row_args = 'data-type="'.$style.'"';
	if($style == 'masonry'){  
		$row_args .= ' data-wpbc-masonry="cols" ';
		$style_args['row_class'] .= ' wpbc-masonry-row';
		$style_args['item_class'] .= ' wpbc-masonry-item';
	}
	$style_args['row_args'] = $row_args;

	$query_args = array(); 
	if(!empty($query)){
		foreach ($query as $key => $value) {
			$query_args[ str_replace('field_', '', $key) ] = $value;
		} 
	}

	if(is_front_page()){
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	}else{
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	}
	$query_args['paged'] = intval($paged);  


	$query_args = WPBC_get_layout_posts_query($query_args);

	$ui_layout_args = array(
		'paged' => $paged,
		'query' => $query_args,
		'style' => $style,
		'style_args' => $style_args,
		'pagination' => $pagination_args,
		'row_id' => $row_id,
	);

	return apply_filters('WPBC_get_ui_layout_posts_advanced_args', $ui_layout_args);
}