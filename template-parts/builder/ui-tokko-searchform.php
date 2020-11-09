<?php
$row = get_row(); 

$acf_fc_layout = $row['acf_fc_layout']; 
$prefix = 'field_'.$acf_fc_layout;
$section = WPBC_get_section_row_args($row, $prefix); 
if(!empty($section['section_options']['visible'])) return;  
$prefix = 'field_ui-tokko-searchform_'; 
?>
<?php do_action('wpbc/flexible-layout-row/start', $section, $acf_fc_layout ); ?>

	<?php   

		$post_id = $row[$prefix.'post_id'];  
		$row_index = $row[$prefix.'row_index'];

		   $linked_results = $row[$prefix.'linked_results'];  
		   $linked_results_id = $row[$prefix.'linked_results_id']; 
		   $linked_results_page = $row[$prefix.'linked_results_page']; 
		   $linked_results_url = $row[$prefix.'linked_results_url'];   

		   $template = $row[$prefix.'template'];   

		WPBC_get_template_part('wpbc_tokko/form', array(
			'post_id' => $post_id,
			'row_index' => $row_index, 
			'linked_results' => $linked_results,
			'linked_results_id' => $linked_results_id,
			'linked_results_page' => $linked_results_page,
			'linked_results_url' => $linked_results_url,
			'template' => $template,
		));
		// echo do_shortcode('[WPBC_get_tokko_form post_id=6 row_index=3 id="form-venta"]');
		?>

<?php do_action('wpbc/flexible-layout-row/end', $section, $acf_fc_layout ); ?>