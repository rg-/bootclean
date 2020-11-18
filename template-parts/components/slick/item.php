<?php
// _print_code($args);
/*

	Passed $args

		> $args['item']
		> $args['params']

*/
$item = $args['item'];
$params = $args['params'];

$use_lazyload = false; 
if( !empty( $params['lazyload'] ) ){
	$use_lazyload = true; 
} 

//$use_lazytype = 'lazybackground_inner';
//$use_lazytype_fx = 'blured';

$use_lazytype = $params['lazytype'];
$use_lazytype_fx = $params['lazytype_fx'];

$type = ( !empty($item['type']) && !is_array($item['type']) ) ? $item['type'] : 'inline'; 
 
$content = apply_filters('wpbc/slick/content_slide', $item['content'], $params);

$extra_content = '';

	//_print_code($args);

$image_object = !empty($item['image_object']) ? $item['image_object'] : ''; 
$content_class = !empty($item['content_class']) ? $item['content_class'] : ( !empty($params['container_item_class']) ? $params['container_item_class'] : '' ); 

$content_type = 'item-just-content';
$item_class = '';
$attrs = '';

if($type == 'inline'){ 
	$content_type = 'item-image-content'; 

	// TODO HERE, apply same new data-lazyimage-src for <img> inline

}

$slick_item_class = '';

if($type == 'cover'){ 
	$content_type = 'item-cover-content';
	$item_class = 'image-cover ';
	if(!empty($image_object)){  
		$attrs = 'style="background-image:url('. $image_object['url'] .');" '; 
		if($use_lazyload && $use_lazytype == 'lazyload' || $use_lazytype == 'lazybackground'  ){
			$slick_item_class .= ' loading'; 
			$img_id = $image_object['id'];
			$img_low = wp_get_attachment_image_src($img_id, 'medium');

			$attrs = 'data-'.$use_lazytype.'-src="'.$image_object['url'].'" style="background-image:url('. $img_low[0] .');" ';

		}
		if($use_lazyload && $use_lazytype == 'lazybackground_inner'){
			$img_id = $image_object['id'];
			$img_low = wp_get_attachment_image_src($img_id, 'medium');
			$attrs = 'style="background-image: url('.$img_low[0].');" ';
			
			if( $use_lazytype_fx == 'blured' ){
				$item_class .= ' lazyload-blured';
			}
			$extra_content = '<div class="w-100 h-100 image-cover " data-lazybackground-spinner="false" data-lazybackground-target="parent" data-lazybackground="simple" data-lazybackground-src="'.$image_object['url'].'" style="background-image: none;"></div>';
		}
	}else{
		$item_class .= ' no-image';
	}
} 

$attrs = apply_filters('wpbc/slick/item/container/attrs', $attrs, $item);
$item_class = apply_filters('wpbc/slick/item/container/class', $item_class, $item);

/* START ITEM */
if( !empty($content) || !empty($image_object)) {   

?>
<div class="item <?php echo $slick_item_class; ?>">
	<?php if($use_lazyload && !empty($image_object) && $use_lazytype == 'lazyload'){ ?>
		<span class="lazyload-loading"></span>
	<?php } ?>
	<div class="item-container <?php echo $item_class; ?>" <?php echo $attrs; ?>>
		<?php echo $extra_content; ?>
		<?php do_action('wpbc/slick/item/container/before', $item, $params); ?>
		<?php do_action('wpbc/slick/item/container/content/before', $item, $params); ?>
		<?php if( $type == 'inline' && !empty($image_object) ) { ?>
			<img src="<?php echo $image_object['url']; ?>" class="item-image full-w" alt="<?php echo $image_object['title']; ?>"/>
		<?php } ?>
		<?php if( !empty($content) ) { ?>
			<div class="<?php echo $content_type.' '.$content_class; ?>">
				<?php do_action('wpbc/slick/item/content/before', $item, $params); ?>
				<?php echo $content; ?>
				<?php do_action('wpbc/slick/item/content/after', $item, $params); ?>
			</div>
		<?php } ?>
		<?php do_action('wpbc/slick/item/container/content/after', $item, $params); ?>
		<?php do_action('wpbc/slick/item/container/after', $item, $params); ?>
	</div>
</div>
<?php } ?>