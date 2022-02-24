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
		$slick_item = !empty($args['slick_item']) ? $args['slick_item'] : 'item';
		$type = !empty($args['type']) ? $args['type'] : 'inview';
		$embed = !empty($args['embed']) ? $args['embed'] : '16by9';
		$content = !empty($args['content']) ? $args['content'] : '';

		$item_styles = !empty($args['item_styles']) ? $args['item_styles'] : '';
		
		$div_attrs = 'data-lazyloader="true"';

		$item_class = !empty($args['item_class']) ? $args['item_class'] : '';

		$effect_class =  !empty($args['effect_class']) ? $args['effect_class'] : 'lazyload-blured';
		
		$effect_class = apply_filters('wpbc/filter/WPBC_build_lazyloader_image/effect', $effect_class);

		$spinner = !empty($args['spinner']) ? $args['spinner'] : false;

		$on_load = apply_filters('wpbc/filter/WPBC_build_lazyloader_image/on_load', false, $type);

			$on_load = !empty($args['on_load']) ? $args['on_load'] : $on_load;

		$img_empty = get_template_directory_uri().'/images/px-trans.png';
		$img_empty = apply_filters('wpbc/filter/WPBC_build_lazyloader_image/img_empty', $img_empty);

		global $WPBC_VERSION;  

		$inview = isset($args['inview']) ? $args['inview'] : true;

		if ( version_compare( $WPBC_VERSION, '12', '>' ) ) { 
			if( WPBC_is_inview_installed() && !empty($inview) ){ 
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

				$img_src = 'src="'. $img_low .'"';
				if(!empty($on_load)){
					$img_src = 'src="'. $img_empty .'" data-load-src="'. $img_low .'"';
				}

				?>
				<div data-type="<?php echo $type; ?>" class="<?php echo $img_holder_class; ?> " <?php echo $div_attrs; ?>>
					<img alt="<?php echo $img_alt; ?>" class="<?php echo $effect_class; ?> <?php echo $img_class; ?>" <?php echo $img_attrs; ?> data-is-inview-lazysrc="<?php echo $img_hi; ?>" <?php echo $img_src; ?>/>
				</div>
				<?php
			}

			if($type=='slick-inline'){ // slick
				$img_attrs = !empty($args['img_attrs']) ? $args['img_attrs'] : '';
				$img_alt = !empty($args['img_alt']) ? $args['img_alt'] : ' ';
				$img_class = !empty($args['img_class']) ? $args['img_class'] : 'w-100';
				$img_holder_class = !empty($args['img_holder_class']) ? $args['img_holder_class'] : 'position-relative';
				
				$img_src = 'src="'. $img_low .'"';
				if(!empty($on_load)){
					$img_src = 'src="'. $img_empty .'" data-load-src="'. $img_low .'"';
				}

				?>
				<div class="<?php echo $slick_item; ?> <?php echo $item_class; ?>" data-type="<?php echo $type; ?>">
					<div class="item-container d-flex flex-wrap align-items-center <?php echo $img_holder_class; ?>" style="<?php echo $item_styles; ?>">
						<img alt="<?php echo $img_alt; ?>" class="<?php echo $img_class; ?> <?php echo $effect_class; ?>" <?php echo $img_attrs; ?> data-lazyimage-src="<?php echo $img_hi; ?>" <?php echo $img_src; ?>/>
					</div>
					<?php echo $content; ?>
				</div>
				<?php
			} 

			// Use this when slick using Responsive Heights

			if( $type == 'slick-embed' || $type == 'slick-image-cover' ){ // slick

				$attrs = ' data-lazybackground-spinner="'.$spinner.'" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = ''; 

				$cover_attrs = 'style="background-image: url('.$img_low.');'.$item_styles.'"';
				if(!empty($on_load)){
					$cover_attrs = 'style="background-image: none;" data-load-style="background-image: url('.$img_low.');'.$item_styles.'"';
				}

				if( $effect_class == 'backdrop-blur' ){
					$item_class .= ' lazyload-backdrop-blur';
				}

				?>
				<div class="<?php echo $slick_item; ?> <?php echo $item_class; ?>" data-type="<?php echo $type; ?>">
					<div class="item-container image-cover <?php echo $effect_class; ?>" <?php echo $cover_attrs; ?> >
						<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<?php
			}

			if($type=='slick-onload'){ // slick

				$attrs = ' data-lazybackground-spinner="'.$spinner.'" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = '';
				?>
				<div class="<?php echo $slick_item; ?> <?php echo $item_class; ?>" data-type="<?php echo $type; ?>">
					<div class="item-container image-cover <?php echo $effect_class; ?>" style="background-image: none;" data-load-style="background-image: url(<?php echo $img_low; ?>);<?php echo $item_styles; ?>">
						<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<?php
			}


			// is-inview
			if($type=='inview' || $type=='inview-onload' || $type=='lazybackground' || $type=='lazybackground_start'){ 

				$attrs = ' data-lazybackground-spinner="'.$spinner.'" ';
				$attrs .= ' data-lazybackground-target="parent" ';
				$attrs .= ' data-lazybackground="simple" ';
				$attrs .= ' data-is-inview-lazybackground="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;" ';
				$box_attrs = '';

				if($type=='inview-onload' || !empty($on_load)){
					$embed_attrs = ' data-load-style="background-image: url('.$img_low.');" style="background-image: none;" ';
				}else{
					$embed_attrs = ' style="background-image: url('.$img_low.');" ';
				}

				if( $type!='lazybackground' ){
					$class = 'embed-responsive embed-responsive-'.$embed;
					$holder_class = 'embed-responsive-item';
				}

				if( $type=='lazybackground' ){
					$class = !empty($args['class']) ? $args['class'] : 'w-100';
					$holder_class = !empty($args['holder_class']) ? $args['holder_class'] : 'position-relative';
				}
				?>
<div data-type="<?php echo $type; ?>" class="<?php echo $class; ?>" <?php echo $div_attrs; ?>>
	<div class="<?php echo $holder_class; ?> image-cover <?php echo $effect_class; ?>" <?php echo $embed_attrs; ?>>
		<div class="w-100 h-100 image-cover " <?php echo $attrs; ?>>
			
			<?php if($type!='lazybackground_start') { ?>
				<?php echo $content; ?>
				
		</div>
	</div>
</div>
<?php } ?>
			<?php
			}

			// slick
			
			if( $type=='slick-inview'  || $type == 'slick-image-responsive-embed' ){ 

				$attrs = ' data-lazybackground-spinner="'.$spinner.'" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$img_hi.'" ';
				$attrs .= ' style="background-image: none;"';
				$box_attrs = '';
				?>
	<?php if( $type == 'slick-image-responsive-embed' ){ ?>
		<div class="<?php echo $slick_item; ?> <?php echo $item_class; ?>" data-type="<?php echo $type; ?>">
	<?php } ?>
	<div class="embed-responsive embed-responsive-<?php echo $embed; ?>" style="<?php echo $item_styles; ?>">
		<div class="embed-responsive-item image-cover <?php echo $effect_class; ?>" style="background-image: none;" data-load-style="background-image: url(<?php echo $img_low; ?>);">
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