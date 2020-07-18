<?php

/*

	@package WPBC_get_template_parts_shortcodes
	
	Return path/file to the template for inclusion, will find first on child theme and then, if exist, on parent one.
	Is quite same thing as using default get_template_part(), but, here i can pass anything as parameters for re-use the components and also use them using shortcodes. 
	
	The main idea here is to create avery single compo as a shortcode too. To do this and keep compatible things, we have two parts basicly:
	
	(the admin side)
	- boostrap/shortcodes
					/alert
					/accordion
					/etc....
		
	(front end one, hooked by child theme)
	- template-parts/shortcodes
	
	@tip Clone this file into same folder/file structure on parent into child theme to replace template.
  
	
	That WPBC_bs__alert will load a template named also "alert.php" file under the parent/child template-parts/shorcodes/ folder.
	Argumens of each shortcode are passed to template and can be used as normal, ej. if you passed a variable named "my_name", then you can access on the template that variable just using "$my_name".
	Child themes can filter these defatul settings as well, and then use a custom template-part/shortcode for that.
	
	
*/  

add_filter("WPBC_shortcode_list__XX", function ($shortcode_list) {
    
	$shortcode_list["alert"] = array(
        "tag" => 'div',
		"class" => 'alert-link',   
		"role" => 'alert', 
		"extra_attrs" => '', 
    ); 
	
	$shortcode_list["btn"] = array(
        "tag" => 'a',
		"class" => 'btn-link',
		"label" => 'Button',
		"href" => '#',
		"target" => '', 
		"value" => '',
		"type" => 'submit',
		"role" => 'button', 
		"extra_attrs" => '',
    ); 
	
	$shortcode_list["btn_social"] = array(
       "label" => '',
		"title" => '',
		"tag" => 'a',
		"href"=> '#',
		"class" => 'btn-social',
		"type" => '',
		"extra_attrs" => '',
    ); 
	
	$temp = array();
	foreach ($shortcode_list as $k=>$v) {
		$temp[$k] = apply_filters( 'WPBC_shortcode_list__'.$k.'' , $v);
	}
	$shortcode_list = $temp;
	
    return $shortcode_list;
});  

/* Below the rest of functions/filters so that filter WPBC_shortcode_list, do the magic job of adding a "virtual" shortcode linked with a "no-virtual" template part and also passing the arguments */

/*

	TODO, this function should be "MAIN GENERAL" one, right?

*/
function WPBC_get_template_parts($part, $args=''){
	$out = ''; 
	$folder_part = !empty($args['folder_part']) ? $args['folder_part'] : 'template-parts';
	
	$file_uri = get_template_directory_uri().'/'.$folder_part;
	$file_path = get_template_directory().'/'.$folder_part;
	
	$child_file_uri = get_stylesheet_directory_uri().'/'.$folder_part;
	$child_file_path = get_stylesheet_directory().'/'.$folder_part;
	
	$inc = false;
	
	if( file_exists( $child_file_path.'/'.$part.'.php' ) ){
		$inc = $child_file_path.'/'.$part.'.php'; 
	}else{
		if( file_exists( $file_path.'/'.$part.'.php' ) ){
			$inc = $file_path.'/'.$part.'.php'; 
		}
	}
	$out = '';
	if($inc){
		
		ob_start();
		$args = !empty($args) ? $args : '0'; 
		if(!empty($inc)){
			include ($inc); 
		} 
		$out = ob_get_contents();
		ob_end_clean(); 
		return $out; 
	} 
} 

function WPBC_get_template_parts_shortcodes($part){
	$out = '';
	
	$file_uri = get_template_directory_uri().'/template-parts/shortcodes';
	$file_path = get_template_directory().'/template-parts/shortcodes';
	
	$child_file_uri = get_stylesheet_directory_uri().'/template-parts/shortcodes';
	$child_file_path = get_stylesheet_directory().'/template-parts/shortcodes';
	
	$inc = false;
	
	if( file_exists( $child_file_path.'/'.$part.'.php' ) ){
		$inc = $child_file_path.'/'.$part.'.php'; 
	}else{
		if( file_exists( $file_path.'/'.$part.'.php' ) ){
			$inc = $file_path.'/'.$part.'.php'; 
		}
	}
	if($inc) return $inc; 
} 

// shortcodes declaration

/*

	The nomeclature will be this: 
	
	WPBC_bs__[component-name] ej: WPBC_bs__alert WPBC_bs__loremipsum

*/

function WPBC_get_shortcode_list(){
	
	/*
	 
		and: template-parts\shortcodes\loremipsum.php
	
	*/
	$shortcode_list["loremipsum"] = array();
	/*
	
		See: bc\components\slick.php
		and: template-parts\shortcodes\slider.php
	
	*/
	$shortcode_list["slider"] = array(
        "id" => '',
		"container_class" => 'container',   
		"container_item_class" => '', 
		"slick" => '{ "dots":true, "arrows":false }', 
		"template_items_id"=> '',
		"breakpoint_height"=> ''
    );
	
	/* 
		# template-parts\shortcodes\alert.php 
	*/
	$shortcode_list["alert"] = array(
        "tag" => 'div',
		"class" => 'alert-link',   
		"role" => 'alert', 
		"extra_attrs" => '', 
    ); 
	
	/* 
		# template-parts\shortcodes\btn.php 
	*/
	$shortcode_list["btn"] = array(
        "tag" => 'a',
		"class" => 'btn-link',
		"label" => 'Button',
		"href" => '#',
		"target" => '', 
		"value" => '',
		"type" => 'submit',
		"role" => 'button', 
		"extra_attrs" => '',
    ); 
	
	/* 
		# template-parts\shortcodes\btn_social.php 
	*/
	$shortcode_list["btn_social"] = array(
       "label" => '',
		"title" => '',
		"tag" => 'a',
		"href"=> '#',
		"class" => 'btn-social',
		"type" => '',
		"extra_attrs" => '',
    );
	
	$temp = array();
	foreach ($shortcode_list as $k=>$v) {
		$temp[$k] = apply_filters( 'WPBC_shortcode_list__'.$k.'' , $v);
	}
	$shortcode_list = $temp;
	
	return apply_filters("WPBC_shortcode_list", $shortcode_list);  
	
} 

add_action("init", function () {   
    $shortcodes = WPBC_get_shortcode_list();  
    foreach (array_keys($shortcodes) as $shortcode_slug) {
        add_shortcode('WPBC_bs__'.$shortcode_slug, "WPBC_shortcode_callback");
    }; 
});
function WPBC_shortcode_callback($atts, $content = "", $this_name) {

	// shortcode data
  $shortcodes = WPBC_get_shortcode_list(); 
	
	$this_name = str_replace('WPBC_bs__','',$this_name);
  
  $shortcode = (!empty($shortcodes[$this_name])) ? $shortcodes[$this_name] : array();
	
	extract(shortcode_atts($shortcode, $atts));  
    $out  = "";
    if(!empty($class)){
		$class = ' '.$class;
	} 
	$content = shortcode_unautop( $content );
	ob_start();  
		$file = WPBC_get_template_parts_shortcodes($this_name);
		if(!empty($file)){
			include ($file); 
		} 
		$out = ob_get_contents();
	ob_end_clean(); 
	return $out; 
	//print_r($shortcodes[$this_name]); 

} 
 

function _WPBC_get_view_FX($atts, $content = null){
	extract(shortcode_atts(array(
		"params" => '',
		"name" => ''
	), $atts));
	$out = _get_views($name,$params);
	return $out; 
}
add_shortcode('_WPBC_get_view', '_WPBC_get_view_FX'); 
/* THE END HERE */

/*

	TODO, make shortcode

	Usage:
	
	$args = array(
		'before' => '<ul class="pagination">',
		'after' => '</ul>',
		'before_link' => '<li>',
		'after_link' => '</li>',
		'current_before' => '<li class="active">',
		'current_after' => '</li>',
		'previouspagelink' => '&laquo;',
		'nextpagelink' => '&raquo;'
	);
	bootstrap_link_pages( $args );

*/
 

function bootstrap_link_pages( $args = array () ) {
    $defaults = array(
		
		'before_pagination' => '',
		'after_pagination' => '',
	
        'before'      => '<ul class="pagination">',
        'after'       => '</ul>',
		
        'before_link' => '<li class="page-item">',
        'after_link'  => '</li>',
        'current_before' => '<li class="page-item active">',
        'current_after' => '</li>',
		'disabled_before' => '<li class="page-item disabled">',
        'disabled_after' => '</li>',
		
        'link_before' => '',
        'link_after'  => '',
		'link_class' => 'page-link',
        'pagelink'    => '%',
		'previouspagelink' => '&laquo;',
		'nextpagelink' => '&raquo;',
		'show_next_previous' => true,
        'echo'        => 1
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    if ( ! $multipage )
    {
        return;
    }
	
	$output = $before_pagination . $before; 
	
	if($show_next_previous){
		$a = _wp_link_page( $i );
		$a = str_replace('<a','<a class="'.$link_class.'"', _wp_link_page( 1 ) );
		if( 1 == $page ){
			$output .= "{$disabled_before}" . $a . "{$link_before}{$previouspagelink}{$link_after}</a>{$disabled_after}";
		}else{
			$output .= "{$before_link}" . $a . "{$link_before}{$previouspagelink}{$link_after}</a>{$after_link}";
		}
	}
	
    for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
    {
        $j       = str_replace( '%', $i, $pagelink );
        $output .= ' ';

        if ( $i != $page || ( ! $more && 1 == $page ) )
        {	
			$a = _wp_link_page( $i );
			$a = str_replace('<a','<a class="'.$link_class.'"', _wp_link_page( $i ) );
            $output .= "{$before_link}" . $a . "{$link_before}{$j}{$link_after}</a>{$after_link}";
        }
        else
        {
            $output .= "{$current_before}{$link_before}<a class='page-link'>{$j}</a>{$link_after}{$current_after}";
        }
    }
	
	if($show_next_previous){
		$a = _wp_link_page( $numpages + 1 );
		$a = str_replace('<a','<a class="'.$link_class.'"', _wp_link_page( 1 ) );
		if( ($numpages) == $page ){
			$output .= "{$disabled_before}" . $a . "{$link_before}{$nextpagelink}{$link_after}</a>{$disabled_after}";
		}else{
			$output .= "{$before_link}" . $a . "{$link_before}{$nextpagelink}{$link_after}</a>{$after_link}";
		}
	}

    print $output . $after . $after_pagination;
}