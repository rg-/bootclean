	<?php 
	/*   

		wpbc/layout/body/end action

			@hooked action__wpbc_layout_body_end__main_footer - 10
			@hooked action__wpbc_layout_body_end__main_content_end - 20
			@hooked action__wpbc_layout_body_end__main_content_wrap_end - 30
			@hooked action__wpbc_layout_body_end__main_modal - 40
			@hooked action__wpbc_layout_body_end__go_up - 50

	*/

		do_action('wpbc/layout/body/end');

	?>
	<?php wp_footer(); ?>	
	</body>
</html>