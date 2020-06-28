<?php do_action('WPBC_layout__inner_col_sidebar__before'); ?>
<?php 
	// $args passed into template from shortcode as name:area-name-id
	// print_r($args);
	// getting $name
	$content_area_index = 1;
	$name = '';
	if(!empty($args)){
		$finalArray = array(); 
		$asArr = explode( ',', $args ); 
		foreach( $asArr as $val ){
		  $tmp = explode( ':', $val );
		  $key = str_replace(' ', '', $tmp[0]);
		  $finalArray[$key] = $tmp[1];
		}
		if(!empty($finalArray['area-id'])){
			$i = (int) $finalArray['area-id'];
			$content_area_index = $i;
		} 
		if(!empty($finalArray['name'])){
			$name = $finalArray['name']; 
		} 
	}

	$defaults_widgets = array();
	$defaults_widgets = apply_filters('wpbc/filter/layout/secondary-content/defaults_widgets', $defaults_widgets, $name);

	$custom_layout_secondary_areas__enable = WPBC_get_option('custom_layout_secondary_areas__enable'); 


	$widget_output = '';
	ob_start();

	if( !empty($custom_layout_secondary_areas__enable )){

		if(!empty($name)){
			$secondary_area_template = WPBC_get_option('bc-options--layout--secondary-area-template--'.$name);
			echo do_shortcode('[WPBC_get_template id="'.$secondary_area_template.'"/]');

			$secondary_area_widget = WPBC_get_option('bc-options--layout--secondary-area-widget--'.$name);
			if(!empty($secondary_area_widget) && is_active_sidebar( $secondary_area_widget ) ){
				dynamic_sidebar( $secondary_area_widget );
			} 
		} 
	}else{  

		$post_id = WPBC_layout__get_id(); 
		$post_id = apply_filters('wpbc/filter/layout/secondary-content/post_id',$post_id); 
		WPBC_get_template_builder_rows($post_id, 'key__flexible_secondary_content_rows_'.$content_area_index, $name);
	}

	$widget_output = ob_get_clean();
	$widget_output = apply_filters('wpbc/filter/layout/secondary-content/widget_output',$widget_output);
	if(!empty($widget_output)){
		echo $widget_output;
	}else{ 

		if(!empty($defaults_widgets)){
			foreach ($defaults_widgets as $widget) {
				if(is_active_sidebar( $widget ) ){
					dynamic_sidebar( $widget );
				}
			}
		} else{
			if( is_user_logged_in() && current_user_can( 'manage_options' ) ){ 
			$wp_registered_sidebars = $GLOBALS['wp_registered_sidebars']; 
			$name_to_id = 'widget_'.str_replace('-', '_', $name); 
			?>
			<div class="widget-box">
				<p><?php _e('There are no widgets used for:', 'bootclean'); ?></p>
				<h5 class="section-title gmb-2"><?php echo $wp_registered_sidebars[$name_to_id]['name']; ?></h5>
				<p><a target="_blank" class="btn btn-primary btn-sm" href="<?php echo get_admin_url(); ?>/widgets.php"><?php _e('Manage your Widgets', 'bootclean'); ?></a></p>
			</div>
			<?php
			}
			
		}


		
	}

?>
<?php do_action('WPBC_layout__inner_col_sidebar__after'); ?>