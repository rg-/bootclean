<?php 

$svg_uri = BC_URI.'/core/assets/svg'; 

$WPBC_enable_post_type_realstate = WPBC_enable_post_type_realstate();
$WPBC_enable_post_type_resource = WPBC_enable_post_type_resource();

$WPBC_enable_post_type_realstate_op = WPBC_enable_post_type_realstate_op();
$WPBC_enable_post_type_resource_op = WPBC_enable_post_type_resource_op();

$fields = array( 

	array( 
		'desc' => __( 'Enable Realstate post types.', 'bootclean' ),
		'id' => 'post-type-realstate-enable',
		'std' => $WPBC_enable_post_type_realstate,
		'type' => 'checkbox',
		'ui' => true,
		'disabled'=> $WPBC_enable_post_type_realstate_op,
		'hide-reset'=> true, 
	), 

	array( 
		'desc' => __( 'Enable Resources post types.', 'bootclean' ),
		'id' => 'post-type-resource-enable',
		'std' => $WPBC_enable_post_type_resource,
		'type' => 'checkbox',
		'ui' => true,
		'disabled'=> $WPBC_enable_post_type_resource_op,
		'hide-reset'=> true, 
	),  
	
);


$icon = WPBC_get_svg_icons('md-add'); 
WPBC_set_option_group( 'post_types', 'Post Types', $icon, $fields ); 