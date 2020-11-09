<?php

	$property = $args;   
  
	$tags = $property->get_field('tags');

?>

<hr class="border-primary mt-4 mb-5">

<h3 class="section-subtitle md mb-4">Adicionales</h3>

<div class="row mt-3"> 
	<?php  
		$servicios = $property->get_tags_by_type(3);
		foreach ($servicios as $key => $value) {
			?>
			<div class="col-md-4">
				<p><i class="icon-plus sm text-primary"></i> <?php echo strtoupper($value->name); ?></p>
			</div>
			<?php
		}
	?>
</div>