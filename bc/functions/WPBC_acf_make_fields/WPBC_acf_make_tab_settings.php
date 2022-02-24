<?php

function WPBC_acf_make_tab_settings( $setting_field, $field_name, $title, $icon, $check='string', $not=''){
	
	if( isset($_GET['post']) ){ 
		$this_settings = WPBC_get_field($setting_field, $_GET['post']); 
	}else{
		$this_settings = false;
	}

	$tab_badge_class = 'wpbc-d-none';

	if( $check == 'string' ){ 
		if( $this_settings && $this_settings != $not ){ $tab_badge_class = ''; } 
	}

	if( $check == 'true_false' ){ 
		if( $this_settings ){ $tab_badge_class = ''; } 
	} 
 
 	if($this_settings==1){
 		$this_settings = 'ENABLED';
 	}

	$badge_title = 'Use: '.strtoupper($this_settings);

	$badge = '<small title="'.$badge_title.'" class="wpbc-tab-badge wpbc-badge success '.$tab_badge_class.'"><span class="dashicons dashicons-yes"></span></small>'; 

	$label = '<span class="wpbc-tab">'. $icon .' '. $title . $badge .'</span>';

	return WPBC_acf_make_tab_field(array(
		'key' => 'field_'.$field_name,
		'label' => $label,
		'placement' => 'top',
		));

}