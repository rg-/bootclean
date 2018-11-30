<h2 class="gmt-2 gmb-2">row>cols content</h2>
<?php 
$col = '<div class="col-4"><img src="images/sample/architecture/architecture-3076685_1280.jpg" class="item-image full-w" alt=" "/><h3>Title</h3><p>Lorem ipsum</p></div>';
$content = '<div class="row">'.$col.$col.$col.'</div>';
$slick_items = array(
	array('content'=>$content),
	array('content'=>$content)
); 
BC_get_component('slick', array( 
	'container_class'=>'',
	'container_item_class'=>'',
	'slick'=>'{ "dots":false, "arrows":true }',
	'items'=>$slick_items
));  ?>

<h2 class="gmt-2 gmb-2">Basic image content</h2>
<?php 
$slick_items = array(
	array('content'=>'<img src="images/sample/architecture/architecture-3076685_1280.jpg" class="item-image full-w" alt=" "/>'),
	array('content'=>'<img src="images/sample/architecture/staircase-600468_1280.jpg" class="item-image full-w" alt=" "/>'),
	array('content'=>'<img src="images/sample/architecture/stairs-1209439_1280.jpg" class="item-image full-w" alt=" "/>'),
	array('content'=>'<img src="images/sample/architecture/architecture-3076685_1280.jpg" class="item-image full-w" alt=" "/>'),
	array('content'=>'<img src="images/sample/architecture/staircase-600468_1280.jpg" class="item-image full-w" alt=" "/>'),
	array('content'=>'<img src="images/sample/architecture/stairs-1209439_1280.jpg" class="item-image full-w" alt=" "/>')
); 
BC_get_component('slick', array( 
	'container_class'=>'',
	'container_item_class'=>'',
	'slick'=>'{ "dots":true, "arrows":false }',
	'items'=>$slick_items
));  ?>
<h2 class="gmt-2 gmb-2">Multiple</h2>
<?php  
BC_get_component('slick', array( 
	'container_class'=>'',
	'container_item_class'=>'',
	'slick'=>'{ "dots":true, "arrows":false, "infinite":true, "slidesToShow":3, "slidesToScroll":3 }',
	'items'=>$slick_items
));  ?> 

<h2 class="gmt-2 gmb-2">Items with background color based on theme scheme + responsive heights</h2>

<?php
$slick_items = array(
	array(
		'background-scheme'=>'secondary',
		'content'=> '<div><h2 class="slide-title">Slide One</h2><p>xs height is set to 130px</p></div>',
		'content_class'=>'d-flex justify-content-center align-items-center container'
	),
	array(
		'background-scheme'=>'success',
		'content'=> '<div class="gpb-2 gpl-2"><h2 class="slide-title">Another Slide</h2><p>sm height is set to 200px</p></div>',
		'content_class'=>'d-flex justify-content-start align-items-end container'
	),
	array(
		'background-scheme'=>'info',
		'content'=> '<div class="gpr-2"><h2 class="slide-title">Slide Title</h2><p>Aligned center/right.</p></div>',
		'content_class'=>'d-flex justify-content-end align-items-center container'
	),
	array(
		'background-scheme'=>'warning',
		'content'=> '<div class="gpr-2"><h2 class="slide-title">Slide Title</h2><p>Aligned center/right.</p></div>',
		'content_class'=>'d-flex justify-content-end align-items-center container'
	),
	array(
		'background-scheme'=>'danger',
		'content'=> '<div><h2 class="slide-title">Slide Title</h2><p>Aligned center/right.</p></div>',
		'content_class'=>'d-flex justify-content-center align-items-center container'
	),
	array(
		'background-scheme'=>'dark',
		'content'=> '<div><h2 class="slide-title">Slide Title</h2><p>Aligned center/right.</p></div>',
		'content_class'=>'d-flex justify-content-center align-items-center container'
	),
	array(
		'background-scheme'=>'primary',
		'content'=> '<div class="text-center"><h2 class="slide-title">Slide background color</h2><p>Aligned center/center.</p></div>',
		'content_class'=>'d-flex justify-content-center align-items-center container'
	)
);
BC_get_component('slick', array( 
	'container_class'=>'',
	'container_item_class'=>'',
	'slick'=>'{ "dots":true, "arrows":false }',
	'items'=>$slick_items,
	'breakpoint-height'=>array(
				'xs'=>'130px',
				'sm'=>'200px',
				'md'=>'300px',
				'lg'=>'400px',
				'xl'=>'400px'
			)
)); 
?>
<hr>
<p>Slick Slider all options and demos, here: <a href="http://kenwheeler.github.io/slick/">http://kenwheeler.github.io/slick/</a></p>