<div class="<?php WPBC_class_col_sidebar(); ?>">
	<?php do_action('WPBC_layout__inner_col_sidebar__before'); ?>
	<?php do_action('WPBC_sidebar'); ?>
	<?php
		$post_id = WPBC_layout__get_id(); 
		WPBC_get_template_builder_rows($post_id,'key__flexible_secondary_content_rows'); 
	?>
	<?php do_action('WPBC_layout__inner_col_sidebar__after'); ?>
</div><!-- .col_sidebar -->