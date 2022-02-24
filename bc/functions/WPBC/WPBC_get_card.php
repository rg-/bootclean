<?php

if( !function_exists('WPBC_get_card') ){

	function WPBC_get_card($args=array()){

		WPBC_get_template_part('components/card',$args);
	
	}

}