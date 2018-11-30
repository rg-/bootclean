<?php

/* 

	Color Variants

 */  
 
$bootstrap_variables_colors = WPBC_get_custom_bootstrap_variables_colors();
$wpbc_customs = '';
$wpbc_customs_classes = '';
$wpbc_customs_variants = '';

function WPBC_replace_helper($var_name, $std){
	
	if (strpos($std, 'WPBC_VALUE') !== false || empty($std) ) {
		$value = 'var('.$var_name.')!important';
		return str_replace('WPBC_VALUE',$value,$std);
	}else{
		return $std;
	} 
}

function WPBC_make_root_base_name($name){
	//$var_name = '--wpbc-custom--'.$name.'';
	// Replace the ones from root.css
	$var_name = '--'.$name.'';
	return $var_name;
}
 
function WPBC_make_custom_variant__btn($args, $name, $value){
	$out = '';
	$var_name = WPBC_make_root_base_name($name);
	//$std = str_replace('WPBC_VALUE',$args['value'],$value['std']):
	$std = WPBC_replace_helper($var_name, $value['std']);
	$hover = WPBC_replace_helper($var_name, $value['hover']);
	// For .btns 
	$out .= '.btn-'.$name.'{' . "\n";
		$out .= $std . "\n"; 
	$out .= '}' . "\n";
		
		$out .= '.btn-'.$name.':hover{' . "\n";
			$out .= $hover . "\n"; 
		$out .= '}' . "\n"; 
	
	return $out;
} 
 

if( !empty($bootstrap_variables_colors) ){

	foreach($bootstrap_variables_colors as $var => $args){ 
		 
		$value = $args['value'];
		$std = $args['std'] ? $args['std'] : $args['value']; 
		$var_name = WPBC_make_root_base_name($var);
		
		
		//$std = str_replace('WPBC_VALUE', 'var('.$var_name.')' ,$std);  
		
		$std = WPBC_replace_helper($var_name, $std);
		
		if(!empty($args['apply'])){ 
			$wpbc_customs_classes .= $args['apply'].'{'.$std.'}' . "\n";
		}else{
			
			$wpbc_customs .= $var_name.': '.$value.';' . "\n"; 
			
		}
		
		if( !empty($args['variants']) ){ 
			$variants = $args['variants'];
			foreach($variants as $variant=>$value){ 
				if($variant=='btn'){ 
					$wpbc_customs_classes .= WPBC_make_custom_variant__btn($args, $var, $value); 
				}
				 
			}
		}
		
	} 
	
	echo "\n"; 
	echo "/*
 * Custom Color CSS Variables
 */";
	echo "\n";
	echo "\n"; 
	
	echo ':root {' . "\n";
	echo $wpbc_customs . "\n";
	echo '}' . "\n";
	
	echo "/*
 * Custom Color CSS Variants
 */";
	echo "\n";
	echo $wpbc_customs_classes . "\n";
	
	

	
}



echo "\n";
echo "/*
 * BC_get_root_colors ->  wpbc_option_color_[COLOR]
 */";
echo "\n";
 
$colors = BC_get_root_colors(); 
$variants_background = array(
	'.bg-',
	'.badge-'
);
$variants_colors = array(
	'.text-'
);
if(!empty($colors)){
	
	
	echo "\n";
	echo "/* btns */";
	echo "\n";
	echo "\n";
	foreach($colors as $k => $v){
			$k = str_replace('--','',$k);
			
			$v = WPBC_get_option('wpbc_option_color_'.$k); 
			if(has_filter('WPBC_get_custom_variable_color_background__'.$k)){
				$v = apply_filters('WPBC_get_custom_variable_color_background__'.$k, $v,10, 1);
			}
			
			// echo '.btn-'.$k.'{background-color:'.$v.'!important;}' . "\n";
			// echo '.btn-'.$k.'{border-color:'.$v.'!important;}' . "\n";
			
			if(has_filter('WPBC_get_custom_variable_color_hover__'.$k)){
				$v = apply_filters('WPBC_get_custom_variable_color_hover__'.$k, $v,10, 1);
				// echo '.btn-'.$k.':hover{background-color:'.$v.'!important;}' . "\n";
				// echo '.btn-'.$k.':hover{border-color:'.$v.'!important;}' . "\n";
			}
			
		}
	
	echo "\n";
	echo "/* background-color */";
	echo "\n";
	echo "\n";
	foreach($variants_background as $variant){
		foreach($colors as $k => $v){
			$k = str_replace('--','',$k);
			$v = WPBC_get_option('wpbc_option_color_'.$k); 
			if(has_filter('WPBC_get_custom_variable_color_background__'.$k)){
				$v = apply_filters('WPBC_get_custom_variable_color_background__'.$k, $v, 10, 1);
			}
			// echo $variant.$k.'{background-color:'.$v.'!important;}' . "\n";
		}
	}
	
	
	echo "\n";
	echo "/* text-color */";
	echo "\n";
	echo "\n";
	foreach($variants_colors as $variant){
		foreach($colors as $k => $v){
			$k = str_replace('--','',$k);
			$v = WPBC_get_option('wpbc_option_color_'.$k); 
			$v = apply_filters('WPBC_get_custom_variable_color__'.$k, $v,10, 1);
			// echo $variant.$k.'{color:'.$v.'!important;}' . "\n";
		}
	}
	
}