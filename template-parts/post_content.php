<?php if ( is_home() || is_search() ) { 
	// has_excerpt() 
	?>
	<?php get_template_part( 'template-parts/post_excerpt' );  ?>
<?php }else{ ?>
	<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bootclean' ),
			get_the_title()
		) );
	?>
	<?php get_template_part( 'template-parts/link_pages' );  ?>
<?php } ?> 