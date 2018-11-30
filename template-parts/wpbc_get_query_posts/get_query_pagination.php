<?php

	/*

		get_query_pagination

		@bootclean
			@addons
				@wpbc_get_query_posts
					@template-parts 

		@passed
			
			$query (shortcode query_string into array)
			$query_posts (WP_Query($query))
			
			$template_args (array, not passed through shortcode)

	*/ 


	$total_pages = $query_posts->max_num_pages;
	$found_posts = $query_posts->found_posts;
	
	$post_count = $query_posts->post_count; 
	
	$next_link = wp_parse_args( $query, array(
		'paged' => !empty($query['paged']) ? $query['paged'] : 1, 
		'target_id' => !empty($query['target_id']) ? $query['target_id'] : $template_args['target_id'],
	) );
	$paged = $next_link['paged'];
	$next_link['paged'] = $next_link['paged'] + 1;  
	$next_link = $ajax_action_url. '&' . http_build_query($next_link, '', '&'); 
	
	/* 
	echo WPBC_advanced_posts_pagination(array(

		'wp_query' => $query_posts,
		'max_page' => $total_pages,
		'paged' => $paged,

	));
	*/

if( !$query_posts->is_singular ){
?>
<div id="<?php echo $template_args['target_nav_id']; ?>" class="wpbc_get_query_posts_nav <?php echo $template_args['target_nav_class']; ?>">
	<nav class="<?php echo $template_args['target_nav_ul_class']; ?>">
		<?php
		if( $paged < $total_pages && $total_pages != 1 ){ 
			?>
			<li><a class="page-link" data-shortcode-load="#<?php echo $template_args['target_id']; ?>" data-shortcode-nav="#<?php echo $template_args['target_nav_id']; ?>" href="<?php echo $next_link; ?>"><?php echo $template_args['pagination_load_more']; ?></a></li>
			<?php
		}else{ 
			?>
			<li><?php echo $template_args['pagination_no_results']; ?></li>
			<?php
		}
		?>
	</nav>

	<nav class="<?php echo $template_args['target_nav_ul_class']; ?>">
		<?php
		$w = ($query['posts_per_page'] * ($paged-1));
		$post_count = $w + $post_count;
		$found_posts = sprintf($template_args['pagination_showing'], $post_count, $found_posts);
		?>
		<li><?php echo $found_posts; ?></li>
	</nav>
</div>
<?php } ?>