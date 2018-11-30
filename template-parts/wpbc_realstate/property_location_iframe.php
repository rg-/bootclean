<?php
$property_id = !empty($property->ID) ? $property->ID : get_the_ID();
$location_map = WPBC_get_field('property_location_iframe', $property_id); 

if(!empty($location_map)){ 
	$map_args = WPBC_property_location_iframe_args($property_id);  
	?>
<div class="property_location_iframe <?php echo $map_args['class']; ?>">
<?php
	// If ajax
	if(!empty($map_args['ajax'])){ 
		$ajax_map_wrapper_class = $map_args['ajax_map_wrapper_class'];
		$ajax_map_button_label = $map_args['ajax_map_button_label'];
		$ajax_map_button = '<span href="[data-ajax-target]" data-toggle="ajax-load" class="'.$map_args['ajax_map_button_class'].'">'.$ajax_map_button_label.'</span>'; 

		$ajax_map_button = $map_args['ajax_map_button_before'].$ajax_map_button.$map_args['ajax_map_button_after'];
		$parsed_map_args = wp_parse_args( $map_args, array() );
		$parsed_map_args = http_build_query($parsed_map_args, '', '&'); 
		echo do_shortcode('[WPBC_get_template_ajax class="'.$ajax_map_wrapper_class.'" args="'.$parsed_map_args.'" name="wpbc_realstate/google-map-iframe" type="toggle" target_content="#map-'.$property_id.'" label="" ]'.$ajax_map_button.'[/WPBC_get_template_ajax]');
		?> 
		<div class="ajax-map <?php echo $map_args['map_class']; ?>">
			<div id="map-<?php echo $property_id;?>" class="<?php echo $map_args['map_item_class']; ?>" class="image-cover" style="<?php echo $map_args['map_item_style']; ?>"></div>
		</div>
		<?php
	}else{

	// If default
?>

	<div class="embed-map <?php echo $map_args['map_class']; ?>">
		<?php WPBC_get_template_part('wpbc_realstate/google-map-iframe', $map_args); ?>
	</div>

<?php } ?>
</div>
<?php } ?>