<?php 

$row = get_row();   
$section_settings = WPBC_get_flex_layout($row); 

$post = WPBC_get_flex_layout_field('post');  
$ajax_load = WPBC_get_flex_layout_field('ajax_load'); 
$ajax_onload = WPBC_get_flex_layout_field('ajax_onload'); 
$edit = WPBC_get_edit_template_builder(number_format($post));

WPBC_flex_layout_start(array(
	'edit_link' => $edit,
)); ?>

<?php  

	if(empty($ajax_load)){
		$do_shortcode = do_shortcode('[WPBC_get_template id="'.$post.'"/]'); 
		echo $do_shortcode;  
	}else{  
		
		/*
		
			@see bootclean/js/core/ajax-navigation.js

		*/  

		$target_attrs = '';
		$target_class = '' ;
		$btn_attrs = '';
		$btn_class = 'btn btn-primary';
		$btn_label = __('Load','bootclean');
		$ajax_loading_background = WPBC_get_flex_layout_field('ajax_loading_background_color'); 
		$ajax_loading_color = WPBC_get_flex_layout_field('ajax_loading_spinner_color');  
		$ajax_loading_background_opacity = WPBC_get_flex_layout_field('ajax_loading_background_opacity');  
		$rgb = WPBC_hex2rgb($ajax_loading_background);
		$ajax_loading_background = 'rgba('.$rgb["r"].','.$rgb["g"].','.$rgb["b"].','.$ajax_loading_background_opacity.')'; 

		if( $ajax_onload != 'inview' ){
			// ready, load, init
			$btn_attrs = 'data-ajax-onload="'.$ajax_onload.'"';
			$btn_class = ' d-none ';
		}

		if( $ajax_onload == 'inview' ){
			$target_attrs = ' data-is-inview="click" data-click-target="#ui_template_'.$section_settings['id'].'_ajax_button" '; 
		}

		if( $ajax_onload == 'button' ){
			$btn_class = 'btn btn-primary';
		}

		?>
		<div <?php echo $target_attrs; ?> data-transition-time="1s" id="ui_template_<?php echo $section_settings['id']; ?>_ajax_target" class="<?php echo $target_class; ?> min-h-100 ">

			<div class="d-flex min-h-100 align-items-center justify-content-center gpy-2">
				
				<button id="ui_template_<?php echo $section_settings['id']; ?>_ajax_button" <?php echo $btn_attrs; ?> data-ajax-loading-background="<?php echo $ajax_loading_background; ?>" data-ajax-loading-color="<?php echo $ajax_loading_color; ?>" data-ajax-remove-me="parent" data-ajax-template="<?php echo admin_url( 'admin-ajax.php' ); ?>?action=get_template&id=<?php echo $post; ?>" data-template-target="#ui_template_<?php echo $section_settings['id']; ?>_ajax_target" data-ajax-template-type="replace" class="<?php echo $btn_class; ?>"><?php echo $btn_label; ?></button>
			
			</div>

		</div>
		
		<?php
	}

?>

<?php WPBC_flex_layout_end(); ?>