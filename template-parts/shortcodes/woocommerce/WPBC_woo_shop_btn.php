<?php 
//_print_code($args);
?>
<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="<?php echo $args[ 'class' ]; ?>">
	<?php echo $args[ 'label' ]; ?>
</a>