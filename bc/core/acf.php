<?php

function WPBC_get_field($field, $id=''){
	if(function_exists('get_field')){
		return get_field($field, $id) ? get_field($field, $id) : '';
	}else{
		if($id!='options'){
			return get_post_meta($id, $field, true);
		}else{
			return get_option('options_'.$field);
		}
	} 
} 


include('acf/group-fields.php');  
include('acf/reusable-fields.php');
include('acf/layouts.php');
include('acf/groups.php');



if( !function_exists('WPBC_ACF_FORM') ){
	function WPBC_ACF_FORM(){

		$enable_acf_form = apply_filters('wpbc/filter/acf/enable_acf_form', 1);

		if( is_user_logged_in() && current_user_can( 'manage_options' ) && $enable_acf_form ){
			return true;
		}else{
			return false;
		}
	}
}


// 
if ( version_compare( $WPBC_VERSION, '9.0.0', '>' ) ) {
	// $filter_tag = 'wpbc/layout/start';
	$filter_tag = apply_filters('wpbc/filter/acf/acf_form/action_tag', 'wpbc/layout/acf_form');
	$filter_index = apply_filters('wpbc/filter/acf/acf_form/action_index', '10'); 
	add_action($filter_tag, function ($post_id){ 
		if( WPBC_ACF_FORM() && !wp_doing_ajax() ){ 
			WPBC_get_acf_form($post_id);
		} 
	},$filter_index,1);

}else{
	
	//$filter_tag = 'wpbc/layout/inner/content/loop/after';
	$filter_tag = apply_filters('wpbc/filter/acf/acf_form/action_tag', 'wpbc/layout/inner/content/loop/after');
	$filter_index = apply_filters('wpbc/filter/acf/acf_form/action_index', '10');
	add_action('wpbc/layout/inner/content/loop/after', function (){ 
		if( WPBC_ACF_FORM() && !wp_doing_ajax() ){
			WPBC_get_acf_form();
		} 
	}, $filter_index);
}


add_action('wpbc/layout/builder/loop/after', function (){ 
	if( WPBC_ACF_FORM()  && !wp_doing_ajax() ){
	//	WPBC_get_acf_form();
	} 
},10);

function WPBC_get_acf_form($post_id=''){
	?>
	<div id="WPBC_acf_form">
			<button class="btn btn-primary btn-sm button--form" type="button" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false" aria-controls="collapseExample">
			<?php 
			echo $edit_icon = WPBC_get_svg_img('md-cube', array(
				'width'=>'20px',
				'height'=>'20px',
				'color'=>'white'
			));
			?>
			</button>
			<?php echo apply_filters('wpbc/acf/form/before/collapse',''); ?>
			<div class="collapse-form-holder">
				<div class="collapse" id="collapse-form">
					<?php
					if( is_page_template('_template_builder.php') ){ 
						$settings = array(
							'post_id'=>$post_id,

						);
					}else{
						$settings = array( 
							'post_title' => true,
							'post_content' => true, 
							'property_location_map' => false,
						);
						if(is_page()){
							$settings = array( 
								'post_title' => true,
								'post_content' => true, 
								'property_location_map' => false,
							);
						} 
						
					}

					$post_type = get_post_type();
					$settings = apply_filters('wpbc/filter/acf/form/settings', $settings, $post_type);
					
					/*

					TODO filter locations, enable, settings, etc

					*/
					acf_form($settings);?>
				</div>
			</div>
		</div>
	<?php
}