<?php

if( !function_exists('WPBC_get_jumbotron') ){

	function WPBC_get_jumbotron($args=array()){

		WPBC_get_template_part('components/jumbotron',$args);
	
	}

}