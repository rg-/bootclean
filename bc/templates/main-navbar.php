<?php  
$brand = $theme_root['globals']['brand'];
$main_navbar = $theme_root['main-navbar']; 
$affix = isset($theme_root['main-navbar']['affix']) ? $theme_root['main-navbar']['affix'] : false;	
BC_get_component('navbar', array(
	'id'=> 'main-navbar', 
	'class'=> isset($main_navbar['class']) ? $main_navbar['class'] : 'navbar-sizes navbar-expand-lg bg-primary navbar-dark navbar-expand-aside collapse-right',
	'container_class' => isset($main_navbar['container_class']) ? $main_navbar['container_class'] : 'container',
	'brand'=> '<img class="navbar-brand-img" src="'.$brand['logo']['src'].'" alt="'.$brand['logo']['alt'].'"/>',
	'brand-href'=>'http://localhost/_www/_BC_builder_v4/_test_one/',
	'affix'=> $affix,
	'navbar-nav'=> $theme_root['globals']['navbar-nav']['_main-nav']
));  
?>
<?php

/* OR Just HTML ...

<nav  id="main-navbar" data-toggle="nav-affix" data-affix-position="top" data-affix-simulate="" data-affix-scrollify="1" data-affix-breakpoint="md" class="navbar navbar-sizes navbar-expand-lg navbar-dark bg-transparent navbar-expand-aside collapse-right">
	<div class="container">
		<a class="navbar-brand" href="#brand-href"><img class="navbar-brand-img" src="images/theme/bootclean-logo-color-alt-@2.png" alt=""/></a>
		<button class="navbar-toggler animate collapsable" type="button" data-toggle="collapse" data-target="#main-navbar-navbar-collapse" aria-controls="#main-navbar-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="custom-toggler"><span class="navbar-toggler-icon"></span></span>
		</button>
		<div class="collapse navbar-collapse flex-row-reverse" id="main-navbar-navbar-collapse" data-nav-target="main-navbar">
			<ul class="navbar-nav">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown" data-hover-respond="lg" >Home</a><div class="dropdown-menu animated bounceInDown" data-animated-respond="lg"><span class="dropdown-item-text"><small>Animated Dropdown with bounceInDown effect</small></span><a class="dropdown-item" href="/">Go home</a></div></li><li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="components.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown" data-hover-respond="lg" >Components</a><div class="dropdown-menu animated bounceInDown" data-animated-respond="lg"><span class="dropdown-item-text"><small>Bootstrap Components</small></span><a class="dropdown-item" href="components.php?part=alerts">Alerts</a><a class="dropdown-item" href="components.php">More...</a></div></li>
			</ul>
		</div>
	</div>
</nav>
<?php

*/

?>