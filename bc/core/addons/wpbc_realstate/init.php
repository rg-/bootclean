<?php
//flush_rewrite_rules();
add_action('init', 'wpbc_create_post_type_property' ); 

function wpbc_create_post_type_property(){

	//$property_slug = WPBC_property_get_slug();
	//$property_slug_rewrite = WPBC_property_get_slug_rewrite();
 	 
	include('init/taxonomy.php');
	include('init/post_type.php');   
	include('init/defaults.php');
	
}