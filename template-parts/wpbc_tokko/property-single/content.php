<?php

	$property = $args; 

	$classes = WPBC_tokko_get_property_single_classes($property); 

?>
<!-- property content -->
<div class="<?php echo $classes['row_class']; ?>">

	<div class="<?php echo $classes['content_col_class']; ?>">
		 
		<?php WPBC_get_template_part('wpbc_tokko/property-single/images', $property); ?>

		<?php WPBC_get_template_part('wpbc_tokko/property-single/features', $property); ?>

		<?php WPBC_get_template_part('wpbc_tokko/property-single/basic-info', $property); ?>

		<?php WPBC_get_template_part('wpbc_tokko/property-single/surfaces', $property); ?>

		<?php WPBC_get_template_part('wpbc_tokko/property-single/description', $property); ?>

		<?php WPBC_get_template_part('wpbc_tokko/property-single/services', $property); ?>

		<?php WPBC_get_template_part('wpbc_tokko/property-single/rooms', $property); ?>

		<?php WPBC_get_template_part('wpbc_tokko/property-single/aditionals', $property); ?>

	</div>

	<div class="<?php echo $classes['aside_col_class']; ?>">

		<?php WPBC_get_template_part('wpbc_tokko/property-single/prices', $property); ?>
		
		<?php WPBC_get_template_part('wpbc_tokko/property-single/map', $property); ?>

	</div>

</div>
<!-- property content END -->