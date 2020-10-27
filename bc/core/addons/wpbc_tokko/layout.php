<?php

/*

	@hooked 'tokko/get_properties/before'

		'tokko_get_properties_result_detail' 10
	
	@hooked 'tokko/get_properties/after'

		'tokko_get_properties_pagination' 10
		'tokko_get_properties_result_detail' 20

*/

add_action('tokko/get_properties/before', 'tokko_get_properties_result_detail', 10, 4);
add_action('tokko/get_properties/after', 'tokko_get_properties_pagination', 10, 4);
add_action('tokko/get_properties/after', 'tokko_get_properties_result_detail', 20, 4);

function tokko_get_properties_pagination($search, $use_query_vars, $pagination, $result_detail){
	if($pagination){
		WPBC_get_template_part('wpbc_tokko/properties/pagination', array(
			'search' => $search, 
			'use_query_vars' => $use_query_vars,
		));
	}
}

function tokko_get_properties_result_detail($search, $use_query_vars, $pagination, $result_detail){
	if($result_detail){
		WPBC_get_template_part('wpbc_tokko/properties/result_detail', array(
			'search' => $search, 
			'use_query_vars' => $use_query_vars,
		));
	}
} 