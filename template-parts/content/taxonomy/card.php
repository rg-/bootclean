<?php 
	$id = $args['id'];
	$style_args = !empty($args['style_args']) ? $args['style_args'] : '';

	$id = apply_filters('wpbc/filter/ui_layout_posts_advanced-item/id', $id);
	$style_args = apply_filters('wpbc/filter/ui_layout_posts_advanced-item/style_args', $style_args); 
	
	$term = $args['term'];
?>
<article id="taxonomy-id-<?php echo $id;?>" class="ui_layout_posts_advanced-item <?php echo $style_args['item_class'];?>">
	<div class="card">
	  <div class="card-body">
	   <h5 class="card-title"><?php echo $term->name;?></h5>
	    <p class="card-text"><?php echo get_the_excerpt($term->description);?></p>
	    <a href="<?php echo get_the_permalink($term->term_id);?>" class="btn btn-primary"><?php echo __('Read more', 'bootclean');?></a>
	  </div>
	</div>
</article>