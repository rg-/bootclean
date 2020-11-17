<?php

/*
 
http://aispuru.bootclean.loc//wp-admin/admin-ajax.php?action=get_template&name=wpbc_tokko/ajax/get_developments&limit=1&tk_page=2

*/

$api_key = tokko_config('api_key'); 
$auth = new TokkoAuth($api_key); 
$search = new TokkoDevelopmentList($auth);

$limit = 9;
$order_by = 'id';
$order = 'desc';
$pagination = $_REQUEST['pagination'];
$result_detail = $_REQUEST['result_detail'];

$search->get_development_list(); 
//
//  _print_code($search->get_developments());
// _print_code($search->get_developments());
//_print_code($search);
foreach ($search->get_developments() as $development){

	_print_code($development->get_field('name'));
	_print_code($development->get_field('id'));

}