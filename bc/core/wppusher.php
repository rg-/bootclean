<?php

function wpbc_dashboard_get_github_theme_info($repro){
	/* */
	if(in_array( 'curl', get_loaded_extensions() )){
		$url = 'https://api.github.com/repos/rg-/'.$repro;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,1);
		curl_setopt($ch, CURLOPT_USERAGENT,'YOUR_INVENTED_APP_NAME');
		$content = curl_exec($ch);
		curl_close($ch); 
		if(!empty($content)){
			$api = json_decode($content); 
			return $api; 
		} 
	}

} 

if ( function_exists('pusher')) { 

	/* OPTIONS */

	add_action('wppusher_theme_was_installed','WPBC_update_github_theme_info_option');
	add_action('wppusher_theme_was_updated','WPBC_update_github_theme_info_option');

	function WPBC_update_github_theme_info_option(){
		
		$bootclean_info = wpbc_dashboard_get_github_theme_info('bootclean');
		if(!empty($bootclean_info)){
			update_option('wpbc_github_theme_bootclean_updated_at', $bootclean_info->updated_at);
		}
		if( get_stylesheet() != 'bootclean' ) { 
			$bootclean_info = wpbc_dashboard_get_github_theme_info(get_stylesheet());
			if(!empty($bootclean_info)){
				update_option('wpbc_github_theme_'.get_stylesheet().'_updated_at', $bootclean_info->updated_at);
			}
		}
		
	} 

	/* DASHBOARD */

	add_action('wp_dashboard_setup', 'WPBC_wp_dashboard_wppusher');


	function WPBC_wp_dashboard_wppusher(){

		wp_add_dashboard_widget(
			'wpbc_dashboard_wppusher_widget',
			WPBC_get_admin_icon().' Bootclean > '.__('Github/WP Pusher','bootclean'),
			'wpbc_dashboard_wppusher');

	} 

	function wpbc_dashboard_wppusher(){
		$current_theme = wp_get_theme();
		?>
		<div class="main">
			<p>You are using WP Pusher, that´s great!.</p>

			<h3 class="wpbc-dashboard-title"><b>Github Info</b></h3>
			<div class="" style="padding:10px;">

				<h4><span class="dashicons dashicons-yes text-success"></span> <b>Bootclean</b></h4>
				<ul class="wpbc-dashboard-list">
					<?php  
						$github_theme_info = wpbc_dashboard_get_github_theme_info('bootclean');
						if(!empty($github_theme_info)){

							$update_at_github = $github_theme_info->updated_at;
							$update_at_instaled = get_option('wpbc_github_theme_bootclean_updated_at');

							?>
							<li>html_url: <?php echo $github_theme_info->html_url;?> <br>
								update_at_github: 
								<?php echo date("F jS, Y, h:m:s", strtotime($update_at_github));?> 
								<br>
								update_at_instaled: 
								<?php echo date("F jS, Y, h:m:s", strtotime($update_at_instaled));?>
								<br>
							</li>
							<?php 
						}
					?>
				</ul>
				<?php if( get_stylesheet() != 'bootclean' ) { ?>
				<h4><span class="dashicons dashicons-yes text-success"></span> <b><?php echo $current_theme->get( 'Name' ); ?></b></h4>
				<ul class="wpbc-dashboard-list">
					<?php  
						$github_theme_info = wpbc_dashboard_get_github_theme_info(get_stylesheet());
						if(!empty($github_theme_info)){

							?>
							<li>html_url: <?php echo $github_theme_info->html_url;?> <br>
								updated_at: <?php echo date("F jS, Y, h:m:s", strtotime($github_theme_info->updated_at));?></li>
							<?php 
						}
					?>
				</ul>
				<?php } ?>

			</div>

		</div>
		<?php
	}


} // END wppusher