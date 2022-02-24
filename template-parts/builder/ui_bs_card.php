<?php WPBC_flex_layout_start(); ?>

<?php 
	
	$row = get_row();  
	$row_index = get_row_index();
	$section_settings = WPBC_get_flex_layout($row); 

	$content = WPBC_get_flex_layout_field('content');

	$content = WPBC_get_flex_layout_cleaned($content, 'content_headline__section-');   

		$settings = $content['title-settings']; 
		$headline_class = str_replace('.', '', $settings['title-settings__heading']);
		$headline_class .= ' text-'.$settings['title-settings__align'];

		$headline = $content['title'];
		$lead = $content['content_lead'];

	$style = WPBC_get_flex_layout_field('style'); 

		$gallery_images = '';
		$attrs = '';

	if(!empty($style)){

		$gallery = $style['style_gallery'];
		$gallery_temp = array();  
		if( !empty($gallery) ){
			foreach ($gallery as $key => $value) {
				$gallery_temp[] = $value['id'];
			}
			$gallery_images = implode(",",$gallery_temp);  
		}

		$background_color = $style['style_background-color'];
		$color = $style['style_color'];

		if( !empty($background_color) || !empty($color) ){
			$attrs .= ' style="';
			if(!empty($background_color)){
				$attrs .= 'background-color:'.$background_color.';';
			}
			if(!empty($color)){
				$attrs .= 'color:'.$color.';';
			}
			$attrs .= '" ';
		}

	}
	
	$args = array(
		'card_type' => $style['card_type'],
		'card_embed' => $style['card_embed'],
		'class' => 'mb-0 position-relative',
		'attrs' => $attrs,
		'headline' => $headline,
		'headline_class' => $headline_class,
		'lead' => apply_filters('the_content', $lead),
		'lead_tag' => 'div', 
		'container_class' => 'position-relative z-index-10',
		'images' =>  "[WPBC_get_section_background images='".$gallery_images."']",
	);

	WPBC_get_card($args);

?>

<?php WPBC_flex_layout_end(); ?>