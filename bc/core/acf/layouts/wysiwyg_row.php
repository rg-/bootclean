<?php 

add_filter('WPBC_acf_builder_layouts', 'build_wysiwyg_row',10,1);

function build_wysiwyg_row($layouts){
	
	$content_sub_fields = array();  

		$content_sub_fields[] = WPBC_acf_make_wysiwyg_field(array(
			'name' => 'wysiwyg_row_content',
			'label' => __('Wysiwyg editor','bootclean'),
			'toolbar' => 'full',
			'media_upload' => 1,
		));

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => 'wysiwyg_row',
		'layout_label' => '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path fill="#fff" class="path" d="M2.5,4v3h5v12h3V7h5V4H2.5z M21.5,9h-9v3h3v7h3v-7h3V9z"/></g></g></g></svg></i> '.__('Wysiwyg Row','bootclean'),
		
		'content_sub_fields' => $content_sub_fields,

		'hide_section_title' => true,
		'hide_call_to_action' => true,

	), $layouts); 

	return $layouts; 
} 