<?php 
	
	/*
	 * @passed $args
	 * @see _print_code($args);
	*/

	$layout_name = $args['layout'];
	$section_title = $args['section-title']; 

	$section_title_settings = !empty($args['section-title-settings']) ? $args['section-title-settings'] : array('heading' => '');  

	$style = '';
	$attrs = '';

	if(!empty($section_title_settings)){

		if( !empty($section_title_settings['color']) ){
			$style .= 'color:'.$section_title_settings['color'].'!important;';
		}
		if( !empty($section_title_settings['align']) ){
			$style .= 'text-align:'.$section_title_settings['align'].'!important;';
		}

		$temp = array();
		$root_breakpoint = BC_get_root_breakpoint();
		foreach ($root_breakpoint as $key => $value) {
			if($key!='xs'){
				foreach ($section_title_settings as $k => $v) {
					if (strpos($k, '_'.$key) !== false) {
						$kk = str_replace('_'.$key, '', $k);
						if (strpos($kk, '_tab') == false) {
							$temp[$key][$kk] = $v;
						}
					  
					}
				}
			}
		}

		$temp_styles = array();
		$key_styles_last = '';
		foreach ($root_breakpoint as $key => $value) {
			if( !empty($temp[$key]['enable']) ){
				$temp_styles[$key] = array(
					'color' => $temp[$key]['color'],
				);
				$key_styles_last = $key;
			}
		} 
		foreach ($root_breakpoint as $key => $value) {
			if( !empty($key_last) && empty($temp[$key]['enable']) ){
				$temp_styles[$key] = array(
					'color' => $temp[$key_styles_last]['color'],
				);
			} 
		} 

		$temp_class = array();
		$key_last = '';
		foreach ($root_breakpoint as $key => $value) {
			if( !empty($temp[$key]['enable']) ){
				$heading_class = str_replace('.', '', $temp[$key_last]['heading']);
				$temp_class[$key] = $heading_class . ' text-' . $temp[$key]['align'];  
				$key_last = $key;
			} 
		} 
		foreach ($root_breakpoint as $key => $value) {
			if( !empty($key_last) && empty($temp[$key]['enable']) ){
				$heading_class = str_replace('.', '', $temp[$key_last]['heading']);
				$temp_class[$key] = $heading_class . ' text-' . $temp[$key_last]['align']; 
			} 
		} 

	}

	if(!empty($temp_styles)){ 
		$temp_styles['xs'] = array('color' => $section_title_settings['color']); 
		$attrs .= " data-responsive-style='".json_encode($temp_styles)."'";
	}
	if(!empty($temp_class)){
		$heading_class = str_replace('.', '', $section_title_settings['heading']);
		$temp_class['xs'] = $heading_class . ' text-' . $section_title_settings['align'];
		$attrs .= " data-responsive-class='".json_encode($temp_class)."'";
	}


	$heading_class = str_replace('.', '', $section_title_settings['heading']);

?>

<?php do_action('wpbc/ui_layouts/section_title/before', $layout_name); ?>

	<h2 <?php echo $attrs; ?> style="<?php echo $style; ?>" class="<?php echo $heading_class; ?>"><?php echo $section_title; ?></h2>

<?php do_action('wpbc/ui_layouts/section_title/after', $layout_name); ?>