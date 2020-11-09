<?php
/*

	Layout builder
	
	Note: 	Functions names started with "_", are for internal/preview/test things.
			Like "_get_views()" used for bootstrap components previews.
			
	The $params=array() on almost all functions for components/partials and similar, ara 100% customized if using a new custom theme component/layout/partial or anything elase. Every component/partial has it´s owns $parameters passed. And you can pass anything in fact, just using "$params['something']" later on your layouts templates.
	
	The idea is to use custom things only on layout/ folder, and leave bc/ folder untouched over the custom themes for each proyect.

*/

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////	

function WPBC_version_compare($v){
	// $v like '9.0.0'
	global $WPBC_VERSION; 
	if ( version_compare( $WPBC_VERSION, $v, '>' ) ) {
		return true;		
	}else{
		return false;
	}
}
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
function WPBC_get_template_part($template, $args=''){ 
	$temp = WPBC_include_template_part($template);
	if($temp){
		include($temp);
	}

}
function WPBC_include_template_part($template){
	
	$inc = false; 

	$file_uri = get_template_directory_uri().'/template-parts/'.$template;
	$file_path = get_template_directory().'/template-parts/'.$template;
	
	$child_file_uri = get_stylesheet_directory_uri().'/template-parts/'.$template;
	$child_file_path = get_stylesheet_directory().'/template-parts/'.$template; 
	
	if( file_exists( $child_file_path.'.php' ) ){
		$inc = $child_file_path.'.php'; 
	}else{
		if( file_exists( $file_path.'.php' ) ){
			$inc = $file_path.'.php'; 
		}
	}

	return $inc;

}
	
function WPBC_get_template($args='') {
	global $post;
	if(isset($_GET['post'])){
		$post = get_post($_GET['post']);
	}
	// Reference guide: https://developer.wordpress.org/reference/functions/get_body_class/
	// https://developer.wordpress.org/themes/references/list-of-conditional-tags/
	$_is = '';
	
	if ( is_front_page() && is_home() ) {
	  $_is = 'home-blog';
	} elseif ( is_front_page() ) {
	  $_is = 'home';
	} elseif ( is_home() ) {
	  $_is = 'blog';
	} else { 
	
	  if( is_single() ){ 
		  $_is = 'single'; 
		  
		  if( isset($args['show_post_types']) ){
			  
				$post_type = get_post_type($post); 
				$_is = 'single-'.$post_type; 
			}
			if( isset($args['show_post_formats']) ){
			   
				$get_post_format = get_post_format($post); 
				$_is = 'single-'.$get_post_format; 
			}
			
		  
		  if( is_attachment() ){
			  $_is = 'attachment';
		  } 
		  
		  
	  }elseif( is_page() ){
		  $_is = 'page';
		  
	  }elseif(  is_archive() ){
		   $_is = 'archive';
		   if(is_category()){
			   $_is = 'category';
		   }
		   if(is_tag()){
				$_is = 'tag';
		   }
		   if(is_tax()){
				$_is = 'tax';
		   }
	  } else { 
		  $_is = ''; 
		  if( is_search() ){
			  $_is = 'search';
		  }
		  if( is_404() ){
			  $_is = '404';
		  }  
		  
	  }
	  
	}
	return $_is;  
}

function WPBC_get_ob_contents($url){
	ob_start(); 
	include($url);
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function WPBC_curl_get_contents($url){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
function WPBC_file_get_contents($url){
	/*
	$curl = false;
	$allow_url_fopen = false;
	$return = '';
	if( in_array( 'curl', get_loaded_extensions()) ){ 
		$curl = true;
	}
	if( ini_get('allow_url_fopen') ){ 
		$allow_url_fopen = false;
	}
	if($curl && $allow_url_fopen){
		$return = file_get_contents($url); 
		return $return;
	}else{ 
		$return = WPBC_curl_get_contents($url);
		return $return; 
	}
	*/
} 

function BC_theme_root(){
	global $theme_root;
	return $theme_root;
}


// BC_css_parser

function BC_css_parser($css){
	//Regex to find tags and their rules
	$re = "/(.+)\{([^\}]*)\}/";
	preg_match_all($re, $css, $matches); 
	//Create an array to hold the returned values
	$return = array();
	for($i = 0; $i<count($matches[0]); $i++){
		//Get the ID/class
		$name = trim($matches[1][$i]); 
		//Get the rules
		$rules = trim($matches[2][$i]); 
		//Format rules into array
		$rules_a = array();
		$rules_x = explode(";", $rules);
		foreach($rules_x as $r){
			if(trim($r)!=""){
				$s = explode(":", $r);
				$rules_a[trim($s[0])] = trim($s[1]);
			}
		} 
		//Add the name and its values to the array
		$return[$name] = $rules_a;
	} 
	//Return the array
	return $return;
}


//////////////////////////////////////////////////////////////////////////////////////
// Template system functions

function BC_header($part='',$params = array()){
	global $theme_root;
	BC_get_component('html-header', $params);
}

function BC_footer($part='',$params = array()){
	global $theme_root;
	BC_get_component('html-footer', $params); 
}

function BC_is_template_name($name){ 
	$page_attrs = BC_get_page_attrs(); 
	if($page_attrs['template'] == $name){	
		return true;
	}else{
		return false;
	} 
}

function BC_get_page_attrs(){
	global $theme_root;
	if(isset($theme_root)){
		$attrs['template'] = BC_get_template_name();
		$attrs['page-title'] = isset($theme_root['page-title']) ? $theme_root['page-title'] : ''; 
		return $attrs;
	}
}
function BC_build_slug($s){
	$parts = Explode('/', $s);
	$parts = $parts[count($parts) - 1];
	$parts = Explode('.', $parts);
	return $parts[0];
}
function BC_get_template_name(){
	$currentFile = $_SERVER["PHP_SELF"];
	if($currentFile){ 
		return BC_build_slug($currentFile);
	}
}

function BC_get_footer_scripts(){
	global $theme_root;
	$scripts = $theme_root['footer-scripts'];
	if(isset($scripts)){ 
		foreach($scripts as $k=>$v){ 
			echo '<script src="'.$v['src'].'"></script>'; 
		} 
	}  
}
function BC_get_head_styles(){
	global $theme_root;
	$scripts = $theme_root['head-styles'];
	if(isset($scripts)){ 
		foreach($scripts as $k=>$v){ 
			echo '<link id="'.$k.'-css" rel="stylesheet" href="'.$v['src'].'">'; 
		} 
	}
	if(isset($theme_root['google-fonts'])){ 
		if( isset($theme_root['google-fonts']['base']['href']) ){
			echo '<link href="'.$theme_root['google-fonts']['base']['href'].'" rel="stylesheet">';
		}
		if( isset($theme_root['google-fonts']['base']['font-family']) ){
			echo '<style>body{font-family: '.$theme_root['google-fonts']['base']['font-family'].'}</style>';
		}
	} 
} 

function BC_get_body_class(){
	
	global $theme_root;
	
	$body_class_output = ''; 
	$currentFile = BC_get_template_name();
	if($currentFile){ 
		$body_class_output .= $currentFile.' '; 
	} 
	$body_class_output .= isset($theme_root['body']['class']) ? $theme_root['body']['class'].' ' : '';
	$body_class_output = apply_filters('wpbc/body/class', $body_class_output);
	return $body_class_output;
}

function BC_get_body_data(){
	global $theme_root;
	$out = '';
	if(isset($theme_root['body']['data'])){
		$out = '';
		$data = $theme_root['body']['data'];
		foreach($data as $k=>$v){
			$out .= ' data-'.$k.'="'.$v.'"';
		}

	}
	
	$out = apply_filters('wpbc/body/data', $out);
	echo $out;
	
}





function BC_template( $src, $params=array() ){
	global $theme_root;  
	 if( file_exists(stream_resolve_include_path(BC_ABSPATH.'/templates/'.$src.'.php')) ){
		ob_start(); 
		include(BC_ABSPATH.'/templates/'.$src.'.php');
		$content = ob_get_contents();
		ob_end_clean();
		echo $content; 
	} 
}
	function BC_template_part( $src, $params=array() ){
		global $theme_root;  
		 if( file_exists(stream_resolve_include_path(BC_ABSPATH.'/templates/partials/'.$src.'.php')) ){
			ob_start(); 
			include(BC_ABSPATH.'/templates/partials/'.$src.'.php');
			$content = ob_get_contents();
			ob_end_clean();
			echo $content; 
		} 
	}
function _BC_template( $src, $params=array() ){
	global $theme_root;  
	 if( file_exists(stream_resolve_include_path(BC_ABSPATH.'/templates/'.$src.'.php')) ){
		ob_start(); 
		include(BC_ABSPATH.'/templates/'.$src.'.php');
		$content = ob_get_contents();
		ob_end_clean();
		return $content; 
	} 
}
	function _BC_template_part( $src, $params=array() ){
		global $theme_root;  
		 if( file_exists(stream_resolve_include_path(BC_ABSPATH.'/templates/partials/'.$src.'.php')) ){
			ob_start(); 
			include(BC_ABSPATH.'/templates/partials/'.$src.'.php');
			$content = ob_get_contents();
			ob_end_clean();
			return $content; 
		} 
	}


/* MIMIC WP function names ?¡?¡ I think is better to keep separate, use: WPBC_get_component() instead :(*/
function get_component_part($src,$params=array(), $echo=true){
	BC_get_component($src,$params, $echo);
}
function WPBC_get_component($src,$params=array(), $echo=true){ 
	BC_get_component($src,$params, $echo);
}
function BC_get_component($src,$params=array(), $echo=true){ 
	global $theme_root; 
	 if( file_exists(stream_resolve_include_path(BC_ABSPATH.'/components/'.$src.'.php')) ){
		ob_start(); 
		include(BC_ABSPATH.'/components/'.$src.'.php');
		$content = ob_get_contents();
		ob_end_clean();
		if($echo){
			echo $content; 
		}else{  
			return $content; 
		} 
	} 
}
function WPBC_get_partial($src,$params=array(), $echo=true){
	BC_get_partial($src,$params, $echo);
}
function BC_get_partial($src,$params=array(), $echo=true){ 
	global $theme_root; 
	 if( file_exists(stream_resolve_include_path(BC_ABSPATH.'/components/partials/'.$src.'.php')) ){
		ob_start(); 
		include(BC_ABSPATH.'/components/partials/'.$src.'.php');
		$content = ob_get_contents();
		ob_end_clean();
		if($echo){
			echo $content; 
		}else{
			return $content; 
		}  
	} 
} 

///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////// 


// LOCAL THINGS

// BC_apply_filters('test_filter', 'something');
function test_filter($a=''){
	echo "test filter: ".$a;
}
function BC_apply_filters($fn, $a){
	if(function_exists($fn)){  
		$fn($a); 
	} 
}

function _print_code($args){
	?><pre class="gp-1" style="border:2px solid var(--primary);">
<code>
<?php 
if(!empty($args)){print_r($args);}else{echo "! empty result :(";} 
?>
</code>
</pre><?php
}

function BC_http_strip_query_param($url,$param) {
	$pieces = parse_url($url);
	$query = [];
	if ($pieces['query']) {
		parse_str($pieces['query'], $query);
	} 
	return isset($query[$param]) ? $query[$param] : '';
}    
 

function _get_sample_img($params=''){
	$size = isset($params['size']) ? '-'.$params['size'] : '';
	$name = isset($params['name']) ? $params['name'] : 'sample';
	$ext = isset($params['ext']) ? $params['ext'] : 'jpg'; 
	if( is_array($params) ){
		return 'images/sample/'.$name.''.$size.'.'.$ext.''; 
	}
}
 

function _get_views($src,$params=array()){ 
	global $theme_root; 
	 if( file_exists(stream_resolve_include_path(BC_ABSPATH.'/_views/_php/'.$src.'.php')) ){
		ob_start(); 
		include(BC_ABSPATH.'/_views/_php/'.$src.'.php');
		$content = ob_get_contents();
		ob_end_clean();
		echo $content; 
	} 
} 

function _get_views_all($params=array()){
	$out = '';
	$component_path = BC_ABSPATH.'/_views/_php/';
  $component_files = glob($component_path."*.php");
  if(!empty($component_files)){
  	//print_r($component_files);

  	foreach($component_files as $file){
  		$basename = str_replace('.php', '', basename($file));
  		$out .= _get_views($basename,$params);
  	}

  	return $out;
  }
}







function WPBC_get_admin_icon($type='grayscale'){
	$icon = '<img width="16" style="vertical-align:middle; display:inline-block;" src="'.get_template_directory_uri().'/bc/core/assets/images/bootclean-iso-'.$type.'-@2.png'.'"/>';
	return $icon;
}

/* Color choices */

function WPBC_get_acf_root_colors_select_choices($field_name=''){
	$style_choices = array();
	$root_colors = BC_get_root_colors();
	$style_choices['transparent'] = 'None';
	foreach($root_colors as $k=>$v){ 
		$choice_key = str_replace('--', '', $k); 
		$style_choices[$choice_key] = '<i class="select_choices-badge" style="background-color:'.$v.'"></i>';
		 
	}

	$style_choices = apply_filters('wpbc/filter/acf/root_color_select_choices', $style_choices, $field_name);

	return $style_choices;
}

function WPBC_get_acf_root_colors_choices($field_name=''){
	$style_choices = array();
	$root_colors = BC_get_root_colors();
	$style_choices['transparent'] = '<span title="Transparent" style="min-width:20px; overflow:hidden; display: inline-block; width: 50%; display: block;"><i style="background-color:#fff;display: block;position: relative; border:1px solid rgba(1,1,1,.2); display:block; height:10px; "></i><i style="display:block; position:absolute; top: 8px; left: 0; right: 0; text-align: center; font-size:8px; color:#999; text-style:normal;">X</i></span>';
	foreach($root_colors as $k=>$v){ 
		$choice_key = str_replace('--', '', $k); 
		$style_choices[$choice_key] = '<span title="'.strtoupper($choice_key).'" style="min-width:20px; overflow:hidden; display: inline-block; width: 50%; display: block;"><i style="background-color:'.$v.';display: block;position: relative; border:1px solid rgba(1,1,1,.2); display:block; height:10px; "></i><i style="display:none;">'.strtoupper($choice_key).'</i></span>';
		 
	}

	$style_choices = apply_filters('wpbc/filter/acf/root_color_choices', $style_choices, $field_name);

	return $style_choices;
}



/*
 *
 * @function WPBC_get_theme_settings_args
 *
 * @filter
 *
*/
function WPBC_get_theme_settings_args($key=''){

	$args = array();   
	
	$args = apply_filters('wpbc/filter/theme_settings/args',$args);

	if(!empty($key)){
		$return = !empty($args[$key]) ? $args[$key] : '';
	}else{
		$return = $args;
	}

	return $return;

} 


include ('functions/WPBC_get_svg.php');
include ('functions/WPBC_acf_get__fx.php');
include ('functions/WPBC_acf_make__fields.php');