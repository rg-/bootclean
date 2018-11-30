<?php
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'bootclean' ),
			get_the_title()
		),
		'<small class="edit-link">',
		'</small>'
	);
?>