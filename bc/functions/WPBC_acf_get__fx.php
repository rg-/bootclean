<?php


function WPBC_acf_get__choices__font_style($default_value=false){

	$choices = array( 
		'normal' => 'normal',
		'italic' => 'italic',
		'oblique' => 'oblique', 
	);
	if($default_value){
		return array('normal' => 'normal');
	}else{
		return $choices;
	} 

}

function WPBC_acf_get__choices__font_generic_family($default_value=false){

	$choices = array( 
		'sans-serif' => 'sans-serif',
		'serif' => 'serif',
		'cursive' => 'cursive', 
		'fantasy' => 'fantasy', 
		'monospace' => 'monospace', 
	);
	if($default_value){
		return array('sans-serif' => 'sans-serif');
	}else{
		return $choices;
	} 

}

function WPBC_acf_get__choices__font_weight($default_value=false){

	$choices = array( 
		'normal' => 'normal',
		'bold' => 'bold',
		'100' => '100',
		'200' => '200',
		'300' => '300',
		'400' => '400',
		'500' => '500',
		'600' => '600',
		'700' => '700',
		'800' => '800',
		'900' => '900', 
	);
	if($default_value){
		return array('normal' => 'normal');
	}else{
		return $choices;
	} 

}