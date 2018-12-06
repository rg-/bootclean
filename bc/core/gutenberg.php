<?php
 
/**
 * Bootclean Gutenberg
 *
 * @package bootclean
 * @subpackage gutenberg
 */

 
// see: https://wisdomplugin.com/build-gutenberg-block-plugin/
// see https://github.com/WordPress/gutenberg-examples/

define('BC_GUTENBERG_URI', THEME_URI.'/bc/core/gutenberg');

require 'gutenberg/test/index.php'; 
//require 'gutenberg/simple-block/index.php'; 
//require 'gutenberg/edit-block/index.php'; 
//include 'gutenberg/01-basic/index.php'; 
//include 'gutenberg/02-stylesheets/index.php';
//include 'gutenberg/03-editable/index.php'; 
//include 'gutenberg/04-controls/index.php'; 
//include 'gutenberg/05-recipe-card/index.php'; 


/**
 * Disabling the Gutenberg editor all post types except post.
 *
 * @param bool   $can_edit  Whether to use the Gutenberg editor.
 * @param string $post_type Name of WordPress post type.
 * @return bool  $can_edit
 */
 
 
 
if( !function_exists( 'WPBC_gutenberg_init' ) ){
	
	function WPBC_gutenberg_init(){
		
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		} 
		
		class WPBC_gutenberg { 
			public function init() {
				add_action( 'gutenberg_can_edit_post_type', array( $this, 'can_edit_post_type' ), 10, 2 ); 
				add_action( 'after_setup_theme', array( $this, 'theme_support' ) );   
			}  
			
			/*
				Enable gutenberg only for these post types
			*/
			function can_edit_post_type( $can_edit, $post_type ) {
				$gutenberg_supported_types = apply_filters('WPBC_gutenberg__supported_types', array( 'post' ));
				if ( ! in_array( $post_type, $gutenberg_supported_types, true ) ) {
					$can_edit = false;
				} 
				return $can_edit;
			}
			
			function theme_support(){
				
				/**
				 * Add support for custom color palettes in Gutenberg.
				 */ 
				if( apply_filters('WPBC_gutenberg__color_palette', '__return_true') ){
					$color_palette = BC_get_root_colors();
					if(isset($color_palette)){
						$count = 0;
						$palette = array();
						foreach($color_palette  as $k=>$v){
							$name = str_replace('--','',$k); 
							if( $count <= apply_filters('WPBC_gutenberg__color_palette_max', 7) ){
								$palette[] = array(
									'name'  => $name,
									'slug' => $name,
									'color' => $v,
								); 
							}
							$count++;
						} 
						add_theme_support(
							'editor-color-palette', $palette
						); 
					}
				} // BC_gutenberg__color_palette <<<<
				
			}
			// <<<< 
			
		}
		
		// Instantiate the options page.
		$BC_gutenberg = new WPBC_gutenberg;
		$BC_gutenberg->init();
		
	}
	
} 

if( apply_filters('WPBC_gutenberg', '__return_true') ){ 
	WPBC_gutenberg_init(); 
}
//add_action( 'init', 'BC_gutenberg_init', 20 );