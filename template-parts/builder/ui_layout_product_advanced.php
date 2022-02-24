<?php if( class_exists( 'WooCommerce' ) ){ ?>

<?php WPBC_flex_layout_start(); ?>

<?php  
	
	$ui_layout_args = WPBC_get_ui_layout_posts_advanced_args(); 
	
	$query_loop = new WP_Query( $ui_layout_args['query'] );  

?>

<div id="<?php echo $ui_layout_args['row_id']; ?>" class="ui_layout_posts_advanced-container <?php echo $ui_layout_args['style_args']['container_class'];?>">

	<div <?php echo $ui_layout_args['style_args']['row_args'];?> class="ui_layout_posts_advanced-row <?php echo $ui_layout_args['style_args']['row_class'];?>">

		<?php 
		if($ui_layout_args['style'] == 'masonry'){  
			?>
			<div class="wpbc-masonry-sizer <?php echo $ui_layout_args['style_args']['item_class']; ?>"></div>
			<?php
		}  

		if ( $query_loop->have_posts() ) { 

			while ( $query_loop->have_posts() ) {
				$query_loop->the_post();   
				$template = !empty($ui_layout_args['style_args']['item_template']) ? $ui_layout_args['style_args']['item_template'] : 'product'; 
				$temp_folder = WPBC_get_template_part_content_path(); 
				echo "<!-- ".$temp_folder.'/'.$template." -->"; 
				if($ui_layout_args['style'] == 'slick'){
					echo '<div class="item">';
				}
				WPBC_get_template_part( $temp_folder.'/'.$template, array(
					'ID' => get_the_ID(),
					'style_args' => $ui_layout_args['style_args'],
				));
				if($ui_layout_args['style'] == 'slick'){
					echo '</div>';
				}
			}
			wp_reset_postdata();
		}
		?>
	</div>

	<?php 

	$ui_pagination = $ui_layout_args['pagination']; 
	if(!empty($ui_pagination['pagination_type'])){
	?>
	<div class="ui_layout_posts_advanced-pagination" <?php !empty($ui_pagination['pagination_div_data']) ? $ui_pagination['pagination_div_data'] : '' ?>>
		<?php  
			$pagination_args = array(  
					'wp_query' => $query_loop,
					'paged' => $ui_layout_args['paged'],
					'max_page' => $query_loop->max_num_pages, 
				);
			$pagination_args = apply_filters('wpbc/filter/ui_layout_posts_advanced/pagination_args', $pagination_args);
			WPBC_advanced_posts_pagination($pagination_args);
		?>
	</div>
	<?php } ?>

</div>
<?php WPBC_flex_layout_end(); ?>

<?php } ?>