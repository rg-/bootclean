<?php


if ( ! function_exists( 'WPBC_post_taxonomies' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own WPBC_post_taxonomies() function to override in a child theme.
 *
 * @since Bootclean 9.0
 */
	function WPBC_post_taxonomies() {
		
		$categories_list = WPBC_get_the_category_list();
		if ( $categories_list && WPBC_categorized_blog() ) {
			return WPBC_get_the_category_list();
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'bootclean' ) );
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'bootclean' ),
				$tags_list
			);
		}
	}
endif; 


if ( ! function_exists( 'WPBC_get_the_term_list' ) ) :
	function WPBC_get_the_term_list_filter_link($links){
		$temp = array();
		foreach($links as $k=>$v){
			$temp[] = str_replace('rel="tag"', 'rel="OPS"', $v);
		}
		return $temp; 
	}
	function WPBC_get_the_term_list($args='') {
		extract(shortcode_atts(array( 
			"taxonomy" => 'category', 
			"before" => '',
			"sep" => '',
			"after" => '',
			"post_id" => false, 
		), $args));


		$out = '';
		
		// $term_links = apply_filters( "term_links-{$taxonomy}", $links );
		//add_filter("term_links-".$taxonomy,'WPBC_get_the_term_list_filter_link',10,1); 
		$terms = get_the_term_list( $post_id, $taxonomy, $before, $sep, $after ) ;
		//remove_filter("term_links-".$taxonomy,'WPBC_get_the_term_list_filter_link',10,1);
		if(!empty($terms )){
			$out = $terms;
		}
		return $out; 
	}
	
endif;

if ( ! function_exists( 'WPBC_get_the_terms' ) ) :
	function WPBC_get_the_terms($args='') {
		extract(shortcode_atts(array( 
			"taxonomy" => 'category',  
			"post_id" => false, 
			"before" => '',
			"sep" => ', ',
			"after" => '',
			"use_icons" => false,
		), $args));
		$out = '';
		if($post_id){
			$terms = get_the_terms( $post_id, $taxonomy );
			$post_type = get_post_type( $post_id );              
			if ( $terms && ! is_wp_error( $terms ) ) { 
				$temp = array();
				foreach ( $terms as $term ) {

					$term_id = $term->term_id;
					$term_link = get_term_link($term_id, $taxonomy);
					$term_link = apply_filters('wpbc/filter/get_the_terms/link', $term_link, $term_id, $taxonomy, $post_type);

					if($use_icons){
						$item = '<i data-id="'.$term->term_id.'" class="icon-'.$term->slug.'"></i> '.$term->name;
					}else{
						$item = $term->name;
					}

					$a = '<a href="'.$term_link.'">';
					$aa = '</a>';

					$temp[] = $a.$item.$aa;

				} 
				$out = $before.join( "$sep ", $temp ).$after;
			}
		} 
		 
		return $out; 
	}
endif; 
                   

if ( ! function_exists( 'WPBC_get_the_category_list' ) ) :
	function WPBC_get_the_category_list($args='') { 
		extract(shortcode_atts(array( 
			"label" => _x( 'Categories', 'Used before category names.', 'bootclean' ), 
			"separator" => ', ',
			"parents" => '',
			"post_id" => false
		), $args));
		$out = '';
		$categories_list = get_the_category_list( $separator, $parents, $post_id );
		if ( $categories_list && WPBC_categorized_blog() ) {
			$out = sprintf( '<span class="cat-links"><span class="screen-reader-text">%1$s</span>%2$s</span>',
				$label,
				$categories_list
			);
		}
		return $out; 
	}
endif;

if ( ! function_exists( 'WPBC_categorized_blog' ) ) :
/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own WPBC_categorized_blog() function to override in a child theme.
 *
 * @since Bootclean 9.0
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function WPBC_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wpbc_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wpbc_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 || is_preview() ) {
		// This blog has more than 1 category so twentysixteen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so twentysixteen_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in WPBC_categorized_blog().
 *
 * @since Bootclean 9.0
 */
function WPBC_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'wpbc_categories' );
}
add_action( 'edit_category', 'WPBC_category_transient_flusher' );
add_action( 'save_post',     'WPBC_category_transient_flusher' );