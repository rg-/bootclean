<?php 
 

$svg_uri = BC_URI.'/core/assets/svg';

function _WPBC_develope_template_helpers(){
	ob_start(); 
	?>
	<table class="WPBC_table widefat fixed" cellspacing="0">
		<tr>
			<td>
				Get an option by name:
			</td>
			<td>
				WPBC_get_option( 'option-name', 'default/optional' );
			</td>
		</tr>
	</table> 
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

$fields = array( 
	
	array( 
		'desc' => __( 'Show Options Names in panels.', 'bootclean' ),
		'id' => 'develope-show-option-names',
		'std' => '1',
		'type' => 'checkbox',
		'ui' => true,
		'hide-reset'=> true,
		'condition' => array(
			array(
				'target' => '.of-debug-field-id',
				'show' => '1'
			)
		)
	), 
	
	array( 
		'name' => __( 'Template helpers.', 'bootclean' ), 
		'desc' => _WPBC_develope_template_helpers(),
		'type' => 'info',
		'width' => '100%'
	), 
	
);


$icon = WPBC_get_svg_icons('md-build'); 
WPBC_set_option_group( 'develope', 'Develope', $icon, $fields ); 