<?php 
$args['main_container']['a2-mt'] = array(
 
	'id' => 'main-container-areas',
	'type' => 'container',
	'tag' => 'div',
	'attrs' => '',
	'class' => 'container-a2-mt',
	'container_type' => 'fixed', // none | fixed | fixed-left | fixed-right | fluid
	
	'content_areas' => 2, // needed

	'options' => array(
  		'name' => '[a2-mt] '.__('2 Content Areas - Main Top', 'bootclean'),
		'desc' => __('Container with 2 content areas, main on the top, secondary on the bottom.', 'bootclean'),
		'icon' => get_template_directory_uri().'/template-parts/layout/structure/a2-mt.png',
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
					'class' => 'col-12',  

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
					'class' => 'col-12',

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