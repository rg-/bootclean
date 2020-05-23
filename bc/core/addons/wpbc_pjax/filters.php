<?php

/*

	Disable ACF form on front end, not working for some pages, TODO thing

*/

add_filter('wpbc/filter/acf/enable_acf_form', function(){ 
	if( WPBC_is_pjax_enabled() ){
		return false;
	} 
},10,1);


/*

	The pJax settings to use (defaults)
	Child theme override by filter as follows..

*/
add_filter('wpbc/filter/pjax/settings', function($settings){

	$settings = array(
			
			'cacheBust' => 0,

			'elements' => 'a[href], form[action]', // default is "a[href], form[action]"
	    
	    'selectors' => array(

	    	// <head> things
	    	'title',

	    	// Bootclean uses an inline style added optional for every page
    		// this is a good example on how to re-load that on ajax call
	    	'style[id="wpbc-inline-styles-inline-css"]',

	    	// <body> things
	    	'#main-navbar', // care with this
		    // '#side-menu', // care with this

		    "#main_pageheader_container",

		    "#main-content[class]",

		    "#main-container-areas",

		    //"#WPBC_acf_form",

		    // the trick to get body data and not using body[**] that in fact, is not working ok
		    "#simulate-body-tags", 

		    //'body[class]', // NEVER DO THIS !!!
	    ), 
	);

	return $settings; 
},10,1);