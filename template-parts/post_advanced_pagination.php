<?php
	$args = array(
		'use_ajax' => apply_filters('wpbc/filter/advanced_pagination/use_ajax',false),
		'use_get_next' => apply_filters('wpbc/filter/advanced_pagination/use_get_next',false),
		'more_text' => __('Load more posts','bootclean'),
		'more_text_last' => __('No more posts to load', 'bootclean'), 
		'more_class' => 'btn btn-black btn-max',

		'nav_class' => 'gpy-2 text-left',
		'prev_arrow' => '<i class="wpbci-angle-left"></i>',
		'next_arrow' => '<i class="wpbci-angle-right"></i>',
	);
	$args = apply_filters('wpbc/filter/advanced_pagination/args',$args);
	WPBC_advanced_posts_pagination($args); ?>