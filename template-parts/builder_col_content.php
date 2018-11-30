<main id="main" class="layout__container_content <?php WPBC_class_col_content(); ?>">

	<?php 
	do_action('wpbc/layout/inner/content/before'); ?>

	<?php 
	$template = WPBC_get_template(); // home, blog, post, page, etc....  
	
	WPBC_get_template_builder($post->ID);

	do_action('wpbc/layout/inner/content/after');

	?>
	
</main><!-- .col_content -->