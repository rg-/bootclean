<?php 

// remember apply_filters('wpbc/filter/layout/main_container/area-name/'.$value['area-name'].'/class', $class);

$args['main_container']['a1'] = array(
 
	'id' => 'main-container-areas',
	'type' => 'container',
	'tag' => 'div',
	'attrs' => '',
	'class' => 'container-a1',
	'container_type' => 'none', // none | fixed | fixed-left | fixed-right | fluid 
	
	'content_areas' => 1, // needed

	'options' => array(
  		'name' => '[a1] '.__('One Content Area', 'bootclean'),
		'desc' => __('Just One content area, free form.', 'bootclean'),
		'icon' => get_template_directory_uri().'/template-parts/layout/structure/a1.png',
  	),

	'is-main' => true, // required
	'content-area' => array(
		'name' => 'area-main',
		'shortcode' => '[WPBC_get_template name="layout/main-content"/]',
	),  
 
);