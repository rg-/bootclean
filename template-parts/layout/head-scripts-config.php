<?php


$css_root = WPBC_get_ob_contents( WPBC_root_css() );
if(!empty($css_root)){ 
	$css = BC_css_parser($css_root);
	if(!empty($css)){

		$css = str_replace(' ', '', $css);
		
		$primary = $css[":root"]["--primary"];
		$secondary = $css[":root"]["--secondary"];
		$success = $css[":root"]["--success"];
		$info = $css[":root"]["--info"];
		$warning = $css[":root"]["--warning"];
		$danger = $css[":root"]["--danger"];
		$light = $css[":root"]["--light"];
		$dark = $css[":root"]["--dark"];
		
		$xs = $css[":root"]["--breakpoint-xs"];
			$xs = str_replace('px', '', $xs);
		$sm = $css[":root"]["--breakpoint-sm"];
			$sm = str_replace('px', '', $sm);
		$md = $css[":root"]["--breakpoint-md"];
			$md = str_replace('px', '', $md);
		$lg = $css[":root"]["--breakpoint-lg"];
			$lg = str_replace('px', '', $lg);
		$xl = $css[":root"]["--breakpoint-xl"];
			$xl = str_replace('px', '', $xl);


		$test = array(
			//array(
				"layout" => array(
					"main_navbar"	=> "#main-navbar",
					"main_header"	=> "#main-page-header",
					"main_content"	=> "#main-content",
					"main_footer"	=> "#main-footer"
				),
			//),
			//array(
				"scheme" => array(
					"primary" => $primary,
					"secondary" => $secondary,
					"success" => $success,
					"info" => $info,
					"warning" => $warning,
					"danger" => $danger,
					"light" => $light,
					"dark" => $dark,
				),
			//),
			//array(
				"breakpoints" => array(
					"xs" => $xs,
					"sm" => $sm,
					"md" => $md,
					"lg" => $lg,
					"xl" => $xl,
				),
			//),
		);
		$test = json_encode($test);  
		?>
<script>var bc_config = <?php echo $test; ?>;</script>
		<?php
		/*

	OLD JS part:

	var bc_config = { 
	layout: {
		main_navbar: '#main-navbar',
		main_header: '#main-page-header',
		main_content: '#main-content',
		main_footer: '#main-footer'
	},
	scheme: {
		primary: '<?php echo $primary; ?>',
		secondary: '<?php echo $secondary; ?>',
		success: '<?php echo $success; ?>',
		info: '<?php echo $info; ?>',
		warning: '<?php echo $warning; ?>',
		danger: '<?php echo $danger; ?>',
		light: '<?php echo $light; ?>',
		dark: '<?php echo $dark; ?>'
	},
	breakpoints: {
		xs: '<?php echo $xs; ?>',
		sm: '<?php echo $sm; ?>',
		md: '<?php echo $md; ?>',
		lg: '<?php echo $lg; ?>',
		xl: '<?php echo $xl; ?>'
	}
}; 

		*/
	} 
}