<?php

	// TODO; this is a template not a component.... mmm

	// $params passed..
	$div_attrs = isset($params['id']) ? ' id="'.$params['id'].'"' : 'main-footer'; 
?>
<footer <?php echo $div_attrs; ?> class="<?php echo isset($params['class']) ? $params['class'] : 'pt-4 pb-2'; ?>">
	<div class="<?php echo isset($params['container_class']) ? $params['container_class'] : 'container'; ?>">
		<div class="<?php echo isset($params['container_col_class']) ? $params['container_col_class'] : 'col-12 text-center'; ?>">
			<p><small>&copy; 2018 - BootClean by <a href="https://rgdesign.org" target="rgdesign">rgdesign</a> - Bootstrap framework - v <?php echo $theme_root['version'];?></small></p>
		</div>
	</div>
</footer>