<?php WPBC_flex_layout_start(); ?>

<?php  
	
	/*
	
	Will return

	WPBC_get_ui_layout_full_cols() = array(

		'layout_ID' => $layout_ID,

		'layout_type' => $layout_type, default, title-up, overlay-content, overlay-title

		'breakpoint' => $breakpoint,
		'content_side' => $content_side,
		'image_embed' => $image_embed,
		'gallery_ids' => $gallery,

		'col_img_class' => $col_img_class, 
		'col_gallery_wrap_class' => $col_gallery_wrap_class,


		'content_wysiwyg' => $content_wysiwyg,
		'container_content_class' => $container_content_class,
		'row_content_class' => $row_content_class,
		'col_content_class' => $col_content_class,
		'col_content_wrap_class' => $col_content_wrap_class,
		'col_content_wysiwyg_wrap_class' => $col_content_wysiwyg_wrap_class,

		'use_title' => $use_title,
		'content_title' => $content_title,
		'title_attrs' => $title_attrs,
		'content_title_settings' => $content_title_settings, 
		'col_content_title_wrap_class' => $col_content_title_wrap_class, 
		
		'custom_content_title' => false,
	);

	*/


	$ui = WPBC_get_ui_layout_full_cols();  
	extract($ui);
?>

<div class="wpbc-full-aside-cols d-flex flex-column type-<?php echo $layout_type; ?> content-<?php echo $content_side; ?> break-<?php echo $breakpoint; ?>">

	<div id="<?php echo $layout_ID; ?>-col-fullside" class="<?php echo $col_img_class; ?> col-fullside">
		
		<?php if(!empty($use_title)){ ?>
		<div class="d-block d-<?php echo $breakpoint;?>-none">
			<div class="<?php echo $container_content_class; ?> col-content-container">
				<div class="<?php echo $row_content_class; ?> col-content-row">
			  	<div class="<?php echo $col_content_class; ?> col-content">
			  		<div class="<?php echo $col_content_wrap_class; ?> col-content-wrap">
							<div id="<?php echo $layout_ID; ?>-col-fullside-cloned">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<div class="<?php echo $col_gallery_wrap_class; ?> h-100 col-fullside-wrap">
			<?php 
			WPBC_get_template_part('builder/parts/ui_layout_commons/section-background', array(
				'images' => $gallery_ids,
				'slick_class' => 'slick-embed-responsive',
				'lazyloader' => array(
					'embed' => $image_embed,
					'type' => 'slick-image-responsive-embed',
				)
			)); 
			?>
		</div>
	</div>

	<div id="<?php echo $layout_ID; ?>-col-content-container" class="<?php echo $container_content_class; ?> col-content-container">
	  <div class="<?php echo $row_content_class; ?> col-content-row">
	  	<div class="<?php echo $col_content_class; ?> col-content">
	  		<div class="<?php echo $col_content_wrap_class; ?> col-content-wrap">

	  			<?php if(!empty($use_title)){ ?>
		  			<div <?php echo $title_attrs; ?> class="<?php echo $col_content_title_wrap_class; ?> col-content-title-wrap">
			  		<?php WPBC_get_template_part('builder/parts/ui_layout_commons/section-title', array(
								'section-title' => $content_title, 
								'section-title-settings' => $content_title_settings,
								'layout' => 'ui_layout_full_cols',
							)); ?>
						</div>
					<?php } ?>

					<div class="<?php echo $col_content_wysiwyg_wrap_class; ?> col-content-wysiwyg-wrap">
					<?php WPBC_get_template_part('builder/parts/ui_layout_commons/section-content', array(
							'section-content' => $content_wysiwyg, 
							'layout' => 'ui_layout_full_cols',
						)); ?>
					</div>
		  	
		  	</div>
	  	</div>
	  </div>
	</div>

</div>

<?php WPBC_flex_layout_end(); ?>