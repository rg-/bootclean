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
	if(has_post_thumbnail($id)){
	   $img_src = wp_get_attachment_image_url( get_post_thumbnail_id( $id ), 'thumbnail' );
	   ?>
	   <div class="post-image">
			<img width="50" src="<?php echo esc_url( $img_src ); ?>" alt=" ">
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

    if( $if ){
			if( $if == 2 ){
				$out = 'Not used';
			}else{ 
				$out = 'Using template: '.$link;
			} 
    }else{
   		$out = 'Using default: '.$link;
    }
    echo "<p><small><b>".$title.": </b><br><span style='display:inline-block; padding-left:5px;'>".$out."</span></small></p>";
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
   }

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