<?php

	/* 
		
		@rel bc\core\bootstrap\shortcodes\alert.php
	
		@params passed:
		
			"tag" => 'div',
			"class" => 'alert-link',   
			"role" => 'alert', 
			"extra_attrs" => '',
	
	*/

?><<?php echo $tag; ?> class="alert <?php echo $class; ?>" role="<?php echo $role; ?>" <?php echo $extra_attrs; ?>>
	<?php echo $content; ?>
</<?php echo $tag; ?>>