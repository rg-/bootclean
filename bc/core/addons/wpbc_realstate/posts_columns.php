<?php

add_filter( 'manage_property_posts_columns', 'wpbc_property_column_views' );
add_action( 'manage_property_posts_custom_column', 'wpbc_property_custom_column_views', 5, 2 );

function wpbc_property_column_views($defaults){ 
	$defaults['listing-price'] = __( 'Price', 'bootclean' ); 
	$defaults['featured-image'] = __('Featured Image', 'bootclean');
	$defaults['action-post'] = __('Actions', 'bootclean'); 
	return $defaults;
}
function wpbc_property_custom_column_views($column_name, $id){

	$currency_symbol = WPBC_property_currency_symbol(); 

	if ( $column_name === 'listing-price' ) {
		$listing_features_price = WPBC_get_field('property_price', $id);
		if($listing_features_price){
			$listing_features_price = $currency_symbol.' '.$listing_features_price;
		}else{
			$listing_features_price = '<span style="color:red;">'.__('NO PRICE','bootclean').'</span>';
		}
		echo $listing_features_price; 

		$temporary_prices = WPBC_get_field('property_u_temporary_prices', $property_id);

		if(!empty($temporary_prices)){
			echo "<p><small>".__wpbc_dashicon_yes()." Using Temporary Prices</small></p>";
		}
	}

	if ( $column_name === 'featured-image' ) {
	   wpbc_get_featured_image_for_columns($id); 

	   $location_map = WPBC_get_field('property_location_iframe', $id) || WPBC_get_field('property_location_map', $id);
	   $property_gallery = WPBC_get_field('property_gallery', $id);

	   echo "<div>";
	   if($property_gallery){
	   	echo "<small>".__wpbc_dashicon_yes()." Has Gallery</small> ";
	   }else{
	   	echo "<small>".__wpbc_dashicon_no()." No Gallery</small> ";
	   }
	   if($location_map){
	   	echo "<small>".__wpbc_dashicon_yes()." Has Map</small> ";
	   }else{
	   	echo "<small>".__wpbc_dashicon_no()." No Map</small> ";
	   }

   	}

   	if ( $column_name === 'action-post' ) {
		
   		// featured_post
		$featured_post = get_post_meta($id, 'wpbc_realstate_featured_post', true); 
		if($featured_post){
			$checked = 'checked="checked"';
		}else{
			$checked = '';
		}
		echo '<label><input data-post-update="checkbox" class="wpbc-update-meta-checkbox" type="checkbox" '.$checked.' data-post-meta="wpbc_realstate_featured_post" data-post-meta-val="1" data-id="'.$id.'" /> <small>'.__('Featured','bootclean').'</small></label>';
	}
}

// select filter on post type admin list
function wpbc_property_restrict_manage_posts($post_type, $which) {
	global $typenow; 
	$property_slug = WPBC_property_get_slug();
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array( 'property_type', 'property_operation', 'property_services' ); 
	// must set this to the post type you want the filter(s) displayed on

	if( $post_type == $property_slug ){ 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug); 
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms(array(
			// https://developer.wordpress.org/reference/functions/get_terms/#comment-2180
			    'taxonomy' => $tax_slug, 
			));  
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>$tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
	 
}
add_action( 'restrict_manage_posts', 'wpbc_property_restrict_manage_posts',10,2 );


/*

	Ex: 
	wp-admin/admin-ajax.php?action=wpbc_update_post_meta&postID=21&post_meta=wpbc_realstate_featured_post&post_meta_val=1

	TODO, a way to alter post taxonoies ?? and other fields?? featured img? content? title? create a post by ajax? create many posts by ajax from json or php array? filter that? create defaults property posts when setup theme? uuuuu a lot!!

*/
function wpbc_update_post_meta_FX(){       
	$post_meta = !empty($_POST[ 'post_meta' ]) ? $_POST[ 'post_meta' ] : (!empty($_GET[ 'post_meta' ]) ? $_GET[ 'post_meta' ] : '' );   
	$post_meta_val = !empty($_POST[ 'post_meta_val' ]) ? $_POST[ 'post_meta_val' ] : (!empty($_GET[ 'post_meta_val' ]) ? $_GET[ 'post_meta_val' ] : '' ); 

	$postID = !empty($_POST[ 'postID' ]) ? $_POST[ 'postID' ] : (!empty($_GET[ 'postID' ]) ? $_GET[ 'postID' ] : '' ); 
	$postID = intval( $postID ); 

	if( $postID > 0 ) {
		update_post_meta( $postID, $post_meta, $post_meta_val);  
	} exit; 
}
add_action( 'wp_ajax_wpbc_update_post_meta', 'wpbc_update_post_meta_FX' ); 

function wpbc_realstate_admin_footer(){
	
	if ( current_user_can( 'administrator' ) ){ ?>                    
		
		<script type="text/javascript" language="javascript">                
			
			jQuery( document ).ready( function(){                
				
				function wpbc_update_meta(ele, postID, post_meta, post_meta_val){
					jQuery('#post-'+postID+'').css('opacity','.5'); 
					var data = {
						'action': 'wpbc_update_post_meta', 
						'postID': postID,
						'post_meta': post_meta,
						'post_meta_val': post_meta_val
					};
					console.log(data);
					jQuery.post(ajaxurl, data, function(response) { 
						jQuery('#post-'+postID+'').css('opacity','1');
					});
				}
				// when the checkbox is clicked save the meta option for this post
				jQuery( '[data-post-update="checkbox"]' ).click( function() {  
					var me = jQuery(this);
					var postID = me.attr( "data-id" );
					var post_meta = me.attr( "data-post-meta" );
					var post_meta_val = me.attr( "data-post-meta-val" );
					var selected = 1;
					if ( !me.is(':checked') ){ selected = '0'; }  
					wpbc_update_meta(me, postID, post_meta, selected);
				});

			});
		
		</script> <?php

	}

}
add_action( 'admin_footer', 'wpbc_realstate_admin_footer' ); 