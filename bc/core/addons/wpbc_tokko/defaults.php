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