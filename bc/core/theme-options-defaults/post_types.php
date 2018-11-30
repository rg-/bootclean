<?php 

$svg_uri = BC_URI.'/core/assets/svg'; 

$WPBC_enable_post_type_realstate = WPBC_enable_post_type_realstate();

$fields = array( 

	array( 
		'desc' => __( 'Enable Realstate post types.', 'bootclean' ),
		'id' => 'post-type-realstate-enable',
		'std' => $WPBC_enable_post_type_realstate,
		'type' => 'checkbox',
		'ui' => true,
		'hide-reset'=> true, 
	),  
	
);


$icon = WPBC_get_svg_icons('md-add'); 
WPBC_set_option_group( 'post_types', 'Post Types', $icon, $fields ); 