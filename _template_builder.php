<?php
/**
 * Template Name: Content Builder
 *
 */
?>
<?php get_header(); ?>
<?php   
 
	/*
	 *	wpbc/layout/start action
	 *	
	 *		@hooked layout__container_block_start - 1 
	 *		@hooked layout__container_start - 10 
	 *		@hooked layout__container_row_start - 20 
	 *
	 */  
	
	do_action('wpbc/layout/start'); 
 
?>
<?php  

	/*
	 *	wpbc/builder/layout/inner action
	 *	
	 *		@hooked action__wpbc_builder_layout_inner__col_content - 10 
	 *		@hooked action__wpbc_builder_layout_inner__col_sidebar - 20 
	 *
	 */
	
	do_action('wpbc/builder/layout/inner');
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