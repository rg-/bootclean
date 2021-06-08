<?php WPBC_flex_layout_start(); ?>

<?php

	$file = WPBC_get_flex_layout_field('file'); 

	/* TODO HERE ?? */
	$passed_args = array();
	$passed_args = http_build_query($passed_args);

	$do_shortcode = do_shortcode('[WPBC_get_template_theme post_id="'.$post_id.'" name="'.$file.'" from="template_part_row" layout_count="'.$layout_count.'" args="'.$passed_args.'"/]'); 

	echo $do_shortcode; 

?>

<?php WPBC_flex_layout_end(); ?>