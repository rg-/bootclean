<?php
	
	/*

	$args passed

	Related js/global.js > [data-toggle="collapse-custom"]

	js usefull like closeCollapseCustom = function(target, overlay)....

	Related sass/core/_collapse.scss

	*/ 



	$params = $args['params'];  

	$collapse_ID = isset($params['id']) ? $params['id'] : 'collapse-custom-'.uniqid();
	$collapse_class = isset($params['class']) ? $params['class'] : '';
	if(!empty($params['inside_nav'])){
		$collapse_class .= ' collapse-inside_nav';
	}
	$collapse_attrs = isset($params['attrs']) ? $params['attrs'] : '';
	$collapse_wrapper_class = isset($params['wrapper_class']) ? $params['wrapper_class'] : 'w-100';
	$collapse_action_class = isset($params['action_class']) ? $params['action_class'] : 'text-right';
	$collapse_content_class = isset($params['content_class']) ? $params['content_class'] : '';
	$collapse_content = isset($params['content']) ? $params['content'] : '';

	$collapse_use_toggler = isset($params['toggler_use_toggler']) ? $params['toggler_use_toggler'] : true;
	$collapse_toggler_class = isset($params['toggler_class']) ? $params['toggler_class'] : 'toggler-primary';
	$collapse_toggler_expanded = isset($params['toggler_expanded']) ? $params['toggler_expanded'] : true;
	$collapse_toggler_label = isset($params['toggler_label']) ? $params['toggler_label'] : __('Toggle navigation', 'bootclean');
	$collapse_toggler_type = isset($params['toggler_type']) ? $params['toggler_type'] : 'animate';
	$collapse_toggler_effect = isset($params['toggler_effect']) ? $params['toggler_effect'] : 'close-arrow';
	$collapse_toggler_attrs = isset($params['toggler_attrs']) ? $params['toggler_attrs'] : '';
	$collapse_toggler_data_toggle = isset($params['toggler_data_toggle']) ? $params['toggler_data_toggle'] : 'data-toggle="collapse-custom"';

	$collapse_toggler_before_toggler = isset($params['toggler_before_toggler']) ? $params['toggler_before_toggler'] : '';
	$collapse_toggler_after_toggler = isset($params['toggler_after_toggler']) ? $params['toggler_after_toggler'] : '';

?>
<div id='<?php echo $collapse_ID; ?>' class='collapse-custom <?php echo $collapse_class; ?>' <?php echo $collapse_attrs; ?>>
	<div class='collapse-custom-wrapper <?php echo $collapse_wrapper_class; ?>'>
		<?php echo isset($params['before_wrapper']) ? $params['before_wrapper'] : '';?>
		<div class="collapse-custom-action <?php echo $collapse_action_class; ?>">
		<?php
		$navbar_toggler = array(
			'class' => $collapse_toggler_class,
			'target' => $collapse_ID,
			'expanded' => $collapse_toggler_expanded,
			'label' => $collapse_toggler_label, 
			'type' => $collapse_toggler_type, /* default | animate */
			'effect' => $collapse_toggler_effect, /* rotate | collapsable | cross | asdot */ 
			'attrs' => $collapse_toggler_attrs,
			'data_toggle' => $collapse_toggler_data_toggle,
			'before_toggler' => $collapse_toggler_before_toggler,
			'after_toggler' => $collapse_toggler_after_toggler,
		);
		if( $collapse_use_toggler ) {
			WPBC_get_partial('navbar-toggler', $navbar_toggler);
		}
		?></div>
		<div class="collapse-custom-animate <?php echo $collapse_content_class; ?>">
			<?php

			echo isset($params['before_content']) ? $params['before_content'] : '';

			if(!empty($collapse_content)){
				echo do_shortcode($collapse_content);
			} else {

				$wp_nav_menu = array(
					'theme_location'  => 'primary',
					'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => 'div',
					'container_class' => 'flex-row-reverse',
					'container_id'    => 'navbar-collapse-'.$collapse_ID,
					'menu_class'      => 'navbar-nav',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(), 
					'before_menu'			=> '',
					'after_menu'			=> '',
				);

				$passed_wp_nav_menu = isset($params['wp_nav_menu']) ? $params['wp_nav_menu'] : array();
				$wp_nav_menu = array_merge( $wp_nav_menu, $passed_wp_nav_menu );
				// _print_code($wp_nav_menu);
				// wp_nav_menu( $wp_nav_menu );

				$nav_menus = array(); 
				$nav_menus[] = $wp_nav_menu; 
				$nav_menus = apply_filters('wpbc/filter/layout/'.$params['id'].'/nav_menus', $nav_menus); 
				foreach ($nav_menus as $key => $value) {
					wp_nav_menu( $value ); 
				} 

			}

			echo isset($params['after_content']) ? $params['after_content'] : '';

			?>
		</div>
		<?php echo isset($params['after_wrapper']) ? $params['after_wrapper'] : '';?>
	</div>
</div>