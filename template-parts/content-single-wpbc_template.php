<?php 
	$post_id = get_the_ID();
	$post_class = apply_filters('wpbc/filter/post/loop/class',''); 
	WPBC_get_template_builder_rows($post_id,'','main-content'); 
?>