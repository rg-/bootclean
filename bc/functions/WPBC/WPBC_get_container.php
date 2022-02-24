<?php

if( !function_exists('WPBC_get_container') ){

	function WPBC_get_container($args=array()){

		WPBC_get_template_part('components/container',$args);
	
	}

}