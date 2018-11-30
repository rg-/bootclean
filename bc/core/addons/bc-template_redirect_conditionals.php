<?php

// bc-coming_soon_redirect

/*
	
	TODO, filters for child manipulation, also using Options Theme Page, under.... mmm, under self alone tab "Template Redirect"
	
	The idea under that is not only be able to switch template for no-logged users, but also create many other conditionals, for example:
	
	- condition for some user roles
	- condition by ip
	- condition by.... must be repeteables options
	
	This addon also has this add into theme settings:
	
	C:\xampp\htdocs\_www\bootclean-v8\_html\wp-content\themes\bootclean\bc\core\all-defaults-globals\options__default_admin_mainteneance.php

*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

add_shortcode('get__bc_admin_mainteneance_html','get__bc_admin_mainteneance_html_fx');
function get__bc_admin_mainteneance_html_fx($atts, $content=null){ 
	extract(shortcode_atts(array(
		"id" => '',
		"class" => '',
	), $atts)); 
	$out = ''; 
	$bc_admin_mainteneance_html = WPBC_get_field('bc_admin_mainteneance_html','options');
	$out .= apply_filters('the_content', $bc_admin_mainteneance_html); 
	return $out; 
}

add_action('bc_admin_mainteneance_style','bc_admin_mainteneance_style_fx');
function bc_admin_mainteneance_style_fx(){
	$bc_admin_mainteneance_style = WPBC_get_field('bc_admin_mainteneance_style','options');
	?>
	<style>
		<?php echo $bc_admin_mainteneance_style; ?>
	</style>
	<?php
	
}

if( ! class_exists('bc_template_redirect_conditionals') ) :
	class bc_template_redirect_conditionals {  
		public function __construct() { 
			
			add_filter( 'template_include', array($this, 'bc_template_include') ); 
			add_action( 'admin_init', array($this, 'bc_template_settings_init')); 
			
		} 
		
		public function bc_template_include($original_template){
			
			$bc_coming_soon = get_option( 'options_bc_coming_soon' );
			if ( !is_user_logged_in() && $bc_coming_soon == 1 ) { 
				$templaate_file = STYLESHEETPATH .'/_template_redirect_conditionals.php';
				if(is_file($templaate_file)){
				   return  STYLESHEETPATH .'/_template_redirect_conditionals.php';
				} else {
				   return  TEMPLATEPATH .'/_template_redirect_conditionals.php';
				}
			} else {
				return $original_template;
			}
			
		}
		
		public function bc_template_settings_init() {  
			 
				/* Register Settings */
				register_setting(
					'reading',             // Options group
					'options_bc_coming_soon',      // Option name/database
					array($this, 'bc_template_settings_sanitize') // sanitize callback function
				);
			 
				/* Create settings section */
				add_settings_section(
					'bc-coming-soon',                   // Section ID
					__('Custom Bootclean settings','bootclean'),  // Section title
					array($this, 'bc_template_settings_section_description'), // Section callback function
					'reading'                          // Settings page slug
				);
			 
				/* Create settings field */
				add_settings_field(
					'bc-coming-soon-field',       // Field ID
					__('Website Visibility','bootclean'),       // Field title 
					array($this, 'bc_template_settings_field_callback'), // Field callback function
					'reading',                    // Settings page slug
					'bc-coming-soon'               // Section ID
				);
			}
			
			
		/* Sanitize Callback Function */
		function bc_template_settings_sanitize( $input ){
			return isset( $input ) ? true : false;
		}
		 
		/* Setting Section Description */
		function bc_template_settings_section_description(){
			//echo wpautop(  );
			return false;
		}
		 
		/* Settings Field Callback */
		function bc_template_settings_field_callback(){ 
		
			$bc_admin_mainteneance__message_header = ''.__('Customize this feature under','bootclean').': ';
			$bc_admin_mainteneance__message_header .= '<b>' . __('Options','bootclean') . '> <a href="' . admin_url( 'options-general.php?page=bc_mainteneance_mode' ) . '">' .__('BC Mainteneance','bootclean');
			$bc_admin_mainteneance__message_header .= '</a></b>.'; 
			?>
			<label for="bc-coming-soon">
				<input id="bc-coming-soon" type="checkbox" value="1" name="options_bc_coming_soon" <?php checked( get_option( 'options_bc_coming_soon', false ) ); ?>> <?php _e('Only logged users can view this site.','bootclean'); ?>
			</label>
			<!--<p class="description"><?php echo $bc_admin_mainteneance__message_header; ?></p>-->
			<?php 
		}
			
		  
	}
	global $bc_plugin_init;
	$bc_plugin_init = new bc_template_redirect_conditionals(); 
endif;


?>