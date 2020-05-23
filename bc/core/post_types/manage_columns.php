<?php
/*

	@bootclean
		@core
			@post_types
				@columns

*/

/* Helpers for any */

function __wpbc_dashicon_yes(){
	return "<i class='dashicons dashicons-yes text-success'></i>";
}
function __wpbc_dashicon_no(){
	return "<i class='dashicons dashicons-no text-danger'></i>";
}

function wpbc_get_featured_image_for_columns($id){
	$post_type = get_post_type($id);
	if(has_post_thumbnail($id)){
	   $img_size = apply_filters('wpbc/post_type/columns/featured-image/size', 'thumbnail', $post_type);
	   $img_width = apply_filters('wpbc/post_type/columns/featured-image/width', '50', $post_type);
	   $img_src = wp_get_attachment_image_url( get_post_thumbnail_id( $id ), $img_size );
	   ?>
	   <div class="post-image">
			<img width="<?php echo $img_width; ?>" src="<?php echo esc_url( $img_src ); ?>" alt=" ">
		</div>
	   <?php
   }else{
   		echo 'No featured image.';
   } 
   
   echo "</div>";
}
function wpbc_get_icon_for_columns($icon){
	$icon = WPBC_get_svg_img($icon, array(
		'color'=>'green',
		'width'=>'20',
		'height'=>'20',
	));
	return $icon; 
}

function wpbc_get_template_settings_for_columns($layout, $id){
	$title = '';
	if($layout=='main_navbar'){
		$title = 'Main Navbar';
		$temp = WPBC_layout__main_navbar_defaults($id);
		$if = WPBC_if_has_main_navbar($id);
	}
	if($layout=='main_page_header'){
		$title = 'Page Header';
		$temp = WPBC_layout__main_page_header_defaults($id);
		$if = WPBC_if_has_page_header($id);
	}
	if($layout=='main_footer'){
		$title = 'Main Footer';
		$temp = WPBC_layout__main_footer_defaults($id);
		$if = WPBC_if_has_main_footer($id);
	}
	$link = '';
	if(!empty($temp['template_id'])){
		$t_id = $temp['template_id'];
		$edit = get_edit_post_link($t_id);
		$link = '<a href="'.$edit.'" target="_blank">'.get_the_title($t_id).'</a>';
	} 

  if( !empty($if) ){
		if( $if == 2 ){
			$t_out = 'Not used';
		}else{ 
			$t_out = 'Using template: '.$link;
		} 
  }else{
 		$t_out = 'Using default: '.$link;
  }

  if(!empty($title)){
  	$out = "<p><small><b>".$title.": </b><br><span style='display:inline-block; padding-left:5px;'>".$t_out."</span></small></p>";
  }
  if($layout=='ajax_navigation'){ 
 
  	if(function_exists('WPBC_ajax_navigation_pjax__is_enabled')){
  		$out = '<p style="margin-top:10px; padding-top:5px;"><small><b>Page Navigation: </b></small></p>';	
  		if(WPBC_ajax_navigation_pjax__is_enabled($id)){
	  		$c = 'dashicons dashicons-yes text-success';   
		  }else{
		  	$c = 'dashicons dashicons-no text-danger';  
		  }
		  $out .= '<div><small><span class="dashicons dashicons-yes text-success"></span> Ajax navigation (pjax)</small></div>';
  	}
  	 
  	if(function_exists('WPBC_ajax_navigation__is_enabled')){

	  	if(WPBC_ajax_navigation__is_enabled($id)){
	  		$c = 'dashicons dashicons-yes text-success';   
		  }else{
		  	$c = 'dashicons dashicons-no text-danger';  
		  }
		  $out .= '<div><small><span class="'.$c.'"></span> Section Navigation</small></div>';
		 }

		 if(function_exists('WPBC_ajax_navigation_full__is_enabled')){

		  if(WPBC_ajax_navigation_full__is_enabled($id)){
	  		$c = 'dashicons dashicons-yes text-success';   
		  }else{
		  	$c = 'dashicons dashicons-no text-danger';  
		  }
		  $out .= '<div><small><span class="'.$c.'"></span> Full Height Sections</small></div>';
	  }

	  if(function_exists('WPBC_ajax_navigation_navmenu__is_enabled')){

		  if(WPBC_ajax_navigation_navmenu__is_enabled($id)){
	  		$c = 'dashicons dashicons-yes text-success';   
		  }else{
		  	$c = 'dashicons dashicons-no text-danger';  
		  }
		  $out .= '<div><small><span class="'.$c.'"></span> Menu Sections</small></div>'; 
  	}

	  echo $out;
  }else{

  	echo $out;

  }

}


/*

	Admin Columns for Page post type

*/
add_filter( 'manage_pages_columns', 'wpbc_manage_pages_columns' );
add_action( 'manage_pages_custom_column', 'wpbc_manage_pages_custom_column', 5, 2 );

function wpbc_manage_pages_columns( $defaults ) { 
   $defaults['template-layout'] = __('Template used', 'bootclean'); 
   $defaults['template-settings'] = __('Layout', 'bootclean'); 
   $defaults['featured-image'] = __('Featured Image', 'bootclean'); 
   return $defaults;
}

function wpbc_manage_pages_custom_column( $column_name, $id ){

	if ( $column_name === 'template-layout' ) {

		   $set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
		   if ( $set_template == 'default' ) {
			   echo 'Default';
		   }
		   $templates = get_page_templates();
		   ksort( $templates );
		   foreach ( array_keys( $templates ) as $template ) :
			   if ( $set_template == $templates[$template] ) echo $template;
		   endforeach; 

		  wpbc_get_template_settings_for_columns('ajax_navigation', $id);
   		
   		$custom_layout__enable = WPBC_get_field('custom_layout__enable', $id);
	   	if($custom_layout__enable){
				$layout = WPBC_get_layout_structure_build_layout($id);
				$layout_defaults = WPBC_layout_struture__defaults();
				$layout_args = WPBC_filter_layout_structure_build( $layout_defaults );

				$container_type = $layout_args['main_container'][$layout]['container_type']; 
				$img_path = get_template_directory_uri();

				$layout_icon = $img_path.'/template-parts/layout/structure/'.$layout.'.png';
				$container_icon = $img_path.'/bc/core/assets/images/layout_'.$container_type.'.png';
			   
			   //echo WPBC_get_field('custom_layout__custom_location', $id);

			   echo '<br><small>Container <small>'.$container_type.'</small>:<br> <img src="'.$container_icon.'" width="30" /></small>'; 
			   echo '<br><small>Layout <small>'.$layout.'</small>:<br> <img src="'.$layout_icon.'" width="30" /></small>';  
		   }
   } // 'template-layout' END 

   if ( $column_name === 'template-settings' ) { 
	    // Main Navbar
	    wpbc_get_template_settings_for_columns('main_navbar', $id); 
	    // Page Header
	    wpbc_get_template_settings_for_columns('main_page_header', $id); 
	    // Main Footer
	    wpbc_get_template_settings_for_columns('main_footer', $id);  
   }

   if ( $column_name === 'featured-image' ) {
	   wpbc_get_featured_image_for_columns($id); 
   }

}

/*

	Admin Columns for Post post type

*/

add_filter( 'manage_post_posts_columns', 'wpbc_manage_post_posts_columns' );

add_action( 'manage_post_posts_custom_column', 'wpbc_manage_post_posts_custom_column', 5, 2 );

function wpbc_manage_post_posts_columns( $defaults ) { 
   $defaults['featured-image'] = __('Featured Image', 'bootclean');
   return $defaults;
}

function wpbc_manage_post_posts_custom_column( $column_name, $id ) {
    
   if ( $column_name === 'featured-image' ) {
	   wpbc_get_featured_image_for_columns($id); 
   }
}