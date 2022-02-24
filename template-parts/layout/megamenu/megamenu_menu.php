<?php 

$menu = new WPBC_Bootstrap_Nav_Menu(); 
$menu->setMenu($args['id']);
$menu->setListClass('');
$menu->setLinkClass('nav-link');
$menu->showMenu();

?>