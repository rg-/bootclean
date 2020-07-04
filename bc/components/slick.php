<?php
	
/*
 * @pack Bootclean
 * @subpack Slick Slider
 * 
 * @version v 10.0
 *
 *
 */

	/*
	Gerenate custom unique id if needed.
	*/
	$_slider_uid = uniqid();
	
	$slick_attrs = isset($params['slick']) ? $params['slick'] : '{ }'; 
	
	/* Defatuls arguments passed */
	$slick_args = isset($params['slick_args']) ? $params['slick_args'] : array(); 
	$slider_acf_object = isset($params['slider_acf_object']) ? $params['slider_acf_object'] : array(); 
	/*
	Since defaults "$slick_args" are also de plugin js params
	there´s no need to pass the entire json to the data- tag
	So, here i filter them, if something is diferent than defaut value, 
	then it´s passed to the array, then as a json, and then as the data-slick="" tag on the element.
	*/
	$slick_args_temp = array();
	foreach($slick_args as $k=>$v){  
		if($slider_acf_object['value']['r_slider_settings_args'][$k] != $v){ 
			$slick_args_temp[str_replace('slider_args__', '', $k)] = $v;
		}else{ 
		} 
	} 
	// As above said, if there are custom arguments, pass them, if not {} empty json !important, do not leave empty.
	if(!empty($slick_args_temp)){
		$slick_attrs = json_encode($slick_args_temp);
	}else{
		$slick_attrs = $slick_attrs; 
	}  

	$slider_ID = !empty($params['id']) ? $params['id'] : 'wp-slick-slider-'.$_slider_uid;  
	
	$slick_data = '';
	if( !empty( $params['breakpoint-height'] ) ){
		$bk = $params['breakpoint-height'];
		if(is_array($bk)){
			$bk = json_encode($bk);
		} 
		$slick_data = "data-breakpoint-height='".$bk."'";
	}else{
		$def = '{ "defaults":{"default":"100wh"} }';
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
	
	$slick_attrs = apply_filters('wpbc/slick/slick_attrs', $slick_attrs, $params);

	$slick_data = apply_filters('wpbc/slick/slick_data', $slick_data, $params);
	$slick_class = 'theme-slick-slider';
	$slick_class = apply_filters('wpbc/slick/slick_class', $slick_class, $params);
?>
<?php if($slick_wrapper){?><div class="<?php echo isset($params['container_class']) ? 'slick-slider-container '.$params['container_class'] : 'slick-slider-container container';?>"><?php } ?>
	<?php do_action('wpbc/slick/before', $params); ?>
	<div id="<?php echo $slider_ID; ?>" class="<?php echo $slick_class; ?>" data-slick='<?php echo $slick_attrs; ?>' <?php echo $slick_data; ?> <?php echo $slick_data_callbacks; ?>>
		<?php
		if(isset($params['items'])){
		
			$items = $params['items']; 
			
			foreach( $items as $k=>$v ){  
				
				$content_slide = $v['content'];

				$content_slide = apply_filters('wpbc/slick/content_slide', $content_slide, $params);
 
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
										<?php echo $content_slide; ?>
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
										<?php echo $content_slide; ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } else {
					
					/*
						@params passed for each item ($v) over $items
					*/
					
					/* END ITEM */
					WPBC_get_template_part('components/slick/item', array(
						'item' => $v,
						'params' => $params, 
					));
					
					?>
					
				<?php } ?>
			
			<?php do_action('wpbc/slick/item/after', $v, $params); ?>
			<!-- item END --><?php }
			} // if "items" end
			
			if(isset($params['items_html'])){
				echo $params['items_html'];
			}

		?>
	</div><!-- theme-slick-slider END -->
<?php do_action('wpbc/slick/after', $params); ?>
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