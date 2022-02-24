<?php WPBC_flex_layout_start(); ?>

<?php  
	$ui_layout_args = WPBC_get_ui_layout_posts_advanced_args();  

	$taxonomy_query = $ui_layout_args['query'];
	//_print_code($taxonomy_query);

	$taxonomy_name = $taxonomy_query['taxonomy_name']; 
		$taxonomy_args = array(
			'taxonomy' => $taxonomy_name, 
			'hide_empty' => false, 
		); 

		if( $taxonomy_query['posts_per_page_type'] != 'select' && $taxonomy_query['orderby'] != 'random'){
			$taxonomy_args['orderby'] = $taxonomy_query['orderby'];
		}

		if( $taxonomy_query['posts_per_page_type'] == 'custom' ){
			$taxonomy_args['number'] = $taxonomy_query['posts_per_page'];
		}

		if( $taxonomy_query['posts_per_page_type'] == 'select' ){
			$selected = $taxonomy_query[$taxonomy_name.'__include'];
			$include = array();
			foreach ($selected as $key => $value) {
				$include[] = $value[$taxonomy_name.'__term'];
			}
			$taxonomy_args['include'] = $include;
		}

?>

<div id="<?php echo $ui_layout_args['row_id']; ?>" class="ui_layout_posts_advanced-container <?php echo $ui_layout_args['style_args']['container_class'];?>" <?php echo $ui_layout_args['style_args']['container_args'];?>>

	<div <?php echo $ui_layout_args['style_args']['row_args'];?> class="ui_layout_posts_advanced-row <?php echo $ui_layout_args['style_args']['row_class'];?> row-half-gutters" data-delay-items >

		<?php 
		if($ui_layout_args['style'] == 'masonry'){  
			?>
			<div class="wpbc-masonry-sizer <?php echo $ui_layout_args['style_args']['item_class']; ?>"></div>
			<?php
		}   
		
		$taxonomy = get_categories($taxonomy_args);
		if(!empty($taxonomy)){   

			if($taxonomy_query['orderby'] == 'random'){
				$arr_taxonomy = (array)$taxonomy; 
				shuffle($arr_taxonomy);
				$taxonomy = (object) $arr_taxonomy;
			} 
			
			foreach($taxonomy as $term){
				$term_id = number_format($term->term_id);  
	    	$template = !empty($ui_layout_args['style_args']['item_template']) ? $ui_layout_args['style_args']['item_template'] : 'default'; 
				$temp_folder = WPBC_get_template_part_content_path().'/taxonomy'; 
				echo "<!-- ".$temp_folder.'/'.$template." -->";
				WPBC_get_template_part( $temp_folder.'/'.$template, array(
					'ID' => $term_id,
					'term' => $term,
					'style_args' => $ui_layout_args['style_args'],
				));
 			}
  	}
 
		?>
	</div>

</div>
<?php WPBC_flex_layout_end(); ?>