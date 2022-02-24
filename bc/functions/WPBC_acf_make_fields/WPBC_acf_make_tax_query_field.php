<?php

function WPBC_acf_make_tax_query_field($sub_fields__query, $layout_name, $query_by_taxonomy, $nested=false){

	$choices_taxonomy = array();
	foreach ($query_by_taxonomy as $tax) {  
		$choices_taxonomy[$tax['slug']] = $tax['name']; 
	}
	
	$sub_fields_tax_query = array();

	$sub_fields_tax_query[] = WPBC_acf_make_select_field( array(
		'name' => $layout_name.'__tax_query_passed_array__taxonomy', 
		'label'=> 'Taxonomy',
		'choices' => $choices_taxonomy,
		'default_value' => array (),
		'width' => '30%',
	));
	$sub_fields_tax_query[] = WPBC_acf_make_select_field( array(
		'name' => $layout_name.'__tax_query_passed_array__operator', 
		'label'=> 'Operator',
		'choices' => array(
			'IN'=>'IN', 'NOT IN'=>'NOT IN', 'AND'=>'AND', 'EXISTS' => 'EXISTS', 'NOT EXISTS' => 'NOT EXISTS'
		),
		'default_value' => 'IN',
		'width' => '30%',
	));
	$sub_fields_tax_query[] = WPBC_acf_make_true_false_field( array(
		'name' => $layout_name.'__tax_query_passed_array__include_children', 
		'label'=> 'Include Children',
		'default_value' => 1,
		'width' => '30%',
	));	
	foreach ($query_by_taxonomy as $tax) {  
		$sub_fields_tax_query[] = WPBC_acf_make_taxonomy_field( array( 
			'name' => $layout_name.'__tax_query_passed_array__'.$tax['slug'],  
			'label'=> $tax['name'],
			'taxonomy' => $tax['slug'],
			'return_format' => 'object',
			'multiple' => 1,
			'field_type' => 'checkbox',
			'width' => '100%',
			'conditional_logic' => array (
					array (
						array (
							'field' => 'field_'.$layout_name.'__tax_query_passed_array__taxonomy',
							'operator' => '==',
							'value' => $tax['slug'],
						),
					), 
				),
		) );
	}
	if($nested){ 
		$sub_fields_tax_query = WPBC_acf_make_tax_query_field($sub_fields_tax_query, $layout_name.'__tax_query_passed_array__nested', $query_by_taxonomy, false);
	}

	$sub_fields_tax_query_group = array();

	$sub_fields_tax_query_group[] = WPBC_acf_make_select_field( array(
		'name' => $layout_name.'__tax_query_passed_relation', 
		'label'=> 'Relation',
		'choices' => array(
			'AND' => 'AND',
			'OR' => 'OR'
		),
		'default_value' => 'AND',
		'width' => '15%',
	));
	$sub_fields_tax_query_group[] = WPBC_acf_make_repeater_field(array(
		'name' => $layout_name.'__tax_query_passed_array',
		'label' => 'Taxonomies',
		'width' => '85%',
		'sub_fields' => $sub_fields_tax_query,
		'button_label' => !$nested ? 'Add Tax Query' : 'Add Nested Tax',
	));

	$sub_fields__query[] = WPBC_acf_make_group_field(array(
		'name' => $layout_name.'__tax_query_passed',
		'label' => !$nested ? 'Taxonomy Query' : 'Nested Taxonomy',
		'width' => '100%',
		'sub_fields' => $sub_fields_tax_query_group, 
	));

	return $sub_fields__query;

}

?>