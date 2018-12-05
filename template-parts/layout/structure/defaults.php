<?php

/*
	
	@since 9.0.1

	DO NOT REMOVE EVER THIS FILE; SINCE IS THE BASE FOR LAYOUTS
	It doesn´t care if is visible or not on the admin area, file needs to be here,
	can be replaced on child, but take care of main components, should be:

		'main_navbar' => array(),
		'main_pageheader' => array(),
		'main_container' => array(), 
		'main_footer' => array(),

		See: 'wpbc/filter/layout/sections'

	@bootclean
		@template-builder
			@layouts
				@defaults
	
	Default layout structure:

	This arrays will hold almost anything, not just html structure, class and attrs, 
	also it´s contents (using shortcodes) and also, and very important:
	From here theme options and ACF post options will be auto-generated

	Also remember filters that can re-build anything inside this arrays from a child theme, 
	so you can adjust classes, add/remove content areas, and so on, using things like:
	add_filter('wpbc/filter/layout/struture', function($args){ 
		if( is_page() ){ 
			$args['main_container']['defaults']['class'] = 'your-new-class'; 
		}
		if( is_404() ){ 
			$args['main_container']['defaults']['class'] = 'your-404-class'; 
		}
	},10,1);

	Also;

	Example for all "area-1" output  
	add_filter('wpbc/filter/layout/content-area/shortcode/area-1', function($shortcode, $key, $value){  
		return 'hello'; 
	},10,3);
	
	Example for only "a2-ml" layout "area-1" output 
	add_filter('wpbc/filter/layout/a2-ml/content-area/shortcode/area-1', function($shortcode, $value){  
		return 'hello'; 
	},10,2); 
	 

*/


$args['main_container']['defaults'] = array(
 
	'id' => 'main-container-areas',
	'type' => 'container',
	'tag' => 'div',
	'attrs' => '',
	'class' => 'container-defaults',
	'container_type' => 'fixed', // none | fixed | fixed-left | fixed-right | fluid
	
	'content_areas' => 2, // needed

	/*
		Needed for theme options parts
	*/
	'options' => array(
  		'name' => 'Default',
		'desc' => 'Default layout. Two columns, main content left, secondary content right.',
		'icon' => get_template_directory_uri().'/template-parts/layout/structure/defaults.png',
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



$args['main_navbar']['defaults'] = array(
 
	'id' => 'main_navbar_container',
	'type' => 'container',
	'tag' => 'div',
	'attrs' => '',
	'class' => 'container-navbar',

	'content-area' => array(
		'name' => 'navbar-area-1',
		'shortcode' => '[WPBC_get_template name="layout/main-navbar"/]',
	),

);
$args['main_pageheader']['defaults'] = array(
 
	'id' => 'main_pageheader_container',
	'type' => 'container',
	'tag' => 'div',
	'attrs' => '',
	'class' => 'container-page-header',

	'content-area' => array(
		'name' => 'page-header-1',
		'shortcode' => '[WPBC_get_template name="layout/page-header"/]',
	),

);
$args['main_footer']['defaults'] = array(
 
	'id' => 'main_footer_container',
	'type' => 'container',
	'tag' => 'div',
	'attrs' => '',
	'class' => 'container-footer',
	'no_wrap' => true,

	'content-area' => array(
		'name' => 'footer-area-1',
		'shortcode' => '[WPBC_get_template name="layout/main-footer"/]',
	),

);