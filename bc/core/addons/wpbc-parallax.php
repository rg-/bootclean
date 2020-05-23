<?php
/*

	https://github.com/wagerfield/parallax

	Parallax Engine that reacts to the orientation of a smart device.

*/
$use_wpbc_parallax = apply_filters('wpbc/filter/parallax/installed', 0);

if($use_wpbc_parallax){

	function WPBC_is_parallax_enabled(){
		return apply_filters('wpbc/filter/parallax/enabled', 1);
	}

	include('wpbc_parallax/enqueue.php'); 

}