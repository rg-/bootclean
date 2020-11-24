<?php
	$section_args = $args['section_args'];
	$no_results_text = !empty($section_args['is_developments']) ? 'There are no related properties for this development.' : 'There are no search results with that criteria.'; 
?>
<div class="col-12 ">
	<p class="lead text-center"><?php echo $no_results_text; ?></p>
</div>