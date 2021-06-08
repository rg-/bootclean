<?php WPBC_flex_layout_start(); ?>

<?php  
	$options = WPBC_get_flex_layout_field('options'); 
	$call = WPBC_get_acf_call_to_action_group($options, 'field_', false);  
	if(!empty($call)){
		echo $call; 
	}
?>

<?php WPBC_flex_layout_end(); ?>