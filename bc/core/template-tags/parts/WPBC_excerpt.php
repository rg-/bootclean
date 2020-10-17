<?php

/** 
* @function WPBC_excerpt 
* @since Bootclean 9.0
*
*/ 

if ( ! function_exists( 'WPBC_excerpt' ) ) : 
	 
	function WPBC_excerpt_length( $length ) {
		return $length ? $length : 55;
	}
	add_filter( 'excerpt_length', 'WPBC_excerpt_length' );
	
	function WPBC_excerpt( $args = array(), $echo = true ) {
		 
		// Set Defaults
		$defaults = array(
			'post'            => '',
			'length'          => 20,
			'class'		=> 'entry-summary', 
			'wrap' => true,
			'excerpt_before'	=> '<span class="entry-excerpt">',
			'excerpt_after'	=> '</span>',
			'readmore'        => true,
			'readmore_show_title' => false,
			'readmore_text'   => esc_html__( 'Read more', 'bootclean' ),
			'readmore_before'	=> '&hellip; <span class="entry-more">',
			'readmore_after'  => '</span>',
			'readmore_class'  => 'more-link'
		); 
		
		// Apply filters
		$defaults = apply_filters( 'WPBC_excerpt__defaults', $defaults );
		// Merge them
		$this_args = wp_parse_args( $args, $defaults );
		// Apply filters to args
		$this_args = apply_filters( 'WPBC_excerpt__args', $this_args ); 
		// Extract args
		extract( $this_args );
		

		$post = get_post($post);
		if(empty($post)){
			global $post; 
		} 
		
		$output = '';
		if($wrap) $output .= '<div class="'. esc_attr( $class ) .'">'; 
		$text = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
		$text = do_shortcode($text);
		$excerpt_length = apply_filters( 'excerpt_length', $length );
		$excerpt_more = apply_filters( 'excerpt_more', '' );
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
		$text = apply_filters( 'get_the_excerpt', $text ); 
		
		$text = $excerpt_before.$text.$excerpt_after;
		
		$link = '';
		if($readmore){
			$show_title = $readmore_show_title ? sprintf( '<span class="screen-reader-text"> "%s"</span>' , get_the_title( $post->ID ) ) : ''; 
			$more = $readmore_text . $show_title;
			$link = $readmore_before . sprintf( '<a href="%1$s" class="'. esc_attr( $readmore_class ) .'">%2$s</a>',
				esc_url( get_permalink( $post->ID ) ),
				/* translators: %s: Name of current post */
				$more
			).$readmore_after;
		} 
		$output .= $text.$link; 
		if($wrap) $output .= '</div>';
		
		if($echo){
			echo apply_filters( 'WPBC_excerpt', $output );
		}else{
			return apply_filters( 'WPBC_excerpt', $output );
		} 
	}
endif; 