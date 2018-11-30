<?php

do_action('wpbc/template/content/search/before');

	get_template_part( 'template-parts/post_header', 'search' );

	if ( have_posts() ) {
	
		do_action('wpbc/template/content/search/loop/before'); 
		
		while ( have_posts() ) {
		
			the_post();
			
			get_template_part( 'template-parts/content-search', 'result' );
		
		}
		
		do_action('wpbc/template/content/search/loop/after');
	
	} else {
	
		do_action('wpbc/template/content/search/loop/before');
		
		get_template_part( 'template-parts/content-search', '404' );
		
		do_action('wpbc/template/content/search/loop/after');
	
	}

	wp_reset_query();

do_action('wpbc/template/content/search/after');