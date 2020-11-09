<?php 

// If AJAX CALL
if(empty($args)){ 

	$api_key = tokko_config('api_key'); 
	$auth = new TokkoAuth($api_key); 
	$search = new TokkoSearch($auth);
	$limit = $_REQUEST['limit'];
	$order_by = $_REQUEST['tk_order_by'];
	$order = $_REQUEST['tk_order'];
	$pagination = $_REQUEST['pagination'];
	$result_detail = $_REQUEST['result_detail'];
	$search->do_search($limit, $order_by, $order); 
	$use_query_vars = $_REQUEST['use_query_vars'];

}else{ 

	$search = $args['search']; 
	/*
	$search->default_page_limit = $args['limit']; 
	$search->default_search_order = $args['order']; 
	$search->default_search_order_by = $args['order_by'];
	*/ 

	$pagination = $args['pagination'];
	$result_detail = $args['result_detail'];
	$use_query_vars = $args['use_query_vars'];

} 
?> 

<?php 

	/*

	@hooked 'tokko/get_properties/before'

		'tokko_get_properties_result_detail' 10

	*/
	
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
			<div class="col-12 ">
				<p class="lead text-center">There are no search results with that criteria.</p>
			</div>
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