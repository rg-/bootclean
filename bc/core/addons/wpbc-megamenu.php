<?php

/*
	@bootclean
		@core
			@addons
				@wpbc-megamenu 

	Megamenu for WP Menus. ACF custom nav menu filter apply and required for that, see rest of code, it´s clear.
	
	Dependence on ACF, only for the selection on each menu item. Rest can be applied using actions/filters/shortcodes.... some way for sure.

*/ 
 
include('wpbc_megamenu/functions.php'); 
include('wpbc_megamenu/filters.php'); 
include('wpbc_megamenu/acf.php'); 

//include('wpbc_megamenu/_test.php');   