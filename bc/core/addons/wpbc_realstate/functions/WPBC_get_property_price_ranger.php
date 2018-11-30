<?php 
function WPBC_get_property_price_ranger($args){

	$defaults = array(
		'shortcode_atts' => '',
	);
	$args = shortcode_atts($defaults, $args); 
	$shortcode_atts = $args['shortcode_atts'];

	$prefix = WPBC_property_currency_symbol(); 
	
	$get_max_price_value = WPBC_property_get_max_price();
	$default_max_price = 1000;

	$min = 0;
	$max = !empty($get_max_price_value) ? $get_max_price_value : $default_max_price; 
	$step = 50;

	$start_from = !empty($shortcode_atts['property_price_min']) ? $shortcode_atts['property_price_min'] : $min;
	$start_to = !empty($shortcode_atts['property_price_max']) ? $shortcode_atts['property_price_max'] : $max;  
	
	ob_start();
	$out = '';
	?>
	<div class="form-slider-range" data-input-min="#property_price_min" data-input-max="#property_price_max" data-money-format='{ "decimals": 0, "thousand": ".", "prefix": "<?php echo $prefix; ?>" }' data-range-args='{ "start": [<?php echo $start_from; ?>, <?php echo $start_to; ?>], "step": <?php echo $step; ?>, "range": { "min":[<?php echo $min; ?>], "max":[<?php echo $max; ?>] }, "rangeLabels": { "min": "", "max": " - " }  }'> 
		<div class="slider-range"></div> 
	</div>
	<?php
	$out .= ob_get_contents();
	ob_end_clean();   
	return $out; 
}