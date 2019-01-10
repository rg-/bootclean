<?php

$property_id = !empty($property->ID) ? $property->ID : get_the_ID();

$property_gallery = WPBC_get_field('property_gallery', $property_id);

// data-slick

$data_slick_arr = array (
	'dots' => true,
	'arrows' => true,
	'infinite' => true,
); 
$data_slick = json_encode($data_slick_arr); 

// data-breakpoint-height
$data_breakpoint_arr = array (
	'xs' => array (
	    'default' => '100%',
	    'min' => '100%',
	    'max' => '900px',
	),
	'md' => array (
		'default' => '100%',
		'min' => '550px',
		'max' => '900px',
	),
);
$data_breakpoint = json_encode($data_breakpoint_arr);  

// items_type

$items_type = apply_filters('wpbc/filter/realstate/property_gallery/items_type','slick-basic');

if(!empty($property_gallery)){ ?>
<div id="slider-property-single" class="theme-slick-slider"
	data-slick='<?php echo $data_slick; ?>'
	data-breakpoint-height='<?php echo $data_breakpoint; ?>' >
	<?php
	foreach( $property_gallery as $image ){
		
		if($items_type == 'slick-basic'){

?>
<div class="item">
	<?php 
	echo wp_get_attachment_image( $image['ID'], array($image['width'],$image['height']), '', array('class'=>'w-100 h-auto') );

	?>
</div>
<?php
		}

		if($items_type == 'slick-lazyload-cover'){
?>
<div class="item loading">
	<span class="lazyload-loading"></span>
	<div data-lazyload-src="<?php echo $image['url']; ?>" class="item-container image-cover" style="background-image:url(<?php echo $image['sizes']['medium']; ?>);" ></div>					
</div>
<?php
		} 
		
	}
	?>
</div>
<?php } ?>