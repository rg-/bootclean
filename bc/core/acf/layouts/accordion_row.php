<?php 

add_filter('WPBC_acf_builder_layouts', 'build_accordion_row',10,1);

function build_accordion_row($layouts){
	
	$content_sub_fields = array(); 

		$accordion_row_items = array();
			$accordion_row_items[] = WPBC_acf_make_text_field(array(
				'name' => 'accordion_row_item_title',
				'label' => __('Title','bootclean'),
			));
			$accordion_row_items[] = WPBC_acf_make_textarea_field(array(
				'name' => 'accordion_row_item_content',
				'label' => __('Content','bootclean'),
			));
		$content_sub_fields[] = WPBC_acf_make_repeater_field(array(
			'name' => 'accordion_row_items',
			'label' => __('Accordion items','bootclean'),
			'button_label' => __('Add item','bootclean'),
			'sub_fields' => $accordion_row_items,
		));

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => 'accordion_row',
		'layout_label' => '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><rect fill="none" fill-rule="evenodd" height="24" width="24"/><path class="path" fill="#ffffff" d="M13,9.5h5v-2h-5V9.5z M13,16.5h5v-2h-5V16.5z M19,21H5c-1.1,0-2-0.9-2-2V5 c0-1.1,0.9-2,2-2h14c1.1,0,2,0.9,2,2v14C21,20.1,20.1,21,19,21z M6,11h5V6H6V11z M7,7h3v3H7V7z M6,18h5v-5H6V18z M7,14h3v3H7V14z" fill-rule="evenodd"/></svg></i> '.__('Accordion Row','bootclean'),
		
		'content_sub_fields' => $content_sub_fields,

		'hide_section_title' => true,
		'hide_call_to_action' => true,

	), $layouts); 

	return $layouts; 
} 