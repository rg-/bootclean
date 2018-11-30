<?php

/**
 * Bootclean wpbc_get_query_posts v1.0
 *
 * @package bootclean
 * @subpackage addons
 * @subpackage wpbc_get_query_posts
 */

/*

	WPBC_get_query_posts

	This is an all terrain addon to get any query using shortcode/s
	Also all this thing works under ajax calls that can be used anywhere.

	Use filters and actions for customization. 

*/

global $WPBC_get_query_posts;

define('WPBC_GET_QUERY_POSTS_URI', get_template_directory_uri().'/bc/core/addons/wpbc_get_query_posts' ); 
define('WPBC_GET_QUERY_POSTS_PATH', get_template_directory().'/bc/core/addons/wpbc_get_query_posts' ); 

include('enqueue_scripts.php');
include('defaults.php');
include('functions.php');
include('ajax.php');
include('shortcodes.php'); 