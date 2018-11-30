<?php

/*

	WPBC_get_query_posts like:

	[WPBC_get_query_posts/]
	[WPBC_get_query_posts query_string='debug=1&posts_per_page=3'/]

	That query_string will be later:

	/wp-admin/admin-ajax.php/?action=get_query_posts&debug=1&posts_per_page=3

	Great right?!

*/ 

include('shortcodes/actions_posts.php');
include('shortcodes/actions_form.php');
include('shortcodes/WPBC_get_query_post.php');
include('shortcodes/WPBC_get_query_posts.php');
include('shortcodes/WPBC_get_query_form.php'); 

add_shortcode('WPBC_get_query_preview', 'WPBC_get_query_preview_FX'); 

function WPBC_get_query_preview_FX( $atts, $content = null) {

	$shortcode_args = wp_parse_args( $atts, array(

		'target_id' => WPBC_get_query_posts_default_target_id(),

	) ); 

	ob_start();  
	?>
	<div class="" data-swap-preview="#<?php echo $shortcode_args['target_id']; ?>">
		<a href="#" class="preview_large btn btn-default">Large</a> <a href="#" class="preview_thumbs btn btn-default">Thumbnails</a>
	</div>
	<?php

	$out = ob_get_contents();
	ob_end_clean(); 
	return $out;

}