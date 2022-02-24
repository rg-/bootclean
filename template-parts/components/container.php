<?php
	
	/*
	
		WPBC_get_container

	*/

	$id_tag = '';
	if( !empty($args['id']) ){
		$id_tag = 'id="'.$args['id'].'"';
	}
?>
<div <?php echo $id_tag; ?> class="<?php echo $args['class']; ?>" <?php echo $args['attrs']; ?>>
	<?php echo do_shortcode($args['before']); ?>
  <div class="position-relative z-index-10"><?php echo $args['content']; ?></div>
  <?php echo do_shortcode($args['after']); ?>
</div>