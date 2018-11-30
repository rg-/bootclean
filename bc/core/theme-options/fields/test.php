<?php
/*
add_filter( 'optionsframework_all', function($option_name, $value, $val){
	if ( 'test' == $value['type'] ) {
		return '<h3>Something added only for this field.</h3>';
	}
}, 10, 3 );
*/
add_filter( 'optionsframework_test', function($option_name, $value, $val){
		
	$output = '';
	
	// If there is a description save it for labels
	$explain_value = '';
	if ( isset( $value['desc'] ) ) {
		$explain_value = $value['desc'];
	}

	// Set the placeholder if one exists
	$placeholder = '';
	if ( isset( $value['placeholder'] ) ) {
		$placeholder = ' placeholder="' . esc_attr( $value['placeholder'] ) . '"';
	}
	
	
	$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '"' . $placeholder . ' />';
	
	return $output;
	
}, 10, 3 );

	
add_filter( 'of_sanitize_test', 'sanitize_text_field' );