<?php 
	$post_class = apply_filters('wpbc/filter/post/single/class',''); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	
	<div class="entry-header gmb-1">
		<?php get_template_part( 'template-parts/entry_date' ); ?>
		<?php get_template_part( 'template-parts/header-post_title'); ?>
		<?php get_template_part( 'template-parts/entry_meta' ); ?>
		<?php get_template_part( 'template-parts/link_pages' ); ?>
	</div>

	<div class="entry-thumbnail gmb-1">
		<?php get_template_part( 'template-parts/post_thumbnail' );  ?>
	</div>
	
	<div class="entry-content gmb-1">
		<?php the_content(); ?>
	</div>
	
	<footer class="entry-footer">
		<?php get_template_part( 'template-parts/post_share' ); ?>
		<?php get_template_part( 'template-parts/edit_post_link' ); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- article#post-## -->

<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	} 
?>