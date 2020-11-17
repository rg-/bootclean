<?php

// ui-tokko-developments

add_filter('WPBC_acf_builder_layouts', 'build_ui_tokko_developments',10,1); 

function build_ui_tokko_developments($layouts){

	$content_sub_fields = array();  
 		
 		$section_header = array();
		$section_header[] = WPBC_acf_make_text_field(
			array(
				'name' => 'ui-tokko-developments_section_title',
				'label'=>'Título de sección', 
				'class' => 'acf-input-title', 
				'width' => '70%',
			)
		);

		$content_sub_fields[] = WPBC_acf_make_group_field(array(
			'name' => 'ui-tokko-developments_section_header',
			'label'=>'Encabezado de sección', 
			'sub_fields' => $section_header
		));

		$content_sub_fields[] = WPBC_acf_make_text_field(array(
			'name' => 'ui-tokko-developments_linked_results_id',
			'label' => 'linked_results_id',
			'width' => '20%', 
			'default_value' => '',
			'prepend' => '#',
			'append' => '',
		));
 

		$pagination_fields = array();
			
			$pagination_fields[] = WPBC_acf_make_select_field(
				array(
					'name'=>'ui-tokko-developments_order_by',
					'label' => 'Order by',
					'choices' => array(
						'location__name' => 'location__name',
						'construction_date' => 'construction_date',
						'id'=>'id', 
					),
					'default_value' => 'location__name',
					'width' => '20%'
				)
			); 

			$pagination_fields[] = WPBC_acf_make_number_field(
				array(
					'name'=>'ui-tokko-developments_limit',
					'label' => 'Limit',
					'width' => '20%',
					'default_value' => 20,
				)
			);

			$pagination_fields[] = WPBC_acf_make_true_false_field(array(
				'name' => 'ui-tokko-developments_pagination_links',
				'label' => 'Pagination Links',
				'width' => '20%',
			));
			$pagination_fields[] = WPBC_acf_make_true_false_field(array(
				'name' => 'ui-tokko-developments_result_detail',
				'label' => 'Result detail',
				'width' => '20%',
			));

			$content_sub_fields[] = WPBC_acf_make_group_field(array(
				'name' => 'ui-tokko-developments_pagination',
				'label' => 'Pagination/Order',
				'sub_fields' => $pagination_fields,
			));


			$filters_fields = array();

			$filters_fields[] = $pagination_fields[] = WPBC_acf_make_true_false_field(array(
				'name' => 'ui-tokko-developments_is_starred_on_web',
				'label' => 'Starred on web',
				'width' => '20%',
				'default_value' => 0
			));

			$content_sub_fields[] = WPBC_acf_make_group_field(array(
				'name' => 'ui-tokko-developments_filters',
				'label' => 'Filters',
				'sub_fields' => $filters_fields,
			));

 

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => 'ui-tokko-developments',
		'layout_label' => '<i class="dot-badge"></i> Tokko Developments',
		'content_sub_fields' => $content_sub_fields,
		'hide_section_title' => true,
		'hide_call_to_action' => true, 
		//'hide_options_all' => true,
	), $layouts);

	return $layouts;

}