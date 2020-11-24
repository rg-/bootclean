<?php

	$property = $args; 

	$get_operations = $property->get_operations();  
 	
	//_print_code( $property->is_sale() ); 
  //_print_code( $property->is_rent() ); 
  //_print_code( $property->is_temporary_rent() ); 


  //_print_code( $property->get_available_prices_by_operation('venta') ); 
?>

<div data-clone="#cloned-prices" class="ui-property-content-row ui-prices-row d-none d-md-block">

	<div class="ui-tokko-property-prices">

		<?php
		 
		foreach ($get_operations as $key => $value) { 
			$currency = 'USD'; 
			?>
			<div class="property-price-part">
				<h3 class="section-subtitle md text-primary font-weight-600"><?php echo $value->operation_type; ?></h3>
				<?php
				$prices = $value->prices;
				//$prices = array_reverse($prices);

				foreach ($prices as $price) {
					// _print_code($price);
					if($price->currency == $currency){
						if(!empty( $price->period )){
							?>
							<p class="text-primary mt-3 mb-0"><?php echo $price->period; ?></p>
							<?php
						}
						$price = number_format_i18n($price->price,2);
						?>
						<p class="font-size-22 font-weight-600">USD <?php echo $price; ?></p> 
						<?php
					}
				}
				?>
			</div>
			<?php 
		}
		?>

	</div>

</div>