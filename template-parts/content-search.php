<?php
echo "<!-- template-parts/content-search.php -->";
do_action('wpbc/template/content/search/before');

	// get_template_part( 'template-parts/post_header', 'search' );

	if ( have_posts() ) {
	
		do_action('wpbc/template/content/search/loop/before'); 
		
		while ( have_posts() ) {
		
			the_post();
			$post_type = get_post_type();

			$template_path = apply_filters('wpbc/filter/search/template-path', 'template-parts/content-search', $post_type);
			
			$part = $post_type; 
			$part = apply_filters('wpbc/filter/search/template-part', 'result', $post_type); 
			echo "<!-- TEMPLATE TO USE: ".$template_path.'-'.$part." -->";
			get_template_part( $template_path, $part ); 

			//get_template_part( 'template-parts/content-search', 'result' );
		
		}
		
		do_action('wpbc/template/content/search/loop/after');
	
	} else {
	
		do_action('wpbc/template/content/search/loop/before');
		
		get_template_part( 'template-parts/content-search', '404' );
		
		do_action('wpbc/template/content/search/loop/after');
	
	}

	wp_reset_query();

do_action('wpbc/template/content/search/after');