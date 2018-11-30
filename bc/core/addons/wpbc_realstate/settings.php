<?php 

/* 

	Custom settings should go inside child theme functions using filters like:


	'wpbc/filter/property/property_taxonomies'

	and then every TERM for those taxes like:

	'wpbc/filter/property/property_taxonomies/[TAX_ID]'

*/

/*

	Filtering/Creating property_taxonomies

	Locations, operation, type, services, aditionals...

*/

add_filter('wpbc/filter/property/property_taxonomies', function(){
 
	$args = array( 

		array(
			'id' => 'property_location',
			'args' => array(
				'label' => __( 'Property Locations', 'bootclean' ),
				'labels' => array(
					'add_new_item' => __( 'Add New Property Location', 'bootclean' )
				),
				'query_var' => 'property_location',
				'hierarchical' => true,
				'meta_box_cb' => false,
			), 

			'default_terms' => '',
		),

		array(
			'id' => 'property_operation',
			'args' => array(
				'label' => __( 'Property Operations', 'bootclean' ),
				'labels' => array(
					'add_new_item' => __( 'Add New Property Operation', 'bootclean' )
				),
				'query_var' => 'property_operation',
				'meta_box_cb' => false,
			), 

			'default_terms' => '',
		),

		array(
			'id' => 'property_type',
			'args' => array(
				'label' => __( 'Property Types', 'bootclean' ),
				'labels' => array(
					'add_new_item' => __( 'Add New Property Type', 'bootclean' )
				),
				'query_var' => 'property_type',
				'meta_box_cb' => false,
			),
			'default_terms' => '',
		),

		array(
			'id' => 'property_services',
			'args' => array(
				'label' => __( 'Property Services', 'bootclean' ),
				'labels' => array(
					'add_new_item' => __( 'Add New Property Service', 'bootclean' )
				),
				'query_var' => 'property_services',
				'meta_box_cb' => false,
			),
			'default_terms' => '',
		),

		array(
			'id' => 'property_aditionals',
			'args' => array(
				'label' => __( 'Property Aditionals', 'bootclean' ),
				'labels' => array(
					'add_new_item' => __( 'Add New Property Aditional', 'bootclean' )
				),
				'query_var' => 'property_aditionals',
				'meta_box_cb' => false,
			),
			'default_terms' => '',
		),

	);
 

	return $args;

},10,1);



/*

	SOME EXAMPLES BEHIND

*/


/*

	get_properties shortcode query args filter

*/ 

add_filter('wpbc/filter/property/get_term_link', function($term_link, $term_id, $taxonomy){
	// $term_link = 'OPS';
	/*

	Do something here to rewrite the term link to something used, like the ajax search results page using adecuate parameters, tax, term name/id... will depend on settings too.

	*/ 
	return $term_link; 
},10,4);

add_filter('wpbc/filter/property/form_fields',function($form_fields, $form_id){
	if($form_id=='vertical-form'){
		/*
		$form_fields = array(
			'property_type',
			'property_price_ranger'
		);
		*/
	}
	return $form_fields; 
},10,2);	

add_filter('wpbc/filter/property/form_action/before',function($out, $form_id){
	if($form_id=='vertical-form'){

	}
	return $out; 
},10,2);

add_filter('wpbc/filter/property/form_action/after',function($out, $form_id){
	if($form_id=='vertical-form'){

	}
	return $out; 
},10,2);

 







