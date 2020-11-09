<?php

	$property = $args;

	$basic_info = array(
 		
		array(
			'label' => 'DIRECCIÓN',
			'value' => $property->get_field("location")->name,
		),

		array(
			'label' => 'AMBIENTES',
			'value' => $property->get_field("room_amount"),
		),

		array(
			'label' => 'DORMITORIOS',
			'value' => $property->get_field("suite_amount"),
		),

		array(
			'label' => 'BAÑOS',
			'value' => $property->get_field("bathroom_amount"),
		),

		array(
			'label' => 'TOILETS',
			'value' => $property->get_field("toilet_amount"),
		),

		array(
			'label' => 'COCHERAS',
			'value' => $property->get_field("parking_lot_amount"),
		),

		array(
			'label' => 'COCHERAS',
			'value' => $property->get_field("parking_lot_amount"),
		),

		array(
			'label' => 'PLANTAS',
			'value' => $property->get_field("floors_amount"),
		),

		array(
			'label' => 'ANTIGÜEDAD',
			'value' => $property->get_age(),
		),  

		array(
			'label' => 'ZONIFICACIÓN',
			'value' => $property->get_field("zonification"),
		),  

		array(
			'label' => 'CONDICIÓN',
			'value' => $property->get_field("property_condition"),
		),

		array(
			'label' => 'SITUACIÓN',
			'value' => $property->get_field("situation"),
		),

		array(
			'label' => 'DISPOSICIÓN',
			'value' => $property->get_field("disposition"),
		),

		array(
			'label' => 'ORIENTACIÓN',
			'value' => strtoupper($property->get_field('orientation')),
		),

		array(
			'label' => 'EXPENSAS',
			'value' => strtoupper($property->get_field('expenses')).'$',
		),

	);
?>

<hr class="border-primary mt-4 mb-5">

<h3 class="section-subtitle md mb-4">Información básica</h3>

<div class="row">

	<?php
	foreach ($basic_info as $key => $value) {
		?>
		<div class="col-md-4">
			<p><?php echo $value['label']; ?>: <span class="text-primary"><?php echo $value['value']; ?></span></p>
		</div>
		<?php
	}
	?>

</div>