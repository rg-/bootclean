<?php

	$property = $args; 

	$classes = WPBC_tokko_get_property_single_classes($property); 

?>
<!-- property content -->
<div class="ui-property-container-row <?php echo $classes['row_class']; ?>">

	<div class="ui-property-content-col <?php echo $classes['content_col_class']; ?>">
		
		<?php do_action('tokko/development-single/content/col', $property ); ?> 

	</div>

	<div class="ui-property-content-aside <?php echo $classes['aside_col_class']; ?>">

		<?php do_action('tokko/development-single/content/aside', $property ); ?>

	</div>

</div>
<!-- property content END -->