<?php
$social_defaults = array( 
	array(
		'id' => 'facebook',
		'icon_html' => '<i class="icon-facebook"></i>', 
		'title'=> 'Facebook'
	),
	array(
		'id' => 'twitter',
		'icon_html' => '<i class="icon-twitter"></i>', 
		'title'=> 'Twitter'
	),
	array(
		'id' => 'delicious',
		'icon_html' => '<i class="icon-delicious"></i>',  
		'title'=> 'Delicious'
	),
	array(
		'id' => 'digg',
		'icon_html' => '<i class="icon-digg"></i>',
		'title'=> 'Digg'
	), 
	array(
		'id' => 'stumbleupon',
		'icon_html' => '<i class="icon-stumbleupon"></i>',
		'title'=> 'Stumble'
	), 
	array(
		'id' => 'google-plus',
		'icon_html' => '<i class="icon-google-plus"></i>',
		'title'=> 'Google Plus'
	), 
	array(
		'id' => 'pinterest',
		'icon_html' => '<i class="icon-pinterest"></i>',
		'title'=> 'Pinterest'
	), 
);
$social_defaults = apply_filters('wpbc/filter/post/share/defaults', $social_defaults);   
$args = array( 
	// 'switch_label' => __('Share this publication', 'bootclean'), 
	// 'switch_icon' => '<i class="icon-share"></i>', 
	'social_defaults' => $social_defaults, 
); 
WPBC_post_share( $args ); 
?>