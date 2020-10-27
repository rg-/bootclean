<?php   

/**
 * @subpackage Shortcode "[WPBC_get_tokko_properties]"
 *
 *
 *	$args passed
 * _print_code($args);
 *	 
 *
 */  
	
	/* order_by:
		random
		price 
		location
		suite_amount
		is_starred_on_web
		age
		situation
		expenses
		room_amount
		bathroom_amount
		toilet_amount
		parking_lot_amount
		floors_amount
		surface
		roofed_surface
		semiroofed_surface
		total_surface 
	*/
	
	/*

		ajax, onload (load first time by ajax or direct on html, rest pages will load using ajax)
		
	*/
$debug_mode = false;
$output_type = 'onload';
$use_query_vars = 1; // 1/0

$ajax_get_properties = tokko_config('templates')['ajax_get_properties'];

$api_key = tokko_config('api_key');  
$auth = new TokkoAuth($api_key); 

$limit = $args['limit']; 
$order_by = $args['order_by'];
$order = $args['order']; // desc/asc
$pagination = $args['pagination']; 
$result_detail = $args['result_detail']; 

$operation_types = !empty($args['operation_types']) ? array($args['operation_types']) : array();
$property_types = !empty($args['property_types']) ? array($args['property_types']) : array();

$page = 1;

	$is_starred_on_web = false;

	$search_data = array( 
		'current_localization_id' => 0,
		'current_localization_type' => 'country',
		'price_from' => 0,
		'price_to' => 9999999999,
		'operation_types' => $operation_types,
		'property_types' => $property_types,
		'currency' => 'USD',
		'filters' => array( )
	);  

if($is_starred_on_web){
	$search_data['filters'][] = array('is_starred_on_web', '=', 1);
} 

if(isset($_REQUEST['data'])){
		$search_data = json_decode($bodytag = str_replace("\\", "", $_REQUEST['data']), true);
	} 

if(isset($_REQUEST['tk_order_by'])){
	$order_by = $_REQUEST['tk_order_by'];
}
if(isset($_REQUEST['limit'])){
	$limit = $_REQUEST['limit'];
}
if(isset($_REQUEST['tk_order'])){
	$order = $_REQUEST['tk_order'];
}
if(isset($_REQUEST['tk_page'])){
	$page = $_REQUEST['tk_page'];
}

if($output_type == 'onload'){ 

	$search = new TokkoSearch($auth, $search_data);  
	$search->do_search($limit, $order_by, $order);   
}

$ajax_params = '&tk_order_by='.$order_by;  // id, is_starred_on_web
$ajax_params .= '&limit='.$limit;
$ajax_params .= '&tk_order='.$order;
$ajax_params .= '&tk_page='.$page; 

$json_data = json_encode($search_data);

$ajax_params_data = '&data='.$json_data; 

$ajax_params .= $ajax_params_data;

$ajax_params .= '&use_query_vars='.$use_query_vars; 
$ajax_params .= '&pagination='.$pagination;  
$ajax_params .= '&result_detail='.$result_detail;  

  $ajax_onload_url = $ajax_get_properties.$ajax_params;
?>

<div class="ui-tokko-properties position-relative">

	<form data-tokko="searchform" data-swup-form class="ui-tokko-searchform" action="/">

		<?php
			
			$input_type = 'hidden';
			if($debug_mode){
				$input_type = 'text';
			}
		?>

		<input type="<?php echo $input_type; ?>" name="tk_order_by" value='<?php echo $order_by; ?>'>
		<input type="<?php echo $input_type; ?>" name="limit" value='<?php echo $limit; ?>'>
		<input type="<?php echo $input_type; ?>" name="tk_order" value='<?php echo $order; ?>'>
		<input type="<?php echo $input_type; ?>" name="tk_page" value='<?php echo $page; ?>'>
		<input type="<?php echo $input_type; ?>" name="use_query_vars" value='<?php echo $use_query_vars; ?>'>
		<input class="w-100 small p-3" type="<?php echo $input_type; ?>" name="data" value='<?php echo $json_data; ?>'>
		
		<?php
		WPBC_get_template_part('wpbc_tokko/form', array(
			'limit' => $limit,
			'order'=> $order,
			'order_by' => $order_by,
			'pagination' => $pagination,
			'result_detail' => $result_detail,
			'page' => $page,
			'search' => $search, 
			'use_query_vars' => $use_query_vars,
		));
		?>

	</form>

  <div class="container">
    <div id="ajax-loader" class="ajax-load-holder ajax-loading-min-height" <?php if($output_type == 'ajax'){ echo "data-ajax-onload='".$ajax_onload_url."'";  }?> >

    	<!-- -->
 			<?php if($output_type == 'onload') {

 				WPBC_get_template_part('wpbc_tokko/ajax/get_properties', array(
 					'limit' => $limit,
 					'order'=> $order,
 					'order_by' => $order_by,
 					'search' => $search, 
 					'pagination' => $pagination,
 					'result_detail' => $result_detail,
 					'use_query_vars' => $use_query_vars,
 				));

 			} ?>
    	<!-- -->

    </div>

  </div>

</div>