<?php do_action('WPBC_layout__inner_col_sidebar__before'); ?>
<?php 
	// $args passed into template from shortcode
	$content_area_index = 1;
	$name = '';
	if(!empty($args)){
		$finalArray = array(); 
		$asArr = explode( ',', $args ); 
		foreach( $asArr as $val ){
		  $tmp = explode( ':', $val );
		  $key = str_replace(' ', '', $tmp[0]);
		  $finalArray[$key] = $tmp[1];
		}
		if(!empty($finalArray['area-id'])){
			$i = (int) $finalArray['area-id'];
			$content_area_index = $i;
		} 
		if(!empty($finalArray['name'])){
			$name = $finalArray['name']; 
		}
	} 

	$custom_layout_secondary_areas__enable = WPBC_get_option('custom_layout_secondary_areas__enable'); 
	if( !empty($custom_layout_secondary_areas__enable )){
		if(!empty($name)){
			$secondary_area_template = WPBC_get_option('bc-options--layout--secondary-area-template--'.$name);
			echo do_shortcode('[WPBC_get_template id="'.$secondary_area_template.'"/]');
		}
		
	}else{
		$post_id = WPBC_layout__get_id();  
		WPBC_get_template_builder_rows($post_id, 'key__flexible_secondary_content_rows_'.$content_area_index, $name);
	}
?>
<?php do_action('WPBC_layout__inner_col_sidebar__after'); ?>