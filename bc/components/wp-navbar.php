<?php 
	/*
	
	$params are passed when using this via:
	
		WPBC_get_component
		WPBC_get_partial
		
		shortcodes
		
		etc, no matter from where you call this components, using the correct params will produce the correct component.
	
	*/
	// reduce names:
	$_p = $params; 
	$is_main = isset($_p['is_main']) ? true : false;
	// TODO, a way to sanitize all posible wrong passed values ?? This should be passed not by stupids but....
	
	// $params passed should be an array, like defaults: 
	$_uid = uniqid();
	$defauls = array( 
		
		'is_main' => $is_main,
		
		'id' => 'wp-navbar-'.$_uid,
		'class' => 'navbar navbar-dark bg-primary',
		'container_class' => 'container',
		 
		
		'before_nav' => '',
		'after_nav' => '',
		
		'affix' => false,
		'affix_defaults' => array(
			'position' => 'top', /* top / bottom */
			'simulate' => true, /* top / bottom / false ((default))  */
			'scrollify' => false, /* true / false */
			'breakpoint' => 'sm' /* xs / sm / md / lg / xl */
		),
		
		'aside_expand' => array(
			'target' => '.aside-expand-content',
		),
		
		// 'navbar-nav' => array(), 
		
		'navbar_brand' => array(
			'image' => '',
			'image_class' => 'navbar-brand-img',
			'image_alt' => '',
			'class' => 'd-flex navbar-brand',
			'title' => get_bloginfo('name'),
			'href' => get_bloginfo('url'),
			'attrs' => '',
			// 'sizes' => true, // Use this stead of styles to make responsive from css settings
			//'styles' => array(
				//'xs' => 'width: auto; height: 100px;' 
			//)
		),
		
		'navbar_toggler' => array(
			'class' => '',
			'target' => $_uid.'-navbar-collapse',
			'expanded' => false,
			'label' => __('Toggle navigation', 'bootclean'), 
			'type' => 'default', /* default | animate */
			'effect' => '' /* rotate | collapsable | cross | asdot */ 
		),
		
		'wp_nav_menu' => array(
			'theme_location'  => 'primary',
			'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
			'container'       => 'div',
			'container_class' => 'collapse navbar-collapse flex-row-reverse',
			'container_id'    => $_uid.'-navbar-collapse',
			'menu_class'      => 'navbar-nav',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(),
		)
	);
	
	$_p = array_replace_recursive($defauls, $_p);  
	
	/*
		Let child themes filter params
	*/
	$_p = apply_filters('WPBC_component_defaults__navbar', $_p);
	/*
		Also filter component by id, so if you use id => 'my-super-navbar'
		You can apply a filter called "WPBC_component_defaults__navbar_my-super-navbar"
		and change parameters passed.
	*/
	$_p = apply_filters('WPBC_component_defaults__navbar_'.$_p['id'], $_p);
	 
	// ID // TODO, see how to deal when no id on the toggle collapse target
	$div_attrs = ' id="'.$_p['id'].'"'; 
	// CLASS 
	if( !empty($_p['navbar_brand']['styles']) ){ 
		$_p['class'] = $_p['class'] . ' navbar-custom-sizes '; 
	}
	if( !empty($_p['navbar_brand']['sizes']) ){
		$_p['class'] = $_p['class'] . ' navbar-sizes ';
	} 
	$div_attrs .= ' class="'.$_p['class'].'"'; 
	// AFFIX
	$div_attrs .= WPBC_get_navbar_affix_attrs($_p); 
	
	$div_attrs .= ' data-aside-expand-target="'. $_p['aside_expand']['target'] .'"';
	
?>
<nav <?php echo $div_attrs; ?>>
	
	<?php echo $_p['before_nav']; ?>
	
	<div class="<?php echo $_p['container_class']; ?> aside-expand-content">
	
		<?php
		if(isset($_p['navbar_brand'])) {
			WPBC_get_partial('navbar-brand', $_p['navbar_brand']);
		}
		?> 
		
		<?php
		if(isset($_p['navbar_toggler'])) { 
			WPBC_get_partial('navbar-toggler', $_p['navbar_toggler']);
		}
		?> 
		
		<?php
		// TODO, or not? what happend with "data-nav-target" ??
		if(isset($_p['wp_nav_menu'])) { 
			wp_nav_menu( $_p['wp_nav_menu'] ); 
		}
		?>
	
	</div>
	
	<?php echo $_p['after_nav']; ?>
	
</nav>
<!-- end navbar header --> 