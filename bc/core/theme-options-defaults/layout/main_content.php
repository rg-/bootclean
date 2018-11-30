<?php 

$main_content = array();

$main_content[] = array(
	'name' => __( 'Main Content', 'bootclean' ),
	'type' => 'sub-heading', 
);
 
	$temp = WPBC_get_layout_main_content_default_classes('all'); 

	$condition_groups = array(); 
	foreach ($temp as $key => $value) {
		$condition_groups[] = array(
			'target' => '.group-bc-options--layout--main-content-container-group-'.$key,
			'show' => '1'
		);
	}

	$main_content[] = array(  
		'desc' => __( 'Enable for custom settinngs.', 'bootclean' ),
		'id' => 'bc-options--layout--main-content-custom',
		'std' => '1',
		'type' => 'checkbox',
		'ui' => true,
		'hide-reset'=> true,
		'condition' => $condition_groups,
		'width' => '100%'
	);

	
	$classes_groups = array();
	foreach ($temp as $key => $value) {  
		$classes_groups[$key] = array( 
			'id' => $key,
			'name' => $value['options']['name'],
			'desc' => $value['options']['desc'],
			'classes' => array(
				'container' => $value['container'],
			), 
		);
	} 



	function _WPBC_advanced_preview_builder(){
		ob_start(); 
		?> 
		<div class="WPBC_layout_builder_preview"> 
			<div class="embed-responsive embed-responsive-16by9">
				<iframe src="<?php echo get_bloginfo('url');?>/wp-admin/admin-ajax.php?action=get_template&preview=builder"></iframe>
			</div> 
		</div>
		
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	$layout_preview = _WPBC_advanced_preview_builder();

	foreach ($classes_groups as $key => $value) {
		
		$main_content[] = array(
			'id' => 'bc-options--layout--main-content-container-group-'.$value['id'],
			'type' => 'group-start',
			'name' => $value['name'].' (<small>'.$value['desc'].'</small>)',
			'no_esc_html' => true,
			'label_tag' => 'h3',
		);

			$classes = $value['classes']; 

			$main_content[] = array(
				'name' => __( 'Container class', 'bootclean' ), 
				'id' => 'bc-options--layout--main-content-container-class-'.$value['id'],
				'std' => $classes['container']['class'],
				'width' => '20%',
				'type' => 'text',
				'label_tag' => 'h5',
			);
			$main_content[] = array(
				'name' => __( 'Container > Row class', 'bootclean' ), 
				'id' => 'bc-options--layout--main-content-container-row-class-'.$value['id'],
				'std' => $classes['container']['row'],
				'width' => '20%',
				'type' => 'text',
				'label_tag' => 'h5',
			);
			$main_content[] = array(
				'name' => __( 'Main content column class', 'bootclean' ), 
				'id' => 'bc-options--layout--main-content-container-col_content-class-'.$value['id'],
				'std' => $classes['container']['col_content'],
				'width' => '25%',
				'type' => 'text',
				'label_tag' => 'h5',
			);
			$main_content[] = array(
				'name' => __( 'Secondary content column class', 'bootclean' ), 
				'id' => 'bc-options--layout--main-content-container-col_sidebar-class-'.$value['id'],
				'std' => $classes['container']['col_sidebar'],
				'width' => '25%',
				'type' => 'text',
				'label_tag' => 'h5',
			);


		$main_content[] = array(
			'type' => 'group-end',
		);


	}

$main_content[] = array( 
	'type' => 'sub-heading-end', 
);