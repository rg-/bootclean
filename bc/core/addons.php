<?php

$WPBC_is_acf = WPBC_is_acf(); 

/*

	CodeMirror addon for admin textareas

	Used mainly on ACF fields, Option Pages, Widgets...

*/

require "addons/bc-codemirror.php";

/*

	Duplicate posts, pages and custom post types

*/

require "addons/bc_duplicate_posts.php";

/*

	The "comming soon" redirect for non logged users.

*/
require "addons/bc-template_redirect_conditionals.php";

// Last added 9.0.1 up

require "addons/wpbc_google_maps.php"; // Not in use yet

require "addons/wpbc_get_query_posts/wpbc_get_query_posts.php"; 
require "addons/wpbc_realstate/wpbc_realstate.php";

/*

	All addons should be added this, or similar, way.

*/
$post_type_resource = !empty(WPBC_get_option( 'post-type-resource-enable' )) ? 1 : WPBC_enable_post_type_resource();

	if( !empty($post_type_resource) && $WPBC_is_acf ){
		require "addons/wpbc_resource/wpbc_resource.php";
	}