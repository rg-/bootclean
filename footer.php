	<?php 
	/*   

		wpbc/layout/body/end action
		
			@hooked action__wpbc_layout_body_end__main_footer - 10
			@deprecated since 9.0.1 see /template-builder/...
			@hooked action__wpbc_layout_body_end__main_content_end - 20
				@deprecated since 9.0.1 see /template-builder/...
				
			@hooked action__wpbc_layout_body_end__main_content_wrap_end - 30
			@hooked action__wpbc_layout_body_end__main_modal - 40
			@hooked action__wpbc_layout_body_end__go_up - 50

	*/

		do_action('wpbc/layout/body/end');

	?>
	<?php wp_footer();

	do_action('wpbc/layout/wp_footer/after');
	?>	
	</body>
</html>