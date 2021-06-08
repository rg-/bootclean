<?php WPBC_flex_layout_start(); ?>

<?php

	$area = WPBC_get_flex_layout_field('area'); 
 
	if ( !empty($area) && is_active_sidebar( $area ) ){
		dynamic_sidebar( $area );
	}

?>

<?php WPBC_flex_layout_end(); ?>