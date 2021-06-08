<?php 

function WPBC_flex_layout_start($args=array()){
	
	$row = get_row();  
	$row_index = get_row_index();
	$section_settings = WPBC_get_flex_layout($row); 
	// _print_code($section_settings); 

	?>
<div id="<?php echo $section_settings['id']; ?>" data-layout="<?php echo $section_settings['layout']; ?>" class="flex_layout_row <?php echo $section_settings['class']; ?>" <?php echo $section_settings['data']; ?>>

	<?php
	if(!empty($args['edit_link'])){
		echo '<span class="flex_edit_container d-block">'.$args['edit_link'].'</span>';
	}
	?> 

	<?php if(!empty($section_settings['has_background'])) {  ?>
		<div class="position-relative">
			<div class="position-relative z-index-10">
	<?php } ?>


	<?php if(!empty($section_settings['classes'])) { ?>
	<div class="flex_layout_row_container <?php echo $section_settings['container_class']; ?>">
		<div class="flex_layout_row_row <?php echo $section_settings['row_class']; ?>">
			<div class="flex_layout_row_column <?php echo $section_settings['column_class']; ?>">
	<?php
	}
 
	$section_title = WPBC_get_flex_layout_field('section-title'); 
	$section_title_use = WPBC_get_flex_layout_field('section-title-use');
	$section_title_settings = WPBC_get_flex_layout_field('section-title-settings'); 
	$section_title_settings = WPBC_get_flex_layout_cleaned($section_title_settings, 'section-title-settings__'); 
	if(!empty($section_title) && !empty($section_title_use)) {  
		WPBC_get_template_part('builder/parts/ui_layout_commons/section-title', array(
			'section-title' => $section_title,
			'section-title-settings' => $section_title_settings,
			'layout-id' => $section_settings['id'],
			'layout' => $section_settings['layout'],
		));
	} 

}

function WPBC_flex_layout_end(){
	$row = get_row();  
	$section_settings = WPBC_get_flex_layout($row);  
	?>
	<?php if(!empty($section_settings['classes'])) { ?>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php
		if(!empty($section_settings['has_background'])) {
			?>
			</div>
			<?php  
			WPBC_get_template_part('builder/parts/ui_layout_commons/section-background', array(
				'html' => $section_settings['section_styles']['section_styles_html'], 
				'images' => $section_settings['section_styles']['section_styles_images'], 
				'layout-id' => $section_settings['id'], 
			));
			?>
			</div>
			<?php
		} 
		?>
</div>
	<?php
}