<?php
function WPBC_group_builder__layout_template_row_clone($clone = array()){  

	$clone = array(
		0 => 'key__r_tab__content',
		1 => 'key__r_wpbc_template',
		2 => 'key__r_tab__settings',
		3 => 'key__r_builder_classes_group',
		4 => 'key__r_tab__advanced',
		5 => 'key__r_wpbc__advanced_group_inview', 
	);

	return apply_filters('WPBC_group_builder__layout_template_row_clone', $clone);
}
add_filter('WPBC_acf_builder_layouts', function($layouts){

	$layouts['layout_template_row'] =  array(
		'key' => 'layout_template_row',
		'name' => 'template_row',
		'label' => '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#fff" d="M467.3 168.1c-1.8 0-3.5.3-5.1 1l-177.6 92.1h-.1c-7.6 4.7-12.5 12.5-12.5 21.4v185.9c0 6.4 5.6 11.5 12.7 11.5 2.2 0 4.3-.5 6.1-1.4.2-.1.4-.2.5-.3L466 385.6l.3-.1c8.2-4.5 13.7-12.7 13.7-22.1V179.6c0-6.4-5.7-11.5-12.7-11.5zM454.3 118.5L272.6 36.8S261.9 32 256 32c-5.9 0-16.5 4.8-16.5 4.8L57.6 118.5s-8 3.3-8 9.5c0 6.6 8.3 11.5 8.3 11.5l185.5 97.8c3.8 1.7 8.1 2.6 12.6 2.6 4.6 0 8.9-1 12.7-2.7l185.4-97.9s7.5-4 7.5-11.5c.1-6.3-7.3-9.3-7.3-9.3zM227.5 261.2L49.8 169c-1.5-.6-3.3-1-5.1-1-7 0-12.7 5.1-12.7 11.5v183.8c0 9.4 5.5 17.6 13.7 22.1l.2.1 174.7 92.7c1.9 1.1 4.2 1.7 6.6 1.7 7 0 12.7-5.2 12.7-11.5V282.6c.1-8.9-4.9-16.8-12.4-21.4z"/></svg></i> Template Row',
		'display' => 'block',
		'sub_fields' => array(
			array(
				'key' => 'key__layout_template_row__content',
				'label' => 'Content',
				'name' => 'content',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => WPBC_group_builder__layout_template_row_clone(),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;

},10,1); 

add_filter('acf/fields/flexible_content/layout_title', function($title, $field, $layout, $i){

	$check = array(
		'template_row',
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
    if(!empty($value)){
    	$t = $value['key__layout_'.$layout['name'].'__content_key__r_wpbc_template'];
			// key__layout_template_row__content_key__r_wpbc_template
			// _print_code($value);

			$t = get_the_title($t);
			$title = $title.' -> '.$t . ' <a title="Edit Template" class="wpbc-btn-small button" href="#"><small>EDIT</small></a>';
    }
 
	}

	return $title;

}, 10, 4); 