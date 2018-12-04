<?php

function wpbc_get_query_form_start($query, $shortcode_args, $template_args, $query_fields, $form_elements){
	
	$ajax_action_url = admin_url('admin-ajax.php') . '/?action=' . $shortcode_args['action'];

	$POST_ID = WPBC_get_wp_query_POST_ID();

	$POST_PERMALINK = '';
	
	if(!empty($POST_ID)){ 
		$POST_PERMALINK = get_permalink($POST_ID);
	} 
	
	$target_post_id = !empty($shortcode_args['target_post_id']) ? $shortcode_args['target_post_id'] : false;

	$form_id = !empty($shortcode_args['form_id']) ? $shortcode_args['form_id'] : '';
	$form_class = !empty($shortcode_args['form_class']) ? $shortcode_args['form_class'] : '';

	$form_class .= ' '.$form_id;

	if(!$target_post_id){ 
?>
<form id="<?php echo $template_args['target_id']; ?>-form" method='post' action="<?php echo admin_url('admin-ajax.php'); ?>" data-action-url="<?php echo $POST_PERMALINK; ?>" class="wpbc_get_query_form no-bc-caret <?php echo $form_class; ?>" data-ajax-form="get_query_form">
<?php
	}else{
?>
<form id="<?php echo $template_args['target_id']; ?>-form" method='get' action="<?php echo get_permalink($target_post_id); ?>" class="wpbc_get_query_form no-bc-caret <?php echo $form_class; ?>">
<?php
	}

}

function wpbc_get_query_form_fields($query, $shortcode_args, $template_args, $query_fields, $form_elements){
	$query_fields_type = !empty($query['debug']) ? 'text' : 'hidden';  
	foreach($query_fields as $k=>$v){
		?><input type="<?php echo $query_fields_type; ?>" class="" id="<?php echo $v['name'];?>" name="<?php echo $v['name'];?>" value="<?php echo !empty($query[$v['name']] ) ? $query[$v['name']] : $v['value'];?>"><?php
	}
}

function wpbc_get_query_form_wrap_args($query, $shortcode_args, $template_args, $query_fields){


	$form_wrap_args = array(
		'before_form' => '',
		'after_form' => '',

		'form_buttons_args' => array(

			'col_class' => '',
			'group_class' => 'form-group position-relative',

			'use_reset' => true,
			'use_reload' => true,

		),
	);

	$form_wrap_args = apply_filters('wpbc/filter/get_query_form/form_wrap_args', $form_wrap_args, $query, $shortcode_args, $template_args, $query_fields);

	return $form_wrap_args; 

}

function wpbc_get_query_form_controls($query, $shortcode_args, $template_args, $query_fields, $form_elements){
	
	$query_fields_type = !empty($query['debug']) ? 'text' : 'hidden';  

	$form_col_class = '';
	$form_group_class = 'form-group position-relative';

	$form_id = !empty($shortcode_args['form_id']) ? $shortcode_args['form_id'] : ''; 

	foreach($form_elements as $k=>$v){ 

		$form_args = $v['form_args'];
		$wrap = !empty($v['wrap']) ? $v['wrap'] : '';
		
		echo !empty($wrap['before']) ? $wrap['before'] : '';
		echo '<div class="'. (!empty($wrap['form_group_class']) ? $wrap['form_group_class'] : $form_group_class) .'">';

		if($v['type'] == 'html'){ 
			if(!empty($v['content'])){
				echo $v['content'];
			}
			if(!empty($v['template_part'])){ 
				$template_args = !empty($v['template_args']) ? $v['template_args'] : '';
				WPBC_get_template_part($v['template_part'], $template_args);
			}
		}
		if($v['type'] == 'text'){ 
			echo WPBC_get_query_posts_input($form_args, 'text');
		}

		if($v['type'] == 'dropdown'){
			// This version is using a hidden input for the data, this is not a <select> element 
			$default = !empty($form_args['current']) ? $form_args['current'] : ''; 
			?>
			<input type="<?php echo $query_fields_type; ?>" class="" id="<?php echo $form_args['form_id']; ?>" name="<?php echo $form_args['form_id']; ?>" value="<?php echo !empty($query[$form_args['form_id']]) ? $query[$form_args['form_id']] : $default;?>"> 
			<?php
			echo WPBC_get_query_posts_dropdown($form_args);
		}
		if($v['type'] == 'select'){ 
			echo WPBC_get_query_posts_select($form_args);
		}
		if($v['type'] == 'checkbox'){ 
			echo WPBC_get_query_posts_check($form_args, 'checkbox');
		}
		if($v['type'] == 'radio'){
			echo WPBC_get_query_posts_check($form_args, 'radio');
		}

		if($v['type'] == 'price_ranger'){
			$range_args = $form_args['range_args']; 
			$input_min = $range_args['input_min'];
			$input_max = $range_args['input_max'];
			?>
			<input type="<?php echo $query_fields_type; ?>" class="" id="<?php echo $input_min; ?>" name="<?php echo $input_min; ?>" value="<?php echo !empty($query[$input_min]) ? $query[$input_min] : '';?>">
			<input type="<?php echo $query_fields_type; ?>" class="" id="<?php echo $input_max; ?>" name="<?php echo $input_max; ?>" value="<?php echo !empty($query[$input_max]) ? $query[$input_max] : '';?>">
			<?php 
			echo WPBC_get_query_posts_price_ranger( $range_args );
		}
		echo '</div>'; 
		echo !empty($wrap['after']) ? $wrap['after'] : '';
	}

	echo $after_form;
}

function wpbc_get_query_form_buttons($query, $shortcode_args, $template_args, $query_fields, $form_elements){ 

	$form_wrap_args = wpbc_get_query_form_wrap_args($query, $shortcode_args, $template_args, $query_fields);

	$form_col_class = $form_wrap_args['form_buttons_args']['col_class'];
	$form_group_class = $form_wrap_args['form_buttons_args']['group_class'];

	$use_reset = $form_wrap_args['form_buttons_args']['use_reset'];
	$use_reload = $form_wrap_args['form_buttons_args']['use_reload'];

	$use_reset = !empty($shortcode_args['use_reload']) ? $shortcode_args['use_reload'] : $use_reload;
	$use_reload = !empty($shortcode_args['use_reload']) ? $shortcode_args['use_reload'] : $use_reload;

	echo '<div class="'.$form_col_class.'">';
	echo '<div class="'.$form_group_class.'">';

	$ajax_action_url = admin_url('admin-ajax.php') . '/?action=' . $shortcode_args['action']; 

	$target_post_id = !empty($shortcode_args['target_post_id']) ? $shortcode_args['target_post_id'] : false;

	if(empty($target_post_id)){
?><button data-ajax-load="#<?php echo $template_args['target_id']; ?>" data-ajax-nav="#<?php echo $template_args['target_nav_id']; ?>" data-ajax-form-btn="search" data-ajax-target-form="#<?php echo $template_args['target_id']; ?>-form" class="btn btn-primary"><?php _e('Search Ajax','bootclean');?></button><?php
	}else{
?><button type="submit" class="btn btn-primary"><?php _e('Search','bootclean');?></button><?php
	}
	?>
<?php if(!empty($use_reset)){ ?><button data-ajax-load="#<?php echo $template_args['target_id']; ?>" data-ajax-call="<?php echo $ajax_action_url; ?>" data-ajax-nav="#<?php echo $template_args['target_nav_id']; ?>" data-ajax-form-btn="reset" data-ajax-target-form="#<?php echo $template_args['target_id']; ?>-form" class="btn btn-default"><?php _e('Reset','bootclean');?></button><?php } ?><?php if(!empty($use_reload)){ ?><button data-ajax-load="#<?php echo $template_args['target_id']; ?>" data-ajax-call="<?php echo $ajax_action_url; ?>" data-ajax-nav="#<?php echo $template_args['target_nav_id']; ?>" data-ajax-form-btn="reset-all" data-ajax-target-form="#<?php echo $template_args['target_id']; ?>-form" class="btn btn-default"><?php _e('Reload','bootclean');?></button><?php } ?>
	<?php
	echo '</div>';
	echo '</div>';
}

function wpbc_get_query_form_end($query, $shortcode_args, $template_args, $query_fields, $form_elements){
	echo '</form>';
}

add_action( 'wpbc_get_query_form', 'wpbc_get_query_form_start', 10, 5 );
add_action( 'wpbc_get_query_form', 'wpbc_get_query_form_fields', 20, 5 );
add_action( 'wpbc_get_query_form', 'wpbc_get_query_form_controls_start', 29, 5 );
add_action( 'wpbc_get_query_form', 'wpbc_get_query_form_controls', 30, 5 );
add_action( 'wpbc_get_query_form', 'wpbc_get_query_form_buttons', 40, 5 );
add_action( 'wpbc_get_query_form', 'wpbc_get_query_form_controls_end', 41, 5 );
add_action( 'wpbc_get_query_form', 'wpbc_get_query_form_end', 99, 5 );


function wpbc_get_query_form_controls_start($query, $shortcode_args, $template_args, $query_fields, $form_elements){
	$form_wrap_args = wpbc_get_query_form_wrap_args($query, $shortcode_args, $template_args, $query_fields);
	$before_form = $form_wrap_args['before_form'];
	echo $before_form;
}
function wpbc_get_query_form_controls_end($query, $shortcode_args, $template_args, $query_fields, $form_elements){
	$form_wrap_args = wpbc_get_query_form_wrap_args($query, $shortcode_args, $template_args, $query_fields); 
	$after_form = $form_wrap_args['after_form']; 
	echo $after_form;
}