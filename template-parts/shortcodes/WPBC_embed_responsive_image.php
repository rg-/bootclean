<?php

$args = $args['params']; // $args passed from shortcode
// like Array ( [params] => Array ( [id] => 29 [size] => large ) )
// print_r($args);
$by = !empty($args['by']) ? $args['by'] : '1by1'; 
$class = !empty($args['class']) ? $args['class'] : ''; 
$item_class = !empty($args['item_class']) ? $args['item_class'] : ''; 
$id = !empty($args['id']) ? $args['id'] : ''; 
$size = !empty($args['size']) ? $args['size'] : 'large'; 
?>
<div class="embed-responsive embed-responsive-<?php echo $by; ?> <?php echo $class; ?>">
	<div class="embed-responsive-item image-cover <?php echo $item_class; ?>" style='background-image: url([WPBC_get_attachment_image_src id="<?php echo $id; ?>" size="<?php echo $size;?>"]);'>
	</div>
</div>