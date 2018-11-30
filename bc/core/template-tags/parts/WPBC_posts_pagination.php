<?php

if ( ! function_exists( 'WPBC_posts_pagination' ) ) : 
	
	function WPBC_posts_pagination( $args = array(), $echo = true ){
		
		$defaults = array(
			'mid_size' => 1,
			'prev_text' => __( 'Previous', 'bootclean' ),
			'next_text' => __( 'Next', 'bootclean' ),
			'screen_reader_text' => __( 'Posts navigation', 'bootclean' ),
		);
		
		// Apply filters
		$defaults = apply_filters( 'WPBC_posts_pagination__defaults', $defaults );
		// Merge them
		$this_args = wp_parse_args( $args, $defaults );
		// Apply filters to args
		$this_args = apply_filters( 'WPBC_posts_pagination__args', $this_args ); 
		// Extract args
		extract( $this_args );
		
		the_posts_pagination( $this_args );
		
	}

endif; 