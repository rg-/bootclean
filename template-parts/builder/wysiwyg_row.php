<?php
$row = get_row();
$acf_fc_layout = $row['acf_fc_layout']; 
$prefix = 'field_'.$acf_fc_layout;
$section = WPBC_get_section_row_args($row, $prefix); 
if(!empty($section['section_options']['visible'])) return;

?>

<?php do_action('wpbc/flexible-layout-row/start', $section, $acf_fc_layout ); ?>

	<?php

	 if(!empty($row['field_wysiwyg_row_content'])){
	 	?>
<div class="wysiwyg_row-content">
	<?php echo $row['field_wysiwyg_row_content']; ?>
</div>
	 	<?php
	 }

	?>

<?php do_action('wpbc/flexible-layout-row/end', $section, $acf_fc_layout ); ?>