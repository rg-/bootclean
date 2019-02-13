<?php

$params = WPBC_layout__main_page_header_defaults();

$use_from_options = $params['use_from_options'];
$use_template = $params['use_template']; 
$use_custom_template = $params['use_custom_template']; 
$use_custom_html = $params['use_custom_html'];    
$template_id = $params['template_id'];  
if( !empty($template_id) || !empty($use_custom_html) ){
?>
<div class="page-header">
	<?php do_action('wpbc/layout/page-header/before'); ?>
	<?php 
	if($use_custom_html){ 
		echo do_shortcode( $use_custom_html ); 
	}else{
		echo do_shortcode('[WPBC_get_template id="'.$template_id.'"]');
	}
	?>
	<?php do_action('wpbc/layout/page-header/after'); ?>
</div>
<?php } ?>