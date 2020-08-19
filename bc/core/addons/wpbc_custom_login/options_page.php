<?php

$custom_login_options_page = apply_filters('wpbc/filter/custom_login/args', array());

if( function_exists('acf_add_options_page') ) {

	$args = WPBC_get_theme_settings_args();

	if(defined('WPBC_THEME_SETTINGS_ACTIVE') && WPBC_THEME_SETTINGS_ACTIVE==1){  

		$child_page = acf_add_options_sub_page(array(

			'page_title'  => $args['options_page']['page_title'] .' > '. $custom_login_options_page['page_title'],
      'menu_title'  => $custom_login_options_page['menu_title'], 
      'menu_slug' => $custom_login_options_page['menu_slug'],
      'parent_slug' => $args['options_page']['menu_slug'],
      'capability' => $custom_login_options_page['capability'],

		)); 

		add_filter('admin_body_class',function($classes){  
			if(!empty($_GET['page'] && 'wpbc-custom-login-settings' == $_GET['page'] )){ 
				$classes = "$classes wpbc_site_settings wpbc_loading"; 
			}
			return $classes;
		},10,1);

	} else {

		$args = array(
			'page_title'  => $args['options_page']['page_title'] .' > '. $custom_login_options_page['page_title'],
      'menu_title'  => $custom_login_options_page['menu_title'], 
      'menu_slug' => $custom_login_options_page['menu_slug'],
			'capability' => $custom_login_options_page['capability'],
		);
		
		acf_add_options_page($args);

	}

} 

/* ACF OPTION PAGE FIELDS */

if( function_exists('acf_add_local_field_group') ){

	acf_add_local_field_group(array(
		'key' => 'group_custom_login_settings',
		'title' => _x('Custom Login Settings','bootclean'),
		'fields' => WPBC_custom_login_settings_fields(),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'wpbc-custom-login-settings',
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

	// #acf-group_custom_login_settings
	add_action('admin_head', function(){
		?>
<style>#acf-group_custom_login_settings{padding: 0 1.2rem!important;}</style>
		<?php
	},999); 

}

function WPBC_custom_login_settings_fields(){
	$fields = array();

	$fields[] = WPBC_acf_make_subtitle_field(array(
		'key' => 'field_wpbc_custom_login__title',
		'label' => _x('Custom Login Settings','bootclean'),
	));

	$fields[] = WPBC_acf_make_true_false_field(array(
		'name' => 'field_wpbc_custom_login__enable',
		'label' => _x('Enable Custom Login','bootclean'),
	));

	$sub_fields = array();
		$sub_fields[] = WPBC_acf_make_url_field(array(
			'name' => 'background-image',
			'label' => _x('URL','bootclean'),
		));
		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => 'background-width',
			'append' => 'PX',
			'width' => '20%',
			'label' => _x('Width','bootclean'),
		));
		$sub_fields[] = WPBC_acf_make_number_field(array(
			'name' => 'background-height',
			'append' => 'PX',
			'width' => '20%',
			'label' => _x('Height','bootclean'),
		));
	$fields[] = WPBC_acf_make_group(array(
		'name' => 'field_wpbc_custom_login__login_brand_image',
		'label' => _x('Brand image','bootclean'),
		'sub_fields' => $sub_fields,		
	));
	
	return $fields;
}

add_filter('acf/load_value/type=image', 'reset_default_image', 10, 3);
function reset_default_image($value, $post_id, $field) {
  if (!$value) {
    $value = $field['default_value'];
  }
  return $value;
}