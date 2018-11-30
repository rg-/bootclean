<?php

function XXX___optionsframework_options() { 
	// Test data
	$test_array = array(
		'one' => __( 'One', 'bootclean' ),
		'two' => __( 'Two', 'bootclean' ),
		'three' => __( 'Three', 'bootclean' ),
		'four' => __( 'Four', 'bootclean' ),
		'five' => __( 'Five', 'bootclean' )
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'bootclean' ),
		'two' => __( 'Pancake', 'bootclean' ),
		'three' => __( 'Omelette', 'bootclean' ),
		'four' => __( 'Crepe', 'bootclean' ),
		'five' => __( 'Waffle', 'bootclean' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  OPTIONS_FRAMEWORK_DIRECTORY . '/images/';

	/*
	
	STARTING OPTIONS
	
	*/
	
	$options = array();
	
	$to_merge = BC_get_bootclean_options();
	if(isset($to_merge)){
		foreach($to_merge as $group){ 
			$options = array_merge( $group, $options); 
		}
	}
	
	//$options = array_merge( BC_get_bootclean_options('admin'), $options);

	$options[] = array(
		'name' => __( 'Basic Settings', 'bootclean' ),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => __( 'Repeater field', 'bootclean' ),
		'desc' => __( 'A repeater field.', 'bootclean' ),
		'id' => 'example_repeater',
		'std' => 'Default',
		'type' => 'repeater'
	);

	$options[] = array(
		'name' => __( 'Input Text Mini', 'bootclean' ),
		'desc' => __( 'A mini text input field.', 'bootclean' ),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Input Text', 'bootclean' ),
		'desc' => __( 'A text input field.', 'bootclean' ),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Input with Placeholder', 'bootclean' ),
		'desc' => __( 'A text input field with an HTML5 placeholder.', 'bootclean' ),
		'id' => 'example_placeholder',
		'placeholder' => 'Placeholder',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Textarea', 'bootclean' ),
		'desc' => __( 'Textarea description.', 'bootclean' ),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Input Select Small', 'bootclean' ),
		'desc' => __( 'Small Select Box.', 'bootclean' ),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array
	);

	$options[] = array(
		'name' => __( 'Input Select Wide', 'bootclean' ),
		'desc' => __( 'A wider select box.', 'bootclean' ),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array
	);

	if ( $options_categories ) {
		$options[] = array(
			'name' => __( 'Select a Category', 'bootclean' ),
			'desc' => __( 'Passed an array of categories with cat_ID and cat_name', 'bootclean' ),
			'id' => 'example_select_categories',
			'type' => 'select',
			'options' => $options_categories
		);
	}

	if ( $options_tags ) {
		$options[] = array(
			'name' => __( 'Select a Tag', 'bootclean' ),
			'desc' => __( 'Passed an array of tags with term_id and term_name', 'bootclean' ),
			'id' => 'example_select_tags',
			'type' => 'select',
			'options' => $options_tags
		);
	}

	$options[] = array(
		'name' => __( 'Select a Page', 'bootclean' ),
		'desc' => __( 'Passed an pages with ID and post_title', 'bootclean' ),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages
	);

	$options[] = array(
		'name' => __( 'Input Radio (one)', 'bootclean' ),
		'desc' => __( 'Radio select with default options "one".', 'bootclean' ),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array
	);

	$options[] = array(
		'name' => __( 'Example Info', 'bootclean' ),
		'desc' => __( 'This is just some example information you can put in the panel.', 'bootclean' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Input Checkbox', 'bootclean' ),
		'desc' => __( 'Example checkbox, defaults to true.', 'bootclean' ),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Advanced Settings', 'bootclean' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Check to Show a Hidden Text Input', 'bootclean' ),
		'desc' => __( 'Click here and see what happens.', 'bootclean' ),
		'id' => 'example_showhidden',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Hidden Text Input', 'bootclean' ),
		'desc' => __( 'This option is hidden unless activated by a checkbox click.', 'bootclean' ),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Uploader Test', 'bootclean' ),
		'desc' => __( 'This creates a full size uploader that previews the image.', 'bootclean' ),
		'id' => 'example_uploader',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png'
		)
	);

	$options[] = array(
		'name' =>  __( 'Example Background', 'bootclean' ),
		'desc' => __( 'Change the background CSS.', 'bootclean' ),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background'
	);

	$options[] = array(
		'name' => __( 'Multicheck', 'bootclean' ),
		'desc' => __( 'Multicheck description.', 'bootclean' ),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array
	);

	$options[] = array(
		'name' => __( 'Colorpicker', 'bootclean' ),
		'desc' => __( 'No color selected by default.', 'bootclean' ),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color'
	);

	$options[] = array( 'name' => __( 'Typography', 'bootclean' ),
		'desc' => __( 'Example typography.', 'bootclean' ),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography'
	);

	$options[] = array(
		'name' => __( 'Custom Typography', 'bootclean' ),
		'desc' => __( 'Custom typography options.', 'bootclean' ),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options
	);

	$options[] = array(
		'name' => __( 'Text Editor', 'bootclean' ),
		'type' => 'heading'
	);

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress,wplink' )
	);

	$options[] = array(
		'name' => __( 'Default Text Editor', 'bootclean' ),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'bootclean' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	return $options;
}