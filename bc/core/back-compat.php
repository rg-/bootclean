<?php
/**
 * Bootclean back compat functionality
 *
 * Prevents Bootclean from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage Bootclean
 * @since Bootclean 9.0
 */

/**
 * Prevent switching to Bootclean on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Bootclean 9.0
 */
function WPBC_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'WPBC_upgrade_notice' );
}
add_action( 'after_switch_theme', 'WPBC_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Bootclean on WordPress versions prior to 4.4.
 *
 * @since Bootclean 9.0
 *
 * @global string $wp_version WordPress version.
 */
function WPBC_upgrade_notice() {
	$message = sprintf( __( 'Bootclean requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'bootclean' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Bootclean 9.0
 *
 * @global string $wp_version WordPress version.
 */
function WPBC_customize() {
	wp_die( sprintf( __( 'Bootclean requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'bootclean' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'WPBC_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Bootclean 9.0
 *
 * @global string $wp_version WordPress version.
 */
function WPBC_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Bootclean requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'bootclean' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'WPBC_preview' );