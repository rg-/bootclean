<?php
$development = $args; 
$classes = WPBC_tokko_get_property_single_classes($development); 
?>

<div class="ui-tokko-property-related <?php echo $classes['content_related_class']; ?>">

	<div class="ui-tokko-property-container <?php echo $classes['container_related_class']; ?>">

		<div class="row gmb-3">

			<div class="col-12"> 
				<h2 class="section-title xl m-0 d-flex align-items-center">Propiedades asociadas <i class="icon-circle-star text-primary xl ml-auto"></i></h2>
			</div>

		</div>   

	<?php  

		 $filters = array(); 
		 $filters[] = array('development__id', '=', $development->get_field('id'));
		 WPBC_get_template_part('wpbc_tokko/properties', array(
  
			'operation_types' => array(),
			'property_types' => array(),
			'localizations' => null,
			'order_by' => 'random',
			'order' => 'desc',
			'limit' => 3,
			'pagination' => false,
			'result_detail' => false, 
			'filter_options' => $filters, 

			'is_developments' => true,

		));

		?>

	</div>

</div>