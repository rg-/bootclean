<?php 
	
	/*
	 * @passed $args
	 * @see _print_code($args);
	*/

	$layout_name = $args['layout'];
	$content = $args['section-content'];

?>

<?php do_action('wpbc/ui_layouts/section_content/before', $layout_name); ?>

<?php echo $content; ?>

<?php do_action('wpbc/ui_layouts/section_content/after', $layout_name); ?>