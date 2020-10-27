<?php
$row = get_row(); 

$prefix = 'field_ui-tokko-properties_';

$operation_types = $row[$prefix.'operation_types'];
$property_types = $row[$prefix.'property_types']; 

$pagination_options = $row[$prefix.'pagination'];  
WPBC_get_template_part('wpbc_tokko/properties', array(

	'operation_types' => $operation_types,
	'property_types' => $property_types,
	'order_by' => $pagination_options['field_order_by'],
	'order' => $pagination_options['field_order'],
	'limit' => $pagination_options['field_limit'],
	'pagination' => $pagination_options['field_pagination'],
	'result_detail' => $pagination_options['field_result_detail'], 

));