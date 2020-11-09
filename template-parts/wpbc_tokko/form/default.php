<?php

	$search_data = $args;

?>

<div class="row row-half-gutters">

	<div class="col">
		<?php WPBC_tokko_form_operation_types(array(
			'show_all' => 'Operación',
			'search_data' => $search_data, 
		)); ?>
	</div>
	<div class="col">
		<?php WPBC_tokko_form_property_types(array(
			'show_all' => 'Tipo de propiedad',
			'search_data' => $search_data,
		)); ?>
	</div>
	<div class="col">
		<?php WPBC_tokko_form_localization(array(
			'show_all' => 'Ubicación',
			'search_data' => $search_data,
		)); ?>
	</div>
</div>

<div class="row row-half-gutters">

	<div class="col">
		<?php WPBC_tokko_form_filter_amount(
			array(
				'show_all' => 'Dormitorios',
				'id' => 'suite_amount',
				'search_data' => $search_data, 
			)
		); ?>
	</div>

	<div class="col">
		<?php WPBC_tokko_form_filter_amount(
			array(
				'show_all' => 'Baños',
				'id' => 'bathroom_amount',
				'search_data' => $search_data,  
			)
		); ?>
	</div>

	<div class="col">
			<?php WPBC_tokko_form_property_prices(array( 
				'search_data' => $search_data, 
			)); ?>
	</div>

	<div class="col col-md-2 d-none">
		<?php WPBC_tokko_form_filter_amount(
			array(
				'show_all' => 'Destacado',
				'id' => 'is_starred_on_web',
				'search_data' => $search_data,
				'options' => array(
					array(
						'value' => 0,
						'name' => 'NO', 
						'cond' => '=',
					),
					array(
						'value' => 1,
						'name' => 'SI', 
						'cond' => '=',
					), 
				)
			)
		); ?>
	</div>

	<div class="col col-md-1">
		<?php WPBC_tokko_form_order_by(array( 
			'search_data' => $search_data,
			'submit_on_change' => true,
		)); ?>
	</div>
	<div class="col col-md-1">
		<?php WPBC_tokko_form_order(array( 
			'search_data' => $search_data,
			'submit_on_change' => true,
		)); ?>
	</div>

	<div class="col col-md-1">
		<?php WPBC_tokko_form_submit(array(
			'label' => 'Buscar',
			'class' => 'btn btn-primary btn-block',
		)); ?>
	</div>


</div>