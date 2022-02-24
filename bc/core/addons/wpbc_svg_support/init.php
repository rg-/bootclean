<?php

/**
 * Add svg MIME type support
 *
 * @param $mimes
 *
 * @author wpbc
 * @return mixed
 */
function wpbc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'wpbc_mime_types' );

/**
 * Enqueue SVG javascript and stylesheet in admin
 * @author wpbc
 */

function wpbc_svg_enqueue_scripts( $hook ) {
	wp_enqueue_style( 'wpbc-svg-style', THEME_URI . '/bc/core/addons/wpbc_svg_support/assets/svg.css');
	wp_enqueue_script( 'wpbc-svg-script', THEME_URI . '/bc/core/addons/wpbc_svg_support/assets/svg.js', array('jquery') );
	wp_localize_script( 'wpbc-svg-script', 'script_vars',
		array( 'AJAXurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'admin_enqueue_scripts', 'wpbc_svg_enqueue_scripts' );


/**
 * Ajax get_attachment_url_media_library
 * @author wpbc
 */
function wpbc_get_attachment_url_media_library() {

	$url          = '';
	$attachmentID = isset( $_REQUEST['attachmentID'] ) ? $_REQUEST['attachmentID'] : '';
	if ( $attachmentID ) {
		$url = wp_get_attachment_url( $attachmentID );
	}

	echo $url;

	die();
}

add_action( 'wp_ajax_svg_get_attachment_url', 'wpbc_get_attachment_url_media_library' );