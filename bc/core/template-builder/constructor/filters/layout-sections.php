<?php

add_filter('wpbc/filter/layout/sections', function($sections){ 
	$sections = array(
		'main_navbar' => array(),
		'main_pageheader' => array(),
		'main_container' => array(), 
		'main_footer' => array(),
	);   
	return $sections;  
},10,1);