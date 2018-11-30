<?php 

function WPBC_property_query_vars( $vars ) {
    $vars[] = 'property_type'; 
    $vars[] = 'property_operation'; 
    $vars[] = 'property_services'; 
    $vars[] = 'property_aditionals'; 
    $vars[] = 'property_price'; 
    return $vars;
} 
//add_filter( 'query_vars', 'WPBC_property_query_vars' );


//add_action('pre_get_posts', 'WPBC_property_pre_get_posts');

function WPBC_property_pre_get_posts( $query ){

    if ( is_admin() || ! $query->is_main_query() ){
        return;
    }

    $template = WPBC_get_template();

    if( $template == 'home-blog' ){
        //$query->set('posts_per_page', '3');
        //$query->set('post_type', 'property');
        //return;
    }
    // 
    /*
    if ( !is_post_type_archive( 'property' ) ){
        return;
    } 
        */
}

//add_filter('post_link', 'wpbc_property_post_link', 1, 3);
//add_filter('post_type_link', 'wpbc_property_post_link', 1, 3);

function wpbc_property_post_link( $post_link, $post = 0 ){   
	if (strpos($post_link, '%property_operation%') === FALSE) return $post_link;
        // Get post
        $post = get_post($post->ID);
		if ( !is_object($post) || $post->post_type != 'listing' ) {
		  return $post_link;
		}
        if (!$post) return $post_link;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'property_operation');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
        	$taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = '';

    return str_replace('%property_operation%', $taxonomy_slug, $post_link);
}