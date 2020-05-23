<?php 

/*

	If modifications, also here:  template-parts\template-types\slider.php

*/

//$row = get_row();  
//print_r($row); 
//key__layout_slider_row__content _ key__slider__slider_items __ slider_settings_key__r_slider_settings
//key__layout_slider_row__content _ key__slider__slider_items __ slider_breakpoint_heights_key__r_slider_breakpoint_heights

$field_base = 'key__layout_slider_row__content'; 

$slider_items = get_sub_field( $field_base.'_'.'key__slider__slider_items', $post_id); 
$slider_classes = get_sub_field( $field_base.'_'.'key__slider__classes', $post_id);
$slider_settings = get_sub_field($field_base.'_'.'key__slider__slider_items__slider_settings'.'_'.'key__r_slider_settings', $post_id);
$slider_breakpoint_heights = get_sub_field($field_base.'_'.'key__slider__slider_items__slider_breakpoint_heights'.'_'.'key__r_slider_breakpoint_heights', $post_id);
$slider_breakpoint_enable = get_sub_field($field_base.'_'.'key__slider__slider_items__slider_breakpoint_heights'.'_'.'key__r_slider_breakpoint_enable', $post_id); 


$slider_settings_args = get_sub_field($field_base.'_'.'key__slider__slider_items__slider_settings'.'_'.'key__r_slider_settings_args', $post_id); 


$slider_acf_object = get_field_object($field_base, $post_id);  


if(!empty($slider_items)){ 

	$slider_id = '';
	$slick = $slider_settings; 
	$slider_breakpoint_heights = !empty($slider_breakpoint_heights) ? json_decode($slider_breakpoint_heights,true) : ''; 
	$slider_breakpoint_enable = $slider_breakpoint_enable;
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
		 
		$items[] = array(
			'type'=> $item_type,
			'image_object'=> $item_image,
			'content'=> $item_caption,
			'content_class'=> $item_class,
		); 
	} 
	
	$slider_id = 'template-slider-row-'.$post_id;
	$slider_args = array( 
		'this_id' => $post_id,
		'id'=>						$slider_id, 
		'container_class'=>			$slider__classes_item_container,
		'container_item_class'=>	$slider__classes_item_content, 
		'slick'=>					$slider_settings, 
		'slick_args'=>					$slider_settings_args, 
		'slider_acf_object'=> 	$slider_acf_object,
		'items' => $items, 
		'breakpoint-height' => $slider_breakpoint_heights,
		'enable-at' => $slider_breakpoint_enable,
		'lazyload' => true,
	); 
	$slider_args = apply_filters('wpbc/slick/args', $slider_args, $post_id);
	BC_get_component('slick', $slider_args);
}