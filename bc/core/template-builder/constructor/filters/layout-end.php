<?php

add_action('wpbc/layout/end', function($out){

	global $post;
	if(isset($_GET['post'])){
		$post = get_post($_GET['post']);
		$post_id = $post->ID;
	}
	$post_id = $post->ID;

	if(is_singular()){
		if ( have_posts() ) {
			while ( have_posts() ) { 
				the_post();
				$post_id = get_the_ID();
			}
		} 
		do_action('wpbc/layout/acf_form', $post_id); 
	}

	if( is_user_logged_in() && current_user_can( 'manage_options' ) ){

		$template = WPBC_get_template();
		$post_type = get_post_type();
		 
		$layout = WPBC_get_layout_structure_build_layout();
		$locations = WPBC_get_layout_locations(); 
		$using_settings = WPBC_get_layout_using_settings('main_container');

		$custom_layout_locations = WPBC_get_option('custom_layout_locations__enable');
		$custom_layout_locations = !empty($custom_layout_locations) ? 'YES' : 'NO';


		$layout_defaults = WPBC_layout_struture__defaults();
		$layout_args = WPBC_filter_layout_structure_build( $layout_defaults );
	 
		$container_type = $layout_args['main_container'][$layout]['container_type']; 

		$content_areas = WPBC_get_main_container_max_content_areas();

		$out = '<span id="wpbc_layout_debug">';

		$out .= '$post_id: <b>'.$post_id.'</b> ';

		$out .= '| $post_type: <b>'.$post_type.'</b> ';

		$out .= '| $template: <b>'.$template.'</b> ';
		
		$out .= '| $layout: <b>'.$layout.'</b> ';  

		$out .= '| $container_type: <b>'.$container_type.'</b> ';

		$out .= '| <u>main_container</u> > $using_settings: <b>'.$using_settings.'</b> ';

		$out .= '| <u>Custom layout locations</u>  <b>'. $custom_layout_locations .'</b> ';

		$out .= '</span>';

		echo $out; 
	
	}

}, 10, 1); 