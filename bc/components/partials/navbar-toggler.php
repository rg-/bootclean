<button class="navbar-toggler <?php echo $params['class']; echo !$params['expanded'] ? ' collapsed' : ''; ?> <?php echo $params['type']; ?> <?php echo $params['effect']; ?>" type="button" data-toggle="collapse" data-target="<?php echo '#'.$params['target']; ?>" aria-controls="<?php echo $params['target']; ?>" aria-expanded="<?php echo $params['expanded'] ? 'true' : 'false'; ?>" aria-label="<?php echo $params['label']; ?>">
	<?php if($params['type']!='custom'){ ?>
	<span class="custom-toggler"><span class="navbar-toggler-icon"></span></span>
	<?php }else{ ?>
		<span class="navbar-toggler-icon"></span>
	<?php } ?>
</button>