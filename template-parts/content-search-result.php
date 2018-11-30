<?php 
	$post_class = apply_filters('wpbc/filter/post/search/class',''); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

	<?php do_action('wpbc/template/content/search/result/before'); ?>

	<header class="entry-header">
		<?php get_template_part('template-parts/header-post_title'); ?>
	</header>
	
	<div class="entry-content">
		<?php get_template_part( 'template-parts/post_excerpt' );  ?>
	</div>

	<footer class="entry-footer">
		<?php get_template_part( 'template-parts/entry_meta' );  ?>
		<?php get_template_part( 'template-parts/edit_post_link' );  ?>
	</footer><!-- .entry-footer -->
	
	<?php do_action('wpbc/template/content/search/result/after'); ?>
	
</article><!-- article#post-## -->
