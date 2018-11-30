<?php

/**
 * Bootclean Template tags/parts/functions
 *
 * @package bootclean
 * @subpackage template-tags
 * @since Bootclean 9.0
 *
 */

 /**
 * Template functions
 */
include('template-tags/WPBC_get_template_part.php');
include('template-tags/WPBC_template_builder.php');
include('template-tags/WPBC_layout.php'); 
include('template-tags/WPBC_class.php');
include('template-tags/WPBC_ajax_posts_pagination.php');  
/* 
	WPBC_parts 
*/

include('template-tags/parts/WPBC_excerpt.php');
include('template-tags/parts/WPBC_advanced_posts_pagination.php');
include('template-tags/parts/WPBC_post_thumbnail.php');
include('template-tags/parts/WPBC_posts_pagination.php');
include('template-tags/parts/WPBC_post_taxonomies.php'); 
include('template-tags/parts/WPBC_post_date.php'); 
include('template-tags/parts/WPBC_post_share.php');
include('template-tags/parts/WPBC_post_breadcrumb.php'); 
/*

	TODO, see how i´m working on WPBC_get_template(), this is crucial to keep theme with just one "index" theme root template for all.
		
		Also, WPBC_get_template should be named: WPBC_detect_template(), since the get_ is already used to "get" template files.
		Later i can use detection to determine the template part to use, but this is also something that WP do by itself, see the best if there is no chance to create a "search.php" or "archive.php", leave that for child themes only.
		
		Also, find the function that output the custom/puncual page/post custom settings used... i gues that is in WPBC_class

	TODO, review this WPBC_component_defaults ???
		
	TODO, this section should be named: WPBC_templates not "template-tags"
	
	# WPBC_templates has also subpackages like:
	
		WPBC_layout
		WPBC_class
		WPBC_template_part
		
		IMPORTANT
		
		I need to resolve how to deal the best way with bc/components and bc/templates, vs also /template-parts on theme root :) !!!
	
	# Needs to be better ordered and cleanner. In that way...
	
	# Some other "outside" things should belong to WPBC_layout, the main idea here is make a class with sub classes on next future Alpha version.
	
		Things like:
		
		- bc/core/bootstrap
		- bc/core/shortcodes ( front-end ones )
		- bc/core/post_types ( front-end ones )
		
		The idea here is not to have many all in one post_types/shortcodes, like "team", "projects" and so on, leave that part as "addons" in plugin format.
		
		- bc/core/enqueue 

		- bc/core/customize
		
		- bc/core/cleaner Here see what things should belong to this or not, mostly are general things but take a look.
		
		
		
*/   