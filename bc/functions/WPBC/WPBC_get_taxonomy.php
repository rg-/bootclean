<?php

if( !function_exists('WPBC_get_taxonomy') ){
	function WPBC_get_taxonomy($args = '' ){

		global $wp_query;

		$options = wp_parse_args( $args['options'], array(
			'type' => 'list', 
			'nav_id' => 'WPBC_get_taxonomy-'.uniqid(),
			'count_item_class' => 'badge badge-light',
			'nav_class' => 'nav flex-column',
			'nav_item_class' => 'nav-item',
			'nav_link_class' => 'nav-link',
			'inclue_childrens' => true,
			'rearange_taxonomy' => true,
			'return' => 'return', // array, echo, return
			'collapse_caret' => '<i class="icon fa fa-angle-down"></i>',
		) );

		unset($args['options']);

		$defaults = array( 
			'taxonomy' => 'category',
			'hide_empty' => true, 
			'count' => false,
		); 
    $args = wp_parse_args( $args, $defaults ); 

		$out = '';
		
		$taxonomy = get_categories($args);

		$tax_temp = array();
		if(!empty($taxonomy)){
			foreach ($taxonomy as $key => $term) { 
				$term_id = number_format($term->term_id); 
				if(!$term->parent) {
					$term->childrens = array();
					$tax_temp[$term_id] = $term; 
					
					if(!empty($wp_query->queried_object->term_id)){
						if($term_id == $wp_query->queried_object->term_id){
							$tax_temp[$term_id]->is_current = true;
						}
					}
				}else{ 
				}
			} 
			foreach ($taxonomy as $key => $term) { 
				$term_id = number_format($term->term_id); 
				if(!$term->parent) { 
				}else{ 
					$tax_temp[$term->parent]->childrens[$term_id] = $term; 
					if(!empty($wp_query->queried_object->term_id)){
						if($term_id == $wp_query->queried_object->term_id){
							$tax_temp[$term->parent]->childrens[$term_id]->is_current = true;
							$tax_temp[$term->parent]->is_current = true;
							$tax_temp[$term->parent]->is_collapsed = true;
						}else{

						}
					}
				}
			}
		} 

		if( $options['return'] == 'array' ){
			return $tax_temp;
		}

		if( $options['type'] == 'collapse-tree' ){

			if( $options['collapse'] == 'group' ){
				$options['nav_class'] = ' list-group list-tree list-tree-flush';
			}else{
				$options['nav_class'] = ' list-tree list-tree-flush collapse';
			} 
			
			$options['nav_item_class'] = ' list-tree-item';
			$options['nav_link_class'] = ' list-tree-item-link';

		}  

		if(!$options['rearange_taxonomy']){
			$tax_temp = $taxonomy;
		}

		if(!empty($tax_temp)){ 
			foreach($tax_temp as $term){   
				if(!empty($term->is_current && $options['type'] == 'collapse-tree')){
					$options['nav_class'] .= ' show';
				}

				$nav_start = '<div id="'.$options['nav_id'].'" class="'.$options['nav_class'].'">';
				$nav_end = '</div>'; 
				$nav_item_start = '<div class="'.$options['nav_item_class'].'">';
				$nav_item_end = '</div>'; 
				$nav_link_start = '';
				$nav_link_end = '';

				if( $options['type'] == 'collapse-tree' ){
					$nav_link_start .= '<div class="list-tree-action">';
					$nav_link_end .= '</div>';
				}

				if( $options['type'] == 'list' ){
					$nav_start = '<ul id="'.$options['nav_id'].'" class="'.$options['nav_class'].'">';
					$nav_end = '</ul>'; 
					$nav_item_start = '<li class="'.$options['nav_item_class'].'">';
					$nav_item_end = '</li>';
				} 

	  		$out .= WPBC_get_taxonomy_nav_item($term, array(
	  			'args' => $args,
	  			'type' => $options['type'],
	  			'nav_id' => $options['nav_id'],
	  			'inclue_childrens' => $options['inclue_childrens'],
	  			'count_item_class' => $options['count_item_class'],
	  			'nav_link_class' => $options['nav_link_class'],
	  			'nav_start' => $nav_start,
	  			'nav_end' => $nav_end,
	  			'nav_item_start' => $nav_item_start,
	  			'nav_item_end' => $nav_item_end,
	  			'nav_link_start' => $nav_link_start,
	  			'nav_link_end' => $nav_link_end,
	  			'collapse_caret' => $options['collapse_caret'],
	  		) );
	  	}  
  	}

  	return $nav_start.$out.$nav_end;

	}
}

if( !function_exists('WPBC_get_taxonomy_nav_item') ){
	function WPBC_get_taxonomy_nav_item($term = '', $args = '' ){
		$term_id = number_format($term->term_id);  

		$collapsed_class = 'collapsed';
		$collapsed_aria = 'false';
		if(!empty($term->is_current)){
			$args['nav_link_class'] .= ' current'; 
		}
		if(!empty($term->is_collapsed)){
			$collapsed_class = '';
			$collapsed_aria = 'true';
		}

		$out = '';

		//_print_code($term);

		$out .= $args['nav_item_start']; 
		$out .= $args['nav_link_start']; 
		$out .= '<a href="'.get_term_link($term).'" class="'.$args['nav_link_class'].'">';
		$out .= $term->name;

		if( !empty($args['args']['count']) ){ 

			$count = !empty($term->childrens) ? count($term->childrens) : 0;
			if(!$count){
				$count = !empty($term->category_count) ? $term->category_count : '0';
			}

			$out .= ' <span class="count '.$args['count_item_class'].'">'.$count.'</span>';
		}

		$out .= '</a>';

		if( $args['type'] == 'collapse-tree' && !empty($term->childrens) && !empty($args['inclue_childrens'])){
			$out .= '<button data-parent="#'.$args['nav_id'].'" data-toggle="collapse" data-target="#'.$args['nav_id'].'_sub_'.$term_id.'" type="button" class="list-tree-item-toggle '.$collapsed_class.'" aria-expanded="'.$collapsed_aria.'">'.$args['collapse_caret'].'</button>';
		}

		$out .= $args['nav_link_end'];

		if( !empty($term->childrens) && !empty($args['inclue_childrens']) ){
			$childrens = $term->childrens;
			
			$sub_nav_args = array(
					'taxonomy' => $args['args']['taxonomy'],
					'hide_empty' => $args['args']['hide_empty'],
					'count' => $args['args']['count'],
					'parent' => $term->term_id,
					'options' => array(
						'type' => $args['type'],
						'inclue_childrens' => false,
						'rearange_taxonomy' => false,
						'count_item_class' => $args['count_item_class'],
					)
				);

			if( $args['type'] == 'collapse-tree' && !empty($term->childrens) && !empty($args['inclue_childrens'])){
				$sub_nav_args['options']['type'] = $args['type'];
				$sub_nav_args['options']['nav_id'] = ''.$args['nav_id'].'_sub_'.$term_id.'';
				$sub_nav_args['options']['nav_class'] = 'list-tree collapse';
			}

			$out .= WPBC_get_taxonomy($sub_nav_args);

			foreach ($childrens as $children) { 
				// $out .= $children->term_id;

			} 
		}

		$out .= $args['nav_item_end']; 
		return $out;
	}
}