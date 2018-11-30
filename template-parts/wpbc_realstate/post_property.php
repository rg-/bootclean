<?php  

	$shortcode_id = $template_args['target_id'];

	$property_class = apply_filters('wpbc/filter/property/loop/class', 'col-sm-6 col-md-4 gmy-1', $shortcode_id);  

	$property_id = !empty($property->ID) ? $property->ID : get_the_ID();
?>
<article data-inview="animated" data-animated-on="fadeIn" data-animated-off="fadeOut" data-animated-once="1" id="property-<?php echo $property_id; ?>" <?php post_class($property_class); ?>>

	<div class="property_header position-relative mb-1">

		<?php 

		if(WPBC_property_is_featured($property_id)){
			?>
			<div class="position-absolute z-index-10 w-100 h-100 gp-1">
				<span class="badge badge-success"><?php echo __('Featured','bootclean');?></span>
			</div>
			<?php
		}

		?>

		<div class="property_thumbnail loading">
			<span class="lazyload-loading"></span>
			<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_thumbnail"/]'); ?>
		</div>

	</div>

	<div class="property_meta">
		<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" args="use_small=1" part="property_taxonomy" taxonomy="property_operation"/]'); ?>
	</div>

	<div class="property_meta">
		<?php 
		echo do_shortcode('[WPBC_get_property id="'.$property_id.'" args="use_small=1" part="property_taxonomy" taxonomy="property_location"/]'); ?>
	</div>

	<h4 class="property_title"><a href="<?php the_permalink($property_id); ?>"><?php echo get_the_title($property_id); ?></a></h4>
	
	<div class="property_price">
		<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" args="use_small=1" part="property_price"/]'); ?>
	</div>

	<div class="property-excerpt small">
		<?php WPBC_excerpt(array('post'=>$property_id)); ?>
	</div>

	<?php edit_post_link( '['.__('Edit','bootclean').']', '<p class=" ">', '</p>', '', 'small' ); ?>

</article>
<!-- article #post-<?php echo $property_id; ?> END -->