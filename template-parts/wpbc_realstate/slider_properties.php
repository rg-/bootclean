<?php 
$query_string = wp_parse_args( $query_string, array() );
$query_string['post_type'] = 'property';

$query_string['meta_key'] = 'wpbc_realstate_featured_post';
$query_string['meta_value'] = 1;
// WPBC_property_is_featured?? 
?>

<?php
	

	// Needs .item-container

	// "md":{"default":"480px","min":"375px","max":"480px"}
	$slider_breakpoint = '{
		"xs":{"default":"320px","min":"320px","max":"320px"},
		"sm":{"default":"375px","min":"375px","max":"640px"},
		"md":{"default":"100%","max":"640px"}
	}';  

	// data-breakpoint-height-offset="#your-offset-element" 

?>
<div data-slick='{"fade":true, "dots": false, "arrows": false, "useTransform": true, "useCss": true}' class=" " data-breakpoint-height='<?php echo $slider_breakpoint; ?>' >
<?php 
$query = $query_string;
$query_post = new WP_Query( $query ); 
while( $query_post->have_posts() ){ 
	$query_post->the_post(); 
	$property_id = get_the_ID();
	$featured_thumb_url = get_the_post_thumbnail_url($property_id, 'medium'); 
	$featured_img_url = get_the_post_thumbnail_url($property_id,'full');
	?>
	<div class="item">
		<div class="loading">
			<span class="lazyload-loading"></span>
			<div class="item-container image-cover" data-lazyload-src="<?php echo $featured_img_url;?>" style="background-image: url(<?php echo $featured_thumb_url;?>); ">

				<div class="item-cover-content d-flex justify-content-start align-items-end h-100">

					<div class="bgo-50-dark w-100" data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOutDown" data-animation-duration=".1s">

						<div class="container">
							
							<div class="row">
							
								<div class="p-0 text-white col-md-8">

									<div class="row">
										<h4 class="m-0 bg-dark gp-1 d-inline-block h5"><?php the_title(); ?></h4>
										<span class="property_price gp-1">
											<?php echo do_shortcode('[WPBC_get_property id="'.$property_id.'" args="use_small=1" part="property_price"/]'); ?>
										</span>
									</div>
									
									<?php

									$args = array( 
										'length'          => 20,
										'class'		=> 'entry-summary gpy-1 gpr-6', 
										'excerpt_before'	=> '<span class="entry-excerpt">',
										'excerpt_after'	=> '</span>',
										'readmore'        => true,
										'readmore_show_title' => false,
										'readmore_text'   => esc_html__( 'Read more', 'bootclean' ),
										'readmore_before'	=> '&hellip; <span class="entry-more">',
										'readmore_after'  => '</span>',
										'readmore_class'  => 'more-link'
									); 

									WPBC_excerpt($args); ?> 

								</div>

								<div class="col-md-4">
									<p class="m-0 gp-2 d-flex h-100 align-items-end flex-row justify-content-end">
										<!--<a href="#" class="btn btn-outline-light" data-slick-nav="prev"><?php _e('Previous'); ?></a>-->
										<a href="#" class="btn btn-light" data-slick-nav="next"><?php _e('Next'); ?></a>
									</p>
								</div>
							
							</div>

						</div>

					</div>

				</div>

			</div>
		</div>
	</div>
	<?php // echo do_shortcode('[WPBC_get_property part="property_thumbnail" id="'.get_the_ID().'"]'); ?>
	<?php
}
wp_reset_postdata();
?>
</div>