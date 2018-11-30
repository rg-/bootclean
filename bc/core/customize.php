<?php
//add_action( 'after_setup_theme', 'WPBC_customizer_after_setup_theme');
function WPBC_customizer_after_setup_theme(){
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
}


/*

	Playing with those custmizations as inline styles
	
	TODO, see navbar-brand sizes....
	
	CAUTION, doing same thing here: bc\core\enqueue\custom.css.php

*/ 

function __BC_get_root_colors_customizer(){ 
	$css = BC_get_root_colors();
	if(isset($css)){
		$out = '';
		$count = 0;
		foreach($css as $k=>$v){
			$name = str_replace('--','',$k);
			$value = $v;  
			if($count<=7){
				$out[$name]['label'] = ucwords($name).' color';
				$out[$name]['default'] = $value;
			}
			$count++;
		}
		
		return $out; 
	}
}  

add_action( 'customize_register', 'WPBC_customizer_register' );

function WPBC_customizer_register( $wp_customize ) { 
	$wp_customize->add_panel(
		'WPBC_panel_layout',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'title'          => __('Theme Layout', 'bootclean'),
				'description'    => __('Several settings pertaining to layout.', 'bootclean'),
			)
	); 
	
	// Layout panel
	$wp_customize->add_section(
		'WPBC_colors',
		array(
			'title'     => 'Colors',
			'priority'  => 10,
			'panel'  => 'WPBC_panel_layout',
		)
	); 
	// Customizer colors WPBC_colors
	
	$customizer_colors = __BC_get_root_colors_customizer(); 
	foreach($customizer_colors as $k=>$v){ 
		$wp_customize->add_setting(
			'WPBC_color__'.$k,
			array(
				'default'     	    => $v['default'],
				'sanitize_callback' => 'WPBC_sanitize_input',
				'transport'   	    => 'postMessage'
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'link_color__'.$k,
				array(
					'label'      => $v['label'],
					'section'    => 'WPBC_colors',
					'settings'   => 'WPBC_color__'.$k
				)
			)
		); 
	}
	
}   

add_action( 'wp_enqueue_scripts', 'WPBC_customizer_enqueue_scripts',999 );

function WPBC_customizer_enqueue_scripts(){
	$handle = 'customizer-custom';
	$css = '';
	
	$customizer_colors = __BC_get_root_colors_customizer();
	foreach($customizer_colors as $k=>$v){
		
		$color = get_theme_mod( 'WPBC_color__'.$k ); 
		
		if(!empty($color)){
			
			$css .= '.bg-'.$k.'{background-color:'.$color.'!important;}';
			$css .= '.text-'.$k.'{color:'.$color.'!important;}';
		
		}		
		
	} 
	
	wp_register_style( $handle, false );
    wp_enqueue_style( $handle );
	wp_add_inline_style( $handle  , $css );

}



add_action( 'customize_preview_init', 'WPBC_customizer_preview_init' );

function WPBC_customizer_preview_init() {
	wp_enqueue_script(
		'customizer-custom',
		get_template_directory_uri() . '/bc/core/customize/customize.js',
		array(  'jquery','customize-preview'  ),
		'1.0.0',
		true
	);
	$customizer_colors = __BC_get_root_colors_customizer();
	wp_localize_script( "customizer-custom", "customizer_colors", $customizer_colors );


} // end tcx_customizer_live_preview


function WPBC_sanitize_input( $input ) {
	return strip_tags( stripslashes( $input ) );
}