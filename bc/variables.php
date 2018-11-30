<?php
/*

	// TODO, leave this for WP, use something else DONE!

	Default Variables, to replace anything you have two options:

		# Globaly via theme-settings.json file
		
		
		# For particual template, before "require 'bc/_php_head.php'; " write your owns parameters, like
			
			$theme['head-styles']['main']['src']['your-new-css-src-file.css']
		
			In that example, default css/main.css file will be replaced with the custom one.

	Note, you can add new parameters into $theme_root, not just default ones. Since $theme_root then is global, you can access it anywhere, components, layouts, partials, etc.
	
*/

$theme_root['version'] = '9.0.0';  
$theme_root['abspath'] = BC_ABSPATH;  
/* Bootstrap default color scheme names (used mostly on demo preview pages) */
$theme_root['scheme'] = array(
	'primary',
	'secondary',
	'success',
	'info',
	'warning',
	'danger',
	'light',
	'dark',
	'white',
	'transparent'
);

/* REQUIRED Css used by default on all pages */
$theme_root['head-styles'] = array(
	
	'main'=>	array( 
		'src'=>'css/main.css'
	), 
	
	'addons'=>	array( 
		'src'=>'css/addons.css'
	), 
	
	'custom'=>	array( 
		'src'=>'css/custom.css'
	)

);

$theme_root['head-fonts'] = array(); 
$theme_root['fontawesome'] = false; 
if(!empty($theme_root['fontawesome'])){ 
	$theme_root['head-fonts'] = array_merge($theme_root['head-fonts'], array(
		'fontawesome-all'=>	array( 
			'src'=>'css/fontawesome/all.min.css'
		)
	)); 
}
$theme_root['head-scripts'] = array(

	'html5shiv'=>	array( 
		'src'=>'js/html5shiv/html5shiv.min.js',
		'conditional'=>'lt IE 9'
	),
	'respond'=>	array( 
		'src'=>'js/respond/respond.min.js',
		'conditional'=>'lt IE 9'
	)

);
/* REQUIRED JS used by default on all pages */ 
$theme_root['footer-scripts'] = array( 
	'jquery'=>	array( 
		'src'=>'js/jquery.min.3.1.1.js'
	),
	
	'bootstrap'=>	array( 
		'src'=>'js/bootstrap.bundle.min.js'
	),
	
	'main'=>	array( 
		'src'=>'js/main.js'
	)
	
	//'custom'=>	array( 
			//'src'=>'js/custom.js'
	//)
	
);

// $font-family-sans-serif:      -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !default;
	// $theme_root['google-fonts']['base']['href'] = 'https://fonts.googleapis.com/css?family=Quicksand';
	// $theme_root['google-fonts']['base']['font-family'] = "'Quicksand', sans-serif;"; 

// Or even a better and more flexible way to add styles, css or anything else just before head close tag.
	// $theme_root['head-close'] = '<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">';
	// $theme_root['head-close'] .= "<style>body{font-family: 'Quicksand', sans-serif; }</style>";



// Some custom font...
/*
$theme_root['head-close'] .= "<style>
@font-face {
  font-family: 'Cassannet-Regular';
  src: url('fonts/cassannet/Cassannet-Regular.eot?#iefix') format('embedded-opentype'),  url('fonts/cassannet/Cassannet-Regular.otf')  format('opentype'),
	     url('fonts/cassannet/Cassannet-Regular.woff') format('woff'), url('fonts/cassannet/Cassannet-Regular.ttf')  format('truetype'), url('fonts/cassannet/Cassannet-Regular.svg#Cassannet-Regular') format('svg');
  font-weight: normal;
  font-style: normal;
} 
body,
font-cassannet{
	font-family:'Cassannet-Regular';
}
</style>";
*/

// HTML/HEAD things
$theme_root['html-lang'] = 'en';  
$theme_root['head-tag-title'] = true;
$theme_root['head-tag-description'] = true;
$theme_root['head-tag-title-separation'] = ' | ';

//$theme_root['body']['class'] = dirname();

// default main-navbar enabled (ex: when no navbar used)
$theme_root['main-navbar']['enabled'] = true;
// default main-footer enabled (same as above)
$theme_root['main-footer']['enabled'] = true;
?>