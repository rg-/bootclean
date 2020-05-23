<?php 
	do_action('wpbc/layout/inner/content/before');
?>
<?php 
$template = WPBC_get_template(); // home, blog, post, page, etc....  
do_action('wpbc/layout/builder/content/before');
if ( have_posts() ) {  
	do_action('wpbc/layout/inner/content/loop/before');
	do_action('wpbc/layout/builder/loop/before');
	while ( have_posts() ) { 
		the_post();
		$post_id = get_the_ID(); 
		do_action('wpbc/layout/builder/rows/before');
		WPBC_get_template_builder_rows($post_id,'','main-content');
		WPBC_get_edit_template_builder($post_id);
		do_action('wpbc/layout/builder/rows/after'); 
	}  // If posts END
	do_action('wpbc/layout/builder/loop/after'); 
	do_action('wpbc/layout/inner/content/loop/after', $post_id);
	wp_reset_query();   
}
do_action('wpbc/layout/builder/content/before');
?>
<?php 
	do_action('wpbc/layout/inner/content/after');
?>