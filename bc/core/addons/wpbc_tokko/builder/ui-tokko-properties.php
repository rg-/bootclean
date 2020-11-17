<?php

function get_current_row(){

	$row = get_row();
	$get_row_index = get_row_index();

	echo $row['acf_fc_layout'];

}

add_filter('WPBC_acf_builder_layouts', 'build_ui_tokko_properties',10,1); 

function build_ui_tokko_properties($layouts){

	$content_sub_fields = array();  
 		
 		$section_header = array();
		$section_header[] = WPBC_acf_make_text_field(
			array(
				'name' => 'ui-tokko-properties_section_title',
				'label'=>'Título de sección', 
				'class' => 'acf-input-title', 
				'width' => '70%',
			)
		);

		$content_sub_fields[] = WPBC_acf_make_group_field(array(
			'name' => 'ui-tokko-properties_section_header',
			'label'=>'Encabezado de sección', 
			'sub_fields' => $section_header
		));

		$content_sub_fields[] = WPBC_acf_make_text_field(array(
			'name' => 'ui-tokko-properties_linked_results_id',
			'label' => 'linked_results_id',
			'width' => '20%', 
			'default_value' => '',
			'prepend' => '#',
			'append' => '',
		));

		$content_sub_fields[] = WPBC_acf_make_select_field(
			array(
				'name'=>'ui-tokko-properties_operation_types',
				'label' => 'Operation Types',
				'choices' => _tokko_acf_choices_operation_types(),
				'default_value' => 0,
				'width' => '20%', 
			)
		);

		$content_sub_fields[] = WPBC_acf_make_select_field(
			array(
				'name'=>'ui-tokko-properties_property_types',
				'label' => 'Property Types',
				'choices' => _tokko_acf_choices_property_types(),
				'default_value' => 0,
				'width' => '20%'
			)
		); 

		$content_sub_fields[] = WPBC_acf_make_select_field(
			array(
				'name'=>'ui-tokko-properties_localizations',
				'label' => 'Location',
				'choices' => _tokko_acf_choices_localizations(),
				'default_value' => 0,
				'width' => '20%'
			)
		); 

		$pagination_fields = array();
			
			$pagination_fields[] = WPBC_acf_make_select_field(
				array(
					'name'=>'ui-tokko-properties_order_by',
					'label' => 'Order by',
					'choices' => array(
						'price'=>'price',
						'id'=>'id',
						'random'=>'random',
					),
					'default_value' => 'price',
					'width' => '20%'
				)
			);
			$pagination_fields[] = WPBC_acf_make_select_field(
				array(
					'name'=>'ui-tokko-properties_order',
					'label' => 'Order',
					'choices' => array(
						'asc'=>'asc',
						'desc'=>'desc',
					),
					'default_value' => 'desc',
					'width' => '20%'
				)
			);

			$pagination_fields[] = WPBC_acf_make_number_field(
				array(
					'name'=>'ui-tokko-properties_limit',
					'label' => 'Limit',
					'width' => '20%',
					'default_value' => 20,
				)
			);

			$pagination_fields[] = WPBC_acf_make_true_false_field(array(
				'name' => 'ui-tokko-properties_pagination_links',
				'label' => 'Pagination Links',
				'width' => '20%',
			));
			$pagination_fields[] = WPBC_acf_make_true_false_field(array(
				'name' => 'ui-tokko-properties_result_detail',
				'label' => 'Result detail',
				'width' => '20%',
			));

			$content_sub_fields[] = WPBC_acf_make_group_field(array(
				'name' => 'ui-tokko-properties_pagination',
				'label' => 'Pagination/Order',
				'sub_fields' => $pagination_fields,
			));


			$filters_fields = array();

			$filters_fields[] = $pagination_fields[] = WPBC_acf_make_true_false_field(array(
				'name' => 'ui-tokko-properties_is_starred_on_web',
				'label' => 'Starred on web',
				'width' => '20%',
				'default_value' => 0
			));

			$content_sub_fields[] = WPBC_acf_make_group_field(array(
				'name' => 'ui-tokko-properties_filters',
				'label' => 'Filters',
				'sub_fields' => $filters_fields,
			));

 

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => 'ui-tokko-properties',
		'layout_label' => '<i class="dot-badge"></i> Tokko Properties',
		'content_sub_fields' => $content_sub_fields,
		'hide_section_title' => true,
		'hide_call_to_action' => true, 
		//'hide_options_all' => true,
	), $layouts);

	return $layouts;

}