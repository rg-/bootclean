<?php 
add_action('wpbc/layout/body/start', 'WPBC_swup_simulate_body_tags',1);
 
function WPBC_swup_simulate_body_tags(){ 
	$body_class = 'loading detect-scroll '.BC_get_body_class();
	?>
<div id="simulate-body-tags" style="display:none;" <?php body_class($body_class); ?> data-config='<?php WPBC_get_body_data_config(); ?>' <?php BC_get_body_data(); ?> data-template="<?php echo WPBC_get_template(); ?>" data-template-type="<?php echo WPBC_get_template(array('show_post_types'=>'1')); ?>" data-template-format="<?php echo WPBC_get_template(array('show_post_formats'=>'1')); ?>"></div>
	<?php 
}