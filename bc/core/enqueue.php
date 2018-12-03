<?php


/*

	TODO, make same thig with other functions/filters/actions here

*/
include('enqueue/WPBC_add_inline_style.php');  

/**
 * Bootclean enqueue styles/scripts
 *
 * @package bootclean
 * @subpackage enqueue
 */
 


 /*

	Styles/Scripts for back and front end, mostly for options and customizer

 */

	function WPBC_wp_enqueue_scripts_options(){

		$uri = get_template_directory_uri().'/bc/core/assets/css/wpbc-options.css';
		$uri = apply_filters('wpbc/filter/enqueue/options/uri',$uri);
		wp_register_style( 'wpbc-options', $uri, array(), '1');
		wp_enqueue_style( 'wpbc-options' );  

	}

	add_action( 'wp_enqueue_scripts', 'WPBC_wp_enqueue_scripts_options' );
 	add_action( 'admin_enqueue_scripts', 'WPBC_wp_enqueue_scripts_options' );
 /*
 
	Filters used:
	 
		BC_enqueue_scripts__version
 
 */
 
function BC_enqueue_scripts__version(){
	$the_theme = wp_get_theme('bootclean');
	$theme_version = $the_theme->get( 'Version' );
	$scripts_version = $theme_version;
	return apply_filters('BC_enqueue_scripts__version', $scripts_version);
}
function __scripts_version(){
	return BC_enqueue_scripts__version();
}
 
 
 if ( ! function_exists( 'WPBC_wp_enqueue_scripts' ) ) {
	 
	 function WPBC_wp_enqueue_scripts(){ 
		
		// Get theme_root, basicly i take the arguments on theme_root and use them to loop and enqueue styles and scripts in that order.
		// TODO, more filters....
		
		$theme_root = BC_theme_root();  
		
		// WPBC_enqueue_scripts__fonts
		include('enqueue/WPBC_enqueue_scripts__fonts.php');

		// WPBC_enqueue_scripts__head_styles
		include('enqueue/WPBC_enqueue_scripts__head_styles.php'); 
		
		// WPBC_enqueue_scripts__head_scripts
		include('enqueue/WPBC_enqueue_scripts__head_scripts.php'); 
		
		// WPBC_enqueue_scripts__footer_scripts
		include('enqueue/WPBC_enqueue_scripts__footer_scripts.php'); 
		
		/**
		 * Add iconmoon for common icons, child overides
		 */ 
		$iconmoon_uri = get_template_directory_uri().'/css/iconmoon.css';
		$iconmoon_uri = apply_filters('wpbc/filter/enqueue/iconmoon/uri',$iconmoon_uri);
		wp_register_style( 'iconmoon', $iconmoon_uri, array(), '1');
		wp_enqueue_style( 'iconmoon' );  
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		 
	 }
	 
 }
 
 add_action( 'wp_enqueue_scripts', 'WPBC_wp_enqueue_scripts' );
 
 
 
/* 
 * Google fonts
 *
 * 	@WPBC_enqueue_google_fonts
 *
 * TODO, make it options configurable
 *
*/
 
function WPBC_enqueue_google_fonts(){ 
	$fonts = array();
	return apply_filters('WPBC_enqueue_google_fonts', $fonts);
}

function WPBC_bootstrap_google_font_enqueue(){ 
	$fonts = WPBC_enqueue_google_fonts(); 
	if(isset($fonts)){ 
		foreach($fonts as $k=>$v){
			wp_register_style( 'google-font-'.$k.'', $v['href'], array(), __scripts_version() ); 
			wp_enqueue_style( 'google-font-'.$k.'' ); 
		} 
	}   
}
add_action( 'wp_enqueue_scripts', 'WPBC_bootstrap_google_font_enqueue', 0 );
 
function WPBC_wp_head_google_fonts() {
	$fonts = WPBC_enqueue_google_fonts(); 
	if(!empty($fonts)){  
	?>
<style><?php
	foreach($fonts as $k=>$v){
		if(isset($v['primary'])){
			$family = $v['font-family'];
		}else{
			$family = $fonts[0]['font-family'];
		}
		?>.font-<?php echo $v['base']; ?>{ font-family: <?php echo $v['font-family'];?> } <?php
	}
	?> body { font-family: <?php echo $family;?> } 
</style><?php
	}
}
add_action('wp_head', 'WPBC_wp_head_google_fonts', 10);
  

/* 
 * Dynamic Css 
 *
 * 	WPBC_dynamic_css
 * 
 *  notice priority 999
 *
 * TODO, make it options configurable
 *
*/ 


function WPBC_enqueue_dynamic_css() {
	wp_enqueue_style( 'dynamic-css', admin_url('admin-ajax.php').'?action=dynamic_css', '', __scripts_version());
}
add_action( 'wp_enqueue_scripts', 'WPBC_enqueue_dynamic_css', 999 );


function WPBC_dynamic_css() {
	require( get_template_directory().'/bc/core/enqueue/custom.css.php' );
	exit;
}
add_action('wp_ajax_dynamic_css', 'WPBC_dynamic_css');
add_action('wp_ajax_nopriv_dynamic_css', 'WPBC_dynamic_css');






/*

	Other functions

*/




function WPBC_get_custom_bootstrap_variables_colors(){
	
	$bootstrap_variables_colors = array(
		/* Example */
		/*
		'navbar-light-color' => array(
			'apply' => '.navbar-light .navbar-nav .nav-link',
			'value' => 'red!important',
			'std' => 'color:WPBC_VALUE;'
		),
		'navbar-light-hover-color' => array(
			'apply' => '.navbar-light .navbar-nav .nav-link:hover',
			'value' => 'orange!important',
			'std' => 'color:WPBC_VALUE;'
		),
		*/
	);
	
	return apply_filters('WPBC_get_custom_bootstrap_variables_colors', $bootstrap_variables_colors, 10, 1);
	
}