<?php

$args = wp_parse_args( $args, array() ); 

$property_id = !empty($property->ID) ? $property->ID : get_the_ID();
$property_price = WPBC_get_field('property_price', $property_id);
$single_price = WPBC_get_field('property_single_price', $property_id);
$currency_symbol = WPBC_property_currency_symbol();
$sep = WPBC_property_currency_symbol_sep(); 
$prices_args = WPBC_property_template_prices_args(false, $property_id); 

if(!empty($args['use_small'])){
	$prices_args['class'] = '';
	$prices_args['row_class'] = '';
	$prices_args['btn_class'] = '';
}

if($property_price){
	$available = !empty($single_price['property_single_price_available']) ? $single_price['property_single_price_available'] : 1; 
	$label = !empty($single_price['property_single_price_label']) ? $single_price['property_single_price_label'] : ''; 
	$price = $currency_symbol.$sep.$property_price;
	$desc = !empty($single_price['property_single_price_desc']) ? $single_price['property_single_price_desc'] : ''; 
	$desc = '<small class="desc '.$prices_args['row_desc_class'].'">'.$desc.'</small>'; 
	$row_class = $prices_args['row_class'] . ' ' . ( empty($available) ? 'not-available '.$prices_args['row_not_available_class'] : 'available' ); 

?>
<div class="property_price <?php echo $prices_args['class']; ?>">
	<div class="<?php echo $row_class; ?>">
		<div class="<?php echo $prices_args['row_head_class']; ?>">
		<?php if($label){ ?><div class="label <?php echo $prices_args['row_label_class']; ?>"><?php echo $label; ?></div><?php } ?>
		<span class="price <?php echo $prices_args['row_price_class']; ?>"><?php echo $price; ?></span>
		</div>
		<?php if(empty($args['use_small'])) echo $desc; ?>
	</div>
</div>
<?php
} 
?>