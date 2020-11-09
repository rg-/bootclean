<?php

function WPBC_tokko_get_property_single_classes($property=null){
	$classes = array(
		'content_class' => '',
		'container_class' => 'container',
		'row_class' => 'row',
		'content_col_class' => 'col-md-9',
		'aside_col_class' => 'col-md-3',
	);

	$classes = apply_filters('wpbc/filter/tokko/property-single/classes',$classes,$property);
	return $classes;
}

function WPBC_tokko_property_features( $args=array() ){
		if(empty($args['property'])) return; 

		$def_features = apply_filters('wpbc/filter/tokko/property_features', array(), $args['property']);

		if(!empty($args['features'])){
			$features = $args['features'];
		}else{
			$features = $def_features;
		}

		foreach($features as $key => $value){ 

			$labels = $value['labels'];

			$val = $args['property']->get_field($value['key']);
			$label = $labels[0];
			if($val>1 || $val==0) {
				$label = $labels[1];
			}
			if($val==0) $val = '--';

			$icon = '';
			if(!empty($value['icon'])){
				$icon = '<i class="'. $value['icon'] .'"></i>';
			}

			$pos = 'ivl'; // IconValueLabel

			if($pos == 'ivl') $text = $icon . $val .' '. $label;

			if($pos == 'vli') $text =  $val .' '. $label . ' ' . $icon;

			if($pos == 'lvi') $text =   $label . ' ' . $val . $icon;

			echo '<span class="feature feature-'.$value['key'].'">'. $text .'</span>';
		}
	}

/*

	Single Property

	@hooked 'wpbc/layout/start'  

	*/

add_action('wpbc/layout/start', 'tokko_get_property_single', 31);

function tokko_get_property_single(){
 	
	$wpbc_tokko_post_object_single_property = WPBC_get_field('wpbc_tokko_post_object_single_property','options'); 
	if(is_page($wpbc_tokko_post_object_single_property)){
 		WPBC_get_template_part('wpbc_tokko/property-single');
 	}

}

add_action('wpbc/layout/body/end', 'tokko_get_property_single_modals', 41);

function tokko_get_property_single_modals(){

	$wpbc_tokko_post_object_single_property = WPBC_get_field('wpbc_tokko_post_object_single_property','options'); 
	if(is_page($wpbc_tokko_post_object_single_property)){

		 

	}
	WPBC_get_template_part('wpbc_tokko/property-single/modals');
}

add_action('tokko/property-single/content', 'WPBC_tokko_property_single_header',10,1);
function WPBC_tokko_property_single_header($property){
	WPBC_get_template_part('wpbc_tokko/property-single/header', $property);
}

add_action('tokko/property-single/content', 'WPBC_tokko_property_single_content',20,1);
function WPBC_tokko_property_single_content($property){
	WPBC_get_template_part('wpbc_tokko/property-single/content', $property);
}
/*

	Properties results (loop)

	@hooked 'tokko/get_properties/before'

		'tokko_get_properties_result_detail' 10
	
	@hooked 'tokko/get_properties/after'

		'tokko_get_properties_pagination' 10
		'tokko_get_properties_result_detail' 20

*/

//add_action('tokko/get_properties/before', 'tokko_get_properties_result_detail', 10, 4);
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