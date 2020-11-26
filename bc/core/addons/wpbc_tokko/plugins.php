<?php

/*

	Contact Form 7 addons

*/

if(function_exists('wpcf7_add_shortcode')){

	add_shortcode('get_tokko_property_id', 'get_tokko_property_id_FX');

	function get_tokko_property_id_FX() {
	    //if (!is_array($tag)) return '';

	    //$name = $tag['name'];
	    //if (empty($name)) return '';

	    $out = '';

	    $property_id = get_query_var('property_id', null);  
			if(empty($property_id)){
				$property_id = $_GET['property_id'];
			} 
	    if(!empty($property_id)){
	    	$out = '<input type="hidden" name="get_tokko_property_id" value="'.$property_id.'">';
	    }
	    
	    return $out;
	}

	add_filter( 'wpcf7_special_mail_tags', 'PBC_wpcf7_do_shortcodes_mail_tag', 10, 3 );
	function PBC_wpcf7_do_shortcodes_mail_tag( $output, $name, $html ) {
		if ( 'get_tokko_property_id' == $name )
			$output = do_shortcode( "[$name]" );
	 
		return $output;
	}

}