<?php
	$show_edit = apply_filters('wpbc/filter/layout/single/page/actions',1);
	if($show_edit){
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'bootclean' ),
				get_the_title()
			),
			'<small class="edit-link">',
			'</small>'
		);
	}
?>