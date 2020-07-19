<?php

/**
 * Bootclean Core files
 *
 * @package bootclean
 * @subpackage core functions
 */ 

 /*
 *
 * BC Core Main functions
 *
*/
require BC_WP_DIR . 'core/functions.php'; 

require BC_WP_DIR . 'core/theme-settings.php'; 

require BC_WP_DIR . 'core/theme-helpers.php'; 

require BC_WP_DIR . 'core/admin.php';

require BC_WP_DIR . 'core/template-landing-builder.php';
require BC_WP_DIR . 'core/template-builder.php';
require BC_WP_DIR . 'core/template-tags-init.php';


/* 
	Theme Options framework, works idependent from theme inside theme-options/ folder. Defaults will be the ones taked from BC_theme_root() global array also. Be aweare of that.
*/
require BC_WP_DIR . 'core/theme-options.php';
require BC_WP_DIR . 'core/theme-options-functions.php';
require BC_WP_DIR . 'core/theme-options-defaults.php';
/* ############################################################ */
/* ############################################################ */ 

/*
	IMPORTANT: Initial theme setup, not placed before theme-options, becaouse setup settings will also depend on options used.
*/
/* ############################################################ */
/* ############################################################ */
/* 
	Initial theme setup, textdomain, theme_support, and so on.
*/
require BC_WP_DIR . 'core/setup.php'; 
/* 
	Cleaner, all in one everything to make wp as minimal and customizable as posible, ex: custom branded login, no comments (no blog), cleanner head, no gravatars, and so, so, so on. To be continued all the time!! 
*/
require BC_WP_DIR . 'core/cleaner.php'; 

/* 
	Customize Things
*/
// require BC_WP_DIR . 'core/customize.php';
/* 
	GUTENBERG Things
*/
require BC_WP_DIR . 'core/gutenberg.php';


/* 
	Enqueue styles/scripts 
*/
require BC_WP_DIR . 'core/enqueue.php';
/* 
	Template tags/functions ([theme]/template-parts/...)
*/
require BC_WP_DIR . 'core/template-tags.php';
/* 
	Template Shortcodes
*/
require BC_WP_DIR . 'core/shortcodes.php';
/* 
	Template Posttypes
*/
require BC_WP_DIR . 'core/post_types.php';
/* 
	Addons, custom plugins and so on.
*/
require BC_WP_DIR . 'core/addons.php'; 


/* ############################################################ */
/* ############################################################ */
/* 
	Bootstrap Things
*/
require BC_WP_DIR . 'core/bootstrap.php'; 
/* 
	ACF Things
*/
require BC_WP_DIR . 'core/acf.php'; 
/* 
	Woocommerce Things
*/
require BC_WP_DIR . 'core/woocommerce.php'; 

/* 
	WP Pusher Things
*/
require BC_WP_DIR . 'core/wppusher.php'; 

/* ############################################################ */
/* ############################################################ */

// see https://github.com/understrap/understrap/blob/master/functions.php