<?php 

$svg_uri = BC_URI.'/core/assets/svg'; 

$WPBC_enable_cleaner_updates_notifications = WPBC_enable_cleaner_updates_notifications();
$WPBC_enable_cleaner_updates_notifications_op = WPBC_enable_cleaner_updates_notifications_op();

$WPBC_enable_cleaner_updates_checks = WPBC_enable_cleaner_updates_checks();
$WPBC_enable_cleaner_updates_checks_op = WPBC_enable_cleaner_updates_checks_op();


$fields = array( 

	array( 
		'desc' => __( 'Disable Updates Notifications', 'bootclean' ),
		'id' => 'cleaner-updates-notifications',
		'std' => $WPBC_enable_cleaner_updates_notifications,
		'type' => 'checkbox',
		'ui' => true,
		'disabled'=> $WPBC_enable_cleaner_updates_notifications_op,
		'hide-reset'=> true, 
	), 

	array( 
		'desc' => __( 'Disable Checks for Updates', 'bootclean' ),
		'id' => 'cleaner-updates-checks',
		'std' => $WPBC_enable_cleaner_updates_checks,
		'type' => 'checkbox',
		'ui' => true,
		'disabled'=> $WPBC_enable_cleaner_updates_checks_op,
		'hide-reset'=> true, 
	),  
	
);


$icon = WPBC_get_svg_icons('md-settings'); 
WPBC_set_option_group( 'advanced', 'Advanced Settings', $icon, $fields ); 