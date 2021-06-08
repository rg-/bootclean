<?php 
	
	$id = !empty($args['id']) ? $args['id'] : get_the_ID();
	$style_args = !empty($args['style_args']) ? $args['style_args'] : '';

	$id = apply_filters('wpbc/filter/ui_layout_posts_advanced-item/id', $id);
	$style_args = apply_filters('wpbc/filter/ui_layout_posts_advanced-item/style_args', $style_args);

?>
<article id="post-id-<?php echo $id;?>" class="ui_layout_posts_advanced-item <?php echo $style_args['item_class'];?>">
	<div class="jumbotron">
	  <h1 class="display-4"><?php echo get_the_title($id);?></h1>
	  <p class="lead"><?php echo get_the_excerpt($id);?></p>
	  <hr class="my-4"> 
	  <p class="lead">
	    <a class="btn btn-primary btn-lg" href="<?php echo get_the_permalink($id);?>" role="button"><?php echo __('Read more', 'bootclean');?></a>
	  </p>
	</div>
</article>