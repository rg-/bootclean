<?php

	/* 
		
		@rel bc\core\bootstrap\template.php
	
		@params passed:
		
			"label" => '',
			"title" => '',
			"tag" => 'a',
			"href"=> '#',
			"class" => 'btn-link',
			"type" => '',
			"extra_attrs" => '',
	
	*/

	 if($type){
		// If no content, use label
		$content = ( !empty($content) ? $content : $label );
		// Icon args
		$icon_args = array(
			'alt'=> $label ? $label : $title,
			'width'=>'24'
		); 
		$svg = WPBC_get_svg_img('logo-'.$type, $icon_args); 
	}  
?>
<?php if($type){ ?>
<a class="btn <?php echo $class; ?> btn-<?php echo $type; ?>" href="<?php echo $href; ?>" <?php echo $extra_attrs; ?>><?php echo $svg; ?><span><?php echo $content; ?></span></a>
<?php } ?>