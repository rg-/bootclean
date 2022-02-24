<?php
if(!function_exists('WPBC_get_dropdown')){
	function WPBC_get_dropdown($args=array()){
		WPBC_get_template_part('components/dropdown',$args);
	}
}