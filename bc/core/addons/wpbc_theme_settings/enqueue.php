<?php
add_action('admin_footer','WPBC_theme_settings_admin_footer',999);
function WPBC_theme_settings_admin_footer(){
	?>
<script id="WPBC_theme_settings_admin_footer">
	
	(function($) {


		$(window).on('load',function(){ 
			setTimeout(function(){ 
				$('body.wpbc_loading').removeClass('wpbc_loading');
			}, 1000); 
		});

		var accordion_layouts = $('.wpbc-acf-accordion-layout');

		accordion_layouts.each(function(){

			var me = $(this); 
			var layout_location = me.find('.layout_location .acf-input input[type="radio"]');

			layout_location.on('click', function(){

				var img_to_replace = me.find('.acf-accordion-title img.icon');
				$new_img = $(this).parent().find('.radio-as-thumb-img-thumb').attr('src')
				img_to_replace.attr('src', $new_img)
				//alert( $(this).parent().find('.radio-as-thumb-img-thumb').attr('src') );

			});

		});

	})(jQuery); 

</script>
	<?php
}
 
/*

	Maybe something like this should be used to the entire core.

	Add styles, notice the menu_slug as part of the class element.
*/
add_filter( 'admin_body_class', 'WPBC_theme_settings_admin_body_class' ); 
function WPBC_theme_settings_admin_body_class( $classes ) {

		$get_current_screen = get_current_screen();

		$in_pages = array(
			'toplevel_page_wpbc-site-settings',
			'toplevel_page_wpbc-theme-design',
		);
		$in_pages = apply_filters('wpbc/filter/theme_settings/admin_body_class',$in_pages);

		if( in_array($get_current_screen->id, $in_pages) ){
			$classes = "$classes wpbc_site_settings wpbc_loading";
		}

    return $classes;
    // Or: return "$classes my_class_1 my_class_2 my_class_3";
}

if(!function_exists('WPBC_theme_settings_admin_head')){ 
	add_action('admin_head', 'WPBC_theme_settings_admin_head',999); 
	function WPBC_theme_settings_admin_head(){

		$get_current_screen = get_current_screen();
		// toplevel_page_wpbc-theme-settings
		// echo $get_current_screen->id;

	?>
	<style>
		body.wpbc_loading .acf-postbox.seamless:after,
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
		body.wpbc_loading .acf-postbox.seamless > .acf-fields,
		body.wpbc_loading #acf-group_wpbc_theme_settings > .acf-fields{
			display: none!important;
		}
		#adminmenu .toplevel_page_wpbc-site-settings .wp-menu-image img {
	    width: 18px;
	    height: auto;
	    top: -2px;
	    position: relative;
		}
		#adminmenu .toplevel_page_wpbc-site-settings li a svg{
			vertical-align: -6px; width: 16px;
			margin-right: 5px;
		}

		body.wpbc_site_settings .acf-fields .acf-label label h2{
			font-size: 1.6em!important;
	    margin: 1em 0!important;
	    padding: 0!important;
	    font-weight: 600!important;
		}
		body.wpbc_site_settings .acf-postbox.seamless{
			padding:0 1.2rem;
			border: 1px solid #ccd0d4!important;
	    box-shadow: 0 1px 1px rgba(0,0,0,.04)!important;
	    background-color: #fff!important;
		} 
		
	}
	</style>
	<?php
	} 
}