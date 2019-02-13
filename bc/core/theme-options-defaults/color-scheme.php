<?php 


/*

	TODO many things here, for example see:
	
	https://codepen.io/nicetransition/pen/QjwbRg
	
	https://webdesign.tutsplus.com/articles/quick-tip-name-your-sass-variables-modularly--webdesign-13364

*/ 

$svg_uri = BC_URI.'/core/assets/svg';
$bootclean_options['color-scheme'] = array(
	array(
		'icon-name' => '<svg class="of-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 64C150.401 64 64 150.401 64 256c0 105.604 86.401 192 192 192 18.136 0 32-13.864 32-32 0-8.531-3.198-16-8.531-21.333-5.333-5.334-8.531-12.803-8.531-21.334 0-18.135 13.864-32 32-32h38.396c58.667 0 106.667-48 106.667-106.666C448 140.802 361.604 64 256 64zM138.667 256c-18.136 0-32-13.864-32-32s13.864-32 32-32c18.135 0 32 13.864 32 32s-13.865 32-32 32zm64-85.333c-18.136 0-32-13.865-32-32 0-18.136 13.864-32 32-32 18.135 0 32 13.864 32 32 0 18.135-13.865 32-32 32zm106.666 0c-18.135 0-32-13.865-32-32 0-18.136 13.865-32 32-32 18.136 0 32 13.864 32 32 0 18.135-13.864 32-32 32zm64 85.333c-18.135 0-32-13.864-32-32s13.865-32 32-32c18.136 0 32 13.864 32 32s-13.864 32-32 32z"/></svg>',
		'name' => __( 'Color Scheme', 'bootclean' ),
		'type' => 'heading'
	),
	
	array(
		//'name' => __( 'Advanced', 'bootclean' ),
		'desc' => __( 'Customize colors', 'bootclean' ),
		'id' => 'color-scheme-advanced-settings',
		'std' => '0',
		'type' => 'checkbox',
		'hide-reset'=> true,
		'ui'=> true,
		'condition' => array(
			array(
				'target' => '#color-scheme-desc, #color-scheme-colors',
				'show' => '0' 
			),
			array(
				'target' => '.group-color-scheme-options-custom',
				'show' => '1' 
			)
		)
	),
	
	array(
		'id' => 'color-scheme-desc',
		'name' => __( 'This color variations are the ones in the front-end styles used by theme, and also are applied to UI elements accross back-end side.', 'bootclean' ),
		'type' => 'info'
	),
	array(
		'id' => 'color-scheme-colors',
		//'name' => 'This color variations are the ones in the front-end styles used by theme.',
		'desc' => __BC_get_root_colors_X(),
		'type' => 'info'
	),
	array(
		'id' => 'color-scheme-options-custom',
		'name' => 'Group', 
		'type' => 'group-start'
	),
	
);

$root_colors = BC_get_root_colors();

if(!empty($root_colors)){
	$count = 0;
	foreach($root_colors as $k=>$v){
		$k = str_replace('--','',$k);
		if($count<8){
			$bootclean_options['color-scheme'][] = array(
				'name' => ucfirst($k), 
				'id' => 'wpbc_option_color_'.$k,
				'std' => $v,
				'type' => 'color',
				'width' => '20%',
				'reset-button'=> '<span style="display:inline-block; width:20px; height:10px; background-color:'. $v .';"></span> Reset'
			);
		}
		$count++;
	}
}


$bootclean_options['color-scheme'][] = array( 
	'type' => 'group-end'
);
$bootclean_options['color-scheme'][] = array( 
	'type' => 'heading-end'
);

/*

$bootclean_options['color-scheme'][] = array(
		'name' => __( 'And here you can change those colors and will apply visualy.', 'bootclean' ),
		'type' => 'group-start'
	)

$bootclean_theme_root_colors = __BC_get_root_colors();
if(isset($bootclean_theme_root_colors)){
	foreach($bootclean_theme_root_colors as $k=>$v){
		$name = str_replace('--','',$k);
		$value = $v; 
		$bootclean_options['color-scheme'][] = array(
			'name' => ''.$name.'',
			//'desc' => ''.$name.'',
			'id' => 'bc-options--color-scheme--'.$name.'',
			'std' => ''.$v.'',
			'type' => 'color',
			'width' => '20%'
		);
	}
}
$bootclean_options['color-scheme'][] = array( 
		'type' => 'group-end'
	);

*/

/*

	Add color scheme into color pickers

*/

add_action('init', 'wpbc_color_scheme__init');
function wpbc_color_scheme__init(){
	add_action( 'acf/input/admin_footer','WPBC_color_scheme_admin_footer', 999 );
}

function WPBC_color_scheme_admin_footer(){ 
	
	$max = apply_filters('wpbc/filter/color_picker_max', 7);
	$root_colors = __BC_get_root_colors_palette($max);

	$color_picker_args['palettes'] = $root_colors;
	$color_picker_args['width'] = 255;
	$color_picker_args['mode'] = 'hsv';
	$color_picker_args = apply_filters('wpbc/filter/color_picker_args', $color_picker_args);

	
	
	?>
	<script type="text/javascript">
		var color_picker_palettes = <?php echo $color_picker_args['palettes']; ?>;
	(function($) {
		acf.add_filter('color_picker_args', function( args, $field ){	
			// do something to args
			args.palettes = <?php echo $color_picker_args['palettes']; ?>; 
			args.width = <?php echo $color_picker_args['width']; ?>;
			args.mode = '<?php echo $color_picker_args['mode']; ?>';
			// return
			return args;		
		});
	})(jQuery);	
	</script>
	<?php
}