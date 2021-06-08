<?php  

$attachment_id = $args['content__item_image'];  

$item_content = $args['content__item_content'];  

$image_hi_data = wp_get_attachment_image_src( $attachment_id, "full" );
$image_low_data = wp_get_attachment_image_src( $attachment_id, "medium" ); 

$img_hi = $image_hi_data[0];
$img_low = $image_low_data[0];
	
	$item_args = array(
		'type' => 'slick-image-cover',
		'img_hi' => $img_hi,
		'img_low' => $img_low, 
		'content' => $item_content, 
	);

	$item_styles = '';
	if(!empty($args['content__item_styles']['content__item_styles__background-color']) ){
		$item_styles .= 'background-color:'.$args['content__item_styles']['content__item_styles__background-color'].';';
	}
	if(!empty($args['content__item_styles']['content__item_styles__text-color']) ){ 
		$item_styles .= 'color:'.$args['content__item_styles']['content__item_styles__text-color'].';';
	}
	if(!empty($item_styles)){ 
		$item_args['item_styles'] = $item_styles; 
	}

	if(!empty($args['settings__embed']['settings__embed_by'])){
		$item_args['embed'] = $args['settings__embed']['settings__embed_by'];
		$item_args['type'] = 'slick-image-responsive-embed';
	} 

	WPBC_build_lazyloader_image($item_args);

?>