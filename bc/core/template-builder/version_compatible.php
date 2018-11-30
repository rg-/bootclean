<?php


add_action('wpbc/builder/layout/inner', function(){ 
 
	 remove_action('wpbc/builder/layout/inner','action__wpbc_builder_layout_inner__col_content', 10);
	 remove_action('wpbc/builder/layout/inner','action__wpbc_builder_layout_inner__col_sidebar', 20);
	 
}, 0 );  

add_action('wpbc/layout/start', function(){ 
 
	 remove_action('wpbc/layout/start','action__wpbc_layout_start__container_start', 10);
	 remove_action('wpbc/layout/start','action__wpbc_layout_start__container_row_start', 20);
	  
}, 0 ); 
add_action('wpbc/layout/end', function(){ 
 
	 remove_action('wpbc/layout/end','action__wpbc_layout_end__container_row_end', 10);
	 remove_action('wpbc/layout/end','action__wpbc_layout_end__container_end', 20);
 
}, 0 ); 

add_action('wpbc/layout/inner', function(){ 
	 
	 remove_action('wpbc/layout/inner','action__wpbc_layout_inner__col_content', 10);
	 remove_action('wpbc/layout/inner','action__wpbc_layout_inner__col_sidebar', 20);
 
}, 0 ); 

add_action('wpbc/layout/body/start', function(){ 
	 
	 remove_action('wpbc/layout/body/start','action__wpbc_layout_body_start__main_navbar', 30); 
	 remove_action('wpbc/layout/body/start','action__wpbc_layout_body_start__page_header', 35); 
	 remove_action('wpbc/layout/body/start','action__wpbc_layout_body_start__main_content_wrap_start', 35); 
	 
}, 0 ); 

add_action('wpbc/layout/body/end', function(){ 
	 
	 remove_action('wpbc/layout/body/end','action__wpbc_layout_body_end__main_footer', 10);
	 remove_action('wpbc/layout/body/end','action__wpbc_layout_body_end__main_content_end', 20);
	 
}, 0 ); 