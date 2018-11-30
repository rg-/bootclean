<?php
/*

	Filters used:
	
		BC_cleaner__updates__disable

*/

/**
 * Disable update notifcations.
 */
 
if( apply_filters('BC_cleaner__updates__disable', '__return_true') ){ 
	// Core update notifications
	add_filter('pre_site_transient_update_core', 'last_checked_now');
	// Plugin update notifications
	add_filter('pre_site_transient_update_plugins', 'last_checked_now');
	// Theme update notifications
	add_filter('pre_site_transient_update_themes', 'last_checked_now');
	// Core translation notifications
	add_filter( 'site_transient_update_core', 'remove_translations' );
	// Plugin translation notifications
	add_filter( 'site_transient_update_plugins', 'remove_translations' );
	// Theme translation notifications
	add_filter( 'site_transient_update_themes', 'remove_translations' );
	function last_checked_now( $transient ) {
	  include ABSPATH . WPINC . '/version.php';
	  $current = new stdClass;
	  $current->updates = array();
	  $current->version_checked = $wp_version;
	  $current->last_checked = time();
	  return $current;
	}
	function remove_translations( $transient ) {
	  if ( is_object( $transient ) && isset( $transient->translations ) ) {
		$transient->translations = array(); 
	  }
	  return $transient;
	}
}
/**
 * Remove actions that checks for updates
 */
add_action( 'admin_init', function () {
  if( apply_filters('BC_cleaner__updates__disable', '__return_true') ){ 
	  remove_action( 'wp_maybe_auto_update', 'wp_maybe_auto_update' );
	  remove_action( 'admin_init', 'wp_maybe_auto_update' );
	  remove_action( 'admin_init', 'wp_auto_update_core' );
	  wp_clear_scheduled_hook( 'wp_maybe_auto_update' );
  }
});