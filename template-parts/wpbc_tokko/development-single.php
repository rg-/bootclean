<?php
	
	$development = $args;

	if(isset($_GET['development_id']) || !empty(get_query_var('development_id')) ){
	
	$development_id = isset($_GET['development_id']) ? $_GET['development_id'] : null; 
	$development_id = !empty(get_query_var('development_id'))  ? get_query_var('development_id') : null; 

	$api_key = tokko_config('api_key');  
	if(empty($api_key)) return;
	$auth = new TokkoAuth($api_key); 
	if(empty($auth)) return;
	$development = new TokkoDevelopment('id', $development_id, $auth);
	if(empty($development)) return; 

}else{
	return;
}  

$id = $development->get_field('id');  

$classes = WPBC_tokko_get_property_single_classes($development); 

?> 

<?php do_action('tokko/development-single/before', $development ); ?>

<div id="ui-development-<?php echo $id; ?>" class="ui-tokko-property-single ui-tokko-development-single <?php echo $classes['content_class']; ?>">

	<div class="ui-tokko-property-container <?php echo $classes['container_class']; ?>">

		<?php

		/*

			@hooked 'tokko/development-single/content'
				
				WPBC_tokko_development_single_header - 10

				WPBC_tokko_development_single_content - 20


		*/

		do_action('tokko/development-single/content', $development ); ?>

	</div>

</div>

<?php do_action('tokko/development-single/after', $development ); ?>