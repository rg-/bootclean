<?php

/**
 * For theme
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/
 */

add_action( 'after_setup_theme', 'WPBC_after_setup_theme__customs');
function WPBC_after_setup_theme__customs(){
	/*
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	*/
	$defaults = array(
		'default-color'          => 'red',
		'default-image'          => '',
		'default-repeat'         => 'no-repeat',
		'default-position-x'     => 'center',
		'default-position-y'     => 'center',
		'default-size'           => 'cover',
		'default-attachment'     => 'fixed',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	// add_theme_support( 'custom-background', $defaults );
	
}

/**
 * For posts
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/
 */

add_action( 'after_setup_theme', 'WPBC_after_setup_theme__posts'); 
function WPBC_after_setup_theme__posts(){
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );
	
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}


/**
 * Remove theme features
 * @link https://codex.wordpress.org/Function_Reference/remove_theme_support
 */
 

add_action( 'after_setup_theme', function () { 

	if( apply_filters('BC_cleaner__theme__remove_support', '__return_true') ){ 
	
		//remove_theme_support( 'post-formats' );
		//remove_theme_support( 'post-thumbnails' );
		//remove_theme_support( 'custom-background' );
		//remove_theme_support( 'custom-header' );
		//remove_theme_support( 'automatic-feed-links' );
		//remove_theme_support( 'html5' );
		//remove_theme_support( 'title-tag' );
		//remove_theme_support( 'menus' );
	
	}
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	 // See this to customize the output: https://wordpress.stackexchange.com/questions/228183/custom-attribute-for-the-title-tag-with-wp-title
	
  
}, 11 );