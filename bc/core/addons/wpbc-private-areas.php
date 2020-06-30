<?php
/*

	Enable private pages or content by user "suscriptor" role

*/
$use_wpbc_private_areas = apply_filters('wpbc/filter/private_areas/installed', 0);

if($use_wpbc_private_areas){ 

	include('wpbc_private_areas/init.php'); 

}