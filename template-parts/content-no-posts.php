<?php 
	$post_class = apply_filters('wpbc/filter/post/404/class',''); 
?>
<article <?php post_class($post_class); ?>>
	
	<header class="entry-header">
		<h2><?php echo esc_html( __('There are no publications yet.', 'bootclean') ); ?></h2>
	</header>
	
</article><!-- article#post-## --> 