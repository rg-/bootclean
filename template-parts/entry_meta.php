<?php if ( 'post' === get_post_type() ) { ?>
<div class="entry-meta">
	<?php echo WPBC_get_the_terms(array(
	'post_id'=> get_the_ID(),
	'before' => __('Category:','bootclean').' ',
)); ?>
</div>
<div class="entry-meta">
	<?php echo WPBC_get_the_terms(array(
	'post_id'=> get_the_ID(),
	'taxonomy' => 'post_tag',
	'before' => __('Tag:','bootclean').' ',
)); ?>
</div>
<?php } ?>