<?php 
// Create post object
$my_post = array( 
  'post_type' => 'page', 
);
 
// Insert the post into the database
$post_id = wp_insert_post( $my_post );

if( !is_wp_error($post_id) ) {
	update_post_meta( $post_id, '_wp_page_template', '_template_builder.php' );
	return get_edit_post_link($post_id); 
} else {
	echo 0;
}