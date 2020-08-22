<?php

/*

	Related:

	/template-parts/builder/
	bc/core/template-tags/wpbc_template_builder.php (The BRAIN here !!)

	@filter WPBC_acf_builder_layouts

*/ 


include('layouts/html_row.php');
//include('layouts/headin_row.php'); 
include('layouts/slider_row.php');
include('layouts/widgets_row.php');
include('layouts/template_row.php'); 
include('layouts/template_part_row.php'); 

// TODO, doing... see acf/layouts/navbar_row and same in template-parts/layouts/navbar_row.php
include('layouts/navbar_row.php'); 

add_filter('acf/fields/flexible_content/layout_title', function($title, $field, $layout, $i){

	$check = array(
		'template_row',
		'template_part_row',
	);

	if( in_array($layout['name'], $check) ){

		if( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX && isset($_POST['value']) ){ 
			// code to handle the AJAX
    	$value = $_POST['value'];  
    }else{
    	// code normal php load
    	$value = $field['value'][$i];
    }
    $t = '';
    $e = '';
    if(!empty($value)){

    	if( $layout['name'] == 'template_row' && !empty($value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template'])){ 
    		$t = $value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template'];
    		$t = get_the_title($t);
    		$e = ' <a title="Edit Template" class="wpbc-btn-small button" href="#"><small>EDIT</small></a>';
    	} 

    	if( $layout['name'] == 'template_part_row' && !empty($value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template_part'])){ 
    		$t = $value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template_part']; 
    		$e = '.php';
    	}

			
			$title = $title.' <svg class="sep" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path class="path" fill="#fff" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg> '.$t . $e;
    }
 
	}

	return $title;

}, 10, 4); 

add_action('admin_head',function(){
	 
	?>
<style>
[data-layout] .acf-fc-layout-handle svg{
	vertical-align: -2px;
}
[data-layout] .acf-fc-layout-handle svg.sep{
	vertical-align: -3px;
}
[data-layout].-collapsed .acf-fc-layout-handle svg path.path{
		fill:#333333 !important;
	}
</style>
	<?php
}); 

/* */

function WPBC_acf_builder_layouts(){
	
	$layouts = array(); 
	
	// Filter here, so i can allways "safe" add a flexible_row by filter, and then, and LAST always, the layout_flexible_row, that in fact has the same layouts defined above and that´s why needs to be last one loaded :)
	$layouts = apply_filters('WPBC_acf_builder_layouts', $layouts);
	$layouts = apply_filters('wpbc/filter/builder_flexible_content/layouts', $layouts);
	
	$flexible_rows = array(
		'layout_flexible_row' => array(
			'key' => 'layout_flexible_row',
			'name' => 'flexible_row',
			'label' => 'Flexible Row',
			'display' => 'block',
			'sub_fields' => array(
			
				array (
					'key' => 'layout_flexible_row__tab_content',
					'label' => 'Content Rows',
					'name' => '',
					'type' => 'tab',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'placement' => 'top',
					'endpoint' => 0,
				),
			
				array(
					'key' => 'key__layout_flexible_row__content',
					'label' => 'Content',
					'name' => 'content',
					'type' => 'flexible_content',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layouts' => $layouts,
					'button_label' => 'Add Sub Row',
					'min' => '',
					'max' => '',
				),
				
				array (
					'key' => 'layout_flexible_row__tab_settings',
					'label' => 'Settings',
					'name' => '',
					'type' => 'tab',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'placement' => 'top',
					'endpoint' => 0,
				),
				
				array(
					'key' => 'key__layout_flexible_row__classes',
					'label' => 'Classes',
					'name' => 'classes',
					'type' => 'clone',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'clone' => array( 
						1 => 'key__r_builder_classes_group'
					),
					'display' => 'seamless',
					'layout' => 'block',
					'prefix_label' => 0,
					'prefix_name' => 0,
				),
			),
			'min' => '',
			'max' => '',
		),
	);
	$layouts['layout_flexible_row'] = $flexible_rows['layout_flexible_row']; 

	$layouts = apply_filters('wpbc/filter/acf/builder/flexible_content/layouts', $layouts);

	return $layouts;
}