<?php

function WPBC_tokko_get_operations($lang='es_ar'){
	if( $lang == 'en' ){
		$operations = array(
			array(
				'id' => 1,
				'name' => 'Sale'
			),
			array(
				'id' => 2,
				'name' => 'Rent'
			),
			array(
				'id' => 3,
				'name' => 'Temporary Rent'
			),
		);
	} else {
		$operations = array(
			array(
				'id' => 1,
				'name' => 'Venta'
			),
			array(
				'id' => 2,
				'name' => 'Alquiler'
			),
			array(
				'id' => 3,
				'name' => 'Alquiler Temporario'
			),
		);
	}
}

function acf_tokko_get_operation_types(){
	$api_key = tokko_config('api_key');  
	$auth = new TokkoAuth($api_key); 
	if ($auth->get_language() == 'en'){
		$operations = array(
			array(
				'id' => 1,
				'name' => 'Sale'
			),
			array(
				'id' => 2,
				'name' => 'Rent'
			),
			array(
				'id' => 3,
				'name' => 'Temporary Rent'
			),
		);
	}else{
		$operations = array(
			array(
				'id' => 1,
				'name' => 'Venta'
			),
			array(
				'id' => 2,
				'name' => 'Alquiler'
			),
			array(
				'id' => 3,
				'name' => 'Alquiler Temporario'
			),
		);
	}
	$out = '';
	if(!empty($operations)){
		$out .= "<div style='max-height:200px; overflow-y:auto;'>";
		$out .= "<ul>";
		foreach ($operations as $key => $value) {
			$out .= "<li>".$value['id']." : ".$value['name']."</li>";
		}
		$out .= "</ul>";
		$out .= "</div>";
	}
	return $out;
}

function acf_tokko_get_property_types(){

	$api_key = tokko_config('api_key');  
	$auth = new TokkoAuth($api_key); 
	$TokkoPropertyTypes = new TokkoPropertyTypes($auth);

	$out = '';
	if(!empty($TokkoPropertyTypes->property_types)){
		$out .= "<div style='max-height:200px; overflow-y:auto;'>";
		$out .= "<ul>";
		foreach ($TokkoPropertyTypes->property_types as $key => $value) {
			$out .= "<li>".$value->id." : ".$value->name."</li>";
		}
		$out .= "</ul>";
		$out .= "</div>";
	} 

	return $out;

}

function acf_tokko_get_location_types($target=''){

	$out = '<div class="tokko_get_location_types"><div class="tokko_flex_form"><input class="q" type="text" value="">';
	$attrs = '';
	if(!empty($target)){
		$attrs = 'data-sortable-target-key="'.$target.'"';
	}
	$out .= '<a class="tokko_submit_form_btn"><span class="dashicons dashicons-search"></span></a></div><div '.$attrs.' class="result" style="max-height:400px; overflow-y:auto;"></div></div>';
	return $out;
} 