<?php

// $args passed

// _print_code($args);

if( !empty($args) ){
	
	$id = !empty($args['class']) ? $args['class'] : 'wpbc-dropdown-'.uniqid();
	$class = !empty($args['class']) ? $args['class'] : '';
	$btn_class = !empty($args['btn_class']) ? $args['btn_class'] : '';
	$btn_label = !empty($args['btn_label']) ? $args['btn_label'] : 'Dropdown menu';
	$items = !empty($args['items']) ? $args['items'] : '';
	$attrs = !empty($args['attrs']) ? $args['attrs'] : '';

	$options_list = '';
	if(!empty($items)){
		foreach ($items as $item) {
			$item_list .= '<a href="'.$item['href'].'" class="dropdown-item">'.$item['label'].'</a>';
		}
	} 
?>
<div class="dropdown <?php echo $class; ?>" <?php echo $attrs; ?>> 
  <button class="btn dropdown-toggle <?php echo $btn_class; ?>" type="button" id="<?php echo $id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $btn_label; ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="<?php echo $id; ?>">
    <?php echo $item_list; ?>
  </div>
</div>
<?php

}
?>