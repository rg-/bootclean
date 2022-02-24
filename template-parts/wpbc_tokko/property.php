<?php 

$property = $args;
 
$get_cover_picture = $property->get_cover_picture(); 
if(!empty($get_cover_picture)){
	$img = $get_cover_picture->thumb;
	$img_lg = $get_cover_picture->original;
}else{
	$img = get_stylesheet_directory_uri().'/images/theme/placeholder.png';
	$img_lg = $img;
}  

$id = $property->get_field('id');

$single_page = WPBC_get_field('field_wpbc_tokko_post_object_single_property','options');  
$propiedad_url = get_permalink($single_page).WPBC_get_tokko_rewrite_property_url($property);

$address = $property->get_field('address');
$publication_title = $property->get_field('publication_title'); 

$bathroom_amount = $property->get_field('bathroom_amount');
$room_amount = $property->get_field('room_amount');
$suite_amount = $property->get_field('suite_amount');
//_print_code($property->get_available_prices());
//_print_code($property->get_available_operations());

$operations = $property->get_available_operations_names(); 
 
//echo 'Operations: '.implode(' - ', $operations);
//echo '<br>';
//echo 'Type: '.$property->get_field("type")->name; 
?>

<div class="card h-100 ui-tokko-card" data-is-inview="detect">
	<div class="card-header pt-1 pb-2">
		<small><u><?php echo strtoupper($property->get_field("type")->name); ?></u> EN <?php echo strtoupper($property->get_field("location")->name); ?></small>
	</div>
  
  <?php
    WPBC_build_lazyloader_image(array(
      'img_hi' => $img_lg, 
      'img_low' => $img,
      'type' => 'inview',
    ));
    ?> 

  <div class="card-body">
    <h5 class="card-title"><?php echo $address; ?></h5>
    <p class="card-text"><u><?php echo implode(' - ', $operations); ?></u></p>
    <p class="card-text"><?php echo $property->get_field('web_price') ? implode(" <br>",$property->get_available_operations()): "Consulte precio;" ?></p>
    <p>room_amount: <?php echo $room_amount; ?></p>
    <p>suite_amount: <?php echo $suite_amount; ?></p>
    <p>bathroom_amount: <?php echo $bathroom_amount; ?></p>
  </div>
  <div class="card-footer"> 
  	<a href="<?php echo $propiedad_url;?>" class="btn btn-primary">Ver más</a> - <small>REF: <?php echo $property->get_field('reference_code'); ?></small>
  </div>
</div>