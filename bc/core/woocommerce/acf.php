<?php

$woo_enable_product_advanced = apply_filters('wpbc/filter/woocommerce/enable_product_advanced','__return_true');


add_filter('wpbc/filter/woocommerce/enable_product_advanced', 'WPBC_woo_acf_product_headder',10,1);
function WPBC_woo_acf_product_headder($fields){
	$fields[] = array(
		'key' => 'field_woo_product_advanced_header_tab',
		'label' => __('Product Header','bootclean'),
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'left',
		'endpoint' => 0,
	);

	$fields[] = array (
		'key' => 'field_woo_product_advanced_header_message',
		'label' => __('Product Header','bootclean'),
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
		'message' => __('You can choose just one image or many, will be converted into a single header or a sliler one.','bootclean'),
		'new_lines' => 'wpautop',
		'esc_html' => 0,
	);
	$fields[] = array (
		'key' => 'field_woo_product_advanced_header_type',
		'label' => __('Header Type','bootclean'),
		'name' => 'woo_product_advanced_header_type',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			0 => 'None',
			'featured' => __('Use Featured Image','bootclean'),
			'featured-gallery' => __('Use Featured Image & Gallery','bootclean'),
			'custom' => __('Use Custom Image/Slider','bootclean'),
		),
		'default_value' => array (
			0 => 'None',
		),
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 0,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',
	);
	$fields[] = array(
		'key' => 'field_woo_product_advanced_header_custom',
		'label' =>  __('Custom Image/Slider','bootclean'),
		'name' => 'woo_product_advanced_header_custom',
		'type' => 'gallery',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_woo_product_advanced_header_type',
					'operator' => '==',
					'value' => 'custom',
				),
			), 
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'min' => '',
		'max' => '',
		'insert' => 'append',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',
	);
	return $fields;
} 

add_filter('wpbc/filter/woocommerce/enable_product_advanced', 'WPBC_woo_acf_product_preview',20,1);
function WPBC_woo_acf_product_preview($fields){
	$fields[] = array(
		'key' => 'field_woo_product_advanced_preview_tab',
		'label' => __('Product Preview','bootclean'),
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'left',
		'endpoint' => 0,
	);
	return $fields;
} 


if( $woo_enable_product_advanced && function_exists('acf_add_local_field_group') ) {

	$fields = array();

	$fields = apply_filters('wpbc/filter/woocommerce/enable_product_advanced', $fields);

	acf_add_local_field_group(array(
		'key' => 'group_woo_product_advanced',
		'title' => __('Advaced Product Settings','bootclean'),
		'fields' => $fields,
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

} 


function WPBC_woo_if_product_has_header($id=''){
		
	$header_type = 'none'; // just in case
	if($id){
		$header_type = WPBC_get_field('field_woo_product_advanced_header_type', $id);
	}else{
		global $post;
		$header_type = WPBC_get_field('field_woo_product_advanced_header_type', $post->ID); 
	}

	if( 'none' != $header_type ){
		return $header_type;
	}else{
		return false;
	}

}

add_filter('wpbc/filter/layout/main-page-header/defaults', 'WPBC_woo_product_pageheader',10,1);
function WPBC_woo_product_pageheader($params){
	global $post;
	if( is_product() ){
		$header_type = WPBC_woo_if_product_has_header($post->ID);
		/* 
		if( 'none' == $header_template || !$header_template ){
			$params['use_custom_html'] = '[WPBC_get_template name="parts/custom-page-header"]'; 
		} 
		$params['custom_attrs'] = ' data-swup="move-fade-top-header" data-toggle="scroll-affix" data-affix-targetX="#post-87" '; 
		*/
		$params['use_custom_html'] = $header_type;
		if( 'none' != $header_type ){
			$params['use_custom_html'] = '[WPBC_woo_product_page_header post_id="'.$post->ID.'" type="none"]'; 
		} 
	}
	return $params;
}

add_filter('wpbc/body/class', 'WPBC_woo_product_pageheader_body_class',10,1 ); 
function WPBC_woo_product_pageheader_body_class($class){
	if( is_product() && WPBC_woo_if_product_has_header() ){
		$class .= '';
	}
	return $class;
}

add_filter('wpbc/filter/layout/main-navbar/defaults', function($args){
	if( is_product() && WPBC_woo_if_product_has_header() ){
		$args['class'].= ' navbar-dark ';
		$args['affix_defaults']['simulate'] = false;
		$args['nav_attrs'] = ' data-affix-removeclass="navbar-dark" data-affix-addclass="bg-white shadow" ';
	}
	return $args;
},20,1); 


add_action('woocommerce_single_product_summary', function(){
	if( is_product() && WPBC_woo_if_product_has_header()){
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
	}
},0);