<?php 

$property_id = !empty($property->ID) ? $property->ID : get_the_ID();

$currency_symbol = WPBC_property_currency_symbol();
$sep = WPBC_property_currency_symbol_sep();
$prices = WPBC_get_field('property_temporary_prices', $property_id); 
$prices_list = $prices['property_temporary_prices_list'];

if(!empty($prices_list)){ 
$prices_args = WPBC_property_template_prices_args(true, $property_id); 
?>
<div class="property_temporary_prices <?php echo $prices_args['class']; ?>">
<?php
	foreach($prices_list as $k=>$v){

		$available = $v['property_temporary_price_available']; 
		$label = $v['property_temporary_price_label'];
		$price = $currency_symbol.$sep.$v['property_temporary_price_num'];
		$desc = !empty($v['property_temporary_price_desc']) ? $v['property_temporary_price_desc'] : '';
		$desc = '<small class="desc '.$prices_args['row_desc_class'].'">'.$desc.'</small>'; 

		$row_class = $prices_args['row_class'] . ' ' . ( empty($available) ? 'not-available '.$prices_args['row_not_available_class'] : 'available' );

		?>
		  <div class="<?php echo $row_class; ?>">
		  	<?php if(empty($available)){ ?>
		      	<span class="bg-warning text-primary badge "><?php echo $prices_args['not_available'];?></span>
		      <?php }else{ ?>
		      	<span class="bg-success text-white badge "><?php echo $prices_args['available'];?></span>
		      <?php } ?>
		    <div class="<?php echo $prices_args['row_head_class']; ?>">
		      <div class="label <?php echo $prices_args['row_label_class']; ?>"><?php echo $label; ?></div>
		      <span class="price <?php echo $prices_args['row_price_class']; ?>"><?php echo $price; ?></span>
		    </div>
		    <?php if(is_singular('property')) echo $desc; ?>
		  </div> 
		<?php
	}
?>
</div>
<?php 
}
?>