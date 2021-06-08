<?php

add_action('admin_footer',function(){ 

	/*

		USE LIKE, where [LAYOUT-NAME] is your layout name, like "ui_layout_section_base":


			'[LAYOUT-NAME]' => array( 
				'params' => array(
					array(
						'key' => 'icono',
						'type' => 'text'
					),
					array(
						'key' => 'titulo',
						'type' => 'html'
					),
					array(
						'key' => 'texto',
						'type' => 'html'
					),
				) 
			),

	*/
	$ui_layout_template_part__msg = apply_filters('wpbc/filters/ui_layout_template_part/dynamic_params', array() );

	?>
<script id="ui_layout_template_part">
	
	jQuery(document).ready(function($){

		function ui_layout_template_part_Update(ele, val){  

			var msgout = '';
			var msgs = <?php echo json_encode($ui_layout_template_part__msg); ?>;

			if(msgs[val]){
				$.each( msgs[val]['params'], function(i,val){ 
					msgout += (i+1) +' - Type: <b><u>'+val.type+'</u></b> Key: <b><u>'+val.key+'</u></b> <br>'; 
				}); 
			} else {

				msgout = 'Nothing defined.';

			}

			ele.parent().find('[data-key="ui_layout_template_part__message"] .acf-input').html(msgout);
			
		}

		$('[data-name="ui_layout_template_part__file"]').each(function(){
			var me = $(this);
			if( $(this).find('select').val() ){ 
				var val = $(this).find('select').val();  
				ui_layout_template_part_Update( $(this), val ); 
			} 

			$(this).find('select').on('change',function(){
				var val = $(this).val(); 
				ui_layout_template_part_Update( me, val );
			});

		}); 

	}); 

</script>
	<?php
},999);

/*
		ui_layout_template_part 
*/  
	 
	add_filter( 'acf/load_field/key=field_ui_layout_template_part__file', function ( $field ) { 
		
		$files = array();  
		$temp_folder = 'theme'; 
		$temp_files = glob(MAIN_THEME_PATH.'/template-parts/'.$temp_folder.'/*.php');
	
		foreach($temp_files as $file) { 
			$file_slug = str_replace('.php', '', basename($file));
			$files[] = array('name'=>basename($file),'file'=>$file_slug);
		} 
	
		$field['choices'][0] = 'None';
		foreach($files as $item){  
			$field['choices'][$item['file']] = $item['name'];  
		} 
	  
	  return $field;	
	
	}, 10, 1 );
		
	add_filter('wpbc/filter/acf/builder/flexible_content/layouts', 'WPBC_build__ui_layout_template_part',20,1);  
	
	function WPBC_build__ui_layout_template_part($layouts){ 

		$layout_name = 'ui_layout_template_part';

		$layout_label = '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path class="path" fill="#fff" d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg></i> Template Part'; 
		
		$content_sub_fields = array(); 
		
		$content_sub_fields[] = WPBC_acf_make_select_field(array(
			'name' => $layout_name.'__file',
			'label' => __('Select the template part','bootclean'),
			'instructions' => __('Files under "template-parts/theme/" folder. (php only)','bootclean'), 
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0, 
			'as_template_part_select' => 1,
		));  

		$content_sub_fields[] = WPBC_acf_make_message_field(array(
			'key' => $layout_name.'__message',
			'label' => 'Parameters used on the selected template',
			'message' => 'Nothing defined.',  
			'as_template_part_select_message' => 1,
		));  

		$content_sub_fields[] = WPBC_acf_make_repeater_field(array(
			'label' => __('Dynamic Template Part Parameters','bootclean'),
			'instructions' => __('Get parameter values using: WPBC_get_dynamic_param("your-key") on your template.','bootclean').'<br>'.__('Or access all parameters using: WPBC_get_dynamic_params() .','bootclean'),
			'name' => $layout_name.'__dynamic_params',
			'button_label' => __('Add parameter','bootclean'),
			'sub_fields' => WPBC_acf_get_dynamic_params_sub_fields($layout_name),
		));

		$layouts = WPBC_acf_make_flex_builder_layout(array(
			'layout_name' => $layout_name,
			'layout_label' => $layout_label,
			'content_sub_fields' => $content_sub_fields,
			//'show_section_title' => false, 
			'show_section_settings' => true,
			'show_section_styles' => true,
			'section_settings_defaults' => array( 

				/**/
				'classes' => array(
					'default' => false,
				),

				/*
				'classes' => array(
					'default' => true,
					'container_class' => 'container',
					'row_class' => 'row',
					'column_class' => 'col-12',
				),
				*/
				// 'classes' => array(),
			),
		), $layouts); 

		return $layouts;  
	}