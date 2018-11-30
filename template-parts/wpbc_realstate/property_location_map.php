<?php
$property_id = !empty($property->ID) ? $property->ID : get_the_ID();
$location_map = WPBC_get_field('property_location_map', $property_id);
echo "template-parts/wpbc_realstate/property_location_map";
if(!empty($location_map)){
?>
<div class="property_location_map">
	<div class="acf-map embed-responsive embed-responsive-16by9">
		<div class="marker" data-lat="<?php echo $location_map['lat']; ?>" data-lng="<?php echo $location_map['lng']; ?>">
			
			<h4><?php echo $location_map['address']; ?></h4>

		</div>
	</div>
</div>
<?php } ?>