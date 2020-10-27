<?php

	$search_data = $args['serch'];

?>
<div class="ui-tokko-searchform gmb-1">

	<div class="container">

		<div class="row row-half-gutters">

				<div class="col-auto">
					<?php WPBC_tokko_form_operation_types(array(
						'show_all' => 'All operations',
						'search_data' => $search_data,
					)); ?>
				</div>
				<div class="col-auto">
					<?php WPBC_tokko_form_property_types(array(
						'show_all' => 'All properties',
						'search_data' => $search_data,
					)); ?>
				</div>
				<div class="col-auto">
					<?php WPBC_tokko_form_localization(array(
						'show_all' => 'All locations',
						'search_data' => $search_data,
					)); ?>
				</div>
				
				<div class="col-auto">
					<?php WPBC_tokko_form_filter_amount(
						array(
							'show_all' => 'All Rooms',
							'id' => 'suite_amount',
							'search_data' => $search_data,
							'options' => array(
								array(
									'value' => 1,
									'name' => '1 room',
									'cond' => '=',
								),
								array(
									'value' => 2,
									'name' => '2 rooms',
									'cond' => '=',
								),
								array(
									'value' => 3,
									'name' => '3 rooms',
									'cond' => '=',
								),
								array(
									'value' => 4,
									'name' => 'More than 3',
									'cond' => '>',
								),
							)
						)
					); ?>
				</div>

				<div class="col-auto">
					<?php WPBC_tokko_form_filter_amount(
						array(
							'show_all' => 'All Bathrooms',
							'id' => 'bathroom_amount',
							'search_data' => $search_data, 
							'options' => array(
								array(
									'value' => 1,
									'name' => '1 bathroom',
									'cond' => '=',
								),
								array(
									'value' => 2,
									'name' => '2 bathrooms',
									'cond' => '=',
								),
								array(
									'value' => 3,
									'name' => '3 bathrooms',
									'cond' => '=',
								),
								array(
									'value' => 4,
									'name' => 'More than 3 bathrooms',
									'cond' => '>',
								),
							)
						)
					); ?>
				</div>

				<div class="col-auto">
					<button class="btn btn-primary" type="submit">Search</button>
				</div>

				<div class="col-auto">
					<?php WPBC_tokko_form_order_by(array( 
						'search_data' => $search_data,
						'submit_on_change' => true,
					)); ?>
				</div>
				<div class="col-auto">
					<?php WPBC_tokko_form_order(array( 
						'search_data' => $search_data,
						'submit_on_change' => true,
					)); ?>
				</div>

			</div>

		</div>

</div>