<?php
/**
 * Template Name: Tokko Development Single
 *
 */
?>
<?php get_header(); ?>
<?php   
 
	/*
	 *	wpbc/layout/start action
	 *	
	 *		@hooked layout__container_block_start - 1  

				WPBC_layout_struture__main_navbar - 10
				WPBC_layout_struture__main_pageheader - 20
				WPBC_layout_struture__main_content_wrap - 30
				WPBC_layout_struture__main_container - 40
				WPBC_layout_struture__main_footer - 50
				WPBC_layout_struture__main_content_wrap_end - 60

	 *
	 */  

	remove_action('wpbc/layout/start', 'WPBC_layout_struture__main_container', 40); 
	add_action('wpbc/layout/start', 'tokko_get_development_single',31);  
	
	do_action('wpbc/layout/start');  
	
	/*
	 *	wpbc/layout/end action 
	 *
	 *		@hooked action__wpbc_layout_end__container_block_end - 1 
	 *		@hooked action__wpbc_layout_end__container_end - 10 
	 *		@hooked action__wpbc_layout_end__container_row_end - 20 
	 *
	 */ 
	
	do_action('wpbc/layout/end');

?>
<?php get_footer(); ?>