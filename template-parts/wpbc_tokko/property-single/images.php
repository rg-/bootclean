<?php

$property = $args;

$property_images = array();

$get_cover_picture = $property->get_cover_picture(); 

if(!empty($get_cover_picture)){
	$property_images[] = $get_cover_picture;
}
	/* EJ
	[description] => 
  [image] => https://static.tokkobroker.com/pictures/93858421518296491139624358036322049268853486855801252101544392153978241403671.jpg
  [is_blueprint] => 
  [is_front_cover] => 1
  [order] => 0
  [original] => https://static.tokkobroker.com/original_pictures/93858421518296491139624358036322049268853486855801252101544392153978241403671.jpg
  [thumb] => ht
	*/

$get_pictures = $property->get_pictures();
if(!empty($get_pictures)){
	foreach ($get_pictures as $key => $value) {
		$property_images[] = $value;
	} 
}
// _print_code($property_images);


$slick_id = 'slick-property-'.uniqid();
$slick = array(
	'dots' => false,
	'arrows' => false,
	'infinite' => false,
	'adaptiveHeight' => false,
	'accessibility' => false, 
); 
$slick = json_encode($slick); 
 
if(empty($property_images)) return;

?>

<div class="ui-property-content-row ui-images-row">

<div class="ui-slick-property">

	<div class="embed-responsive embed-responsive-4by3">
 
		<div class="embed-responsive-item bg-light ">

			<div id="<?php echo $slick_id; ?>" data-has-pager="true" class=" slick-embed-responsive theme-slick-slider shadow-lg" data-slick='<?php echo $slick; ?>' >

				<?php foreach($property_images as $image ){ ?> 
						
							<?php 
							WPBC_build_lazyloader_image(array(
								'img_hi' => $image->original, 
								'img_low' => $image->thumb,
								'type' => 'slick-onload',
							));
							?> 
							
				<?php } ?>

			</div>

		</div>

	</div> 

	<?php if(count($property_images)>1){ ?>
	<div class="ui-slick-pager">
		<button target="#<?php echo $slick_id; ?>" class="btn btn-icon prev" data-toggle="slick-prev">
	    <i class="icon-arrow-left"></i>
	  </button>
	  <span class="pager" data-pager="#<?php echo $slick_id; ?>">
			<span class="current">01</span>
			<i class="sep">/</i>
			<span class="total"><?php
			$total = count($property_images);
			if($total<10){
				$total = '0'.$total;
			}
			echo $total; 
			?></span>
		</span>
		<button target="#<?php echo $slick_id; ?>" class="btn btn-icon next" data-toggle="slick-next">
	    <i class="icon-arrow-right"></i>
	  </button>
	</div>
	<?php } ?>

</div>

</div>