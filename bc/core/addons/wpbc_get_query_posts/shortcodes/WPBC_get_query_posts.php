<?php

/*


	Like:

	[WPBC_get_query_posts query_string='posts_per_page=3'/]

*/

add_shortcode('WPBC_get_query_posts', 'WPBC_get_query_posts_FX'); 

function WPBC_get_query_posts_FX( $atts, $content = null) { 
	
	// Parsing shortcode args, this is not how wp use shortcodes by default, this way i can pass any paramenter and not just the ones defined here as defauts. That is why "wp_parse_args" in use.
	$shortcode_args = wp_parse_args( $atts, array() ); 

	// If no action passed, default here. This must be not changed, but just in case, use "action" param.
	if(empty($shortcode_args['action'])){
		$shortcode_args['action'] = 'get_query_posts';
	}
	if(empty($shortcode_args['target_id'])){
		$shortcode_args['target_id'] = WPBC_get_query_posts_default_target_id();
	}
	// print_r($atts);
	// USED??
	$ajax_action_url = admin_url('admin-ajax.php') . '/?action=' . $shortcode_args['action'];
 
	ob_start();  
	
	$use_as_search = !empty($shortcode_args['use_as_search']) ? $shortcode_args['use_as_search'] : '0';
	
	// The main query from shortcode args  
	$query = html_entity_decode( $shortcode_args['query_string'] );
	$query = str_replace('+', '%2B', $query); 

	$query = wp_parse_args( $query, array() );  
	
	// The main query filtered 
	
	$query = WPBC_get_query_posts_default_query($query); 

	$template_args = WPBC_get_query_posts_default_template_args($query);

	// Filter target_id or something like that for use it also same thing on fo
	if( !empty($shortcode_args['use_map']) || !empty($query['use_map']) ){
		$query['posts_per_page'] = '-1';

		$query['meta_query'][] = array(
		            'key' => 'property_location_map', 
		            'compare' => 'EXISTS',
		            'type' => 'CHAR',
		        );

		$template_args['use_map'] = $shortcode_args['use_map'] ? $shortcode_args['use_map'] : $query['use_map']; 
		$template_args['target_class'] = 'acf-map embed-responsive embed-responsive-16by9';
		$query['use_map'] = '1';
	}
	if( $shortcode_args['target_id'] ){
		$template_args['target_id'] = $shortcode_args['target_id'];
		$template_args['target_nav_id'] = $shortcode_args['target_id'].'-nav';
	}
	if( !empty($query['target_id']) ){
		$template_args['target_id'] = $query['target_id'];
		$template_args['target_nav_id'] = $query['target_id'].'-nav';
	}
	if(!empty($shortcode_args['target_no_wrapper'])){
		$template_args['target_no_wrapper'] = $shortcode_args['target_no_wrapper'];
	}

	//$_post_type = !empty($query['post_type']) ? $query['post_type'] : 'post';
	//$template_args['target_id'] = $template_args['target_id'].'-'.$_post_type;
	//$template_args['target_nav_id'] = $template_args['target_id'].'-nav'.'-'.$_post_type;

	// Filter here target_id and so on?? 

	if(!empty($query['search'])){ // DELETE
		$query['s'] = esc_attr($query['search']);
	} 

	if(!empty($query['p_search'])){
		$query['s'] = esc_attr($query['p_search']);
	} 
	if(!empty($query['p_order'])){
		$query['order'] = esc_attr($query['p_order']);
	}
	if(!empty($query['p_orderby'])){
		$query['orderby'] = esc_attr($query['p_orderby']);
	}
	
	$query_posts = new WP_Query( $query ); 

	if(!empty( $_GET['pagename'] )){
		//unset($query['pagename']);
		//unset($query['s']);
		//unset($query['search']);
		//unset($query['order']);
		//unset($query['orderby']);
	}
	/*
	echo "query<pre>";
	print_r($query);
	echo "</pre>";
	echo "template_args<pre>";
	print_r($template_args);
	echo "</pre>";
	*/

	WPBC_set_query_posts($template_args, $query); 
  
  	// if use_as_search passed as param, can be on shortcode or query_string
	if(!empty($use_as_search)){ 
		// If use as search do not load rest of template, the important thing here is the WPBC_set_query_posts so the form could use same parameters.
		$out = ob_get_contents();
		ob_end_clean(); 
		return $out;
	}

	if( $query_posts->have_posts() ){ 

		if(!empty($query['debug'])){ 
			echo "<pre>";
			print_r($query_posts);
			echo "</pre>";
			echo "<pre id='ajax-debug' class='small'></pre>"; 
		}

		// The Map ??? USED WHERE????
		if(!empty($template_args['use_map'])){
			$inc_map = WPBC_include_template_part('wpbc_realstate/properties_map'); 
			if(!empty($inc_map)){  
				//include ($inc_map);  
			}
		}
		// The loop
		//global $WPBC_get_query_posts;
		//print_r($WPBC_get_query_posts);
		$inc = WPBC_include_template_part('wpbc_get_query_posts/get_query_posts'); 
		if(!empty($inc)){  
			include ($inc);  
		}

		// The pagination
		$inc = WPBC_include_template_part('wpbc_get_query_posts/get_query_pagination');  
		if(!empty($inc) && empty($query['hide_nav']) ){  
			include ($inc);  
		} 
		

	}else{

		if(!empty($query['debug'])){ 
			echo "<pre>";
			print_r($query);
			echo "</pre>";
		}

		// The loop
		$inc = WPBC_include_template_part('wpbc_get_query_posts/get_query_not_found'); 
		if(!empty($inc)){  
			include ($inc);  
		}

		// #HERE_1 Just for ajax to work fine if no results and rebuil query from form search... yes it´s complex to xplain leave this here, do not ask :)
		// Todo, make this to happen on js side if no target nav present on html by default.
		?>
		<div id="<?php echo $template_args['target_nav_id']; ?>" class="wpbc_get_query_posts_nav <?php echo $template_args['target_nav_class']; ?>"></div>
		<?php
	}

	$out = ob_get_contents();
	ob_end_clean(); 
	return $out;
}