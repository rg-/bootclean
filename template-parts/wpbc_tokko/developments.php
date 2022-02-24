<?php

//_print_code($args); 

$api_key = tokko_config('api_key'); 
$auth = new TokkoAuth($api_key); 
$search = new TokkoDevelopmentList($auth);

$limit = !empty($_GET['limit']) ? $_GET['limit'] : $args['limit'];
$order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : $args['order_by']; // id, name, construction_date, 
$filters = null;

if(!empty($args['filter_options'])){
	$filters = array();
	foreach ($args['filter_options'] as $key => $value) {
		$filters[] = array(
			'key' => $key,
			'value' => $value
		);
	}
} 

$pagination = $args['pagination'];
$result_detail = $args['result_detail'];

$search->get_development_list($limit, $order_by, $filters);  
// https://www.tokkobroker.com/api/v1/property/?format=json&key=e17221a413928c2f59ac76a1e1827675390b2d8d&development__id=20480
foreach ($search->get_developments() as $development){ 
	//_print_code($development);
	WPBC_get_template_part('wpbc_tokko/development', $development); 

}