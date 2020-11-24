<?php

	$property = $args;  
 	
 	$surface_measurement = $property->get_field("surface_measurement"); 
		$total_surface = $property->get_field("total_surface").' '.$surface_measurement;
		$surface = $property->get_field("surface").' '.$surface_measurement;
		$roofed_surface = $property->get_field("roofed_surface").' '.$surface_measurement;
		$semiroofed_surface = $property->get_field("semiroofed_surface").' '.$surface_measurement;
		$unroofed_surface = $property->get_field("unroofed_surface").' '.$surface_measurement;

	$surfaces = array(

		array(
			'label' => 'CONSTRUCCIÓN',
			'value' => $total_surface,
		),

		array(
			'label' => 'TERRENO',
			'value' => $surface,
		),

		array(
			'label' => 'TECHADA',
			'value' => $roofed_surface,
		),

		array(
			'label' => 'SEMI TECHADA',
			'value' => $semiroofed_surface,
		),

		array(
			'label' => 'NO TECHADA',
			'value' => $unroofed_surface,
		),

	); 
  
  if(!empty($surfaces)){
?>
<div class="ui-property-content-row ui-surfaces-row">

	<h3 class="section-subtitle md mb-4">Superficies</h3>

	<div class="row">
		<?php foreach ($surfaces as $key => $value) {
			?>
			<div class="col-sm-6 col-md-4">
				<p class="ui-property-tag"><?php echo $value['label']; ?>: <span class="text-primary"><?php echo $value['value']; ?></span></p>
			</div>
			<?php
		}
		?>
	</div>

</div>
<?php } ?>