<?php

/*

	TODOING, basic code ready like: http://test.bootclean.loc/wp-json/test/v1/date

*/

$use_wpbc_rest_api = apply_filters('wpbc/filter/rest_api/installed', 0);

if($use_wpbc_rest_api){
	add_action('rest_api_init', function(){
	    foreach([
	        'Test'
	    ] as $endpoint) {
	        require_once( __DIR__."/wpbc_rest_api/{$endpoint}Controller.php");
	        $controller_class = "{$endpoint}Controller";
	        $controller = new $controller_class();
	        $controller->register_routes();
	    }
	});
}