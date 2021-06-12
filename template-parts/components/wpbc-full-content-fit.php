<?php 

/*
 *
 * wpbc_full_content_fit
 * ui_layout_full_content_fit
 *
*/

$args = apply_filters('wpbc/filter/wpbc-full-content-fit/args',$args);

$layout_id = !empty($args['layout_id']) ? $args['layout_id'] : 'wpbc-full-content-fit-'.uniqid();
$breakpoint = !empty($args['breakpoint']) ? $args['breakpoint'] : 'lg';
$layout_class = !empty($args['layout_class']) ? $args['layout_class'] : '';

if(!empty($args['cols'])){ 
	$cols = $args['cols'];
	$count = 0;
?>
<div data-component="wpbc-full-content-fit" class="position-relative <?php echo $layout_class; ?>">

	<div class="container position-relative z-index-10">

		<div class="row">

			<?php foreach ($cols as $columns) { 

					$defaults = array(

						'col_type' => 'default',  // default, title-up, content-up, content-overlap, image-overlap
						'col_side' => '', // left, right, center
						'col_size' => '6',
						'col_order' => '1',
						'col_order_breakpoint' => '1', 
						'col_class' => 'p-0', 

						'content' => array(
							'content_class' => '', 
							'content_attrs' => '', 
							'content_background_class' => '', 
							'content_background_attrs' => '', 
							'title' => '',
							'wysiwyg' => '',
							'content_before' => '',
							'content_after' => '',
						),
						'overlap_content' => array(
							'overlap_embed' => '16by9',
							'overlap_class' => '', 
							'overlap_attrs' => '',
							'overlap_images' => array(),
							'overlay_slick_args' => array(),
							'overlap_before' => '',
							'overlap_after' => '',
						),

					);
					$col = shortcode_atts($defaults, $columns); 

					$count ++;
					$col_id = $layout_id . '_col_' . $count . ''; 

					$col_type = $col['col_type'];
					$col_side = $col['col_side'];

					$col = apply_filters('wpbc/filter/wpbc-full-content-fit/col/args', $col, $breakpoint, $col_type, $col_side, $layout_id);
 
					$col_order = $col['col_order'];
					$col_order_breakpoint = $col['col_order_breakpoint'];
					$col_size = $col['col_size'];
					$col_class = $col['col_class']; 

					$content = $col['content'];
						$content_class = $content['content_class'];
						$content_attrs = $content['content_attrs'];
						$content_background_class = $content['content_background_class'];
						$content_background_attrs = $content['content_background_attrs'];
						$title = $content['title'];
						$wysiwyg = $content['wysiwyg'];
						$content_before = $content['content_before'];  
						$content_after = $content['content_after'];  

					$overlap_content = $col['overlap_content'];
						$overlap_embed = $overlap_content['overlap_embed'];
						$overlap_class = $overlap_content['overlap_class'];
						$overlap_attrs = $overlap_content['overlap_attrs'];
						$overlap_images = $overlap_content['overlap_images'];
						$overlay_slick_args = $overlap_content['overlay_slick_args'];  
						$overlap_before = $overlap_content['overlap_before'];  
						$overlap_after = $overlap_content['overlap_after'];  

					$class = 'col-'.$breakpoint.'-'.$col_size.' ';
					$class .= 'order-'.$col_order.' ';
					$class .= 'order-'.$breakpoint.'-'.$col_order_breakpoint.' ';
					$class .= $col_class.' '; 
					$class .= 'position-relative ';


					$full_order = 'order-1';
					$content_order = 'order-2';

					if($col_type == 'content-up') { 
						$full_order = 'order-2';
						$content_order = 'order-1';
					}

					?>
<div id="<?php echo $col_id; ?>" class="<?php echo $class; ?>">

	<div class="d-flex flex-column d-<?php echo $breakpoint; ?>-block position-relative h-100">

		<?php if($col_type == 'title-up') { ?>
			<div class="d-<?php echo $breakpoint; ?>-none order-0">
				<div id="<?php echo $col_id; ?>_cloned_title" class="<?php echo $content_class; ?> z-index-10 position-relative" <?php echo $content_attrs; ?>>

				</div>
				<?php 
					$content_overlap_attrs = ''; 
					$content_overlap_attrs .= 'data-overlap-breakpoint-down="'.$breakpoint.'" ';
					$content_overlap_attrs .= 'data-overlap="margin-'.$col_side.'" ';
					$content_overlap_attrs .= 'data-overlap-multiply="-1" ';   
				?>
				<div class="position-absolute-full d-<?php echo $breakpoint; ?>-none z-index-0">
					<div class="h-100 <?php echo $content_background_class; ?>" <?php echo $content_overlap_attrs; ?> >
						<div class="h-100" <?php echo $content_background_attrs; ?>></div>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php

			$full_class = 'position-'.$breakpoint.'-absolute-full ';
			if( $col_type == 'image-overlap' || $col_type == 'content-overlap' ) { 
				$full_class = 'position-absolute-full ';
			}
			
		?>
		<div class="<?php echo $full_class; ?> <?php echo $full_order; ?> z-index-0">

			<!-- overlap -->
			<?php  
				$full_overlap_attrs = ''; 
				if( $col_side == 'center' ){
						$full_overlap_attrs .= 'data-overlap-breakpoint-down="'.$breakpoint.'" ';
						$full_overlap_attrs .= 'data-overlap="margin-left" ';
					}else{
						$full_overlap_attrs .= 'data-overlap-breakpoint="'.$breakpoint.'" ';
						$full_overlap_attrs .= 'data-overlap="margin-'.$col_side.'" ';
					} 
				
				$full_overlap_attrs .= 'data-overlap-multiply="-1" '; 

				$full_overlap_attrs .= ' '.$overlap_attrs.' ';

				$overlap_classes = 'h-'.$breakpoint.'-100 ' . $overlap_class;
				if($col_type == 'image-overlap' || $col_type == 'content-overlap' ) { 
					$overlap_classes = 'h-100 ' . $overlap_class;
				}
			?>
			<div class="<?php echo $overlap_classes; ?>" <?php echo $full_overlap_attrs; ?> >

				<?php echo $overlap_before; ?>

				<div class="h-100" <?php echo $content_background_attrs; ?>>

				<?php if(!empty($overlap_images)){ ?>

				<?php
					$embed_class = 'embed-responsive embed-responsive-down-'.$breakpoint.'-'.$overlap_embed.' h-'.$breakpoint.'-100';
					$embed_item_class = 'h-'.$breakpoint.'-100 w-100 embed-responsive-item';
					if($col_type == 'image-overlap' || $col_type == 'content-overlap' ) { 
						$embed_class = 'h-100 w-100';
						$embed_item_class = 'h-100 w-100';
					}
				?>
				<div class="<?php echo $embed_class; ?>">
					<div class="<?php echo $embed_item_class; ?>">
						<?php 
							WPBC_get_template_part('builder/parts/ui_layout_commons/section-background', array(
								'images' => $overlap_images,
								'slick_class' => 'slick-embed-responsive',
								'slick_args' => $overlay_slick_args,
								'lazyloader' => array(
									// 'embed' => $embed_responsive,
									'type' => 'slick-image-cover',
								)
							)); 
						?>
					</div>
				</div>

				<?php } ?>

				</div>

				<?php echo $overlap_after; ?>

			</div>

		</div> 

		<div class="z-index-10 position-relative <?php echo $content_order; ?> h-100">

			<?php 
				$content_overlap_attrs = ''; 
				$content_overlap_attrs .= 'data-overlap-breakpoint-down="'.$breakpoint.'" ';
				$content_overlap_attrs .= 'data-overlap="margin-'.$col_side.'" ';
				$content_overlap_attrs .= 'data-overlap-multiply="-1" ';

				if($col_type == 'content-overlap' || $col_type == 'content-overlap') {
					$content_absolute_background_class = 'd-none';
				}else{
					$content_absolute_background_class = 'd-'.$breakpoint.'-none';
				}
			?>
			<div class="position-absolute-full <?php echo $content_absolute_background_class; ?> z-index-0">
				<div class="h-100 <?php echo $content_background_class; ?>" <?php echo $content_overlap_attrs; ?> >
					<div class="h-100" <?php echo $content_background_attrs; ?>></div>
				</div>
			</div>
			
			<div class="wpbc-full-content-fit--content z-index-10 position-relative h-100 <?php echo $content_class; ?>" <?php echo $content_attrs; ?>>

				<?php echo $content_before; ?>

				<?php if($col_type == 'title-up') { ?>
					<div data-clone="#<?php echo $col_id; ?>_cloned_title" class="d-none d-<?php echo $breakpoint; ?>-block">
						<?php echo $title; ?>
					</div>
				<?php } else { ?>
					<?php echo $title; ?>
				<?php } ?>
				
				<?php echo apply_filters('the_content', $wysiwyg); ?>

				<?php echo $content_after; ?>

			</div>

		</div>

	</div>

</div>
<?php } ?>

		</div>

	</div>

</div>
<?php } ?>