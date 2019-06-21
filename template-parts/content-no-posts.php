<?php 
	$post_class = apply_filters('wpbc/filter/post/404/class',''); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	
	<header class="entry-header">
		<h2><?php echo esc_html( __('There are no publications yet.', 'bootclean') ); ?></h2>
	</header>
	
	<div class="entry-thumbnail"> 
	</div>
	
	<div class="entry-content"> 
	</div>
	
	<footer class="entry-footer"> 
		
	</footer><!-- .entry-footer -->
	
</article><!-- article#post-## --> 