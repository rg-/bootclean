<?php 

add_action('wpbc/layout/inner/content/loop/before', function(){

	$types = WPBC_get_layout_posts_post_types();

	foreach ($types as $post_type) {
		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings($post_type); 

		if( WPBC_if_is_post_type_layout(false, $post_type) ){  
			$row_args = $WPBC_layout_posts_page['style_args']['row_args'];
			$row_class = 'ui_layout_posts_advanced-row '.$WPBC_layout_posts_page['style_args']['row_class'];
			?>
			<!-- ui_layout_posts_advanced-row -->
			<div <?php echo $row_args; ?> class="<?php echo $row_class;?>">
			<?php
			if($WPBC_layout_posts_page['style'] == 'masonry'){  
				?>
				<div class="wpbc-masonry-sizer <?php echo $WPBC_layout_posts_page['style_args']['item_class']; ?>"></div>
				<?php
			} 
		} 
	} 

},10);

add_action('wpbc/layout/inner/content/loop/after', function(){

	$types = WPBC_get_layout_posts_post_types();

	foreach ($types as $post_type) {
		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings($post_type);
		$page_settings = $WPBC_layout_posts_page; 
		if( WPBC_if_is_post_type_layout(false, $post_type) ){
			?>
			</div>
			<!-- ui_layout_posts_advanced-row END -->
			<?php
		} 
	} 

},10); 


// page for post or front page post type ???

add_filter('wpbc/filter/layout/struture', function($args){

	$page_for_posts = get_option( 'page_for_posts' ); 

	if( is_blog() && !empty($page_for_posts) ){ 
		$layout = WPBC_get_layout_structure_build_layout($page_for_posts);
		$custom_layout__enable = WPBC_get_field('custom_layout__enable', $page_for_posts);
		if(!empty($custom_layout__enable)){ 
			$custom_layout_container_type = WPBC_get_field('custom_layout__container_type', $page_for_posts); 
			$args['main_container'][$layout]['using_settings'] = true;
			$args['main_container'][$layout]['container_type'] = $custom_layout_container_type;
		}
	}

	return $args;

},10,1);

add_filter('wpbc/filter/layout/location', function($layout, $template, $using_theme_settings, $using_page_settings){

	$page_for_posts = get_option( 'page_for_posts' ); 
	
	if( is_blog() && !empty($page_for_posts) || isset($_GET['post']) && $_GET['post'] == $page_for_posts   ){

		$custom_layout__enable = WPBC_get_field('custom_layout__enable', $page_for_posts);
		//_print_code($custom_layout__enable);
		if(!empty($custom_layout__enable) && !is_single()  ){ 
		  $layout = WPBC_get_field('custom_layout__custom_location', $page_for_posts); 
		} 
	}

	return $layout;
},99,4); 


add_filter('wpbc/filter/layout/main-page-header/defaults', function($params){
	 
	$page_for_posts = get_option( 'page_for_posts' );

	if( !empty($page_for_posts) ){ 

		$layout_header_templates = WPBC_layout_posts_page_templates();

		foreach ($layout_header_templates as $key => $value) {
			
			if( is_blog($value['template']) ){  
				$params['use_template'] = '';
				$header_type = WPBC_get_field('layout_header_template_'.$value['key'].'__type', $page_for_posts);
				if( $header_type == 'template' ){  
					$params['template_id'] = WPBC_get_field('layout_header_template_'.$value['key'], $page_for_posts);
				}
			}

		} 

	}
	
	return $params;

},20,1);

add_filter('wpbc/filter/layout/main-page-header/post_id', function($post_id){
	$page_for_posts = get_option( 'page_for_posts' );
	if( !empty($page_for_posts) ){ 

		$layout_header_templates = WPBC_layout_posts_page_templates();

		foreach ($layout_header_templates as $key => $value) {
			
			if( is_blog($value['template']) ){  
				$params['use_template'] = '';
				$header_type = WPBC_get_field('layout_header_template_'.$value['key'].'__type', $page_for_posts);
				if( $header_type == 'page_settings' ){  
					$post_id = $page_for_posts;
				}
			}

		} 

	}
	return $post_id; 
},10,1);

add_filter('wpbc/filter/layout/secondary-content/post_id', function($post_id, $content_area_index){
	
	$page_for_posts = get_option( 'page_for_posts' ); 

	$layout_header_templates = WPBC_layout_posts_page_templates();

	foreach ($layout_header_templates as $key => $value) {
		
		if( is_blog($value['template']) ){    

			$header_type = WPBC_get_field('layout_secondary_content_'.$value['key'].'__type_'.$content_area_index, $page_for_posts);

			if( $header_type == 'page_settings' ){   
				$post_id = $page_for_posts;
			} 
		}

	} 
	return $post_id;

},10,2);

add_filter('wpbc/filter/layout/secondary-content/template_id', function($post_id, $content_area_index){

	$page_for_posts = get_option( 'page_for_posts' ); 

	$layout_header_templates = WPBC_layout_posts_page_templates();

	foreach ($layout_header_templates as $key => $value) {
		
		if( is_blog($value['template']) ){    

			$header_type = WPBC_get_field('layout_secondary_content_'.$value['key'].'__type_'.$content_area_index, $page_for_posts);

			if( $header_type == 'page_settings' ){   
				//$post_id = $page_for_posts;
			}
			if( $header_type == 'template' ){   
				$post_id = WPBC_get_field('layout_secondary_content_'.$value['key'].'_'.$content_area_index, $page_for_posts);
			}
		}

	} 

	return $post_id;

},10,2);

add_filter('wpbc/filter/layout/secondary-content/widget_output', function($widget_output, $content_area_index){

	$widget_area = '';

	$page_for_posts = get_option( 'page_for_posts' ); 

	$layout_header_templates = WPBC_layout_posts_page_templates();

	foreach ($layout_header_templates as $key => $value) {
		
		if( is_blog($value['template']) ){    
			// layout_secondary_content_posts_page__type_1
			$header_type = WPBC_get_field('layout_secondary_content_'.$value['key'].'__type_'.$content_area_index, $page_for_posts);  

			if( $header_type == 'widget_area' ){   
				$widget_area = WPBC_get_field('layout_secondary_content_'.$value['key'].'__widget_area_'.$content_area_index, $page_for_posts);
			}
		}

	} 
	 
	if ( !empty($widget_area) && is_active_sidebar( $widget_area ) ){ 
		ob_start();
		dynamic_sidebar( $widget_area );
		$widget_output .= ob_get_clean();
	}

	return $widget_output;

},10,2);