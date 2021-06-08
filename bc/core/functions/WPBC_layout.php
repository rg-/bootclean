<?php

/*

	Remember this one WPBC_get_layout_customize() !!!

	The entire thing related to which classes will use each template, home, blog, single, etc
	Should be proccessed here and only here!

	WPBC_layout__container_class -> WPBC_get_layout_main_content_classes 

	Ok, wait, things should belong to core/template-tags WPBC_layout
	some things should go in functions, others in defaults.
	Im coding this here, meantime, due to functions order loading since all this thing also
	works with ACF and Theme Options, that is, core/acf and core/theme-options and core/theme-options-defaults

	TODO, globalize things, so two or more functions become one

	TODO, See filters, list them, put all togheter :)

*/ 

function WPBC_get_layout_main_content_classes($type = 'defaults', $just_options = false ){
 		
	$post_id = WPBC_layout__get_id();  

  	$layout_main_content = BC_get_option('bc-options--layout--main-content-custom');  

	// main_content_container_class
	$main_content_custom = WPBC_get_field('main_content_custom', $post_id); 

	// See if has custom page settings enabled, if not, see if has custom options

	if( !empty($main_content_custom) ){

		$container_class = WPBC_get_field('main_content_container_class', $post_id);
		$row_class = WPBC_get_field('main_content_container_row_class', $post_id);
		$col_content_class = WPBC_get_field('main_content_container_col_content_class', $post_id);
		$col_sidebar_class = WPBC_get_field('main_content_container_col_sidebar_class', $post_id);

		$main_content_classes = array(

			'container' => array(
				'type' => $type,
		  		'class' => $container_class,
				'row' => $row_class,
				'col_content' => $col_content_class,
				'col_sidebar' => $col_sidebar_class, 
		  	)

		);

	} else if( ( WPBC_is_options_page_enabled() && $layout_main_content ) || $just_options ){ 

		$container_class = BC_get_option('bc-options--layout--main-content-container-class-'.$type); 
		$row_class = BC_get_option('bc-options--layout--main-content-container-row-class-'.$type);
		$col_content_class = BC_get_option('bc-options--layout--main-content-container-col_content-class-'.$type);
		$col_sidebar_class = BC_get_option('bc-options--layout--main-content-container-col_sidebar-class-'.$type);

  		$main_content_classes = array(

			'container' => array(
				'type' => $type,
		  		'class' => $container_class,
				'row' => $row_class,
				'col_content' => $col_content_class,
				'col_sidebar' => $col_sidebar_class, 
		  	)

		);

	} else {
		$main_content_classes = WPBC_get_layout_main_content_default_classes($type);
	}

	$layout = WPBC_get_layout_structure_build_layout($post_id);
	$main_content_classes['layout'] = $layout;

	return $main_content_classes;
} 

function WPBC_get_layout_main_content_default_or_options_classes($type='defaults'){
	// $type == 'reusables'
	// $type == 'builder'
	$return = ''; 
	$layout_main_content_default_classes = WPBC_get_layout_main_content_default_classes($type); 
	$options = WPBC_get_layout_main_content_classes($type, true);
	$layout_main_content = BC_get_option('bc-options--layout--main-content-custom'); 
	if(!empty($layout_main_content)){
		$return =  $options;
	}else{
		$return =  $layout_main_content_default_classes;
	} 
	return $return;
}


/*

	Using js when change template on page edit, in order to swap between classes settings
	for container, row, col_contente and col_sidebar. See acf-builder.js on core.

	TODO, add a button on fields to "Restore defaults" and each "default" will follow same rule, one for default pages other for builder template pages.

	TODO, make more widget areas or something like that. Prefooter area like old v8 ? 

 	*/
function WPBC_acf_builder_js( $hook ) { 
    global $post; 
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'page' === $post->post_type ) {     
             
            wp_register_script(  'acf-builder', get_template_directory_uri().'/bc/core/acf/js/acf-builder.js' );
            $defaults = WPBC_get_layout_main_content_default_or_options_classes('defaults');
            $builder = WPBC_get_layout_main_content_default_or_options_classes('builder');
            $reusables = WPBC_get_layout_main_content_default_or_options_classes('reusables');
            // Localize the script with new data
			$passed = array(
				'defaults' => $defaults,
				'builder' => $builder,
				'reusables' => $reusables
			);
			wp_localize_script( 'acf-builder', 'builder_defaults', $passed );

			wp_enqueue_script( 'acf-builder' );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'WPBC_acf_builder_js', 10, 1 );