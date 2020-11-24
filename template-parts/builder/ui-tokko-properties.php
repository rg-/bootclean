<?php
$row = get_row(); 

$acf_fc_layout = $row['acf_fc_layout']; 
$prefix = 'field_'.$acf_fc_layout;
$section = WPBC_get_section_row_args($row, $prefix); 
if(!empty($section['section_options']['visible'])) return;  

$prefix = 'field_ui-tokko-properties_';

$operation_types = $row[$prefix.'operation_types'];
$property_types = $row[$prefix.'property_types']; 
$localizations = $row[$prefix.'localizations']; 
$filter_options =  $row[$prefix.'filters'];
$pagination_options = $row[$prefix.'pagination'];	
$linked_results_id = $row[$prefix.'linked_results_id'];

$section_header = $row[$prefix.'section_header']; 

$filter_temp = array();
foreach ($filter_options as $key => $value) {
	$new_key = str_replace($prefix, '', $key);
	$filter_temp[$new_key] = $value;
} 
?>

<?php do_action('wpbc/flexible-layout-row/start', $section, $acf_fc_layout ); ?> 

	<?php 
		WPBC_get_template_part('wpbc_tokko/properties', array(

			'section_header' => $section_header,
			'linked_results_id' => $linked_results_id,

			'operation_types' => $operation_types,
			'property_types' => $property_types,
			'localizations' => $localizations,
			'order_by' => $pagination_options['field_ui-tokko-properties_order_by'],
			'order' => $pagination_options['field_ui-tokko-properties_order'],
			'limit' => $pagination_options['field_ui-tokko-properties_limit'],
			'pagination' => $pagination_options['field_ui-tokko-properties_pagination_links'],
			'result_detail' => $pagination_options['field_ui-tokko-properties_result_detail'], 
			'filter_options' => $filter_temp,
			'properties_id' => $row[$prefix.'id'], 

		));
	?>

<?php do_action('wpbc/flexible-layout-row/end', $section, $acf_fc_layout ); ?>