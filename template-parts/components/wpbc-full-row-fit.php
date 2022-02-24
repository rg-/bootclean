<?php

	
	// $args passed  
	// _print_code($args);

	$background_side = ($args['content_side']=='left') ? 'right' : 'left';
	$content = $args['content'];
	$overlap_content = $args['overlap_content']; 
	
?>

<div data-component="wpbc-full-row-fit" data-component-type="<?php echo $args['type']; ?>" data-component-content-side="<?php echo $args['content_side']; ?>" class="position-relative <?php echo $args['class']; ?>" <?php echo $args['attrs']; ?>>

	<div class="container position-relative z-index-10">

		<div class="row">

			<div class="<?php echo $overlap_content['class']; ?>" <?php echo $overlap_content['attrs']; ?>>

				<?php echo $overlap_content['before']; ?>

				<div class="position-<?php echo $args['breakpoint']; ?>-absolute-full">

					<div class="h-100" data-overlap-breakpoint="<?php echo $args['breakpoint']; ?>" data-overlap="margin-<?php echo $background_side; ?>" data-overlap-multiply="-1">
						<div class="h-100 <?php echo $overlap_content['overlap_class']; ?>" <?php echo $overlap_content['overlap_attrs']; ?>>
							
							<div class="embed-responsive embed-responsive-down-<?php echo $args['breakpoint']; ?>-16by9 h-<?php echo $args['breakpoint']; ?>-100">

								<div class="embed-responsive-item h-<?php echo $args['breakpoint']; ?>-100">
									<?php 
										WPBC_get_template_part('builder/parts/ui_layout_commons/section-background', array(
											'images' => $overlap_content['overlap_images'],
											'slick_class' => 'slick-embed-responsive',
											'slick_args' => $overlap_content['overlay_slick_args'],
											'lazyloader' => array(
												// 'embed' => $embed_responsive,
												'type' => 'slick-image-cover',
											)
										)); 
									?>
								</div>

							</div>

						</div>
					</div>

				</div>

				<?php echo $overlap_content['after']; ?>

			</div>

			<div class="<?php echo $content['class']; ?>" <?php echo $content['attrs']; ?>>

				<?php echo $content['before']; ?>

				<div class="position-relative z-index-10">
					<?php if(!empty($content['headline'])) { ?>
						<div class="<?php echo $content['headline_class']; ?>" <?php echo $content['headline_attrs']; ?>>
							<h2 class="<?php echo $content['headline_title_class']; ?>"><?php echo $content['headline']; ?></h2>
						</div>
					<?php } ?>

					<div class="<?php echo $content['wysiwyg_class']; ?>" <?php echo $content['wysiwyg_attrs']; ?>>
						<?php echo apply_filters('the_content', $content['wysiwyg']); ?>
					</div>
				</div>

				<div class="position-absolute-full z-index-0" <?php echo $content['overlap_holder_attrs']; ?>>
					<div class="h-100" data-overlap-breakpoint="<?php echo $args['breakpoint']; ?>" data-overlap="margin-<?php echo $args['content_side']; ?>" data-overlap-multiply="-1">
						<div class="h-100 <?php echo $content['overlap_class']; ?>" <?php echo $content['overlap_attrs']; ?>></div>
					</div>
				</div>

				<?php echo $content['after']; ?>

			</div>			

		</div>

	</div>

</div>