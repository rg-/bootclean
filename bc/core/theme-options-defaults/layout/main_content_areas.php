<?php


$content_areas_info = '';

//$content_areas = WPBC_get_main_container_content_areas();
$content_areas_count = WPBC_get_main_container_max_content_areas(); 
$content_areas_count = ( $content_areas_count > 1 ) ? $content_areas_count - 1 : $content_areas_count;
$layout_defaults = WPBC_layout_struture__defaults();
$content_areas = WPBC_get_main_container_content_areas($layout_defaults); 
//$layout_args = WPBC_filter_layout_structure_build( $layout_defaults ); 

$main_content_areas = array(); 
$main_content_areas[] = array(
	'name' => __( 'Secondary Content Areas', 'bootclean' ),
	'type' => 'sub-heading', 
); 


	$main_content_areas[] = array(
		'name' => __( 'Theme has ', 'bootclean' ).$content_areas_count.' '.__('Secondary Content Area','bootclean'). ( $content_areas_count > 1 ? 's' : '' ) .' '. __('over all layouts','bootclean').'.',
		'desc' => __('TODO: See how to mix/deal this with layout for each template, home, page, post, etc.... Content for this areas can be changed over pages/posts/categories and every template too.','bootclean'),
		'type' => 'info'
	);

	$main_content_areas[] = array( 
		'name' => __('Secondary Areas Default content', 'bootclean'),
		'desc' => __( 'Enable for custom settings or use defaults.', 'bootclean' ),
		'id' => 'custom_layout_secondary_areas__enable',
		'std' => '0',
		'type' => 'checkbox',
		'ui' => true,
		'hide-reset'=> true,
		'condition' => array(
			array(
				'target' => '.group-custom_layout__group-secondary_areas_options',
				'show' => '1'
			), 
		),
		'width' => '100%'
	);


	$main_content_areas[] = array(
		'id' => 'custom_layout__group-secondary_areas_options',
		'type' => 'group-start',
		//'name' => __('Secondary Areas Default content', 'bootclean'),
		'no_esc_html' => true,
		'label_tag' => 'h3',
		'class' => '',
	); 

	foreach ($content_areas as $key => $value) {
		if( empty($value['is-main']) ){
			$main_content_areas[] = array(
				'name' => ' Content Area Name: '.$value['content-area']['name'],
				'desc' => ( !empty($value['content-area']['shortcode']) ? 'Using shortcode: '.$value['content-area']['shortcode'].'' : '' ),
				'type' => 'info'
			);
			// $options_wpbc_template
			$main_content_areas[] = array(
				'name' => __( 'Select a Template', 'bootclean' ), 
				// 'desc' => __( 'Needs some Template created.', 'bootclean' ),
				'id' => 'bc-options--layout--secondary-area-template--'.$value['content-area']['name'],
				'type' => 'select',
				'std' => '0',
				'options' => $options_wpbc_template,
				'width' => '50%', 
			);
			// $options_wpbc_widgets
			$main_content_areas[] = array(
				'name' => __( 'Select a Widget Area', 'bootclean' ), 
				// 'desc' => __( 'Needs some Template created.', 'bootclean' ),
				'id' => 'bc-options--layout--secondary-area-widget--'.$value['content-area']['name'],
				'type' => 'select',
				'std' => '0',
				'options' => '',
				'width' => '50%', 
			);

			add_filter('WPBC_set_default_option__'.'bc-options--layout--secondary-area-widget--'.$value['content-area']['name'],function($option, $k){

				$options_wpbc_widgets = array();
				$options_wpbc_widgets[0] = 'None';
				$wp_registered_sidebars = $GLOBALS['wp_registered_sidebars']; 
				foreach($wp_registered_sidebars as $k=>$v){
					if($v['id'] != 'default_widget_area'){ 
						$options_wpbc_widgets[$v['id']] = $v['name'];
					}
				}

				$option['options'] = $options_wpbc_widgets;
				return $option;
			}, 10, 2);

		} 
	}


	$main_content_areas[] = array( 
		'type' => 'group-end', 
	);


$main_content_areas[] = array( 
	'type' => 'sub-heading-end', 
);