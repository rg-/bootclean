<?php

add_filter('acf/load_field', 'WPBC_acf_read_only');
function WPBC_acf_read_only($field) {
	if(!empty($field['readonly'])){
		// $field['disabled'] = 'disabled';
	}
	return $field;
}

function WPBC_private_areas_get_woo_conditions(){
	$woo_conditions = array(

		'is_account_page',
		'is_cart',
		'is_checkout',
		'is_product',
		'is_product_category',
		'is_product_tag',
		'is_shop', 

	);
	return apply_filters('wpbc/filter/private_areas/woo_conditions',$woo_conditions);
} 

$private_areas_options_page = apply_filters('wpbc/filter/private_area/args', array());

if( function_exists('acf_add_options_page') ) {

	if(defined('WPBC_THEME_SETTINGS_ACTIVE') && WPBC_THEME_SETTINGS_ACTIVE==1){
	
		$args = WPBC_get_theme_settings_args(); 

		$child_page = acf_add_options_sub_page(array(

			'page_title'  => $args['options_page']['page_title'] .' > '. $private_areas_options_page['page_title'],
      'menu_title'  => $private_areas_options_page['menu_title'], 
      'menu_slug' => $private_areas_options_page['menu_slug'],
      'parent_slug' => $args['options_page']['menu_slug'],
      'capability' => $private_areas_options_page['capability'],

		)); 

		add_filter('wpbc/filter/theme_settings/admin_body_class',function($in_pages){
			$in_pages[] = 'site-settings_page_wpbc-private-areas-settings';
			return $in_pages;
		},10,1);

	} else {

		$args = array(
			'page_title'  => $args['options_page']['page_title'] .' > '. $private_areas_options_page['page_title'],
      'menu_title'  => $private_areas_options_page['menu_title'], 
      'menu_slug' => $private_areas_options_page['menu_slug'],
			'capability' => $private_areas_options_page['capability'],
		);
		
		acf_add_options_page($args);

	}

}  


function WPBC_private_areas_get_role_names(){
	global $wp_roles; 
	if ( ! isset( $wp_roles ) )
	    $wp_roles = new WP_Roles(); 
	$get_role_names = $wp_roles->get_names();
	return $get_role_names;
}

function WPBC_private_areas_settings_fields(){

	$fields = array();

	$fields[] = array (
		'key' => 'field_wpbc_private_areas__allowed_roles_group_title',
		'label' => '<h2>'.WPBC_get_svg_icon('lock').' Private Areas <u>Bootclean</u> Addon</h2>',
		'name' => '', 
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-group_title',
			'id' => '',
		),
		'message' => 'Make your site a "members" only accessible content.',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);   

	$fields[] = array (
		'key' => 'field_wpbc_private_areas__allowed_roles_headline',
		'label' => '<h3>'.WPBC_get_svg_icon('how_to_reg').' Allowed Roles</h3>',
		'name' => '', 
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => 'Choose the user roles allowed to view private areas. If you need specifyc user, just go to Users and change, the role of that user, to one allowed.',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);   

	$get_role_names = WPBC_private_areas_get_role_names(); 
	$default_allowed_roles = WPBC_private_areas_default_allowed_roles();

	foreach ($get_role_names as $key => $value) {

		$default_value = 0;
		if(in_array($key, $default_allowed_roles)){
			$default_value = 1;
 		
 			/*
			$fields[] = array (
				'key' => 'field_wpbc_private_areas__allowed_roles__'.$key,
				'label' => $value,
				'name' => 'wpbc_private_areas__allowed_roles__'.$key,
				'type' => 'text',
				'instructions' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill="#0cad0a" d="M18 7l-1.41-1.41-6.34 6.34 1.41 1.41L18 7zm4.24-1.41L11.66 16.17 7.48 12l-1.41 1.41L11.66 19l12-12-1.42-1.41zM.41 13.41L6 19l1.41-1.41L1.83 12 .41 13.41z"/></svg> Allowed *',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '20%',
					'class' => 'wpbc-hidden-input',
					'id' => '',
				), 
				'readonly' => true,
				'default_value' => $default_value,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			);
			*/

			$fields[] = array (
				'key' => 'field_wpbc_private_areas__allowed_roles__'.$key,
				'label' => $value.' *',
				'name' => 'wpbc_private_areas__allowed_roles__'.$key,
				'type' => 'true_false_advanced',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '20%',
					'class' => 'wpbc-true_false-ui ui-success',
					'id' => '', 
				), 
				'disabled' => true,
				'message' => '',
				'default_value' => $default_value,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			);

		}else{
			$fields[] = array (
				'key' => 'field_wpbc_private_areas__allowed_roles__'.$key,
				'label' => $value,
				'name' => 'wpbc_private_areas__allowed_roles__'.$key,
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '20%',
					'class' => 'wpbc-true_false-ui',
					'id' => '', 
				), 
				'message' => '',
				'default_value' => $default_value,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			);
		} 

	}

	$fields[] = array (
		'key' => 'field_wpbc_private_areas__allowed_roles_tab_message_2',
		'label' => '',
		'name' => '',
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'wpbc-acf-no-label',
			'id' => '',
		),
		'message' => '<small>(*) This users roles can´t be changed from here. </small>',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);


	$fields[] = array (
		'key' => 'field_wpbc_private_areas__redirect_url_headline',
		'label' => '<h3>'.WPBC_get_svg_icon('login').' Redirects</h3>',
		'name' => '', 
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => '',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);

	$fields[] = array(
		'key' => 'field_wpbc_private_areas__redirect_url',
		'label' => 'Private Pages redirects',
		'name' => 'wpbc_private_areas__redirect_url',
		'type' => 'group',
		'value' => NULL,
		'instructions' => 'Select the page/url where users will be redirected if visiting a private page. Default is the Wordpress login url.',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => array (

			array (
				'key' => 'field_wpbc_private_areas__redirect_url_select',
				'label' => 'Select',
				'name' => 'select',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '20%',
					'class' => '',
					'id' => '',
				),
				'choices' => array ( 
					'custom' => 'Custom Url',
					'post_object' => 'Post Object',
				),
				'default_value' => array (
					'custom' => 'Custom Url',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),

			array(
				'key' => 'field_wpbc_private_areas__redirect_url_post_object',
				'label' => 'Choose a page',
				'name' => 'post_object',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_private_areas__redirect_url_select',
								'operator' => '==',
								'value' => 'post_object',
							),
						), 
					),
				'wrapper' => array(
					'width' => '70%',
					'class' => '',
					'id' => '',
				),
				'post_type' => array('page'),
				// 'taxonomy' => array( ),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),

			array(
				'key' => 'field_wpbc_private_areas__redirect_url_post_url',
				'label' => 'Insert a valid url',
				'name' => 'url',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_private_areas__redirect_url_select',
								'operator' => '==',
								'value' => 'custom',
							),
						), 
					),
				'wrapper' => array(
					'width' => '70%',
					'class' => '',
					'id' => '',
				),
				'default_value' => wp_login_url(),
				'placeholder' => '',
			),

		),
	);



	$fields[] = array(
		'key' => 'field_wpbc_private_areas__redirect_login_url',
		'label' => 'After login redirect',
		'name' => 'wpbc_private_areas__redirect_login_url',
		'type' => 'group',
		'value' => NULL,
		'instructions' => 'Select the page/url where users will be redirected once logged in.',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => array (

			array (
				'key' => 'field_wpbc_private_areas__redirect_login_url_select',
				'label' => 'Select',
				'name' => 'select',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '20%',
					'class' => '',
					'id' => '',
				),
				'choices' => array ( 
					'last-visited' => 'Last visited Url',
					'custom' => 'Custom Url',
					'post_object' => 'Post Object',
				),
				'default_value' => array (
					'last-visited' => 'Last visited Url',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),

			array (
				'key' => 'field_wpbc_private_areas__redirect_login_url_last_visited_message',
				'label' => 'Last visited',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_private_areas__redirect_login_url_select',
								'operator' => '==',
								'value' => 'last-visited',
							),
						), 
					),
				'wrapper' => array (
					'width' => '70%',
					'class' => '',
					'id' => '',
				),
				'message' => 'User will be redirected to the last url visited. This will apply only for internal private pages.',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),

			array(
				'key' => 'field_wpbc_private_areas__redirect_login_url_post_object',
				'label' => 'Choose a page',
				'name' => 'post_object',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_private_areas__redirect_login_url_select',
								'operator' => '==',
								'value' => 'post_object',
							),
						), 
					),
				'wrapper' => array(
					'width' => '70%',
					'class' => '',
					'id' => '',
				),
				'post_type' => array('page'),
				// 'taxonomy' => array( ),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),

			array(
				'key' => 'field_wpbc_private_areas__redirect_login_url_post_url',
				'label' => 'Insert a valid url',
				'name' => 'post_url',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
						array (
							array (
								'field' => 'field_wpbc_private_areas__redirect_login_url_select',
								'operator' => '==',
								'value' => 'custom',
							),
						), 
					),
				'wrapper' => array(
					'width' => '70%',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),

		),
	);


	$fields[] = array (
		'key' => 'field_wpbc_private_areas__bypass_headline',
		'label' => '<h3>'.WPBC_get_svg_icon('lock_open').' Allowed <u>not-private</u> pages/urls</h3>',
		'name' => '', 
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => 'Choose the pages/urls that will be not-private. ',
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	); 

	$fields[] = array(
		'key' => 'field_wpbc_private_areas__bypass_post_object',
		'label' => 'Allow this Pages',
		'name' => 'wpbc_private_areas__bypass_post_object',
		'type' => 'post_object',
		'instructions' => 'Remember that every page (edit) has also it´s own selector to choose to be or not to be a private page.',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => array(
			0 => 'page',
		),
		'taxonomy' => array(
		),
		'allow_null' => 0,
		'multiple' => 1,
		'return_format' => 'object',
		'ui' => 1,
	);

	$fields[] = array (
		'key' => 'field_wpbc_private_areas__bypass_repeater_field',
		'label' => 'Allow this Urls',
		'name' => 'wpbc_private_areas__bypass_repeater_field',
		'type' => 'repeater',
		'instructions' => 'If for some reason the allowed url you need is not part of WP core posts objects, then, use this fields. Take care.',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 0,
		'max' => 0,
		'layout' => 'block',
		'button_label' => 'Add url',
		'sub_fields' => array (
			array(
				'key' => 'field_wpbc_private_areas__bypass_repeater_field_url',
				'label' => 'Valid url',
				'name' => 'url',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
		),
	);


	if( WPBC_is_woocommerce_active() ){

		$fields[] = array (
			'key' => 'field_wpbc_private_areas__bypass_headline_woo',
			'label' => '<hr><br>Allowed extended <br><br><span class="wpbc-badge">Woocommerce detected</span>',
			'name' => '', 
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Private Areas <b>will not apply</b> on this pages. *',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		); 

		$woo_conditions = WPBC_private_areas_get_woo_conditions();

		foreach ($woo_conditions as $key ) {
			$fields[] = array (
				'key' => 'field_wpbc_private_areas__bypass_woo_'.$key,
				'label' => $key.'()',
				'name' => 'wpbc_private_areas__'.$key,
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '20%',
					'class' => 'wpbc-true_false-ui',
					'id' => '', 
				), 
				'message' => '',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			);
		}

		$fields[] = array (
			'key' => 'field_wpbc_private_areas__bypass_woo_message',
			'label' => '',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '100%',
				'class' => 'wpbc-acf-no-label',
				'id' => '',
			),
			'message' => '<small>(*) Unselect them only undestanding the logic behind this. For example, the idea of having a private site, in most of the cases, is to also let users to purchase a subscription. If you have also woocommmerce installed, the only way a future client could do that is allowing the cart, checkout, product pages, etc. to be NOT private.</small>',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		);


	}


	return $fields;

}

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_private_areas_settings',
		'title' => 'Private Areas Settings',
		'fields' => WPBC_private_areas_settings_fields(),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'wpbc-private-areas-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'right',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	endif;

/* Filter allowed roles if options saved values */

add_filter( 'WPBC/filter/private_areas/allowed_roles', function($allowed_roles){

	$get_role_names = WPBC_private_areas_get_role_names(); 
	foreach ($get_role_names as $key => $value) { 
		$option_saved_value = get_field('wpbc_private_areas__allowed_roles__'.$key,'options');  
		if( $option_saved_value && !in_array($key, $allowed_roles) ){
			$allowed_roles[] = $key;
		}
	}  

	return $allowed_roles;
},0,1);  


/*
	Redirect users to this page if not allowed and not logged
*/
add_filter( 'WPBC/filter/private_areas/redirect_url', function($redirect_url, $url){
	/*
	default $redirect_url = wp_login_url();
	*/
	$redirect_url_select = get_field('wpbc_private_areas__redirect_url_select','options');
	if(!empty($redirect_url_select)){
		if($redirect_url_select == 'custom'){
			$redirect_url = get_field('wpbc_private_areas__redirect_url_url','options');
		}
		if($redirect_url_select == 'post_object'){
			$redirect_url = get_field('wpbc_private_areas__redirect_url_post_object','options');
			$redirect_url = get_permalink( $redirect_url );
		}
	}
	return $redirect_url;
},0,2);


function WPBC_private_areas_if_bypass(){
	$bypass = false;
	if( WPBC_is_woocommerce_active() ){ 

		// Get woo conditional function names (is_cart, is_product, etc)
		$get_woo_conditions = WPBC_private_areas_get_woo_conditions(); 

		$temp = array();
		foreach ($get_woo_conditions as $key ) {
			$option = get_field('wpbc_private_areas__'.$key, 'options');
			if($option){
				$temp[] = $key;
			}
		}

		if(!empty($temp)){
			foreach ($get_woo_conditions as $key ) {
				// Get options if saved
				$option = get_field('wpbc_private_areas__'.$key, 'options'); 
	 			// Check if function_exists and call it (php 7 dinamic calls as (function_name)(args) )
				if( $option && function_exists($key) && ($key)() ){ 
					$bypass = true;
				} 
			}
		}else{
			// If no options saved yet, use defaults
			foreach ($get_woo_conditions as $key ) {
				if( function_exists($key) && ($key)() ){ 
					$bypass = true;
				} 
			}
		}
		 

	}

	return $bypass;
}


add_filter( 'WPBC/filter/private_areas/bypass', function($bypass,$url){
	// defautl false 

	/*
	
	Here i need to take:

	- woo conditionals
	- Bypass this Pages -> post objects
	- Bypass this Urls -> url repeater

	*/ 

	if( WPBC_private_areas_if_bypass() ){
		$bypass = true;
	}

	return $bypass;
},0,2);


/* If woocommerce, need this too 
	$_GET['private'] is the page where the user has being redirected 
*/ 
add_filter('WPBC/filter/woocommerce/login_redirect', function ($login_redirect){
	if(isset($_GET['private'])){
		$login_redirect = $_GET['private'];
	}
	return $login_redirect;
},10,1);
  

add_filter( 'WPBC/filter/private_areas/show_alerts', function($show_alerts){
	// default true
	/*
	
	Add option

	- See priority or where the alerts output on theme
	- See WPBC_get_template_part('addons/wpbc_private_areas/alerts')
		and there see langs and options for messages

	*/
	return $show_alerts;
},0,1); 


add_action('wpbc/layout/body/start', function(){
 
 // just for testings....

}, 30 );