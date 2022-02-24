<?php

/*
	
	NEW v12.0.0

	main-page-header

*/

$post_id = apply_filters('wpbc/filter/layout/main-page-header/post_id', '');
$params = WPBC_layout__main_page_header_defaults($post_id);  
$type = $params['type']; 
$use_from_options = $params['use_from_options'];
$use_template = $params['use_template']; 
$use_custom_template = $params['use_custom_template']; 
$use_custom_html = $params['use_custom_html'];  
$use_page_title = $params['use_page_title'];    
$template_id = $params['template_id'];  
$custom_attrs = $params['custom_attrs'];   
$custom_class = $params['custom_class'];  

	$custom_attrs = apply_filters('wpbc/main-page-header/data', $custom_attrs);
	$custom_class = apply_filters('wpbc/main-page-header/class', $custom_class);  
		$custom_class = 'page-header ui-page-header '.$custom_class;  

$template_style = 'default';
$template_container = '';
$gallery_images = '';

if( !empty($params['options']) ) {

	$options = $params['options'];

	$template_container = $options['container'];
	$template_style = $options['style'];

	$background = $options['background'];
	if( !empty($background) ){
		
		$gallery = $background['layout_header_template_background-gallery'];
		$gallery_temp = array(); 

		if( !empty($gallery) ){
			foreach ($gallery as $key => $value) {
				$gallery_temp[] = $value['id'];
			}
			$gallery_images = implode(",",$gallery_temp);  
		}


		$background_color = $background['layout_header_template_background-color'];
		$color = $background['layout_header_template_color'];

		if( !empty($background_color) || !empty($color) ){
			$custom_attrs .= ' style="';
			if(!empty($background_color)){
				$custom_attrs .= 'background-color:'.$background_color.';';
			}
			if(!empty($color)){
				$custom_attrs .= 'color:'.$color.';';
			}
			$custom_attrs .= '" ';
		}

	}
}

if( $type == 'title' ){

	$args = array(
		'id' => $params['id'],
		'is_main' => $params['is_main'],
		'headline' => $use_page_title['title'],
		'lead' => $use_page_title['subtitle'], 
		'constainer' => $template_container,
		'before' => $params['before'],
		'after' => $params['after'],
	);  
	if(!empty($gallery_images)){
		$args['after'] = $params['after']."[WPBC_get_section_background images='".$gallery_images."']";
	} 
	$args['class'] = 'z-index-10 '.$custom_class;
	$args['container_class'] = 'container position-relative z-index-10';
	$args['attrs'] = $custom_attrs;
	
	// _print_code($template_style);
	// template-parts/components/
 	// $template_style: default, jumbotron, ....
 	WPBC_get_template_part('components/'.$template_style, $args); 

}

if( $type == 'html' ){

	$args = array(
		'id' => $params['id'],
		'is_main' => $params['is_main'], 
		'content' => $params['use_custom_html'], 
		'class' => 'z-index-10 '.$custom_class,
		'attrs' => $custom_attrs,
		'container_class' => 'position-relative z-index-10',
		'before' => $params['before'],
		'after' =>  $params['after']."[WPBC_get_section_background images='".$gallery_images."']",
	); 

	WPBC_get_template_part('components/container', $args); 

}

if( $type == 'template' ){

	?>
<div id="<?php echo $params['id']; ?>" class="page-header <?php echo $custom_class; ?>" <?php echo $custom_attrs; ?>>
	<?php

		echo do_shortcode($params['before']);

		add_action('wpbc/slick/item/content/before', 'WPBC_page_header_slick_item_before',0,2);
		add_action('wpbc/slick/item/content/after', 'WPBC_page_header_slick_item_after',0,2);
		echo do_shortcode('[WPBC_get_template id="'.$template_id.'"]');	 
		remove_action('wpbc/slick/item/content/before', 'WPBC_page_header_slick_item_before',0,2);
		remove_action('wpbc/slick/item/content/after', 'WPBC_page_header_slick_item_after',0,2);

		echo do_shortcode($params['after']);

	?>
</div>
	<?php
	echo WPBC_get_edit_template_builder(number_format($template_id));	
}

if( empty($type) && !empty($params['use_custom_template_part']) ){
		?>
<div id="<?php echo $params['id']; ?>" class="page-header <?php echo $custom_class; ?>" <?php echo $custom_attrs; ?>>
	<?php
	WPBC_get_template_part($params['use_custom_template_part']);
		?>
</div>
	<?php
}
?>