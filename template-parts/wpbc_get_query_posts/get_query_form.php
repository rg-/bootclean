<?php 

	/*

	get_query_form

	[WPBC_get_query_form] Shortocode template
	
	All args passed since included

		@action: wpbc_get_query_form

		@hooked:

			wpbc_get_query_form_start - 10
			wpbc_get_query_form_fields - 20
			wpbc_get_query_form_controls - 30
			wpbc_get_query_form_buttons - 40
			wpbc_get_query_form_end - 99

	*/

	do_action('wpbc_get_query_form', $query, $shortcode_args, $template_args, $query_fields, $form_elements);

?>