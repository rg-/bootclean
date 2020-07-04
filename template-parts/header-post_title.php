<?php
	$WPBC = array( 
		'header_class' => apply_filters('WPBC_post_header_class', ''),
		'title_tag' => apply_filters('WPBC_post_header_title_tag', 'h2'),
		'title_class' => apply_filters('WPBC_post_header_title_class', 'entry-title')
	);
	$WPBC = apply_filters('WPBC_post_header', $WPBC);
	extract($WPBC); 

	$show_entry_header = apply_filters('WPBC_post_header_show','__return_true');
	if($show_entry_header){
?>
<header class="entry-header">
<?php if( is_singular() ){ ?>
<<?php echo $title_tag; ?> class="<?php echo $title_class; ?>"><?php single_post_title(); ?></<?php echo $title_tag; ?>>
<?php } else { ?>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-post"><?php _e( 'Featured', 'bootclean' ); ?></span>
	<?php endif; ?>
	<?php the_title( sprintf( '<'.$title_tag.' class="'.$title_class.'"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></'.$title_tag.'>' ); ?>
<?php } ?>
</header>
<?php } ?>