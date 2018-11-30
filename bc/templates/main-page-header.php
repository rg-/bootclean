<?php
	// this setup, no container wrap, and fluid no padding item container, will create a full width image slider for example.
	
	// $slick_items not used
	$slick_items = array(
		array(
			'background-image'=>'images/sample/architecture/architecture-3076685_1280.jpg',
			'content'=> '<div><a class="navbar-brand" href="#brand-href"><img class="navbar-brand-img" src="images/theme/logo@2x_inverse.png" alt=""></a></div>',
			'content_class'=>'d-flex justify-content-center align-items-center container'
		),
		array(
			'background-image'=>'images/sample/architecture/staircase-600468_1280.jpg',
			'content'=> '<div class="gp-4"><h2 class="slide-title">Another Slide</h2><p>Aligned bottom/left.</p></div>',
			'content_class'=>'d-flex justify-content-start align-items-end container'
		),
		array(
			'background-image'=>'images/sample/architecture/stairs-1209439_1280.jpg',
			'content'=> '<div><h2 class="slide-title">Slide Title</h2><p>Aligned center/right.</p></div>',
			'content_class'=>'d-flex justify-content-end align-items-center container'
		),
		array(
			'background-color'=>'red',
			'content'=> '<div class="text-center"><h2 class="slide-title">Slide background color</h2><p>Aligned center/center.</p></div>',
			'content_class'=>'d-flex justify-content-center align-items-center container'
		),
		array( 
			'content'=> '<div class="text-center"><h2 class="slide-title">Slide background color</h2><p>Aligned center/center.</p></div>',
			'content_class'=>'d-flex justify-content-center align-items-center container'
		)
	);
	
	BC_get_component('slick', array(
		'id'=>						'main-page-header', 
		'container_class'=>			'',
		'container_item_class'=>	'',
		'slick'=>					'{ "dots":true, "arrows":false }',
		//'items'=>					$slick_items,
		'items_html'=> _BC_template('slick-items-example'),
		'breakpoint-height' => array(
			'xs' => array(
				'default'=>'200px' 
			),
			'sm' => array(
				'default'=>'300px' 
			),
			'md' => array(
				'default'=>'400px' 
			),
			'lg' => array(
				'default'=>'100%',
				'min'=>'400px',
				'max'=>'1400px'
			),
			'xl' => array(
				'default'=>'100%',
				'min'=>'500px',
				'max'=>'1400px'
			)
		)
	)); // BC_get_component
?>