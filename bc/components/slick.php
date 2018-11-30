<?php
	
	$_slider_uid = uniqid();
	
	$slick_attrs = isset($params['slick']) ? $params['slick'] : '{ }'; 
	
	$slider_ID = !empty($params['id']) ? $params['id'] : 'wp-slick-slider-'.$_slider_uid;  
	
	$slick_data = '';
	if( !empty( $params['breakpoint-height'] ) ){
		$bk = $params['breakpoint-height'];
		$data = json_encode($bk);
		$slick_data = "data-breakpoint-height='".$data."'";
	}else{
		$def = '{ "defaults":{"default":"100%"} }';
		$data = json_encode($def);
		$slick_data = "data-breakpoint-height='".$def."'";
	}
	
	if( !empty( $params['enable-at'] ) ){
		$enable_def = $params['enable-at'];
		$slick_data .= " data-enable-at='".$enable_def."'";
	}else{
		//$enable_def = '{ "md":1 }';
		//$slick_data .= " data-enable-at='".$enable_def."'";
	}
	
	
	$slick_wrapper =  isset($params['wrapper']) ? $params['wrapper'] : true;
	
	/*
		afterChange : slick, currentSlide
		beforeChange : slick, currentSlide, nextSlide
		breakpoint : event, slick, breakpoint
		destroy : event, slick
		edge : slick, direction
		init : slick
		reInit : slick
		setPosition : slick
		swipe: slick, direction
		lazyLoaded : event, slick, image, imageSource
		lazyLoadError : event, slick, image, imageSource
	*/
	$callbacks_args = array(
		'afterChange', 'beforeChange', 'breakpoint', 'destroy', 'edge', 'init', 'reInit', 'setPosition', 'swipe', 'lazyLoaded', 'lazyLoadError'
	);
	$slick_data_callbacks = ''; 
	if( isset($params['callbacks']) ){
		foreach($callbacks_args as $callback){
			$slick_data_callbacks .= isset($params['callbacks'][$callback]) ? 'data-callback-'.$callback.'="'.$params['callbacks'][$callback].'"' : '';
		} 
		
	}

	$slick_item_class = 'item';
	$use_lazyload = false;

	if( !empty( $params['lazyload'] ) ){
		$use_lazyload = true; 
	}
	
?>
<?php if($slick_wrapper){?><div class="<?php echo isset($params['container_class']) ? 'slick-slider-container '.$params['container_class'] : 'slick-slider-container container';?>"><?php } ?>
	<div id="<?php echo $slider_ID; ?>" class="theme-slick-slider" data-slick='<?php echo $slick_attrs; ?>' <?php echo $slick_data; ?> <?php echo $slick_data_callbacks; ?>>
		<?php
		if(isset($params['items'])){
		
			$items = $params['items']; 
			
			foreach( $items as $k=>$v ){  
			
			?>
				
				<?php do_action('wpbc/slick/item/before', $v, $params); ?>
				
				<?php if(isset($v['background-image'])){ ?>
					<div class="<?php echo $slick_item_class; ?>">
						<div class="<?php echo isset($params['container_item_class']) ? 'item-container image-cover '.$params['container_item_class'] : 'item-container image-cover';?>" style="background-image:url(<?php echo $v['background-image']; ?>);">
							<?php if(isset($v['content'])){ ?>
								<div class="item-cover-content <?php 
									$content_class = isset($v['content_wrap_class']) ? $v['content_wrap_class'] : ( isset($params['container_item_content_wrap_class']) ? $params['container_item_content_wrap_class'] : ' d-flex' );
								?>">
									<div class="<?php
									$content_class = isset($v['content_class']) ? $v['content_class'] : ( isset($params['container_item_content_class']) ? $params['container_item_content_class'] : '' );
									echo $content_class; ?>">
										<?php echo $v['content']; ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } else if( isset($v['background-color']) || isset($v['background-scheme']) ){ ?>
					<div class="<?php echo $slick_item_class; ?>">
						<div class="<?php echo isset($params['container_item_class']) ? 'item-container color-cover '.$params['container_item_class'] : 'item-container color-cover';?><?php if(isset($v['background-scheme'])){ echo ' bg-'.$v['background-scheme']; } ?>" <?php if(isset($v['background-color'])){ ?>style="background-color:<?php echo $v['background-color']; ?>;"<?php } ?>>
							<?php if(isset($v['content'])){ ?>
								<div class="item-cover-content <?php 
									$content_class = isset($v['content_wrap_class']) ? $v['content_wrap_class'] : ( isset($params['container_item_content_wrap_class']) ? $params['container_item_content_wrap_class'] : ' d-flex' );
								?>">
									<div class="<?php
									$content_class = isset($v['content_class']) ? $v['content_class'] : ( isset($params['container_item_content_class']) ? $params['container_item_content_class'] : '' );
									echo $content_class; ?>">
										<?php echo $v['content']; ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } else {
					
					/*
						@params passed for each item ($v) over $items
					*/
					$type = ( !empty($v['type']) && !is_array($v['type']) ) ? $v['type'] : 'inline'; 
					 
					$content = $v['content']; 
					$image_object = !empty($v['image_object']) ? $v['image_object'] : ''; 
					$content_class = !empty($v['content_class']) ? $v['content_class'] : ( !empty($params['container_item_class']) ? $params['container_item_class'] : '' ); 
					
					$content_type = 'item-just-content';
					$item_class = '';
					$attrs = '';
					
					if($type == 'inline'){ 
						$content_type = 'item-image-content'; 
					}
					
					if($type == 'cover' && !empty($image_object) ){ 
						$content_type = 'item-cover-content';
						$item_class = 'image-cover';						
						$attrs = 'style="background-image:url('. $image_object['url'] .');" ';

						if($use_lazyload){
							$slick_item_class .= ' loading'; 
							$img_id = $image_object['id'];
							$img_low = wp_get_attachment_image_src($img_id, 'medium');
							$attrs = 'data-lazyload-src="'.$image_object['url'].'" style="background-image:url('. $img_low[0] .');" ';
						}
					} 
					if( !empty($content) || !empty($image_object)) {
					?><div class="<?php echo $slick_item_class; ?>">
						<?php if($use_lazyload){ ?>
							<span class="lazyload-loading"></span>
						<?php } ?>
						<div class="item-container <?php echo $item_class; ?>" <?php echo $attrs; ?>>

						<?php do_action('wpbc/slick/item/container/before', $v, $params); ?>
						
						<?php if( $type == 'inline' && !empty($image_object) ) { ?>
							<?php do_action('wpbc/slick/item/container/content/before', $v, $params); ?>
							<img src="<?php echo $image_object['url']; ?>" class="item-image full-w" alt="<?php echo $image_object['title']; ?>"/>
							<?php do_action('wpbc/slick/item/container/content/after', $v, $params); ?>
						<?php } ?>
						
						<?php if( !empty($content) ) { ?>
						<div class="<?php echo $content_type; ?> <?php echo $content_class; ?>">
							<?php do_action('wpbc/slick/item/container/content/before', $v, $params); ?>
							<?php echo $content; ?>
							<?php do_action('wpbc/slick/item/container/content/after', $v, $params); ?>
						</div>
						<?php } ?>

						<?php do_action('wpbc/slick/item/container/after', $v, $params); ?>

					</div></div><?php } ?>
					
				<?php } ?>
			
			<?php do_action('wpbc/slick/item/after', $v, $params); ?>
			<!-- item END --><?php }
			} // if "items" end
			
			if(isset($params['items_html'])){
				echo $params['items_html'];
			}

		?>	
	</div><!-- theme-slick-slider END -->
<?php if($slick_wrapper){?></div><!-- slick-slider-container END --><?php } ?>
<?php
/*
	
	
	
	See this for animations https://jsfiddle.net/solodev/qszmrx2n/
	
	
		$params passed.. 
	
		$params['id']
		$params['container_class']
		$params['container_item_class'] // Classes will be appended, TODO choose to overide or preppend, etc
		
		
		CSS/HTML Structure:
		
		.theme-slick-slider
			.item
				.item-container
					.item-image
					
		Slide data-slick parameters example:
		
		<div class="your-slide" data-slick='{
					"dots":false,
					"slide":".slide-item",
					"slidesToShow":4,
					"slidesToScroll": 1,
					"adaptiveHeight": true,
					"focusOnSelect": false,
					"accessibility": false,
					"responsive": [
							{
							  "breakpoint": 1200,
							  "settings": { 
								"slidesToShow": 3,
								"slidesToScroll": 1
							  }
							},
							{
							  "breakpoint": 992,
							  "settings": { 
								"slidesToShow": 3,
								"slidesToScroll": 1
							  }
							},
							{
							  "breakpoint": 768,
							  "settings": { 
								"slidesToShow": 2,
								"slidesToScroll": 1
							  }
							},
							{
							  "breakpoint": 480,
							  "settings": { 
								"slidesToShow": 1,
								"slidesToScroll": 1
							  }
							}
						]
					}'>
		
	*/
?>