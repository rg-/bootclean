<?php
 
if( is_user_logged_in() && current_user_can( 'manage_options' ) && !wp_doing_ajax() && function_exists('acf_form_head') && WPBC_ACF_FORM() ){
	acf_form_head();
} 

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo apply_filters('wpbc/html/class','');?>">
	<head>
		
		<?php do_action('wpbc/head/start'); ?>
		
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<?php do_action('wpbc/head/favicons'); ?>

		<?php do_action('wpbc/head/scripts'); ?>
		
		<?php wp_head(); ?>

		<?php do_action('wpbc/head/end'); ?>
		
	</head>
	<?php
	$body_class = 'loading detect-scroll '.BC_get_body_class();
	?>
	<body <?php body_class($body_class); ?> data-config='<?php WPBC_get_body_data_config(); ?>' <?php BC_get_body_data(); ?> data-template="<?php echo WPBC_get_template(); ?>" data-template-type="<?php echo WPBC_get_template(array('show_post_types'=>'1')); ?>" data-template-format="<?php echo WPBC_get_template(array('show_post_formats'=>'1')); ?>">
	
	<?php 
	/*   
		wpbc/layout/body/start action

		@hooked action__wpbc_layout_body_start__loader - 10
		@hooked action__wpbc_layout_body_start__main_content_start - 20

		@hooked action__wpbc_layout_body_start__main_navbar - 30
			@deprecated since 9.0.1 see /template-builder/...
 		@hooked action__wpbc_layout_body_start__page_header - 35
 			@deprecated since 9.0.1 see /template-builder/...
 		@hooked action__wpbc_layout_body_start__main_content_wrap_start - 40
 			@deprecated since 9.0.1 see /template-builder/...

	*/
	 
		do_action('wpbc/layout/body/start');  
	?>