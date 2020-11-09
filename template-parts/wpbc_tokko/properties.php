<?php   

/**
 * @subpackage Shortcode "[WPBC_get_tokko_properties]"
 *
 * 	@see $args from shortcode, direct function or builder flexible layout
 * 
 * 	@see _print_code($args);
 *
 */  
	 
$debug_mode = 0;

$use_query_vars = 1; // 1/0 

$search_defaults = WPBC_get_tokko_search_defaults($args);
	
	$limit = $search_defaults['limit'];
	$order_by = $search_defaults['order_by'];
	$order = $search_defaults['order'];
	$page = $search_defaults['page'];
	$search_data = $search_defaults['search_data'];

	$pagination = $search_defaults['pagination'];
	$result_detail = $search_defaults['result_detail'];

/*

	TokkoAuth > TokkoSearch > do_search

*/
	$api_key = tokko_config('api_key');  
	$auth = new TokkoAuth($api_key); 
	$search = new TokkoSearch($auth, $search_data);  
	$search->do_search($limit, $order_by, $order);  

	$search->default_page_limit = $limit; 
	$search->default_search_order = $order; 
	$search->default_search_order_by = $order_by;
 
?>

<?php if(!empty( $args['section_header'] )){ ?>
	<?php WPBC_get_template_part('wpbc_tokko/properties/section_header', array(
		'section_args' => $args,
		'search' => $search,
	)); ?>
<?php } ?>

<div class="ui-tokko-properties position-relative">
	 

		<?php 
				$input_type = 'hidden'; 
				$btn_class = 'd-none';
				if($debug_mode){
					$input_type = 'text';
					$btn_class = '';
				} 

				global $wp;
				$form_action = "/";
				$url_parameters = home_url(add_query_arg(array(), $wp->request));
				$url_request = $wp->request;
				if(!empty($url_request)){
					$form_action = home_url($url_request).'/';
				} 

			?>

		<form id="<?php echo $args['linked_results_id']; ?>" method="get" data-tokko="searchform" data-swup-form class="ui-tokko-searchform" action="<?php echo $form_action; ?>"> 
			<input type="<?php echo $input_type; ?>" name="tk_order_by" value='<?php echo $order_by; ?>'>
			<input type="<?php echo $input_type; ?>" name="limit" value='<?php echo $limit; ?>'>
			<input type="<?php echo $input_type; ?>" name="tk_order" value='<?php echo $order; ?>'>
			<input type="<?php echo $input_type; ?>" name="tk_page" value='<?php echo $page; ?>'>
			<input type="<?php echo $input_type; ?>" name="use_query_vars" value='<?php echo $use_query_vars; ?>'>
			<input class="w-100 small p-3" type="<?php echo $input_type; ?>" name="data" value='<?php echo json_encode($search_data); ?>'>  
			<button class="<?php echo $btn_class; ?>" type="submit">Submit</button> 
		</form>

		<?php

			$include_form = false;
			if($include_form){
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
			}
			?>

		<div id="ajax-loader" class="ui-tokko-properties-holder">
	  	  
	    	<?php  
					do_action('tokko/get_properties/before', $search, $use_query_vars, $pagination, $result_detail);

				?>
				<div data-ajax="properties">

					<?php
						$row_class = apply_filters('wpbc/filter/tokko/properties/class', 'row row-half-gutters');
						$col_class = apply_filters('wpbc/filter/tokko/properties/item/class', 'col-md-4 gmb-1');
						$row_attrs = apply_filters('wpbc/filter/tokko/properties/attrs', '');
						$col_attrs = apply_filters('wpbc/filter/tokko/properties/item/attrs', '');
					?>
					<div class="<?php echo $row_class; ?>" <?php echo $row_attrs; ?>>

						<?php if(!empty($search->get_properties()) ) { ?>

						<?php foreach ($search->get_properties() as $property){
							?>
							<div class="<?php echo $col_class; ?>" <?php echo $col_attrs; ?>>
								<?php
								WPBC_get_template_part('wpbc_tokko/property', $property);
								?>
							</div>
							<?php
						} ?>

						<?php }else{ ?>
							<?php
								WPBC_get_template_part('wpbc_tokko/properties/no_results', $search);
								?>
						<?php }?>

					</div>
					
				</div>

				<?php

					/*
					
					@hooked 'tokko/get_properties/after'

						'tokko_get_properties_pagination' 10
						'tokko_get_properties_result_detail' 20

					*/
					
					do_action('tokko/get_properties/after', $search, $use_query_vars, $pagination, $result_detail);

				?>

	  </div>
 

</div>