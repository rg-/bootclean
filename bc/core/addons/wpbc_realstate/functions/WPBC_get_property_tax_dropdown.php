<?php

function WPBC_get_property_form_control_FX($atts, $content = null){

	$out = '';
	extract(shortcode_atts(array(
		'type' => false, 
	), $atts));  



};
add_shortcode('WPBC_get_property_form_control', 'WPBC_get_property_form_control_FX');

function WPBC_get_property_tax_dropdown( $args ){
	
	$out = ''; 
	if( !empty($args['get_terms']) ){

		$get_terms_args = $args['get_terms'];
		$taxonomy = $get_terms_args['taxonomy'];

		$form_target = !empty($args['form_id']) ? $args['form_id'] : $taxonomy;
 		
 		// No get_terms args
		$get_first = !empty($args['get_first']) ? $args['get_first'] : false;
		$label = !empty($args['label']) ? $args['label'] : __('Select','bootclean');
		$btn_class = !empty($args['btn_class']) ? $args['btn_class'] : 'btn-white';
		$btn_class_current = !empty($args['btn_class_current']) ? $args['btn_class_current'] : 'btn-primary';

		$property_terms = get_terms($args['get_terms']); 

		if(!empty($property_terms)){ 
			$first_term = $property_terms[0];
			$first_term_ID = $first_term->term_id; 

	ob_start(); 
	?>

<div class="dropdown dropdown-select" data-input-target="#<?php echo $form_target; ?>">
	<?php

	if( empty($args['get_first']) ){
		$value = '';
		$tax_id = '';
		$if_current = '';
		$this_label = $label;
		if( !empty($args['current']) ){
			foreach($property_terms as $k=>$v){
				if( $v->slug == $args['current'] ){
					$this_label = $v->name;
				}
			} 
			$if_current = '<a class="dropdown-item" href="#" data-value="">'.$label.'</a>';
			$btn_class = $btn_class_current;
		}
		?>

		<button class="btn btn-block dropdown-toggle <?php echo $btn_class; ?>" type="button" id="dropdown-<?php echo $taxonomy; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="dropdown-select-value" data-tax-id="<?php echo $tax_id; ?>" data-value="<?php echo $value; ?>"><?php echo $this_label; ?></span> <i class="caret icon-arrow-down"></i>
		</button>

		<div class="dropdown-menu" aria-labelledby="dropdown-<?php echo $taxonomy; ?>">
			<?php echo $if_current; ?>
			<?php if(!$if_current) { ?>
				<a class="dropdown-item active" href="#" data-tax-id="<?php echo $tax_id; ?>" data-value="<?php echo $value; ?>"data-tax-id="<?php echo $tax_id; ?>" data-value="<?php echo $value; ?>"><?php echo $this_label; ?></a>
			<?php } ?>
		<?php
	}

	foreach($property_terms as $k=>$v){
		if( $v->term_id == $first_term_ID && !empty($args['get_first'])){
			?>

			<button class="btn btn-block btn-white dropdown-toggle" type="button" id="dropdown-<?php echo $taxonomy; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

				<span class="dropdown-select-value" data-tax-id="<?php echo $first_term_ID; ?>" data-value="<?php echo $v->slug; ?>"><?php echo $v->name; ?></span> <i class="caret icon-arrow-down"></i>

			</button>

			<div class="dropdown-menu" aria-labelledby="dropdown-<?php echo $taxonomy; ?>">

				<a class="dropdown-item" href="#" data-value=""><?php echo $label; ?></a>

				<a class="dropdown-item active" href="#" data-tax-id="<?php echo $first_term->term_id; ?>" data-value="<?php echo $first_term->slug; ?>"><?php echo $first_term->name; ?></a>

			<?php
		}else{
			$_count_before = ' <small>(';
			$_count_after = ')</small>';
			$_count = !empty($args['show_count']) ? $_count_before.$v->count.$_count_after : '';

			$label = $v->name.$_count;
			?>

			<a class="dropdown-item" href="#" data-tax-id="<?php echo $v->term_id; ?>" data-value="<?php echo $v->slug; ?>"><?php echo $label; ?></a>

			<?php

		}
	}

	?>


	</div>
</div>

	<?php
	$out .= ob_get_contents();
	ob_end_clean(); 


		} // if(!empty($property_terms)){ END 
	} // if !empty($args['get_terms']  END 

	return $out; 
}