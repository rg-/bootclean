<?php 
$template_id = get_sub_field('key__layout_template_row__content_'.'key__r_wpbc_template', $post_id);
$inview = get_sub_field('key__layout_template_row__content_'.'key__r_wpbc__advanced_group_inview', $post_id);
$use_inview = false; 
if(!empty($inview)){
	$use_inview = true;
	$advanced_group_inview__type = $inview['advanced_group_inview__type'];
	if($advanced_group_inview__type == 'ajax-load'){
		$type = 'inview';
	}
	if(!$advanced_group_inview__type){
		$use_inview = false;
	}	
}
if($use_inview){ 
	echo do_shortcode('[WPBC_get_template_ajax args="" id="'.$template_id.'" type="'.$type.'"/]');
}else{ 
	echo do_shortcode('[WPBC_get_template id="'.$template_id.'"/]'); 
}