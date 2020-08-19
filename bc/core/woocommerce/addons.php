<?php

$WPBC_woo_addon_user_profile_picture = apply_filters('wpbc/filter/woocommerce/addons/myaccount-user-profile-picture',false);
if($WPBC_woo_addon_user_profile_picture){
	include('addons/myaccount-user-profile-picture.php');
}
