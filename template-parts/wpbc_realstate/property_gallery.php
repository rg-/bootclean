<?php

$property_id = !empty($property->ID) ? $property->ID : get_the_ID();
$property_gallery = WPBC_get_field('property_gallery', $property_id);


$data_slick = '{ "dots":true, "arrows":true, "infinite":true }';
$data_breakpoint = '{"xs":{"default":"100%","min":"100%","max":"900px"},"md":{"default":"100%","min":"550px","max":"900px"}}';

$gallery_type = 'slick-basic';

if(!empty($property_gallery)){ ?>
<div id="slider-property-single" class="theme-slick-slider"
	data-slick='<?php echo $data_slick; ?>'
	data-breakpoint-height='<?php echo $data_breakpoint; ?>' >
	<?php
	foreach( $property_gallery as $image ){

		//echo '<div class="item">'.$image['url'].'</div>';
		if($gallery_type == 'slick-basic'){
		?>
		<div class="item">
			<img src="<?php echo $image['url']; ?>" class="w-100 h-auto" alt=" "/>
		</div>
		<?php
		}

		if($gallery_type == 'slick-lazyload-cover'){
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