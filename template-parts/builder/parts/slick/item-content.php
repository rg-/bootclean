<?php

	$item_content = $args['content__item_content'];

	$item_styles = '';
	if(!empty($args['content__item_styles']['content__item_styles__background-color']) ){
		$item_styles .= 'background-color:'.$args['content__item_styles']['content__item_styles__background-color'].';';
	}
	if(!empty($args['content__item_styles']['content__item_styles__text-color']) ){ 
		$item_styles .= 'color:'.$args['content__item_styles']['content__item_styles__text-color'].';';
	}

?>

<div class="item" data-item-type="<?php echo $args['content__item_type']; ?>">

	<div class="item-container no-image d-block" style="<?php echo $item_styles; ?>">

		<?php if(!empty($args['settings__embed']['settings__embed_by']) && $args['settings__embed']['settings__embed_by'] != 'none' ){ ?>
			<div class="embed-responsive embed-responsive-<?php echo $args['settings__embed']['settings__embed_by'];?>">
				<div class="embed-responsive-item">
		<?php } ?>
		<?php echo $item_content; ?>
		<?php if(!empty($args['settings__embed']['settings__embed_by']) && $args['settings__embed']['settings__embed_by'] != 'none' ){ ?>
				</div>
			</div>
		<?php } ?>
	</div>

</div>