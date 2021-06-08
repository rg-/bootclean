<?php 
	
	$id = !empty($args['id']) ? $args['id'] : get_the_ID();
	$style_args = !empty($args['style_args']) ? $args['style_args'] : ''; 
	$id = apply_filters('wpbc/filter/ui_layout_posts_advanced-item/id', $id);
	$style_args = apply_filters('wpbc/filter/ui_layout_posts_advanced-item/style_args', $style_args); 
	
?>
<article id="post-id-<?php echo $id;?>" class="ui_layout_posts_advanced-item <?php echo $style_args['item_class'];?>">
	<div class="card">

	  <div class="card-img">
			<?php
			$image_hi_data = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "full" ); 
			$image_low_data = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "medium" );
				$img_hi = $image_hi_data[0];
				$img_low = $image_low_data[0];
			if(!empty($img_low)){
				echo '<img class="w-100" src="'.$img_low.'" alt=" "/>'; 
			}
			?>
		</div>

	  <div class="card-body">
	    <h5 class="card-title"><?php echo get_the_title($id);?></h5>
	    <p class="card-text"><?php echo get_the_excerpt($id);?></p>
	    <a href="<?php echo get_the_permalink($id);?>" class="btn btn-primary"><?php echo __('Read more', 'bootclean');?></a>
	  </div>
	</div>
</article>