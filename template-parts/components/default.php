<?php
	
	/*
	
		WPBC_get_jumbotron
	
		$args passed 

	*/

		$defaults = array( 
			'id' => '',
			'is_main' => false,
			'class' => '', 
			'attrs' => '',
			'container_class' => 'container',
			'container_attrs' => '',
			'container' => 'inside', // inside, outside, none
			'headline' => '',
				'headline_class' => 'display-1',
				'headline_tag' => 'h2',
				'headline_attrs' => '', 
			'lead' => '',
				'lead_class' => 'lead',
				'lead_tag' => 'p',
				'lead_attrs' => '', 
			'images' => array(), // img ids,
			'slick_attrs' => array(), // slick
			'after' => '',
			'before' => '',
		);

		$args = shortcode_atts($defaults, $args); 
		$args = apply_filters('wpbc/filter/wpbc-default/args', $args);

		//_print_code($args);
		$after = do_shortcode($args['after']);
		$before = do_shortcode($args['before']);
		$container = $args['container'];

		$id_tag = '';
		$id_tag_outside = '';
		if( !empty($args['id']) ){
			$id_tag = 'id="'.$args['id'].'"';
			$id_tag_outside = 'id="'.$args['id'].'"';
		}
		if( $container == 'outside' ) {
			$id_tag = ''; 
		}else{
			
		}

?>

<?php if( $container == 'outside' ) { ?>
	<div <?php echo $id_tag_outside; ?> class="<?php echo $args['container_class']; ?>" <?php echo $args['container_attrs']; ?>>
		<?php echo $before; ?>
<?php } ?>

<div <?php echo $id_tag; ?> class="default <?php echo $args['class']; ?>" <?php echo $args['attrs']; ?>>

	<?php if( $container == 'inside' ) { ?>
		<?php echo $before; ?>
		<div class="<?php echo $args['container_class']; ?>" <?php echo $args['container_attrs']; ?>>
	<?php } ?>

	<?php if(!empty($args['headline'])){ ?>
	  <<?php echo $args['headline_tag']; ?> class="<?php echo $args['headline_class']; ?>" <?php echo $args['headline_attrs']; ?>>
	  	<?php echo $args['headline']; ?>
	  </<?php echo $args['headline_tag']; ?>>
  <?php } ?>

  <?php if(!empty($args['lead'])){ ?>
	  <<?php echo $args['lead_tag']; ?> class="<?php echo $args['lead_class']; ?>" <?php echo $args['lead_attrs']; ?>>
	  	<?php echo $args['lead']; ?>
	  </<?php echo $args['lead_tag']; ?>>
  <?php } ?>

  <?php if( $container == 'inside' ) { ?>
		</div>
	<?php } ?>

	<?php echo $after; ?>

</div>

<?php if( $container == 'outside' ) { ?>
	<?php echo $after; ?>
	</div>
<?php } ?>