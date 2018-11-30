<?php
// My be a good idea is to place this file in root... ?¡?¡? TODO
// Custom default variables for Theme (optional)
if( file_exists(stream_resolve_include_path(BC_ABSPATH.'/theme-settings.php')) ){ 
	include(BC_ABSPATH.'/theme-settings.php'); 
} 

// temporal array just in case
$theme_pre_root = $theme_root;
 
if(!empty($theme_customs)){ 
	$theme_root = array_merge( $theme_root, array('theme-settings'=>true));
	$theme_root = array_replace_recursive ( $theme_root, $theme_customs );
}
// $theme array will hold optinal/custom template settings, ej. replace <title> on some page.
if(!empty($theme)){
	$theme_root = array_replace_recursive  ( $theme_root , $theme);
}

?>