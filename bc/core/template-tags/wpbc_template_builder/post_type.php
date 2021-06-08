<?php

/*

	This one is used on the admin area to create "templates"
	
		See: WPBC_template_builder__taxonomy_type_terms, to add/remove new ones, but keep simple and let child themes do the filter for new ones, the main idea is > add a new type > create the fields > create the template for output on /template-parts/...

	Post type: wpbc_template
	
	Shortcode related: wpbc_template_shortcode

*/

// Reference v8 : C:\xampp\htdocs\_www\bootclean-v8\_html\wp-content\themes\bootclean\bc\core\admin\post_types\bc_templates.php


add_action( 'init', 'WPBC_template_builder' ); 


function WPBC_template_builder__post_type_name(){
	return 'wpbc_template';
}
function WPBC_template_builder__taxonomy_type_name(){
	return 'wpbc_template_type';
}

function WPBC_template_builder__post_type_show_in_menu(){
	
	/*
		Forget this part, leave Templates as standalone admin menu item.
	*/
	if( !WPBC_is_options_page_enabled()){
		$post_type_menu = true;
	}else{
		$post_type_menu = optionsframework_menu_slug();
	}
	
	$post_type_menu = true;
	return apply_filters('WPBC_template_builder__post_type_show_in_menu', $post_type_menu);
}
function WPBC_template_builder__post_type_supports(){
	//$args = array('title','editor');
	$args = array('title');
	return apply_filters('WPBC_template_builder__post_type_supports',$args);
} 

function WPBC_template_builder__taxonomy_type_terms(){
	$default_template_types = array(
		array('name' => 'Slider', 'slug' => 'slider'),
		array('name' => 'Default', 'slug' => 'default')
	);
	return apply_filters('WPBC_template_builder__taxonomy_type_terms',$default_template_types);
}
	
function WPBC_template_builder(){
	 
	$svg_icon = '<span class="wpbc-menu-image">'. WPBC_get_svg_img('md-cube', array(
		'width'=>'20px',
		'height'=>'20px',
		//'color'=>'black'
	)) .'</span>'; 
	
	$svg_img = WPBC_get_svg_img('md-cube', array(
		'data_src_type'=>'base64',
		'return'=>'src',
		'color'=>'black'
	));
	
	function WPBC_template_builder__post_type_menu_icon($svg_img){
		if(WPBC_template_builder__post_type_show_in_menu() === true){
			return $svg_img;
		}
	}
	
	/* post_type slider */  
	$post_type_labels = array(
		'name'               => __( 'Templates', 'bootclean' ),
		'singular_name'      => __( 'Template', 'bootclean' ),
		'menu_name'          => __( 'Templates', 'bootclean' ),
		'name_admin_bar'     => __( 'Template', 'bootclean' ),
		'add_new'            => __( 'Add New', 'bootclean' ),
		'add_new_item'       => __( 'Add New Template', 'bootclean' ),
		'new_item'           => __( 'New Template', 'bootclean' ),
		'edit_item'          => __( 'Edit Template', 'bootclean' ),
		'view_item'          => __( 'View Template', 'bootclean' ),
		'all_items'          => __( 'All Templates', 'bootclean' ),
		'search_items'       => __( 'Search Templates', 'bootclean' ),
		'parent_item_colon'  => __( 'Parent Template:', 'bootclean' ),
		'not_found'          => __( 'No Template found.', 'bootclean' ),
		'not_found_in_trash' => __( 'No Template found in Trash.', 'bootclean' )
	);
	
	$publicly_queryable = false;
	if ( current_user_can( 'manage_options' ) ) {
	    $publicly_queryable = true;
	}
	register_post_type(
		WPBC_template_builder__post_type_name(), 
		array(
			'labels' => $post_type_labels,
			'description' => __( 'Bootclean Template Builder, or BTB!!.', 'bootclean' ),
			'public' => true,
			'has_archive' => false,
			'hierarchical' => false,
			'show_in_nav_menus' => false,
			'publicly_queryable' => $publicly_queryable, // hide from front end
			'exclude_from_search' => true,
			'query_var' => false,
			'supports' => WPBC_template_builder__post_type_supports(),
			'menu_icon' => WPBC_template_builder__post_type_menu_icon($svg_img),
			'rewrite' => false,
			'show_in_menu' => WPBC_template_builder__post_type_show_in_menu(), //  >> bc\core\theme-options.php 
		/*
		'rewrite' => array(
			'slug' => 'wpbc_template',
			'with_front' => false
		 )
		*/
		)
	);

	/*

	OBSOLETE, see wpbc_template default/slider

	Taxonomies as "Formats", that will be in this case "Template Types" */
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Template Types', 'taxonomy general name', 'bootclean' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name', 'bootclean' ),
		'search_items'      => __( 'Search Types', 'bootclean' ),
		'all_items'         => __( 'All Types', 'bootclean' ),
		'parent_item'       => __( 'Parent Type', 'bootclean' ),
		'parent_item_colon' => __( 'Parent Type:', 'bootclean' ),
		'edit_item'         => __( 'Edit Type', 'bootclean' ),
		'update_item'       => __( 'Update Type', 'bootclean' ),
		'add_new_item'      => __( 'Add New Type', 'bootclean' ),
		'new_item_name'     => __( 'New Type', 'bootclean' ),
		'menu_name'         => __( 'Type', 'bootclean' ),
	);


	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => WPBC_template_builder__taxonomy_type_name() ),
		'capabilities' => array(
			'manage_terms' => '',
			'edit_terms' => '',
			'delete_terms' => '',
			'assign_terms' => 'edit_posts'
		),
		'public' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud' => false,
	);
	register_taxonomy( WPBC_template_builder__taxonomy_type_name(), array( WPBC_template_builder__post_type_name() ), $args); // our new 'type' taxonomy 
	
	
	// Just in case: https://codex.wordpress.org/Function_Reference/wp_delete_term
	// wp_delete_term( $term_id, $taxonomy, $args )
	// Run this things just once and never leave uncommented 
	//wp_delete_term( 7, WPBC_template_builder__taxonomy_type_name() );
	//wp_delete_term( 5, WPBC_template_builder__taxonomy_type_name() );
	//wp_delete_term( 11, WPBC_template_builder__taxonomy_type_name() );
	
	$default_template_types = WPBC_template_builder__taxonomy_type_terms();
	if(!empty($default_template_types)){
		foreach($default_template_types as $k=>$v){

			// Do not insert term if allready there... just in case.
			$term = term_exists( $v['name'], WPBC_template_builder__taxonomy_type_name() );
			if ( $term !== 0 && $term !== null ) return;

			wp_insert_term(
				$v['name'],
				WPBC_template_builder__taxonomy_type_name(),
				array(
				  'description'	=> '',
				  'slug' 		=> $v['slug']
				)
			);
		}
	}
	/*
	
	wp_insert_term(
		'Default',
		WPBC_template_builder__taxonomy_type_name(),
		array(
		  'description'	=> '',
		  'slug' 		=> 'default'
		)
	);
	wp_insert_term(
		'Navbar', // change this to
		WPBC_template_builder__taxonomy_type_name(),
		array(
		  'description'	=> '',
		  'slug' 		=> 'navbar'
		)
	);
	wp_insert_term(
		'Slider', // change this to
		WPBC_template_builder__taxonomy_type_name(),
		array(
		  'description'	=> '',
		  'slug' 		=> 'slider'
		)
	);
	*/

} // init END


// replace checkboxes for the format taxonomy with radio buttons and a custom meta box
function WPBC_template_wp_terms_checklist_args( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === WPBC_template_builder__taxonomy_type_name() ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, ...$args ) {
                        $output = parent::walk( $elements, $max_depth, ...$args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );
                        return $output;
                    }
                }
            }
            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }
    return $args;
} 
add_filter( 'wp_terms_checklist_args', 'WPBC_template_wp_terms_checklist_args' );

// Remove the "Most used" tab
add_action('admin_head', function(){
	?><style type='text/css'>
		#wpbc_template_type-pop,
		#wpbc_template_type-tabs{
			display:none!important;
		}
	</style><?php
});

function WPBC_template_buider_save_post( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
    	// Make "default" to be saved as default if nothing selected
        $defaults = array(
            WPBC_template_builder__taxonomy_type_name() => 'default'
            );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post', 'WPBC_template_buider_save_post', 100, 2 );

function WPBC_template_builder_styles(){
    $icon = get_template_directory_uri().'/bc/core/assets/svg/md-cube.svg';
    $custom_css = " 
            body.post-type-wpbc_template .wp-heading-inline:before
            {
				content:'';
				display:inline-block;
                background-image: url( {$icon} );
				  background-size: 28px 28px;
				  height: 28px;
				  width: 28px;
				  position: relative;
				  top:7px;
				  margin-right:8px;
            }";
	wp_register_style( 'inline-custom-style', false );
    wp_enqueue_style( 'inline-custom-style' );
    wp_add_inline_style( 'inline-custom-style', $custom_css );
}
add_action( 'admin_enqueue_scripts', 'WPBC_template_builder_styles' ); 

add_filter( 'manage_wpbc_template_posts_columns', 'wpbc_template_column_views' );
add_action( 'manage_wpbc_template_posts_custom_column', 'wpbc_template_custom_column_views', 5, 2 ); 

function wpbc_template_column_views( $defaults ){
	$defaults['template-id'] = __( 'Template ID / Shortcode', 'bootclean' ); 
	$defaults['template-type'] = __( 'Type', 'bootclean' );
	return $defaults;
}
function wpbc_template_custom_column_views( $column_name, $id ){
	
	$this_post = get_post($id);
	
	if ( $column_name === 'template-id' ) {   
		$bc_layout_id = $this_post->post_name; 
		$name = get_the_title($id);
		echo '<span class="wpbc_template_id '.$bc_layout_id.'"><input style="font-size:12px; line-height:12px; width:100%;" onclick="this.focus();this.select()" type="text" name="bc_layout_id" value="[WPBC_get_template id=&quot;'.$id.'&quot; name=&quot;'.$name.'&quot;/]" readonly="readonly"></span>'; 
	}
	if ( $column_name === 'template-type' ) { 
		$template_type = 'default';
		$default_template_types = WPBC_template_builder__taxonomy_type_terms();
		if(!empty($default_template_types)){
			foreach($default_template_types as $k=>$v){ 
				if( has_term( $v['slug'], WPBC_template_builder__taxonomy_type_name(), $this_post ) ){
					$template_type = $v['slug'];
				}
			}
		} 
		echo '<span class="wpbc_template_type '.$template_type.'">'.$template_type.'</span>'; 
	} 
}


// ACF

if( function_exists('acf_add_local_field_group') ):
function d(){
	if(!empty($_GET['post'])){
		$id = $_GET['post'];
		$name = get_the_title($id);
		return '<span class="wpbc_template_id wpbc_template_'.$id.'"><input style="font-size:12px; line-height:12px; width:100%;" onclick="this.focus();this.select()" type="text" name="bc_layout_id" value="[WPBC_get_template id=&quot;'.$id.'&quot; name=&quot;'.$name.'&quot;/]" readonly="readonly"></span>';
	} 
}
acf_add_local_field_group(array(
	'key' => 'group_wpbc_template_helper',
	'title' => 'Helper',
	'fields' => array(
		array(
			'key' => 'field_wpbc_template_helper_shortcode',
			'label' => __('Shortcode use','bootclean'),
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => d(),
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array (
			'key' => 'field_wpbc_template_helper_comments',
			'label' => __('Description','bootclean'),
			'name' => 'wpbc_template_helper_comments',
			'type' => 'textarea',
			'instructions' => __('Internal use only.','bootclean'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
		),
	), 
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'wpbc_template',
			),
		),
	),
	'menu_order' => 10,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;


/*

	AJAX Create New Page Builder

	This is for:

		- Add _template_builder.php as page_template used.
		- The post is created by wp_insert_post
		- Then the _wp_page_template post meta value is updated
		- Then the ajax return the edit url
		- User is redirected

		- Needs to parts

			- the button to trigger the action
			- the code for the action itself


*/

//Insertar Javascript js y enviar ruta admin-ajax.php
add_action('admin_enqueue_scripts', 'WPBC_insert_page_builder__scripts');

function WPBC_insert_page_builder__scripts(){

	wp_enqueue_script( 'jquery-ui-dialog' ); // jquery and jquery-ui should be dependencies, didn't check though...
	wp_enqueue_style( 'wp-jquery-ui-dialog' );

	$js_path = get_template_directory_uri() . '/js/wpbc_insert_page_builder.js';

	wp_register_script('wpbc-insert_page_builder',$js_path, array(), '1', true );
	wp_enqueue_script('wpbc-insert_page_builder');

	wp_localize_script('wpbc-insert_page_builder','dcms_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);
} 

add_action('admin_footer','WPBC_insert_page_builder__admin_footer',999);
function WPBC_insert_page_builder__admin_footer(){

	$post_edit_link = 'edit.php?post_type=page&page=wpbc-edit-new-page-builder';
	
?>
<!-- The modal / dialog box, hidden somewhere near the footer -->
<div id="page-builder-dialog" class="hidden" style="max-width:100%; width:600px; text-align:center;">
  <h3>New page using <br>Page Template</h3>
  <p><a href="<?php echo admin_url( $post_edit_link ); ?>" class="button button-primary button-large add-new-page-builder">New Page Builder</a></p>
  <p>- or -</p>
  <p><a href="<?php echo admin_url('/post-new.php?post_type=page'); ?>" class="button button-primary button-large add-new-page-builder">New Page (*)</a></p>

  <p><small>(*) This is just the default Wordpress page.</small></p>
</div>
<?php
}

add_action('admin_menu', 'WPBC_insert_page_builder__admin_menu');

function WPBC_insert_page_builder__admin_menu() {   
  add_submenu_page(
      'edit.php?post_type=page',
      'New Page Builder',
      'New Page Builder',
      'edit_posts',
      'wpbc-edit-new-page-builder',
      'WPBC_insert_page_builder_function_output' );
  
  if(WPBC_is_template_landing_enabled()){
  	 add_submenu_page(
      'edit.php?post_type=page',
      'New Landing Page',
      'New Landing Page',
      'edit_posts',
      'wpbc-edit-new-landing-page',
      'WPBC_insert_landing_function_output' );
  }
 
  add_submenu_page(
      'edit.php?post_type=page',
      'Page Builder +',
      'Page Builder +',
      'edit_posts',
      'wpbc-edit-new-page-builder-plus',
      'WPBC_insert_page_builder_plus_function_output' ); 
} 

function WPBC_insert_page_builder_function_output() { 
	$my_post = array( 
		'post_title' => 'New Page Builder',
	  'post_type' => 'page', 
	); 
	$post_id = wp_insert_post( $my_post ); 
	$post_edit_link = '';
	if( !is_wp_error($post_id) ) {
		update_post_meta( $post_id, '_wp_page_template', '_template_builder.php' );  
		$post_edit_link = 'post.php?post='.$post_id.'&action=edit'; 
		echo "Redirecting: ".get_admin_url().$post_edit_link;  
		?>
		<script type="text/javascript">
		window.location = '<?php echo get_admin_url().$post_edit_link; ?>';
		</script>
		<?php
	} 
  exit;
} 
function WPBC_insert_landing_function_output() { 
	$my_post = array( 
		'post_title' => 'New Landing Page',
	  'post_type' => 'page', 
	); 
	$post_id = wp_insert_post( $my_post ); 
	$post_edit_link = '';
	if( !is_wp_error($post_id) ) {
		update_post_meta( $post_id, '_wp_page_template', '_template_landing_builder.php' );  
		$post_edit_link = 'post.php?post='.$post_id.'&action=edit'; 
		echo "Redirecting: ".get_admin_url().$post_edit_link;  
		?>
		<script type="text/javascript">
		window.location = '<?php echo get_admin_url().$post_edit_link; ?>';
		</script>
		<?php
	} 
  exit;
} 

function WPBC_insert_page_builder_plus_function_output(){

}