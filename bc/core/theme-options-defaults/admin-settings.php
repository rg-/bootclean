<?php
// Defaults
$background_defaults = array(
	'color' => '',
	'image' => '',
	'repeat' => 'no-repeat',
	'position' => 'center center',
	'attachment'=>'scroll',
	'size'=>'cover'
);

	
// heading
$args = array(

	array(
		'icon-name' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M413.967 276.8c1.06-6.235 1.06-13.518 1.06-20.8s-1.06-13.518-1.06-20.8l44.667-34.318c4.26-3.118 5.319-8.317 2.13-13.518L418.215 115.6c-2.129-4.164-8.507-6.235-12.767-4.164l-53.186 20.801c-10.638-8.318-23.394-15.601-36.16-20.801l-7.448-55.117c-1.06-4.154-5.319-8.318-10.638-8.318h-85.098c-5.318 0-9.577 4.164-10.637 8.318l-8.508 55.117c-12.767 5.2-24.464 12.482-36.171 20.801l-53.186-20.801c-5.319-2.071-10.638 0-12.767 4.164L49.1 187.365c-2.119 4.153-1.061 10.399 2.129 13.518L96.97 235.2c0 7.282-1.06 13.518-1.06 20.8s1.06 13.518 1.06 20.8l-44.668 34.318c-4.26 3.118-5.318 8.317-2.13 13.518L92.721 396.4c2.13 4.164 8.508 6.235 12.767 4.164l53.187-20.801c10.637 8.318 23.394 15.601 36.16 20.801l8.508 55.117c1.069 5.2 5.318 8.318 10.637 8.318h85.098c5.319 0 9.578-4.164 10.638-8.318l8.518-55.117c12.757-5.2 24.464-12.482 36.16-20.801l53.187 20.801c5.318 2.071 10.637 0 12.767-4.164l42.549-71.765c2.129-4.153 1.06-10.399-2.13-13.518l-46.8-34.317zm-158.499 52c-41.489 0-74.46-32.235-74.46-72.8s32.971-72.8 74.46-72.8 74.461 32.235 74.461 72.8-32.972 72.8-74.461 72.8z"/></svg>',
		'name' => __( 'Admin Settings', 'bootclean' ),
		'type' => 'heading'
	)
	
); 

// brand_login
$brand_login = array(
	// sub-heading
	array(
		'name' => __( 'Login screen', 'bootclean' ),
		'type' => 'sub-heading'
	),

		array( 
				'name' =>  __( 'Enable custom Login screen', 'bootclean' ),
				'desc' => __( 'Data will not be removed.', 'bootclean' ),
				'id' => 'bc-options--admin-login--enable',
				'std' => '0',
				'type' => 'checkbox',
				'ui' => true,
				'hide-reset'=> true,
				'condition' => array(
					array(
						'target' => '.group-bodystyles',
						'show' => '1'
					),
					array(
						'target' => '.group-brand',
						'show' => '1'
					)
				)
			),
	
		// Body Styles
	
		array(
			'name' => __( 'Body styles', 'bootclean' ),
			'type' => 'group-start'
		),

			
		
			array(
				'name' =>  __( 'Background', 'bootclean' ),
				//'desc' => __( 'Change the background CSS.', 'bootclean' ),
				'id' => 'bc-options--admin-login--body-background',
				'std' => $background_defaults,
				'type' => 'background',
				'width' => '40%'
			),
			
			/*
			array(
				'name' => __( 'Background color', 'bootclean' ),
				//'desc' => __( 'No color selected by default.', 'bootclean' ),
				'id' => 'bc-options--admin-login--body-background-color',
				'std' => '',
				'type' => 'color',
				'class' => 'mini',
				'width' => '20%'
			),
			*/ 
			array(
				'name' => __( 'Text color', 'bootclean' ),
				//'desc' => __( 'No color selected by default.', 'bootclean' ),
				'id' => 'bc-options--admin-login--body-text-color',
				'std' => '',
				'type' => 'color',
				'class' => 'mini',
				'width' => '30%'
			),
			
			array(
				'name' => __( 'Text color hover', 'bootclean' ),
				//'desc' => __( 'No color selected by default.', 'bootclean' ),
				'id' => 'bc-options--admin-login--body-text-color-hover',
				'std' => '',
				'type' => 'color',
				'class' => 'mini',
				'width' => '30%'
			),
		
		array( 
			'type' => 'group-end'
		),
		
		// group-end !!
		
		array(
			'name' => __( 'Brand', 'bootclean' ),
			'type' => 'group-start'
		),
		 
			// Brand Logo
			array(
				'name' => __( 'Brand logo', 'bootclean' ),
				'desc' => __( 'Change default WP logo here.', 'bootclean' ),
				'id' => 'bc-options--admin-login--brand-logo',
				'std' => '',
				'type' => 'upload'
			),
			array(
				'name' => __( 'Logo width (px)', 'bootclean' ), 
				'id' => 'bc-options--admin-login--brand-logo-width',
				'std' => '',
				'class' => 'mini',
				'type' => 'number',
				'width' => '20%'
			),
			array(
				'name' => __( 'Logo height (px)', 'bootclean' ), 
				'id' => 'bc-options--admin-login--brand-logo-height',
				'std' => '',
				'class' => 'mini',
				'type' => 'number',
				'width' => '20%'
			),
			// Brand Logo END
		
		array( 
			'type' => 'group-end'
		),
	
	array(
		'type' => 'sub-heading-end'
	)
	// sub-heading-end !!
);

// under_construction
$under_construction = array(
	// sub-heading
	array(
		'name' => __( 'Under Construction', 'bootclean' ),
		'type' => 'sub-heading'
	),

	array(
		'name' => __( 'TITLE', 'bootclean' ),
		'desc' => __( 'Custom page TITLE.', 'bootclean' ),
		'id' => 'bc-options--admin-under-construction-title',
		'std' => get_bloginfo( 'blogname' ),
		'type' => 'text',
		'class' => 'w-100',
		'width' => '100%'
	),

	array(
		'name' => __( 'BODY > HTML', 'bootclean' ),
		'desc' => __( 'Customize how site looks like when "Settings->Reading->Website Visibility" is enabled.', 'bootclean' ),
		'id' => 'bc-options--admin-under-construction-html',
		'std' => '',
		'type' => 'textarea',
		'class' => 'codemirror',
		'width' => '100%'
	),

	array(
		'name' => __( 'HEAD > STYLE', 'bootclean' ),
		'desc' => __( 'Add just custom css here. No STYLE tag needed.', 'bootclean' ),
		'id' => 'bc-options--admin-under-construction-style',
		'std' => '',
		'type' => 'textarea',
		'class' => 'codemirror codemirror-css',
		'width' => '100%'
	),

	array(
		'name' => __( 'Javascript', 'bootclean' ),
		'desc' => __( 'Add just custom js here. No SCRIPT tag needed.', 'bootclean' ),
		'id' => 'bc-options--admin-under-construction-script',
		'std' => '',
		'type' => 'textarea',
		'class' => 'codemirror codemirror-js',
		'width' => '100%'
	),

	array(
		'type' => 'sub-heading-end'
	)
	// sub-heading-end !!
);

$group_end = array( 
	array( 
		'type' => 'heading-end'
	) 
);

// merge all
$args = array_merge( $args, $brand_login); 
$args = array_merge( $args, $under_construction); 
$args = array_merge( $args, $group_end); 

// build and set option group/tab
BC_set_bootclean_options('admin', $args);