<?php
function WPBC_get_property_reset_button($args){

	$defaults = array(
		'shortcode_atts' => '',
		'ajax_call' => '',
	);
	$args = shortcode_atts($defaults, $args); 
	$shortcode_atts = $args['shortcode_atts'];

	$load = '#'.$shortcode_atts['ajax_target_id'];
	$nav = '#'.$shortcode_atts['ajax_nav_id'];

	ob_start();
	$out = '';
	?><button data-ajax-load="<?php echo $load; ?>" data-ajax-call="<?php echo $args['ajax_call']; ?>" data-ajax-nav="<?php echo $nav; ?>" data-ajax-form-btn="reset" class="btn btn-default btn-block"><?php echo __('Reset','bootclean'); ?></button><?php
	$out .= ob_get_contents();
	ob_end_clean();   
	return $out; 

}