<?php


if ( ! function_exists( 'WPBC_post_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own WPBC_post_date() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function WPBC_post_date() {
	
	$time_string = '<time class="entry-time published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-time published" datetime="%1$s">%2$s</time><time class="updated sr-only" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="entry-posted-on"><span class="screen-reader-text sr-only">%1$s </span><a href="%2$s" rel="bookmark" class="entry-date">%3$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'bootclean' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;