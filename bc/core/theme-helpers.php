<?php

/*

	theme-helpers

*/

// Global array to hold all the thing

global $bootclean_admin_filters;
$bootclean_admin_filters = array();

include('theme-helpers/filters.php');
/*

	Insert data into array like:

	- First parameter will be the group name.
	- The filter base will prepend the sub_filters if used.

	BC_set_bootclean_filters( 'excerpt', array(
		
		'WPBC_excerpt' => array( // filter/function name base
			
			'description' => 'Enable/Disable custom Excerpt', 
			'defaults' => '__return_true',
			'inc' => __FILE__,
			
			'sub_filters' => array( // sub filters/functions name bases
				'defaults' => array(
					'description' => 'Filter defaults values',
					'defaults' => 'Array() $defaults'
				),
				'args' => array(
					'description' => 'Filter after wp_parse_args defaults',
					'defaults' => 'Array() $defaults'
				)
			
			)
		)
		
	));

*/
function BC_set_bootclean_filters($group, $arr){
	global $bootclean_admin_filters;
	$new = array(
		$group => $arr
	);
	$bootclean_admin_filters = array_merge_recursive($bootclean_admin_filters, $new); 
}
/*
	Get the data, as group or all
*/
function BC_get_bootclean_filters($group=''){
	global $bootclean_admin_filters;
	if(!$group) {
		return $bootclean_admin_filters;
	}else{
		if(isset( $bootclean_admin_filters[$group] )){
			return $bootclean_admin_filters[$group];
		}
	}
} 

/*

	Shortcodes

*/

function _BC_build_filter_table_html($group,$test){
	
	if( isset($group) && isset($test) ){
		
		$out = '<div class="pt-4">'; 
		
		$out .= '<table class="table table-dark">';
		
		$out .= '<thead><tr>';  
			$out .= '<th><small>Filters for group: <b  class="p-1 bg-secondary">'.$group.'</b></small></th>';
			$out .= '<th><small>Description</small></th>'; 
			$out .= '<th><small>Defaults</small></th>'; 
		$out .= '</tr></thead>';
		
		$out .= '<tbody>';
		
		foreach($test as $k=>$v){  
			
			$out .= '<tr>'; 
			$out .= '<td colspan="3" class="p-0">';
			$out .= '<table class="tableX table-dark table-borderless"><tbody><tr>';

				$out .= '<td>';
				$out .= $k;
				$out .= '</td>';
				$out .= '<td>';
					$out .= $v['description'];
				$out .= '</td>';
				$out .= '<td>';
					$out .= $v['defaults'];
				$out .= '</td>';

			$out .= '</tr></tbody></table>';
			$out .= '</td>';

			$out .= '</tr>';
		
			$sub_filters = $v['sub_filters'];
			foreach($sub_filters as $kk=>$vv){
				$out .= '<tr>'; 

					$out .= '<td colspan="3" class="p-0">';

					$out .= '<table class="tableX table-dark table-borderless"><tbody><tr>';
						$out .= '<td>';
							$out .= $k.'__'.$kk.'';
						$out .= '</td>';
						$out .= '<td>';
							$out .= $vv['description'];
						$out .= '</td>';
						$out .= '<td>';
							$out .= $vv['defaults'];
						$out .= '</td>';
					$out .= '</tr></tbody></table>';

					$out .= '</td>';

					
				$out .= '</tr>';
			}
			
			
			$out .= '<tr>'; 
				$out .= '<td colspan="3">';
				$inc = str_replace('C:\xampp\htdocs\_www\_BC_builder_v4\_WPMU\wordpress\wp-content\themes\bootclean','',$v['inc']);

	$github_base = 'https://github.com/rg-/bootclean/blob/master';
	$inc = str_replace('\\', '/', $inc);
	$href = $github_base.$inc;
				$out .= '<small class="p-1 bg-warning text-dark"><small style="opacity:.6;">Above used in: </small><a href="'.$href.'" target="_blank">'.$inc.'</a></small>';
				$out .= '</td>';
			$out .= '</tr>';
			
		}
		$out .= '</tbody>';
		 
		$out .= '</table>';
		
		$out .= '</div>';
		
		return $out;
		
	}
	
}

// Just one table by group name

function _BC_build_filter_table_FX($atts, $content = null) {
	extract(shortcode_atts(array(
		"group" => '',
	), $atts));
	if(!empty($group)) $test = BC_get_bootclean_filters($group); 
	$out = '';
	if(isset($test)){ 
		$out = _BC_build_filter_table_html($group,$test); 
	} 
	return $out; 
} 

add_shortcode('_BC_build_filter_table', '_BC_build_filter_table_FX');

// All the tables

function _BC_build_filter_table__all_FX(){
	
	$all = BC_get_bootclean_filters();
	if(isset($all)){
		$out = '';
		foreach($all as $k=>$test){ 
			$out .= _BC_build_filter_table_html($k,$test);
		}
		return $out;
	}
	
	
}
add_shortcode('_BC_build_filter_table_all', '_BC_build_filter_table__all_FX');