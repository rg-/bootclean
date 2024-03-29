<?php 
echo "<!-- template-parts/layout/main-content.php -->";

if( !is_page_template('_template_builder.php') ){ ?>
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
			
			$part = $post_type;
			if(is_singular()){
				$template_path .= '-single';
			}
			$part = apply_filters('wpbc/filter/layout/template-part', $part, $post_type); 
			echo "<!-- TEMPLATE TO USE: ".$template_path.'-'.$part." -->";
			get_template_part( $template_path, $part ); 
			
			do_action('wpbc/layout/inner/content/post/after');
		} 
		
		do_action('wpbc/layout/inner/content/loop/after'); 
		
		if(!is_singular()){
			echo "<!-- post_pagination -->";
			$post_pagination = apply_filters('wpbc/filter/layout/post_pagination', 'post_pagination' );  
			get_template_part( 'template-parts/'.$post_pagination ); 
		} 
	} else {
		if($template == 'search')  {
			$t = 'search';
		}else{
			$t = 'no-posts';
		}
		if(is_404()){
			$t = '404';
		}
		do_action('wpbc/layout/inner/content/loop/before');
		echo "<!-- TEMPLATE TO USE: ".$t." -->"; 
		get_template_part( 'template-parts/content', $t ); 
		do_action('wpbc/layout/inner/content/loop/after'); 
	} 
	wp_reset_query(); 
	?>
	<?php 
		do_action('wpbc/layout/inner/content/after');
	?>
<?php } else {
	echo "<!-- template-parts/layout/main-content-builder.php -->";
	get_template_part('template-parts/layout/main-content-builder');
} ?>