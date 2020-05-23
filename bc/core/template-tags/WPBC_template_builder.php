<?php


include ('wpbc_template_builder/shortcode.php'); 
include ('wpbc_template_builder/post_type.php');


/*

	This one is for the output result used on _template_builder.php (template page)

	WPBC_get_template_builder
	
	See IMPORTANT:
		Where fields live:
		bc\core\acf\layouts.php
		bc\core\acf\reusables-fields.php
		
		Where templates live:
		template-parts\builder\...
	
	key__flexible_content_rows


	*/
function WPBC_get_template_builder_rows($post_id='', $sub_flex = false, $name=''){
	// key__flexible_secondary_content_rows
	if($sub_flex){
		$row = $sub_flex;
	}else{
		$row='key__flexible_content_rows';
	}
	//print_r($classes_group_2['r_builder_classes_group']);
	if($sub_flex=='key__layout_flexible_row__content'){
		$key_prefix = 'key__classes__';
		//$classes_group = get_sub_field('key__layout_'.$layout.'__content_key__r_builder_classes_group', $post_id);
	}else{
		$key_prefix = '';
	}


	
	$out = '';
	$layout_count = 0;
	$flexible_count = 0;
	$key__flexible_content_rows = $row;
	if( have_rows($key__flexible_content_rows, $post_id) ){ 
		while( have_rows($key__flexible_content_rows, $post_id) ){ 
			the_row($post_id);  
			$layout = get_row_layout(); 

			if(!empty($layout)){ 

				$file_uri = get_template_directory_uri().'/template-parts/builder';
				$file_path = get_template_directory().'/template-parts/builder';
				
				$child_file_uri = get_stylesheet_directory_uri().'/template-parts/builder';
				$child_file_path = get_stylesheet_directory().'/template-parts/builder';
				
				$inc = false; 
				if( file_exists( $child_file_path.'/'.$layout.'.php' ) ){
					$inc = $child_file_path.'/'.$layout.'.php'; 
				}else{
					if( file_exists( $file_path.'/'.$layout.'.php' ) ){
						$inc = $file_path.'/'.$layout.'.php'; 
					}
				} 
				$temp = '';
				ob_start();
				if(!empty($inc)){
					include ($inc);  
				} 
				$temp = ob_get_contents(); 

				ob_end_clean();  
				if( !empty($temp) ){  

					$temp = apply_filters('wpbc/template/builder/rows/temp', $temp, $post_id, $row, $key_prefix, $layout);

					$special_types = array('navbar_row');  

					if( !in_array($layout, $special_types) ){
 
						if( $layout == 'flexible_row' ){
							$flexible_row = true;
							$key_prefix = '';
							$flexible_count++;
							$classes_group = get_sub_field('key__layout_flexible_row__classes_key__r_builder_classes_group', $post_id);

							$global_content_visible = get_sub_field('key__layout_flexible_row__classes_key__global_content_visible', $post_id);
						}else{
							$flexible_row = false;
							$flexible_count = 0;
							$classes_group = get_sub_field('key__layout_'.$layout.'__content_key__r_builder_classes_group', $post_id); 

							$global_content_visible = get_sub_field('key__layout_'.$layout.'__content_'.'key__global_content_visible', $post_id);
						}
						// key__layout_flexible_row__classes
						
						 
						// $classes_group_flex = get_sub_field('key__layout_'.$layout.'__content', $post_id); 
	/*	
	ob_start();
	 
		
		if(empty($classes_group) ){ 
			print_r($global_content_visible);
		}
		
	  
	$out .= ob_get_contents();
	ob_end_clean();  
	*/
	
						//$classes_group = $classes_group_flex[0]['r_builder_classes_group'];
						
						/*
							Removing $key_prefix 
						*/
						$classes_group_temp = array();
						if(!empty($classes_group)){
							foreach($classes_group as $k=>$v){
								$kk = str_replace($key_prefix,'',$k);
								$classes_group_temp[$kk] = $v;
							}
						}
						$classes_group = $classes_group_temp;
						$key_prefix = '';
						 
							$content_row_id = $classes_group[$key_prefix.'content_row_id'];
							$content_visible = $classes_group[$key_prefix.'content_visible'];
							$content_use_divs = $classes_group[$key_prefix.'content_use_divs'];
							$content_use_row = $classes_group[$key_prefix.'content_use_row'];
							$content_row = $classes_group[$key_prefix.'content_row'];
							$content_row__container = $classes_group[$key_prefix.'content_row__container'];
							$content_row__container_row = $classes_group[$key_prefix.'content_row__container_row'];
							$content_row__container_row_col = $classes_group[$key_prefix.'content_row__container_row_col']; 
						
					if( empty($classes_group) ){
						$content_visible = $global_content_visible;
					}

						// TODO from here... make template-part includeable child/filter.. etc
						if($layout=='template_row'){
							$layout_id = get_sub_field('key__layout_template_row__content_'.'key__r_wpbc_template', $post_id);
							$template_row = $layout_id;
						}else{
							$layout_id = $post_id; 
						}
						$layout_id = $content_row_id ? $content_row_id: ( 'flex_'.$layout_id.'-'.$name.'-'.$layout.'-'.$layout_count );
						
						$layout_start_args = array(
							'post_id'=> $post_id,
							'layout_id'=> $layout_id,
							'layout_class'=> $content_row,
							'layout_name'=> $layout,
							'layout_count'=> $layout_count,
						);
						
						$layout_start = '<div id="'. $layout_id .'" class="flexible_content_row '.$content_row.'" data-layout="'.$layout.'" data-layout-index="'.$layout_count.'">';
						
						$layout_start = apply_filters('wpbc/template/builder/rows/layout_start', $layout_start, $layout_start_args);

							if(!$content_use_row){
								$content_row__container = 'no-container';
							}
							
							$layout_start .= '<div class="flexible_content_row_container '.$content_row__container.'">';
								$layout_row_start = '';
								$layout_row_end = '';
								if($content_use_row){
									$layout_row_start = '<div class="'.$content_row__container_row.'">';
									$layout_row_start .= '<div class="'.$content_row__container_row_col.'">'; 
									$layout_row_end = '</div>';
									$layout_row_end .= '</div>';
								}
								 
							//$layout_end = WPBC_get_edit_template_builder( ( !empty($template_id) ? $template_id : $post_id ), $layout, $post_id );
							$edit_id = !empty($template_row)?$template_row:$post_id;
							$layout_end = WPBC_get_edit_template_builder(number_format($edit_id));
							
							$layout_end .= '</div>'; // flexible_content_row_container
							
						$layout_end .= '</div>'; // flexible_content_row
						
						$temp = apply_filters('wpbc/template/builder/rows/pre', $temp, $post_id, $row, $key_prefix, $layout, $edit_id, $classes_group);

						if($content_visible){
							if($content_use_divs){
								$out .= $layout_start.$layout_row_start. $temp .$layout_row_end.$layout_end;
							}else{
								$out .= $temp;
							}
						}else{
							$out .= '<!-- NOT VISIBLE HERE: <div id="'. $layout_id .'" .... -->';
						}

					} else { // IF layout not $special_types

						$out .= $temp;

					}

				} // IF temp END
				
			} // IF layouts END

			$layout_count++;								
		}  
		
		// The final result!!
		$out = apply_filters('wpbc/template/builder/rows/out', $out, $post_id, $row, $key_prefix, $layout);
		$out = do_shortcode($out);
		echo $out;
		
	} // If layouts END
}

function WPBC_get_edit_template_builder($id, $layout='', $layout_id='', $class=''){
	
	$out = '';
	$l_id = '';
	$p_id = '';
	$post_id = '';
	
	$layout_test = get_post($layout_id);
	$id_test = get_post($id);
	/*
	if( !empty( $layout_test ) ){ 
		$l_id = $layout_id;
	} 
	if( !empty( $id_test ) ){ 
		$p_id = $id;
	}
	*/
	
	if($l_id){
		$post_id = $l_id;
	}else{
		$post_id = $p_id;
	}
	
	if( !empty($id) ){ 
		
		$edit_link = get_edit_post_link( $id );
		
		$edit_icon_svg = 'md-settings';
		if($class=='edit-image'){
			$edit_icon_svg = 'md-image';
		}
		$edit_icon = WPBC_get_svg_img($edit_icon_svg, array(
			'width'=>'30px',
			'height'=>'30px',
			'color'=>'white'
		));

		$edit_icon = apply_filters('wpbc/filter/template_builder/edit_icon', $edit_icon);
		
		$out .= ' <small class="wpbc-edit-link edit-link '. $class.'"><a class="post-edit-link" href="'.$edit_link.'" data-toggle="tooltip" data-placement="right" target="_blank" title="'.__('Edit','bootclean') .'-> '.get_the_title($id).'">'. $edit_icon .'</a></small>';   
	}
	
	if ( current_user_can('edit_theme_options') ) {
		
		return apply_filters('WPBC_get_edit_template_builder',$out);
		
	}
	
}

/*
	
	TEMPLATE 

*/ 

 
function WPBC_get_template_builder($post_id=''){
	//print_r($post);  

	do_action('wpbc/layout/builder/content/before');
	if ( have_posts($post_id) ) {  
		do_action('wpbc/layout/inner/content/loop/before');
		do_action('wpbc/layout/builder/loop/before');
		while ( have_posts($post_id) ) { 
			the_post($post_id);
			do_action('wpbc/layout/builder/rows/before');
			WPBC_get_template_builder_rows($post_id);
			WPBC_get_edit_template_builder($post_id);
			do_action('wpbc/layout/builder/rows/after');
			 
		}  // If posts END
		do_action('wpbc/layout/builder/loop/after'); 
		do_action('wpbc/layout/inner/content/loop/after');
		wp_reset_query(); 
	}
	do_action('wpbc/layout/builder/content/before');
} 


/* ----------------------------------------------------------------------------- */

	/*
	 *	wpbc/builder/layout/inner action
	 *	
	 *		@hooked action__wpbc_builder_layout_inner__col_content - 10 
	 *		@hooked action__wpbc_builder_layout_inner__col_sidebar - 20 
	 *
	 *
	 *		@deprecated since 9.0.1
	 *			see: template-builder/.....
	 */
 

	add_action('wpbc/builder/layout/inner', 'action__wpbc_builder_layout_inner__col_content', 10);
		function action__wpbc_builder_layout_inner__col_content(){
			// Yeah, that is all.... here, but not on core :)
			//WPBC_get_template_builder($post->ID); 
			get_template_part( 'template-parts/builder_col_content' ); 
		}
	add_action('wpbc/builder/layout/inner', 'action__wpbc_builder_layout_inner__col_sidebar', 20);
		function action__wpbc_builder_layout_inner__col_sidebar(){
			get_template_part( 'template-parts/col_sidebar' ); 
		}

/* ----------------------------------------------------------------------------- */