<?php

/* 
	Add the options page 
	*/

	if( function_exists('acf_add_options_page') ) { 

		$args = WPBC_get_theme_settings_args();
		acf_add_options_page($args); 

	}

	/*
		Add styles, notice the menu_slug as part of the class element.
	*/
	add_filter( 'admin_body_class', 'WPBC_theme_settings_admin_body_class' ); 
	function WPBC_theme_settings_admin_body_class( $classes ) {
	    return "$classes wpbc_theme_settings wpbc_loading";
	    // Or: return "$classes my_class_1 my_class_2 my_class_3";
	}

	if(!function_exists('WPBC_theme_settings_admin_head')){ 
		add_action('admin_head', 'WPBC_theme_settings_admin_head',999); 
		function WPBC_theme_settings_admin_head(){
		?>
		<style>
			body.wpbc_loading #acf-group_wpbc_theme_settings:after{
				content:"";
				display: flex;
				align-items: center;
				justify-content: center;
				min-height: 200px;
				display: block;
				width: 100%;
				position: relative;
				background-color:transparent;
				background-repeat: no-repeat;
				background-position: center center;
				background-size:48px 48px;
				background-image: url("data:image/svg+xml;charset=utf8,%3C!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL --%3E%3Csvg width='38' height='38' viewBox='0 0 38 38' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3ClinearGradient x1='8.042%25' y1='0%25' x2='65.682%25' y2='23.865%25' id='a'%3E%3Cstop stop-color='%23000000' stop-opacity='0' offset='0%25'/%3E%3Cstop stop-color='%23000000' stop-opacity='.631' offset='63.146%25'/%3E%3Cstop stop-color='%23000000' offset='100%25'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg transform='translate(1 1)'%3E%3Cpath d='M36 18c0-9.94-8.06-18-18-18' id='Oval-2' stroke='url(%23a)' stroke-width='2'%3E%3CanimateTransform attributeName='transform' type='rotate' from='0 18 18' to='360 18 18' dur='0.9s' repeatCount='indefinite' /%3E%3C/path%3E%3Ccircle fill='%23000000' cx='36' cy='18' r='1'%3E%3CanimateTransform attributeName='transform' type='rotate' from='0 18 18' to='360 18 18' dur='0.9s' repeatCount='indefinite' /%3E%3C/circle%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
			}
			body.wpbc_loading #acf-group_wpbc_theme_settings > .acf-fields{
				display: none!important;
			}
			#adminmenu .toplevel_page_wpbc-theme-settings .wp-menu-image img {
		    width: 18px;
		    height: auto;
		    top: -2px;
		    position: relative;
		}
		}
		</style>
		<?php
		} 
	}