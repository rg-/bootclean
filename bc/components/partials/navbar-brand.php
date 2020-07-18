<?php 
$image = $params['image'];
if($image){
	$width = !empty($params['image_width']) ? 'width="'.$params['image_width'].'"' : '';
	$height = !empty($params['image_height']) ? 'width="'.$params['image_height'].'"' : '';
	$brand = '<img '.$width.' '.$height.' class="' . $params['image_class'] . '" src="' . $params['image'] . '" alt="'. $params['image_alt'] .'"/> <span class="navbar-brand-title align-self-center p-2">'. $params['title'] .'</span>';
}else{
	$brand = $params['title'];
}
$attrs = $params['attrs'];
$styles = !empty($params['styles']) ? $params['styles'] : '';
if( is_array($styles) ){ 
	// NOT USED, instead this style filter: bc\core\enqueue\custom.css.php
	//if( !empty($styles['xs']) ) $attrs .= ' style="'.$styles['xs'].'" ';
}
?>
<a <?php echo $attrs; ?> class="navbar-brand <?php echo $params['class']; ?>" href="<?php echo $params['href']; ?>"><?php echo $brand; ?></a>