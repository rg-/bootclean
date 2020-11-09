<?php

/*

	Related:

	/template-parts/builder/
	bc/core/template-tags/wpbc_template_builder.php (The BRAIN here !!)

	@filter WPBC_acf_builder_layouts

*/ 


function wpbc_acf_layouts(){
	$wpbc_acf_layouts = array(
		'html_row',
		'slider_row',
		'accordion_row',
		'wysiwyg_row',
		'widgets_row',
		'template_row',
		'template_part_row', 
	);
	return $wpbc_acf_layouts; 
}
$wpbc_acf_layouts = wpbc_acf_layouts();
foreach ($wpbc_acf_layouts as $layout) {
	include('layouts/'.$layout.'.php'); 
}  

add_filter('acf/fields/flexible_content/layout_title', function($title,
$field, $layout, $i){

	$check = array(
		'template_row',
		'template_part_row',
	);

	if( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX && isset($_POST['value']) ){ 
			// code to handle the AJAX
    	$value = $_POST['value'];  
    }else{
    	// code normal php load
    	$value = $field['value'][$i];
    }
	
	//_print_code($value);
	
	if( in_array($layout['name'], $check) ){ 
    $t = '';
    $e = '';
    if(!empty($value)){

    	if( $layout['name'] == 'template_row' && !empty($value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template'])){ 
    		$template_id = $value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template'];
    		$t = get_the_title($template_id);
    		$edit_link = get_edit_post_link($template_id);
    		$e = ' <a title="Edit Template" class="wpbc-btn-small button" href="'.$edit_link.'"><small>EDIT</small></a>';
    	} 

    	if( $layout['name'] == 'template_part_row' && !empty($value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template_part'])){ 
    		$t = $value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template_part']; 
    		$e = '.php';
    	} 
			
			$title = $title.' <svg class="sep" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path class="path" fill="#fff" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg> '.$t . $e;
    }
 
	}

	$section_options = !empty($value['field_'.$layout['name'].'__section_options']) ? $value['field_'.$layout['name'].'__section_options'] : '';

	$layout_style = !empty($section_options['field_'.$layout['name'].'__section_options_style']) ? $section_options['field_'.$layout['name'].'__section_options_style'] : ''; 
	 
	if(!empty($layout_style)){
		$title = '<small title="Esquema de color :'.$layout_style.'" style="background-color:var(--'.$layout_style.');" class="wpbc-badge wpbc-badge-style bg-'.$layout_style.'"></small> ' . $title;
	}

	return $title;

}, 10, 4); 

add_action('admin_head',function(){ 
	?>
<style>
[data-layout] .acf-fc-layout-handle svg{
	vertical-align: -2px;
}
[data-layout] .acf-fc-layout-handle svg.sep{
	vertical-align: -3px;
}
[data-layout].-collapsed .acf-fc-layout-handle svg path.path{
		fill:#333333 !important;
	}
.wpbc-badge-style{
		position: relative;
		border: 1px solid rgba(255,255,255,.8);
		display: inline-block;
		height: 10px;
		padding: 0;
		width: 10px;
		top: 2px;
		cursor: default;
	}
	[data-layout].-collapsed .wpbc-badge-style{
		border: 1px solid rgba(1,1,1,.8); 
	}
</style>
	<?php
}); 

/* */

function WPBC_acf_builder_layouts(){
	
	$layouts = array(); 
	
	// Filter here, so i can allways "safe" add a flexible_row by filter, and then, and LAST always, the layout_flexible_row, that in fact has the same layouts defined above and that´s why needs to be last one loaded :)
	$layouts = apply_filters('WPBC_acf_builder_layouts', $layouts);
	$layouts = apply_filters('wpbc/filter/builder_flexible_content/layouts', $layouts);
	
	$flexible_rows = array(
		'layout_flexible_row' => array(
			'key' => 'layout_flexible_row',
			'name' => 'flexible_row',
			'label' => '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><path fill="#fff" d="M8,8H6v7c0,1.1,0.9,2,2,2h9v-2H8V8z"/><path fill="#fff" d="M20,3h-8c-1.1,0-2,0.9-2,2v6c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V5C22,3.9,21.1,3,20,3z M20,11h-8V7h8V11z"/><path fill="#fff" d="M4,12H2v7c0,1.1,0.9,2,2,2h9v-2H4V12z"/></g></g><g display="none"><g display="inline"/><g display="inline"><path fill="#fff" d="M8,8H6v7c0,1.1,0.9,2,2,2h9v-2H8V8z"/><path fill="#fff"d="M20,3h-8c-1.1,0-2,0.9-2,2v6c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V5C22,3.9,21.1,3,20,3z M20,11h-8V7h8V11z"/><path fill="#fff" d="M4,12H2v7c0,1.1,0.9,2,2,2h9v-2H4V12z"/></g></g></svg></i>'.' Flexible Row',
			'display' => 'block',
			'sub_fields' => array(
			
				array (
					'key' => 'layout_flexible_row__tab_content',
					'label' => 'Content Rows',
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
			
				array(
					'key' => 'key__layout_flexible_row__content',
					'label' => 'Content',
					'name' => 'content',
					'type' => 'flexible_content',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layouts' => $layouts,
					'button_label' => 'Add Sub Row',
					'min' => '',
					'max' => '',
				),
				
				array (
					'key' => 'layout_flexible_row__tab_settings',
					'label' => 'Settings',
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
				
				array(
					'key' => 'key__layout_flexible_row__classes',
					'label' => 'Classes',
					'name' => 'classes',
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
						1 => 'key__r_builder_classes_group'
					),
					'display' => 'seamless',
					'layout' => 'block',
					'prefix_label' => 0,
					'prefix_name' => 0,
				),
			),
			'min' => '',
			'max' => '',
		),
	);
	$layouts['layout_flexible_row'] = $flexible_rows['layout_flexible_row']; 

	$layouts = apply_filters('wpbc/filter/acf/builder/flexible_content/layouts', $layouts);

	return $layouts;
}




/*

	WPBC_acf_make_flexible_content_layout

	NEW WAY FOR BUILD FLEXIBLE ROWS v11

	Child calleable hook 

*/

if(!function_exists('WPBC_acf_make_flexible_content_layout')){

	function WPBC_acf_make_flexible_content_layout($args=array(), $layouts=array()){

		if(empty($args)) return; 

			$layout_name = !empty($args['layout_name']) ? $args['layout_name'] : 'ui-box-test';
			$layout_label = !empty($args['layout_label']) ? $args['layout_label'] : 'Box Test';

			$args = apply_filters('wpbc/filter/make_flexible_content_layout/pre/args',$args,$layout_name);

			$sub_fields = array();

			$sub_fields[] = WPBC_acf_make_tab_field(
				array(
					'key' => $layout_name.'__content_tab',
					'label' => 'Contenido',
					'placement' => 'top',
				)
			);
				if(empty($args['hide_section_title'])){
					$sub_fields[] = WPBC_acf_make_text_field(
						array(
							'name' => $layout_name.'__section-title',
							'label'=>'Título de sección', 
							'class' => 'acf-input-title', 
							'width' => '70%',
						)
					);
				}

				$content_sub_fields = $args['content_sub_fields'];
				if(!empty($content_sub_fields)){
					foreach ($content_sub_fields as $key => $value) {
						$sub_fields[] = $value;
					}
				}

			if(empty($args['hide_call_to_action'])){

					$sub_fields[] = WPBC_acf_make_tab_field(
						array(
							'key' => $layout_name.'__call_to_action_tab',
							'label'=>_x('Call to Action', 'bootclean'),
							'placement' => 'top',
						)
					);

						$sub_fields[] = WPBC_acf_make_call_to_action_group_field(
							array(
								'name' => $layout_name.'__call_to_action',
								'label'=> 'Método de visualización', 
								'default_type' => 'btn',
							)
						); 

				} 

			

				$sub_fields_section_options = array(); 

					if(empty($args['hide_attributes'])){
						
						$sub_fields__attributes = array();

							$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
								'name' => $layout_name.'__attributes_id', 
								'prepend' => 'ID #',
								'class' => 'wpbc-field-no-label',
								'width' => '50%',
							));

						

							$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
								'name' => $layout_name.'__attributes_class', 
								'prepend' => __('Layout Class','bootclean'),
								'class' => 'wpbc-field-no-label',
								'width' => '50%',
							));

							if(empty($args['hide_attributes_classes'])){

								$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
									'name' => $layout_name.'__attributes_container_class', 
									'prepend' => __('Container Class','bootclean'),
									'class' => 'wpbc-field-no-label',
									'width' => '50%',
								));

								$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
									'name' => $layout_name.'__attributes_row_class', 
									'prepend' => __('Row Class','bootclean'),
									'class' => 'wpbc-field-no-label',
									'width' => '50%',
								));

								$sub_fields__attributes[] = WPBC_acf_make_text_field(array(
									'name' => $layout_name.'__attributes_column_class', 
									'prepend' => __('Column Class','bootclean'),
									'class' => 'wpbc-field-no-label',
									'width' => '50%',
								));

							}

						$sub_fields_section_options[] = WPBC_acf_make_group_field(array(
							'name' =>  $layout_name.'__attributes',
							'label' => __('Row attributes'),
							'sub_fields' => $sub_fields__attributes,
							'class' => 'wpbc-field-no-padding', 
						));

					}	

					if(empty($args['hide_options_style'])){

						$def_color = 'transparent'; 
						$sub_fields_section_options[] = WPBC_acf_make_radio_field( array(
								'name' => $layout_name.'__section_options_style',
								'label'=>  'Esquema de color',
								'choices' => WPBC_get_acf_root_colors_choices($layout_name.'__section_options_style'),
								'default_value' => $def_color,
								'width' => '20%',
								'class' => 'wpbc-radio-as-btn no-padding-radio-label', 
							) );

					}

						$sub_fields_section_options[] = WPBC_acf_make_true_false_field(
								array(
									'name' => $layout_name.'__section_options_visible',
									'label'=>'¿Ocultar la sección?',  
									'default_value' => 0, 
									'message' => '',
									'width' => '20%', 
								)
							);  

			if(empty($args['hide_options_all'])){

				$sub_fields[] = WPBC_acf_make_tab_field(
					array(
						'key' => $layout_name.'__section_options_tab',
						'label'=>_x('Settings', 'bootclean'),
						'placement' => 'top',
					)
				); 

				$sub_fields[] = WPBC_acf_make_group_field(
					array(
						'name' => $layout_name.'__section_options',
						'label'=>'',  
						'width' => '100%',
						'sub_fields' => $sub_fields_section_options,
						'class' => 'wpbc-group-no-border wpbc-group-no-label',
					)
				); 
			}

			$layouts['layout_'.$layout_name] = array(
				'key' => 'layout_'.$layout_name,
				'name' => $layout_name,
				'label' => $layout_label,
				'display' => 'block',
				'sub_fields' => $sub_fields,
				'min' => '',
				'max' => '',
			); 

			return $layouts; 

	} 

}

if(!function_exists('WPBC_get_section_row_args')){

	function WPBC_get_section_row_args($args=array(),$p=''){

		$options = !empty($args[$p.'__section_options']) ? $args[$p.'__section_options'] : array();  

		if(!empty($options)){


			if(!empty($options[$p.'__attributes'])){
				$attributes = $options[$p.'__attributes'];
				$id = $attributes[$p.'__attributes_id'];
				$class = $attributes[$p.'__attributes_class'];
				$container_class = $attributes[$p.'__attributes_container_class'];
				$row_class = $attributes[$p.'__attributes_row_class'];
				$column_class = $attributes[$p.'__attributes_column_class']; 
			}

			$options = array(
				'visible' => !empty($options[$p.'__section_options_visible']) ? $options[$p.'__section_options_visible'] : '',
				'style' => !empty($options[$p.'__section_options_style']) ? $options[$p.'__section_options_style'] : 'transparent',
				'style_color' => 'dark', 
				'id' => !empty($id) ? $id : '',
				'class' => !empty($class) ? $class : '',
				'container_class' => !empty($container_class) ? $container_class : '',
				'row_class' => !empty($row_class) ? $row_class : '',
				'column_class' => !empty($column_class) ? $column_class : '',
			);
 			
		}  

		/*
		if( !empty( $options['style'] ) ) {
			if( !in_array( $options['style'], array( 'transparent', 'white', 'rosa', 'rosa-claro' ) )){
				$options['style_color'] = 'white';
			}
		} 
		*/

		$options['style_color'] = apply_filters('wpbc/filter/flexible-layout-row/style_color', $options['style_color'], $options);

		$section_id = !empty($args[$p.'__section-title']) ? sanitize_title($args[$p.'__section-title']) : $args['acf_fc_layout'].'-'.uniqid();
		$section_id = !empty( $options['id'] ) ? $options['id'] : $section_id;

		$return = array(
			'section_id' => $section_id,
			'section_title' => !empty($args[$p.'__section-title']) ? $args[$p.'__section-title'] : '',
			'call_to_action' => !empty($args[$p.'__call_to_action']) ? $args[$p.'__call_to_action'] : '',
			'section_options' => $options,
		);    

		$return = apply_filters('wpbc/filter/flexible-layout-row/args', $return, $args);

		return $return;

	}

}

add_action('wpbc/flexible-layout-row/start', function($section, $acf_fc_layout){

	$layout_class = $acf_fc_layout;
	$layout_class .= ' bg-'.$section['section_options']['style'];
	$layout_class .= ' text-'.$section['section_options']['style_color'];
	$layout_class .= ' '.$section['section_options']['class'];

	$container_class = $section['section_options']['container_class'];
	$row_class = $section['section_options']['row_class'];
	$column_class = $section['section_options']['column_class'];

	if(empty($column_class)) $column_class = 'col-12';
?>
<div id="<?php echo $section['section_id']; ?>" class="<?php echo $layout_class; ?>">
	<div class="container <?php echo $container_class; ?>">
		<div class="row <?php echo $row_class; ?>">
			<div class="<?php echo $column_class; ?>">
<?php
},10,2);

add_action('wpbc/flexible-layout-row/end', function($section, $acf_fc_layout){
	?>
			</div>
		</div>
	</div>
</div>
	<?php
},10,2);