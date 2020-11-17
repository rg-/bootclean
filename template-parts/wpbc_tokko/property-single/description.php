<?php

	$property = $args;   
  
  $description = $property->get_field('description');

  if(!empty($description)){
?> 

<div class="ui-property-content-row ui-description-row">
	
	<h3 class="section-subtitle md mb-4">Descripción</h3>

	<p><?php echo apply_filters('the_content', $description); ?></p>

</div>

<?php } ?>