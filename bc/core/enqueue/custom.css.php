<?php

header( "Content-type: text/css; charset: UTF-8" ); 


$BC_get_root_breakpoint = BC_get_root_breakpoint(); 


if( WPBC_get_option('color-scheme-advanced-settings') ){
	include('colors/customs.php');
}

/* 

	Main navbar size

*/ 


$WPBC_get_layout_customize = WPBC_get_layout_customize(); 




if( isset( $WPBC_get_layout_customize['main_navbar']['navbar_brand']['styles'] ) ){
	$styles = $WPBC_get_layout_customize['main_navbar']['navbar_brand']['styles'];

	if( $BC_get_root_breakpoint ){ 
		foreach($BC_get_root_breakpoint as $k=>$v){
			//echo 'O: '.$styles[$k]. "\n";
			//echo $k.' - '.$v. "\n"; 
			if(!empty($styles[$k])){
				if($v == 0){
					echo '#main-navbar .navbar-brand{ '.$styles[$k].' }'. "\n";
				} else {
					echo '@media (min-width: '.$v.') { #main-navbar .navbar-brand{ '.$styles[$k].' } }'. "\n";
				}
			} 
		} 
	}  
}