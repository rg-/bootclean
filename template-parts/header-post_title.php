<?php
	$WPBC = array( 
		'header_class' => apply_filters('WPBC_post_header_class', ''),
		'title_tag' => apply_filters('WPBC_post_header_title_tag', 'h2'),
		'title_class' => apply_filters('WPBC_post_header_title_class', 'display-3')
	);
	$WPBC = apply_filters('WPBC_post_header', $WPBC);
	extract($WPBC); 

	$show_entry_header = apply_filters('WPBC_post_header_show','__return_true');
	if($show_entry_header){

		$title_before = apply_filters('WPBC_post_header_title_before', '');
		$title_after = apply_filters('WPBC_post_header_title_after', ''); 

?>
<header class="entry-header <?php echo $header_class; ?>">
	<?php echo $title_before; ?>
<?php if( is_singular() ){  
	$title = get_the_title(); 
	$title = '<'.$title_tag.' class="'.$title_class.'">'.$title.'</'.$title_tag.'>'; 
	$title = apply_filters('WPBC_post_header_title', $title, $title_tag, $title_class);  
	echo $title;
	?>
<?php } else { ?>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-post"><?php _e( 'Featured', 'bootclean' ); ?></span>
	<?php endif; ?>
	<?php the_title( sprintf( '<'.$title_tag.' class="'.$title_class.'"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></'.$title_tag.'>' ); ?>
<?php } ?>
	<?php echo $title_after; ?>
</header>
<?php } ?>