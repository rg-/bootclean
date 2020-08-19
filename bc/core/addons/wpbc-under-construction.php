<?php


$under_construction_enable = apply_filters('wpbc/filter/under_construction/enable',1);

if($under_construction_enable){

	add_action('bc_admin_mainteneance_title', function(){

		return "OP";

	});

}