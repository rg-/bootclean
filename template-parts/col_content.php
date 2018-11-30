<main id="main" class="layout__container_content <?php WPBC_class_col_content(); ?>">

	<?php 
	do_action('wpbc/layout/inner/content/before'); ?>

	<?php 
	$template = WPBC_get_template(); // home, blog, post, page, etc....  
	 
	if ( have_posts() && $template != 'search' ) {
		 
		do_action('wpbc/layout/inner/content/loop/before');
		
		while ( have_posts() ) {
 
			do_action('wpbc/layout/inner/content/post/before');
		
			the_post(); 
			$post_format = get_post_format();
			$post_type = get_post_type(); 
			if($post_format){
				$temp = $template; 
				//$temp = $template.'-'.$post_format; 
			}else{
				$temp = $template; 
			}
			 
			$temp = apply_filters('wpbc/filter/layout/inner/content/template',$temp);
			
			get_template_part( 'template-parts/content', $temp );
			 
			do_action('wpbc/layout/inner/content/post/after');
		}
		 
		do_action('wpbc/layout/inner/content/loop/after');
		
		if(!is_singular()){
			get_template_part( 'template-parts/post_pagination' ); 
		} 
		
	} else {  
		get_template_part( 'template-parts/content', $template ); 
	} 
	wp_reset_query(); 
	?>
	
	<?php 
	do_action('wpbc/layout/inner/content/after'); ?>
	
</main><!-- .col_content -->