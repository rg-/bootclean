<?php 
//https://premium.wpmudev.org/blog/load-posts-ajax/

function WPBC_ajax_enqueue_scripts(){  
	 wp_enqueue_script(
		'wpbc-ajax-pagination',
		get_template_directory_uri() . '/bc/core/assets/js/ajax-pagination.js',
		array( 'jquery' ),
		'1.0',
		true ); 
	global $wp_query;
	global $post;
	$params = array(
	    'ajaxurl' => admin_url('admin-ajax.php'),
	    //'ajax_nonce' => wp_create_nonce('wpbc_ajax_nonce'),
		'current_post' => $post->ID,
	);
	wp_localize_script( 'wpbc-ajax-pagination', 'ajaxData', $params ); 
} 
add_action( 'wp_enqueue_scripts', 'WPBC_ajax_enqueue_scripts', 998 ); 


add_action( 'wp_ajax_nopriv_'.'wpbc_ajax_pagination', 'wpbc_ajax_pagination' );
add_action( 'wp_ajax_'.'wpbc_ajax_pagination', 'wpbc_ajax_pagination' ); 
function wpbc_ajax_pagination() {  
	 
	$post_id = $_POST['post_id']; 
	// $post_types = $_POST['post_types']; 
	$template_part = 'content'; 
	
	$query_vars = array();  
	$query_vars['p'] = $post_id; 
	//$query_vars['post_type'] = explode(",", $post_types);
	$query_vars['post_type'] = array('post','page');
	
	$posts = new WP_Query( $query_vars );
    $GLOBALS['wp_query'] = $posts; 
	
	if( $posts->have_posts() ) { 
		 while ( $posts->have_posts() ) { 
			$posts->the_post(); 
			?>
			<div class="hidden_ajax_data" style="display:none!important;">
				<span class="title"><?php echo wp_get_document_title(); ?></span>
				<span class="url"><?php echo esc_url( get_permalink() ); ?></span>
			</div>
			<?php 
			get_template_part( 'template-parts/'.$template_part );
		 }
	} else {
		//print_r($query_vars['post_type']);
		get_template_part( 'template-parts/404' );
	}
	
    die();
} 

function WPBC_ajax_nav_menu_item_args( $atts, $item, $args, $depth  ) {
	$classes = $item->classes; 
		
	if( in_array('ajax-nav', $classes) !== false) {
		 
	}
	
	if( $item->type!='custom' || ( in_array('ajax-nav', $classes) !== false ) ){
		$atts['data-ajax'] = $item->object_id;
		$atts['data-ajax-url'] = get_permalink($item->object_id);		
	} 
	return $atts; 
}

add_filter('nav_menu_link_attributes', 'WPBC_ajax_nav_menu_item_args', 10, 4);



