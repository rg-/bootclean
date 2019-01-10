<?php


/*

	"resource" template part for the loop

*/ 

$post_id = get_the_ID();

?>
<article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>

	<div class="h6 gmy-0"><small><?php echo WPBC_get_the_terms(array(
			'taxonomy' => 'wpbc_resource_category',
			'post_id'=> $post_id,
			'before' => '',
		)); ?> | <?php echo WPBC_get_the_terms(array(
			'taxonomy' => 'wpbc_resource_type',
			'post_id'=> $post_id,
			'before' => '@',
		)); ?></small></div>

	<h5 class="gmy-0 text-info mt-1"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>

	<div class="entry-description small mt-1">
		<?php  
		$wpbc_resource_desc = WPBC_get_field('wpbc_resource_desc');
		echo $wpbc_resource_desc; 
		?>
	</div>

	<div class="alert alert-info p-2 mt-1"><small><?php WPBC_resource_template__path($post_id); ?></small></div> 

</article>