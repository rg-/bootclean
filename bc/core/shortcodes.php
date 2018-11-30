<?php

/*
	
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
				$out .= '<td>';
				$out .= $k;
				$out .= '</td>';
				$out .= '<td>';
					$out .= $v['description'];
				$out .= '</td>';
				$out .= '<td>';
					$out .= $v['defaults'];
				$out .= '</td>';
			$out .= '</tr>';
		
			$sub_filters = $v['sub_filters'];
			foreach($sub_filters as $kk=>$vv){
				$out .= '<tr>'; 
					$out .= '<td>';
						$out .= $k.'__'.$kk.'';
					$out .= '</td>';
					$out .= '<td>';
						$out .= $vv['description'];
					$out .= '</td>';
					$out .= '<td>';
						$out .= $vv['defaults'];
					$out .= '</td>';
				$out .= '</tr>';
			}
			
			
			$out .= '<tr>'; 
				$out .= '<td colspan="3">';
				$inc = str_replace('C:\xampp\htdocs\_www\_BC_builder_v4\_WPMU\wordpress\wp-content\themes','',$v['inc']);
				$out .= '<small class="p-1 bg-warning text-dark"><small style="opacity:.6;">Above used in: </small>'.$inc.'</small>';
				$out .= '</td>';
			$out .= '</tr>';
			
		}
		$out .= '</tbody>';
		 
		$out .= '</table>';
		
		$out .= '</div>';
		
		return $out;
		
	}
	
}
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
