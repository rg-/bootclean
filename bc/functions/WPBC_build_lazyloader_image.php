<?php

/*

	TODO

	- make it echo/return from $argss['echo'] = true by default
	- filter parameters
	- filter use or not blured effect
	- compact names

*/


if(!function_exists('WPBC_build_lazyloader_image')){
	function WPBC_build_lazyloader_image($args=array()){ 

		// $attachment_id=null, $type=null, $embed='16by9', $size='full'
		$type = !empty($args['type']) ? $args['type'] : 'inview';
		$embed = !empty($args['embed']) ? $args['embed'] : '16by9';
		$content = !empty($args['content']) ? $args['content'] : '';

		$item_styles = !empty($args['item_styles']) ? $args['item_styles'] : '';
		
		$div_attrs = 'data-lazyloader="true"';

		
		global $WPBC_VERSION;  
		if ( version_compare( $WPBC_VERSION, '12', '>' ) ) { 
			if( WPBC_is_inview_installed() ){ 
				$div_attrs .= ' data-is-inview="detect"';
			}
		}

		if(!empty($args['img_hi']) && !empty($args['img_low']) ){

			$img_hi = $args['img_hi'];
			$img_low = $args['img_low']; 
			

			if($type=='lazysrc' || $type=='inview-lazysrc'){ // is-inview
				$img_attrs = !empty($args['img_attrs']) ? $args['img_attrs'] : '';
				$img_alt = !empty($args['img_alt']) ? $args['img_alt'] : ' ';
				$img_class = !empty($args['img_class']) ? $args['img_class'] : 'w-100';
				$img_holder_class = !empty($args['img_holder_class']) ? $args['img_holder_class'] : 'position-relative';
				?>
				<div data-type="<?php echo $type; ?>" class="<?php echo $img_holder_class; ?> " <?php echo $div_attrs; ?>>
					<img alt="<?php echo $img_alt; ?>" class="lazyload-blured <?php echo $img_class; ?>" <?php echo $img_attrs; ?> data-is-inview-lazysrc='<?php echo $img_hi; ?>' src='<?php echo $img_low; ?>'/>
				</div>
				<?php
			}

			if($type=='slick-inline'){ // slick
				$img_attrs = !empty($args['img_attrs']) ? $args['img_attrs'] : '';
				$img_alt = !empty($args['img_alt']) ? $args['img_alt'] : ' ';
				$img_class = !empty($args['img_class']) ? $args['img_class'] : 'w-100';
				$img_holder_class = !empty($args['img_holder_class']) ? $args['img_holder_class'] : 'position-relative';
				?>
				<div class="item" data-type="<?php echo $type; ?>">
					<div class="item-container d-flex flex-wrap align-items-center <?php echo $img_holder_class; ?>" style="<?php echo $item_styles; ?>">
						<img alt="<?php echo $img_alt; ?>" class="<?php echo $img_class; ?> lazyload-blured" <?php echo $img_attrs; ?> data-lazyimage-src='<?php echo $img_hi; ?>' src='<?php echo $img_low; ?>'/>
					</div>
				</div>
				<?php
			}

			// Use this when slick using Responsive Heights

			if( $type == 'slick-embed' || $type == 'slick-image-cover' ){ // slick

				$attrs = ' data-lazybackground-spinner="false" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = ''; 
				?>
				<div class="item" data-type="<?php echo $type; ?>">
					<div class="item-container image-cover lazyload-blured" style="background-image: url(<?php echo $img_low; ?>);<?php echo $item_styles; ?>" >
						<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<?php
			}

			if($type=='slick-onload'){ // slick

				$attrs = ' data-lazybackground-spinner="false" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = '';
				?>
				<div class="item" data-type="<?php echo $type; ?>">
					<div class="item-container image-cover lazyload-blured" style="background-image: none;" data-load-style="background-image: url(<?php echo $img_low; ?>);<?php echo $item_styles; ?>">
						<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<?php
			}


			// is-inview
			if($type=='inview' || $type=='inview-onload'){ 

				$attrs = ' data-lazybackground-spinner="false" ';
				$attrs .= ' data-lazybackground-target="parent" ';
				$attrs .= ' data-lazybackground="simple" ';
				$attrs .= ' data-is-inview-lazybackground="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;" ';
				$box_attrs = '';

				if($type=='inview-onload'){
					$embed_attrs = ' data-load-style="background-image: url('.$img_low.');" style="background-image: none;" ';
				}else{
					$embed_attrs = ' style="background-image: url('.$img_low.');" ';
				}
				?>
<div data-type="<?php echo $type; ?>" class="embed-responsive embed-responsive-<?php echo $embed; ?>" <?php echo $div_attrs; ?>>
	<div class="embed-responsive-item image-cover lazyload-blured" <?php echo $embed_attrs; ?>>
		<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
			<?php echo $content; ?>
		</div>
	</div>
</div>
			<?php
			}

			// slick
			
			if( $type=='slick-inview'  || $type == 'slick-image-responsive-embed' ){ 

				$attrs = ' data-lazybackground-spinner="false" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = '';
				?>
	<?php if( $type == 'slick-image-responsive-embed' ){ ?>
		<div class="item" data-type="<?php echo $type; ?>">
	<?php } ?>
	<div class="embed-responsive embed-responsive-<?php echo $embed; ?>" style="<?php echo $item_styles; ?>">
		<div class="embed-responsive-item image-cover lazyload-blured" style="background-image: none;" data-load-style="background-image: url(<?php echo $img_low; ?>);">
			<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
				<?php echo $content; ?>
			</div>
		</div>
	</div>
	<?php if( $type == 'slick-image-responsive-embed' ){ ?>
		</div>
	<?php } ?>
			<?php
			}
			

		}
	}
}