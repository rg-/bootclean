<?php 
 
if( apply_filters( 'wpbc/filter/wpbc_ajax_posts_pagination/enqueue', false ) ){
	add_action( 'wp_enqueue_scripts', 'WPBC_ajax_posts_pagination__enqueue_scripts', 998 ); 

	function WPBC_ajax_posts_pagination__enqueue_scripts(){  
		 wp_enqueue_script(
			'wpbc-ajax-posts-pagination',
			get_template_directory_uri() . '/bc/core/assets/js/ajax-posts-pagination.js',
			array( 'jquery' ),
			'1.0',
			true ); 
		global $wp_query;
		global $post;

		$post_ID = !empty($post->ID) ? $post->ID : 0;

		$query_vars_test = $wp_query->query_vars;

		$params = array(
		    'ajaxurl' => admin_url('admin-ajax.php'),
			'current_post' => $post_ID,
			'query_vars' => json_encode( $wp_query->query ),
			'query_vars_test' => json_encode( $query_vars_test ),
			//'ajax_nonce' => wp_create_nonce('wpbc_ajax_nonce'), 
		);
		wp_localize_script( 'wpbc-ajax-posts-pagination', 'wpbc_ajax_posts_pagination_data', $params ); 
	} 
}


add_action( 'wp_ajax_nopriv_'.'wpbc_ajax_posts_pagination', 'WPBC_ajax_posts_pagination__template' );
add_action( 'wp_ajax_'.'wpbc_ajax_posts_pagination', 'WPBC_ajax_posts_pagination__template' );

function WPBC_ajax_posts_pagination__template(){
	
	global $wp_query;

	//$query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

	$query_vars = $wp_query->query_vars;

	$paged = !empty($_GET['paged']) ? $_GET['paged'] : $_POST['paged'];
	$post_type = !empty($_GET['post_type']) ? $_GET['post_type'] : $_POST['post_type'];
	$posts_per_page = !empty($_GET['posts_per_page']) ? $_GET['posts_per_page'] : $_POST['posts_per_page'];

	$query_vars['paged'] = intval($paged);
	$query_vars['post_type'] = $post_type;
	$query_vars['posts_per_page'] = intval($posts_per_page); 

	$posts = new WP_Query( $query_vars );
    	$GLOBALS['wp_query'] = $posts; 

    	$template = WPBC_get_template(); // home, blog, post, page, etc.... 
  
    if( ! $posts->have_posts() ) { 
        get_template_part( 'template-parts/content', '404' );
    }
    else {
    	do_action('wpbc/layout/inner/content/loop/before');
        while ( $posts->have_posts() ) { 
            $posts->the_post(); 
            do_action('wpbc/layout/inner/content/post/before'); 
            $post_type = get_post_type(); 
            echo $_POST['page'];
            $template_path = apply_filters('wpbc/filter/layout/template-path', 'template-parts/content', $post_type);
		$part = apply_filters('wpbc/filter/layout/template-part', $part, $post_type);  
		get_template_part( $template_path, $part ); 

            do_action('wpbc/layout/inner/content/post/after');
        }
        do_action('wpbc/layout/inner/content/loop/after');
        
    }
 	wp_reset_query(); 
    
    die();

}