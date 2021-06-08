<?php

function WPBC_acf_get_breakpoints(){
	$breakpoints = array(
		
		array(
			'key_prefix' => 'xs',
			'label' => 'XS'
		),
		array(
			'key_prefix' => 'sm',
			'label' => 'SM'
		),
		array(
			'key_prefix' => 'md',
			'label' => 'MD'
		),
		array(
			'key_prefix' => 'lg',
			'label' => 'LG'
		),
		array(
			'key_prefix' => 'xl',
			'label' => 'XL'
		),

	);
	return $breakpoints;
}

function WPBC_acf_get_slick_settings_options_defaults(){
	
	$default_args = array( 

		
		array(
			'key'=> 'accessibility',
			'type'=> 'true_false',
			'default'=> 1
		),

				array(
					'key'=> 'adaptiveHeight',
					'type'=> 'true_false',
					'default'=> 0	
				),

				array(
					'key'=> 'autoplay',
					'type'=> 'true_false',
					'default'=> 0	
				),

				array(
					'key'=> 'autoplaySpeed',
					'type'=> 'number',
					'default'=> '3000'	
				),

				array(
					'key'=> 'arrows',
					'type'=> 'true_false',
					'default'=> 1	
				),

		array(
			'key'=> 'asNavFor',
			'type'=> 'text',
			'default'=> ''	
		),

		array(
			'key'=> 'appendArrows',
			'type'=> 'text',
			'default'=> '$(element)'	
		),

		array(
			'key'=> 'appendDots',
			'type'=> 'text',
			'default'=> '$(element)'	
		),

		array(
			'key'=> 'prevArrow',
			'type'=> 'text',
			'default'=> '<button type="button" class="slick-prev">Previous</button>'	
		),

		array(
			'key'=> 'nextArrow',
			'type'=> 'text',
			'default'=> '<button type="button" class="slick-next">Previous</button>'	
		),

		array(
			'key'=> 'centerMode',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'centerPadding',
			'type'=> 'text',
			'default'=> '50px'	
		),

		array(
			'key'=> 'cssEase',
			'type'=> 'text',
			'default'=> 'ease'	
		),

		array(
			'key'=> 'customPaging',
			'type'=> 'text',
			'default'=> 'n/a'	
		),

				array(
					'key'=> 'dots',
					'type'=> 'true_false',
					'default'=> 0	
				),

		array(
			'key'=> 'dotsClass',
			'type'=> 'text',
			'default'=> 'slick-dots'	
		),

				array(
					'key'=> 'draggable',
					'type'=> 'true_false',
					'default'=> 1	
				),

				array(
					'key'=> 'fade',
					'type'=> 'true_false',
					'default'=> 0	
				),

		array(
			'key'=> 'focusOnSelect',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'easing',
			'type'=> 'text',
			'default'=> 'linear'	
		),

		array(
			'key'=> 'edgeFriction',
			'type'=> 'number',
			'default'=> '0.15',
			'step'=> '0.01'	
		),

				array(
					'key'=> 'infinite',
					'type'=> 'true_false',
					'default'=> 0	
				),

				array(
					'key'=> 'initialSlide',
					'type'=> 'number',
					'default'=> '0', 
				),

		array(
			'key'=> 'lazyLoad',
			'type'=> 'select',
			'default'=> 'ondemand',
			'choices' => array (
				'ondemand' => 'ondemand',
				'progressive' => 'progressive',
			),
		),

		array(
			'key'=> 'mobileFirst',
			'type'=> 'true_false',
			'default'=> 0	
		),

				array(
					'key'=> 'pauseOnFocus',
					'type'=> 'true_false',
					'default'=> 1	
				),

				array(
					'key'=> 'pauseOnHover',
					'type'=> 'true_false',
					'default'=> 1	
				),

				array(
					'key'=> 'pauseOnDotsHover',
					'type'=> 'true_false',
					'default'=> 0	
				),

		array(
			'key'=> 'respondTo',
			'type'=> 'text',
			'default'=> 'window'	
		),

				array(
					'key'=> 'rows',
					'type'=> 'number',
					'default'=> '1', 
				),

		array(
			'key'=> 'slide',
			'type'=> 'text',
			'default'=> "''"	
		),

				array(
					'key'=> 'slidesPerRow',
					'type'=> 'number',
					'default'=> '1', 
				),

				array(
					'key'=> 'slidesToShow',
					'type'=> 'number',
					'default'=> '1', 
				),

				array(
					'key'=> 'slidesToScroll',
					'type'=> 'number',
					'default'=> '1', 
				),

				array(
					'key'=> 'speed',
					'type'=> 'number',
					'default'=> '300', 
				),

		array(
			'key'=> 'swipe',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'swipeToSlide',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'touchMove',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'touchThreshold',
			'type'=> 'number',
			'default'=> '5', 
		),

		array(
			'key'=> 'useCSS',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'useTransform',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'variableWidth',
			'type'=> 'true_false',
			'default'=> 0	
		),

				array(
					'key'=> 'vertical',
					'type'=> 'true_false',
					'default'=> 0	
				),

				array(
					'key'=> 'verticalSwiping',
					'type'=> 'true_false',
					'default'=> 0	
				),

		array(
			'key'=> 'rtl',
			'type'=> 'true_false',
			'default'=> 0	
		),

		array(
			'key'=> 'waitForAnimate',
			'type'=> 'true_false',
			'default'=> 1	
		),

		array(
			'key'=> 'zIndex',
			'type'=> 'number',
			'default'=> '1000', 
		),

	);

	return $default_args;

}


/*
	
	Used for group display on admin settings

*/
function WPBC_acf_get_slick_settings_options_defaults_by( $check = array() ){

	$options_defaults = WPBC_acf_get_slick_settings_options_defaults();

	$temp = array();  

	if(!empty($check)){

		foreach ($options_defaults as $key => $value) {
			foreach ($check as $base) {
				if($value['key'] == $base){
					$temp[] = $value;
				}
			} 
		}

		$temp_order = array();
		foreach ($check as $base) {
			foreach ($options_defaults as $key => $value) {
				if($value['key'] == $base){
					$temp_order[] = $value;
				}
			}
		}
		
		return $temp_order;

	}

}