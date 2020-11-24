<?php

	$property = $args;   
  
	$tags = $property->get_field('tags');

	$additionals = $property->get_tags_by_type(3);

	if(!empty($additionals)){
?>
 
<div class="ui-property-content-row ui-additionals-row">

<h3 class="section-subtitle md mb-4">Adicionales</h3>

<div class="row mt-3"> 
	<?php  
		
		foreach ($additionals as $key => $value) {
			?>
			<div class="col-sm-6 col-md-4">
				<p class="ui-property-tag has-icon"><i class="icon icon-plus sm text-primary"></i> <?php echo strtoupper($value->name); ?></p>
			</div>
			<?php
		}
	?>
</div>

</div>
<?php } ?>

<div id="cloned-map" class="ui-property-content-row ui-map-row">
</div>