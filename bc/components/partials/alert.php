<div class="alert <?php echo isset($params['context']) ? 'alert-'.$params['context'] : ''; ?>" role="alert">
	<?php if ( isset($params['dismiss']) ) { ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<?php } ?>
	<?php echo isset($params['html']) ? $params['html'] : ''; ?>
</div>