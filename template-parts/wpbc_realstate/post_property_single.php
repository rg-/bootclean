<?php

$property_class = apply_filters('wpbc/filter/property/single/class',''); 
$property_id = !empty($property->ID) ? $property->ID : get_the_ID(); 

?>
<article id="property-<?php echo $property_id; ?>" <?php post_class($property_class); ?>>
	
	<div class="row">

		<div class="col-md-8">
			<!--
			<div class="property_thumbnail gmb-2">
			<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_thumbnail"/]'); ?>
			</div>
			-->
			<div class="property_gallery gmb-2">
				<h5 class="property_label"><?php echo __('Slide Gallery','bootclean');?></h5>
				<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_gallery"/]'); ?>
			</div>

			<div class="property_content gmb-2">
				<h5 class="property_label"><?php echo __('Details','bootclean');?></h5>
				<?php 
				$content = get_post_field('post_content', $property_id);
				$content = apply_filters('the_content', $content);
				echo $content; ?>
			</div>

			<div class="property_location_map gmb-2">
				<h5 class="property_label"><?php echo __('Location Map','bootclean');?></h5>
				<?php
				$map_type = WPBC_default_property_location_map_type();
				$map_template = 'property_location_'.$map_type;
				echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="'.$map_template.'"/]'); ?>
			</div>
			
		</div>

		<div class="col-md-4">

			<div class="property_title_header gmb-2">
				<h2 class="section-title property_title h1"><?php echo get_the_title($property_id); ?></h2>
			</div>

			<div class="property_meta gmy-1">
				<h5 class="property_label"><?php echo __('Operation','bootclean');?></h5>
				<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_taxonomy" taxonomy="property_operation"/]'); ?>
			</div>

			<div class="property_price gmb-2">
				<?php 

				/*
				
				'property_u_temporary_prices' hidden true_false input
				if true, use temporary_prices template
				if not, single one.

				See WPBC_default_property_pricing_fields();

				*/
				$temporary_prices = WPBC_get_field('property_u_temporary_prices', $property_id); 
				
					?>
					<h5 class="property_label"><?php echo __('Price','bootclean');?></h5>
					<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_price"/]'); ?>
					<?php
				if(!empty($temporary_prices)){
					?>
					<h5 class="property_label gmt-2"><?php  
				$atts = array(
					'alt' => 'Reset',
					'color' => '#999',
					'width' => '24',
					'height' => '24', 
					'class' => 'mb-1 mr-1', 
				); 
				$icon = WPBC_get_svg_img('md-pricetags', $atts); 
				echo $icon; 
				?><?php echo __('Temporary Prices','bootclean');?></h5>
					<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_temporary_prices"/]'); ?>
					<?php
				}
				?>
			</div>

			<div class="property_meta">
				<h5 class="property_label"><?php  
				$atts = array(
					'alt' => 'Reset',
					'color' => '#999',
					'width' => '24',
					'height' => '24', 
					'class' => 'mb-1 mr-1', 
				); 
				$icon = WPBC_get_svg_img('md-globe', $atts); 
				echo $icon; 
				?><?php echo __('Location','bootclean');?></h5>
				<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_taxonomy" args="include_parents=1&include_current=0&last_current=1" taxonomy="property_location"/]'); ?>
			</div>

			<div class="property_meta gmy-1">
				<h5 class="property_label"><?php echo __('Type','bootclean');?></h5>
				<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_taxonomy" taxonomy="property_type"/]'); ?>
			</div>

			<div class="property_meta gmb-2">
				<h5 class="property_label"><?php echo __('Features','bootclean');?></h5>
				<?php 
				 echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_features"/]'); ?>
			</div>
			
			<div class="property_meta gmy-1">
				<h5 class="property_label"><?php echo __('Services','bootclean');?></h5>
				<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_taxonomy" taxonomy="property_services"/]'); ?>
			</div>

			<div class="property_meta gmy-1">
				<h5 class="property_label"><?php echo __('Aditionals','bootclean');?></h5>
				<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" part="property_taxonomy" taxonomy="property_aditionals"/]'); ?>
			</div>

		</div>

	</div>

</article>
<!-- article #post-<?php the_ID(); ?> END -->

<div class="row">
	<div class="col-12">
		<h2 class="section-title"><?php echo __('Related Properties','bootclean');?></h2>
	</div>
	<div class="col-12">
		<?php echo  do_shortcode("[WPBC_get_query_properties query_string='posts_per_page=3&orderby=rand&hide_nav=1'/]");?>
	</div>
</div>