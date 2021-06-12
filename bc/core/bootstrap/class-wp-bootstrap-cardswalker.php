<?php
/**
 * WP_Bootstrap_Cardswalker class
 *
 * @package Bootclean/Classes/Walkers
 * @version 12.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Bootstrap_Cardswalker', false ) ) {
	return;
}

/**
 * Product cat list walker class.
 */
class WP_Bootstrap_Cardswalker extends Walker {

	/**
	 * What the class handles.
	 *
	 * @var string
	 */
	public $tree_type = 'category';

	/**
	 * DB fields to use.
	 *
	 * @var array
	 */
	public $db_fields = array(
		'parent' => 'parent',
		'id'     => 'term_id',
		'slug'   => 'slug',
	);

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of category. Used for tab indentation.
	 * @param array  $args Will only append content if style argument value is 'list'.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' !== $args['style'] ) {
			return;
		}

		$indent  = str_repeat( "\t", $depth );
		// $output .= "$indent<div id='list-tree_". $args['taxonomy'] ."_".$depth."' class=' list-tree list-tree-flush collapse children'>\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of category. Used for tab indentation.
	 * @param array  $args Will only append content if style argument value is 'list'.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' !== $args['style'] ) {
			return;
		}

		$indent  = str_repeat( "\t", $depth );
		// $output .= "$indent</div>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string  $output            Passed by reference. Used to append additional content.
	 * @param object  $cat               Category.
	 * @param int     $depth             Depth of category in reference to parents.
	 * @param array   $args              Arguments.
	 * @param integer $current_object_id Current object ID.
	 */
	public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$cat_id = intval( $cat->term_id );

		global $wp_query;

		$collapse_caret = !empty($args['options']['collapse_caret']) ? $args['options']['collapse_caret'] : '+';

		$include_children = false; 
		$item_class = '';
		$item_link_class = '';
		if ( $args['has_children'] && $args['hierarchical'] && ( empty( $args['max_depth'] ) || $args['max_depth'] > $depth + 1 ) ) { 
			$include_children = true; 
			
		}

		if($depth == 0){
			$item_class = 'card';
		}

		$parent_id = 'card-tree_'. $args['taxonomy'] .'_'.$depth.'_'.$cat_id.'';
		$target_id = 'card-tree_'. $args['taxonomy'] .'_'.$depth.'_'.$cat_id.'_collapse';

		$output .= '<div id="'.$parent_id.'" class="'.$item_class.' nav-item cat-item cat-item-' . $cat_id;

		if ( $args['current_category'] === $cat_id ) {
			$output .= ' current-cat'; 
			$item_link_class = 'current';
		}

		if ( $include_children ) {
			$output .= ' cat-parent parent-id-'.$cat->parent;
		}

		if ( $args['current_category_ancestors'] && $args['current_category'] && in_array( $cat_id, $args['current_category_ancestors'], true ) ) {
			$output .= ' current-cat-parent'; 
			$item_link_class = 'current';
		} 

		$output .= '"><a href="' . get_term_link( $cat_id, $args['taxonomy'] ) . '" class="nav-link '.$item_link_class.'">' . apply_filters( 'list_product_cats', $cat->name, $cat ) . '</a>';

		if ( $include_children ) {
			 
		}

		if ( $args['show_count'] ) {
			$output .= ' <span class="count">(' . $cat->count . ')</span>';
		}
		$output .= '';
		if( $include_children ){
			$output .= '<div id="'.$target_id.'" class="nav flex-column children '.$collapse_class.'">';
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $cat    Category.
	 * @param int    $depth  Depth of category. Not used.
	 * @param array  $args   Only uses 'list' for whether should append to output.
	 */
	public function end_el( &$output, $cat, $depth = 0, $args = array() ) {
		$include_children = false;
		if ( $args['has_children'] && $args['hierarchical'] && ( empty( $args['max_depth'] ) || $args['max_depth'] > $depth + 1 ) ) { 
			$include_children = true; 
		}

		$output .= "</div>\n";
		if( $include_children ){
			$output .= "</div>\n";
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max.
	 * depth and no ignore elements under that depth. It is possible to set the.
	 * max depth to include all depths, see walk() method.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @since 2.5.0
	 *
	 * @param object $element           Data object.
	 * @param array  $children_elements List of elements to continue traversing.
	 * @param int    $max_depth         Max depth to traverse.
	 * @param int    $depth             Depth of current element.
	 * @param array  $args              Arguments.
	 * @param string $output            Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		if ( ! $element || ( 0 === $element->count && ! empty( $args[0]['hide_empty'] ) ) ) {
			return;
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}
