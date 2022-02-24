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
	$type = !empty($args['type']) ? $args['type'] : 'jumbotron';
	$container = !empty($args['container']) ? $args['container'] : 'inside';

	WPBC_get_template_part('components/container', array());
	WPBC_get_template_part('components/jumbotron', array());
?> 

<?php if( $container == 'outside' ) { ?>
	<div class="<?php echo $args['container_class']; ?>">
<?php } ?>

<div class="<?php echo $type; ?> mb-0 bg-transparent">

	<?php if( $container == 'inside' ) { ?>
		<div class="<?php echo $args['container_class']; ?>">
			<?php } ?>

			<?php echo $args['before']; ?>

		  <h1 class="display-2"><?php echo $args['title']; ?></h1>

		  <?php if( $args['subtitle'] ) { ?>
				<p class="lead"><?php echo $args['subtitle']; ?></p>
			<?php } ?>

			<?php echo $args['after']; ?>

		  <?php if( $container == 'inside' ) { ?>
		</div>
	<?php } ?>

</div>

<?php if( $container == 'outside' ) { ?>
	</div>
<?php } ?>