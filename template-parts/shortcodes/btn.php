<?php

	/* 
		
		@rel bc\core\bootstrap\template.php
	
		@params passed:
		
			"tag" => 'a',
			"class" => 'btn-link',
			"label" => 'Button',
			"href" => '#',
			"target" => '', 
			"value" => '',
			"type" => 'submit',
			"role" => 'button', 
			"extra_attrs" => '',
	
	*/ 
	
?>
<?php if($tag == 'input'){
	$vlaue = ($value?$value:$label);
	?>
<input class="btn <?php echo $class; ?>" type="<?php echo $type; ?>" value="<?php echo $vlaue; ?>" <?php echo $extra_attrs; ?> />
<?php }elseif($tag == 'button'){
	$content = (!empty($content)?$content:$label); 
	?>
<button class="btn <?php echo $class; ?>" type="<?php echo $type; ?>" <?php echo $extra_attrs; ?>><?php echo $content; ?></button>
<?php }else{
	$content = (!empty($content)?$content:$label); 
	?>
<a href="<?php echo $href; ?>" class="btn <?php echo $class; ?>" target="<?php echo $target; ?>" role="<?php echo $role; ?>" <?php echo $extra_attrs; ?>><?php echo $content; ?></a>
<?php } ?>