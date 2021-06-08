<?php

/*
	
	@since 9.0.1

	@bootclean
		@template-builder


*/
// $layout_customize = WPBC_get_layout_customize();   

global $WPBC_VERSION; 


/*

		All functions used

	*/
	include('template-builder/functions.php'); 


if ( version_compare( $WPBC_VERSION, '9.0.0', '>' ) ) {
 
 	/*

 		Remove actions hooks if old version used, see how to filter WPBC_VERSION on child theme, ex:
 	
	 	add_filter('wpbc/filter/version', function(){
			return '9.0.0';
		},10,1);

	*/
	include('template-builder/version_compatible.php');

	
	/*

		The builder itself, actions and filters.
		Settings for ACF, Theme Options and so on too.


	*/
	include('template-builder/constructor.php');

}  