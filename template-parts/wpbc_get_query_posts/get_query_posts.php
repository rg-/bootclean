<?php

	/*

		get_query_posts

		@bootclean
			@addons
				@wpbc_get_query_posts
					@template-parts 

		@passed
			
			$query (shortcode query_string into array)
			$query_posts (WP_Query($query))
			
			$template_args (array, not passed through shortcode)

	*/ 
	 
?>
<div id="<?php echo $template_args['target_id']; ?>" class="wpbc_get_query_posts_target <?php echo $template_args['target_class']; ?>">
<?php

	while ( $query_posts->have_posts() ) { 
		
		$query_posts->the_post();  
		
		// Since shortcode can take a single post too, choose template to use defined on args/filtered
		if($query_posts->is_singular){
			$template = $template_args['template_part_single']; 
		}else{
			$template = $template_args['template_part']; 
		}

		if(!empty($template_args['use_map'])){
			$template = 'wpbc_realstate/post_property_map_marker';
		}

		$inc = WPBC_include_template_part( $template ); 
		if(!empty($inc)){  
			include ($inc);  
		} 

	}

	wp_reset_postdata();

?>
</div>