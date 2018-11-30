<?php 

add_action( 'enqueue_block_editor_assets', 'BC_enqueue_block_editor_assets__fixed_content' );

function BC_enqueue_block_editor_assets__fixed_content() {
	
	global $theme_root; 
	
	add_action('admin_head', function(){
		?>
		<style>
			
		</style>
		<?php
	});
	add_action('admin_footer', function(){
		$__name_space = 'bccgb';
		?>
		<script>
		/**
		 * Hello World: Step 1
		 *
		 * Simple block, renders and saves the same content without interactivity.
		 *
		 * Using inline styles - no external stylesheet needed.  Not recommended
		 * because all of these styles will appear in `post_content`.
		 */
		( function( blocks, i18n, element ) {
			var el = element.createElement;
			var __ = i18n.__;
			
			// fixed-content
			var blockStyle = {
				backgroundColor: '#900',
				color: '#fff',
				padding: '20px'
			}; 
			blocks.registerBlockType(
				'<?php echo $__name_space; ?>/fixed-content',
				{
					title: '<?php _e( 'Fixed Content Block', 'bootclean'); ?>',
					icon: 'universal-access-alt',
					category: 'layout',
					edit: function() {
						return el(
							'p',
							{ style: blockStyle },
							'Hello World, step 1 (from the editor).'
						);
					},
					save: function() {
						return el(
							'p',
							{ style: blockStyle },
							'Hello World, step 1 (from the frontend).'
						);
					},
				}
			);
			// fixed-content END
			
		} )(
			window.wp.blocks,
			window.wp.i18n,
			window.wp.element
		);
		</script>
		<?php
		
	});
}

