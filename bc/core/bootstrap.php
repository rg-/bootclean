<?php
require 'bootstrap/class-wp-bootstrap-navwalker.php'; 
require 'bootstrap/megamenu.php'; 
require 'bootstrap/template.php'; 
 

function _get_bootstrap_view_fx($atts, $content = null) {
	extract(shortcode_atts(array(
		"group" => 'accordions',
	), $atts));
	$out = '';
	ob_start(); 
	include(BC_ABSPATH.'/_views/_php/'.$group.'.php');
	$out = ob_get_contents();
	ob_end_clean();
	return $out; 
} 
add_shortcode('_get_bootstrap_view', '_get_bootstrap_view_fx');