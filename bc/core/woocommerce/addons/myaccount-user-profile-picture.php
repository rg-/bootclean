<?php
// =========================================================================
/**
 * Function wpbc_woo_user_profile_picture
 *
 */
add_action( 'woocommerce_before_edit_account_form', 'wpbc_woo_user_profile_picture' );
function wpbc_woo_user_profile_picture( $atts, $content= NULL) {
	?>
<div class="d-sm-flex gmb-1">

	<div class="woo-account-panel-dashboard-profile_pic">
		<?php
			$gravatar_image      = get_avatar_url( get_current_user_id(), $args = null );
			$profile_picture_url = get_user_meta( get_current_user_id(), 'profile_pic', true ); 
			$profile_picture_url = wp_get_attachment_image_src($profile_picture_url);
			$image = ( ! empty( $profile_picture_url ) ) ? $profile_picture_url[0] : $gravatar_image; 
		?>
		<img width="100" class="profile-preview" alt="profile-picture" src="<?php echo $image; ?>">
		
	</div>

	<div class="woo-account-panel-dashboard-profile_name gpl-sm-1">
		<label>Imagen de perfil</label>
		<form enctype="multipart/form-data" action="" method="POST">
	    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
	    <div class="d-sm-flex">
	    	<div class="custom-file">
				  <input type="file" name="profile_pic" class="custom-file-input" id="profile_pic" lang="es">
				  <label class="custom-file-label" for="profile_pic">Seleccionar Imagen</label>
				</div>
				<div class="gml-sm-1">
			    <input type="submit" value="Subir" class="btn btn-outline-secondary" />
			  </div>
	    </div>
		</form>
	</div>

</div>
	<?php 
	if($_FILES['profile_pic']){

		$current_user = wp_get_current_user();
		$user_id = get_current_user_id();

		$picture_id = wpbc_woo_user_upload_picture($_FILES['profile_pic'], $user_id);
		
		wpbc_woo_user_save_picture($picture_id, $user_id);
	}
}

// =========================================================================
/**
 * Function wpbc_woo_user_save_picture
 *
 */
function wpbc_woo_user_save_picture($picture_id, $user_id){
	update_user_meta( $user_id, 'profile_pic', $picture_id );
}

// =========================================================================
/**
 * Function wpbc_woo_user_upload_picture
 *
 */
function wpbc_woo_user_upload_picture( $foto, $user_id) { 
	
	add_filter( 'upload_dir', 'wpbc_woo_user_upload_directory', 10);

	$wordpress_upload_dir = wp_upload_dir();
	// $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
	// $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
	$i = 1; // number of tries when the file with the same name is already exists

	$profilepicture = $foto;
	$new_file_path = $wordpress_upload_dir['path'] . '/' . $user_id . '__' . $profilepicture['name'];
	$new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
	
	$log = new WC_Logger();		
	
	if( empty( $profilepicture ) )
	$log->add('custom_profile_picture','File is not selected.');	

	if( $profilepicture['error'] )
	$log->add('custom_profile_picture',$profilepicture['error']);	
	

	if( $profilepicture['size'] > wp_max_upload_size() )
	$log->add('custom_profile_picture','It is too large than expected.');	
	

	if( !in_array( $new_file_mime, get_allowed_mime_types() ))
	$log->add('custom_profile_picture','WordPress doesn\'t allow this type of uploads.' );		

	while( file_exists( $new_file_path ) ) {
	$i++;
	$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
	}

	// looks like everything is OK
	if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
	

	$upload_id = wp_insert_attachment( array(
		'guid'           => $new_file_path, 
		'post_mime_type' => $new_file_mime,
		'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	), $new_file_path );

	// wp_generate_attachment_metadata() won't work if you do not include this file

	 
	require_once(ABSPATH . 'wp-admin' . '/includes/image.php'); 

	// Generate and save the attachment metas into the database
	wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );

	remove_filter( 'upload_dir', 'wpbc_woo_user_upload_directory', 10);

	return $upload_id;
	}
} 

function wpbc_woo_user_upload_directory( $args ) { 
	$newdir = '/users'; 
	$args['path']    = str_replace( $args['subdir'], '', $args['path'] ); //remove default subdir
	$args['url']     = str_replace( $args['subdir'], '', $args['url'] );      
	$args['subdir']  = $newdir;
	$args['path']   .= $newdir; 
	$args['url']    .= $newdir; 
	return $args;  
}

// =========================================================================
/**
 * Function wpbc_woo_user_change_avatar
 *
 */
add_filter( 'get_avatar' , 'wpbc_woo_user_change_avatar' , 1 , 5 );
function wpbc_woo_user_change_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;
    if ( is_numeric( $id_or_email ) ) {
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );	
    }

    if ( $user && is_object( $user ) ) {
		$picture_id = get_user_meta($user->data->ID,'profile_pic');
		if(! empty($picture_id)){
			$avatar = wp_get_attachment_url( $picture_id[0] );
			$avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
		}
    }
    return $avatar;
}