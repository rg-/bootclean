<?php

/*

	

*/

// Function that outputs the contents of the dashboard widget
function wpbc_property_dashboard_widget_FX( $post, $callback_args ) {

	$edit_post_url = admin_url('edit.php?post_type=property'); 
	$new_post_url = admin_url('post-new.php?post_type=property'); 
	$count_property_posts = wp_count_posts('property'); 
		$publish = $count_property_posts->publish;
		$draft = $count_property_posts->draft; 

	?>

	<h4><?php echo __('Properties','bootclean'); ?></h4>

	<p><a href="<?php echo $edit_post_url; ?>"><span class="dashicons dashicons-menu"></span> <?php echo __('Edit','bootclean'); ?></a> or <a href="<?php echo $new_post_url; ?>"><span class="dashicons dashicons-plus"></span> <?php echo __('Add new','bootclean'); ?></a></p>

	<p><?php echo __('Published Properties: ','bootclean'); ?> <b><?php echo $publish; ?></b></p>
	<p><small><?php echo __('Draft Properties: ','bootclean'); ?> <b><?php echo $draft; ?></b></small></p>

	<?php
}

// Function used in the action hook
function wpbc_property_dashboard_widget() {
	wp_add_dashboard_widget(
		'wpbc_property_dashboard_widget',
		__('Realstate Activity', 'bootclean'),
		'wpbc_property_dashboard_widget_FX'
	);
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'wpbc_property_dashboard_widget' );