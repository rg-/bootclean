<?php

function WPBC_tokko_property_features( $args=array(), $template='property' ){
		if(empty($args['property'])) return; 

		$def_features = apply_filters('wpbc/filter/tokko/property_features', array(), $args['property'], $template);
		 
		if(!empty($args['features'])){
			$features = $args['features'];
		}else{
			$features = $def_features;
		}

		if(!empty($args['include'])){
			$temp = array();
			foreach ($def_features as $key => $value) {
				foreach ($args['include'] as $k) {
					if($value['key'] == $k){
						$temp[] = $value;
					}
				}
			}
			$features = $temp;
		}

		foreach($features as $key => $value){ 

			$labels = array('','');
			if(!empty($value['labels'])){
				$labels = $value['labels'];
			} 

			$val = $args['property']->get_field($value['key']);
			$label = $labels[0];
			if($val>1 || $val==0) {
				$label = $labels[1];
			}
			if($val==0) $val = '--';

			$icon = '';
			if(!empty($value['icon'])){
				$icon = '<i class="icon '. $value['icon'] .'"></i>';
			}

			$pos = 'ivl'; // IconValueLabel

			if($pos == 'ivl') $text = $icon . $val .' '. $label;

			if($pos == 'vli') $text =  $val .' '. $label . ' ' . $icon;

			if($pos == 'lvi') $text =   $label . ' ' . $val . $icon;

			echo '<span class="feature feature-'.$value['key'].'">'. $text .'</span>';
		}
	}