<?php

$use_wpbc_pjax = apply_filters('wpbc/filter/pjax/installed', 0);

if($use_wpbc_pjax){

	function WPBC_is_pjax_enabled(){
		return apply_filters('wpbc/filter/pjax/enabled', 1);
	}

	include('wpbc_pjax/enqueue.php');
	include('wpbc_pjax/filters.php');
	include('wpbc_pjax/layout.php'); 

}