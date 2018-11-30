<?php 
	$post_id = get_the_ID();
	$post_class = apply_filters('wpbc/filter/post/loop/class',''); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	
	<div class="entry-thumbnail">
		<?php get_template_part( 'template-parts/post_thumbnail' ); ?>
	</div>
	
	<header class="entry-header">
		<h4 class="property-title gmy-1"><a href="<?php the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h4>
	</header>
	
	<div class="entry-content">
		<?php get_template_part( 'template-parts/post_content' ); ?>
	</div>
	
	<footer class="entry-footer">
		<?php get_template_part( 'template-parts/entry_meta' ); ?>
		<?php get_template_part( 'template-parts/edit_post_link' ); ?>
	</footer>
	
</article>
<!-- article #post-<?php the_ID(); ?> END -->
