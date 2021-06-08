<?php 

$post = WPBC_get_flex_layout_field('post'); 

$edit = WPBC_get_edit_template_builder(number_format($post));

WPBC_flex_layout_start(array(
	'edit_link' => $edit,
)); ?>

<?php 

	$do_shortcode = do_shortcode('[WPBC_get_template id="'.$post.'"/]'); 

	echo $do_shortcode;  

?>

<?php WPBC_flex_layout_end(); ?>