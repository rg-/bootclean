<?php

/*

	Realstate addon for Bootclean

*/  

define('WPBC_PROPERTY_URI', get_template_directory_uri().'/bc/core/addons/wpbc_realstate' ); 
define('WPBC_PROPERTY_PATH', get_template_directory().'/bc/core/addons/wpbc_realstate' ); 

$ACF_ENABLED = WPBC_is_acf();
$WPBC_enable_post_type_realstate = WPBC_enable_post_type_realstate();

	if( !empty($WPBC_enable_post_type_realstate) && $ACF_ENABLED ){

		include('settings.php');

		include('functions.php');

		include('init.php');

		include('rewrite_rules.php');

		include('posts_columns.php');

		include('acf.php');

		include('shortcodes.php'); 

		include('enqueue_scripts.php');

		include('wpbc_get_query_posts.php');

		include('wpbc_get_properties_map.php');

	}