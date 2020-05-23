<?php
/*

	https://swup.js.org/

	Ajax load between pages and css transitions (like pjax but...)

*/
$use_wpbc_swup = apply_filters('wpbc/filter/swup/installed', 0);

if($use_wpbc_swup){

	function WPBC_is_swup_enabled(){
		return apply_filters('wpbc/filter/swup/enabled', 1);
	}
	function WPBC_use_swup_css(){
		return apply_filters('wpbc/filter/swup/usecss', 1);
	}
	function WPBC_use_swup_js(){
		return apply_filters('wpbc/filter/swup/usejs', 1);
	}

	include('wpbc_swup/enqueue.php');
	include('wpbc_swup/filters.php');
	include('wpbc_swup/layout.php'); 

}