<header class="mb-3 mt-4">
	<?php
	$p = array(
		'title'=> isset($params['title']) ? $params['title'] : '',
		'tag'=> isset($params['tag']) ? $params['tag'] : 'h1',
		'attrs'=> isset($params['attrs']) ? $params['attrs'] : '', // NOT class NOT id
		'class'=> isset($params['class']) ? $params['class'] : 'my-0'		
	
	);  
	?>
	<<?php echo $p['tag']; ?> class="<?php echo $p['class']; ?>"><?php echo $p['title']; ?></<?php echo $p['tag']; ?>>
</header>