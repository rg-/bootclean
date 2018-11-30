<?php
 
$property_slug = WPBC_property_get_slug(); 

$WPBC_property_taxonomies = WPBC_property_taxonomies(); 

if(!empty($WPBC_property_taxonomies)){
	foreach($WPBC_property_taxonomies as $k=>$v){
		// print_r($v['args']['labels']['add_new_item']);
		if(!empty($v['id'])){

			register_taxonomy(
				$v['id'],
				array( $property_slug ),
				array(
					'label' => !empty($v['args']['label']) ? $v['args']['label'] : $v['id'],
					'labels' => array(
						'add_new_item' => !empty($v['args']['labels']['add_new_item']) ? $v['args']['labels']['add_new_item'] : '',
					),  
					
					'public' => true, 
					'hierarchical' => !empty($v['args']['hierarchical']) ? $v['args']['hierarchical'] : false,
					'sort' => true,
					'show_ui' => true,
				      'show_in_quick_edit' => true,
				      'meta_box_cb' => isset($v['args']['meta_box_cb']) ? $v['args']['meta_box_cb'] : 'post_categories_meta_box',
					'show_in_nav_menus' => false,
					'show_admin_column' => true,
					'rewrite' => false,
					
					'query_var' => false,
					//'query_var' => !empty($v['args']['query_var']) ? $v['args']['query_var'] : false,
					//'rewrite' => array( 'slug' => 'operation', 'with_front' => true ),
				)
			);

		}
	}
}  