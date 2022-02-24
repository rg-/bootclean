<?php

$WPBC_woo_addon_user_profile_picture = apply_filters('wpbc/filter/woocommerce/addons/myaccount-user-profile-picture',false);
if($WPBC_woo_addon_user_profile_picture){
	include('addons/myaccount-user-profile-picture.php');
}


$WPBC_woo_addon_ajax_add_to_cart = apply_filters('wpbc/filter/woocommerce/addons/ajax_add_to_cart',false);
if($WPBC_woo_addon_ajax_add_to_cart){
	include('addons/ajax_add_to_cart.php');
}