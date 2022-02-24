<?php
	
	$html = !empty($args['html']) ? $args['html'] : ''; 
	$images = !empty($args['images']) ? $args['images'] : array(); 

	$img_hi_size =  !empty($args['img_hi_size']) ? $args['img_hi_size'] : 'full'; 
	$img_low_size =  !empty($args['img_low_size']) ? $args['img_low_size'] : 'medium'; 
	
	$lazyloader = array(
		'type' => 'slick-image-cover',
	);
	if(!empty($args['lazyloader'])){
		$lazyloader = $args['lazyloader'];
	}

	$slick_class = 'position-absolute-full slick-embed-responsive';
	if(!empty($args['slick_class'])){
		$slick_class = $args['slick_class'];
	}
	$custom_html_class = 'position-absolute-full';
	if(!empty($args['custom_html_class'])){
		$custom_html_class = $args['custom_html_class'];
	}


	$slick = array(
		'dots' => true,
		'arrows' => false, 
		'infinite' => true,
		'speed' => 600,
		'autoplay' => true,
		'autoplaySpeed' => 5000
	);

	if(!empty($args['slick_args'])){
		$slick = array_merge($slick, $args['slick_args']);
	}

	$slick = apply_filters('wpbc/filter/ui-commons/section-background/slick_args', $slick);

	$slick = json_encode($slick);   

	$slick_heights = array(
		'xs' => array(
			'default' => '100%',
			'min' => '100%',
			'max' => '100%'
		), 
	);
	if(!empty($args['slick_heights'])){
		$slick_heights = $args['slick_heights'];
	}
	
	$slick_heights = json_encode($slick_heights);

	if(!empty($images)){
		 
	?>
	<?php if(count($images)>1){ ?>
<div class="theme-slick-slider <?php echo $slick_class; ?>" data-slick='<?php echo $slick; ?>' data-breakpoint-height='<?php echo $slick_heights; ?>' data-disable-affix-offset="true" >
<?php } else { 
	$lazyloader['type'] = 'inview';
	$lazyloader['embed'] = ' h-100';
	?>
	<div class="<?php echo $slick_class; ?>">
<?php } ?>
	<?php 

	foreach ($images as $key => $value) { 
		$img_hi = wp_get_attachment_image_src( $value, $img_hi_size );
		$img_low = wp_get_attachment_image_src( $value, $img_low_size ); 
		$lazyloader['img_hi'] = $img_hi[0];
		$lazyloader['img_low'] = $img_low[0];
		WPBC_build_lazyloader_image($lazyloader);
		?> 
		<?php
	}
?>
</div>
<?php } ?>
<?php if(!empty($html)){ ?>
	<div class="<?php echo $custom_html_class; ?> custom-html">
		<?php echo $html; ?>
	</div>
<?php } ?>