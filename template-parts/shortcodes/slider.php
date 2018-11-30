<?php

	/* 
		
		@rel bc\core\bootstrap\shortcodes\alert.php
	
		@params passed:
		
		"id" => '',
		"container_class" => '',   
		"container_item_class" => '', 
		"slick" => '{ "dots":true, "arrows":false }', 
		"template_items_id"=> ''
		"breakpoint_height"=> ''
	
	{"xs":{"default":"200px"},"sm":{"default":"300px"},"md":{"default":"400px"},"lg":{"default":"100%","min":"400px","max":"1400px"},"xl":{"default":"100%","min":"500px","max":"1400px"}}
	
	
	*/ 
	
	$breakpoint_height = !empty($breakpoint_height) ? json_decode($breakpoint_height,true) : '';
	 
?>
<?php

$template_items = do_shortcode('[WPBC_get_template id="'.$template_items_id.'"/]'); 

if(!empty($template_items)){
	BC_get_component('slick', array(
		'id'=>						$id, 
		'container_class'=>			$container_class,
		'container_item_class'=>	$container_item_class,
		'slick'=>					$slick,
		//'items'=>					$slick_items,
		'items_html'=> $template_items,
		'breakpoint-height' => $breakpoint_height
	));
}

/*
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
*/
?>