<?php

	$_p = $params; 
	$is_main = isset($_p['is_main']) ? true : false;
	
	$_uid = uniqid();
	$defauls = array( 
		
		'is_main' => $is_main,
		
		'id' => '',
		'class' => 'pt-4 pb-2',
		'container_class' => 'container',
		'container_row_class' => 'row',
		'container_col_class' => 'col-12',
		
		'default_content' => '<p><small>&copy; 2020 - BootClean by <a href="https://rgdesign.org" target="rgdesign">rgdesign</a> - Bootstrap framework - v '.WPBC_version().'</small></p>'
		
	);
	
	
	$_p = array_replace_recursive($defauls, $_p);  
	
	$_p = apply_filters('WPBC_component_defaults__footer', $_p);
	// Also filter by id, so you can take control by id :)
	$_p = apply_filters('WPBC_component_defaults__footer_'.$_p['id'], $_p);
	 
	// ID // TODO, see how to deal when no id on the toggle collapse target
	$id = !empty($_p['id']) ? $_p['id'] : 'main-footer';
	$div_attrs = ' id="'. $id .'"';  
	$div_attrs .= ' class="'.$_p['class'].'"';

	$container_class = !empty($_p['container_class']) ? $_p['container_class'] : '';
	$container_row_class = !empty($_p['container_row_class']) ? $_p['container_row_class'] : '';
	$container_col_class = !empty($_p['container_col_class']) ? $_p['container_col_class'] : '';
	$default_content = !empty($_p['default_content']) ? $_p['default_content'] : '';
?>
<footer <?php echo $div_attrs; ?>>
	<div class="<?php echo $container_class; ?>">
		<div class="<?php echo $container_row_class; ?>">
			<div class="<?php echo $container_col_class; ?>">
				<?php echo $default_content; ?>
			</div>
		</div>
	</div>
</footer>