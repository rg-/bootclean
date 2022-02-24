<?php
/**
 * Add a blured image size add_image_size
 *
 * @package Bootclean
 * @subpackage wpbc_blured_image
 * @since 13.0.00
 * 
 */ 

/*

	Enable by filter

*/
$add_image_size_blured = apply_filters('wpbc/filter/wpbc_blured_image/installed', 0); 


if( !empty($add_image_size_blured) ){

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'wpbc_blured_image',
			'title' => __('WPBC Blured Image size','bootclean'), 
		);

		return $addon;
	},10,1);

	/* Init the new size */
	add_action('after_setup_theme','WPBC_add_wpbc_blured_image');
	
	function WPBC_add_wpbc_blured_image() { 
	  add_image_size('wpbc_blured_image', 101, false, false);
	} 

	/* Generate a blured version "wpbc_blured_image" */

	add_filter('wp_generate_attachment_metadata','WPBC_add_wpbc_blured_image_metadata');
	function WPBC_add_wpbc_blured_image_metadata($meta) {
	  $file = wp_upload_dir();
	  $file = trailingslashit($file['path']).$meta['sizes']['wpbc_blured_image']['file'];
	  list($orig_w, $orig_h, $orig_type) = @getimagesize($file);
	  $image = wp_load_image($file);
	  imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR, 999);
	  imagefilter($image, IMG_FILTER_SMOOTH,99);
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