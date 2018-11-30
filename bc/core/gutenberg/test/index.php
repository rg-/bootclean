<?php

defined( 'ABSPATH' ) || exit;

//add_action( 'enqueue_block_editor_assets', 'gutenberg_test' );

function gutenberg_test() {
	wp_enqueue_script(
		'gutenberg-examples-01',
		BC_GUTENBERG_URI . '/test/block.js',
		array( 'wp-blocks' ),
		1
	);
} 