<?php


/*
	@package cleaner
	@sub_package tiny_mce

*/

add_action('init', 'BC_tiny_mce__init');

function BC_tiny_mce__init(){
	
	add_action( 'admin_head', 'WPBC_tiny_mce__palettes', 0 ); // admin_enqueue_scripts is 10
	add_action( 'wp_head', 'WPBC_tiny_mce__palettes', 0 );

	function WPBC_tiny_mce__palettes(){
		?><script>
			var wpTinyMce_palettes = [<?php echo __BC_get_root_colors_palette_tiny() ? __BC_get_root_colors_palette_tiny() : 'null'; ?>]; 
		</script>
		<?php
	}
}

add_filter('tiny_mce_before_init', 'BC_tiny_mce_before_init', 99); 
function BC_tiny_mce_before_init($init=array()) {
	 
	//$init['textcolor_map'] = '['.__BC_get_root_colors_palette_tiny().']';
	//$init['textcolor_rows'] = 3; // expand colour grid to 6 rows
	$json = json_decode( __BC_get_root_colors_palette_tiny(true) );
	$init['textcolor_map'] = $json;
	
	$init['setup'] = 'function(ed) { 
		if(wpTinyMce_palettes){ 
			var old_mceInit = ed.settings.textcolor_map;
			var new_mceInit = wpTinyMce_palettes.concat(old_mceInit);
			ed.settings.textcolor_map = new_mceInit;  
		}  
	}';
	return $init;
}
