<?php 
if( !is_user_logged_in() ){
	echo __('Login','bootclean');
}else{
	echo get_the_title( wc_get_page_id( 'myaccount' ) );
}