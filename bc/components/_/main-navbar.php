<?php
	
	// $params passed..
	/*
	
	data-affix-simulate -> top / bottom /false ((default))
	
	*/
	$nav_ID = isset($params['id']) ? $params['id'] : 'main-navbar';
	$div_attrs = ' id="'.$params['id'].'"';
	  
	if( isset($params['affix']) ){
		//echo $params['affix']['position']; 
		$div_attrs .= ' data-toggle="nav-affix"';
		$div_attrs .= isset($params['affix']['position']) ? ' data-affix-position="'.$params['affix']['position'].'"' : 'data-affix-position="top"';
		$div_attrs .= isset($params['affix']['simulate']) ? ' data-affix-simulate="'.$params['affix']['simulate'].'"' : 'data-affix-simulate="true"';
		$div_attrs .= isset($params['affix']['scrollify']) ? ' data-affix-scrollify="'.$params['affix']['scrollify'].'"' : 'data-affix-scrollify="false"';
		$div_attrs .= isset($params['affix']['breakpoint']) ? ' data-affix-breakpoint="'.$params['affix']['breakpoint'].'"' : 'data-affix-breakpoint="sm"';
	}
	
	$div_class = isset($params['class']) ? 'navbar '.$params['class'] : 'navbar';
?>
<nav <?php echo $div_attrs; ?> class="<?php echo $div_class; ?>">
	
	<div class="container">
		
		<a class="navbar-brand" href="./"><?php echo isset($params['brand']) ? $params['brand'] : 'bootclean'; ?></a>
		
		<?php
		$navbar['target'] = $nav_ID.'-navbar-collapse';
		$navbar['expanded'] = 'false';
		$navbar['label'] = 'Toggle navigation';
		$navbar['type'] = 'animate'; // default | animate
		$navbar['effect'] = 'collapsable'; /* rotate | collapsable | cross | asdot */
		BC_get_partial('navbar-toggler', $navbar);
		?>

		<div class="collapse navbar-collapse flex-row-reverse" id="<?php echo $navbar['target']; ?>" data-nav-target="<?php echo $nav_ID;?>">
			<ul class="navbar-nav">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover-respond="lg">Not hover</a>
					<div class="dropdown-menu animated zoomInUp">
						<a class="dropdown-item" href="media-object.php">But animated</a>
					</div>
				</li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown" data-hover-respond="lg">Hover Dropdown</a>
					<div class="dropdown-menu animated zoomInDown" data-animated-respond="xl">
						<a class="dropdown-item" href="typography.php">Typography</a>
						<a class="dropdown-item" href="code.php">Code</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="images.php">Images</a>
						<a class="dropdown-item" href="tables.php">Tables</a>
						<a class="dropdown-item" href="figures.php">Figures</a>
					</div>
				</li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Components</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="alerts.php">Alerts</a>
						<a class="dropdown-item" href="badge.php">Badge</a>
						<a class="dropdown-item" href="breadcrumb.php">Breadcrumb</a>
						<a class="dropdown-item" href="buttons.php">Buttons</a>
						<a class="dropdown-item" href="button-group.php">Button group</a>
						<a class="dropdown-item" href="card.php">Card</a>
						<a class="dropdown-item" href="carousel.php">Carousel</a>
						<a class="dropdown-item" href="collapse.php">Collapse</a>
						<a class="dropdown-item" href="dropdowns.php">Dropdowns</a>
						<a class="dropdown-item" href="forms.php">Forms</a>
						<a class="dropdown-item" href="input-group.php">Input group</a>
						<a class="dropdown-item" href="jumbotron.php">Jumbotron</a>
						<a class="dropdown-item" href="list-group.php">List group</a>
						<a class="dropdown-item" href="modal.php">Modal</a>
						<a class="dropdown-item" href="navs.php">Navs</a>
						<a class="dropdown-item" href="navbar.php">Navbar</a>
						<a class="dropdown-item" href="pagination.php">Pagination</a>
						<a class="dropdown-item" href="popovers.php">Popovers</a>
						<a class="dropdown-item" href="progress.php">Progress</a>
						<a class="dropdown-item" href="tooltips.php">Tooltips</a>
						<a class="dropdown-item" href="utilities.php">Utilities</a>
					</div>
				</li>
				<li class="nav-item"><a class="nav-link" href="credits.php">Credits</a></li>
			</ul>
		</div>
		
	</div>
</nav>
<!-- end navbar header --> 