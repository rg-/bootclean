<?php

	$property = $args;   
  /*
	  
	  1 - Servicios
	  2 - Ambientes
	  3 - Adicionales

	  */
	$tags = $property->get_field('tags');

	$rooms = $property->get_tags_by_type(2);

	if(!empty($rooms)){
?>

<div class="ui-property-content-row ui-rooms-row">

	<h3 class="section-subtitle md mb-4">Ambientes</h3>

	<div class="row mt-3"> 
		<?php  
			
			foreach ($rooms as $key => $value) {
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