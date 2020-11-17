<?php

	$property = $args; 

	$get_operations = $property->get_operations(); 
?>

<div class="ui-property-content-row ui-prices-row">

	<div class="ui-tokko-property-prices">

		<?php
		foreach ($get_operations as $key => $value) { 
			$currency = 'USD'; 
			?>
			<div class="property-price-part">
				<h3 class="section-subtitle md text-primary"><?php echo $value->operation_type; ?></h3>
				<?php
				foreach ($value->prices as $price) {
					// _print_code($price);
					if($price->currency == $currency){
						if(!empty( $price->period )){
							?>
							<p class="text-primary m-0"><?php echo $price->period; ?></p>
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