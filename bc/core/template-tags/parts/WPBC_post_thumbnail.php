<?php


/** 
* @function WPBC_post_thumbnail 
 * @since Bootclean 9.0
*
*/
if ( ! function_exists( 'WPBC_post_thumbnail' ) ) : 

	function WPBC_post_thumbnail( $args = array(), $echo = true ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
		</a>

		<?php endif; // End is_singular()
	} 

endif;