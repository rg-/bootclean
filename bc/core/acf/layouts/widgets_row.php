<?php


/*


	@WPBC
		@ACF
			@LAYOUTS

	widgets_row
	
	Also needs: template-parts/layouts/widgets_row.php file on theme. Child theme can overide template as well.

*/


/*

	Theme Options filters for repeater field
	See: core/theme-options/fields/repeater.php

*/
add_filter('wpbc/filter/options/repeater/before',function($output, $option_name, $option, $value, $counter){

	if( !empty($option['render_filter']) ){ 
		$filter = $option['render_filter'];  
		if('widgets_areas_options' == $filter){ 
			$output = '<label class="of-label">Widget Area Name: </label>'; 
		} 
	}
	return $output; 

},10,5);

add_filter('wpbc/filter/options/repeater/after',function($output, $option_name, $option, $value, $counter){

	if( !empty($option['render_filter']) ){ 
		$filter = $option['render_filter'];  
		if('widgets_areas_options' == $filter){ 
			$output = '<label class="of-label">ID: </label>';
			//if(!is_null($counter)){
				$output .= '<input type="text" readonly value="'.sanitize_title_with_dashes($value).'" data-callback="widgets_areas_callback" class="widgets_areas_options of-input" style="float:none;" />';
			//} 
		} 
	} 
	return $output; 

},10,5);

add_filter('wpbc/filter/options/repeater/js/docopy',function(){
	$ajaxurl = admin_url('admin-ajax.php');
	?>
	$('.of-input:not(.widgets_areas_options)').on('focus',function(){
		var me = $(this);
		me.parent().find('.widgets_areas_options').addClass('not_me');
	});
	$('.of-input:not(.widgets_areas_options)').on('blur',function(){
		var me = $(this);
		var name = $(this).val();
		
		$.ajax({
			url: '<?php echo $ajaxurl; ?>',
			type: 'post',
			data: {
				action: 'sanitize_title_with_dashes',
				name: name,
			},
			beforeSend: function() { 
			},
			success: function( html ) {
				//console.log("result: "+html); 
				$('.saved .widgets_areas_options').each(function(i){
					var mee = $(this);
					//console.log(mee.attr('class'));
					//console.log("values: "+mee.val());
					if(mee.val() == html){
						//console.log("exists");
						//console.log("values: "+mee.val());
						var e = me.index();
						me.parent().find('.widgets_areas_options').val(html+'-'+(e+1));
					}else{
						//console.log("ok passed");
						me.parent().find('.widgets_areas_options').val(html);
					}
				}); 
			},
			error: function(ms){ 
				alert("Some error occurs, please try again.");
			}
		})
	});
	<?php
},10,1);


function WPBC_ajax_sanitize_title_with_dashes() {

	$name = !empty($_POST['name']) ? $_POST['name'] : 0;
	 
	if($name ){
		echo sanitize_title_with_dashes($name);
	}
	
	die(); 
}
add_action('wp_ajax_'.'sanitize_title_with_dashes', 'WPBC_ajax_sanitize_title_with_dashes');
add_action('wp_ajax_nopriv_'.'sanitize_title_with_dashes', 'WPBC_ajax_sanitize_title_with_dashes');
/*

	ACF part

	Using a simple select field to create a selecteable widgets area dropdown.

*/

function WPBC_acf_post_object_as_widgets_area( $field ) { 
	if( !empty( $field['as_widgets_area'] ) ){ 
		
		
		$field['choices'][0] = 'None';

		/* Since options in fact save a global wp array, i don´t need this...*/
		/*
		$new_widgets = WPBC_get_option('bc-options--widgets--areas');
		foreach($new_widgets as $k=>$v){  
			$field['choices'][sanitize_title_with_dashes($v)] = $v;  
		} 
		*/

		// But i do this:
		$test = $GLOBALS['wp_registered_sidebars']; 
		foreach($test as $k=>$v){
			if($v['id'] != 'default_widget_area'){ 
				$field['choices'][$v['id']] = $v['name'];
			}
		}
	}
    return $field;	
} 
add_filter( 'acf/load_field/type=select', 'WPBC_acf_post_object_as_widgets_area', 10, 4 );

/*

	Adding the reusable widget_area into acf_reusables arrays

*/

add_filter('WPBC_acf_reusables_fields', function($fields){ 
 
	$fields[] = array(
		'key' => 'key__r_widgets_areas',
		'label' => 'Widget Area',
		'name' => 'widgets_area',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => 'widgets_area',
			'id' => '',
		),
		'choices' => array (),
		'default_value' => array (),
		'allow_null' => 0,
		'multiple' => 0,
		'ui' => 0,
		'ajax' => 0,
		'return_format' => 'value',
		'placeholder' => '',

		'as_widgets_area' => 1 // Custom not ACF part
	) ;

	return $fields;

}, 10, 1);

/*

	Adding the layout flexible into the builer layout row system

*/

add_filter('WPBC_acf_builder_layouts', function($layouts){

	$layouts['layout_widgets_row'] =  array(
		'key' => 'layout_widgets_row',
		'name' => 'widgets_row',
		'label' => '<i class="icon-badge"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path fill="#fff" d="M13 13v8h8v-8h-8zM3 21h8v-8H3v8zM3 3v8h8V3H3zm13.66-1.31L11 7.34 16.66 13l5.66-5.66-5.66-5.65z"/></svg></i>'.' Widgets Row',
		'display' => 'block',
		'sub_fields' => array(
			array(
				'key' => 'key__layout_widgets_row__content',
				'label' => 'Content',
				'name' => 'content',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => array(
					0 => 'key__r_tab__content',
					1 => 'key__r_widgets_areas',
					2 => 'key__r_tab__settings',
					3 => 'key__r_builder_classes_group',
					//4 => 'key__r_tab__advanced',
				),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
		),
		'min' => '',
		'max' => '',
	);

	return $layouts;

},10,1); 