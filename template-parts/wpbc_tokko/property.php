<?php

$property = $args;

/*
	get_cover_picture()
	stdClass Object
			(
			    [description] => 
			    [image] => 
			    [is_blueprint] => 
			    [is_front_cover] => 1
			    [order] => 1
			    [original] => 
			    [thumb] => 
			)

*/
$get_cover_picture = $property->get_cover_picture(); 
if(!empty($get_cover_picture)){
	$img = $get_cover_picture->thumb;
	$img_lg = $get_cover_picture->original;
}else{
	$img = get_stylesheet_directory_uri().'/images/theme/placeholder.png';
	$img_lg = $img;
} 

/*

	get_fields()

		address
		age
		
		bathroom_amount

		branch -> OBJ

		created_at
		deleted_at
		custom1 ??
		custom_tags -> () 

		description
		development
		development_excel_extra_data
		disposition

		expenses
		extra_attributes -> () 
		fake_address
		files -> () 
		floors_amount

		geo_lat
		geo_long
		gm_location_type
		
		id
		is_starred_on_web
		legally_checked
		location -> OBJ
				divisions -> OBJ id, name, resource_uri
				full_location
				id
				name
				parent_division
				short_location
				state

		occupation -> () 

		operations -> (
	
				OBJ (
					operation_type
					prices -> (
						
						OBJ(
							currency
							period
							price
						)

					) 
				)

		) 

		[producer] => stdClass Object
      (
          [cellphone] => ( 598) 98047772
          [email] => pablo@aispuru.com
          [id] => 10402
          [name] => Pablo Cuadrado Aispuru
          [phone] => ( 598) 44862433
          [picture] => https://static.tokkobroker.com/...
      )
		
		property_condition
		public_url
		publication_title
		real_address
		reference_code
		roofed_surface
		room_amount
		semiroofed_surface
		situation
		status
		suite_amount
		surface
		surface_measurement

		tags -> (
			OBJ (
				id
				name
				type
			)
		)

		toilet_amount
		total_surface
		transaction_requirements
		type -> (
			OBJ (
				code
				id
				name
			)
		)
		unroofed_surface
		videos -> ()
		web_price
		zonification


*/

$id = $property->get_field('id');
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
  <div class="embed-responsive embed-responsive-16by9">
		<div data-is-inview-lazybackground="<?php echo $img_lg; ?>" class="embed-responsive-item image-cover" style="background-image: url(<?php echo $img; ?>);"></div>
	</div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $address; ?></h5>
    <p class="card-text"><u><?php echo implode(' - ', $operations); ?></u></p>
    <p class="card-text"><?php echo $property->get_field('web_price') ? implode(" <br>",$property->get_available_operations()): "Consulte precio;" ?></p>
    <p>room_amount: <?php echo $room_amount; ?></p>
    <p>suite_amount: <?php echo $suite_amount; ?></p>
    <p>bathroom_amount: <?php echo $bathroom_amount; ?></p>
  </div>
  <div class="card-footer">
  	<a href="<?php echo $id; ?>" class="btn btn-primary">Ver más</a> - <small>REF: <?php echo $property->get_field('reference_code')?></small>
  </div>
</div>