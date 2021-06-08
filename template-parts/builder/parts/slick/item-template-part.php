<?php

$file = $args['content__item_template_part'];  

/* TODO HERE ?? */
$passed_args = array();
$passed_args = http_build_query($passed_args);

$do_shortcode = do_shortcode('[WPBC_get_template_theme name="'.$file.'" from="slick-template-part"  args="'.$passed_args.'"/]'); 

$item_styles = '';
if(!empty($args['content__item_styles']['content__item_styles__background-color']) ){
	$item_styles .= 'background-color:'.$args['content__item_styles']['content__item_styles__background-color'].';';
}
if(!empty($args['content__item_styles']['content__item_styles__text-color']) ){ 
	$item_styles .= 'color:'.$args['content__item_styles']['content__item_styles__text-color'].';';
}

?>

<div class="item">

	<div class="item-container no-image d-block" style="<?php echo $item_styles; ?>">
		<?php echo $do_shortcode; ?>
	</div>

</div>