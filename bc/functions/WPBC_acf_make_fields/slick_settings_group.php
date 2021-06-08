<?php 
/*

	slick_settings_group field

*/
function WPBC_acf_make_slick_settings_group_field($args, $is_registered_option=false){
	
	if(empty($args['name'])) return;

	$sub_fields = array(); 

		$sub_fields[] = WPBC_acf_make_group_field(array(
			'label' => __('Slider Options','bootclean'),
			'name' => $args['name'].'__options',
			'sub_fields' => WPBC_acf_get_slick_options($args['name'].'__options'), 
			'class' => 'wpbc-tabsless-group acf-group-seamless wpbc-acf-highlighted-field info-light',
		));


		$sub_fields[] = WPBC_acf_make_true_false_field(array(
			'name' => $args['name'].'__use_heights',
			'label'=>  __('Use Slider Responsive Heights?','bootclean'),  
			'default_value' => '0',
			'class' => 'wpbc-true_false-ui wpbc-acf-highlighted-field dark wpbc-acf-flex-field', 
		));

		$sub_fields[] = WPBC_acf_make_group_field(array(
			'label' => __('Slider Heights','bootclean'),
			'name' => $args['name'].'__heights',
			'sub_fields' => WPBC_acf_get_slick_heights($args['name'].'__heights'),  
			'class' => 'wpbc-tabsless-group acf-group-seamless wpbc-acf-no-label wpbc-acf-highlighted-field dark',
			'width' => '100',
			'conditional_logic' => array (
					array (
						array (
							'field' => 'field_'.$args['name'].'__use_heights',
							'operator' => '==',
							'value' => '1',
						),
					), 
				),
		)); 

		$embed_sub_fields = array();

			$embed_sub_fields[] = WPBC_acf_make_radio_field(array(
				'label' => __('Embed by','bootclean'),
				'name' => $args['name'].'__embed_by',
				'class' => 'wpbc-radio-as-btn wpbc-ui-mini as-btn-danger',
				'choices' => array(
					'none' => __('Don´t use','bootclean'),
					'1by1' => '1by1',
					'4by3' => '4by3',
					'16by9' => '16by9',
					'21by9' => '21by9',
				),
				'default_value' => 'none',
				'width' => '100',
			));

		$instructions__embed = __('Will not apply if using "Slider Responsie Heights".','bootclean');
		$instructions__embed .= '<br>'.__('Apply only for IMAGE COVER and IMAGE COVER + CONTENT slide types.','bootclean');

		$sub_fields[] = WPBC_acf_make_group_field(array(
			'label' => __('Bootstrap Responsive Embed Sizes','bootclean'),
			'instructions' => $instructions__embed,
			'name' => $args['name'].'__embed',
			'sub_fields' => $embed_sub_fields, 
			'class' => 'wpbc-tabsless-group acf-group-seamless',
			'width' => '100', 
		));
 

	$defaults = array (
		'key' => 'field_'.$args['name'],
		'label' => 'Group Field',
		'name' => 'group_field',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $sub_fields,
	);

	$field = array_merge($defaults, $args); 
	$field = WPBC_acf_make_fields__filter($field, $args); 
	return $field;

}