<?php
add_filter('WPBC_acf_reusables_fields', function($fields){
	$fields[] = array(
		'key' => 'key__r_slider_item',
		'label' => 'Item',
		'name' => 'r_slider_item',
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
		'sub_fields' => array ( 
		  
			array(
				'key' => 'key__r_slider_item__image',
				'label' => 'Slide Image',
				'name' => 'slider_item_image',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '30%',
					'class' => '',
					'id' => '',
				),
				'clone' => array(
					0 => 'key__r_background_image',
				),
				'display' => 'group',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
			
			array(
				'key' => 'key__r_slider_item__caption',
				'label' => 'Caption Content',
				'name' => 'slider_item_caption',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '70%',
					'class' => '',
					'id' => '',
				),
				'clone' => array(
					0 => 'key__r_slider_html_code',
				),
				'display' => 'group',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			), 
			
			array (
				'key' => 'key__r_slider_item__type',
				'label' => 'Item Type',
				'name' => 'r_slider_item__type',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '20%',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'inline' => 'Image Inline',
					'cover' => 'Image Cover',
				),
				'default_value' => array (
					'inline' => 'Image Inline',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			
			array (
				'key' => 'key__r_slider_item__class',
				'label' => 'Item > Container > Caption class',
				'name' => 'r_slider_item__class',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '40%',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array (
				'key' => 'key__r_slider_item__class_add',
				'label' => 'Replace custom class',
				'name' => 'r_slider_item__class_add',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '40%',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => 'Yes',
				'ui_off_text' => 'No',
			),
			
		),
	);
	return $fields;
},10, 1);

add_filter('WPBC_acf_reusables_fields', function($fields){
	$fields[] = array(
			'key' => 'key__r_slider_breakpoint_heights',
			'label' => 'Slider Sizes',
			'name' => 'r_slider_breakpoint_heights',
			'type' => 'textarea',
			'instructions' => 'Json format: {
		"xs":{"default":"200px"},
		"sm":{"default":"300px"},
		"md":{"default":"400px"},
		"lg":{"default":"790px","min":"400px","max":"1400px"},
		"xl":{"default":"790px","min":"500px","max":"1400px"}
		}',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => 'html_code',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		);
	return $fields;
},20, 1);

add_filter('WPBC_acf_reusables_fields', function($fields){

	$sub_fields = array();


		$responsive_tabs_groups = array(
			
			array(
				'key_prefix' => 'xs',
				'label' => 'XS'
			),
			array(
				'key_prefix' => 'sm',
				'label' => 'SM'
			),
			array(
				'key_prefix' => 'md',
				'label' => 'MD'
			),
			array(
				'key_prefix' => 'lg',
				'label' => 'LG'
			),
			array(
				'key_prefix' => 'xl',
				'label' => 'XL'
			),

		);

	foreach ($responsive_tabs_groups as $key => $value) {
		$sub_fields[] = WPBC_acf_make_tab_field(array(
			'key' => 'r_slider_breakpoint_heights_args_tab_'.$value['key_prefix'], 'placement' => 'top', 'label' => $value['label'],
		)); 

		$default_value = '';
		$default_unit = 'px';

		if($value['key_prefix']=='xs'){
			$default_value = '100';
			$default_unit = 'wh';
		}

		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => 'r_slider_breakpoint_heights_args_'.$value['key_prefix'],
			'label' => $value['label'].' - '._x('Height','bootclean'),
			'default_value' => $default_value,
			'min' => '0',
			'width' => '20%',
		));
		$sub_fields[] = WPBC_acf_make_radio_field(array(
			'name' => 'r_slider_breakpoint_heights_args_'.$value['key_prefix'].'_unit',
			'label' => _x('Units','bootclean'),
			'width' => '80%',
			'choices' => array (
				'px' => 'px',
				'%' => '%',
				'vh' => 'vh',
				'wh' => 'wh', 
			),
			'class' => 'wpbc-radio-as-btn',
			'default_value' => $default_unit,
			));
		
		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => 'r_slider_breakpoint_heights_args_min_'.$value['key_prefix'],
			'label' => $value['label'].' - '._x('Min-Height','bootclean'),
			'default_value' => $default_value,
			'min' => '0',
			'width' => '20%',
		));
		$sub_fields[] = WPBC_acf_make_radio_field(array(
			'name' => 'r_slider_breakpoint_heights_args_min_'.$value['key_prefix'].'_unit',
			'label' => _x('Units','bootclean'),
			'width' => '80%',
			'choices' => array (
				'px' => 'px',
				'%' => '%',
				'vh' => 'vh',
				'wh' => 'wh', 
			),
			'class' => 'wpbc-radio-as-btn',
			'default_value' => $default_unit,
			));

		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => 'r_slider_breakpoint_heights_args_max_'.$value['key_prefix'],
			'label' => $value['label'].' - '._x('Max-Height','bootclean'),
			'default_value' => $default_value,
			'min' => '0',
			'width' => '20%',
		));
		$sub_fields[] = WPBC_acf_make_radio_field(array(
			'name' => 'r_slider_breakpoint_heights_args_max_'.$value['key_prefix'].'_unit',
			'label' => _x('Units','bootclean'),
			'width' => '80%',
			'choices' => array (
				'px' => 'px',
				'%' => '%',
				'vh' => 'vh',
				'wh' => 'wh', 
			),
			'class' => 'wpbc-radio-as-btn',
			'default_value' => $default_unit,
			));

	}

 
		 

	$fields[] = array (
		'key' => 'key__r_slider_breakpoint_heights_args',
		'label' => _x('Slider Responsive Heights','bootclean'),
		'name' => 'r_slider_breakpoint_heights_args',
		'type' => 'group',
		'value' => NULL,
		'instructions' => _x('Use only XS for all breakpoints (Bootstrap) .','bootclean'),
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-tabsless-group',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $sub_fields,
	);

	return $fields;
},20, 1);

add_filter('WPBC_acf_reusables_fields', function($fields){
	$fields[] = array(
			'key' => 'key__r_slider_breakpoint_enable',
			'label' => 'Slider Enable/Disable',
			'name' => 'r_slider_breakpoint_enable',
			'type' => 'textarea',
			'instructions' => 'Json format: { "xs":1, "sm":0 }',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => 'html_code',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		);
	return $fields;
},30, 1);

add_filter('WPBC_acf_reusables_fields', function($fields){
	$fields[] = array(
			'key' => 'key__r_slider_settings_args',
			'label' => 'Slider settings Args',
			'name' => 'r_slider_settings_args',
			'type' => 'group',
			'sub_fields' => WPBC_group_builder__slider_settings_args(),
		);
	return $fields;
},40, 1);

/*

	WPBC_group_builder__slider

*/

function WPBC_group_builder__slider($fields = array()){  
	return apply_filters('WPBC_group_builder__slider', $fields);
}

add_filter('WPBC_group_builder__slider', function($fields){
	  
	$fields[] = array(
		'key' => 'key__slider__slider_items',
		'label' => 'Items',
		'name' => 'slider_items',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 0,
		'max' => 0,
		'layout' => 'block',
		'button_label' => 'Add item',
		'sub_fields' => array(
			array(
				'key' => 'key__slider__slider_items__item',
				'label' => 'Item',
				'name' => 'item',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => array(
					//0 => 'key__r_html_code',
					0 => 'key__r_slider_item',
				),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
		),
	);

	return $fields;
}, 10, 1); 

add_filter('WPBC_group_builder__slider', function($fields){

	$fields[] = array(
		'key' => 'key__slider__slider_settings_tab',
		'label' => 'Slider Settings',
		'name' => 'slider_settings_tab',
		'type' => 'tab'
	);

	$fields[] = array (
		'key' => 'key__slider__classes',
		'label' => 'Slider Classes',
		'name' => 'slider__classes',
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
		'sub_fields' => array (
		
			array (
				'key' => 'key__slider__classes_item_container',
				'label' => 'Slider Class',
				'name' => 'slider__classes_item_container',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50%',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '> +',
				'append' => '',
				'maxlength' => '',
			),
			
			array (
				'key' => 'key__slider__classes_item_content',
				'label' => 'Item > Container > Caption class',
				'name' => 'slider__classes_item_content',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50%',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'd-flex justify-content-center align-items-center',
				'placeholder' => '',
				'prepend' => '> +',
				'append' => '',
				'maxlength' => '',
			),
		
		),
	);

	return $fields;
}, 20, 1); 

add_filter('WPBC_group_builder__slider', function($fields){

	global $WPBC_VERSION; 
	if ( version_compare( $WPBC_VERSION, '10.0.0', '>' ) ) {
		$cloned = array( 
			//0 => 'key__r_slider_settings',
			1 => 'key__r_slider_settings_args',
		);
	}else{
		$cloned = array( 
			1 => 'key__r_slider_settings_args',
		);
	}

	$fields[] = array(
		'key' => 'key__slider__slider_items__slider_settings',
		'label' => 'Settings',
		'name' => 'slider_settings',
		'type' => 'clone',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'clone' => $cloned,
		'display' => 'seamless',
		'layout' => 'block',
		'prefix_label' => 0,
		'prefix_name' => 0,
	);

	return $fields;
}, 30, 1); 

add_filter('WPBC_group_builder__slider', function($fields){

	global $WPBC_VERSION; 
	if ( version_compare( $WPBC_VERSION, '10.0.0', '>' ) ) {
		$cloned = array( 
			//0 => 'key__r_slider_settings',
			1 => 'key__r_slider_breakpoint_heights_args',
		);
	}else{
		$cloned = array( 
			1 => 'key__r_slider_breakpoint_heights',
		);
	}
	
	$fields[] = array(
		'key' => 'key__slider__slider_items__slider_breakpoint_heights',
		'label' => 'Breakpoint Sizes',
		'name' => 'slider_breakpoint_heights',
		'type' => 'clone',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'clone' => $cloned,
		'display' => 'seamless',
		'layout' => 'block',
		'prefix_label' => 0,
		'prefix_name' => 0,
	);
	return $fields;
}, 40, 1); 

add_filter('WPBC_group_builder__slider', function($fields){

	$fields[] = array(
		'key' => 'key__slider__slider_items__slider_breakpoint_enable',
		'label' => 'Breakpoint Enable',
		'name' => 'slider_breakpoint_enable',
		'type' => 'clone',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'clone' => array(
			0 => 'key__r_slider_breakpoint_enable',
		),
		'display' => 'seamless',
		'layout' => 'block',
		'prefix_label' => 0,
		'prefix_name' => 0,
	);
	return $fields;
}, 50, 1); 


/*
	#Slider Group 
*/ 


if( function_exists('acf_add_local_field_group') ){ 
	
	$WPBC_group_builder__slider = WPBC_group_builder__slider(); 
	$WPBC_group_builder__slider_locations = array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'wpbc_template',
			),
			array(
				'param' => 'post_taxonomy',
				'operator' => '==',
				'value' => 'wpbc_template_type:slider',
			),
		),
	); 
	acf_add_local_field_group(array(
		'key' => 'group_builder__slider',
		'title' => 'Slider Items',
		'fields' => $WPBC_group_builder__slider, 
		'location' => $WPBC_group_builder__slider_locations,
		'menu_order' => 3,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
		),
		'active' => 1,
		'description' => '',
	));
	
	// #Slider Group <<<
}


/*
 * builder__slider_settings_args
*/   
 
function WPBC_group_builder__slider_settings_args($fields = array()){  
	return apply_filters('WPBC_group_builder__slider_settings_args', $fields);
}

function WPBC_get_slick_default_args(){
	$default_args = array(

		array(
			'key'=> 'accessibility',
			'type'=> 'true_false',
			'default'=> 1
		),

		array(
			'key'=> 'adaptiveHeight',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'autoplay',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'autoplaySpeed',
			'type'=> 'number',
			'default'=> '3000'	
		),

		array(
			'key'=> 'arrows',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'asNavFor',
			'type'=> 'text',
			'default'=> ''	
		),

		array(
			'key'=> 'appendArrows',
			'type'=> 'text',
			'default'=> '$(element)'	
		),

		array(
			'key'=> 'appendDots',
			'type'=> 'text',
			'default'=> '$(element)'	
		),

		array(
			'key'=> 'prevArrow',
			'type'=> 'text',
			'default'=> '<button type="button" class="slick-prev">Previous</button>'	
		),

		array(
			'key'=> 'nextArrow',
			'type'=> 'text',
			'default'=> '<button type="button" class="slick-next">Previous</button>'	
		),

		array(
			'key'=> 'centerMode',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'centerPadding',
			'type'=> 'text',
			'default'=> '50px'	
		),

		array(
			'key'=> 'cssEase',
			'type'=> 'text',
			'default'=> 'ease'	
		),

		array(
			'key'=> 'customPaging',
			'type'=> 'text',
			'default'=> 'n/a'	
		),

		array(
			'key'=> 'dots',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'dotsClass',
			'type'=> 'text',
			'default'=> 'slick-dots'	
		),

		array(
			'key'=> 'draggable',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'fade',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'focusOnSelect',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'easing',
			'type'=> 'text',
			'default'=> 'linear'	
		),

		array(
			'key'=> 'edgeFriction',
			'type'=> 'number',
			'default'=> '0.15',
			'step'=> '0.01'	
		),

		array(
			'key'=> 'infinite',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'initialSlide',
			'type'=> 'number',
			'default'=> '0', 
		),

		array(
			'key'=> 'lazyLoad',
			'type'=> 'select',
			'default'=> 'ondemand',
			'choices' => array (
				'ondemand' => 'ondemand',
				'progressive' => 'progressive',
			),
		),

		array(
			'key'=> 'mobileFirst',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'pauseOnFocus',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'pauseOnHover',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'pauseOnDotsHover',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'respondTo',
			'type'=> 'text',
			'default'=> 'window'	
		),

		array(
			'key'=> 'rows',
			'type'=> 'number',
			'default'=> '1', 
		),

		array(
			'key'=> 'slide',
			'type'=> 'text',
			'default'=> "''"	
		),

		array(
			'key'=> 'slidesPerRow',
			'type'=> 'number',
			'default'=> '1', 
		),

		array(
			'key'=> 'slidesToShow',
			'type'=> 'number',
			'default'=> '1', 
		),

		array(
			'key'=> 'slidesToScroll',
			'type'=> 'number',
			'default'=> '1', 
		),

		array(
			'key'=> 'speed',
			'type'=> 'number',
			'default'=> '300', 
		),

		array(
			'key'=> 'swipe',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'swipeToSlide',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'touchMove',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'touchThreshold',
			'type'=> 'number',
			'default'=> '5', 
		),

		array(
			'key'=> 'useCSS',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'useTransform',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'variableWidth',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'vertical',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'verticalSwiping',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'rtl',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'waitForAnimate',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'zIndex',
			'type'=> 'number',
			'default'=> '1000', 
		),

	);
	return $default_args;
}

add_filter('WPBC_group_builder__slider_settings_args', function($fields){

	// http://kenwheeler.github.io/slick/

	$default_args = WPBC_get_slick_default_args();
	
	foreach ($default_args as $arg) {
		if( $arg['type'] == 'true_false' ){
			$fields[] = array (
				'key' => 'field_slider_args__'.$arg['key'], 
				'name' => 'slider_args__'.$arg['key'],
				'type' => 'true_false', 
				'wrapper' => array (
					'width' => '25',
					'class' => 'wpbc-true_false-ui ui-primary', 
				),
				'message' => $arg['key'],
				'default_value' => $arg['default'],
				'ui' => 1, 
			);
		}
	}
	foreach ($default_args as $arg) {
		if( $arg['type'] == 'number' ){
			$fields[] = array (
				'key' => 'field_slider_args__'.$arg['key'], 
				'name' => 'slider_args__'.$arg['key'],
				'type' => 'number', 
				'wrapper' => array (
					'width' => '25',
					'class' => '', 
				),
				'prepend' => $arg['key'],
				'default_value' => $arg['default'], 
				'step' => !empty($arg['step']) ? $arg['step'] : '',
			);
		}
	}
	foreach ($default_args as $arg) {
		if( $arg['type'] == 'text' ){
			$fields[] = array (
				'key' => 'field_slider_args__'.$arg['key'], 
				'name' => 'slider_args__'.$arg['key'],
				'type' => 'text', 
				'wrapper' => array (
					'width' => '25',
					'class' => '', 
				),
				'prepend' => $arg['key'],
				'default_value' => $arg['default'], 
			);
		}
	}
	foreach ($default_args as $arg) {
		if( $arg['type'] == 'select' ){
			$fields[] = array (
				'key' => 'field_slider_args__'.$arg['key'], 
				'name' => 'slider_args__'.$arg['key'],
				'type' => 'select', 
				'wrapper' => array (
					'width' => '25',
					'class' => '', 
				),
				'instructions' => $arg['key'],
				'default_value' => $arg['default'], 
				'choices' => !empty($arg['choices']) ? $arg['choices'] : '',
			);
		}
	}
 
	return $fields;
},10,1);