<?php

	$property = $args; 

	$classes = WPBC_tokko_get_property_single_classes($property); 

	$id = $property->get_field('id');
	$reference_code = $property->get_field('reference_code');
	$address = $property->get_field('address'); 
	
?>
<div class="<?php echo $classes['row_class']; ?>">

	<div class="col-12 d-flex alig-items-center justify-content-end">
		<?php if( current_user_can('manage_options') || $debug ){  
			echo "<span class='mr-auto d-none d-lg-block'><a target='_blank' class='btn btn-success btn-sm px-2 py-1' href='https://www.tokkobroker.com/development/".$id."/'>Edit > tokkobroker.com/development/".$id."/</a></span>";
		}
		?>
		<a href="<?php $back_url = 'javascript:history.back()'; echo $back_url; ?>" class="btn btn-link btn-sm"><i class="icon-arrow-left mr-2"></i> VOLVER A RESULTADOS</a>
	</div> 

</div>

<div class="<?php echo $classes['row_class']; ?> align-items-end">

	<div class="<?php echo $classes['content_col_class']; ?>">

		<small class="ref text-primary font-size-12 mb-2 d-inline-block">REF. <span class="font-size-14"><?php echo $reference_code; ?></span></small>
		
		<h2 class="section-title xl m-0 d-flex align-items-end"><?php echo $property->get_field('name'); ?></h2>
		
	</div>

	<div class="<?php echo $classes['aside_col_class']; ?> text-right">
		<?php WPBC_get_template_part('wpbc_tokko/property-single/share', $property); ?>
		
	</div>

</div>

<hr class="border-primary gmt-1 gmb-2">