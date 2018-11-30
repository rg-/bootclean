<?php 
$args['main_container']['a3-mr'] = array(
 
	'id' => 'main-container-areas',
	'type' => 'container',
	'tag' => 'div',
	'attrs' => '',
	'class' => 'container-a3-mr',
	'container_type' => 'fixed', // none | fixed | fixed-left | fixed-right | fluid
	
	'content_areas' => 3, // needed

	'options' => array(
  		'name' => '[a3-mr] '.__('3 Content Areas - Main Left', 'bootclean'),
		'desc' => __('Container with 3 content areas, main on the left, 2 secondary areas on the right.', 'bootclean'),
		'icon' => get_stylesheet_directory_uri().'/template-parts/layout/structure/a3-mr.png',
  	),

  	'content' => array( // First level

		// First row
		'main-container-row' => array(

			'id' => 'main-container-row',
			'type' => 'row',
			'tag' => 'div',
			'attrs' => '',
			'class' => 'row row-test',

			'content' => array( // Second level

				// Columns 

				'main-content-area' => array( 
					'is-main' => true,
					'id' => 'main-content-area',
					'area-name' => 'area-main',
					'tag' => 'main',
					'type' => 'col',
					'attrs' => '',
					'class' => 'col-md-6', 
					
					'content-area' => array(
						'name' => 'area-main',
						'shortcode' => '[WPBC_get_template name="layout/main-content"/]',
					), 
				), 

				'area-1' => array(
					'id' => 'area-1',
					'area-name' => 'area-1',
					'type' => 'col',
					'attrs' => '',
					'class' => 'col-md-3',

					'content-area' => array(
						'name' => 'area-1',
						'shortcode' => '[WPBC_get_template name="layout/secondary-content" args="name:area-1"/]',
					), 
				), 

				'area-2' => array(
					'id' => 'area-2',
					'area-name' => 'area-2',
					'type' => 'col',
					'attrs' => '',
					'class' => 'col-md-3',

					'content-area' => array(
						'name' => 'area-2',
						'shortcode' => '[WPBC_get_template name="layout/secondary-content" args="area-id: 2,name:area-2"/]',
					), 
				),
				 

				// Columns END

			), // Second level END

		), // First row END

	), // First Level END
 	// content END
 
);