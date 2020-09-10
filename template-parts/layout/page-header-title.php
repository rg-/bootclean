<?php
/*

	Layout template part for Page Header -> Use Page Title, that is, the_title(); wrapped by bootstrap grid

	$args passed:

		'title' => get_the_title($post_id),
		'container_class' => 'container',
		'row_class' => 'row',
		'col_class' => 'col-12 text-center',
	
	@see _print_code($args);

*/ 
?>
<div class="<?php echo $args['container_class']; ?>">

	<div class="<?php echo $args['row_class']; ?>">
		<div class="<?php echo $args['col_class']; ?>">
			<?php echo $args['title']; ?>
			<?php echo $args['subtitle']; ?>
		</div>
	</div>

</div>