<?php

include('functions/WPBC_get_tokko_searchform.php');
include('functions/WPBC_tokko_property_features.php');

function WPBC_tokko_if_sale(){
	if( isset($_REQUEST['data']) ){
		$search_data = json_decode($bodytag = str_replace("\\", "", $_REQUEST['data']), true);
		if(!empty($search_data['operation_types'])){
			foreach ($search_data['operation_types'] as $operation) {
				if($operation==1) return true;
			}
		}
	}
}
function WPBC_tokko_if_rent(){
	if( isset($_REQUEST['data']) ){
		$search_data = json_decode($bodytag = str_replace("\\", "", $_REQUEST['data']), true);
		if(!empty($search_data['operation_types'])){
			foreach ($search_data['operation_types'] as $operation) {
				if($operation==2) return true;
			}
		}
	}
}
function WPBC_tokko_if_temporary_rent(){
	if( isset($_REQUEST['data']) ){
		$search_data = json_decode($bodytag = str_replace("\\", "", $_REQUEST['data']), true);
		if(!empty($search_data['operation_types'])){
			foreach ($search_data['operation_types'] as $operation) {
				if($operation==3) return true;
			}
		}
	}
}

function WPBC_get_tokko_rewrite_property_url($property){
	
	$address = $property->get_field('address');
	$propiedad_slug = sanitize_title($address);  
	$property_id = $property->get_field('id');

	return $propiedad_slug.'-'.$property_id;
} 
function WPBC_get_tokko_rewrite_development_url($development){
	
	$address = $development->get_field('name');
	$development_slug = sanitize_title($address);  
	$development_id = $development->get_field('id');

	return $development_slug.'-'.$development_id;
} 


function WPBC_get_tokko_linked_results_id($post_id, $compare='', $rows_key='content_rows'){
	$flex = get_field($rows_key, $post_id); 
	$temp = array();
	foreach ($flex as $key => $value) {
		$find = 'ui-tokko-properties_linked_results_id';
		if(!empty($value[$find]) && $compare == $value[$find]){
			$temp = $value;
		}
	}
	return $temp; 
}

function WPBC_tokko_form_get_encoded_data($args=array()){

	$data = isset($_REQUEST['data']) ? $_REQUEST['data'] : '';

	$current_data = json_decode($bodytag = str_replace("\\", "", $data), true); 
	/**/
	// _print_code($args['search_data']['search']->search_data);
	if(empty($current_data) && !empty($args['search_data']['search']->search_data)){

		$current_data = $args['search_data']['search']->search_data;
	}

	return $current_data;
}


function WPBC_tokko_get_available_operation_types(){ 

	$available_operation_types_group = get_option('options_wpbc_tokko_operation_types_available_operation_types_group', '');

	$array_data = explode(PHP_EOL, $available_operation_types_group);
	$final_data = array();
	foreach ($array_data as $data){
	    $format_data = explode(':',$data); 
	    $final_data[] = array(
	    	'id' => trim($format_data[0]),
	    	'name' => trim($format_data[1]),
	    );
	}
	return $final_data;

}

function WPBC_tokko_get_available_property_types(){
 

	$available_property_types_group = get_option('options_wpbc_tokko_property_types_available_property_types_group', '');

	$array_data = explode(PHP_EOL, $available_property_types_group);
	$final_data = array();
	foreach ($array_data as $data){
	    $format_data = explode(':',$data); 
	    $final_data[] = array(
	    	'id' => trim($format_data[0]),
	    	'name' => trim($format_data[1]),
	    );
	}
	return $final_data;

}


function WPBC_tokko_get_available_localizations(){

	$available_locations_group = get_option('options_wpbc_tokko_location_types_available_locations_group', '');

	$array_data = explode(PHP_EOL, $available_locations_group);

	$final_data = array();
	foreach ($array_data as $data){ 
		if ( substr( $data, 0, 1 ) != "#" ) {
	    $format_data = explode(':',$data);  
	    $final_data[str_replace(' ', '', $format_data[0])] = array(
	    	'id' => trim( str_replace(' ', '', $format_data[0]) ),
	    	'name' => trim($format_data[1]), 
	    	'sub_locations' => array(),
	    );
	  }
	}
	
	foreach ($array_data as $data){ 
		if ( substr( $data, 0, 1 ) === "#" ) { 
			$sub_data = str_replace('#','', $data);
			$format_sub_data = explode(':',$sub_data); 
			$final_data[ str_replace(' ', '', $format_sub_data[0]) ]['sub_locations'][str_replace(' ', '', $format_sub_data[1])] = array(
	    	'id' => trim( str_replace(' ', '', $format_sub_data[1]) ),
	    	'name' => trim($format_sub_data[2]), 
	    ); 
		}
	}
	 
	return $final_data;
} 



function WPBC_tokko_get_property_single_classes($property=null){
	$classes = array(
		'content_class' => '',
		'container_class' => 'container',
		'row_class' => 'row',
		'content_col_class' => 'col-md-9',
		'aside_col_class' => 'col-md-3',

		'content_related_class' => '',
		'container_related_class' => 'container',

	);

	$classes = apply_filters('wpbc/filter/tokko/property-single/classes',$classes,$property);
	return $classes;
} 