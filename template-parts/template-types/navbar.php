<?php


/*

	navbar 
	
	There are two ways to build a navbar, the one used by WP, ant the one used without WP.
	
	Without WP
		
		Needs /components, /partials, and/or $root settings.
		Will output the entire <nav> tag, not just the menu.
		
		Example:
		
		// Get $theme_root global settings (array)
		$theme_root = BC_theme_root();
		// If main-navbar is enabled, use it.
		if( !empty( $theme_root['main-navbar']['enabled'] )) { 
			// Call to the /component template
			BC_template('main-navbar'); 
		}

*/ 
?>


<nav id="main-navbar" class="navbar navbar-sizes navbar-expand-lg navbar-dark bg-secondary">
	
	<div class="container">
		
		<a class="navbar-brand" href="#brand-href"><img class="navbar-brand-img" src="<?php echo THEME_URI; ?>/images/theme/bootclean-logo-color-alt-@2.png" alt=""/></a>
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar-navbar-collapse" aria-controls="#main-navbar-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="custom-toggler"><span class="navbar-toggler-icon"></span></span>
		</button>
		
		<?php
		wp_nav_menu( array(
			'theme_location'  => 'primary',
			'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
			'container'       => 'div',
			'container_class' => 'collapse navbar-collapse flex-row-reverse',
			'container_id'    => 'main-navbar-navbar-collapse',
			'menu_class'      => 'navbar-nav',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(),
		) );
		?>
		
	</div>
	
</nav>