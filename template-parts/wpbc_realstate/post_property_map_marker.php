<?php
$property_id = !empty($property->ID) ? $property->ID : get_the_ID();
$location = WPBC_get_field('property_location_map', $property_id);
if(!empty($location)){
?>
<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
	<h4><?php echo $location['address']; ?></h4>
</div>
<?php }else{ ?>
<?php } ?>