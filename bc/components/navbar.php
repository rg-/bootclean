<?php
	
	// $params passed..
	/*
	
	data-affix-simulate -> top / bottom /false ((default))
	
	*/
	$nav_ID = isset($params['id']) ? $params['id'] : 'main-navbar';
	$div_attrs = ' id="'.$params['id'].'"';
	  
	if( isset($params['affix']) && false != $params['affix'] ){
		//echo $params['affix']['position']; 
		$div_attrs .= ' data-toggle="nav-affix"';
		$div_attrs .= isset($params['affix']['position']) ? ' data-affix-position="'.$params['affix']['position'].'"' : ' data-affix-position="top"';
		$div_attrs .= isset($params['affix']['simulate']) ? ' data-affix-simulate="'.$params['affix']['simulate'].'"' : ' data-affix-simulate="true"';
		$div_attrs .= isset($params['affix']['scrollify']) ? ' data-affix-scrollify="'.$params['affix']['scrollify'].'"' : ' data-affix-scrollify="false"';
		$div_attrs .= isset($params['affix']['breakpoint']) ? ' data-affix-breakpoint="'.$params['affix']['breakpoint'].'"' : ' data-affix-breakpoint="sm"';
		
		$div_attrs .= isset($params['affix']['addclass']) ? ' data-affix-addclass="'.$params['affix']['addclass'].'"' : '';
		$div_attrs .= isset($params['affix']['removeclass']) ? ' data-affix-removeclass="'.$params['affix']['removeclass'].'"' : '';
	}
	
	$div_class = isset($params['class']) ? 'navbar '.$params['class'] : 'navbar';
	
?>
<nav <?php echo $div_attrs; ?> class="<?php echo $div_class; ?>">
	
	<?php echo isset($params['before_nav']) ? $params['before_nav'] : ''; ?>
	
	<div class="<?php echo isset($params['container_class']) ? $params['container_class'] : ''; ?>">
		
		<a class="navbar-brand" href="<?php echo isset($params['brand-href']) ? $params['brand-href'] : ''; ?>"><?php echo isset($params['brand']) ? $params['brand'] : 'bootclean'; ?></a>
		
		<?php
		$navbar['target'] = $nav_ID.'-navbar-collapse';
		$navbar['expanded'] = 'false';
		$navbar['label'] = 'Toggle navigation';
		$navbar['type'] = 'animate'; // default | animate
		$navbar['effect'] = 'collapsable'; /* rotate | collapsable | cross | asdot */
		BC_get_partial('navbar-toggler', $navbar);
		?>
		
		<div class="collapse navbar-collapse flex-row-reverse" id="<?php echo $navbar['target']; ?>" data-nav-target="<?php echo $nav_ID;?>">
			<?php
			$navbar_nav = isset($params['navbar-nav']) ? $params['navbar-nav'] : '';
			$navbar_nav_class = isset($params['navbar-nav']['class']) ? $params['navbar-nav']['class'] : 'navbar-nav';
			if($navbar_nav){ ?>
			<ul class="<?php echo $navbar_nav_class; ?>">
				<?php  
				BC_get_partial('navbar-nav', $navbar_nav);
				?>
			</ul>
			<?php } ?>
		</div>
	
	</div>
	
	<?php echo isset($params['after_nav']) ? $params['after_nav'] : ''; ?>
	
</nav>
<!-- end navbar header --> 