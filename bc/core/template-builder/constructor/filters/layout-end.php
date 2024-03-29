<?php

add_action('wpbc/layout/end', function($out){  

	$show_wpbc_layout_debug = apply_filters('WPBC_layout_debug', 1); 

	if( is_user_logged_in() && current_user_can( 'manage_options' ) && !empty($show_wpbc_layout_debug) ){

		global $post;
		if(isset($_GET['post'])){ 
			$post = get_post($_GET['post']);
			$post_id = $post->ID;
		}
		if(!empty($post->ID)){
			$post_id = $post->ID;
		}
		global $wp_query;
		if(!empty($wp_query->is_posts_page)){
			$post_id = get_option('page_for_posts');
		}
		$post_type = get_post_type($post);
		if(is_single() && $post_type == 'post'){ 
			$post_id = get_option('page_for_posts');
		}

		$template = WPBC_get_template();

		// When no page for posts is selected, default home page looping posts
		if( empty($post_id) && $template = 'home-blog' ){
			$post_id = 0;
		}

		if(is_singular()){
			if ( have_posts() ) {
				while ( have_posts() ) { 
					the_post();
					$post_id = get_the_ID();
				}
			} 
			do_action('wpbc/layout/acf_form', $post_id); 
		} 

		
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

		$page_template = get_page_template_slug( $post_id );
		$out .= '| $template: <b>'.$page_template.'</b> ';
		$out .= '| $wp-template: <b>'.WPBC_get_template().'</b> ';
		
		$out .= '| $layout: <b>'.$layout.'</b> ';  

		$out .= '| $container_type: <b>'.$container_type.'</b> ';

		$out .= '| <u>main_container</u> > $using_settings: <b>'.$using_settings.'</b> ';

		$out .= '| <u>Custom layout locations</u>  <b>'. $custom_layout_locations .'</b> ';

		$out .= '</span>';

		echo $out; 
	
	}

}, 10, 1); 