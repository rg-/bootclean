<?php
	
	$development = $args;

	$api_key = tokko_config('api_key'); 
	$auth = new TokkoAuth($api_key); 

	/*
	
	address
	branch -> obj
	construction_date
	construction_status
	custom_tags -> array
	description

	*/

	// _print_code($development);


?>

<?php
$get_cover_picture = $development->get_cover_picture(); 
if(!empty($get_cover_picture)){
	$img = $get_cover_picture->thumb;
	$img_lg = $get_cover_picture->original;
}else{
	$img = get_stylesheet_directory_uri().'/images/theme/placeholder.png';
	$img_lg = $img;
}

$single_page = WPBC_get_field('field_wpbc_tokko_post_object_single_development','options');  
$development_url = get_permalink($single_page).WPBC_get_tokko_rewrite_development_url($development);
?>

<div class="wpbc-tokko-development gpb-1 gmb-1" data-is-inview="detect">

	<div class="row">

		<div class="col-md-6">
			<div class="embed-responsive embed-responsive-4by3">
				<div data-is-inview-lazybackground="<?php echo $img_lg; ?>" class="embed-responsive-item image-cover" style="background-image: url(<?php echo $img; ?>);"></div>
			</div>
		</div>

		<div class="col-md-6">

			<h2 class="section-title"><?php echo $development->get_field('name') .' - '. $development->get_field('reference_code'); ?></h2>

			<?php $location = $development->get_field("location"); ?>
			<?php echo $location->name; ?>

			<?php $description = $development->get_field('description'); ?>

			<p><?php WPBC_excerpt(array(
				'text' => $description,
				'length' => 80,
				'permalink' => $development_url,
				)); ?></p>

		</div>

	</div>

</div>

<!--
<?php $development_properties = new TokkoProperty('development__id', $development->get_field('id'), $auth);
	$properties = $development_properties->get_development_properties(); 
	if(!empty($properties->objects)){ 
		foreach ($properties->objects as $key => $value) {
			?>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;>> <?php echo $value->name .' - '. $value->reference_code; ?></p>
			<?php
		}
	} ?>
	-->