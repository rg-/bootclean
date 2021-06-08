<?php

/*
	@bootclean
		@core
			@boostrap
				@megamenu

*/

				/*

	Megamenu for WP Menus. ACF custom nav menu filter apply and required for that, see rest of code, it´s clear.
	
	Dependence on ACF, only for the selection on each menu item. Rest can be applied using actions/filters/shortcodes.... some way for sure.

*/ 
 


function WPBC_get_menu_mengamenu($id){ 
	$megamenu_content = WPBC_get_field('megamenu_content', $id);
	if( !empty($megamenu_content) ){
		return $megamenu_content;
	}else{
		return false;
	}
}

add_filter('wp_nav_menu_objects', 'WPBC_wp_nav_menu_objects', 10, 2); 
function WPBC_wp_nav_menu_objects( $items, $args ) {  
	foreach( $items as &$item ) {  
		if( WPBC_get_menu_mengamenu($item->ID) ) { 
			// $item->title .= ' Megamenu'; 
			// print_r($item);
		} 
	}  
	return $items; 
}



add_filter('walker_nav_menu_start_el', 'WPBC_walker_nav_menu_start_el', 10, 4);

function WPBC_build_megamenu($item){
	
	$content = '';
	$mm_id = WPBC_get_menu_mengamenu($item->ID);
	$post_temp = get_post($mm_id);
	if(!empty($post_temp)){ 
		$template_post = get_post($mm_id); 
		$out = $template_post->post_content; 
	}
	
	ob_start(); 
	?>
	<div class="dropdown-megamenu-menu dropdown-menu animated fadeInDown" data-animated-respond="lg">
		<div class="megamenu-dialog">
			<div class="megamenu-dialog-container">
				<div class="container">
					<a href="#" data-toggle="dropdown-close"><i class="fa fa-times"></i></a>
					<div class="row gpt-2 gpb-2">
						<div class="col-lg-4 px-0 gpx-lg-1">
							<figure class="figure">
								<img src="images/sample/architecture/architecture-3076685_1280.jpg" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
								<figcaption class="figure-caption">A caption for the above image.</figcaption>
							</figure>
							<p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a class="btn btn-primary" href="#">Go somewhere</a>
						</div>
						<div class="col-lg-4 px-0 gpx-lg-1">
							<figure class="figure">
								<img src="images/sample/architecture/architecture-3076685_1280.jpg" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
								<figcaption class="figure-caption">A caption for the above image.</figcaption>
							</figure>
						</div>
						<div class="col-lg-4 px-0 gpx-lg-1">
							<figure class="figure">
								<img src="images/sample/architecture/architecture-3076685_1280.jpg" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
								<figcaption class="figure-caption">A caption for the above image.</figcaption>
							</figure>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}



// Detect "megamenu_content" and chage args and classes

function WPBC_get_megamenu_template($item){
	$megamenu_template = WPBC_get_field('wpbc_field__megamenu_template', $item->ID);
	return $megamenu_template;
}
function WPBC_if_has_megamenu($item){
	$use = WPBC_get_field('wpbc_field__megamenu', $item->ID);
	$template = WPBC_get_field('wpbc_field__megamenu_template', $item->ID);
	if(!empty($use) && !empty($template)){
		return true;
	}
}

add_filter('nav_menu_item_args', 'WPBC_nav_menu_item_args', 10, 3);
function WPBC_nav_menu_item_args( $args, $item, $depth ) { 

	if( WPBC_if_has_megamenu($item) ) {
		$args->has_children = 1;
		$args->walker->has_children = 1; 
		// print_r($args); 
		foreach( $args as $arg ) { 
			//$item->title .= $megamenu_content;  
		} 
	}  
	return $args; 
}

add_filter('nav_menu_css_class', 'WPBC_nav_menu_css_class', 10, 4);
function WPBC_nav_menu_css_class( $classes, $item, $args, $depth){ 
	if( WPBC_if_has_megamenu($item) ) { 
		$classes[] = 'megamenu';
	}
	return $classes;
}

function WPBC_walker_nav_menu_start_el($item_output, $item, $depth, $args){ 
	$megamenu_id = WPBC_get_megamenu_template($item);
	if( WPBC_if_has_megamenu($item) ) {
		
		$megamenu_class = 'dropdown-megamenu-menu dropdown-menu animated fadeInDown';
		$megamenu_class = apply_filters('wpbc/filter/megamenu/class', $megamenu_class, $item);
 
		$megamenu_args = 'data-animated-respond="lg" data-animation="megamenu" data-animation-delay=".6s" data-animation-duration=".6s"';
		$megamenu_args = apply_filters('wpbc/filter/megamenu/args', $megamenu_args, $item);

		$megamenu_dialog_class = 'megamenu-dialog';
		$megamenu_dialog_class = apply_filters('wpbc/filter/megamenu/dialog/class', $megamenu_dialog_class, $item);

		$megamenu_container_class = 'megamenu-dialog-container';
		$megamenu_container_class = apply_filters('wpbc/filter/megamenu/container/class', $megamenu_container_class, $item);

		$item_output .= '<div class="'.$megamenu_class.'" '.$megamenu_args.'>';
		$item_output .= '<div class="'.$megamenu_dialog_class.'">';
		$item_output .= '<div class="'.$megamenu_container_class.'">';

		$item_output .= do_shortcode('[WPBC_get_template id="'.$megamenu_id.'"/]');

		$item_output .= '</div></div></div>';
	}
	return $item_output;
}


if( function_exists('acf_add_local_field_group') ):

/*

	This is also part for the Megamenu section, but needs TODO:
	
	Create a function to handle all ACF groups, fields, etc, in separate way, ready to mix, use, or anything later.
	Something like:
	
		acf/groups
		acf/fields
		acf/defaults (here i will use filters for defaults, options, choices, etc and could be then the interaction with theme options)

		
		
		
	Nomeclature keys should be:
	
	For FIELDS
		Keys:
			k_wpbc_field__[field name]
			k_wpbc_field__[field name]_[sub names]
		Names:
			wpbc_field__[field name]
			wpbc_field__[field name]_[sub names]
	
	FOR GROUPS
		Keys:
			k_wpbc_group__[group name] 
		
	
*/

$fields = array(
	array(
		'key' => 'k_wpbc_field__megamenu',
		'label' => 'Megamenu',
		'name' => 'wpbc_field__megamenu',
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => '',
		'default_value' => 0,
		'ui' => 1,
		'ui_on_text' => '',
		'ui_off_text' => '',
	),
	array(
		'key' => 'k_wpbc_field__megamenu_template',
		'label' => 'Template',
		'name' => 'wpbc_field__megamenu_template',
		'type' => 'post_object',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'k_wpbc_field__megamenu',
					'operator' => '==',
					'value' => '1',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => array(
			0 => 'wpbc_template',
		),
		'taxonomy' => array(
		),
		'allow_null' => 0,
		'multiple' => 0,
		'return_format' => 'id',
		'ui' => 1,
	),
);


/*
	Nomeclature should be:
	
	wpbc_group__[group name]
	
*/
acf_add_local_field_group(array(
	'key' => 'wpbc_group__megamenu',
	'title' => 'Megamenu',
	'fields' => $fields,
	'location' => array(
		array(
			array(
				'param' => 'nav_menu_item',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;