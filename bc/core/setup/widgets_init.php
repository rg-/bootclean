<?php
/*

	widgets_init

*/
/**
 * Register our sidebars and widgetized areas.
 *
 */
  
 
function WPBC_widgets_init__defaults($defatuls_widgets=array()){

	/*
	 * Filter default arguments used, version pre10 added / dic/2019
	 */
	$before_title = apply_filters('wpbc/filter/widgets/before_title', '<h4 class="section-title">');
	$after_title = apply_filters('wpbc/filter/widgets/after_title', '</h4>');
	
	$defatuls_widgets[] = array(
		'name'          => 'Reusable Widget Area',
		'id'            => 'default_widget_area',
		'description'   => 'Drop and configure into this area all the widgets you need, they will be not visible unless using a filter/hook on theme, or using shortcode "[WPBC_get_widget id=\'your-widget-id\'] anywhere, here on admin fields and textareas, post and pages content, or theme templates. Magic right?!"',
		'class'         => 'wpbc-widget', // ?? This one is a myst?
		'before_widget' => '<div class="widget-box">',
		'after_widget'  => '</div>',
		'before_title'  => $before_title,
		'after_title'   => $after_title,
	
	); 

	global $WPBC_VERSION; 
	if ( version_compare( $WPBC_VERSION, '9.0.0', '>' ) ) {
		$content_areas = WPBC_get_main_container_max_content_areas();

		for ($i=1; $i < $content_areas; $i++) { 
			$defatuls_widgets[] = array(
					'name'          => 'Widget Area '.$i,
					'id'            => 'widget_area_'.$i,
					'description'   => '',
					'class'         => 'wpbc-widget', // ?? This one is a myst?
					'before_widget' => '<div class="widget-box">',
					'after_widget'  => '</div>',
					'before_title'  => $before_title,
					'after_title'   => $after_title,
			); 
		}
	}else{
	 
		$defatuls_widgets[] = array(
				'name'          => 'Primary Widget Area',
				'id'            => 'primary_widget_area',
				'description'   => 'Just a default primary widget area."',
				'class'         => 'wpbc-widget', // ?? This one is a myst?
				'before_widget' => '<div class="widget-box">',
				'after_widget'  => '</div>',
				'before_title'  => $before_title,
				'after_title'   => $after_title,
		); 
	}
	$defatuls_widgets = apply_filters('WPBC_widgets_init__defaults', $defatuls_widgets);
	return $defatuls_widgets;
}
 
function WPBC_widgets_init() {
	
	$widgets = WPBC_widgets_init__defaults();
	if(!empty($widgets)){
		foreach($widgets as $widget){
			register_sidebar( $widget );
		}
	} 
}
add_action( 'widgets_init', 'WPBC_widgets_init' );


/*

	Adding custom fields into widgets forms (admin)

*/

function WPBC_get_widget_custom_data($widget_id, $opt_name, $params){
	global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id']; 
	$widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number']; 
	if (isset($widget_opt[$widget_num][$opt_name]) ){
		return $widget_opt[$widget_num][$opt_name]; 
	}
}

function WPBC_widget_custom_fields(){
	// Nothing to do with ACF... for now
	
	$before_title = apply_filters('wpbc/filter/widgets/custom_fields/before_title', '<h4 class="section-title [VAL]">');
	$after_title = apply_filters('wpbc/filter/widgets/custom_fields/after_title', '</h4>');

	$before_widget = apply_filters('wpbc/filter/widgets/custom_fields/before_widget', '<div class="widget-box [VAL]">');
	$after_widget = apply_filters('wpbc/filter/widgets/custom_fields/after_widget', '</div>');
	
	$fields = array(
		
		/* Custom Widget Title Class*/
		array(
			'name' => 'before_title_class',
			'label' => 'Title Class',
			'type' => 'text',
			'callback' => array(
				'params' => array( 
					'before_title' => $before_title,// [VAL] will be replaced with value saved for this field :)
				),
				'output' => array()
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
		
		/* Custom Widget Box Class */ 
		array(
			'name' => 'before_widget_class',
			'label' => 'Widget Class',
			'type' => 'text',
			'callback' => array(
				'params' => array( 
					'before_widget' => $before_widget,// [VAL] will be replaced with value saved for this field :)
				),
				'output' => array()
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		) 
		
		/* - */
	);
	return $fields;
}

function WPBC_build_widget_form_field($field, $t, $instance){
	$type = $field['type'];
	
	$name = $field['name'];
	$label = $field['label'];
	
	// TEXT
	if( 'text' == $type ){
		?>
		<p><label for="<?php echo $t->get_field_name($namename); ?>"><?php echo $field['label']; ?>:</label>
			<input class="widefat" type="text" name="<?php echo $t->get_field_name($name); ?>" id="<?php echo $t->get_field_id($name); ?>" value="<?php echo $instance[$name];?>" />
		</p>
		<?php
	}
	
	// TEST
	if( 'test' == $type ){
		?>
		<p><label for="<?php echo $t->get_field_name($namename); ?>"><?php echo $field['label']; ?>:</label>
			<input class="widefat" type="text" name="<?php echo $t->get_field_name($name); ?>" id="<?php echo $t->get_field_id($name); ?>" value="<?php echo $instance[$name];?>" />
		</p>
		<?php
	}
}

function WPBC_in_widget_form($t,$return,$instance){
	echo '<label>Widget ID: <input type="text" readonly="readonly" value="'.$t->id.'" class="widefat" style=" display: inline-block;
    width: auto; "/></label>';
	$fields = WPBC_widget_custom_fields();
	$fields_names = array();
	if(!empty($fields)){
		foreach($fields as $field){
			$fields_names[$field['name']] = ''; 
		} 
	} 
	// Defaults and merge customs
	$instance = wp_parse_args(
		(array) $instance,
		$fields_names
	);
	// Check again and set if null if null :)
	if(!empty($fields)){
		foreach($fields as $field){
			if ( !isset($instance[$field['name']]) ){
				$instance[$field['name']] = null;
			}
		}
	} 
	
	// The HTML output 
	if(!empty($fields)){
		foreach($fields as $field){
		WPBC_build_widget_form_field($field, $t, $instance); 
		}
	} 
	// The HTML output END
	
	// Returned data
    $retrun = null;
    return array($t,$return,$instance);
}
function WPBC_widget_update_callback($instance, $new_instance, $old_instance){
	/* Make the above fields callback for update them */
    // $instance['width'] = isset($new_instance['width']); // if number/text
    // $instance['float'] = $new_instance['float']; // if option/select
	
	$fields = WPBC_widget_custom_fields();
	if(!empty($fields)){
		foreach($fields as $field){
			$instance[$field['name']] = strip_tags($new_instance[$field['name']]);
		}
	}
	
    //$instance['before_widget_class'] = strip_tags($new_instance['before_widget_class']);
    return $instance;
}

add_filter( 'WPBC_widget_output_shortcode', function ($output, $widget_id_base, $widget_id){
	return $output;
} );

function WPBC_dynamic_sidebar_params($params){
	/* Set params, add classes... */
	
	if ( is_admin() ) {
        return $params;
    }
	
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
	
	$fields = WPBC_widget_custom_fields();
	$fields_names = array();
	if(!empty($fields)){
		foreach($fields as $field){
			$fields_names[$field['name']] = ''; 
			if( null !==  WPBC_get_widget_custom_data($widget_id, $field['name'], $params ) ){
				$custom = WPBC_get_widget_custom_data($widget_id, $field['name'], $params);  
				if ( isset( $custom ) ){ 
					$this_params = $field['callback']['params'];
					foreach($this_params as $p=>$v){
						$v = str_replace('[VAL]', $custom, $v);
						$params[0][$p] = $v;
					} 
				}
			}
		} 
	} 
	
	/* 
	$before_widget_class = WPBC_get_widget_custom_data($widget_id, 'before_widget_class', $params);  
	if ( isset( $before_widget_class ) ){
		$params[0]['before_widget'] = '<div class="widget-box '. $before_widget_class .'">';
	}
	
	'before_widget' => '<div class="widget-box">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="section-title">',
	'after_title'   => '</h4>', 
	
    if (isset($widget_opt[$widget_num]['width'])){ 
		if(isset($widget_opt[$widget_num]['float'])){
			$float = $widget_opt[$widget_num]['float'];
		}else{
			$float = '';
            $params[0]['before_widget'] = preg_replace('/class="/', 'class="'.$float.' half ',  $params[0]['before_widget'], 1);
		} 
    }
	*/
	$wp_registered_widgets[ $widget_id ]['original_callback'] = $wp_registered_widgets[ $widget_id ]['callback'];
    $wp_registered_widgets[ $widget_id ]['callback'] = 'WPBC_widget_callback_custom';
	
    return $params;
}

function WPBC_widget_callback_custom() {
 
    global $wp_registered_widgets;
    $original_callback_params = func_get_args();
    $widget_id = $original_callback_params[0]['widget_id'];
 
    $original_callback = $wp_registered_widgets[ $widget_id ]['original_callback'];
    $wp_registered_widgets[ $widget_id ]['callback'] = $original_callback;
 
    $widget_id_base = $wp_registered_widgets[ $widget_id ]['callback'][0]->id_base;
	
    if ( is_callable( $original_callback ) ) { 
        ob_start();
        call_user_func_array( $original_callback, $original_callback_params );
        $widget_output = ob_get_clean(); 
        echo apply_filters( 'widget_output', $widget_output, $widget_id_base, $widget_id ); 
    }
 
}
function WPBC_widget_output( $widget_output, $widget_id_base='', $widget_id='' ) {
	global $post;
	global $wp_registered_widgets; 
	//$widget_output = str_replace('<ul>','<ul class="nav flex-column">',$widget_output);
	//$widget_output = str_replace('li class="','li class="nav-item ',$widget_output);
	//$widget_output = str_replace('<a','<a class="nav-link"',$widget_output);
	//$widget_output = str_replace('#\{.*?\}#s','<a class="nav-link"',$widget_output);
	return $widget_output;
}
add_filter( 'widget_output', 'WPBC_widget_output', 10, 3 );

//Add input fields(priority 5, 3 parameters)
add_action('in_widget_form', 'WPBC_in_widget_form',5,3);
//Callback function for options update (priorität 5, 3 parameters)
add_filter('widget_update_callback', 'WPBC_widget_update_callback',5,3);
//add class names (default priority, one parameter)
add_filter('dynamic_sidebar_params', 'WPBC_dynamic_sidebar_params');



/*

	Widgets as shortcodes anywhere...
	

*/

add_filter('widget_text', 'do_shortcode');

// Call a Widget with a Shortcode
function WPBC_widget_fx($atts) {
    
    global $wp_widget_factory;
    
    extract(shortcode_atts(array(
        'widget_name' => FALSE
    ), $atts));
    
    $widget_name = esc_html($widget_name);
    
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct", "bootclean"),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif; 
    ob_start();
    the_widget($widget_name, $widget_args, array(
		'widget_id'=>'arbitrary-instance-'.$id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}
add_shortcode('WPBC_widget','WPBC_widget_fx');


/*

	Widgets by id anywhere too!!

*/
function WPBC_get_widget_fx($atts){
	extract(shortcode_atts(array(
        'name' => FALSE,
		'id' => FALSE,
		'instance' => '',
		'args'=> ''
    ), $atts));
	
	$default_instance = array(
		'title' => '',
	);
	$instance = wp_parse_args( $instance, $default_instance );
	
	$default_args = array(
		'before_widget' => '<div class="widget-box">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="section-title">',
		'after_title'   => '</h4>',
	);
	$args = wp_parse_args( $args, $default_args );
	
	if($id){
		$widget_id = $id;
		global $wp_registered_widgets;
		$original_callback_params = func_get_args(); 
		$widget_obj = $wp_registered_widgets[$widget_id];
		$widget_opt = get_option($widget_obj['callback'][0]->option_name);
		$widget_num = $widget_obj['params'][0]['number'];  
		$original_callback = $widget_obj['original_callback'];
		//$widget_obj['callback'] = $original_callback; 
		$widget_id_base = $widget_obj['callback'][0]->id_base; 
		$widget_class_name = get_class($widget_obj['callback'][0]);
		$output = ''; 
		$last_index = count($widget_opt); 
		
		if($widget_num){ 
			/*
			
			'widget_id'=>'arbitrary-instance-'.$id,
			'before_widget' => '<div class="widget-box">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="section-title">',
			'after_title'   => '</h4>',
			
			*/
			$this_options = $widget_opt[$widget_num];  
			  
			$instance = array(
				'title' => $this_options['title'],
				'dropdown' => $this_options['dropdown'],
				'count'    => $this_options['count'],
			); 
			
			$fields = WPBC_widget_custom_fields();
			$fields_names = array(); 
			
			if(!empty($fields)){
				foreach($fields as $field){
					$fields_names[$field['name']] = '';  
					$this_params = $field['callback']['params']; 
					foreach($this_params as $p=>$v){ 
						$custom = $this_options[$field['name']];
						$v = str_replace('[VAL]', $custom, $v); 
						$args[$p] = $v;
					} 
				} 
			} 
			 
			ob_start();	
			the_widget( $widget_class_name, $instance, $args );
			$output = ob_get_contents();
			ob_end_clean(); 
			return apply_filters('widget_output', $output);  
		}
	}
	if($name){
		ob_start();
		//echo do_shortcode('[WPBC_widget widget_name="'. $name .'"]');
		the_widget( $name, $instance, $args );
		$output = ob_get_contents();
		ob_end_clean(); 
		return apply_filters('widget_output', $output);
	}
	
}
add_shortcode('WPBC_get_widget','WPBC_get_widget_fx');