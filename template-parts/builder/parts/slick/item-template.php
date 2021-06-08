<?php 

$item_template = $args['content__item_template'];

$do_shortcode = do_shortcode('[WPBC_get_template id="'.$item_template.'"/]'); 

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