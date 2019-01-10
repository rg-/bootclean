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
	</div>

	<div class="entry-code gp-2 bg-light gmt-2">
		<?php  
		$wpbc_resource_code = WPBC_get_field('wpbc_resource_code');
		echo '<pre class="m-0"><code>'.$wpbc_resource_code.'</code></pre>'; 
		?> 
	</div>

	<div class="entry-meta gmt-2">
		<?php

		$wpbc_resource_github_file = WPBC_get_field('wpbc_resource_github_file');
		$wpbc_resource_github_file = str_replace('https://github.com/', '', $wpbc_resource_github_file); 
		$wpbc_resource_github_file_vars = WPBC_get_field('wpbc_resource_github_file_vars');

		$gist = 'https://gist-it.appspot.com/github/';
		$file = str_replace('https://github.com', '', $wpbc_resource_github_file);
		$vars = '?footer=0&'.$wpbc_resource_github_file_vars;

		?>

		<script src="<?php echo $gist.$file.$vars; ?>"></script>
	</div>

	<div class="alert alert-info gmt-2 gp-1">
		<?php WPBC_resource_template__path($post_id); ?><br>
		<?php WPBC_resource_template__terms($post_id); ?>
	</div>

</article>