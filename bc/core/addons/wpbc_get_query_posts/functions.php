<?php 

function WPBC_get_wp_query_POST_ID(){
	$POST_ID = false; 
	global $wp_query;
	if(!empty($wp_query)){
		$queried_object = $wp_query->queried_object;
		$POST_ID = $queried_object->ID; 
	} 
	return $POST_ID;
}

function WPBC_set_query_posts($template_args, $query){
	global $WPBC_get_query_posts;
	$WPBC_get_query_posts[$template_args['target_id']] = array(
		'template_args' => $template_args,
		'query' => $query,
	);
}
function WPBC_get_query_posts($target_id){
	global $WPBC_get_query_posts;
	return $WPBC_get_query_posts[$target_id];
}

function WPBC_get_query_posts_default_target_id(){
	return 'get_query_posts-target';  
}

/* FORM ELEMENTS */

/*

	Almost same as:
	https://developer.wordpress.org/reference/functions/get_term_parents_list/

*/
function WPBC_get_term_parents_list( $term_id, $taxonomy, $args = array() ) {
    $list = '';
    $term = get_term( $term_id, $taxonomy );
 
    if ( is_wp_error( $term ) ) {
        return $term;
    }
 
    if ( ! $term ) {
        return $list;
    }
 
    $term_id = $term->term_id;
 
    $defaults = array(
        'format'    => 'name',
        'separator' => '/',
        'link'      => true,
        'inclusive' => true,
    );
 
    $args = wp_parse_args( $args, $defaults );
 
    foreach ( array( 'link', 'inclusive' ) as $bool ) {
        $args[ $bool ] = wp_validate_boolean( $args[ $bool ] );
    }
 
    $parents = get_ancestors( $term_id, $taxonomy, 'taxonomy' );
 
    if ( $args['inclusive'] ) {
        array_unshift( $parents, $term_id );
    }
 
    foreach ( array_reverse( $parents ) as $term_id ) {
        $parent = get_term( $term_id, $taxonomy );
        $name   = ( 'slug' === $args['format'] ) ? $parent->slug : $parent->name;
 		
 	$sep = ($term_id === $parents[0]) ? '' : $args['separator'];

 	$btn_class = !empty($args['btn_class']) ? $args['btn_class'] : '';

        if ( $args['link'] ) {

        	$term_link = get_term_link( $parent->term_id, $taxonomy );
        	$term_link = apply_filters('wpbc/filter/get_term_parents_list/get_term_link', $term_link, $parent->term_id, $taxonomy );

            $list .= '<a href="' . esc_url( $term_link ) . '" class="'.$btn_class.'">' . $name . '</a>' . $sep;
        } else {
            $list .= '<span data-href="' . esc_url( $term_link ) . '" class="'.$btn_class.'">' . $name . '</span>' . $sep;
        }
    }
 
    return $list;
}

/*
	
	WPBC_dropdown_categories

	Almos same as: https://developer.wordpress.org/reference/functions/wp_dropdown_categories/

*/
class WPBC_dropdown_categories_waker extends Walker_CategoryDropdown{
	
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $pad = str_repeat('&nbsp;', $depth * 3);
 
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters( 'list_cats', $category->name, $category );
 
        if ( isset( $args['value_field'] ) && isset( $category->{$args['value_field']} ) ) {
            $value_field = $args['value_field'];
        } else {
            $value_field = 'term_id';
        }
 
        $output .= "\t<option class=\"level-$depth\" value=\"" . esc_attr( $category->{$value_field} ) . "\"";
 
        // Type-juggling causes false matches, so we force everything to a string.
        if ( (string) $category->{$value_field} === (string) $args['selected'] )
            $output .= ' selected="selected"';
        $output .= '>';

        $show_count_before = '&nbsp;(';
        $show_count_after = ')';
        $show_count = $show_count_before. number_format_i18n( $category->count ) .$show_count_after;
        $new_show_count = 0;

        $term_children = get_term_children($category->term_id, $category->taxonomy);
        if ( !empty( $term_children ) && !is_wp_error( $term_children ) ){
        	// $output .= ' HAS CHILDREN: ';
        	foreach ( $term_children as $child ) {
        		$term = get_term_by( 'id', $child, $category->taxonomy );
        		$new_show_count = $new_show_count + number_format_i18n( $term->count );
        	}
        	$show_count = $show_count_before.$new_show_count.$show_count_after;
        }

        $output .= $pad.$cat_name;
        if ( $args['show_count'] )
            $output .= $show_count;
        $output .= "</option>\n";
    }
}

function WPBC_dropdown_categories( $args = '' ) {
    $defaults = array(
        'show_option_all'   => '',
        'show_option_none'  => '',
        'orderby'           => 'id',
        'order'             => 'ASC',
        'show_count'        => 0,
        'hide_empty'        => 1,
        'child_of'          => 0,
        'exclude'           => '',
        'echo'              => 1,
        'selected'          => 0,
        'hierarchical'      => 0,
        'name'              => 'cat',
        'id'                => '',
        'class'             => 'postform',
        'depth'             => 0,
        'tab_index'         => 0,
        'taxonomy'          => 'category',
        'hide_if_empty'     => false,
        'option_none_value' => -1,
        'value_field'       => 'term_id',
        'required'          => false,

        'data_attr'		=> '',
        'walker'			=> new WPBC_dropdown_categories_waker(),
    );
 
    $defaults['selected'] = ( is_category() ) ? get_query_var( 'cat' ) : 0;
 
    // Back compat.
    if ( isset( $args['type'] ) && 'link' == $args['type'] ) {
        _deprecated_argument( __FUNCTION__, '3.0.0',
            /* translators: 1: "type => link", 2: "taxonomy => link_category" */
            sprintf( __( '%1$s is deprecated. Use %2$s instead.' ),
                '<code>type => link</code>',
                '<code>taxonomy => link_category</code>'
            )
        );
        $args['taxonomy'] = 'link_category';
    }
 
    $r = wp_parse_args( $args, $defaults );
    $option_none_value = $r['option_none_value'];
 
    if ( ! isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
        $r['pad_counts'] = true;
    }
 
    $tab_index = $r['tab_index'];
 
    $tab_index_attribute = '';
    if ( (int) $tab_index > 0 ) {
        $tab_index_attribute = " tabindex=\"$tab_index\"";
    }
 
    // Avoid clashes with the 'name' param of get_terms().
    $get_terms_args = $r;
    unset( $get_terms_args['name'] );
    $categories = get_terms( $r['taxonomy'], $get_terms_args );
 
    $name = esc_attr( $r['name'] );
    $class = esc_attr( $r['class'] );
    $id = $r['id'] ? esc_attr( $r['id'] ) : $name;
    $required = $r['required'] ? 'required' : '';
 	
    $data_attr = $r['data_attr'];

    if ( ! $r['hide_if_empty'] || ! empty( $categories ) ) {
        $output = "<select $required $data_attr name='$name' id='$id' class='$class' $tab_index_attribute>\n";
    } else {
        $output = '';
    }
    if ( empty( $categories ) && ! $r['hide_if_empty'] && ! empty( $r['show_option_none'] ) ) {
 
        /**
         * Filters a taxonomy drop-down display element.
         *
         * A variety of taxonomy drop-down display elements can be modified
         * just prior to display via this filter. Filterable arguments include
         * 'show_option_none', 'show_option_all', and various forms of the
         * term name.
         *
         * @since 1.2.0
         *
         * @see wp_dropdown_categories()
         *
         * @param string       $element  Category name.
         * @param WP_Term|null $category The category object, or null if there's no corresponding category.
         */
        $show_option_none = apply_filters( 'list_cats', $r['show_option_none'], null );
        $output .= "\t<option value='" . esc_attr( $option_none_value ) . "' selected='selected'>$show_option_none</option>\n";
    }
 
    if ( ! empty( $categories ) ) {
 
        if ( $r['show_option_all'] ) {
 
            /** This filter is documented in wp-includes/category-template.php */
            $show_option_all = apply_filters( 'list_cats', $r['show_option_all'], null );
            $selected = ( '0' === strval($r['selected']) ) ? " selected='selected'" : '';
            $output .= "\t<option value='0'$selected>$show_option_all</option>\n";
        }
 
        if ( $r['show_option_none'] ) {
 
            /** This filter is documented in wp-includes/category-template.php */
            $show_option_none = apply_filters( 'list_cats', $r['show_option_none'], null );
            $selected = selected( $option_none_value, $r['selected'], false );
            $output .= "\t<option value='" . esc_attr( $option_none_value ) . "'$selected>$show_option_none</option>\n";
        }
 
        if ( $r['hierarchical'] ) {
            $depth = $r['depth'];  // Walk the full depth.
        } else {
            $depth = -1; // Flat.
        }
        $output .= walk_category_dropdown_tree( $categories, $depth, $r );
    }
 
    if ( ! $r['hide_if_empty'] || ! empty( $categories ) ) {
        $output .= "</select>\n";
    }
    /**
     * Filters the taxonomy drop-down output.
     *
     * @since 2.1.0
     *
     * @param string $output HTML output.
     * @param array  $r      Arguments used to build the drop-down.
     */
    $output = apply_filters( 'wp_dropdown_cats', $output, $r );
 
    if ( $r['echo'] ) {
        echo $output;
    }
    return $output;
}


function WPBC_get_query_posts_params($param){
	
	$test = explode(",", $param); // %2C = ,

	if( is_array($test) && count($test) > 1 ){
		$return = $test;
	} else {

		$test = explode("+", $param); // %2B = +
		if( is_array($test) && count($test) > 1 ){
			$return = $test;
		}else{
			$return = $param;
		} 
		
	}

	return $return; 
}
function WPBC_get_query_posts_checked($current, $slug){
	
	$checked = '';  
	$current = WPBC_get_query_posts_params($current); 
	 
	if( !empty($current) ){
		if( is_array($current) ){
			foreach ($current as $key) {
				if($key == $slug){
					$checked = ' checked="checked" ';
				}
			}
		}else{
			if($current == $slug){
				$checked = ' checked="checked" ';
			}
		}

	}
	return $checked; 
}

function WPBC_get_query_posts_input_label($form_args, $target, $type){
	$out = '';
	ob_start();
	if( !empty($form_args['label']) || !empty($form_args['show_actions_all']) || !empty($form_args['show_actions_reset']) ){
	?>
		<label class="d-block">
			<?php echo !empty($form_args['label']) ? $form_args['label'] : ''; ?>
			<?php if( !empty($form_args['show_actions_all']) || !empty($form_args['show_actions_reset']) ){ ?>
			<small>
				<?php if( !empty($form_args['show_actions_all']) ){ ?>
				<a href="#" data-select-all="<?php echo $target; ?>" data-type="<?php echo $type; ?>">All</a>
				<?php } ?>
				<a href="#" data-select-reset="<?php echo $target; ?>" data-type="<?php echo $type; ?>">Reset</a>
			</small>
			<?php } ?>
		</label>
	<?php 
	}
	$out .= ob_get_contents();
	ob_end_clean(); 
	return $out;
}

function WPBC_get_query_posts_input($form_args, $type='text'){

	$out = '';
	ob_start();

	echo WPBC_get_query_posts_input_label($form_args, '#'.$form_args['form_id'], $type); 

	?>
<input type="text" class="<?php echo !empty($form_args['class']) ? $form_args['class'] : 'form-control';?>" id="<?php echo $form_args['form_id']; ?>" name="<?php echo $form_args['form_id']; ?>" value="<?php echo !empty($form_args['current']) ? $form_args['current'] : '';?>" <?php echo !empty($form_args['current']) ? 'data-current="'. $form_args['current'] .'"' : '';?> placeholder="<?php echo !empty($form_args['placeholder']) ? $form_args['placeholder'] : '';?>">
	<?php
	$out .= ob_get_contents();
	ob_end_clean(); 
	return $out;
}

function WPBC_get_query_posts_check($args, $type='radio'){

	if($type=='radio'){
		$field_name = $args['form_id'];
	}else{
		$field_name = $args['form_id'].'[]';
	}

	$out = '';
	ob_start(); 

	$target = '.form-check-'.$args['form_id'];
	echo WPBC_get_query_posts_input_label($args, $target, $type);

	if( !empty($args['get_terms']) ){
		$get_terms = get_terms($args['get_terms']);
	}
	if( !empty($args['items']) ){
		$items = $args['items'];
	}

	if(!empty($get_terms)){ 
		foreach($get_terms as $k=>$v){ 
			$_count_before = ' <small>(';
			$_count_after = ')</small>';
			$_count = !empty($args['show_count']) ? $_count_before.$v->count.$_count_after : ''; 
			$label = $v->name.$_count; 
			$checked = WPBC_get_query_posts_checked($args['current'], $v->slug);
			?>
			<div class="form-check form-check-inline">
			  <input class="form-check-input form-check-<?php echo $args['form_id']; ?> <?php echo !empty($checked) ? 'data-current' : ''; ?>" name="<?php echo $field_name; ?>" type="<?php echo $type; ?>" id="<?php echo $v->slug; ?>" value="<?php echo $v->slug; ?>" <?php echo $checked; ?> <?php echo !empty($checked) ? 'data-current' : ''; ?>>
			  <label class="form-check-label" for="<?php echo $v->slug; ?>"><?php echo $label; ?></label>
			</div>
			<?php  
		}  
	}

	if(!empty($items)){  
		foreach($items as $k=>$v){  
			$checked = WPBC_get_query_posts_checked($args['current'], $k); 
			?>
			<div class="form-check form-check-inline">
			  <input <?php echo !empty($checked)?' data-default="1" ':'';?> class="form-check-input form-check-<?php echo $args['form_id']; ?> <?php echo !empty($checked) ? 'data-current' : ''; ?>" name="<?php echo $field_name; ?>" type="<?php echo $type; ?>" id="<?php echo $k; ?>" value="<?php echo $k; ?>" <?php echo $checked; ?> <?php echo !empty($checked) ? 'data-current' : ''; ?>>
			  <label class="form-check-label" for="<?php echo $k; ?>"><?php echo $v; ?></label>
			</div>
			<?php  
		}  
	}

	$out .= ob_get_contents();
	ob_end_clean(); 
	return $out;
}  

function WPBC_get_query_posts_select($args){

	$select_args = $args['select_args'];
	// print_r($select_args);
	echo WPBC_get_query_posts_input_label($args, '#'.$args['form_id'], 'select');
	WPBC_dropdown_categories( $select_args );

}

function WPBC_get_query_posts_dropdown($args){
	
	$out = '';

	if( !empty($args) ){

		$items = !empty($args['items']) ? $args['items'] : '';
		$get_terms = !empty($args['get_terms']) ? $args['get_terms'] : '';
		if(!empty($get_terms)){
			$get_terms = get_terms($get_terms);
		}
 
		$form_target = $args['form_id'];
		ob_start(); 

		echo WPBC_get_query_posts_input_label($args, '#'.$form_target, 'dropdown'); 
		?>
		<div class="dropdown dropdown-select" data-input-target="#<?php echo $form_target; ?>">
		<?php

		$label = !empty($args['label']) ? $args['label'] : __('Select','bootclean');
		$btn_class = !empty($args['btn_class']) ? $args['btn_class'] : 'btn-light';
		$btn_class_current = !empty($args['btn_class_current']) ? $args['btn_class_current'] : 'btn-primary';

		$id = '';
		$val = '';

		if( !empty($args['label_all'])){
			$label = $args['label_all'];
		}
		if( !empty($args['current'])){
			$id = $args['current'];
			$val = $args['current'];
			$label = !empty($items[$args['current']]) ? $items[$args['current']] : '';
			if(!empty($get_terms)){
				foreach ($get_terms as $key => $value) {
					if( $value->slug == $args['current'] ){
						$id = $value->term_id;
						$val = $value->slug;
						$label = $value->name; 

						$_count_before = ' <small>(';
						$_count_after = ')</small>';
						$_count = !empty($args['show_count']) ? $_count_before.$value->count.$_count_after : ''; 
						$label = $value->name.$_count;
					}
				}
				
			}
		}
			
		
		$class = '';

		?>
		<button class="btn btn-block dropdown-toggle <?php echo $btn_class; ?>" type="button" id="dropdown-<?php echo $form_target; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="dropdown-select-value" data-tax-id="<?php echo $id; ?>" data-value="<?php echo $val; ?>"><?php echo $label; ?></span> <i class="caret icon-arrow-down"></i>
		</button>
		<div class="dropdown-menu" aria-labelledby="dropdown-<?php echo $form_target; ?>">
		<?php
 
		if( !empty($args['label_all'])){

		?>
			<a class="dropdown-item <?php echo $class; ?>" href="#" data-tax-id="" data-all data-value=""><?php echo $args['label_all']; ?></a>
		<?php 

		}
 
		if(!empty($items)){
			foreach ($items as $key => $value) {  
				if( !empty($args['current']) && $key == $args['current'] ) {
					$data_current = 'data-current';
					$class = 'active';
					$data_all = '';
				} else{
					$data_current = '';
					$class = '';
					$data_all = '';
				} 
				?>
				<a class="dropdown-item <?php echo $class; ?>" href="#" data-tax-id="<?php echo $key; ?>" data-value="<?php echo $key; ?>" <?php echo $data_all; ?> <?php echo $data_current; ?>><?php echo $value; ?></a>
				<?php 
			}
		}
		
		if(!empty($get_terms)){
			
			foreach ($get_terms as $key => $value) { 

				$_count_before = ' <small>(';
				$_count_after = ')</small>';
				$_count = !empty($args['show_count']) ? $_count_before.$value->count.$_count_after : ''; 
				$label = $value->name.$_count;

				if( !empty($args['current']) && $value->slug == $args['current'] ) {
					$data_current = 'data-current';
					$class = 'active';
					$data_all = '';
				} else{
					$data_current = '';
					$class = '';
					$data_all = '';
				}
				if(empty($value->parent)){
				?>
				<a class="dropdown-item <?php echo $class; ?>" href="#" data-tax-id="<?php echo $value->term_id; ?>" data-value="<?php echo $value->slug; ?>" <?php echo $data_all; ?> <?php echo $data_current; ?>><?php echo $label; ?></a>
				<?php 
				}
			}
		}
		?>
		</div>
		</div>
		<?php
		$out .= ob_get_contents();
		ob_end_clean();

	}

	return $out;

}

function WPBC_get_query_posts_price_ranger($args){ 

	$args = wp_parse_args( $args, array() ); 

	// $shortcode_atts = $args['shortcode_atts'];
	// print_r($args);
	$prefix = $args['prefix']; 
	$min = $args['min'];
	$max = $args['max']; 
	$step = $args['step'];

	$start_from = !empty($args['start_from']) ? $args['start_from'] : $min;
	$start_to = !empty($args['start_to']) ? $args['start_to'] : $max;  
	
	$input_min = $args['input_min'];
	$input_max = $args['input_max'];

	$form_target = $args['input_min'].'_'.$args['input_max'];

	ob_start();
	$out = '';
	?>
	<?php if(!empty($args['label'])){ ?>
		<label class="d-block">
			<?php echo $args['label']; ?>
			<?php if(!empty($args['show_actions'])){ ?>
			<small>
				<a href="#" data-range-clear="#<?php echo $form_target; ?>">Clear</a>
			</small>
			<?php } ?>	
		</label>
	<?php } ?>
	<div class="form-slider-range" id="<?php echo $form_target; ?>" data-input-min="#<?php echo $input_min; ?>" data-input-max="#<?php echo $input_max; ?>" data-money-format='{ "decimals": 0, "thousand": ".", "prefix": "<?php echo $prefix; ?>" }' data-range-args='{ "start": [<?php echo $start_from; ?>, <?php echo $start_to; ?>], "step": <?php echo $step; ?>, "range": { "min":[<?php echo $min; ?>], "max":[<?php echo $max; ?>] }, "rangeLabels": { "min": "", "max": " - " }  }'> 
		<div class="slider-range"></div> 
	</div>
	<?php
	$out .= ob_get_contents();
	ob_end_clean();   
	return $out; 
}