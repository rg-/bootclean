<?php

$params = WPBC_layout__main_navbar_defaults();   

global $WPBC_VERSION; 
if ( version_compare( $WPBC_VERSION, '11.9.9', '>' ) ) { 

	// New v12 

		// From settings
		$visible = $params['visible'];
		$type = $params['type'];
		$template = $params['template'];
		$template_part = $params['template_part'];
		$custom_html = $params['custom_html'];

 
		$post_id = WPBC_layout__get_id();
		
		if(is_page()){

			$layout_main_navbar__customize = WPBC_get_field('layout_main_navbar__customize', $post_id);

			if(!empty($layout_main_navbar__customize)){

				$type = WPBC_get_field('layout_main_navbar__type', $post_id); 
				if($layout_footer_template_type!='default'){ 
					$template = WPBC_get_field('layout_main_navbar__template', $post_id);
					$template_part = WPBC_get_field('layout_main_navbar__template_part', $post_id);
					$custom_html = WPBC_get_field('layout_main_navbar__custom_html', $post_id);
				}
			}

			$layout_main_navbar__use = WPBC_get_field('layout_main_navbar__use', $post_id);

			if( isset($layout_main_navbar__use) ){ 
				$visible = $layout_main_navbar__use;
			}
			
		}

	if($visible){ 
		
		if( $type == 'default' ){ 
			WPBC_get_component('wp-navbar', $params);
		}

		if( $type == 'template' ){
			echo do_shortcode('[WPBC_get_template id="'.$template.'"]'); 
		}

		if( $type == 'template-part' ){ 
			echo do_shortcode('[WPBC_get_template name="theme/'.$template_part.'"]'); 
		}

		if( $type == 'custom' ){
			echo do_shortcode($custom_html);
		}

	}


}else{


	// OBSOLETE 

	$use_from_options = $params['use_from_options'];
	$use_template = $params['use_template'];
	$use_custom_template = $params['use_custom_template'];
	if( !empty($use_custom_template) ){
		echo do_shortcode('[WPBC_get_template id="'.$use_custom_template.'"]'); 
	}else{
		if( false == $use_from_options ){
			//echo "<br>USE WPBC_get_component<br>";
			WPBC_get_component('wp-navbar', $params);
		}else{
			if( false != $use_template ){
				// echo "<br>USE WPBC_get_template<br>";
				echo do_shortcode('[WPBC_get_template id="'.$use_template.'"]'); 
			}else{
				// echo "silence is golden... they say, who are they? mmmm";  
			}
		}
	} 

}