<?php

/*

	If modifications, also here:  template-parts\builder\slider_row.php

*/

$slider_items = WPBC_get_field('slider_items',$post->ID);
$slider_classes = WPBC_get_field('slider__classes',$post->ID);  
$slider_settings = WPBC_get_field('slider_settings',$post->ID);
$slider_breakpoint_heights = WPBC_get_field('slider_breakpoint_heights',$post->ID); 
$slider_breakpoint_enable = WPBC_get_field('slider_breakpoint_enable',$post->ID);

if(!empty($slider_items)){
	
	$slider_settings = $slider_settings['r_slider_settings'];
	
	$slider_breakpoint_heights = $slider_breakpoint_heights['r_slider_breakpoint_heights'];
	$slider_breakpoint_heights = !empty($slider_breakpoint_heights) ? json_decode($slider_breakpoint_heights,true) : '';
	
	$slider_breakpoint_enable = $slider_breakpoint_enable['r_slider_breakpoint_enable'];
	//print_r($slider_breakpoint_enable);
	//$slider_breakpoint_enable = !empty($slider_breakpoint_enable) ? json_decode($slider_breakpoint_enable,true) : '';
	
	$slider__classes_item_container = $slider_classes['slider__classes_item_container'];
	$slider__classes_item_content = $slider_classes['slider__classes_item_content']; 
	
	$items = array();
	foreach($slider_items as $item){
		$item_data = $item['r_slider_item'];
		$item_image = $item_data['slider_item_image']['r_background_image'];
		$item_caption = $item_data['slider_item_caption']['r_html_code']; 
		 
		$item__class = $item_data['r_slider_item__class'];
		$item__class_add = $item_data['r_slider_item__class_add']; 
		if($item__class_add){
			$item_class = $item__class; 
		}else{
			$item_class = $slider__classes_item_content .' '. $item__class;
		} 
		
		$item_type = $item_data['r_slider_item__type'];
		
		$items_args = array(
			'type' => $item_type,
			'image_object'=> $item_image,
			'content'=> $item_caption,
			'content_class'=> $item_class
		);
		$items_args = apply_filters('wpbc/slick/item/args', $items_args, $item);

		$items[] = $items_args; 
	}  
	
	$slider_id = 'template-type-slider-'.$post->ID;
	$slider_args = array(
		'this_id' => $post->ID,
		'id' =>						$slider_id, 
		'container_class' =>		$slider__classes_item_container,
		'container_item_class' =>	$slider__classes_item_content,
		'slick' =>					$slider_settings, 
		'items' => 					$items,
		'breakpoint-height' => 		$slider_breakpoint_heights,
		'enable-at' => $slider_breakpoint_enable,
		'lazyload' => true,
	);
	$slider_args = apply_filters('wpbc/slick/args',$slider_args, $post->ID);
	BC_get_component('slick', $slider_args);
}