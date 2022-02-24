<?php


function WPBC_tokko_settings_fields(){

	$fields = array();      

	$fields[] = WPBC_acf_make_message_field(array(
		'key' => 'field_wpbc_tokko_title',
		'label' => '<h2>'.WPBC_get_svg_icon('realstate').' Tokko Brokker <u>Bootclean</u> Addon</h2>',
		'class' => 'wpbc-group_title', 
		'message' => 'Let your Wordpress site run Tokko Broker API resources.', 
	));

	$fields[] = WPBC_acf_make_tab_field(array(
		'key' => 'field_wpbc_tokko_tab_keys',
		'label' => 'API/KEYS', 
	));

		$fields[] = WPBC_acf_make_text_field(array(
			'name' => 'wpbc_tokko_apikey',
			'label' => 'API Key',
			'class' => '', 
			'instructions' => 'For testings use: 5940ea45eb7cfb55228bec0b958ea9c0be151757', 
		));

		$fields[] = WPBC_acf_make_text_field(array(
			'name' => 'wpbc_tokko_google_maps_api_key',
			'label' => 'Google Maps API Key',
			'class' => '', 
			'instructions' => 'Required for maps', 
		));

	$fields[] = WPBC_acf_make_tab_field(array(
		'key' => 'field_wpbc_tokko_tab_pages',
		'label' => 'PAGES/TEMPLATES', 
	));

		$fields[] = WPBC_acf_make_post_object_field(array(
			'name' => 'wpbc_tokko_post_object_single_property',
			'label' => 'Single Property Page Template',
			'post_type' => array('page'),
			'multiple' => 0,
		)); 

		$fields[] = WPBC_acf_make_post_object_field(array(
			'name' => 'wpbc_tokko_post_object_single_development',
			'label' => 'Single Developments Page Template',
			'post_type' => array('page'),
			'multiple' => 0,
		));

		$fields[] = WPBC_acf_make_text_field(array(
			'name' => 'wpbc_tokko_form_single_property',
			'label' => 'Contact Form used on single Property page',
			'class' => '', 
			'instructions' => 'Shortcode', 
		));

	$fields[] = WPBC_acf_make_tab_field(array(
		'key' => 'field_wpbc_tokko_tab_form',
		'label' => 'FORM', 
	));

	// operation_types
	$operation_types_fields = array();  

			$operation_types_fields[] = WPBC_acf_make_textarea_field(array(
				'name' => 'available_operation_types_group',
				'label' => 'Available Operation Types List', 
				'width' => '50%',
				'class' => 'available_operation_types_group',
				'rows' => '7',
				'instructions' => 'One item per row separated by ":" as [<b>ID</b> : Label]. <br><br>Ex: "<b>1</b> : Terreno".',
			));

			$operation_types_fields[] = WPBC_acf_make_message_field(array(
				'key' => 'all_operation_types',
				'label' => 'All Tokko Operation Types',  
				'message' => acf_tokko_get_operation_types(), 
				'width' => '50%',
			));

		$fields[] = WPBC_acf_make_group_field(array(
			'name' => 'wpbc_tokko_operation_types',
			'label' => 'Available Operation Types (Forms)',
			'sub_fields' => $operation_types_fields,
		));

	$property_types_fields = array();  

			$property_types_fields[] = WPBC_acf_make_textarea_field(array(
				'name' => 'available_property_types_group',
				'label' => 'Available Property Types List', 
				'width' => '50%',
				'class' => 'available_property_types_group',
				'rows' => '7', 
			));

			$property_types_fields[] = WPBC_acf_make_message_field(array(
				'key' => 'all_property_types',
				'label' => 'All Tokko Property Types',  
				'message' => acf_tokko_get_property_types(), 
				'width' => '50%',
			));

		$fields[] = WPBC_acf_make_group_field(array(
			'name' => 'wpbc_tokko_property_types',
			'label' => 'Available Property Types (Forms)',
			'sub_fields' => $property_types_fields,
		));

	$location_types_fields = array();
   
			$location_types_fields[] = WPBC_acf_make_textarea_field(array(
				'name' => 'available_locations_group',
				'label' => 'Available Locations List', 
				'width' => '50%',
				'class' => 'available_locations_group',
				'rows' => '7', 
			));

			$location_types_fields[] = WPBC_acf_make_message_field(array(
				'key' => 'all_location_types',
				'label' => 'Search Tokko Locations <br>Ex: "Balneario Buenos Aires uruguay"',  
				'message' => acf_tokko_get_location_types('field_available_locations_group'), 
				//'message' => acf_tokko_get_location_types(), 
				'width' => '50%', 
			));   


		$fields[] = WPBC_acf_make_group_field(array(
			'name' => 'wpbc_tokko_location_types',
			'label' => 'Available Locations (Forms)',
			'sub_fields' => $location_types_fields,
		));
	

		

	return $fields;

}

if( function_exists('acf_add_local_field_group') ):
	
	if(defined('WPBC_THEME_SETTINGS_ACTIVE') && WPBC_THEME_SETTINGS_ACTIVE==1){  
		$style = 'seamless';
	}else{
		$style = 'block';
	}

	acf_add_local_field_group(array(
		'key' => 'group_tokko_settings',
		'title' => 'Tokko Broker Settings',
		'fields' => WPBC_tokko_settings_fields(),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'wpbc-tokko-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => $style,
		'label_placement' => 'right',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	// #acf-group_private_areas_settings
	add_action('admin_head', function(){
		?>
<style>#acf-group_tokko_settings{padding: 0 1.2rem!important;}</style>
		<?php
	},999); 

	endif;