<?php

// $args passed

// _print_code($args);

if( !empty($args) ){
	 
	$class = !empty($args['class']) ? $args['class'] : 'form-control';
	$options = !empty($args['options']) ? $args['options'] : '';
	$attrs = !empty($args['attrs']) ? $args['attrs'] : '';

	$options_list = '';
	if(!empty($options)){
		foreach ($options as $values) {
			$options_list .= '<option value="'.$values['value'].'">'.$values['label'].'</option>';
		}
	}

		?>
<select class="<?php echo $class; ?> selectpicker" <?php echo $attrs; ?>>
	<?php echo $options_list; ?>
</select>
		<?php

}
?>