<?php 
$args['main_container']['a2-ml'] = array(
 
	'id' => 'main-container-areas',
	'type' => 'container',
	'tag' => 'div',
	'attrs' => '',
	'class' => 'container-a2-ml',
	'container_type' => 'fixed', // none | fixed | fixed-left | fixed-right | fluid
	
	'content_areas' => 2, // needed

	'options' => array(
  		'name' => '[a2-ml] '.__('2 Content Areas - Main Left', 'bootclean'),
		'desc' => __('Container with 2 content areas, main on the left, secondary on the right.', 'bootclean'),
		'icon' => get_template_directory_uri().'/template-parts/layout/structure/a2-ml.png',
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
					'class' => 'col-md-8',  

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
					'class' => 'col-md-4',

					'content-area' => array(
						'name' => 'area-1',
						'shortcode' => '[WPBC_get_template name="layout/secondary-content" args="name:area-1"/]',
					),
					
				), 

				// Columns END

			), // Second level END

		), // First row END

	), // First Level END
 	// content END
 
);