<?php
/*

	register_nav_menus.php

*/
// TODO, admin enable add/remove menus, select default, change on pages/posts/taxonomies, so on.. like i did in BC8
// nav_menus
$primary_nav_menu_label = __( 'Primary Menu', 'bootclean' );
$primary_nav_menu_label = apply_filters('wpbc/nav_menus/primary/label', $primary_nav_menu_label);
register_nav_menus( array(
	'primary' => $primary_nav_menu_label,
) );