<?php 

/* Pages and Builder */

include('groups/builder__layout_main_navbar.php');
include('groups/builder__layout_main_header.php');
include('groups/builder__layout_main_content.php'); // obsolete < 9.0
include('groups/builder__layout_main_footer.php');
include('groups/builder__layout_code.php'); 

include('groups/builder__layout_export.php'); 

/* Posts / Archiives */

include('groups/builder__layout_posts_page.php');

/* Fields */

include('groups/builder__layout.php'); 
include('groups/builder__flexible.php');
include('groups/builder_slider.php');
include('groups/builder_reusables_all.php');



function secondary_content_rows( $field ) { 
		if(!empty($_GET['post'])){
			$layout = WPBC_get_layout_structure_build_layout($_GET['post']);  
			$layout_defaults = WPBC_layout_struture__defaults();
			$content_areas = $layout_defaults['main_container'][$layout]['content_areas']; 
			//$field['label'] .= '<br>content_areas: '.$content_areas; 
			if($content_areas==1){
				//$field['label'] .= ' No mostrar area 1 y 2'; 
				if($field['key']=='key__flexible_secondary_content_rows_1'){
					return false;
				}
				if($field['key']=='key__flexible_secondary_content_rows_2'){
					return false;
				} 
			} 
			if($content_areas==2){
				//$field['label'] .= ' Mostrar solo area 1'; 
				if($field['key']=='key__flexible_secondary_content_rows_2'){
					return false;
				} 
			} 
			if($content_areas==3){
				//$field['label'] .= ' Mostrar area 1 y 2';
			} 
		}
    // Don't show this field once it contains a value.
    if( $field['value'] ) {
        //return false;
    }  
    return $field;
}

// Apply to fields named "example_field".
add_filter('acf/prepare_field/name=secondary_content_rows_1', 'secondary_content_rows');
add_filter('acf/prepare_field/name=secondary_content_rows_2', 'secondary_content_rows');

function secondary_content_rows_message($field){
	if(!empty($_GET['post'])){
		$layout = WPBC_get_layout_structure_build_layout($_GET['post']);  

		$layout_defaults = WPBC_layout_struture__defaults();
		$content_areas = $layout_defaults['main_container'][$layout]['content_areas'];   

		if($content_areas==1){
			$field['label'] = 'This layout ('.$layout.') has no secondary areas to manage.';
		}
	}
	return $field;
}
add_filter('acf/prepare_field/key=field__secondary_content_rows_message', 'secondary_content_rows_message');