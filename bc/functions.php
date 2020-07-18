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
	?>
	<pre class="gp-2" style="border:2px solid var(--primary);">
		<code>
		<?php 
			print_r($args); 
		?>
		</code>
	</pre>
	<?php
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




/*
 *
 * 	SVG and ICONS
 *
*/


function WPBC_get_svg_icon($name='gear',$fill='#000000'){
	
	switch ($name) {

		case 'gear':
			$icon = '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><path d="M0,0h24v24H0V0z" fill="none"/><path fill='.$fill.' d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></g></svg>';
			break;

		case 'touch_app':
			$icon = '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g><path fill='.$fill.' d="M18.19,12.44l-3.24-1.62c1.29-1,2.12-2.56,2.12-4.32c0-3.03-2.47-5.5-5.5-5.5s-5.5,2.47-5.5,5.5c0,2.13,1.22,3.98,3,4.89 v3.26c-2.15-0.46-2.02-0.44-2.26-0.44c-0.53,0-1.03,0.21-1.41,0.59L4,16.22l5.09,5.09C9.52,21.75,10.12,22,10.74,22h6.3 c0.98,0,1.81-0.7,1.97-1.67l0.8-4.71C20.03,14.32,19.38,13.04,18.19,12.44z M17.84,15.29L17.04,20h-6.3 c-0.09,0-0.17-0.04-0.24-0.1l-3.68-3.68l4.25,0.89V6.5c0-0.28,0.22-0.5,0.5-0.5c0.28,0,0.5,0.22,0.5,0.5v6h1.76l3.46,1.73 C17.69,14.43,17.91,14.86,17.84,15.29z M8.07,6.5c0-1.93,1.57-3.5,3.5-3.5s3.5,1.57,3.5,3.5c0,0.95-0.38,1.81-1,2.44V6.5 c0-1.38-1.12-2.5-2.5-2.5c-1.38,0-2.5,1.12-2.5,2.5v2.44C8.45,8.31,8.07,7.45,8.07,6.5z"/></g></g></svg>';
			break;

		case 'lock':
			$icon = '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill='.$fill.' d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>';
			break;

		case 'lock_open':
			$icon = '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill='.$fill.' d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6h1.9c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm0 12H6V10h12v10z"/></svg>';
			break;

		case 'login':
			$icon = '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><path fill='.$fill.' d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z"/></g></svg>';
			break;

		case 'how_to_reg':
			$icon = '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none" fill-rule="evenodd"/><g fill-rule="evenodd"><path fill='.$fill.' d="M9 17l3-2.94c-.39-.04-.68-.06-1-.06-2.67 0-8 1.34-8 4v2h9l-3-3zm2-5c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4"/><path d="M15.47 20.5L12 17l1.4-1.41 2.07 2.08 5.13-5.17 1.4 1.41z"/></g></svg>';
			break;

		case 'loader-tail-spin':
			$icon = '<svg width="38" height="38" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient x1="8.042%" y1="0%" x2="65.682%" y2="23.865%" id="a">
            <stop stop-color="'.$fill.'" stop-opacity="0" offset="0%"/>
            <stop stop-color="'.$fill.'" stop-opacity=".631" offset="63.146%"/>
            <stop stop-color="'.$fill.'" offset="100%"/>
        </linearGradient>
    </defs>
    <g fill="none" fill-rule="evenodd">
        <g transform="translate(1 1)">
            <path d="M36 18c0-9.94-8.06-18-18-18" id="Oval-2" stroke="url(#a)" stroke-width="2">
                <animateTransform
                    attributeName="transform"
                    type="rotate"
                    from="0 18 18"
                    to="360 18 18"
                    dur="0.9s"
                    repeatCount="indefinite" />
            </path>
            <circle fill="'.$fill.'" cx="36" cy="18" r="1">
                <animateTransform
                    attributeName="transform"
                    type="rotate"
                    from="0 18 18"
                    to="360 18 18"
                    dur="0.9s"
                    repeatCount="indefinite" />
            </circle>
        </g>
    </g>
</svg>';
			break;

		case 'loader-spinning-circles':
			$icon = '<svg width="58" height="58" viewBox="0 0 58 58" xmlns="http://www.w3.org/2000/svg">
    <g fill="none" fill-rule="evenodd">
        <g transform="translate(2 1)" stroke="#000000" stroke-width="1.5">
            <circle cx="42.601" cy="11.462" r="5" fill-opacity="1" fill="#000000">
                <animate attributeName="fill-opacity"
                     begin="0s" dur="1.3s"
                     values="1;0;0;0;0;0;0;0" calcMode="linear"
                     repeatCount="indefinite" />
            </circle>
            <circle cx="49.063" cy="27.063" r="5" fill-opacity="0" fill="#000000">
                <animate attributeName="fill-opacity"
                     begin="0s" dur="1.3s"
                     values="0;1;0;0;0;0;0;0" calcMode="linear"
                     repeatCount="indefinite" />
            </circle>
            <circle cx="42.601" cy="42.663" r="5" fill-opacity="0" fill="#000000">
                <animate attributeName="fill-opacity"
                     begin="0s" dur="1.3s"
                     values="0;0;1;0;0;0;0;0" calcMode="linear"
                     repeatCount="indefinite" />
            </circle>
            <circle cx="27" cy="49.125" r="5" fill-opacity="0" fill="#000000">
                <animate attributeName="fill-opacity"
                     begin="0s" dur="1.3s"
                     values="0;0;0;1;0;0;0;0" calcMode="linear"
                     repeatCount="indefinite" />
            </circle>
            <circle cx="11.399" cy="42.663" r="5" fill-opacity="0" fill="#000000">
                <animate attributeName="fill-opacity"
                     begin="0s" dur="1.3s"
                     values="0;0;0;0;1;0;0;0" calcMode="linear"
                     repeatCount="indefinite" />
            </circle>
            <circle cx="4.938" cy="27.063" r="5" fill-opacity="0" fill="#000000">
                <animate attributeName="fill-opacity"
                     begin="0s" dur="1.3s"
                     values="0;0;0;0;0;1;0;0" calcMode="linear"
                     repeatCount="indefinite" />
            </circle>
            <circle cx="11.399" cy="11.462" r="5" fill-opacity="0" fill="#000000">
                <animate attributeName="fill-opacity"
                     begin="0s" dur="1.3s"
                     values="0;0;0;0;0;0;1;0" calcMode="linear"
                     repeatCount="indefinite" />
            </circle>
            <circle cx="27" cy="5" r="5" fill-opacity="0" fill="#000000">
                <animate attributeName="fill-opacity"
                     begin="0s" dur="1.3s"
                     values="0;0;0;0;0;0;0;1" calcMode="linear"
                     repeatCount="indefinite" />
            </circle>
        </g>
    </g>
</svg>';
			break;


		case 'loader-circles':
			$icon = '<svg width="135" height="135" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#000000">
    <path d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
        <animateTransform
            attributeName="transform"
            type="rotate"
            from="0 67 67"
            to="-360 67 67"
            dur="2.5s"
            repeatCount="indefinite"/>
    </path>
    <path d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z" fill="#000000">
        <animateTransform
            attributeName="transform"
            type="rotate"
            from="0 67 67"
            to="360 67 67"
            dur="8s"
            repeatCount="indefinite"/>
    </path>
</svg>';
			break;


		case 'loader-rings':
			$icon = '<svg width="45" height="45" viewBox="0 0 45 45" xmlns="http://www.w3.org/2000/svg" stroke="#000000">
    <g fill="none" fill-rule="evenodd" transform="translate(1 1)" stroke-width="2">
        <circle cx="22" cy="22" r="6" stroke-opacity="0">
            <animate attributeName="r"
                 begin="1.5s" dur="3s"
                 values="6;22"
                 calcMode="linear"
                 repeatCount="indefinite" />
            <animate attributeName="stroke-opacity"
                 begin="1.5s" dur="3s"
                 values="1;0" calcMode="linear"
                 repeatCount="indefinite" />
            <animate attributeName="stroke-width"
                 begin="1.5s" dur="3s"
                 values="2;0" calcMode="linear"
                 repeatCount="indefinite" />
        </circle>
        <circle cx="22" cy="22" r="6" stroke-opacity="0">
            <animate attributeName="r"
                 begin="3s" dur="3s"
                 values="6;22"
                 calcMode="linear"
                 repeatCount="indefinite" />
            <animate attributeName="stroke-opacity"
                 begin="3s" dur="3s"
                 values="1;0" calcMode="linear"
                 repeatCount="indefinite" />
            <animate attributeName="stroke-width"
                 begin="3s" dur="3s"
                 values="2;0" calcMode="linear"
                 repeatCount="indefinite" />
        </circle>
        <circle cx="22" cy="22" r="8">
            <animate attributeName="r"
                 begin="0s" dur="1.5s"
                 values="6;1;2;3;4;5;6"
                 calcMode="linear"
                 repeatCount="indefinite" />
        </circle>
    </g>
</svg>';
			break;

		case 'loader-material':
			$icon = '<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
  <circle class="path" fill="none" stroke="#000000" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
</svg>';
			break;

		case 'bootclean':
			$icon = '<img width="48" class="icon" src="'.get_template_directory_uri().'/images/theme/bootclean-iso-color-@2.png'.'"/>';
			break;
		
		default:
			$icon = '';
			break;
	}
	
	return $icon;

}



include ('functions/WPBC_acf_make__fields.php');