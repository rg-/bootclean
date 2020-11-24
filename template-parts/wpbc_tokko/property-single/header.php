<?php

	$property = $args; 

	$classes = WPBC_tokko_get_property_single_classes($property); 

	$id = $property->get_field('id');
	$reference_code = $property->get_field('reference_code');
	$address = $property->get_field('address');

	$type = $property->get_field("type")->name;
	$operations = $property->get_available_operations_names();
	$location = $property->get_field("location")->name;
	
?>
<div class="<?php echo $classes['row_class']; ?>">

	<div class="col-12 d-flex alig-items-center justify-content-end">
		<?php if( current_user_can('manage_options') || $debug ){  
			echo "<span class='mr-auto d-none d-lg-block'><a target='_blank' class='btn btn-success btn-sm px-2 py-1' href='https://www.tokkobroker.com/property/".$id."/'>Edit > tokkobroker.com/property/".$id."/</a></span>";
		}
		?>
		<a href="<?php $back_url = 'javascript:history.back()'; echo $back_url; ?>" class="btn btn-link btn-sm"><i class="icon-arrow-left mr-2"></i> VOLVER A RESULTADOS</a>
	</div> 

</div>

<div class="<?php echo $classes['row_class']; ?> align-items-end">

	<div class="<?php echo $classes['content_col_class']; ?>">

		<!--
		<p><?php echo 'publication_title: '. $property->get_field('publication_title'); ?></p>
		<p><?php echo 'real_address: '. $property->get_field('real_address'); ?></p>
		<p><?php echo 'address: '. $property->get_field('address'); ?></p>
		<p><?php echo 'fake_address: '. $property->get_field('fake_address'); ?></p>
		-->

		<small class="ref text-primary font-size-12 mb-2 d-inline-block">REF. <span class="font-size-14"><?php echo $reference_code; ?></span></small>

		<h2 class="section-title xl"><?php echo $address; ?></h2>
		<h3 class="font-size-16 mb-1 font-weight-600"><?php echo strtoupper(implode(" - ",$operations)); ?> / <?php echo strtoupper($type); ?> / <?php echo strtoupper($location); ?></h3>
		
	</div>

	<div class="<?php echo $classes['aside_col_class']; ?> text-right">
		<?php WPBC_get_template_part('wpbc_tokko/property-single/share', $property); ?>
		
	</div>

</div>

<hr class="border-primary gmt-1 gmb-2">