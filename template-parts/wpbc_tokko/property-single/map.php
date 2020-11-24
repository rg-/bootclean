<?php

	$property = $args;   
	$geo_lat = $property->get_field('geo_lat'); 
	$geo_long = $property->get_field('geo_long'); 
	$gm_location_type = $property->get_field('gm_location_type');  

	if(empty($geo_lat) && empty($geo_long)) return;

?>
<div data-clone="#cloned-map" class="ui-property-content-row ui-map-row d-none d-md-block">

	<?php 
	$api_key = tokko_config('google_maps_api_key');
	$mapStaticUrl = 'https://maps.google.com/maps/api/staticmap?center=' . $geo_lat . ',' . $geo_long . '&zoom=16&channel=ZP&size=780x456&sensor=true&scale=2&key='. $api_key .'';


	$iframe_src = 'https://maps.google.com/maps?q=' . $geo_lat . ',' . $geo_long . '&hl=es&z=16&amp;output=embed&scale=2';
	?>
	<div class="embed-responsive embed-responsive-16by9">
		<div class="embed-responsive-item bg-white image-cover" style="background-image: url(<?php echo $mapStaticUrl; ?>);">

			<button type="button" data-modal-title="<?php echo $property->get_field('address'); ?>" data-modal-iframe-src="<?php echo $iframe_src; ?>" data-toggle="modal" data-target="#modal-mapa" class="h-100 w-100 btn"><i class="icon-circle-map xl text-primary"></i></button>
			
		</div>
	</div> 

</div> 