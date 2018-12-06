<?php


/*

	"resource-single" template part for single

*/ 

$post_id = get_the_ID();

?>
<article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>

	<h4 class="gmy-1"><?php echo get_the_title(); ?></h4>

	<div class="entry-description">
		<?php  
		$wpbc_resource_desc = WPBC_get_field('wpbc_resource_desc');
		echo $wpbc_resource_desc; 
		?>

		<?php

		$wpbc_resource_code = WPBC_get_field('wpbc_resource_code');
		//$wpbc_resource_code = remove_filter( $wpbc_resource_code, 'wpautop' );
		echo '<code class="">'.$wpbc_resource_code.'</code>'; 
		?>
	</div>

	<div class="entry-meta bg-light gp-1">
		<?php WPBC_resource_template__path($post_id); ?><br>
		<?php WPBC_resource_template__terms($post_id); ?>
	</div>

</article>