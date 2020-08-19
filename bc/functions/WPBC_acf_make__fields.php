<?php

/*
 * WPBC_acf_make_* functions
 * Helpers for fast coding....
*/ 

/*
	
	HOW TO USE
	Base function

	function WPBC_acf_make_[FIELD_TYPE]_field($args){
		if(empty($args['key'])) return;
		$defaults = array (
		
			[FIELD_ARGUMENTS]

		);
		$field = array_merge($defaults, $args); 
		return $field;
	}


*/

function WPBC_acf_make_fields__filter($field, $args){
	if(!empty($args['class'])){
		if(empty($args['wrapper']['class'])){
			$field['wrapper']['class'] = $args['class'];
		}else{
			$field['wrapper']['class'] .= ' '.$args['class'];
		} 
	} 
	if( !empty($args['width']) ){
		$field['wrapper']['width'] = $args['width'];
	}
	return apply_filters('wpbc/filter/acf_make_fields/field', $field, $field['type']);
}

/*
	
	Auto include all files (functions) for each field

	Field name should be just the field type name, ex:

	For the function "WPBC_acf_make_text_field", the file should be "text.php"

	That is :

		fx: WPBC_acf_make_[FIELD_TYPE]_field($args);
		php: ../WPBC_acf_make_fields/[FIELD_TYPE].php

*/

$WPBC_acf_make_fields = BC_ABSPATH.'/functions/WPBC_acf_make_fields/*.php';
foreach (glob($WPBC_acf_make_fields) as $filename) {
    include $filename;
} 

/*
 * WPBC_acf_make_* functions END
 */