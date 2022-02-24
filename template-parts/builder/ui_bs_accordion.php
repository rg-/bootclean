<?php WPBC_flex_layout_start(); ?>

<?php 
	
	$row = get_row();  
	$row_index = get_row_index();
	$section_settings = WPBC_get_flex_layout($row); 

	$accordion_items = WPBC_get_flex_layout_field('items'); 
	$accordion_items = WPBC_get_flex_layout_cleaned($accordion_items, 'items_');

	$accordion = WPBC_get_template_part('components/accordion', array(

		'return' => true, 
		'accordion_id' => $section_settings['id'].'-'.$row_index,
		'accordion_items' => $accordion_items,
		'collapse_parent' => true,

	));

	echo $accordion;

?>

<?php WPBC_flex_layout_end(); ?>