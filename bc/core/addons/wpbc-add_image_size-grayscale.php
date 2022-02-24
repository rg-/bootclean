<?php
/**
 * Add a grayscale image size add_image_size
 *
 * @package Bootclean
 * @subpackage wpbc_grayscale_image
 * @since 13.0.00
 * 
 */ 

/*

	Enable by filter

*/
$add_image_size_grayscale = apply_filters('wpbc/filter/wpbc_grayscale_image/installed', 0); 


if( !empty($add_image_size_grayscale) ){

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_grayscale_image',
			'title' => __('WPBC Grayscale Image size','bootclean'), 
		);

		return $addon;
	},10,1);

	/* Init the new size */
	add_action('after_setup_theme','WPBC_add_wpbc_grayscale_image');
	
	function WPBC_add_wpbc_grayscale_image() { 
	  add_image_size('wpbc_grayscale_image', 101, false, false);
	  add_image_size('wpbc_grayscale_image_medium', 301, false, false);
	} 

	/* Generate a blured version "wpbc_blured_image" */

	add_filter('wp_generate_attachment_metadata','WPBC_add_wpbc_grayscale_image_metadata');
	function WPBC_add_wpbc_grayscale_image_metadata($meta) {
	   $file = wp_upload_dir();
  $file = trailingslashit($file['path']).$meta['sizes']['wpbc_grayscale_image']['file'];
  list($orig_w, $orig_h, $orig_type) = @getimagesize($file);
  $image = wp_load_image($file);
  imagefilter($image, IMG_FILTER_GRAYSCALE);
  switch ($orig_type) {
    case IMAGETYPE_GIF:
        imagegif( $image, $file );
        break;
    case IMAGETYPE_PNG:
        imagepng( $image, $file );
        break;
    case IMAGETYPE_JPEG:
        imagejpeg( $image, $file );
        break;
  }
  return $meta;
	}

	add_filter('wp_generate_attachment_metadata','WPBC_add_wpbc_grayscale_image_medium_metadata');
	function WPBC_add_wpbc_grayscale_image_medium_metadata($meta) {
	   $file = wp_upload_dir();
  $file = trailingslashit($file['path']).$meta['sizes']['wpbc_grayscale_image_medium']['file'];
  list($orig_w, $orig_h, $orig_type) = @getimagesize($file);
  $image = wp_load_image($file);
  imagefilter($image, IMG_FILTER_GRAYSCALE);
  switch ($orig_type) {
    case IMAGETYPE_GIF:
        imagegif( $image, $file );
        break;
    case IMAGETYPE_PNG:
        imagepng( $image, $file );
        break;
    case IMAGETYPE_JPEG:
        imagejpeg( $image, $file );
        break;
  }
  return $meta;
	}

}