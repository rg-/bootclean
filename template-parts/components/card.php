<?php
	
	/*
	
		WPBC_get_jumbotron
	
		$args passed 

	*/

		$defaults = array( 
			
			'card_type' => '', // card-no-img, card-img-top, card-img-bottom, card-img-overlay
			'card_embed' => '16by9',

			'id' => '',
			'is_main' => false,
			'class' => '', 
			'attrs' => '',
			'container_class' => 'container',
			'container_attrs' => '',
			'container' => 'inside', // inside, outside, none
			'headline' => '',
				'headline_class' => 'card-title',
				'headline_tag' => 'h5',
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
		$args = apply_filters('wpbc/filter/wpbc-card/args', $args);

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

		if( $args['card_type'] == 'card-no-img' ){
			$args['images'] = array();
		} 

		$card_img_class = ( $args['card_type'] == 'card-img-overlay' ) ? 'card-img' : 'card-img-top'; 
		if( $args['card_type'] == 'card-img-overlay' && $args['card_embed'] == 'content-height' ){
			$card_img_class = 'card-img-overlay p-0 z-index-0';
		}
		$card_body_class = ( $args['card_type'] == 'card-img-overlay' && $args['card_embed'] != 'content-height' ) ? 'card-img-overlay' : 'card-body z-index-10 position-relative';

?>

<?php if( $container == 'outside' ) { ?>
	<div <?php echo $id_tag_outside; ?> class="<?php echo $args['container_class']; ?>" <?php echo $args['container_attrs']; ?>>
		<?php echo $before; ?>
<?php } ?>

<div <?php echo $id_tag; ?> class="card <?php echo $args['class']; ?>" <?php echo $args['attrs']; ?>>

	<?php if( $container == 'inside' ) { ?>
		<?php echo $before; ?>
		<div class="<?php echo $args['container_class']; ?>" <?php echo $args['container_attrs']; ?>>
	<?php } ?>

	<?php if(!empty($args['images']) && ( $args['card_type'] == 'card-img-top' || $args['card_type'] == 'card-img-overlay' ) ){ 

			if( $args['card_embed'] != 'content-height' ){ 
				?>
				<div class="<?php echo $card_img_class; ?>">
					<div class="embed-responsive embed-responsive-16by9">
						<div class="embed-responsive-item">
							<div class="h-100 position-relative">
								<?php echo $args['images']; ?>
							</div>
						</div>
					</div>
				</div>
				<?php 
			} else { 
				?>
				<div class="<?php echo $card_img_class; ?>">
					<div class="h-100 position-relative">
						<?php echo $args['images']; ?>
					</div>
				</div>
				<?php 
			}

		}
	?>

	<div class="<?php echo $card_body_class; ?>">

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

	</div>

	<?php if(!empty($args['images']) && $args['card_type'] == 'card-img-bottom' ){ ?>
		<div class="card-img-top">
			<div class="embed-responsive embed-responsive-16by9">
				<div class="embed-responsive-item">
					<div class="h-100 position-relative">
						<?php echo $args['images']; ?>
					</div>
				</div>
			</div>
		</div>
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