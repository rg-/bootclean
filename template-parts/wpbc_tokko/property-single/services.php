<?php

	$property = $args;   
  
	$tags = $property->get_field('tags');
	
	$servicios = $property->get_tags_by_type(1);

	if(!empty($servicios)){
?>

<div class="ui-property-content-row ui-servicios-row">

	<h3 class="section-subtitle md mb-4">Servicios</h3>

	<div class="row mt-3"> 
		<?php  
			$servicios = $property->get_tags_by_type(1);
			foreach ($servicios as $key => $value) {
				?>
				<div class="col-sm-6 col-md-4">
					<p class="ui-property-tag has-icon"><i class="icon icon-plus sm text-primary"></i> <?php echo strtoupper($value->name); ?></p>
				</div>
				<?php
			}
		?>
	</div>

</div>
<?php } ?>