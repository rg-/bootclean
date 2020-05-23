<?php 

function WPBC_acf_reusables_fields($fields = array()){ 
	return apply_filters('WPBC_acf_reusables_fields', $fields);
} 
 
 

add_filter('WPBC_acf_reusables_fields', function($fields){  

	$default_or_options_classes = WPBC_get_layout_main_content_default_or_options_classes('reusables'); 



	$fields = array( 
		/*
		> container_block
			> container 
				> row
					> col
		*/ 

		

		// Global content_visible
		array (
			'key' => 'key__global_content_visible',
			'label' => 'Visible Global',
			'name' => 'global_content_visible',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '25%',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		), 

		// r_builder_classes_group
		array (
			'key' => 'key__r_builder_classes_group',
			'label' => 'Row > Attributes',
			'name' => 'r_builder_classes_group',
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
					'key' => 'key__classes__content_visible',
					'label' => 'Visible',
					'name' => 'content_visible',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '25%',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 1,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				), 

				array (
					'key' => 'key__classes__content_use_divs',
					'label' => 'Use wrapper',
					'name' => 'content_use_divs',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '25%',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
				
				array (
					'key' => 'key__classes__content_row_id',
					'label' => '#ID',
					'name' => 'content_row_id',
					'type' => 'text', 
					'conditional_logic' => array(
						array(
							array(
								'field' => 'key__classes__content_use_divs',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array (
						'width' => '25$',
						'class' => '',
						'id' => '',
					),
					'default_value' => '', 
				), 
				
				array (
					'key' => 'key__classes__content_use_row',
					'label' => 'Bootstrap Container',
					'name' => 'content_use_row',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'key__classes__content_use_divs',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array (
						'width' => '25%',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
				
				array (
					'key' => 'key__classes__msg',
					'label' => 'Classes',
					'name' => '',
					'type' => 'message',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'key__classes__content_use_divs',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array (
						'width' => '20%',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'new_lines' => 'wpautop',
					'esc_html' => 0,
				),
				
				array (
					'key' => 'key__classes__content_row',
					'label' => 'Row block',
					'name' => 'content_row',
					'type' => 'text', 
					'conditional_logic' => array(
						array(
							array(
								'field' => 'key__classes__content_use_divs',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'wrapper' => array (
						'width' => '20$',
						'class' => '',
						'id' => '',
					),
					'default_value' => '', 
				),
				
				array (
					'key' => 'key__classes__content_row__container',
					'label' => 'Container',
					'name' => 'content_row__container',
					'type' => 'text', 
					'wrapper' => array (
						'width' => '20$',
						'class' => '',
						'id' => '',
					),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'key__classes__content_use_row',
								'operator' => '==',
								'value' => '1',
							),
							array(
								'field' => 'key__classes__content_use_divs',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'default_value' => $default_or_options_classes['container']['class'], // See builder TODO needs default from somewhere
					'placeholder' => ''
				),
				
				array (
					'key' => 'key__classes__content_row__container_row',
					'label' => 'Container > Row',
					'name' => 'content_row__container_row',
					'type' => 'text', 
					'wrapper' => array (
						'width' => '20$',
						'class' => '',
						'id' => '',
					),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'key__classes__content_use_row',
								'operator' => '==',
								'value' => '1',
							),
							array(
								'field' => 'key__classes__content_use_divs',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'default_value' => $default_or_options_classes['container']['row'], 
					'placeholder' => ''
				),
				
				array (
					'key' => 'key__classes__content_row__container_row_col',
					'label' => 'Row > Col',
					'name' => 'content_row__container_row_col',
					'type' => 'text', 
					'wrapper' => array (
						'width' => '20$',
						'class' => '',
						'id' => '',
					),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'key__classes__content_use_row',
								'operator' => '==',
								'value' => '1',
							),
							array(
								'field' => 'key__classes__content_use_divs',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'default_value' => $default_or_options_classes['container']['col_content'], 
					'placeholder' => ''
				),
			
			),
		),
		
		
		array (
			'key' => 'key__r_tab__content',
			'label' => 'Content', 
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'key__r_tab__settings',
			'label' => 'Settings', 
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'key__r_tab__advanced',
			'label' => 'Advanced', 
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		
		// r_wpbc_template
		array(
			'key' => 'key__r_wpbc_template',
			'label' => 'Template',
			'name' => 'r_wpbc_template',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'wpbc_template',
			),
			'taxonomy' => array(
			),
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'id',
			'ui' => 1,
		), 
		
		// key__r_background_image
		array (
			'key' => 'key__r_background_image',
			//'label' => 'Background Image',
			'name' => 'r_background_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
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
		
		// r_html_code
		array(
			'key' => 'key__r_html_code',
			//'label' => 'Html',
			'name' => 'r_html_code',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => ' codemirror-custom-field md',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		// r_slider_html_code
		array(
			'key' => 'key__r_slider_html_code',
			//'label' => 'Html',
			'name' => 'r_html_code',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => ' codemirror-custom-field md',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		
		// r_slider_item
		
		array(
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
		),
		
		// r_slider_settings
		array(
			'key' => 'key__r_slider_settings',
			'label' => 'Slider settings',
			'name' => 'r_slider_settings',
			'type' => 'textarea',
			'instructions' => 'Json format: http://kenwheeler.github.io/slick/',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => 'html_code codemirror-custom-field md ',
				'id' => '',
			),
			'default_value' => '{ "dots":true, "arrows":false }',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		// r_slider_settings_args
		
		
		// r_slider_breakpoint_heights
		array(
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
		),
		
		// r_slider_breakpoint_heights
		array(
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
		),
		
	);
	/*
	$fields[] = array (
		'key' => 'field_58e0964fb1f41',
		'label' => 'Text Field for testing',
		'name' => 'text_field',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => 'default value here',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	);
	*/
	
	/*
		@ field_group_code_styles
		
		SEE: bc\core\enqueue\WPBC_add_inline_style.php
	
	*/
	
	$fields[] = array (
		'key' => 'field_group_code_styles',
		'label' => __('Insert css code only. Use XS, SM... for particular bootstrap breakpoint.'),
		'name' => 'code_styles',
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
				'key' => 'field_code_styles_all__tab',
				'label' => 'ALL',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_code_styles_all',
				'label' => '',
				'name' => 'code_styles_all',
				'type' => 'textarea', 
				'wrapper' => array ( 
					'class' => 'codemirror-custom-field md', 
				), 
				'new_lines' => '',
			),
		
			array (
				'key' => 'field_code_styles_xs__tab',
				'label' => 'XS',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_code_styles_xs',
				'label' => '',
				'name' => 'code_styles_xs',
				'type' => 'textarea', 
				'wrapper' => array ( 
					'class' => 'codemirror-custom-field md', 
				), 
				'new_lines' => '',
			),

			array (
				'key' => 'field_code_styles_sm__tab',
				'label' => 'SM',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_code_styles_sm',
				'label' => '',
				'name' => 'code_styles_sm',
				'type' => 'textarea', 
				'wrapper' => array ( 
					'class' => 'codemirror-custom-field md', 
				), 
				'new_lines' => '',
			),

			array (
				'key' => 'field_code_styles_md__tab',
				'label' => 'MD',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_code_styles_md',
				'label' => '',
				'name' => 'code_styles_md',
				'type' => 'textarea', 
				'wrapper' => array ( 
					'class' => 'codemirror-custom-field md', 
				), 
				'new_lines' => '',
			),

			array (
				'key' => 'field_code_styles_lg__tab',
				'label' => 'LG',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_code_styles_lg',
				'label' => '',
				'name' => 'code_styles_lg',
				'type' => 'textarea', 
				'wrapper' => array ( 
					'class' => 'codemirror-custom-field md', 
				), 
				'new_lines' => '',
			),

			array (
				'key' => 'field_code_styles_xl__tab',
				'label' => 'XL',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array (
				'key' => 'field_code_styles_xl',
				'label' => '',
				'name' => 'code_styles_xl',
				'type' => 'textarea', 
				'wrapper' => array ( 
					'class' => 'codemirror-custom-field md', 
				), 
				'new_lines' => '',
			),

		),
	);

	$fields[] = array (
		'key' => 'key__r_color_picker_background',
		'label' => __('Background Color','myfunnel'),
		'name' => 'r_color_picker_background',
		'type' => 'color_picker',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '20%',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
	);
	$fields[] = array (
		'key' => 'key__r_color_picker_text',
		'label' => __('Text Color','myfunnel'),
		'name' => 'r_color_picker_text',
		'type' => 'color_picker',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '20%',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
	);
 	
	return $fields;
}, 10, 1);


/*
 * builder__slider_settings_args
*/  


 
function WPBC_group_builder__slider_settings_args($fields = array()){  
	return apply_filters('WPBC_group_builder__slider_settings_args', $fields);
}
add_filter('WPBC_group_builder__slider_settings_args', function($fields){

	// http://kenwheeler.github.io/slick/

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

add_filter('WPBC_acf_reusables_fields', function($fields){
	$fields[] = array(
			'key' => 'key__r_slider_settings_args',
			'label' => 'Slider settings Args',
			'name' => 'r_slider_settings_args',
			'type' => 'group',
			'sub_fields' => WPBC_group_builder__slider_settings_args(),
		);
	return $fields;
},10,1);


// key__r_wpbc__advanced_group 

function WPBC_group_builder__advanced_group_inview_sub_fields($fields = array()){  
	return apply_filters('WPBC_group_builder__advanced_group_inview_sub_fields', $fields);
}
add_filter('WPBC_group_builder__advanced_group_inview_sub_fields', function($fields){

	// http://kenwheeler.github.io/slick/

	$fields = array(

		array (
			'key' => 'field_advanced_group_inview__type',
			'label' => __('Type','bootclean'),
			'name' => 'advanced_group_inview__type',
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
				0 => _('None'),
				'detect' => _('Normal Inview'),
				'ajax-load' => _('Ajax Load'),
			),
			'default_value' => array (
				0 => _('None'),
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),

	);

	return $fields;
},10,1);

add_filter('WPBC_acf_reusables_fields', function($fields){
	$fields[] = array(
			'key' => 'key__r_wpbc__advanced_group_inview',
			'label' => __('Inview Effect','bootclean'),
			'name' => 'r_wpbc__advanced_group_inview',
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
			'sub_fields' => WPBC_group_builder__advanced_group_inview_sub_fields(),
		);
	return $fields;
},10,1);