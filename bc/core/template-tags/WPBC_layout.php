<?php

/**
 * WPBC_layout
 *
 * @package WPBC_templates
 * @subpackage WPBC_layout
 * @since Bootclean 9.0
 */


/* 
	TODO, separate things like 
	- defaults for every part same as WPBC_layout__main_navbar_defaults 
*/

include('wpbc_layout/functions.php'); 
include('wpbc_layout/defaults.php'); 


/* <head> action hooks */

/*

	wpbc/head/favicons action

		@hooked action__wpbc_head_favicons - 10


*/

add_action('wpbc/head/favicons', 'action__wpbc_head_favicons', 10); 
	
	function action__wpbc_head_favicons(){
		get_template_part( 'template-parts/layout/head-favicons' ); 
	}

/*

	wpbc/head/scripts action

		@hooked action__wpbc_head_scripts_config - 10


*/

add_action('wpbc/head/scripts', 'action__wpbc_head_scripts_config', 10); 
	
	function action__wpbc_head_scripts_config(){
		get_template_part( 'template-parts/layout/head-scripts-config' ); 
	}


/*   

	This ones in header.php

	wpbc/layout/body/start action

		@hooked action__wpbc_layout_body_start__loader - 10
		@hooked action__wpbc_layout_body_start__main_content_start - 20

		@hooked action__wpbc_layout_body_start__main_navbar - 30
			@deprecated since 9.0.1 see /template-builder/...
 		@hooked action__wpbc_layout_body_start__page_header - 35
 			@deprecated since 9.0.1 see /template-builder/...
 		@hooked action__wpbc_layout_body_start__main_content_wrap_start - 40
 			@deprecated since 9.0.1 see /template-builder/...

*/
  
 
add_action('wpbc/layout/body/start', 'action__wpbc_layout_body_start__loader', 10); 
	
	function action__wpbc_layout_body_start__loader(){
		get_template_part( 'template-parts/layout/body-loader' );  
	}

add_action('wpbc/layout/body/start', 'action__wpbc_layout_body_start__main_content_start', 20); 
	function action__wpbc_layout_body_start__main_content_start(){ 
		?>
		<div id="main-content" class="layout__main_content <?php WPBC_class_main_content(); ?>">
		<?php
	}

add_action('wpbc/layout/body/start', 'action__wpbc_layout_body_start__main_navbar', 30);
 	function action__wpbc_layout_body_start__main_navbar(){ 
		get_template_part( 'template-parts/layout/main-navbar' ); 
	}

add_action('wpbc/layout/body/start', 'action__wpbc_layout_body_start__page_header', 35);
 	function action__wpbc_layout_body_start__page_header(){  
		get_template_part( 'template-parts/layout/page-header' ); 
	}

add_action('wpbc/layout/body/start', 'action__wpbc_layout_body_start__main_content_wrap_start', 40); 
	function action__wpbc_layout_body_start__main_content_wrap_start(){ 
		?>
 		<div id="main-content-wrap" class="layout__main_content_wrap aside-expand-content <?php WPBC_class_main_content_wrap(); ?>">
		<?php
	}
/*  

	This ones in footer.php

	wpbc/layout/body/end action

		@hooked action__wpbc_layout_body_end__main_footer - 10
			@deprecated since 9.0.1 see /template-builder/...
		@hooked action__wpbc_layout_body_end__main_content_end - 20
			@deprecated since 9.0.1 see /template-builder/...
			
		@hooked action__wpbc_layout_body_end__main_content_wrap_end - 30
		@hooked action__wpbc_layout_body_end__main_modal - 40
		@hooked action__wpbc_layout_body_end__go_up - 50

*/ 

add_action('wpbc/layout/body/end', 'action__wpbc_layout_body_end__main_footer', 10); 
	function action__wpbc_layout_body_end__main_footer(){ 
		get_template_part( 'template-parts/layout/main-footer' ); 
	}
add_action('wpbc/layout/body/end', 'action__wpbc_layout_body_end__main_content_end', 20); 
	function action__wpbc_layout_body_end__main_content_end(){
		?>
		</div><!-- #main-content-wrap END -->
		<?php
	}
add_action('wpbc/layout/body/end', 'action__wpbc_layout_body_end__main_content_wrap_end', 30); 
	function action__wpbc_layout_body_end__main_content_wrap_end(){ 
		?> 
			</div><!-- #main-content END -->
			<div id="wpbc_container_reference" class="container" style="visibility:hidden;"></div>
		<?php
	}

add_action('wpbc/layout/body/end', 'action__wpbc_layout_body_end__main_modal', 40);
	function action__wpbc_layout_body_end__main_modal (){ 
		get_template_part( 'template-parts/layout/main-modal' ); 
	}
add_action('wpbc/layout/body/end', 'action__wpbc_layout_body_end__go_up', 50);
	function action__wpbc_layout_body_end__go_up(){ 
		get_template_part( 'template-parts/layout/go-up' ); 
	}

/*
 * 
 * This ones wrap index.php globaly
 * 
 * 
 * 	@action wpbc/layout/start
 * 
 * 		@action wpbc/layout/inner
 * 	
 * 	@action wpbc/layout/end
 *	
 */ 


/*
 *	wpbc/layout/start action
 *	
 *		@hooked action__wpbc_layout_start__container_block_start - 1 
 *		@hooked action__wpbc_layout_start__container_start - 10 
 *			@deprecated since 9.0.1 see /template-builder/...
 *		@hooked action__wpbc_layout_start__container_row_start - 20 
 *			@deprecated since 9.0.1 see /template-builder/...
 *
 *
 */ 

add_action('wpbc/layout/start', 'action__wpbc_layout_start__container_block_start', 1);
	function action__wpbc_layout_start__container_block_start(){
		?><div class="layout__container_block_start <?php WPBC_class_container_block(); ?>"><?php
	}
add_action('wpbc/layout/start', 'action__wpbc_layout_start__container_start', 10);
	function action__wpbc_layout_start__container_start(){
		?><div class="layout__container_start <?php WPBC_class_container(); ?>"><?php
	}
add_action('wpbc/layout/start', 'action__wpbc_layout_start__container_row_start', 20);
	function action__wpbc_layout_start__container_row_start(){
		?><div class="layout__container_row_start <?php WPBC_class_row(); ?>"><?php
	}

/* ----------------------------------------------------------------------------- */

	/*
	 *	wpbc/layout/inner action
	 *	
	 *		@hooked action__wpbc_layout_inner__col_content - 10 
	 *		@hooked action__wpbc_layout_inner__col_sidebar - 20 
	 *
	 *		@deprecated since 9.0.1 see /template-builder/...
	 *
	 */
 

	add_action('wpbc/layout/inner', 'action__wpbc_layout_inner__col_content', 10);
		function action__wpbc_layout_inner__col_content(){
			get_template_part( 'template-parts/col_content' ); 
		}
	add_action('wpbc/layout/inner', 'action__wpbc_layout_inner__col_sidebar', 20);
		function action__wpbc_layout_inner__col_sidebar(){
			get_template_part( 'template-parts/col_sidebar' ); 
		}

/* ----------------------------------------------------------------------------- */

/*
 *	wpbc/layout/end action 
 *
 *		@hooked action__wpbc_layout_end__container_row_end - 10
 *			@deprecated since 9.0.1 see /template-builder/...
 *		@hooked action__wpbc_layout_end__container_end - 20
 *			@deprecated since 9.0.1 see /template-builder/... 
 *		@hooked action__wpbc_layout_end__container_block_end - 99 
 *
 */

add_action('wpbc/layout/end', 'action__wpbc_layout_end__container_row_end', 10);
	function action__wpbc_layout_end__container_row_end(){
		?></div><!-- .row --><?php
	}

add_action('wpbc/layout/end', 'action__wpbc_layout_end__container_end', 20);
	function action__wpbc_layout_end__container_end(){
		?></div><!-- .container --><?php
	}

add_action('wpbc/layout/end', 'action__wpbc_layout_end__container_block_end', 99);
	function action__wpbc_layout_end__container_block_end(){
	?></div><!-- .container-block --><?php
}

/* ----------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------- */


/* ----------------------------------------------------------------------------- */


add_action('WPBC_sidebar', 'WPBC_sidebar_widgets', 10);

	function WPBC_sidebar_widgets(){
		
		/*
		Not using this since the shortcode to get any widget.... see widgets_init
		
		$widgets = WPBC_widgets_init__defaults();
		if(!empty($widgets)){
			foreach($widgets as $widget=>$values){
				if ( is_active_sidebar( $values['id'] ) ) { 
					echo apply_filters('WPBC_dynamic_sidebar_before','<div id="'.$values['id'].'" class="'.$values['id'].' widget-area" role="complementary">');
					dynamic_sidebar( $values['id'] );
					echo apply_filters('WPBC_dynamic_sidebar_after','</div>'); 
				}
			}
		}
		
		*/
	}
/* ----------------------------------------------------------------------------- */