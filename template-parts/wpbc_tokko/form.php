<?php  
	$debug_mode = false;
	$use_query_vars = true;

	global $tokko_in_use;  

	$search_data = !empty($args['search']) ? $args['search'] : null;   
	$use_form = false;

	if(!$search_data && isset($args['linked_results']) && !empty($args['linked_results_id']) ){
		
		global $post; 
		$post_id = null;
		
		$linked_results_id = $args['linked_results_id'];
		if($args['linked_results']==0){
			$post_id = $post->ID;
		}

		if($args['linked_results']==1 && !empty($args['linked_results_page'])){ 
			$post_id = $args['linked_results_page']; 
			$use_form = true;
		}

		$row = WPBC_get_tokko_linked_results_id($post_id, $linked_results_id);
		
		//_print_code($row);  
	   
		$prefix = 'ui-tokko-properties_';  

		$operation_types = $row[$prefix.'operation_types'];
		$property_types = $row[$prefix.'property_types']; 
		$localizations = $row[$prefix.'localizations']; 
		$filter_options =  $row[$prefix.'filters'];
		$pagination_options = $row[$prefix.'pagination'];

		$nargs = array(

			'operation_types' => $operation_types,
			'property_types' => $property_types,
			'localizations' => $localizations,
			'order_by' => $pagination_options['field_order_by'],
			'order' => $pagination_options['field_order'],
			'limit' => $pagination_options['field_limit'],
			'pagination' => $pagination_options['field_pagination'],
			'result_detail' => $pagination_options['field_result_detail'], 
			'filter_options' => $filter_options,
			'properties_id' => $row[$prefix.'id'], 

		);
		$search_defaults = WPBC_get_tokko_search_defaults($nargs);

			$limit = $search_defaults['limit'];
			$order_by = $search_defaults['order_by'];
			$order = $search_defaults['order'];
			$page = $search_defaults['page'];
			$search_data = $search_defaults['search_data'];

			$api_key = tokko_config('api_key');  
			$auth = new TokkoAuth($api_key); 
			$search = new TokkoSearch($auth, $search_data);  
			$search->do_search($limit, $order_by, $order);  

			$search->default_page_limit = $limit; 
			$search->default_search_order = $order; 
			$search->default_search_order_by = $order_by;

			$this_tokko_in_use = array(
	 			'limit' => $limit,
	 			'order_by' => $order_by,
	 			'order' => $order,
	 			'search' => $search,
	 		);

			$search_data = $this_tokko_in_use; 

			if($use_form){
				$input_type = 'hidden'; 
				$btn_class = 'd-none';
				if($debug_mode){
					$input_type = 'text';
					$btn_class = '';
				} 

				$form_action = get_permalink($post_id);
				?>
<form id="<?php echo $args['linked_results_id'];?>" method="get" data-tokko="searchform" data-swup-form class="ui-tokko-searchform" action="<?php echo $form_action; ?>"> 
	<input type="<?php echo $input_type; ?>" name="tk_order_by" value='<?php echo $order_by; ?>'>
	<input type="<?php echo $input_type; ?>" name="limit" value='<?php echo $limit; ?>'>
	<input type="<?php echo $input_type; ?>" name="tk_order" value='<?php echo $order; ?>'>
	<input type="<?php echo $input_type; ?>" name="tk_page" value='<?php echo $page; ?>'>
	<input type="<?php echo $input_type; ?>" name="use_query_vars" value='<?php echo $use_query_vars; ?>'>
	<input class="w-100 small p-3" type="<?php echo $input_type; ?>" name="data" value='<?php echo json_encode($search_defaults['search_data']); ?>'>  
	<button class="<?php echo $btn_class; ?>" type="submit">Submit</button> 
</form>
				<?php
				if($debug_mode)echo $form_action; 
			}
	}

?>

<?php if(!empty($args['action'])){

	$search_defaults = WPBC_get_tokko_search_defaults($args);
	
	$limit = $search_defaults['limit'];
	$order_by = $search_defaults['order_by'];
	$order = $search_defaults['order'];
	$page = $search_defaults['page'];
	$search_data = $search_defaults['search_data'];

	$pagination = $search_defaults['pagination'];
	$result_detail = $search_defaults['result_detail'];

	$input_type = 'hidden'; 
	$btn_class = 'd-none';
	if($debug_mode){
		$input_type = 'text';
		$btn_class = '';
	} 

	$form_action = $args['action'];

	?>
	<form method="get" data-tokko="searchform" data-swup-form class="ui-tokko-searchform" action="<?php echo $form_action; ?>"> 
			<input type="<?php echo $input_type; ?>" name="tk_order_by" value='<?php echo $order_by; ?>'>
			<input type="<?php echo $input_type; ?>" name="limit" value='<?php echo $limit; ?>'>
			<input type="<?php echo $input_type; ?>" name="tk_order" value='<?php echo $order; ?>'>
			<input type="<?php echo $input_type; ?>" name="tk_page" value='<?php echo $page; ?>'>
			<input type="<?php echo $input_type; ?>" name="use_query_vars" value='<?php echo $use_query_vars; ?>'>
			<input class="w-100 small p-3" type="<?php echo $input_type; ?>" name="data" value='<?php echo json_encode($search_data); ?>'>  
			<button class="<?php echo $btn_class; ?>" type="submit">Submit</button> 
		</form>

<?php } ?>

<div data-linked-results-id="<?php echo $args['linked_results_id'];?>" data-tokko="searchform-controls" class="ui-tokko-searchform-controls gmy-1"> 

		<?php
		$template = 'default';
		if(!empty($args['template'])){
			$template = $args['template']; 
		} 
		WPBC_get_template_part('wpbc_tokko/form/'.$template, $search_data); ?> 

</div>