<?php 

function _tokko_acf_choices_operation_types(){
	$available_operation_types = WPBC_tokko_get_available_operation_types();
	$temp = array();
	$temp[0] = __('All','bootclean');
	foreach ($available_operation_types as $key => $value) {
		$temp[$value['id']] = $value['name'];
	}
	return $temp;
}

function _tokko_acf_choices_property_types(){
	$available_property_types = WPBC_tokko_get_available_property_types();
	$temp = array();
	$temp[0] = __('All','bootclean');
	foreach ($available_property_types as $key => $value) {
		$temp[$value['id']] = $value['name'];
	}
	return $temp;
}

add_filter('WPBC_acf_builder_layouts', 'build_ui_tokko_properties',10,1); 

function build_ui_tokko_properties($layouts){

	$content_sub_fields = array();  

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

		$pagination_fields = array();
			
			$pagination_fields[] = WPBC_acf_make_select_field(
				array(
					'name'=>'order_by',
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
					'name'=>'order',
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
					'name'=>'limit',
					'label' => 'Limit',
					'width' => '20%',
					'default_value' => 20,
				)
			);

			$pagination_fields[] = WPBC_acf_make_true_false_field(array(
				'name' => 'pagination',
				'label' => 'Pagination Links',
				'width' => '20%',
			));
			$pagination_fields[] = WPBC_acf_make_true_false_field(array(
				'name' => 'result_detail',
				'label' => 'Result detail',
				'width' => '20%',
			));

			$content_sub_fields[] = WPBC_acf_make_group_field(array(
				'name' => 'ui-tokko-properties_pagination',
				'label' => 'Pagination/Order',
				'sub_fields' => $pagination_fields,
			));

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => 'ui-tokko-properties',
		'layout_label' => '<i class="dot-badge"></i> Tokko Properties',
		'content_sub_fields' => $content_sub_fields,
		'hide_section_title' => true,
		'hide_call_to_action' => true, 
		'hide_options_all' => true,
	), $layouts);

	return $layouts;

}

add_action('admin_head',function(){
	$check = array(
		'ui-tokko-properties',
	);
	?>
<style>
<?php foreach ($check as $value) { ?>
	.acf-tooltip [data-layout="<?php echo $value; ?>"] .dot-badge{
		background-color:#222;
		width: 10px;
		height: 10px;
		display: inline-block;
		border-radius: 100%;
		margin-right: 4px;
		border: 1px solid #fff;
		vertical-align: -1px;
	}  
<?php } ?>
[data-layout="ui-tokko-properties"].-collapsed .acf-fc-layout-handle svg path{
		fill:#333333 !important;
	}
</style>
	<?php
}); 