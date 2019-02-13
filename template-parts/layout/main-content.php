<?php if( !is_page_template('_template_builder.php') ){ ?>
	<?php 
		do_action('wpbc/layout/inner/content/before');
	?>
	<?php 
	$template = WPBC_get_template(); // home, blog, post, page, etc....   
	if ( have_posts() && $template != 'search' ) { 
		
		do_action('wpbc/layout/inner/content/loop/before'); 
		
		while ( have_posts() ) { 
			
			do_action('wpbc/layout/inner/content/post/before'); 
			
			the_post(); 
			
			$post_format = get_post_format();
			$post_type = get_post_type();

			$template_path = apply_filters('wpbc/filter/layout/template-path', 'template-parts/content', $post_type);
			$part = apply_filters('wpbc/filter/layout/template-part', $part, $post_type); 
			
			get_template_part( $template_path, $part ); 
			
			do_action('wpbc/layout/inner/content/post/after');
		} 
		
		do_action('wpbc/layout/inner/content/loop/after'); 
		
		if(!is_singular()){
			$post_pagination = apply_filters('wpbc/filter/layout/post_pagination', 'post_pagination' );  
			get_template_part( 'template-parts/'.$post_pagination ); 
		} 
	} else {  
		get_template_part( 'template-parts/content', $template ); 
	} 
	wp_reset_query(); 
	?>
	<?php 
		do_action('wpbc/layout/inner/content/after');
	?>
<?php } else {
	get_template_part('template-parts/layout/main-content-builder');
} ?>