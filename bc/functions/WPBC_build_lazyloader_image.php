<?php
if(!function_exists('WPBC_build_lazyloader_image')){
	function WPBC_build_lazyloader_image($args=array()){ 

		// $attachment_id=null, $type=null, $embed='16by9', $size='full'
		$type = !empty($args['type']) ? $args['type'] : 'inview';
		$embed = !empty($args['embed']) ? $args['embed'] : '16by9';
		$content = !empty($args['content']) ? $args['content'] : '';
		
		if(!empty($args['img_hi']) && !empty($args['img_low']) ){

			$img_hi = $args['img_hi'];
			$img_low = $args['img_low']; 
			
			if($type=='slick-embed'){ 

				$attrs = ' data-lazybackground-spinner="false" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = '';
				?>
				<div class="item">
					<div class="item-container image-cover lazyload-blured" style="background-image: url(<?php echo $img_low; ?>);" >
						<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<?php
			}

			if($type=='slick-onload'){ 

				$attrs = ' data-lazybackground-spinner="false" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = '';
				?>
				<div class="item">
					<div class="item-container image-cover lazyload-blured" style="background-image: url(none);" data-onload-style="background-image: url(<?php echo $img_low; ?>);">
						<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<?php
			}

			if($type=='inview'){

				$attrs = ' data-lazybackground-spinner="false" data-lazybackground-target="parent" data-lazybackground="simple" data-is-inview-lazybackground="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = '';
				?>
	<div class="embed-responsive embed-responsive-<?php echo $embed; ?>">
		<div class="embed-responsive-item image-cover lazyload-blured" style="background-image: url(<?php echo $img_low; ?>);">
			<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
				<?php echo $content; ?>
			</div>
		</div>
	</div>
			<?php
			}
			

		}
	}
}