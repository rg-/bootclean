<?php


add_filter('wpbc/filter/tokko/property_features', function($def_features, $property){

	$surface_measurement = $property->get_field("surface_measurement"); 

	$def_features = array(

		array(
			'key' => 'suite_amount',  
			'icon' => 'icon-suite_amount',
			'labels' => array('dorm','dorms'),
		),

		array(
			'key' => 'bathroom_amount',  
			'icon' => 'icon-bathroom_amount',
			'labels' => array('baño','baños'),
		),

		array(
			'key' => 'total_surface',  
			'icon' => 'icon-total_surface',
			'labels' => array($surface_measurement,$surface_measurement),
		),

		array(
			'key' => 'floors_amount',  
			'icon' => 'icon-floors_amount',
			'labels' => array('planta','plantas'),
		),

	); 
	return $def_features;

},10,2 );




/*

	Filter defaults form fields options 

*/

add_filter('wpbc/filter/tokko/form_filter/args/?id=bathroom_amount', function($args){
	$args['options'] = array(
		array(
			'value' => 1,
			'name' => '1 baño',
			'cond' => '=',
		),
		array(
			'value' => 2,
			'name' => '2 baños',
			'cond' => '=',
		),
		array(
			'value' => 3,
			'name' => '3 baños',
			'cond' => '=',
		),
		array(
			'value' => 4,
			'name' => 'Más de 3 baños',
			'cond' => '>',
		),
	);
	return $args;
},10,1);

add_filter('wpbc/filter/tokko/form_filter/args/?id=suite_amount', function($args){
	$args['options'] = array(
		array(
			'value' => 1,
			'name' => '1 dorm',
			'cond' => '=',
		),
		array(
			'value' => 2,
			'name' => '2 dorms',
			'cond' => '=',
		),
		array(
			'value' => 3,
			'name' => '3 dorms',
			'cond' => '=',
		),
		array(
			'value' => 4,
			'name' => 'Más de 3 dorms',
			'cond' => '>',
		),
	);
	return $args;
},10,1);


add_filter('wpbc/filter/tokko/form_filter/args/?id=order_by', function($args){
	$args['options'] = array(
		'price' => 'Precio',
		'id' => 'ID',
		'random' => 'Rándomico',
		'room_amount' => 'Abitaciones',
		'suite_amount' => 'Dormitorios',
		'bathroom_amount' => 'Baños',
		);
	return $args;
},10,1);

add_filter('wpbc/filter/tokko/form_filter/args/?id=order', function($args){
	$args['options'] = array(
		'asc' => 'Ascendente',
		'desc' => 'Descendente',
		);
	return $args;
},10,1);

add_filter('wpbc/filter/tokko/form_filter/args/?id=property_prices', function($args){
	$args['options'] = array(
		array(
			'value' => '0|9999999999',
			'label' => 'Rango de precios'
		),
		array(
			'value' => '0|20000',
			'label' => 'De 0 a 20.000'
		),
		array(
			'value' => '20000|50000',
			'label' => 'De 20.000 a 50.000'
		),
		array(
			'value' => '50000|80000',
			'label' => 'De 50.000 a 80.000'
		),
		array(
			'value' => '80000|150000',
			'label' => 'De 80.000 a 150.000'
		),
		array(
			'value' => '150000|9999999999',
			'label' => 'Más de 150.000'
		),
	);
	return $args;
},10,1);