<?php

/*

	OBSOLETE since v12.0.0

	@see template-parts/layout/main-page-header.php new ONE

*/

$post_id = apply_filters('wpbc/filter/layout/main-page-header/post_id', '');
$params = WPBC_layout__main_page_header_defaults($post_id);  
$use_from_options = $params['use_from_options'];
$use_template = $params['use_template']; 
$use_custom_template = $params['use_custom_template']; 
$use_custom_html = $params['use_custom_html'];  
$use_page_title = $params['use_page_title'];    
$template_id = $params['template_id'];  
$custom_attrs = $params['custom_attrs'];   
$custom_class = $params['custom_class'];  

	$custom_attrs = apply_filters('wpbc/main-page-header/data', $custom_attrs);
	$custom_class = apply_filters('wpbc/main-page-header/class', $custom_class); 

if( !empty($template_id) || !empty($use_custom_html) || !empty($use_page_title) ){
?>
<div id="main-page-header" class="page-header <?php echo $custom_class; ?>" <?php echo $custom_attrs; ?>>
	<?php do_action('wpbc/layout/page-header/before'); ?>
	<?php 
	if($use_custom_html){ 
		echo do_shortcode( $use_custom_html ); 
	}elseif($use_page_title){ 

		WPBC_get_template_part('layout/page-header-title', $use_page_title); 

	}else{
		add_action('wpbc/slick/item/content/before', 'WPBC_page_header_slick_item_before',0,2);
		add_action('wpbc/slick/item/content/after', 'WPBC_page_header_slick_item_after',0,2);
		echo do_shortcode('[WPBC_get_template id="'.$template_id.'"]');		
		remove_action('wpbc/slick/item/content/before', 'WPBC_page_header_slick_item_before',0,2);
		remove_action('wpbc/slick/item/content/after', 'WPBC_page_header_slick_item_after',0,2);
	}
	?>
	<?php do_action('wpbc/layout/page-header/after'); ?>
</div>
<?php } ?>