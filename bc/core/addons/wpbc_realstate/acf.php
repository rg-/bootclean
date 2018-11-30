<?php


/*

	ACF PART

*/ 

/*

	WPBC_property_admin_script

	Here:

		- conditional select group field

*/
add_action( 'admin_footer', 'WPBC_property_admin_script', 998 );
add_action( 'wp_footer', 'WPBC_property_admin_script', 998 );
function WPBC_property_admin_script(){
	global $post_type;
    	if( 'property' === $post_type ){
	?>

	<?php 
	$conditional_field = '';
	$conditional_target = '';
	$term_id = '';
	$property_taxonomy_list = WPBC_property_taxonomies(); 
	if(!empty($property_taxonomy_list)){ 
		foreach ($property_taxonomy_list as $key => $value) { 
			$taxonomy_id = $value['id']; 
			$property_taxonomy_tems_list = $value['default_terms'];
			if(!empty($property_taxonomy_tems_list)){
				foreach ($property_taxonomy_tems_list as $k => $v) {
					if(!empty($v['conditional_field']) && !empty($v['conditional_target']) ){
						$conditional_field = $v['conditional_field'];
						$conditional_target = $v['conditional_target'];
						$term = get_term_by('slug', $v['slug'], $conditional_field);
						$term_id = $term->term_id;
					}
				}
			}
		}
	}
	?>

	<script type="text/javascript">
		if (window.jQuery) {

			var conditional_field = "<?php echo $conditional_field; ?>";
			var conditional_target = "<?php echo $conditional_target; ?>";
			var term_id = <?php echo $term_id; ?>;
			  
			jQuery(function($) {

				$input_check = $('[data-name="'+conditional_field+'"] [type="checkbox"]'); 
				$input_true_false = $('[data-name="'+conditional_target+'"]'); 

				if( $input_check.length>0 && $input_true_false.length>0 ){
					   
					$input_check.on('change',function(el){ 
						if( $(this).val() == term_id ){ 

							if($(this).is(':checked')){
								if(!$input_true_false.find('[type="checkbox"]').is(':checked')){
									$input_true_false.find('[type="checkbox"]').trigger('click');
								}
							}else{
								if($input_true_false.find('[type="checkbox"]').is(':checked')){
									$input_true_false.find('[type="checkbox"]').trigger('click');
								}
							} 
						}
					});

					$input_check.trigger('change');
				}

			});
		}
	</script>
	<?php
	}
} 

if( function_exists('acf_add_local_field_group') ) {

	$property_slug = WPBC_property_get_slug();

	$location =  array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => $property_slug,
			),
		),
	); 

	$default_property_meta_fields = WPBC_default_property_meta_fields();
	if(!empty($default_property_meta_fields)){

		acf_add_local_field_group(array(
			'key' => 'group_wpbc_property_meta_fields',
			'title' => __('Property Record','bootclean'),
			
			'fields' => $default_property_meta_fields, 

			'location' => $location,
			'menu_order' => 1,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));

	} 

	$default_property_pricing = WPBC_default_property_pricing_fields();
	if(!empty($default_property_pricing)){

		acf_add_local_field_group(array(
			'key' => 'group_wpbc_property__pricing',
			'title' => __('Property Pricing','bootclean'),
			'fields' => $default_property_pricing,
			'location' => $location,
			'menu_order' => 5,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));

	}

	$default_property_gallery_fields = WPBC_default_property_gallery_fields();
	if(!empty($default_property_gallery_fields)){

		acf_add_local_field_group(array(
			'key' => 'group_wpbc_property_gallery_fields',
			'title' => __('Property Gallery','bootclean'),
			
			'fields' => $default_property_gallery_fields, 

			'location' => $location,
			'menu_order' => 10,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));

	}

	$default_property_location_map_fields = WPBC_default_property_location_map_fields();
	if(!empty($default_property_location_map_fields)){

		acf_add_local_field_group(array(
			'key' => 'group_wpbc_property_location_map_fields',
			'title' => __('Property Location Map','bootclean'),
			
			'fields' => $default_property_location_map_fields, 

			'location' => $location,
			'menu_order' => 90,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));

	}  

	  

} 