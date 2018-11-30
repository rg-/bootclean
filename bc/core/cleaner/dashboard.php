<?php

/**
 * Removing dashboard widgets.
 * @link https://codex.wordpress.org/Function_Reference/remove_meta_box
 */
 
if( apply_filters('BC_cleaner__dashboard__remove_panels', '__return_true') ){ 

	add_action( 'admin_init', function () {
	  // Remove the 'Welcome' panel
	  remove_action('welcome_panel', 'wp_welcome_panel');
	  // Remove the 'At a Glance' metabox
	  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	  // Remove the 'Activity' metabox
	  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
	  // Remove the 'WordPress News' metabox
	  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	  // Remove the 'Quick Draft' metabox
	  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	});
	
}

if( true === apply_filters('BC_cleaner__dashboard__remove_menu', '__return_false') ){ 

	/**
	 * Remove access to the dashboard
	*/
	add_action( 'admin_init', function () {
	  global $pagenow; // Get current page
	  $redirect = get_admin_url( null, 'edit.php' ); // Where to redirect
	  if ( $pagenow == 'index.php' ) {
		wp_redirect( $redirect, 301 );
		exit;
	  }
	});
	add_action( 'admin_menu', function () {
		// Remove Dashboard
		remove_menu_page( 'index.php' );
	});

}


/*

--  _ _ _ ___      ___  ____ ____ _  _ ___  ____ ____ ____ ___      ____ ____ ___ _  _ ___  
--  | | | |__]     |  \ |__| [__  |__| |__] |  | |__| |__/ |  \     [__  |___  |  |  | |__] 
--  |_|_| |    ___ |__/ |  | ___] |  | |__] |__| |  | |  \ |__/ ___ ___] |___  |  |__| |    
--                                                                                          

*/

add_action('wp_dashboard_setup', 'WPBC_wp_dashboard_setup');

function WPBC_wp_dashboard_setup(){

	wp_add_dashboard_widget('wpbc_dashboard_welcome_widget', __('Welcome','bootclean'), 'wpbc_dashboard_welcome');


	global $wp_meta_boxes; 
	// Get the regular dashboard widgets array (which has our new widget already but at the end) 
 	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core']; 
 	// Backup and delete our new dashboard widget from the end of the array 
 	$temp_widget_backup = array(
		'wpbc_dashboard_welcome_widget' => $normal_dashboard['wpbc_dashboard_welcome_widget'],
	); 
	
	unset( $normal_dashboard['wpbc_dashboard_welcome_widget'] ); 
 
 	// Merge the two arrays together so our widget is at the beginning 
 	$sorted_dashboard = array_merge( $temp_widget_backup, $normal_dashboard );
 
 	// Save the sorted array back into the original metaboxes  
 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;

}

function wpbc_dashboard_welcome(){
	$current_theme = wp_get_theme();  
	?>
	<div class="main">
	
		<p><?php printf( 
			__('Hi, site is using <b>%1$s</b> theme.', 'bootclean'),
			$current_theme->get( 'Name' )
			); ?></p>
		<ul>
			<li><b>Version</b>: <?php echo esc_html( $current_theme->get( 'Version' ) ); ?></li>
			<li><b>Parent Theme</b>: <?php echo $current_theme->get( 'Template' ) ? esc_html( $current_theme->get( 'Template' ) ) : 'None, using parent directly (not recomended).'; ?></li>
		</ul>
		
		<div class="dashboar-status">
		
			<h3><b>Server Status</b></h3> 
			
			<?php

			$icon_yes = '<span class="dashicons dashicons-yes text-success"></span>';
			$icon_no = '<span class="dashicons dashicons-no-alt text-danger"></span>'; 

			if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '>=' ) ) { 
				echo '<p>'.$icon_yes.' WP version '.$GLOBALS['wp_version'].'</p>';
			}

			if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) { 
				echo '<p>'.$icon_yes.' PHP_VERSION '.PHP_VERSION.'</p>';
			}

			if(is_ssl()){
				echo '<p>'.$icon_yes.' SSL is used</p>';
			}else{
				echo '<p>'.$icon_no.' SSL not used</p>';
			} 

			// Check cURL.
				$curl_message = in_array( 'curl', get_loaded_extensions() ) ?
					$icon_yes . ' ' .
					__( 'cURL is installed.', 'bootclean' ) :
					$icon_no . ' ' .
					__( 'cURL is not installed.', 'bootclean' );
					echo '<p>'.$curl_message.'</p>';
			?>
			
			<?php
			// Check allow_url_fopen.
				$allow_url_fopen_message = ini_get('allow_url_fopen') ?
					$icon_yes . ' ' .
					__( 'allow_url_fopen is installed.', 'bootclean' ) :
					$icon_no . ' ' .
					__( 'allow_url_fopen is not installed.', 'bootclean' );
					echo '<p>'.$allow_url_fopen_message.'</p>';
			?>
			
			<h3><b>Actived Plugins</b></h3>
			<?php
			
			$plugins = apply_filters('active_plugins', get_option('active_plugins')); 
			if ( is_multisite() ) {
				// get active plugins for the network
				$network_plugins = get_site_option('active_sitewide_plugins');
				if ( $network_plugins ) {
					$network_plugins = array_keys($network_plugins);
					$plugins = array_merge($plugins, $network_plugins);
				}
			}
			if(!empty($plugins)){
				echo '<ul>';
				foreach($plugins as $plugin){ 
					$plugin_data = get_plugin_data( WP_PLUGIN_DIR.'/'.$plugin );
					$plugin_name = $plugin_data['Name'];
					echo '<li>'. $icon_yes .' '.$plugin_name.'</li>';
				}
				echo '</ul>';
			}else{
				
			}
			
			?>
		
		</div>
	
	</div>
	<?php	
}