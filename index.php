<?php get_header(); ?>

<?php   
 
	/*
	 *	wpbc/layout/start action
	 *	
	 *		@hooked layout__container_block_start - 1 
	 *		@hooked layout__container_start - 10 REMOVED
	 *		@hooked layout__container_row_start - 20 REMOVED

				WPBC_layout_struture__main_navbar - 10
				WPBC_layout_struture__main_pageheader - 20
				WPBC_layout_struture__main_content_wrap - 30
				WPBC_layout_struture__main_container - 40
				WPBC_layout_struture__main_footer - 50
				WPBC_layout_struture__main_content_wrap_end - 60

	 *
	 */  
	
	do_action('wpbc/layout/start'); 
	
?>

<?php  

	
	/*
	 *	wpbc/layout/inner action
	 *	
	 *		@hooked action__wpbc_layout_inner__col_content - 10 
	 *		@hooked action__wpbc_layout_inner__col_sidebar - 20 
	 *
	 */
	
	do_action('wpbc/layout/inner');

?>

<?php
	
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
