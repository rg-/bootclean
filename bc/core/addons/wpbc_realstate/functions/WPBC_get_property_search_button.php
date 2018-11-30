<?php
function WPBC_get_property_search_button($args){

	$defaults = array(
		'shortcode_atts' => '',
	);
	$args = shortcode_atts($defaults, $args); 
	$shortcode_atts = $args['shortcode_atts'];

	$load = '#'.$shortcode_atts['ajax_target_id'];
	$nav = '#'.$shortcode_atts['ajax_nav_id'];
	
	ob_start();
	$out = '';
	?><button data-ajax-load="<?php echo $load; ?>" data-ajax-nav="<?php echo $nav; ?>" data-ajax-form-btn="" class="btn btn-primary btn-block"><?php echo __('Search','bootclean'); ?></button><?php
	$out .= ob_get_contents();
	ob_end_clean();   
	return $out; 

}