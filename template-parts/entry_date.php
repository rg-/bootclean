<?php if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) { ?>
<div class="entry-date">
	<?php echo WPBC_post_date(); ?>
</div>
<?php } ?>