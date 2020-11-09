<?php

	$property = $args;   
  
?>

<hr class="border-primary mt-4 mb-5">

<h3 class="section-subtitle md mb-4">Descripción</h3>

	<?php $description = $property->get_field('description'); ?>

	<p><?php echo apply_filters('the_content', $description); ?></p>

<br>