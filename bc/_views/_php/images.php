<h2>Responsive image</h2>
<div class="example-block">
	<img src="<?php echo _get_sample_img();?>" class="img-fluid" alt="example image width 1200 pixels" title="example image width 1200 pixels">
</div>

<h2>Image shapes</h2>
<div class="example-block">
	<img src="<?php echo _get_sample_img(array('size'=>'300x250'));?>" class="rounded" alt="rounded image">
	<hr class="border-primary">
	<img src="<?php echo _get_sample_img(array('size'=>'300x250'));?>" class="rounded-circle" alt="circle image">
	<hr class="border-secondary">
	<img src="<?php echo _get_sample_img(array('size'=>'300x250'));?>" class="img-thumbnail" alt="thumbnail image">
</div>