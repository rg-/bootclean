<?php

/*

	Filters:


		'wpbc/filter/get_query_form/query_fields'
		Default required hidden form fields

		'wpbc/filter/get_query_form/form_elements'
		Form elements in use
		
		'wpbc/filter/get_query_posts/query'
		Default query before shortcode passed args used by loop

		'wpbc/filter/get_query_posts/template_args'
		Defautl shortcode template args



*/

function WPBC_get_query_form_default_query_fields( $template_args, $query){

	$query_fields = array( 
		array( 
			'name'=>'action',
			'value' => $template_args['action'],
		), 
		array(
			'name'=>'posts_per_page',
			'value' => !empty($query['posts_per_page']) ? $query['posts_per_page'] : '',
		),
		array(
			'name'=>'paged',
			'value' => !empty($query['paged']) ? $query['paged'] : '',
		),
	);

	$query_fields[] = array( 
		'name'=>'post_type',
		'value' => !empty($query['post_type']) ? $query['post_type'] : '',
	);

	$query_fields = apply_filters('wpbc/filter/get_query_form/query_fields', $query_fields, $template_args, $query); 

	return $query_fields;

}

function WPBC_get_query_form_default_form_elements( $template_args, $query){
	
	$form_elements = array();

	if( $query['post_type'] == 'post' ){

		$form_elements['search'] = array( 
			'type'=>'text',
			'form_args'=>array( 
				'form_id' => 'search',
				'label' => 'Search',
				'placeholder' => 'Search',
				'current' => !empty($query['search']) ? $query['search'] : '', 
				// 'show_actions_all' => true,
				'show_actions_reset' => true,
			),
		);

		/*
		$form_elements['order'] = array( 
			'type'=>'dropdown',
			'form_args'=>array( 
				'form_id' => 'order',
				'label' => 'Order',
				'label_all' => 'None',
				'current' => !empty($query['order']) ? $query['order'] : 'ASC',  
				'items' => array(
					'ASC' => 'ASC',
					'DESC' => 'DESC',
				),
			),
		);

		$form_elements['orderby'] = array( 
			'type'=>'dropdown',
			'form_args'=>array( 
				'form_id' => 'orderby',
				'label' => __('Order by','bootclean'),
				'label_all' => 'None',
				'current' => !empty($query['orderby']) ? $query['orderby'] : 'date',  
				'items' => array(
					'date'  => 'Date',
					'modified' => 'Last modified',
					'title' => 'Title',
					'rand' => 'Rand',
				),
			),
		);
		*/

		$form_elements['order'] = array( 
			'type'=>'radio',
			'form_args'=>array( 
				'form_id' => 'order',
				'label' => 'Order',
				'label_all' => 'None',
				'current' => !empty($query['order']) ? $query['order'] : 'DESC',
				'items' => array( 
					'DESC' => 'DESC',
					'ASC' => 'ASC',
				), 
				'show_actions_reset' => true,
			),
		);

		$form_elements['orderby'] = array( 
			'type'=>'radio',
			'form_args'=>array( 
				'form_id' => 'orderby',
				'label' => 'Order by', 
				'current' => !empty($query['orderby']) ? $query['orderby'] : 'date',  
				'items' => array(
					'date'  => 'Date',
					'modified' => 'Last modified',
					'title' => 'Title',
					'rand' => 'Rand',
				), 
				'show_actions_reset' => true,
			),
		);

		$form_elements['category'] = array( 
			
			'type'=>'dropdown',
			'form_args'=>array( 
				'form_id' => 'category_name', 
				'label' =>  __('Category','bootclean'),
				'label_all' => __('All','bootclean').' '.__('Category','bootclean'),
				'current' => !empty($query['category_name']) ? $query['category_name'] : '',  
				'show_count' => true, 
				'get_terms' => array( 
					'taxonomy' => 'category', 
					'hide_empty' => false, 
				), 

				'show_actions_reset' => true,
			) 
		);

		$form_elements['post_tag'] = array( 
			
			'type'=>'checkbox',
			'form_args'=>array( 
				'form_id' => 'tag',  
				'label' =>  __('Tags','bootclean'),
				'label_all' => __('All','bootclean').' '.__('Tags','bootclean'),
				'current' => !empty($query['tag']) ? $query['tag'] : '',  
				'show_count' => true, 
				'get_terms' => array( 
					'taxonomy' => 'post_tag', 
					'hide_empty' => false, 
				), 

				'show_actions_all' => true,
				'show_actions_reset' => true,
			) 
		);
 

	}

	$form_elements = apply_filters('wpbc/filter/get_query_form/form_elements', $form_elements, $template_args, $query);

	if(!empty($template_args['form_id'])){
		$form_elements = apply_filters('wpbc/filter/get_query_form/'.$template_args['form_id'].'/form_elements', $form_elements, $template_args, $query);
	}

	return $form_elements;

} 

function WPBC_get_query_posts_default_query($query){

	// Define/filter defaults if not passed
	

	if(!empty( get_query_var('post_type') )){
		$query['post_type'] =  get_query_var('post_type');
	}else{
		if(empty($query['post_type'])){
			$query['post_type'] = apply_filters('wpbc/filter/get_query_posts/query/post_type', 'post');
		}
	} 

	if(!empty( get_query_var('paged') )){
		$query['paged'] =  get_query_var('paged');
	}else{
		if(empty($query['paged'])){
			$query['paged'] = 1;
		}
	} 
	if(empty($query['posts_per_page'])){
		// By default it will get all posts
		$query['posts_per_page'] = apply_filters('wpbc/filter/get_query_posts/query/posts_per_page', '-1');
	}
	// Test if array "," separated string is passed
	$post_type = $query['post_type'];
	$post_type_array = explode(",",$post_type);
	// If array is just ONE element, do not pass it as array, just string.
	if (sizeof($post_type_array) > 1) {
	    $query['post_type'] = $post_type_array;
	}   

	// "s" as "search" trick
	if( !empty( $query['search'] ) ){ 
		$query['s'] = esc_attr($query['search']);  
	}

	// meta_query
	$meta_query = array(); 
	if(!empty($meta_query)){
		$query['meta_query'][] = $meta_query; 
	} 

	$query_string = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
	if(!empty($query_string)){
		$query = wp_parse_args( $query_string, $query );
	}

	$query = apply_filters('wpbc/filter/get_query_posts/query', $query);
	return $query;

}

function WPBC_get_query_posts_default_template_args($query){

	$default_target_id = WPBC_get_query_posts_default_target_id();

	$template_args = array(
		
		'template_part' => 'content', // For the loop
		'template_part_single' => 'content-single', // For Single
		
		'target_id' => !empty($query['target_id']) ? $query['target_id'] : $default_target_id,
		'target_nav_id' => !empty($query['target_id']) ? $query['target_id'].'-nav' : $default_target_id.'-nav',
		
		'target_class' => 'row gmy-1', 
		'target_nav_class' => '',
		'target_nav_ul_class' => 'pagination justify-content-center',
		
		'pagination_load_more' => __( 'Load more', 'bootclean' ),
		'pagination_no_results' => __( 'No more post to load', 'bootclean' ),
		'pagination_not_found_posts' => __( 'Not found posts', 'bootclean' ),
		'pagination_showing' => __( 'Showing %u of %u.', 'bootclean' ), 
	);

	$template_args = apply_filters('wpbc/filter/get_query_posts/template_args', $template_args, $query);

	foreach($template_args as $k=>$v){
		$template_args[$k] = apply_filters('wpbc/filter/get_query_posts/template_args/'.$k, $v, $query);
	} 

	return $template_args;
}