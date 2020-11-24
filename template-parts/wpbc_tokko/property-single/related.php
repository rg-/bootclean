<?php
$property = $args; 
$classes = WPBC_tokko_get_property_single_classes($property); 

$operations = $property->get_available_operations_object();
$related_operations = array();
foreach ($operations as $key => $value) {
	$related_operations[] = $value['id']; 
}
$related_operations = implode( ',', $related_operations ); 

$related_type = array();
$related_type[] = $property->get_field("type")->id; 
$related_type = implode( ',', $related_type );
 
?>

<div class="ui-tokko-property-related <?php echo $classes['content_related_class']; ?>">

	<div class="ui-tokko-property-container <?php echo $classes['container_related_class']; ?>">

		<div class="row gmb-3">

			<div class="col-12"> 
				<h2 class="section-title xl m-0 d-flex align-items-center">Propiedades similares <i class="icon-circle-star text-primary xl ml-auto"></i></h2>
			</div>

		</div>   

	<?php  

		 $filters = array();  
		 WPBC_get_template_part('wpbc_tokko/properties', array(
  
			'operation_types' => $related_operations,
			'property_types' => $related_type,
			'localizations' => null,
			'order_by' => 'random',
			'order' => 'desc',
			'limit' => 3,
			'pagination' => false,
			'result_detail' => false, 
			'filter_options' => $filters,  

		));

		?>

	</div>

</div>