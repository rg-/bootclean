<?php



function WPBC_get_tokko_properties_FX($atts, $content = null){
	$atts = shortcode_atts(array(), $atts);
	ob_start(); 
	WPBC_get_template_part('wpbc_tokko/properties', $atts);
	$content = ob_get_contents();
	ob_end_clean();
	return $content; 
}
add_shortcode('WPBC_get_tokko_properties','WPBC_get_tokko_properties_FX');


function WPBC_get_tokko_form_FX($atts, $content = null){
    $atts = shortcode_atts(array(), $atts);
    ob_start(); 
    WPBC_get_template_part('wpbc_tokko/form', $atts);
    $content = ob_get_contents();
    ob_end_clean();
    return $content; 
}
add_shortcode('WPBC_get_tokko_form','WPBC_get_tokko_form_FX');

/*

	Experiments

*/
function WPBC_tokko_do_search($url=null){
	$search_results = '';
    if ($url == null){
        echo "No search parameters were given";
    }else{
        try { 
            $url = str_replace(" ","%20",$url); 
            $cp = curl_init();
            curl_setopt($cp, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($cp, CURLOPT_URL, $url);
            curl_setopt($cp, CURLOPT_TIMEOUT, 60);
            $search_results = json_decode(curl_exec($cp));
            curl_close($cp);
        } catch (Exception $e) {
            $search_results = null;
            echo "Error executing query.";
        }
    }
    return $search_results;
}

function WPBC_tokko_get_properties($search_results){
    $properties = array();
    if ($search_results == null){
        return $properties;
    }else{
        foreach ($search_results->objects as $prop) {
            array_push($properties, new TokkoProperty('object', $prop));
        }
        return $properties;
    }
}