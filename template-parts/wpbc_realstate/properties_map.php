<div id="<?php echo $shortcode_args['target_id']; ?>-map" class="acf-map embed-responsive embed-responsive-16by9">
	<?php
	while ( $query_posts->have_posts() ) { 
		
		$query_posts->the_post();  
		
		$property_id = get_the_ID();
 
		$inc_map = WPBC_include_template_part('wpbc_realstate/post_property_map_marker'); 
		if(!empty($inc_map)){  
			include ($inc_map);  
		}
		$location = WPBC_get_field('property_location_map', $property_id);
		?>
		
			<?php if(!empty($location)){ ?>
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
					<h3><?php echo get_the_title(); ?></h3>
					<h4><?php echo $location['address']; ?></h4>
				</div>
			<?php } ?>
		
		<?php
	}
?>
</div>