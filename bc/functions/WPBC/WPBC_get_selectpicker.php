<?php
if(!function_exists('WPBC_get_selectpicker')){
	function WPBC_get_selectpicker($args=array()){
		WPBC_get_template_part('components/selectpicker',$args);
	}
}