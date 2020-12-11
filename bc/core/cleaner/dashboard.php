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


$use_wpbc_dashboard = apply_filters('wpbc/admin/dashboard', '__return_true');
if($use_wpbc_dashboard){
	add_action('wp_dashboard_setup', 'WPBC_wp_dashboard_setup');
}
function WPBC_wp_dashboard_setup(){

	$icon = WPBC_get_admin_icon();

	wp_add_dashboard_widget('wpbc_dashboard_welcome_widget', $icon.' Bootclean > '.__('Welcome','bootclean'), 'wpbc_dashboard_welcome'); 


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


	$icon_yes = '<span class="dashicons dashicons-yes text-success"></span>';
	$icon_no = '<span class="dashicons dashicons-no-alt text-danger"></span>'; 
	$icon_warning = '<span class="dashicons dashicons-warning text-danger"></span>'; 


	?>
	<div class="main">

		<p><?php printf( 
			__('Hi, site is using <b>%1$s</b> theme.', 'bootclean'),
			$current_theme->get( 'Name' )
			); ?></p>
		<ul class="wpbc-dashboard-list">
			<li><b>Version</b>: <?php echo esc_html( $current_theme->get( 'Version' ) ); ?> | <b>Parent Theme</b>: <?php echo $current_theme->get( 'Template' ) ? esc_html( $current_theme->get( 'Template' ) ) : 'None, using parent directly (not recomended).'; ?></li>
		</ul>

		<div class="wpbc-dashboard-addons">
			<br>
			<h3 class="wpbc-dashboard-title"><?php echo WPBC_get_svg_icon('touch_app'); ?> <b>Actived Bootclean Addons</b></h3>
			<ul class="wpbc-dashboard-list">
				<?php 
				$actived_addons = apply_filters('wpbc/filter/dashboard/actived_addons',array());
				if( !empty($actived_addons) ){
					foreach ($actived_addons as $key => $value) { 
						$addon_name = $value['title']; 
						if(!empty($value['url'])){
							$manage = ' &nbsp;&nbsp;<a class="wpbc-btn-small button" href="'.$value['url'].'"><small>MANAGE</small></a>';
						}else{
							if( !empty($value['has_option_page']) ){
								$manage = '&nbsp;&nbsp;<small class="wpbc-badge">MANAGED FROM THEME FUNCTIONS</small>';
							}else{ 
							$manage = '';
							}
						}
						echo '<li>'. $icon_yes .' <b>'.$addon_name.'</b>'.$manage.'</li>';
					}
				}else{
					echo '<li>'.__( 'No actived adddons used.', 'bootclean' ).'</li>';
				} 
				?>
			</ul>
		
		</div>
		
		<div class="wpbc-dashboard-status">
			
			<br>
			<h3 class="wpbc-dashboard-title"><?php echo WPBC_get_svg_icon('perm_data_setting'); ?> <b>Server Status</b></h3> 
			
			<ul class="wpbc-dashboard-list">
			<?php

			

			if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '>=' ) ) { 
				echo '<li>'.$icon_yes.' Wordpress version '.$GLOBALS['wp_version'].'</li>';
			}

			if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) { 
				
			}

			$response = wp_check_php_version(); 
			echo '<li>';
	    if ( ! $response ) {
	      echo $icon_yes.' PHP_VERSION '.PHP_VERSION;
	    }else{ 
	    	echo $icon_warning.' PHP_VERSION '.PHP_VERSION.'<br>';
	    	if ( isset( $response['is_secure'] ) && ! $response['is_secure'] ) {
		    	echo '<br>Your site is running on an insecure version of PHP.'; 
		    } else {
		    	echo '<br>Your site is running on an outdated version of PHP.'; 
		    }
		    echo "<br>Recomended version: ".$response['recommended_version']." | Minimum version: ".$response['minimum_version']."";
	    } 
	    echo '</li>';
	    
 
			echo '<li>'.$icon_yes.' db_version '.get_option('db_version').'</li>';

			if(is_ssl()){
				echo '<li>'.$icon_yes.' SSL is used</li>';
			}else{
				echo '<li>'.$icon_no.' SSL not used</li>';
			} 

			// Check cURL.
				$curl_message = in_array( 'curl', get_loaded_extensions() ) ?
					$icon_yes . ' ' .
					__( 'cURL is installed.', 'bootclean' ) :
					$icon_no . ' ' .
					__( 'cURL is not installed.', 'bootclean' );
					echo '<li>'.$curl_message.'</li>';
			?>
			
			<?php
			// Check allow_url_fopen.
				$allow_url_fopen_message = ini_get('allow_url_fopen') ?
					$icon_yes . ' ' .
					__( 'allow_url_fopen is installed.', 'bootclean' ) :
					$icon_no . ' ' .
					__( 'allow_url_fopen is not installed.', 'bootclean' );
					echo '<li>'.$allow_url_fopen_message.'</li>';
			?>

			</ul>
		</div> 
		
		<div class="wpbc-dashboard-plugins">

			<br>
			<h3 class="wpbc-dashboard-title"><span class="dashicons dashicons-admin-plugins"></span> <b>Actived Plugins</b></h3>
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
				echo '<ul class="wpbc-dashboard-list">';
				foreach($plugins as $plugin){ 
					$plugin_data = get_plugin_data( WP_PLUGIN_DIR.'/'.$plugin );
					if(!empty($plugin_data)){ 
						$plugin_name = $plugin_data['Name'];
						$plugin_version = $plugin_data['Version'];  
						echo '<li>'. $icon_yes .' '.$plugin_name.' | '.$plugin_version.'</li>';
					}
				}
				echo '</ul>';
			}else{
				
			}
			
			?>
		
		</div>
	
	</div>
	<?php	
}