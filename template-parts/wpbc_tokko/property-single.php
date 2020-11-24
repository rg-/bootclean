<?php

$debug = 1;  

if(isset($_GET['property_id']) || !empty(get_query_var('property_id')) ){
	
	$property_id = isset($_GET['property_id']) ? $_GET['property_id'] : null; 
	$property_id = !empty(get_query_var('property_id'))  ? get_query_var('property_id') : null; 

	$api_key = tokko_config('api_key');  
	if(empty($api_key)) return;
	$auth = new TokkoAuth($api_key); 
	if(empty($auth)) return;
	$property = new TokkoProperty('id', $property_id, $auth);
	if(empty($property)) return; 

}else{
	return;
}    

$id = $property->get_field('id');  

$classes = WPBC_tokko_get_property_single_classes($property); 

?>

<?php do_action('tokko/property-single/before', $property ); ?>

<div id="ui-property-<?php echo $id; ?>" class="ui-tokko-property-single <?php echo $classes['content_class']; ?>">

	<div class="ui-tokko-property-container <?php echo $classes['container_class']; ?>">

		<?php

		/*

			@hooked 'tokko/property-single/content'
				
				WPBC_tokko_property_single_header - 10 
				WPBC_tokko_property_single_content - 20


		*/ 

		do_action('tokko/property-single/content', $property ); ?>

	</div>

</div>

<?php do_action('tokko/property-single/after', $property ); ?>