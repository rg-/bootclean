<?php 
$template_id = get_sub_field('key__layout_template_row__content_'.'key__r_wpbc_template', $post_id);
$inview = get_sub_field('key__layout_template_row__content_'.'key__r_wpbc__advanced_group_inview', $post_id);
$use_inview = false; 
if(!empty($inview)){
	
	$advanced_group_inview__type = $inview['advanced_group_inview__type'];
	if($advanced_group_inview__type == 'ajax-load'){
		$type = 'inview';
		$use_inview = true;
	}

}
if($use_inview){ 
	$do_shortcode = do_shortcode('[WPBC_get_template_ajax post_id="'.$post_id.'" args="" template_id="'.$post_id.'" id="'.$template_id.'" type="'.$type.'" from="template_row" is_ajax="true" layout_count="'.$layout_count.'"/]');
}else{ 
	$do_shortcode = do_shortcode('[WPBC_get_template id="'.$template_id.'" post_id="'.$post_id.'" template_id="'.$post_id.'" from="template_row" layout_count="'.$layout_count.'"/]');
}

$passed_args = array();

$do_shortcode = apply_filters('wpbc/builder/template_row', $do_shortcode, $post_id, $template_id, $passed_args);
echo $do_shortcode;