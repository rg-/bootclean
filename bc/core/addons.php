<?php

$WPBC_is_acf = WPBC_is_acf(); 

function WPBC_masonry_installed(){ 
	return apply_filters('wpbc/filter/masonry/installed', 0);
}

/*

	wpbc-disable-blog addon (not installed by default)
	@since v12
	@since may 2021 

*/
require "addons/wpbc-tinymce.php";

/*

	wpbc-disable-blog addon (not installed by default)
	@since v12
	@since abr 2021 

*/
require "addons/wpbc-disable-blog.php";


/*
	
	TESTING

*/
require "addons/wpbc-rest-api.php";

/*

	wpbc-layout-typography (multipe installed on/off options)
	@since v12
	@since abr 2021

	Manage the entire way Typography is embeded into pages,
	and how styles are used.

*/

require "addons/wpbc-layout-typography.php";

/*

	wpbc-layout-blog addon (not installed by default)
	@since v12
	@since abr 2021

	Complete layout for blog posts, archives, category, tags, so on...

*/

require "addons/wpbc-layout-blog.php";

/*

	flex_builder addon (if installed)	
	@since v11
	@since feb 2021

	Will replace OLD builder layouts with the new way, back and front end.

*/
require "addons/wpbc-flex_builder.php";

/*

	theme settings addon (if installed)	
	@since v11
*/
require "addons/wpbc-theme-settings.php";

/*

	wpbc_is_inview addon (if installed)	
	@since v11
*/
require "addons/wpbc-is-inview.php";



require "addons/wpbc-masonry.php";

/*

	Custom Login addon 
	@since v11
	(old cleaner/login)

*/
require "addons/wpbc-custom-login.php"; 

/*

	private areas addon (if installed)	
	@since v11
*/
require "addons/wpbc-private-areas.php";
/*

	parallax addon (if installed)	

*/
require "addons/wpbc-parallax.php";
/*

	tokko addon (if installed)	

*/
require "addons/wpbc-tokko.php";
/*

	swup addon (if installed)	

*/
require "addons/wpbc-swup.php";

/*

	pjax addon (if installed)	

*/
require "addons/wpbc-pjax.php";

/*

	qtranslate addon (if installed)	

*/
require "addons/bc-qtranslate.php";

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

	Contact Form 7 things

*/

require "addons/bc-wpcf7.php";

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