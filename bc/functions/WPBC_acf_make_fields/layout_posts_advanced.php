<?php

function WPBC_acf_make_layout_posts_advanced($layout_name='', $is_front=false, $post_types=array('post'), $use_taxonomy = array() ){

	$content_sub_fields = array(); 

			$style_choices = array(
				'default' => 'Default', 
				'masonry' => 'Masonry', 
				// 'slider' => 'Slider', // TODOING !!
			);
			if($is_front){
				unset($style_choices['slider']);
			}
			$content_sub_fields[] = WPBC_acf_make_radio_field(array(
					'name' => $layout_name.'__style',
					'label' => 'Loop Type', 
					'choices' => $style_choices,
					'default_value' => 'default',
					'width' => '80%',
					'class' => 'wpbc-radio-as-btn show-radio'
				));  

			if(!$is_front){ 

				$sub_fields__style_options[] = WPBC_acf_make_text_field(array(
					'name' => $layout_name.'__container_class',
					'label' => 'Container CLASS',
					'width' => '33%',
					'default_value' => 'container',
				));

			}

				$sub_fields__style_options[] = WPBC_acf_make_text_field(array(
					'name' => $layout_name.'__row_class',
					'label' => 'Row CLASS',
					'width' => '33%',
					'default_value' => 'row',
				));

				$sub_fields__style_options[] = WPBC_acf_make_text_field(array(
					'name' => $layout_name.'__item_class',
					'label' => 'Item CLASS',
					'width' => '33%',
					'default_value' => 'col-md-6 col-lg-4 gmb-1',
				)); 
  
				$sub_fields__style_options[] = WPBC_acf_make_select_field(array(
					'name' => $layout_name.'__item_template',
					'label' => __('ITEM template','bootclean'), 
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0, 
					'as_ui_layout_posts_advanced' => empty($use_taxonomy) ? 1 : 2, 
					'width' => '66%',
				));

			$content_sub_fields[] = WPBC_acf_make_group_field(array(
					'name' => $layout_name.'__style_options',
					'label' => 'Style Options', 
					'sub_fields' => $sub_fields__style_options,
				)); 


			$sub_fields__query = array(); 

			/*
				"__post_types" used as post type holder, not visible but required
				used on template parts, functions, field names...
			*/
			$post_types_text = implode(',', $post_types);
			$post_type_field = WPBC_acf_make_text_field(array(
				'name' => $layout_name.'__post_types',
				'label' => 'Post Types'.$post_types_text, 
				'default_value' => $post_types_text,
				'class' => 'wpbc-hidden-input wpbc-field-no-label wpbc-field-no-padding',
			)); 

			$sub_fields__query[] = $post_type_field;

				$posts_per_page_type_choices = array (
						'default' => 'Default', 
						'custom' => 'Custom',  
						'select' => 'Select', 
					);
				if($is_front){
					unset($posts_per_page_type_choices['select']);
				}

				$sub_fields__query[] = WPBC_acf_make_radio_field(array(
					'name' => $layout_name.'__posts_per_page_type',
					'label' => 'Posts per page Type', 
					'choices' => $posts_per_page_type_choices,
					'default_value' => 'default',
					'width' => '100%',
					'class' => 'wpbc-radio-as-btn'
				)); 

				$sub_fields__query[] = WPBC_acf_make_number_field(array(
					'name' => $layout_name.'__posts_per_page',
					'label' => 'Posts per page',
					'min' => '-1',
					'default_value' => get_option('posts_per_page'),
					'width' => '30%',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_'.$layout_name.'__posts_per_page_type',
								'operator' => '==',
								'value' => 'custom',
							),
						), 
					),
				));

				$sub_fields__query[] = WPBC_acf_make_message_field(array( 
					'key' => $layout_name.'__posts_per_page__message',
					'label' => 'Posts per page', 
					'message' => '<b>'.get_option('posts_per_page'). '</b> | <i>Options > Reading</i>',
					'width' => '30%',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_'.$layout_name.'__posts_per_page_type',
								'operator' => '==',
								'value' => 'default',
							),
						), 
					),
				));

				$sub_fields__query[] = WPBC_acf_make_select_field(
					array(
						'name' => $layout_name.'__order',
						'label'=> 'Order',  
						'choices' => array(
							'DESC' => 'DESC',
							'ASC' => 'ASC',  
						),
						'default_value' => 'DESC',
						'width' => '20%' 
					)
				);

				$orderby_choices = array (
						'post_date' => 'post_date',
						'post__in' => 'post__in',
						'none' => 'none', 
						'rand' => 'rand', 
						'author' => 'author',
						'title' => 'title',
						'name' => 'name', 
						'date' => 'date',
						'modified' => 'modified', 
					);
				if($is_front){
					unset($orderby_choices['post__in']);
				}

				$sub_fields__query[] = WPBC_acf_make_select_field( array( 
					'name' => $layout_name.'__orderby',  
					'label'=> 'Order by',  
					'choices' => $orderby_choices,
					'default_value' => 'post_date',
					'width' => '20%' 
				) );

				if(!$is_front){  

					$sub_fields__query[] = WPBC_acf_make_select_field(
						array(
							'name' => $layout_name.'__post_status',
							'label'=> 'Post Status',  
							'choices' => array(
								'publish' => 'Publish',
								'private' => 'Private',
								'future' => 'Future', 
								'draft' => 'Draft', 
								'pending' => 'Pending',
								'inherit' => 'Inherit',
							),
							'multiple' => 1,
							'ui' => 1,
							'default_value' => 'publish',
							'width' => '20%' 
						)
					);
					$sub_fields__query[] = WPBC_acf_make_message_field(array(
						'key' => $layout_name.'__post_query_separator',
						'width' => '100%',
						'class' => 'wpbc-field-no-label wpbc-field-no-padding'
					));
				}

				$sub_fields__query[] = WPBC_acf_make_relationship_field(array(
					'name' => $layout_name.'__post__in',
					'label' => 'Select posts',  
					'width' => '100%',
					'post_type' => $post_types,
					'return_format' => 'id',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_'.$layout_name.'__posts_per_page_type',
								'operator' => '==',
								'value' => 'select',
							),
						), 
					),
				));
 			

 			// If no taxonomy
			if(empty($use_taxonomy)){ 

				$content_sub_fields[] = WPBC_acf_make_group_field(array(
						'name' => $layout_name.'__query',
						'label' => 'Query Options', 
						'sub_fields' => $sub_fields__query,
					));
 			

				$sub_fields__pagination = array();

					$sub_fields__pagination[] = WPBC_acf_make_select_field(array(
						'name' => $layout_name.'__pagination_type',
						'label' => 'Pagination type', 
						'width' => '100%',
						'choices' => array(
							0 => 'None',
							'pager' => '< Number Pager >',
							'ajax' => 'Ajax',
						),
						'default_value' => 'pager',
					));

				$content_sub_fields[] = WPBC_acf_make_group_field(array(
						'name' => $layout_name.'__pagination',
						'label' => 'Pagination Options', 
						'sub_fields' => $sub_fields__pagination,
					));

			}else{

				/*
				FOR TAXONOMY HERE
				*/

				$sub_fields__taxonomy = array();

				$taxonomy_choices = $use_taxonomy;  

				$sub_fields__taxonomy[] = $post_type_field;

				$sub_fields__taxonomy[] = WPBC_acf_make_select_field(array(
						'name' => $layout_name.'__taxonomy_name',
						'label' => 'Taxonomy', 
						'width' => '20%',
						'choices' => $taxonomy_choices,
						'default_value' => key($taxonomy_choices),
					));

				$posts_per_page_type_choices = array (
						'default' => 'Default', 
						'custom' => 'Custom',  
						'select' => 'Select', 
					); 

				$sub_fields__taxonomy[] = WPBC_acf_make_radio_field(array(
					'name' => $layout_name.'__posts_per_page_type',
					'label' => 'Terms per page Type', 
					'choices' => $posts_per_page_type_choices,
					'default_value' => 'default',
					'width' => '100%',
					'class' => 'wpbc-radio-as-btn'
				)); 

				$sub_fields__taxonomy[] = WPBC_acf_make_number_field(array(
					'name' => $layout_name.'__posts_per_page',
					'label' => 'Terms per page',
					'min' => '0',
					'default_value' => '0',
					'width' => '20%', 
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_'.$layout_name.'__posts_per_page_type',
								'operator' => '==',
								'value' => 'Custom',
							),
						), 
					),
				));

				$sub_fields__taxonomy[] = WPBC_acf_make_message_field(array(
					'key' => $layout_name.'__posts_per_page__message',
					'label' => 'Terms per page', 
					'message' => '<b>0</b> | <i>All</i>',
					'width' => '20%',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_'.$layout_name.'__posts_per_page_type',
								'operator' => '==',
								'value' => 'default',
							),
						), 
					),
				));

				$orderby_choices = array ( 
						'name' => 'name', 
						'slug' => 'slug',
						'term_id' => 'term_id', 
						'parent' => 'parent',
						'random' => 'random'
					); 

				$sub_fields__taxonomy[] = WPBC_acf_make_select_field( array( 
					'name' => $layout_name.'__orderby',  
					'label'=> 'Order by',  
					'choices' => $orderby_choices,
					'default_value' => 'name',
					'width' => '20%',
					'conditional_logic' => array (
							array (
								array (
									'field' => 'field_'.$layout_name.'__posts_per_page_type',
									'operator' => '!=',
									'value' => 'select',
								), 
							), 
						),
				) );

				foreach ($taxonomy_choices as $tax) {

					$sub_fields = array();
						$sub_fields[] = WPBC_acf_make_taxonomy_field(array(
							'name' => $layout_name.'__'.$tax.'__term',
							'label' => 'Term', 
							'taxonomy' => $tax,
							'return_format' => 'id',  
							'class' => 'wpbc-field-no-label'
						));
					$sub_fields__taxonomy[] = WPBC_acf_make_repeater_field(array(
						'name' => $layout_name.'__'.$tax.'__include',
						'label' => 'Select terms '.$tax,  
						'width' => '100%',
						'sub_fields' => $sub_fields,
						'conditional_logic' => array (
							array (
								array (
									'field' => 'field_'.$layout_name.'__posts_per_page_type',
									'operator' => '==',
									'value' => 'select',
								),
								array (
									'field' => 'field_'.$layout_name.'__taxonomy_name',
									'operator' => '==',
									'value' => $tax,
								),
							), 
						),
					));

					
				}
				

				$content_sub_fields[] = WPBC_acf_make_group_field(array(
						'name' => $layout_name.'__query',
						'label' => 'Taxonomy Options', 
						'sub_fields' => $sub_fields__taxonomy,
					));


				/*
				FOR TAXONOMY HERE END !
				*/

			}

	return $content_sub_fields;

}


add_action('wpbc/layout/start', function($out){ 
	
},10,1); 