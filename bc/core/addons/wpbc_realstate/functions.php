<?php


// Form parts
//include('functions/WPBC_get_property_tax_dropdown.php'); 
//include('functions/WPBC_get_property_reset_button.php'); 
//include('functions/WPBC_get_property_search_button.php'); 
//include('functions/WPBC_get_property_price_ranger.php');  

function WPBC_property_is_featured($id){
	$featured_post = get_post_meta($id, 'wpbc_realstate_featured_post', true);
	if($featured_post) return true;
}

function WPBC_property_get_max_price(){
	$max_price_query = new WP_Query( array(
	    'post_type'      => array( 'property' ),
	    'meta_key'       => 'property_price',
	    'orderby'        => 'meta_value_num',
	    'posts_per_page' => 1,
	    'order'          => 'DESC',
	    'cache_results'  => true,
	) );
	if ( $max_price_query->have_posts() ) {
		while ( $max_price_query->have_posts() ) { 
			$max_price_query->the_post();
			$post_ID = get_the_ID();
		}
	}
	if(!empty($post_ID)){
		$max_price = get_post_meta( $post_ID, 'property_price', true );
		return $max_price;
	} 
}

// global things
function WPBC_property_query_paged(){ // ?? USED
	$paged = 1;
	return apply_filters('wpbc/filter/property/query/paged',$paged);
}
function WPBC_property_query_post_per_page(){ // ?? USED
	$posts_per_page = get_option('posts_per_page');
	return apply_filters('wpbc/filter/property/query/posts_per_page',$posts_per_page);
}
function WPBC_property_get_slug(){
	$property_slug = 'property';
	return apply_filters('wpbc/filter/property/post_type/slug',$property_slug);
}
function WPBC_property_get_slug_rewrite(){
	$property_slug_rewrite = 'property';
	return apply_filters('wpbc/filter/property/post_type/slug/rewrite',$property_slug_rewrite);
}
function WPBC_property_currency_symbol(){
	$symbol = '$';
	return apply_filters('wpbc/filter/property/currency/symbol',$symbol);
} 
function WPBC_property_currency_symbol_sep(){
	$symbol = ' ';
	return apply_filters('wpbc/filter/property/currency/symbol_sep',$symbol);
} 


// Template things

function WPBC_property_template_term_item($term, $args){

	$taxonomy = $args['taxonomy'];
	$taxonomy_args = $args['taxonomy_args'];

	$term_name = $term->name;
	$term_slug = $term->slug;
	$term_id = $term->term_id;
	$term_id = $term->term_id;
	$term_link = get_term_link($term_id, $taxonomy);
	$term_link = apply_filters('wpbc/filter/property/get_term_link', $term_link, $term_id, $taxonomy );
	$use_icons = $taxonomy_args['use_icons'];
	$use_links = $taxonomy_args['use_links'];

	if($use_icons){
		$term_name = '<i data-id="'.$term_id.'" class="icon-'.$term_slug.'"></i> '.$term_name;
	}

	if($use_links){
?>
<a href="<?php echo $term_link; ?>" class="<?php echo $taxonomy_args['btn_class']; ?>"><?php echo $term_name; ?></a>
<?php
		}else{
?>
<span data-href="<?php echo $term_link; ?>" class="<?php echo $taxonomy_args['btn_class']; ?>"><?php echo $term_name; ?></span>
<?php
		}
}

function WPBC_property_template_taxonomy_args($single=false, $property_id='', $taxonomy){
	

	$post_type = get_post_type();
	if( is_single() && $post_type == 'property' ){
		$taxonomy_args = array(
			'class' => 'list-group',
			'row_class' => 'list-group-item flex-column align-items-center',
			'row_head_class' => 'd-flex w-100 justify-content-between ',
			'row_label_class' => 'h5', 
			'row_desc_class' => '', 
			'use_icons' => true,
			'use_links' => true,
			'btn_class' => 'btn btn-link',
			'btn_current_class' => 'btn btn-primary',
			'sep' => ' | ',
			'row_items' => false,
		);
	}else{
		$taxonomy_args = array(
			'class' => '',
			'row_class' => '',
			'row_head_class' => 'd-flex w-100 justify-content-between',
			'row_label_class' => 'h5', 
			'row_desc_class' => '', 
			'use_icons' => true,
			'use_links' => false,
			'btn_class' => 'badge badge-primary',
			'sep' => ' ',
			'row_items' => false,
		);
	}

	return apply_filters('wpbc/filter/template-parts/property_taxonomy/args', $taxonomy_args, $single, $property_id, $taxonomy);
}

function WPBC_property_template_features_args($single=false, $property_id=''){
	$features_args = array(
		'class' => 'list-group',
		'row_class' => 'list-group-item flex-column align-items-start',
		'row_head_class' => 'd-flex w-100 justify-content-between align-items-center',
		'row_label_class' => 'h6',
		'row_meta_class' => 'h5 text-secondary',
		'row_desc_class' => '',
		'use_icons' => true,
	);
	return apply_filters('wpbc/filter/template-parts/property_features/args', $features_args, $single, $property_id);
}

function WPBC_property_template_prices_args($single=false, $property_id=''){

	$post_type = get_post_type();

	if( is_single() && $post_type == 'property' ){ 
		$prices_args = array(
			'class' => 'list-group',
			'row_class' => 'list-group-item flex-column align-items-start',
			'row_head_class' => 'd-flex w-100 justify-content-between',
			'row_label_class' => 'h5',
			'row_price_class' => 'h4 text-danger',
			'row_desc_class' => '',
			'row_not_available_class' => 'bg-danger text-white',
			'available' => __('Available','bootclean'),
			'not_available' => __('Not available','bootclean'),
		);
	}else{
		$prices_args = array(
			'class' => 'mb-2',
			'row_class' => 'd-flex flex-column align-items-start',
			'row_head_class' => 'd-flex w-100 justify-content-between align-items-center',
			'row_label_class' => 'h6 mb-0',
			'row_price_class' => 'h5 mb-0',
			'row_desc_class' => '',
			'row_not_available_class' => 'bg-danger text-white',
			'available' => __('Available','bootclean'),
			'not_available' => __('Not available','bootclean'),
		);
	}
	return apply_filters('wpbc/filter/template-parts/property_prices/args', $prices_args, $single, $property_id);
}

function WPBC_property_location_iframe_args($property_id=''){
	
	$location_map = WPBC_get_field('property_location_iframe', $property_id);
	$location_ajax = WPBC_default_property_location_ajax(); 
	
	$args = array(
		'src' => $location_map,
		'class' => 'position-relative bg-light',
		'ajax' => $location_ajax,
		'ajax_map_button_label' => __('Load Map', 'bootclean'),
		'ajax_map_wrapper_class' => 'position-absolute z-index-10 w-100 h-100 d-flex align-items-center justify-content-center',
		'ajax_map_button_class' => 'btn btn-primary mt-auto mb-auto',
		'ajax_map_button_before' => '',
		'ajax_map_button_after' => '',
		'map_class' => 'bg-light embed-responsive embed-responsive-16by9',
		'map_item_class' => 'embed-responsive-item image-cover',
		'map_item_style' => 'background-image:url('.get_template_directory_uri().'/images/theme/location_map.jpg);',
	);
	return apply_filters('wpbc/filter/template-parts/property_location_iframe/args', $args, $property_id);
}

// Template things END


function WPBC_property_pricing(){ // USED

	$property_pricing = array(

		array(
			'name' => 'property_price_min',
			'label' => __('Price min','bootclean'),
		),
		array(
			'name' => 'property_price_max',
			'label' => __('Price max','bootclean'),
		),


	);

	return $property_pricing;

}

// #########################################################
// Taxonomy parts
function WPBC_property_taxonomies(){ 
	
	$property_taxonomies = array();

	$property_taxonomies = apply_filters('wpbc/filter/property/property_taxonomies', $property_taxonomies);

	foreach($property_taxonomies as $k=>$v){
		$property_taxonomies[$k]['default_terms'] = apply_filters('wpbc/filter/property/property_taxonomies/'.$v['id'],'');
	}
	return $property_taxonomies;
}


// #########################################################
// #########################################################
// ACF PARTS
if( !function_exists('WPBC_get_property_features')){
	function WPBC_get_property_features($args=''){
		extract(shortcode_atts(array(   
			"post_id" => false,  
			"use_icons" => false,
			"sep_label" => ': ',
			"sep_meta" => ', ',
			"before" => '<ul class="property_features">',
			"after" => '</ul>',
			"before_meta" => '<li class="property_feature_meta">',
			"after_meta" => '</li>',

		), $args));

		$out = '';

		$property_features = WPBC_default_property_features(); 
		$temp = array(); 

		if($post_id){
			$property_fields = get_field('group_property_features', $post_id); 
			foreach ($property_features as $key => $value) { 
				$meta_value = $property_fields['property_features_'.$value['name'].''];
				$item = $value['label'] .$sep_label. $meta_value;
				if($use_icons){
					$item = '<i data-id="'.$value['name'].'" class="icon-'.$value['name'].'"></i> '.$item;
				}
				$temp[] = $before_meta.$item.$after_meta;
				?>
				<?php 
			} 
			$out = join( "$sep_meta ", $temp );

			return $before.$out.$after;
		}
	}
}


function WPBC_default_property_features(){
	$fields = array();
	return apply_filters('wpbc/filter/property/property_meta/property_features',$fields);
}

function WPBC_default_property_features_fields(){
	$temp = array();
	$default_property_features = WPBC_default_property_features();
	if(!empty($default_property_features)){
		foreach($default_property_features as $k=>$v){
			
			if( $v['type'] == 'number' ){ 
				
				$temp[] = array (
					'key' => 'field_property_features_'.$v['name'],
					'label' => $v['label'],
					'name' => 'property_features_'.$v['name'],
					'type' => 'number',
					'instructions' => !empty($v['instructions']) ? $v['instructions'] : '',
					'required' => !empty($v['required']) ? $v['required'] : 0,
					'conditional_logic' => !empty($v['conditional_logic']) ? $v['conditional_logic'] : 0,
					'wrapper' => array (
						'width' => '20%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => !empty($v['prepend']) ? $v['prepend'] : '',
					'append' => !empty($v['append']) ? $v['append'] : '',
					'min' => !empty($v['min']) ? $v['min'] : '0',
					'max' => !empty($v['max']) ? $v['max'] : '',
					'step' => !empty($v['step']) ? $v['step'] : '1',
				);

			}
		}
	}
	return $temp;
}

function WPBC_default_property_gallery_fields(){

	$fields[] = array(
		'key' => 'field_property_gallery',
		'label' => __('Property Gallery','bootclean'),
		'name' => 'property_gallery',
		'type' => 'gallery',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'min' => '',
		'max' => '',
		'insert' => 'append',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',
	);

	$fields = apply_filters('wpbc/realstate/property_meta/gallery/fields', $fields);
	return $fields;
}

function WPBC_default_property_location_map_type(){
	$map_type = apply_filters('wpbc/realstate/property/map/type', 'iframe');
	return $map_type;
}
function WPBC_default_property_location_ajax(){
	$use_ajax = apply_filters('wpbc/realstate/property/map/ajax', '1');
	return $use_ajax;
}
function WPBC_default_property_location_map_fields(){

	$map_type = WPBC_default_property_location_map_type();

	$fields = array();

	if($map_type == 'iframe'){ 
		$fields[] = array (
			'key' => 'field_property_location_iframe',
			'label' =>  __('Iframe Map','bootclean'),
			'name' => 'property_location_iframe',
			'type' => 'textarea',
			'instructions' => __('Paste iframe URL code ONLY.','bootclean'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'html_code',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '3',
			'new_lines' => '',
		);
	}

	if($map_type == 'map'){ 
		$fields[] = array(
			'key' => 'field_property_location_map',
			'label' => __('Google Map','bootclean'),
			'name' => 'property_location_map',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '',
			'center_lng' => '',
			'zoom' => '',
			'height' => '',
		);
	}

	return $fields;
}

function WPBC_default_property_single_price_group(){
	$sub_fields = array(

		array (
			'key' => 'field_property_single_price_label',
			'label' => __('Label','bootclean'),
			'name' => 'property_single_price_label',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '40',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => __('Ej: First half of January','bootclean'),
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),

		array (
			'key' => 'field_property_single_price_u_desc',
			'label' => __('Description','bootclean'),
			'name' => 'property_single_price_u_desc',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '15',
				'class' => 'wpbc-true_false-ui',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),

		array (
			'key' => 'field_property_single_price_available',
			'label' => __('Available','bootclean'),
			'name' => 'property_single_price_available',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '15',
				'class' => 'wpbc-true_false-ui ui-danger',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),

		array (
			'key' => 'field_property_single_price_desc',
			'label' => '',
			'name' => 'property_single_price_desc',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_property_single_price_u_desc',
						'operator' => '==',
						'value' => 1,
					),
				), 
			),
			'wrapper' => array (
				'width' => '100',
				'class' => 'html_code',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '3',
			'new_lines' => '',
		),

	);
	$sub_fields = apply_filters('wpbc/filter/property/property_meta/property_single_price/sub_fields', $sub_fields);

	$group = array (
		'key' => 'field_property_single_price',
		'label' => __('Single Price Details','bootclean'),
		'name' => 'property_single_price',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'conditional_logic_XXXX' => array (
				array (
					array (
						'field' => 'field_property_u_temporary_prices',
						'operator' => '==',
						'value' => 0,
					),
				), 
			),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $sub_fields,
	);
	$group = apply_filters('wpbc/filter/property/property_meta/property_single_price', $group);
	
	return $group;
}

function WPBC_default_property_temporary_prices_group(){

	$sub_fields = array(

		array (
			'key' => 'field_property_temporary_prices_list',
			'label' => __('Period prices list', 'bootclean'),
			'name' => 'property_temporary_prices_list',
			'type' => 'repeater',
			'instructions' => __('Add, move, order list.','bootclean'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => '',
			'sub_fields' => array (

				array (
					'key' => 'field_property_temporary_price_label',
					'label' => __('Label','bootclean'),
					'name' => 'property_temporary_price_label',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '40',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => __('Ej: First half of January','bootclean'),
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),

				array (
					'key' => 'field_property_temporary_price_num',
					'label' =>  __('Amount','bootclean'),
					'name' => 'property_temporary_price_num',
					'type' => 'number',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '20',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '0',
					'max' => '',
					'step' => '',
				),

				array (
					'key' => 'field_property_temporary_price_u_desc',
					'label' => __('Description','bootclean'),
					'name' => 'property_temporary_price_u_desc',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '15',
						'class' => 'wpbc-true_false-ui',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),

				array (
					'key' => 'field_property_temporary_price_available',
					'label' => __('Available','bootclean'),
					'name' => 'property_temporary_price_available',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '15',
						'class' => 'wpbc-true_false-ui ui-danger',
						'id' => '',
					),
					'message' => '',
					'default_value' => 1,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),

				array (
					'key' => 'field_property_temporary_price_desc',
					'label' => '',
					'name' => 'property_temporary_price_desc',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_property_temporary_price_u_desc',
								'operator' => '==',
								'value' => 1,
							),
						), 
					),
					'wrapper' => array (
						'width' => '100',
						'class' => 'html_code',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '3',
					'new_lines' => '',
				),

			),
		),

	);
	$sub_fields = apply_filters('wpbc/filter/property/property_meta/property_temporary_prices/sub_fields', $sub_fields);

	$group = array (
		'key' => 'field_property_temporary_prices',
		'label' => __('Property Temporary Prices','bootclean'),
		'name' => 'property_temporary_prices',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
				array (
					array (
						'field' => 'field_property_u_temporary_prices',
						'operator' => '==',
						'value' => 1,
					),
				), 
			),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $sub_fields,
	);

	$group = apply_filters('wpbc/filter/property/property_meta/property_temporary_prices', $group);
	
	return $group;
}

function WPBC_default_property_pricing_fields(){

	$fields = array();

	$fields[] = array (
			'key' => 'field_property_price',
			'label' => __('Property Search Price','bootclean'),
			'name' => 'property_price',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '0',
			'max' => '',
			'step' => '1',
		);

	$property_single_price_group = WPBC_default_property_single_price_group();
	$fields[] = $property_single_price_group;

	$fields[] = array (
		'key' => 'field_property_u_temporary_prices',
		'label' => __('Use temporary prices?','bootclean'),
		'name' => 'property_u_temporary_prices',
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'acf-hiddenXX',
			'id' => '',
		),
		'message' => '',
		'default_value' => 1,
		'ui' => 1,
		'ui_on_text' => '',
		'ui_off_text' => '',
	); 

	$property_temporary_prices_group = WPBC_default_property_temporary_prices_group();
	$fields[] = $property_temporary_prices_group; 

	$fields = apply_filters('wpbc/filter/property/property_meta/property_price', $fields);
	return $fields;
}

function WPBC_default_property_meta_fields(){

	$fields = array();
	$sub_fields = array();

	$sub_fields[] = array (
		'key' => 'field_property_api_id',
		'label' => '#REF',
		'name' => 'property_api_id',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '20%',
			'class' => '',
			'id' => '',

		),
		'readonly' => 'readonly',
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => 'API ID',
		'maxlength' => '',
	);

 	$sub_fields[] = array(
		'key' => 'field_property_tax__property_type',
		'label' => __( 'Property Type', 'bootclean' ),
		'name' => 'property_type',
		'type' => 'taxonomy',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '20%',
			'class' => '',
			'id' => '',
		),
		'taxonomy' => 'property_type',
		'field_type' => 'checkbox',
		'add_term' => 0,
		'save_terms' => 1,
		'load_terms' => 1,
		'return_format' => 'id',
		'multiple' => 0,
		'allow_null' => 0,
	);

	$sub_fields[] = array(
		'key' => 'field_property_tax__property_operation',
		'label' => __( 'Property Operation', 'bootclean' ),
		'name' => 'property_operation',
		'type' => 'taxonomy',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '20%',
			'class' => '',
			'id' => '',
		),
		'taxonomy' => 'property_operation',
		'field_type' => 'checkbox',
		'add_term' => 0,
		'save_terms' => 1,
		'load_terms' => 1,
		'return_format' => 'id',
		'multiple' => 0,
		'allow_null' => 0,
	);

	$sub_fields[] = array(
		'key' => 'field_property_tax__property_location',
		'label' => __( 'Property Location', 'bootclean' ),
		'name' => 'property_location',
		'type' => 'taxonomy',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '30%',
			'class' => '',
			'id' => '',
		),
		'taxonomy' => 'property_location',
		'field_type' => 'select',
		'add_term' => 0,
		'save_terms' => 1,
		'load_terms' => 1,
		'return_format' => 'id',
		'multiple' => 0,
		'allow_null' => 0,
	);

	$fields[] = array (
		'key' => 'field_group_property_main_details',
		'label' => __('Main Details','bootclean'),
		'name' => 'group_property_main_details',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $sub_fields,
	);
 	
 	$default_property_features = WPBC_default_property_features_fields();
	
	$fields[] = array (
		'key' => 'field_group_property_features',
		//'label' => __('Features','bootclean'),
		'name' => 'group_property_features',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => $default_property_features,
	);

	$fields[] = array(
		'key' => 'field_property_tax__property_services',
		'label' => __( 'Property Services', 'bootclean' ),
		'name' => 'property_services',
		'type' => 'taxonomy',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '50%',
			'class' => 'wpbc_taxonomy_checkbox_horizontal',
			'id' => '',
		),
		'taxonomy' => 'property_services',
		'field_type' => 'checkbox', 
		'add_term' => 0,
		'save_terms' => 1,
		'load_terms' => 1,
		'return_format' => 'id',
		'multiple' => 0,
		'allow_null' => 0,
	);

	$fields[] = array(
		'key' => 'field_property_tax__property_aditionals',
		'label' => __( 'Property Aditionals', 'bootclean' ),
		'name' => 'property_aditionals',
		'type' => 'taxonomy',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '50%',
			'class' => 'wpbc_taxonomy_checkbox_horizontal',
			'id' => '',
		),
		'taxonomy' => 'property_aditionals',
		'field_type' => 'checkbox',
		'add_term' => 0,
		'save_terms' => 1,
		'load_terms' => 1,
		'return_format' => 'id',
		'multiple' => 0,
		'allow_null' => 0,
	);

	return $fields;

}

// #########################################################
// #########################################################
// TO REMOVE

// THis ones are not used anymore.... see defaults.php
function WPBC_default_property_type(){
	$args = array();
	return apply_filters('wpbc/filter/property/property_taxonomies/property_type',$args);
}
function WPBC_default_property_operation(){
	$args = array();
	return apply_filters('wpbc/filter/property/property_taxonomies/property_operation',$args);
}
function WPBC_default_property_services(){
	$args = array();
	return apply_filters('wpbc/filter/property/property_taxonomies/property_services',$args);
}
function WPBC_default_property_aditionals(){
	$args = array();
	return apply_filters('wpbc/filter/property/property_taxonomies/property_aditionals',$args);
}