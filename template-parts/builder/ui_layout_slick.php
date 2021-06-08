<?php WPBC_flex_layout_start(); ?>

<?php  

	$content = WPBC_get_flex_layout_field('content');
	$settings = WPBC_get_flex_layout_field('settings');  

	/* 
		settings__options
		Options used to pass via data-slick attributes
		See: https://kenwheeler.github.io/slick/
	*/  


	$slick = WPBC_get_slick_options($settings); 

	/* 
		settings__heights
		Settigns for responsive slider heights
	*/
		
	$breakpoint_height = WPBC_get_slick_heights($settings); 
	/*

		Affix offset
		If enabled, will disable the calculation to rest the height of the #main-navbar element to the slider height used.
		This will prevent to overflow slider height on viewport if using as first element on builder
		and navbar is using "affix-simulate".

		Good for page header component

	*/

	$disable_affix_offset = '';
	$affix_offset = true;
	if($affix_offset){
		$disable_affix_offset = 'data-disable-affix-offset="true"';
	} 
?>

<div class="theme-slick-slider" data-slick='<?php echo $slick; ?>' data-breakpoint-height='<?php echo $breakpoint_height; ?>' <?php echo $disable_affix_offset; ?>>
	<?php foreach($content as $key=>$value){ ?>

		<?php 

		/* Insert more data in the $value, that will be passed as $args on template 
				In this case i will pass the embed by used if and ONLY if it´s not in use the Responsive Heights option.
		*/
		if(empty($settings['settings__use_heights'])){
			$value['settings__embed'] = $settings['settings__embed'];
		}

		$type = $value['content__item_type']; 

		if ( ! current_user_can( 'manage_options' ) ) {
		  echo '<!-- item_type: '.$type.' -->';
		}

		$value['content__item_content'] = apply_filters('wpbc/filter/ui_layout_slick/content__item_content', $value['content__item_content'], $type);

		WPBC_get_template_part('builder/parts/slick/item-'.$type, $value );
		?>

	<?php } ?>
</div>

<?php WPBC_flex_layout_end(); ?>