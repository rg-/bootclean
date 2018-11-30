<?php


	/*

	widgets

	*/


add_filter('WPBC_widgets_init__defaults', function($defatuls_widgets=array()){

	$new_widgets = WPBC_get_option('bc-options--widgets--areas');
	if(!empty($new_widgets)){
		foreach($new_widgets as $k=>$v){  
			$defatuls_widgets[] = array(
				'name'          => $v,
				'id'            => sanitize_title_with_dashes($v),
				'description'   => '',
				'class'         => 'wpbc-widget', // ?? This one is a myst?
				'before_widget' => '<div class="widget-box">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="section-title">',
				'after_title'   => '</h4>',
			);

		} 
 	}
	return $defatuls_widgets; 
},10,1);


$widgets_areas = array( 
	array(
		'name' => __( 'Widget Areas', 'bootclean' ),
		'type' => 'sub-heading', 
	),

	array(
		'name' => __( 'Manage widget areas', 'bootclean' ),
		'desc' => '',
		'id' => 'bc-options--widgets--areas',
		'std' => 'Default',
		'type' => 'repeater',
		'hide-reset' => '1',
		'render_filter' => 'widgets_areas_options'
	),

	array( 
		'name' => __( 'How to', 'bootclean' ), 
		'desc' => __( 'Add as many widgets areas needed, they will appear under Appeareance -> Widgets for you to use.', 'bootclean' ),
		'type' => 'info',
		'width' => '100%'
	),

	array( 
		'name' => '', 
		'desc' => __( '<b>Take care</b> when removing/renaming, idealy don´t do it unless you re-edit the windgets areas and it´s contents too. If you accidentaly delete a widget area, you can create it again with the same name, that way you wiget area will appear again with all the widgets inside.', 'bootclean' ),
		'type' => 'info',
		'width' => '100%'
	),

	array( 
		'name' => '', 
		'desc' => __( 'Once you have widgets areas created, you can use them over pages almost anywhere and also here on Layout settings for a default use over the site. Ex, you can create a Template that will hold a widget area and then use that template as a Footer on some pages but not on all of them. Same applys for Sidebars or whatever you need that can be done using widgets.', 'bootclean' ),
		'type' => 'info',
		'width' => '100%'
	),
	 
	array( 
		'type' => 'sub-heading-end', 
	), 
);

// Merge all those fileds into one...
$fields = array();
$fields = array_merge( $fields, $widgets_areas); 

// Create the Group

$icon = WPBC_get_svg_icons('md-browsers'); 
WPBC_set_option_group( 'widgets', 'Widgets', $icon, $fields ); 