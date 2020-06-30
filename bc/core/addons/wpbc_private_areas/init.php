<?php
/*
	WPBC Private Areas

	Make entire site, just pages, just template parts... to be accesed only if
	user is logged and some particular role.  

*/  

function WPBC_private_areas__template_redirect() {

	// Exceptions for AJAX, Cron, or WP-CLI requests
	if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
		return;
	}

	// Redirect unauthorized visitors
	if ( WPBC_private_areas_if() ) {
		// Get visited URL
		$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
		$url .= '://' . $_SERVER['HTTP_HOST'];
		// port is prepopulated here sometimes
		if ( strpos( $_SERVER['HTTP_HOST'], ':' ) === FALSE ) {
			$url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
		}
		$url .= $_SERVER['REQUEST_URI'];

		/**
		 * Bypass filters.
		 *
		 * @since 3.0.0 The `$whitelist` filter was added.
		 * @since 4.0.0 The `$bypass` filter was added.
		 * @since 5.2.0 The `$url` parameter was added.
		 */
		$bypass = apply_filters( 'WPBC/filter/private_areas/bypass', false, $url );
		$whitelist = apply_filters( 'WPBC/filter/private_areas/whitelist', array() );

		if ( preg_replace( '/\?.*/', '', $url ) !== preg_replace( '/\?.*/', '', wp_login_url() ) && ! $bypass && ! in_array( $url, $whitelist ) ) {
			// Determine redirect URL
			$redirect_url = apply_filters( 'WPBC/filter/private_areas/redirect/url/pre', $url );
			// Set the headers to prevent caching
			nocache_headers();
			// Redirect
			$url = wp_login_url( $redirect_url );
			$redirect_url = apply_filters( 'WPBC/filter/private_areas/redirect/url', $url );
 			if(	1 === apply_filters( 'WPBC/filter/private_areas/redirect/apply', 1 ) ){
				wp_safe_redirect( $redirect_url, 302 ); exit;
			}
		}
	}
	elseif ( function_exists('is_multisite') && is_multisite() ) {
		// Only allow Multisite users access to their assigned sites
		if ( ! is_user_member_of_blog() && ! current_user_can('setup_network') ) {
			wp_die( __( "You're not authorized to access this site.", 'bootclean' ), get_option('blogname') . ' &rsaquo; ' . __( "Error", 'bootclean' ) );
		}
	}
}
add_action( 'template_redirect', 'WPBC_private_areas__template_redirect' );

/**
 * Restrict REST API for authorized users only
 *
 * @since 5.1.0
 * @param WP_Error|null|bool $result WP_Error if authentication error, null if authentication
 *                              method wasn't used, true if authentication succeeded.
 */
function WPBC_private_areas__rest_authentication_errors( $result ) {
	if ( null === $result && ! is_user_logged_in() ) {
		return new WP_Error( 'rest_unauthorized', __( "Only authenticated users can access the REST API.", 'bootclean' ), array( 'status' => rest_authorization_required_code() ) );
	}
	return $result;
}
// add_filter( 'rest_authentication_errors', 'WPBC_private_areas__rest_authentication_errors', 99 );



function WPBC_private_areas_allowed_roles(){
	$allowed_roles = array(
		'administrator',
		'subscriber'
	);
	$allowed_roles = apply_filters( 'WPBC/filter/private_areas/allowed_roles', $allowed_roles );
	return $allowed_roles;
}
function WPBC_private_areas_if(){ 
	$if = false; 
	$if = apply_filters( 'WPBC/filter/private_areas/if', $if ); 
	if ( ! WPBC_private_areas_if_allowed_user() && $if ) {
		return true;
	} else {
		return false;
	} 
} 

function WPBC_private_areas_if_allowed_user(){ 
	$allowed_roles = WPBC_private_areas_allowed_roles(); 
	$user = get_userdata( get_current_user_id() );
	if( ! $allowed_roles || ! $user->roles ){
	    return false;
	} 
	if( is_array( $allowed_roles ) ){
	    return array_intersect( $allowed_roles, (array) $user->roles ) ? true : false;
	} 
	return in_array( $allowed_roles, (array) $user->roles );
} 

/* Shortcodes */

/*

	Shortcodes for private zones/templates/parts

	[WPBC_if_allowed_user]
	Este contenido esta habilitado para el usuario.
	[/WPBC_if_allowed_user]
	
	[WPBC_if_not_allowed_user]
	En este lugar aparecerá contenido una vez te hayas subscripto.
	[/WPBC_if_not_allowed_user]

*/

function WPBC_if_allowed_user_FX( $atts, $content = null ) { 
	$out = '';
	if ( WPBC_private_areas_if_allowed_user() ) { 
		$out .= do_shortcode($content);
	} 
	return $out;
}
add_shortcode( 'WPBC_if_allowed_user', 'WPBC_if_allowed_user_FX' );

function WPBC_if_not_allowed_user_FX( $atts, $content = null ) { 
	$out = '';
	if ( !WPBC_private_areas_if_allowed_user() ) { 
		$out .= do_shortcode($content);
	} 
	return $out;
}
add_shortcode( 'WPBC_if_not_allowed_user', 'WPBC_if_not_allowed_user_FX' );




/*
	
	TODOING....

	- meta on pages, cats, so on to make some private or not depending on... 

*/