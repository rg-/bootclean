<?php 

function WPBC_tokko_get_operations($lang='es_ar'){
	if( $lang == 'en' ){
		$operations = array(
			array(
				'id' => 1,
				'name' => 'Sale'
			),
			array(
				'id' => 2,
				'name' => 'Rent'
			),
			array(
				'id' => 3,
				'name' => 'Temporary Rent'
			),
		);
	} else {
		$operations = array(
			array(
				'id' => 1,
				'name' => 'Venta'
			),
			array(
				'id' => 2,
				'name' => 'Alquiler'
			),
			array(
				'id' => 3,
				'name' => 'Alquiler Temporario'
			),
		);
	}
}

function acf_tokko_get_operation_types(){
	$api_key = tokko_config('api_key');  
	$auth = new TokkoAuth($api_key); 
	if ($auth->get_language() == 'en'){
		$operations = array(
			array(
				'id' => 1,
				'name' => 'Sale'
			),
			array(
				'id' => 2,
				'name' => 'Rent'
			),
			array(
				'id' => 3,
				'name' => 'Temporary Rent'
			),
		);
	}else{
		$operations = array(
			array(
				'id' => 1,
				'name' => 'Venta'
			),
			array(
				'id' => 2,
				'name' => 'Alquiler'
			),
			array(
				'id' => 3,
				'name' => 'Alquiler Temporario'
			),
		);
	}
	$out = '';
	if(!empty($operations)){
		$out .= "<div style='max-height:200px; overflow-y:auto;'>";
		$out .= "<ul>";
		foreach ($operations as $key => $value) {
			$out .= "<li>".$value['id']." : ".$value['name']."</li>";
		}
		$out .= "</ul>";
		$out .= "</div>";
	}
	return $out;
}

function acf_tokko_get_property_types(){

	$api_key = tokko_config('api_key');  
	$auth = new TokkoAuth($api_key); 
	$TokkoPropertyTypes = new TokkoPropertyTypes($auth);

	$out = '';
	if(!empty($TokkoPropertyTypes->property_types)){
		$out .= "<div style='max-height:200px; overflow-y:auto;'>";
		$out .= "<ul>";
		foreach ($TokkoPropertyTypes->property_types as $key => $value) {
			$out .= "<li>".$value->id." : ".$value->name."</li>";
		}
		$out .= "</ul>";
		$out .= "</div>";
	} 

	return $out;

}

function acf_tokko_get_location_types(){

	$out = '<div class="tokko_get_location_types"><input class="q" type="text" value="">';
	$out .= '<br><br><a class="button">Search</a><div class="result"></div></div>';
	return $out;
}

add_action('admin_footer',function(){
	?>
<script type="text/javascript">
	+function($){ 
		
		var tokko_get_location_types = $('.tokko_get_location_types');
		if(tokko_get_location_types.length>0){

			tokko_get_location_types.find('.button').on('click',function(){
				var q = tokko_get_location_types.find('.q').val();
				var url = '<?php echo admin_url( 'admin-ajax.php' ) .'?action=get_template&name=wpbc_tokko/ajax/get_locations&q='; ?>' + q;
				if( q != '' ){
						$.ajax({ type: "GET",   
				     url: url,   
				     success : function(text)
				     { 
				     	tokko_get_location_types.find('.result').html(text);
				     }
				});
				} 

				return false;
			});

		}

	}(jQuery); 
</script>
	<?php
},9999);

$tokko_options_page = apply_filters('wpbc/filter/tokko/args', array());

if( function_exists('acf_add_options_page') ) { 

	if(defined('WPBC_THEME_SETTINGS_ACTIVE') && WPBC_THEME_SETTINGS_ACTIVE==1){  
		$args = WPBC_get_theme_settings_args();
		$child_page = acf_add_options_sub_page(array(

			'page_title'  => $args['options_page']['page_title'] .' > '. $tokko_options_page['page_title'],
      'menu_title'  => $tokko_options_page['menu_title'], 
      'menu_slug' => $tokko_options_page['menu_slug'],
      'parent_slug' => $args['options_page']['menu_slug'],
      'capability' => $tokko_options_page['capability'],

		)); 

		add_filter('admin_body_class',function($classes){  
			if(!empty($_GET['page'] && 'wpbc-tokko-settings' == $_GET['page'] )){ 
				$classes = "$classes wpbc_site_settings wpbc_loading"; 
			}
			return $classes;
		},10,1);

	} else {

		$args = array(
			'page_title'  => $tokko_options_page['page_title'],
      'menu_title'  => $tokko_options_page['menu_title'], 
      'menu_slug' => $tokko_options_page['menu_slug'],
			'capability' => $tokko_options_page['capability'],
			'icon_url' => 'dashicons-home',
		);
		
		acf_add_options_page($args);

	}

} 

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
				'instructions' => 'One item per row separated by ":" as [<b>ID</b> : Label]. <br><br>Ex: "<b>1</b> : Terreno".',
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
				'instructions' => 'One item per row separated by ":" as [<b>ID</b> : Label]. <br><br>Ex: "<b>82611</b> : Balneario Buenos Aires". <br>Use the Search Tool to find the ID, Label text could be customized.',
			));

			$location_types_fields[] = WPBC_acf_make_message_field(array(
				'key' => 'all_location_types',
				'label' => 'Search Tokko Locations <br>Ex: "Balneario Buenos Aires uruguay"',  
				'message' => acf_tokko_get_location_types(), 
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

