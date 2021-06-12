<?php 

	$defaults = array(
		'layout_ID' => 'wpbc-full-aside-cols_'.uniqid(),
		'layout_type' => 'default',

		'breakpoint' => 'md',
		'content_side' => '',
		'image_embed' => '1by1',

		'gallery_ids' => array(),

		'col_img_class' => '', 
		'col_gallery_attrs' => '',
		'col_gallery_wrap_class' => '', 
		'col_gallery_wrap_attrs' => '',

		'content_wysiwyg' => '', 
		'container_content_class' => '', 
		'row_content_class' => '', 
		'col_content_class' => '', 
		'col_content_wrap_class' => '', 
		'col_content_wysiwyg_wrap_class' => '', 

		'use_title' => false,
		'content_title' => '',
		'title_attrs' => '',
		'content_title_settings' => array(),
		'col_content_title_wrap_class' => '',
		
		'custom_content_title' => false,

	);

	$defaults = array_merge($defaults, $args); 
	extract($defaults);

/*

	use like 

	WPBC_get_template_part('components/wpbc-full-aside-cols', array(

		 'layout_ID' => $layout_ID,

			'layout_type' => $layout_type, // default, title-up, overlay-content, overlay-title

			'breakpoint' => $breakpoint, // xs, sm, md, lg, xl
			'content_side' => $content_side, // right, right
			'image_embed' => $image_embed, // 1by1, 4by3 etc
			'gallery_ids' => $gallery, // array of images IDs

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
	));

*/

?>
<div class="wpbc-full-aside-cols d-flex flex-column type-<?php echo $layout_type; ?> content-<?php echo $content_side; ?> break-<?php echo $breakpoint; ?>">

	<div id="<?php echo $layout_ID; ?>-col-fullside" class="<?php echo $col_img_class; ?> col-fullside" <?php echo $col_gallery_attrs; ?>>
		
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
		
		<div class="<?php echo $col_gallery_wrap_class; ?> h-100 col-fullside-wrap" <?php echo $col_gallery_wrap_attrs; ?>>
			<?php 
			WPBC_get_template_part('builder/parts/ui_layout_commons/section-background', array(
				'images' => $gallery_ids,
				'slick_class' => 'slick-embed-responsive',
				'lazyloader' => array(
					'embed' => $image_embed,
					'type' => 'slick-inview',
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
			  		<?php 

			  		if( !empty($custom_content_title) ){
			  			echo $custom_content_title;
			  		}else{
			  			WPBC_get_template_part('builder/parts/ui_layout_commons/section-title', array(
								'section-title' => $content_title, 
								'section-title-settings' => $content_title_settings,
								'layout' => 'ui_layout_full_cols',
							));
			  		} 
			  		 ?>
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