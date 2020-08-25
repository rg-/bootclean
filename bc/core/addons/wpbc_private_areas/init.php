<?php
/*
	WPBC Private Areas

	Make entire site, just pages, just template parts... to be accesed only if
	user is logged and some particular role.  

*/ 

function WPBC_private_areas_get_woo_conditions(){
	$woo_conditions = array(

		'is_account_page',
		'is_cart',
		'is_checkout',
		'is_product',
		'is_product_category',
		'is_product_tag',
		'is_shop', 

	);
	return apply_filters('wpbc/filter/private_areas/woo_conditions',$woo_conditions);
} 

function WPBC_private_areas__type(){
	$private_areas_type = 1;
	$private_areas_type = apply_filters('wpbc/filter/private_areas/type',$private_areas_type);
	return $private_areas_type;
}

function WPBC_private_areas__if_allowed_page($post_id=''){

	if(!$post_id){
		global $post;
		if(!empty($post)){
			$post_id = $post->ID;
		}
		
	}
	$allowed_page = WPBC_get_field('private_area__allow_page', $post_id);
	$private_type = WPBC_private_areas__type();

	$allowed_by_settings = WPBC_private_areas_is_visible_settings($post_id);

	if( ($allowed_by_settings || $allowed_page) && $private_type == 1){
		return $post_id;
	}else{
		return false;
	}

} 

function WPBC_private_areas_is_visible_settings($post_id=''){ 

	$temps_ids = array();

	$get_woo_conditions = WPBC_private_areas_get_woo_conditions(); 
	
	// check wpbc_private_areas__bypass_post_object pages too
	$wpbc_private_areas__bypass_post_object = get_field('wpbc_private_areas__bypass_post_object','options');
	if( !empty($wpbc_private_areas__bypass_post_object) ){
		foreach ($wpbc_private_areas__bypass_post_object as $key => $value) {
			$temps_ids[] = $value->ID; 
		}
	}

	// Check woo pages 
	if( !empty($get_woo_conditions) && WPBC_is_woocommerce_active() ){
		foreach ($get_woo_conditions as $key => $value) {
			
			$option = get_field('wpbc_private_areas__'.$value, 'options');

			if($value=='is_account_page' && $option){
				$temps_ids[] = wc_get_page_id( 'myaccount' );
			}
			if($value=='is_cart' && $option){
				$temps_ids[] = wc_get_page_id( 'cart' );
			}
			if($value=='is_checkout' && $option){
				$temps_ids[] = wc_get_page_id( 'checkout' );
			} 
			if($value=='is_shop' && $option){
				$temps_ids[] = wc_get_page_id( 'shop' );
			}

		}
	}

	if(!empty($post_id) && !empty($temps_ids)){
		if( in_array($post_id,$temps_ids) ){
			return true;
		}
	}
	

}
 
function WPBC_private_areas__get_url(){
	// Get visited URL
	$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
	$url .= '://' . $_SERVER['HTTP_HOST'];
	// port is prepopulated here sometimes
	if ( strpos( $_SERVER['HTTP_HOST'], ':' ) === FALSE ) {
		$url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
	}
	$url .= $_SERVER['REQUEST_URI'];
	return $url;
}

function WPBC_private_areas__template_redirect() { 

	// Exceptions for AJAX, Cron, or WP-CLI requests
	if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
		return;
	}

	$msg = 'template_redirect...';  

	/*
	
		1 - All Site private, you should filter which pages/urls to be not private


	*/
	$private_areas_type = WPBC_private_areas__type();

	$redirect_login_url = get_home_url();
	$redirect_url = wp_login_url( $redirect_login_url );

	$allowed_user = false;
	$redirect = false;
	if( is_user_logged_in() ){
		$msg = 'user_logged'; 
		if( WPBC_private_areas_if_allowed_user() ){
			$msg .= '-allowed_user';
			$allowed_user = true;
		}else{
			$msg .= '-not_allowed_user';
		}
	}else{
		$msg = 'not_user_logged'; 
	}

	$url = WPBC_private_areas__get_url(); 

	$bypass = apply_filters( 'WPBC/filter/private_areas/bypass', false, $url );


	if( !$bypass && preg_replace( '/\?.*/', '', $url ) !== preg_replace( '/\?.*/', '', wp_login_url() ) ){
		$msg .= '----no_wp_login_url';
		if(!$allowed_user){
			$msg .= 'REDIRECT';
			$redirect = true;
		}else{
			$msg .= 'NOTREDIRECT';
		}
	}else{
		$msg .= '----wp_login_url';
		$msg .= 'NOTREDIRECT';
	}

	if( $redirect && ! WPBC_private_areas__if_allowed_page() ){
		
		$redirect_login_url = apply_filters( 'WPBC/filter/private_areas/redirect_login_url', $url );
		$redirect_url = apply_filters( 'WPBC/filter/private_areas/redirect_url', $redirect_url, $url );
		$redirect_url = $redirect_url.'?private='.$redirect_login_url;
		nocache_headers();
		wp_safe_redirect( $redirect_url, 302 ); exit;
	
	} 

	// Redirect unauthorized visitors
	$xxxx = false;
	if ( $xxxx ) { 

		if ( function_exists('is_multisite') && is_multisite() ) {
			// Only allow Multisite users access to their assigned sites
			if ( ! is_user_member_of_blog() && ! current_user_can('setup_network') ) {
				wp_die( __( "You're not authorized to access this site.", 'bootclean' ), get_option('blogname') . ' &rsaquo; ' . __( "Error", 'bootclean' ) );
			}
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

function WPBC_private_areas_default_allowed_roles(){
	$default_allowed_roles = array(
		'administrator',
		'subscriber'
	);
	// If Woocommerce, add the shop manager role to defaults.
	if( WPBC_is_woocommerce_active() ){
		$default_allowed_roles[] = 'shop_manager';
	}
	$default_allowed_roles = apply_filters( 'WPBC/filter/private_areas/default_allowed_roles', $default_allowed_roles );
	return $default_allowed_roles;
}

function WPBC_private_areas_allowed_roles(){
	$allowed_roles = WPBC_private_areas_default_allowed_roles();
	$allowed_roles = apply_filters( 'WPBC/filter/private_areas/allowed_roles', $allowed_roles );
	return $allowed_roles;
} 

function WPBC_private_areas_if_allowed_user(){ 
	$allowed_roles = WPBC_private_areas_allowed_roles(); 
	$current_user_id = get_current_user_id();
	$return = false;
	$msg = 'nada';
	if($current_user_id){
		$user = get_userdata( $current_user_id );
		if($user){
			if( ! $allowed_roles || ! $user->roles ){
				$msg = 'nada 2';
	    	$return = false;
			} 
			if( is_array( $allowed_roles ) ){
				$msg = 'is_array';
			  $return = array_intersect( $allowed_roles, (array) $user->roles ) ? true : false;
			} 
			// $return = in_array( $allowed_roles, (array) $user->roles );
		} 
	}  
	return $return;
} 
 

/*
	
	Front End Alerts

*/  

add_action('wpbc/layout/body/start', 'WPBC_private_areas_show_alerts',30);
function WPBC_private_areas_show_alerts(){
  $show_alerts = apply_filters('WPBC/filter/private_areas/show_alerts', '__return_true'); 
	if($show_alerts) {
		WPBC_get_template_part('addons/wpbc_private_areas/alerts');
	} 
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