<?php
add_action('wpbc/layout/start', function(){  
		 
	WPBC_layout_struture__build('main_navbar');
	WPBC_layout_struture__build('main_pageheader'); 
	/* Here behind some usefull for dev things */ 
 
	$template = WPBC_get_template();
	$locations = WPBC_get_layout_locations(); 
	$layout = WPBC_get_layout_structure_build_layout();

	$layout_defaults = WPBC_layout_struture__defaults();
	$layout_args = WPBC_filter_layout_structure_build( $layout_defaults ); 
	//echo "filtered args: <br>";
	$options_wpbc_widgets = array();
	$options_wpbc_widgets[0] = 'None';
	$test = $GLOBALS['wp_registered_sidebars']; 
	foreach($test as $k=>$v){
		if($v['id'] != 'default_widget_area'){ 
			$options_wpbc_widgets[$v['id']] = $v['name'];
		}
	}

	global $wp_query;
	//echo "<pre>";
	//print_r($wp_query);
	//echo "</pre>";
}, 4 );

add_action('wpbc/layout/start', function(){ 
	?>
	<div id="main-content-wrap" class="layout__main_content_wrap aside-expand-content <?php WPBC_class_main_content_wrap(); ?>">
	<?php
}, 5 );
 
add_action('wpbc/layout/start', function(){ 
	WPBC_layout_struture__build('main_container');
	WPBC_layout_struture__build('main_footer');
}, 6 ); 

add_action('wpbc/layout/start', function(){ 
	?></div><!-- #main-content-wrap END --><?php
}, 7 ); 