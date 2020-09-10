<?php  

$params = WPBC_layout__main_footer_defaults(); 

$use_from_options = $params['use_from_options'];
$use_template = $params['use_template']; 
$use_custom_template = $params['use_custom_template'];  
$template_id = $params['template_id'];  

if( !empty($use_custom_template) ){
	echo do_shortcode('[WPBC_get_template id="'.$use_custom_template.'"]'); 
}else{
	if( false == $use_from_options ){
		// echo "<br>USE WPBC_get_component<br>"; 
		WPBC_get_component('wp-footer', $params);
	}else{
		if( false != $use_template ){
			// echo "<br>USE WPBC_get_template<br>";
			echo do_shortcode('[WPBC_get_template id="'.$use_template.'"]'); 
		}else{
			// echo "silence is golden... they say, who are they? mmmm";  
		}
	}
} 