<?php

/* ACF OPTION PAGE */

if( function_exists('acf_add_options_page') ) {

	$wpbc_swup = apply_filters('wpbc/filter/wpbc_swup/args', array());

	$args = WPBC_get_theme_settings_args();

	if(defined('WPBC_THEME_SETTINGS_ACTIVE') && WPBC_THEME_SETTINGS_ACTIVE==1){  

		$child_page = acf_add_options_sub_page(array(

			'page_title'  => $args['options_page']['page_title'] .' > '. $wpbc_swup['page_title'],
      'menu_title'  => $wpbc_swup['menu_title'], 
      'menu_slug' => $wpbc_swup['menu_slug'],
      'parent_slug' => $args['options_page']['menu_slug'],
      'capability' => $wpbc_swup['capability'],

		)); 

		add_filter('admin_body_class',function($classes){  
			if(!empty($_GET['page'] && 'wpbc-swup-settings' == $_GET['page'] )){ 
				$classes = "$classes wpbc_site_settings wpbc_loading"; 
			}
			return $classes;
		},10,1);

	} else {

		$args = array(
			'page_title'  => $args['options_page']['page_title'] .' > '. $wpbc_swup['page_title'],
      'menu_title'  => $v['menu_title'], 
      'menu_slug' => $wpbc_swup['menu_slug'],
			'capability' => $wpbc_swup['capability'],
		);
		
		acf_add_options_page($args);

	}

}

/* ACF GROUP */

if( function_exists('acf_add_local_field_group') ) {

	acf_add_local_field_group(array(
		'key' => 'group_swup_settings',
		'title' => 'WPBC Swup Settings',
		'fields' => WPBC_swup_settings_fields(),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'wpbc-swup-settings',
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

	// #acf-group_swup_settings
	add_action('admin_head', function(){
		?>
<style>#acf-group_swup_settings{padding: 0 1.2rem!important;}</style>
		<?php
	},999); 

}


/* ACF FIELDS */

function WPBC_swup_settings_fields(){
	$fields = array();

	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_swup_settings__subtitle',
			'label' => '', 
			'message' => '<svg xmlns="http://www.w3.org/2000/svg" width="400" height="173" style="width:150px; height:auto;" viewBox="0 0 996 429">
  <g fill="none">
    <path fill="#2D2E82" d="M61.5 355.46C66.5 370.93 80.5 378 99 376 118 374 130.5 365.18 130.5 350.68 130.5 340.68 123.5 336.41 108 334.05L63 328.8C29 324.39 5 309.43 5 271.93 5 228.43 44 195.3 94 190 150.5 184 181.5 207.76 189 249L130 255.24C126 243.16 115.5 234.77 95 236.94 80 238.5 65.5 247 65.5 261 65.5 270 71.5 274.37 85.5 276.39L131.5 282.03C170.5 287.41 191 306.74 191 340.74 191 386.24 151.5 417.42 99.5 422.91 45 428.7 6.5 406.77 0 362L61.5 355.46zM837.73 422.44L775.73 428.99 775.73 123 837.73 116.45 837.73 134.95C847.73 121.95 869.73 108.07 893.73 105.54 958.73 98.67 995.73 148.76 995.73 211.76 995.73 274.76 958.73 332.17 893.73 339.04 869.73 341.57 847.73 332.4 837.73 321.45L837.73 422.44zM837.73 264.94C845.23 279.65 861.73 288.41 879.73 286.5 913.23 282.96 933.23 253.85 933.23 218.35 933.23 182.35 913.23 157.46 879.73 161 861.23 163 845.23 175.65 837.73 191.44L837.73 264.94zM469.82 155.31L469.82 284C469.82 299.38 466.72 311.18 460.6 319.07 454.99 326.32 446.71 330.43 435.31 331.64 423.91 332.85 415.63 330.48 410.02 324.42 403.9 317.82 400.8 306.67 400.8 291.29L400.8 162.61 340.46 169 340.46 297.62C340.46 313 337.36 324.8 331.25 332.69 325.63 339.94 317.36 344.05 305.95 345.25 294.54 346.45 286.28 344.1 280.66 338.03 274.55 331.43 271.45 320.29 271.45 304.91L271.45 176.27 211.1 182.65 211.1 315.65C211.1 345.5 220.21 369.12 237.44 383.95 253.99 398.19 277.68 404.14 305.95 401.15 332.2 398.38 354.45 388.8 370.7 373.37 386.98 385.37 409.18 390.25 435.31 387.49 463.71 384.49 487.45 373.49 503.96 355.79 521.1 337.36 530.16 311.79 530.16 281.94L530.16 148.94 469.82 155.31zM650.38 364.8C683.54 361.3 706.1 350.46 722.65 332.73 739.88 314.25 748.99 288.73 748.99 258.86L748.99 125.86 688.65 132.23 688.65 260.83C688.65 276.21 685.55 288.01 679.43 295.9 673.81 303.15 665.93 308.49 650.43 310.13 634.93 311.77 626.99 308.13 621.37 302.04 615.26 295.44 612.16 284.3 612.16 268.92L612.16 140.28 551.81 146.66 551.81 279.66C551.81 309.51 560.92 333.13 578.15 347.96 594.65 362.24 617.22 368.31 650.38 364.8z"/>
    <path fill="#FE5B6A" d="M530.6,95.07 C530.6,112.92 515.49,127.57 497.18,127.57 C479.260342,127.498748 464.751252,112.989658 464.68,95.07 C464.68,76.3 479.33,61.65 497.18,61.65 C506.0525,61.6206515 514.57007,65.1322519 520.843909,71.4060909 C527.117748,77.6799299 530.629348,86.1975003 530.6,95.07 Z"/>
    <path fill="#60DDCD" d="M614.9,33.42 C614.9,51.27 599.79,65.92 581.48,65.92 C563.568153,65.8377998 549.071174,51.3318941 549,33.42 C549,14.65 563.63,-3.162943e-15 581.48,-3.162943e-15 C590.3525,-0.0293484583 598.87007,3.48225188 605.143909,9.75609089 C611.417748,16.0299299 614.929348,24.5475003 614.9,33.42 L614.9,33.42 Z"/>
  </g>
</svg><p>Complete, flexible, extensible and easy to use page transition library for your website.</p><p>More info at: <a href="https://swup.js.org/" target="_blank">swup.js.org</a></p>', 
		)
	);  

	// https://swup.js.org/options

	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_swup_settings__options_subtitle',
			'label' => 'Swup Options', 
		)
	);

	$fields[] = WPBC_acf_make_text_field(array(
		'name' => 'wpbc_swup_settings__animationSelector',
		'label' => 'animationSelector',
		'default_value' => '[class*="swup-transition-"]',
		'instructions' => 'Default: [class*="swup-transition-"]',
		'width' => '100%', 
	));

	$fields[] = WPBC_acf_make_text_field(array(
		'name' => 'wpbc_swup_settings__containers',
		'label' => 'containers',
		'default_value' => '#main-container-areas, #simulate-body-tags',
		'instructions' => 'Default: "#main-container-areas, #simulate-body-tags"',
		'width' => '100%', 
	));

	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_swup_settings__plugins_subtitle',
			'label' => 'Swup Plugins', 
		)
	);

	$fields[] = WPBC_acf_make_radio_field(array(
		'name' => 'wpbc_swup_settings__plugins',
		'label' => 'Transition plugin',
		'choices' => array (
			'SwupFadeTheme' => 'SwupFadeTheme',
			'SwupSlideTheme' => 'SwupSlideTheme',
			'SwupOverlayTheme' => 'SwupOverlayTheme',
		),
		'default_value' => 'SwupFadeTheme', 
	));

	$fields[] = WPBC_acf_make_text_field(array(
		'name' => 'wpbc_swup_settings__plugins_mainElement',
		'label' => 'plugins_mainElement',
		'default_value' => '#main-container-areas',
		'instructions' => 'Default: "#main-container-areas"',
		'width' => '100%', 
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_wpbc_swup_settings__plugins',
					'operator' => '==',
					'value' => 'SwupFadeTheme',
				),
			), 
			array (
				array (
					'field' => 'field_wpbc_swup_settings__plugins',
					'operator' => '==',
					'value' => 'SwupSlideTheme',
				),
			), 
		),
	));

	$fields[] = WPBC_acf_make_true_false_field(array(
		'name' => 'wpbc_swup_settings__SwupGaPlugin',
		'label' => 'Use Swup Google Analitics Plugin?',
		'width' => '100%', 
		'default_value' => 0,
	));


	// https://swup.js.org/events

	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_swup_settings__events_subtitle',
			'label' => 'Swup Events', 
			'message' => 'The code to place here is Javascript <u>only</u>, NO <script> tag needed. More info at: :'.'<a href="https://swup.js.org/events" target="_blank">Swup.js.org/events</a>'
		)
	);
 
	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'wpbc_swup_settings__events_contentReplaced',
			'label' => 'contentReplaced', 
			'instructions' => 'Triggers right after the content of page is replaced. More information: '.'<a href="https://swup.js.org/events" target="_blank">Swup.js.org/events</a>',
		)
	);

	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'wpbc_swup_settings__events_pageView',
			'label' => 'pageView', 
			'instructions' => 'Similar to contentReplaced, except it is once triggered on load',
		)
	);

	$fields[] =  WPBC_acf_make_codemirror_field(
		array( 
			'name' => 'wpbc_swup_settings__events_transitionEnd',
			'label' => 'transitionEnd', 
			'instructions' => 'Triggers when transition ends (content is replaced and all animations are done',
		)
	);




	$fields[] = WPBC_acf_make_true_false_field(array(
		'name' => 'wpbc_swup_settings__usecss',
		'label' => 'Use addon CSS?', 
		'instructions' => 'If disabled, no css whill apply to transitions.',
	));

	$fields[] = WPBC_acf_make_true_false_field(array(
		'name' => 'wpbc_swup_settings__usejs',
		'label' => 'Use addon JS?',
		'instructions' => '<b>IMPORTANT!</b> Disable only if you need a custom javascript init for the plugin.',
	));

	return $fields;
}


/* FRONT END FILTERS/ACTIONS */ 

add_filter('wpbc/filter/swup/usecss', function($usecss){
	$u = get_option('options_wpbc_swup_settings__usecss', true); 
	if(!$u){
		$usecss = false;
	}
	return $usecss; 
},10,1);

add_filter('wpbc/filter/swup/usejs', function($usejs){
	$u = get_option('options_wpbc_swup_settings__usejs', true);
	if(!$u){
		$usecss = false;
	}
	return $usejs; 
},10,1);


/*

	$animationSelector = apply_filters('wpbc/filter/swup/animationSelector', '[class*="swup-transition-"]' ); 
	$containers = apply_filters('wpbc/filter/swup/containers', '#main-container-areas, #simulate-body-tags' ); 
	$plugins = apply_filters('wpbc/filter/swup/plugins', 'SwupFadeTheme' ); 
	
	$plugins_mainElement = apply_filters('wpbc/filter/swup/plugins/mainElement', '#main-container-areas' ); 
	
	
	$SwupGaPlugin = apply_filters('wpbc/filter/swup/SwupGaPlugin',0);

	$args = apply_filters('wpbc/filter/swup/plugins/SwupOverlayTheme/args', $args );
*/

add_filter('wpbc/filter/swup/animationSelector', function($animationSelector){
	$animationSelector = get_option('options_wpbc_swup_settings__animationSelector', '[class*="swup-transition-"]');
	return $animationSelector;
},10,1);

add_filter('wpbc/filter/swup/containers', function($containers){
	$containers = get_option('options_wpbc_swup_settings__containers', '#main-container-areas, #simulate-body-tags');
	return $containers;
},10,1);

add_filter('wpbc/filter/swup/plugins', function($plugins){
	$plugins = get_option('options_wpbc_swup_settings__plugins', 'SwupFadeTheme');
	return $plugins;
},10,1);

add_filter('wpbc/filter/swup/mainElement', function($mainElement){
	$mainElement = get_option('options_wpbc_swup_settings__plugins_mainElement', '#main-container-areas');
	return $mainElement;
},10,1);


add_filter('wpbc/filter/swup/SwupGaPlugin', function($SwupGaPlugin){
	$SwupGaPlugin = get_option('options_wpbc_swup_settings__SwupGaPlugin', 0);
	return $SwupGaPlugin;
},10,1);






/* EVENTS AND ACTIONS */

add_action('wpbc/action/swup/contentReplaced',function(){
	echo get_option('options_wpbc_swup_settings__events_contentReplaced', '');
});


add_action('wpbc/action/swup/pageView',function(){
	echo get_option('options_wpbc_swup_settings__events_pageView', '');
}); 

add_action('wpbc/action/swup/transitionEnd',function(){
	echo get_option('options_wpbc_swup_settings__events_transitionEnd', '');
});

add_action('wpbc/layout/start', function(){ 


}, 40 );