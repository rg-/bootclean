<?php

define('BC_ACF_QTRANSLATEX_ENABLED', apply_filters('bc_acf_qtranslatex_enabled','__return true;'));

// qtranslatex things

if( function_exists('qtrans_getLanguage') && defined('BC_ACF_QTRANSLATEX_ENABLED') && BC_ACF_QTRANSLATEX_ENABLED == true ){
	
	// get translated content from raw ddbb value
	if(!function_exists('ynbs_translatethis')){
		function ynbs_translatethis($content) {
			$regexp = '/<\!--:(\w+?)-->([^<]+?)<\!--:-->/i';
			if(preg_match_all($regexp, $content, $matches)) {
				$output = array();
				$count = count($matches[0]);
				for($i = 0; $i < $count; $i++) {
					$output[$matches[1][$i]] = $matches[2][$i];
				}
				return $output;
			} else {
				echo 'no matches';
			}
		}
	}
	
	// make post_object field option texts results translated by filter qtranxf_use
	if(!function_exists('qT_bc__post_object_result')){
		function qT_bc__post_object_result( $title, $post, $field, $post_id ) { 
			// add post type to each result
			global $q_config; 
			$title = qtranxf_use($q_config['language'], $title, false, false); 
			return $title; 
		} 
		add_filter('acf/fields/post_object/result', 'qT_bc__post_object_result', 10, 4);
	}
	
	// Admin head scripts and stypes
	add_action('admin_head', 'wpbc_qtranslate_admin_styles');
	
	function wpbc_qtranslate_admin_styles(){
		echo '<style type="text/css">

		.wp-admin:not(.nav-menus-php) #post-body-content .qtranxs-lang-switch-wrap.widefat{
			display:none!important;
		}

		#qtranxs-meta-box-lsb{
			
			position: fixed;
			text-align: right;
			display: block;
			bottom: 0;
			right: 0;
			z-index: 9999;
			margin: 0;
			padding: 0;
			border:0;
			width: auto;
			min-width: inherit;
			cursor:default!important;
		}
		#qtranxs-meta-box-lsb .hndle {
			cursor: default;
		}
		#qtranxs-meta-box-lsb .qtranxs-lang-switch{
			margin:0;
		}
		#qtranxs-meta-box-lsb button.handlediv{
			display:none!important;
		}

		.acf-input-wrap.multi-language-field{
			border-left: 3px solid #0073aa !important;
		}

		</style>';
	}

	function qT_bc__admin_head(){ 
		echo '<style type="text/css">
			
			body.toplevel_page_acf-options-theme-settings .multi-language-field .wp-switch-editor[data-language]{
				
				display:block!important;
			}
			
			#post-body-content .qtranxs-lang-switch-wrap:last-child{display:none!important;}
			
			.qtranxs-lang-switch{
				
				padding: 2px 2px 4px 7px;
				margin: 1px 4px -2px 0;
				
			}
			.qtranxs-lang-switch:hover{cursor:pointer;text-decoration:none;}
			
			.qtranxs-lang-switch.active{
				cursor:default;
				border-color: #008ec2;
				background-image: none;
				background-color: #008ec2;
				color: #fff;
				
			}
		
			#qtranxs-meta-box-lsb{
				
				position: fixed;
				text-align: right;
				display: block;
				bottom: 0;
				right: 0;
				z-index: 9999;
				margin: 0;
				padding: 3px;
				width: auto;
				min-width: inherit;
				
			}
			#qtranxs-meta-box-lsb button{display:none!important;}
			
			.multi-language-field .acf_input input,
			.multi-language-field .acf_input textarea,
			.multi-language-field .current-language{border-left:3px solid #000;}
			
			[name="qts_en_slug"],
			[data-language="en"]{border-color:blue!important;}
			[name="qts_es_slug"],
			[data-language="es"]{border-color:orange!important;}
			[name="qts_pb_slug"],
			[data-language="pb"]{border-color:green!important;}
				
			</style>'; 
	}
	
	
	
	// Convert acf fields into qtranslate fields
	function bc_child_defaults_qtranslate_wysiwyg_fx( $field ) {
		$field['type'] = 'qtranslate_wysiwyg';
		return $field;	 
	}
	function bc_child_defaults_qtranslate_text_fx( $field ) {
		$field['type'] = 'qtranslate_text';
		return $field;	 
	}
	function bc_child_defaults_qtranslate_textarea_fx( $field ) {
		$field['type'] = 'qtranslate_textarea';
		return $field;	 
	}
	
	// ACF fields ( could be more to add... TODO, find all of them ) 

	// layout_code_body_class
	// add_filter('acf/load_field/name=layout_code_body_class', 'bc_child_defaults_qtranslate_text_fx',100,1);

	// add_filter('acf/load_field/name=r_html_code', 'bc_child_defaults_qtranslate_textarea_fx',100,1);
	
	/*
		Shortcode for qtranxf_get_url_for_language() function

		Can use url(slug) string to default/base language
		or use post ID.
		Optional you can get any other $lang url result.
	*/
	function WPBC_qtranxf_get_url_for_language($atts, $content = null){
		global $q_config;
		$lang = $q_config['language'];
		extract(shortcode_atts(array(
			'url' => '',
			'id' => '',
			'lang' => $lang, 
		), $atts));
		if($url && $lang){
			$url = qtranxf_get_url_for_language($url, $lang);
		}
		if($id && $lang){
			$url = get_the_permalink($id);
			$url = qtranxf_get_url_for_language($url, $lang);
		}
		return $url;

	}
	add_shortcode('WPBC_get_url_for_language', 'WPBC_qtranxf_get_url_for_language');

	function WPBC_get_text_language_FX($atts, $content = null){
		global $q_config;
		$lang = $q_config['language'];
		$content = qtranxf_use($q_config['language'], $content, false, false); 
		return $content;
	}
	add_shortcode('WPBC_get_text_language', 'WPBC_get_text_language_FX');
}