<?php 

$use_wpbc_template_landing = WPBC_is_template_landing_enabled();

if(!$use_wpbc_template_landing){
	function WPBC_remove_template_landing_builder( $templates ) {
	    unset( $templates['_template_landing_builder.php'] );
	    return $templates;
	}
	add_filter( 'theme_page_templates', 'WPBC_remove_template_landing_builder' );
}

if($use_wpbc_template_landing){
 
	include('template-landing-builder/functions.php'); 

	/*

		Init first section as Page Header.

	*/

	if(function_exists('WPBC_template_landing_build_section')){  
		
		$default_section = array(
				'id' => 'main-page-header',
				'class' => 'template-landing--page_header',
				'acf' => array(
					'group_id' => 'page_header',
					'label' => __('Page Header','bootclean'),
					'group_layout' => 'seamless', 
					'sub_fields' => array(),
				),
			);
		$default_section = apply_filters('wpbc/filter/template-landing/default_section', $default_section );
		$build_sections = array();
		$top_section = apply_filters('wpbc/filter/template-landing/top_section', array() );
		$build_sections[] = $top_section;
		$build_sections[] = $default_section;
		$build_sections = apply_filters('wpbc/filter/template-landing/build_sections', $build_sections);
		foreach ($build_sections as $key => $value) { 
			if(!empty($value['acf'])){
				$value['acf']['sub_fields'] = apply_filters('wpbc/filter/template-landing/sub_fields/?group='.$value['acf']['group_id'].'', $value['acf']['sub_fields']); 
			}
			WPBC_template_landing_build_section($value);
		}
		
	 
	}

	include('template-landing-builder/admin.php');
	include('template-landing-builder/acf.php');
	include('template-landing-builder/layout.php');  

} // if $use_wpbc_template_landing END

/* USAGE ON CHILD */

/*

// Add a new section, this will also needs a template part under /template-parts/template-landing
// In this case /template-parts/template-landing/section-1.php

add_filter('wpbc/filter/template-landing/build_sections', function($build_sections){
	$build_sections[] = array(
			'id' => 'section-1',
			'class' => 'template-landing--section-1',
			'acf' => array(
				'group_id' => 'section_1',
				'label' => __('Section 1','bootclean'),
				'sub_fields' => array(),
			),
		);
	return $build_sections;
},10,1);


// For existing sections, add fields using group_id, for example, adding into the defautl "page_header", section

add_filter('wpbc/filter/template-landing/sub_fields/?group=page_header', function($sub_fields){
	$sub_fields[] = array (
		'key' => 'field_58e0964fb1f41',
		'label' => 'Text Field',
		'name' => 'text_field',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => 'default',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	);
	return $sub_fields;
},10,1);


*/