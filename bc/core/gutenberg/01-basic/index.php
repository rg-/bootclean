<?php

defined( 'ABSPATH' ) || exit;

add_action( 'enqueue_block_editor_assets', 'gutenberg_examples_01_enqueue_block_editor_assets' );

function gutenberg_examples_01_enqueue_block_editor_assets() {
	wp_enqueue_script(
		'gutenberg-examples-01',
		BC_GUTENBERG_URI . '/01-basic/block.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		1
	);
}
function gutenberg_examples_01_enqueue_block_editor_assets__() {
	wp_enqueue_script(
		'gutenberg-examples-01',
		plugins_url( 'block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);
}