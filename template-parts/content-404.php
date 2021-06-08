<?php 
	$post_class = apply_filters('wpbc/filter/post/404/class','gpy-2'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	
	<header class="entry-header">
		<h2><?php echo esc_html( __('Sorry the page you are looking at does not exist or an error occurred. Try again later or contact us if the problem persists.', 'bootclean') ); ?></h2>
	</header>
	
</article><!-- article#post-## --> 