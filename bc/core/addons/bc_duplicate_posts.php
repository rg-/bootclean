<?php

/**
 * Bootclean bc_duplicate_posts v9.0
 *
 * @package bootclean
 * @subpackage addons
 * @addon bc_duplicate_posts
 */
 
 
/*
	Filter / Defaults:
	
		bc_duplicate_post__post_types => array('post','page')

*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  
 
$use_wpbc_duplicate_post = apply_filters('wpbc/filter/duplicate_post/installed', 1);   

if( ! class_exists('bc_duplicate_posts') && $use_wpbc_duplicate_post ) :

	add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'duplicate_post',
			'title' => __('Duplicate Post','bootclean'),
			// 'url' => menu_page_url('wpbc-theme-settings',false),
		);

		return $addon;
	},10,1);

	class bc_duplicate_posts {  
		public function __construct() {  
			
			add_action( 'admin_action_rd_duplicate_post_as_draft', array($this, 'bc_duplicate_post_as_draft') );
			
			// post type add row actions
			
			$enable_post_types = apply_filters('bc_duplicate_post__post_types' ,array('post','page'));
			foreach($enable_post_types as $post_type){
				add_filter( $post_type.'_row_actions', array($this, 'bc_duplicate_post_link'), 10, 2 );
			}
			
			//add_filter( 'post_row_actions', array($this, 'bc_duplicate_post_link'), 10, 2 );
			//add_filter( 'page_row_actions', array($this, 'bc_duplicate_post_link'), 10, 2 );
			
			/* TODO
				
				Option page to select post types to duplicate (avoid other plugins, like woo, that already has a duplicate button ) 
				
				Basicly, able to choose which/s {post type name} to use duplicate, via options, via filters....
				add_filter('{post type name}_row_actions', 'rd_duplicate_post_link', 10, 2);
			
			*/ 
			add_action('admin_footer-edit.php', array($this, 'bc_duplicate_post_js_to_head'),9999 );
			add_action('admin_footer-post.php', array($this, 'bc_duplicate_post_js_to_head'),9999 );
			/*
			 * Removes quick edit from custom post type list
			 */
			// add_filter('page_row_actions','bc_remove_quick_edit',10,2);
		}
			 
		
		// bc_remove_quick_edit
		/*
			TODO: manage this via admin side some way, needs then an options page or so.
		*/
		function bc_remove_quick_edit( $actions ) {
			global $post;
			if( $post->post_type == 'custom-post-type-name-here-ohohoho' ) {
				unset($actions['inline hide-if-no-js']);
			}
			return $actions;
		}
		// bc_remove_quick_edit END 
		
		// bc_duplicate_post_js_to_head
		function bc_duplicate_post_js_to_head() {
			global $post;
			if ( current_user_can('edit_posts') ) { 
				if( get_post_type($post)!='acf-field-group' ){ 
				?>
				<style>
					.misc-pub-duplicate{
						text-align:right;
					}
						.misc-pub-duplicate a.button{
							padding-left:0;
						}
						.misc-pub-duplicate a .dashicons{
							position: relative;
								left: 2px;
							top: 3px;
						}
					@media (max-width: 850px) {
						.misc-pub-duplicate{
							margin-bottom:10px;
						}
					}
				</style>
				<script> 
				var global_post_id = <?php echo $post->ID; ?>;
				jQuery(function(){
					if( !jQuery('body').hasClass('toplevel_page_wpcf7') ){ 
						
						if( jQuery('body').hasClass('gutenberg-editor-page') ){
								console.log(jQuery("#editor .edit-post-header .edit-post-header__settings").html());
							jQuery("#editor .edit-post-header .edit-post-header__settings").append('<div class="components-button editor-post-duplicate is-button is-default is-large"><a class="copy button" href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' + global_post_id + '" title="Duplicate this post" rel="permalink"><span class="dashicons dashicons-admin-page"></span>  Duplicate</a></div>');
							
						}else{
							var post_ID = jQuery('#post_ID').val() ? jQuery('#post_ID').val() : global_post_id;
							jQuery("#submitdiv #misc-publishing-actions").append('<div class="misc-pub-section misc-pub-duplicate"><a class="copy button" href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' + post_ID + '" title="Duplicate this post" rel="permalink"><span class="dashicons dashicons-admin-page"></span>  Duplicate</a></div>');
						}
					}
				});
				</script>
				<?php
				}
			}
		}
		// bc_duplicate_post_js_to_head END 
		
		// bc_duplicate_post_link
		function bc_duplicate_post_link( $actions, $post ) {
			if ( current_user_can('edit_posts') && get_post_type($post)!='acf-field-group' ) { 
				$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this post" rel="permalink">Duplicate</a>';
			}
			return $actions;
		}
		// bc_duplicate_post_link END
		
		// bc_duplicate_post_as_draft
		function bc_duplicate_post_as_draft(){
			global $wpdb;
			
			if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
				wp_die('No post to duplicate has been supplied!');
			}
		 
			/*
			 * get the original post id
			 */
			$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
			/*
			 * and all the original post data then
			 */
			$post = get_post( $post_id );
		 
			/*
			 * if you don't want current user to be the new post author,
			 * then change next couple of lines to this: $new_post_author = $post->post_author;
			 */
			$current_user = wp_get_current_user();
			$new_post_author = $current_user->ID; 
			/*
			 * if post data exists, create the post duplicate
			 */
			if (isset( $post ) && $post != null) { 
				/*
				 * new post data array
				 */
				$args = array(
					'comment_status' => $post->comment_status,
					'ping_status'    => $post->ping_status,
					'post_author'    => $new_post_author,
					'post_content'   => $post->post_content,
					'post_excerpt'   => $post->post_excerpt,
					'post_name'      => $post->post_name,
					'post_parent'    => $post->post_parent,
					'post_password'  => $post->post_password,
					'post_status'    => 'draft',
					'post_title'     => $post->post_title,
					'post_type'      => $post->post_type,
					'to_ping'        => $post->to_ping,
					'menu_order'     => $post->menu_order
				);
		 
				/*
				 * insert the post by wp_insert_post() function
				 */
				$new_post_id = wp_insert_post( $args );
		 
				/*
				 * get all current post terms ad set them to the new post draft
				 */
				$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
				foreach ($taxonomies as $taxonomy) {
					$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
					wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
				}
		 
				/*
				 * duplicate all post meta
				 */
				$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
				if (count($post_meta_infos)!=0) {
					$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
					foreach ($post_meta_infos as $meta_info) {
						$meta_key = $meta_info->meta_key;
						$meta_value = addslashes($meta_info->meta_value);
						$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
					}
					$sql_query.= implode(" UNION ALL ", $sql_query_sel);
					$wpdb->query($sql_query);
				}
		  
				/*
				 * finally, redirect to the edit post screen for the new draft
				 */
				global $pagenow;
				//wp_redirect( admin_url( $pagenow ) );
				wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
				exit;
			} else {
				wp_die('Post creation failed, could not find original post: ' . $post_id);
			}
		}
		// bc_duplicate_post_as_draft END 
		
	} // class END
	
	global $bc_duplicate_posts;
	$bc_duplicate_posts = new bc_duplicate_posts(); 
endif;