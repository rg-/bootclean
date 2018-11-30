<?php


/*

	wpbc/layout/inner

		that filter puts col_content and col_sidebar

	core/acf/group-fields.php - line 356

		here im using col_content and col_sidebar too
	
	core/acf/js/acf-builder.js

		using col_content as well

	core/functions/WPBC_layout.php

		using col_content

	core/template-tags/WPBC_class.php

		using col_content too

	So in order to create new Areas, i need to deal someway with this "sidebar"

	mmmmmmm let´s see. Firsst.... ohhh la la 	


*/


/*

	This filter will find wich tempate classes arguments to use on front-end,
	will overide defaults
	this while not using custom page settings

	Used on

	@ WPBC_layout__container_class

*/
add_filter('wpbc/filter/layout/start/defaults', function($template_args){

	$page_template_slug = get_page_template_slug();

	$WPBC_get_template = WPBC_get_template(array('show_post_types'=>true)); 
	$template_args['template'] = $WPBC_get_template;

	if( '_template_builder.php' == $page_template_slug ){
		$container = WPBC_get_layout_main_content_classes('builder');  
	}

	if( 'single-post' == $WPBC_get_template ){
		$container = WPBC_get_layout_main_content_classes('single-post'); 
	}

	if( 'page' == $WPBC_get_template ){
		$container = WPBC_get_layout_main_content_classes('page');  
	}

	$template_args['areas'] = 		!empty($container['areas']) ? $container['areas'] : '';
	$template_args['container'] = 	!empty($container['container']) ? $container['container'] : '';
	$template_args['options'] = 	!empty($container['options']) ? $container['options'] : '';

	return $template_args;
	
}, 0, 1 );

/*

	This ones are defaults for layouts classes

	When adding into this, options will be added too.
	Options settings will be used if enabled if not, the filter above
	"wpbc/filter/layout/start/defaults"
	will do the job to determine which template classes to use on front-end.

	The idea here is to have a simple filter to do the job via child theme functions, but also let the user to make changes over Theme Options and also on each admin page.

*/

function WPBC_get_layout_main_content_default_classes( $type='defaults' ){ 

	$classes['defaults'] = array( 
		'areas' => array(
			'main' => 'col_content',
			'secondary' => 'col_sidebar'
		),
		'container' => array(
			'type' => 'defaults',
	  		'class' => 'container container-global',
			'row' => 'row',
			'col_content' => 'col-sm-8',
			'col_sidebar' => 'col-sm-4',
	  	),
	  	'options' => array(
	  		'name' => 'Global',
			'desc' => 'For all templates',
	  	)
	);

	$classes['builder'] = array( 
		'areas' => array(
			'main' => 'col_content',
			'secondary' => 'col_sidebar'
		),
		'container' => array(
			'type' => 'container',
	  		'class' => 'container-builder',
			'row' => '',
			'col_content' => '',
			'col_sidebar' => '',
	  	),
	  	'options' => array(
	  		'name' => 'Template Builder',
			'desc' => 'post_type: <b>wpbc_template</b>',
	  	)
	); 

	$classes['reusables'] = array( 
		'areas' => array(
			'main' => 'col_content',
			'secondary' => 'col_sidebar'
		),
		'container' => array(
			'type' => 'reusables',
	  		'class' => 'container-reusables',
			'row' => '',
			'col_content' => '',
			'col_sidebar' => '',
	  	),
	  	'options' => array(
	  		'name' => 'Template Builder > Rows',
			'desc' => '<b>reusables</b>',
	  	)
	); 

	$classes['single-post'] = array( 
		'areas' => array(
			'main' => 'col_content',
			'secondary' => 'col_sidebar'
		),
		'container' => array(
			'type' => 'single-post', 
			'class' => 'container container-single-post',
			'row' => 'row',
			'col_content' => 'col-sm-8',
			'col_sidebar' => 'col-sm-4',
	  	),
	  	'options' => array(
	  		'name' => 'Single Post',
			'desc' => 'post_type: <b>post</b>',
	  	)
	); 

	$classes['page'] = array(
		'areas' => array(
			'main' => 'col_content',
			// 'secondary' => 'col_sidebar'
		), 
		'container' => array(
			'type' => 'page', 
			'class' => 'container container-page',
			'row' => 'row',
			'col_content' => 'col-sm-8',
			'col_sidebar' => 'col-sm-4',
	  	),
	  	'options' => array(
	  		'name' => 'Single Page',
			'desc' => 'post_type: <b>page</b>',
	  	)
	); 
	 
	/*
	Use this filter on child theme to override template classes defaults values, just use if_singl() or anthing to re-build any or the arguments, someting like:
	
	$newclasses['page']['container']['row'] = 'row position-relative';

	*/
	$classes = apply_filters('wpbc/filter/layout/main/content/defaults', $classes);

	if($type=='all'){
		return $classes; 
	}else{
		return $classes[$type]; 
	}
	
}  