<?php  

$params = WPBC_layout__main_footer_defaults();  

$use_from_options = $params['use_from_options'];
$use_template = $params['use_template']; 
$use_custom_template = $params['use_custom_template'];  
$template_id = $params['template_id'];  

// New v12

$post_id = WPBC_layout__get_id();
	
	// Defaults
	$footer_use = true;
	$footer_template_type = 'default';

	// From settings
		$settings_footer_use = WPBC_get_theme_settings('footer__use');
		if( isset($settings_footer_use) ) $footer_use = $settings_footer_use;
		$settings_footer_template_type = WPBC_get_theme_settings('footer_template_type');
		if( isset($settings_footer_template_type) ) $footer_template_type = $settings_footer_template_type;

	$footer_template = WPBC_get_theme_settings('footer_template');
	$footer_template_part = WPBC_get_theme_settings('footer_template_part');
	$footer_custom_html = WPBC_get_theme_settings('footer_custom_html');
	

	// From pages/taxonomy/etc
	if(is_page()){
		$layout_footer__use = WPBC_get_field('layout_footer__use', $post_id);
		if(isset($layout_footer__use)){
			$footer_use = $layout_footer__use;
			$layout_footer_template_type = WPBC_get_field('layout_footer_template_type', $post_id); 
			if($layout_footer_template_type!='default'){  
				$footer_template_type = $layout_footer_template_type; 
				$footer_template = WPBC_get_field('layout_footer_template', $post_id); 
				$footer_template_part = WPBC_get_field('layout_footer_template_type', $post_id); 
				$footer_custom_html = WPBC_get_field('layout_footer_template_type', $post_id); 
			}
		} 
	}

if($footer_use){  	
	
	if( $footer_template_type == 'default' ){

		WPBC_get_component('wp-footer', $params);
	}

	if( $footer_template_type == 'template' ){
		echo do_shortcode('[WPBC_get_template id="'.$footer_template.'"]'); 
	}

	if( $footer_template_type == 'template-part' ){ 
		echo do_shortcode('[WPBC_get_template name="theme/'.$footer_template_part.'"]'); 
	}

	if( $footer_template_type == 'custom' ){
		echo do_shortcode($footer_custom_html);
	}

}

/*
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
			// echo "silence is golden...";  
		}
	}
} 
*/