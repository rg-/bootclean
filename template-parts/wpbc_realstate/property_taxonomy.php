<?php 

/*

	Usefull:

	- $term_link = apply_filters('wpbc/filter/property/get_term_link', $term_link, $term_id, $taxonomy );

	When using parents:

	- $term_link = apply_filters('wpbc/filter/get_term_parents_list/get_term_link', $term_link, $parent->term_id, $taxonomy );

*/

$args = wp_parse_args( $args, array() ); 

$property_id = !empty($property->ID) ? $property->ID : get_the_ID();
$terms = get_the_terms( $property_id, $taxonomy ); 
$taxonomy_args = WPBC_property_template_taxonomy_args(false, $property_id, $taxonomy);

$row_items = $taxonomy_args['row_items'];

if(!empty($args['use_small'])){
	$taxonomy_args['class'] = '';
	$taxonomy_args['row_class'] = '';
	$taxonomy_args['btn_class'] = ''; 
}

if(!empty($terms) && !is_wp_error( $terms )){

?>
<div class="property_taxonomy <?php echo $taxonomy_args['class']; ?>">

	<?php if(!$row_items){?><div class="<?php echo $taxonomy_args['row_class']; ?>"><?php } ?>
<?php
	foreach ( $terms as $term ) { 
		
		$sep = ($term === end($terms)) ? '' : $taxonomy_args['sep']; 

		if($row_items){
			?><div class="<?php echo $taxonomy_args['row_class']; ?>"><?php
		}

		/* TODO, how to pass include_parents

		This: $taxonomy_args['include_parents'] do not EXIST!

		*/ 
		$include_parents = !empty($args['include_parents']) ? $args['include_parents'] : false; 
		$include_current = isset($args['include_current']) ? $args['include_current'] : true;
		$last_current = isset($args['last_current']) ? $args['last_current'] : false; 
		$term_parent = $term->parent;
		if( $term_parent && $include_parents ){
			$term_parent = get_term_by('id',$term_parent,$taxonomy); 
			echo WPBC_get_term_parents_list($term->term_id, $taxonomy, array(
				'separator' => $taxonomy_args['sep'],
				'btn_class' => $taxonomy_args['btn_class'],
				'link'      => $taxonomy_args['use_links'],
        			'inclusive' => $include_current,
			));
			if($last_current){
				$taxonomy_args['btn_class'] = $taxonomy_args['btn_current_class'];
				WPBC_property_template_term_item($term, array(
					'taxonomy_args' => $taxonomy_args,
					'taxonomy' => $taxonomy
				));
			}
		} else {

			WPBC_property_template_term_item($term, array(
				'taxonomy_args' => $taxonomy_args,
				'taxonomy' => $taxonomy
			));

			echo $sep;

		} 

		if($row_items){
			?></div><?php
		}

	} // end foreach
?>
<?php if(!$row_items){?></div><?php } ?>
</div>
<?php
}