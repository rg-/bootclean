<?php

/*

	Get defaults parrameters for search form

	Also filtered

	This functions is the brain behind search results

*/

function WPBC_get_tokko_search_defaults($args=array()){
	$defaults = array();

	$limit = !empty($args['limit']) ? $args['limit'] : 9; 
	$order_by = !empty($args['order_by']) ? $args['order_by'] : 'price';
	$order = !empty($args['order']) ? $args['order'] : 'desc'; // desc/asc
	$page = 1;

	$pagination = $args['pagination']; 
	$result_detail = $args['result_detail']; 

	$operation_types = !empty($args['operation_types']) ? array($args['operation_types']) : array();
	$property_types = !empty($args['property_types']) ? array($args['property_types']) : array(); 


	$localizations = !empty($args['localizations']) ? array($args['localizations']) : null; 

	$current_localization_id = 0;
	$current_localization_type = 'country';
	if(!empty($localizations)){
		$current_localization_id = $localizations;
		$current_localization_type = 'division';
	}

	/* 
	filters specific 
	*/
	//_print_code($args['filter_options']);
	$filter_options = !empty($args['filter_options']) ? $args['filter_options'] : array();

	$filters = array(); 


	$is_starred_on_web = !empty($filter_options['field_is_starred_on_web']) ? $filter_options['field_is_starred_on_web'] : ( !empty($filter_options['is_starred_on_web']) ? $filter_options['is_starred_on_web'] : 0 );

	if($is_starred_on_web){
		$filters[] = array('is_starred_on_web', '=', 1);
	}  

	// $temp = array();
	foreach ($filter_options as $filter) {
		// _print_code($filter); 
		if(is_array($filter)){
			$filters[] = $filter;
		 }else{
			
		}
	}
	// _print_code($filters);
	//$filters[] = array('reference_code', '=', 7); 
	//_print_code($filter_options);
	//_print_code($temp);
	//_print_code($filters);
	$search_data = array( 
		'current_localization_id' => $current_localization_id,
		'current_localization_type' => $current_localization_type,
		'price_from' => 0,
		'price_to' => 9999999999,
		'operation_types' => $operation_types,
		'property_types' => $property_types,
		'currency' => 'USD',
		'filters' => $filters
	);

	if(isset($_REQUEST['limit'])){
		$limit = $_REQUEST['limit'];
	}
	if(isset($_REQUEST['tk_order_by'])){
		$order_by = $_REQUEST['tk_order_by'];
	} 
	if(isset($_REQUEST['tk_order'])){
		$order = $_REQUEST['tk_order'];
	}
	if(isset($_REQUEST['tk_page'])){
		$page = $_REQUEST['tk_page'];
	} 
	if(isset($_REQUEST['data'])){
		$search_data = json_decode($bodytag = str_replace("\\", "", $_REQUEST['data']), true);
	} 

	$defaults['limit'] = $limit;
	$defaults['order_by'] = $order_by;
	$defaults['order'] = $order;
	$defaults['page'] = $page;
	$defaults['pagination'] = $pagination;
	$defaults['result_detail'] = $result_detail;  
	$defaults['search_data'] = $search_data; 

	/* Filtering custom parameters (nice urls maybe?) */ 
	$defaults = apply_filters('wpbc/filter/tokko/search_vars',$defaults);

	return $defaults;
}


/*

	Form build functions

	Template form fields

	@see template-parts/wpbc_tokko/form/default.php examples

*/

function WPBC_tokko_form_build_options($select_args = array(
	'options' => null,
	'args' => array(),
)){
	$out = '';
	 if(!empty($select_args['options']) && !empty($select_args['id'])){
	 		
	 		$current_data = WPBC_tokko_form_get_encoded_data($select_args['args']);
	 		$show_all = !empty($select_args['args']['show_all']) ? $select_args['args']['show_all'] : __('Show all', 'bootclean');
	 		$id = !empty($select_args['id']) ? $select_args['id'] : ''; 

			$field_args = WPBC_tokko_get_common_select_args($id,$select_args['args']); 

	 		$out .= '<select '.$field_args['field_attrs'].' class="ui-tokko-'.$id.' '.$field_args['field_class'].'">';
	 		
	 		if(empty($select_args['args']['hide_show_all'])){
	 			$out .= '<option value="0">'.$show_all.'</option>';
	 		}
	 		
	 		foreach ($select_args['options'] as $key => $value) {
	 			$selected = '';
	 		
	 			if(!empty($current_data) && is_array($current_data[$id]) && in_array($value['id'], $current_data[$id])){
					$selected = 'selected';
				}
	 			$out .= '<option '.$selected.' value="'.$value['id'].'">'. $value['name'] .'</option>';
	 		
	 		}
	 		
	 		$out .= '</select>';
	 }
	 if(!empty($out)){
	 	$out = $field_args['field_before'] . $out . $field_args['field_after'];
	 }
	 return $out;
}

function WPBC_tokko_form_build_filter_amount_options($select_args=array()){
	$out = '';

	$has_selected = false;
	$current_data = WPBC_tokko_form_get_encoded_data($select_args['args']); 
	if(!empty($current_data['filters'])){
		foreach ($current_data['filters'] as $k => $v) {
			if(in_array($select_args['id'], $v)){ 
				$has_selected = $v[2];
			}
		}
	}  

	$field_args = WPBC_tokko_get_common_select_args($select_args['id'],$select_args['args']);

	$out .= '<select '.$field_args['field_attrs'].' data-name="'.$select_args['id'].'" class="ui-tokko-'.$select_args['id'].' ui-tokko-filter '.$field_args['field_class'].'">';

		$show_all = !empty($select_args['args']['show_all']) ? $select_args['args']['show_all'] : __('Show all', 'bootclean'); 
 	 
 		if(empty($select_args['args']['hide_show_all'])){
 			$out .= '<option value="0">'.$show_all.'</option>';
 		}
 
		foreach ($select_args['options'] as $key => $value) {
			$selected = '';
			if($has_selected && $value['value'] == $has_selected){ 
				$selected = 'selected';
			} 
			$out .= '<option '.$selected.' data-cond="'.$value['cond'].'" value="'.$value['value'].'">'.$value['name'].'</option>';
		}
		$out .= '</select>';

		if(!empty($out)){
		 	$out = $field_args['field_before'] . $out . $field_args['field_after'];
		 }

	return $out; 
}

/* WPBC_tokko_form_* Template functions */

function WPBC_tokko_get_common_select_args($id=null,$args=array()){
	if(!empty($id)){

		$field_before = '<div class="form-group">';
		$field_after = '</div>';
		
		$field_class = 'use_selectpicker form-control shadow';
		
		$field_attrs = ' data-tokko-form="change" data-style="btn-white" data-dropup="false" data-container="body" data-flip="false" ';

		// multiple title="Elegir"

		if(!empty($args['submit_on_change'])){
				$field_attrs .= ' data-trigger="submit" ';
		} 
		if(!empty($args['trigger_to'])){
				$field_attrs .= ' data-trigger-to="'.$args['trigger_to'].'" ';
		} 

		$return = array(
			'field_before' => $field_before,
			'field_after' => $field_after,
			'field_class' => $field_class,
			'field_attrs' => $field_attrs,
		);

		return $return;
	}
}

function WPBC_tokko_form_order_by($args=array()){
	$out = '';  
	
	$select_args = WPBC_tokko_get_common_select_args('order_by',$args);

	$out .= '<select '.$select_args['field_attrs'].' data-name="order_by" class="ui-tokko-order_by '.$select_args['field_class'].'">'; 

	$def_selected = 'price';
	if(!empty($args['search_data']['order_by'])){
		$def_selected = $args['search_data']['order_by'];
	}
	if(!empty($_REQUEST['tk_order_by'])){
		$def_selected = $_REQUEST['tk_order_by'];
	}  

	$options = null;
	if(!empty($args['options'])){
		$options = $args['options'];
	}
	$args = apply_filters('wpbc/filter/tokko/form_filter/args/?id=order_by', $args);
	if(!empty($options)){
		$args['options'] = $options;
	}
	$options = $args['options'];

	foreach ($options as $key => $value) {
		$selected = '';
		if($def_selected == $key){
			$selected = 'selected';
		}
		$out .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
	} 
	$out .= '</select>';

	if(!empty($out)){
	 	$out = $select_args['field_before'] . $out . $select_args['field_after'];
	 }

	echo $out;
}
function WPBC_tokko_form_order($args=array()){
	$out = ''; 
	
	$select_args = WPBC_tokko_get_common_select_args('order',$args);

	$out .= '<select '.$select_args['field_attrs'].' data-name="order" class="ui-tokko-order '.$select_args['field_class'].'">';  
	
	$def_selected = 'desc';
	if(!empty($args['search_data']['order'])){
		$def_selected = $args['search_data']['order'];
	}
	if(!empty($_REQUEST['tk_order'])){
		$def_selected = $_REQUEST['tk_order'];
	} 
 

	$options = null;
	if(!empty($args['options'])){
		$options = $args['options'];
	}
	$args = apply_filters('wpbc/filter/tokko/form_filter/args/?id=order', $args);
	if(!empty($options)){
		$args['options'] = $options;
	}
	$options = $args['options'];
	
	foreach ($options as $key => $value) {
		$selected = '';
		if($def_selected == $key){
			$selected = 'selected';
		}
		$out .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
	} 
	$out .= '</select>';
	
	if(!empty($out)){
	 	$out = $select_args['field_before'] . $out . $select_args['field_after'];
	 }

	echo $out;
}


function WPBC_tokko_form_submit($args=array(
		'label' => 'Buscar',
		'class' => 'btn btn-primary',
	)){
	$select_args = WPBC_tokko_get_common_select_args('submit',$args);
	$out = '';
	$out .= '<button data-tokko-form="submit" class="'.$args['class'].'" type="button">'.$args['label'].'</button>';
	if(!empty($out)){
	 	$out = $select_args['field_before'] . $out . $select_args['field_after'];
	 }
	echo $out;

}  

function WPBC_tokko_form_property_prices($args=array()){
	
	$id = 'property_prices';
	$options = null;
	if(!empty($args['options'])){
		$options = $args['options'];
	}
	$args = apply_filters('wpbc/filter/tokko/form_filter/args/?id='.$id.'', $args);
	if(!empty($options)){
		$args['options'] = $options;
	}
 	
 	$field_args = WPBC_tokko_get_common_select_args($id,$args);
 	
	$out = '';

	$options = $args['options'];
	if(!empty($options)){ 
 		$current_data = WPBC_tokko_form_get_encoded_data($args);
 		 
 		$out .= '<select '.$field_args['field_attrs'].' class="ui-tokko-'.$id.' '.$field_args['field_class'].'">';

			$price_from = $current_data['price_from'];
			$price_to = $current_data['price_to'];
			$price_comp = $price_from.'|'.$price_to; 
			foreach ($options as $key => $value) {
				$selected = "";
				if($value['value'] == $price_comp ){
					$selected = "selected";
				}
				$out .= '<option '.$selected.' value="'.$value['value'].'">'.$value['label'].'</option>';
			}
			$out .= '</select>'; 
	}
	if(!empty($out)){
	 	$out = $field_args['field_before'] . $out . $field_args['field_after'];
	 }
	echo $out; 
}  

function WPBC_tokko_form_operation_types($args=array()){
	
	$out = '';
	$operations = WPBC_tokko_get_available_operation_types();
	if(!empty($operations)){ 

		$out .= WPBC_tokko_form_build_options(array(
			'options' => $operations,
			'args' => $args,
			'id' => 'operation_types', 
		));

	}
	echo $out; 
}  

function WPBC_tokko_form_property_types($args=array()){
 
	$out = '';
	$property_types = WPBC_tokko_get_available_property_types();
	if(!empty($property_types)){ 

		$out .= WPBC_tokko_form_build_options(array(
			'options' => $property_types,
			'args' => $args,
			'id' => 'property_types', 
		));

	}  
	echo $out; 

}


function WPBC_tokko_form_localization($args=array()){ 
	$out = '';
	$available_locations = WPBC_tokko_get_available_localizations();
	if(!empty($available_locations)){ 
		$out .= WPBC_tokko_form_build_options(array(
			'options' => $available_locations,
			'args' => $args,
			'id' => 'current_localization_id', 
		));
	}
	echo $out; 
}



function WPBC_tokko_form_filter_amount($args=array()){ 
	$out = '';
	$options = null;
	if(!empty($args['options'])){
		$options = $args['options'];
	}
	$args = apply_filters('wpbc/filter/tokko/form_filter/args/?id='.$args['id'].'', $args);
	if(!empty($options)){
		$args['options'] = $options;
	}
	if(!empty($args['options'])){

		$out .= WPBC_tokko_form_build_filter_amount_options(array(
			'options' => $args['options'],
			'args' => $args,
			'id' => $args['id'], 
		));
	}
	echo $out; 
	
} 