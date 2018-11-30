<!DOCTYPE html>
<html lang="<?php echo isset($theme_root['html-lang']) ? $theme_root['html-lang'] : 'en'; ?>">
	<head>
	
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
		
		<?php BC_template('head-seo'); ?>
		
		<!--[if lt IE 9]>
			<script src="js/html5shiv/html5shiv.min.js"></script>
		<![endif]-->
		
		<?php 
		
		$css_root = WPBC_get_ob_contents('css/root.css');  
		$css = BC_css_parser($css_root);
		if(isset($css[":root"])){
			
			$body_data_config = json_encode($css[":root"],true);
			
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
			?>
			<script>
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
			</script>
			<?php
			
		}
		?>
		
		<?php BC_get_head_styles(); ?>
		
		<?php BC_get_partial('head-close'); ?>
	</head>
	<?php 
	/*
	
		#body-loader and class="loading" on body, are in conjuntion, see js (globals.js)
		
		Posible body classes for extra js/css addons
		
		"detect-scroll" -> Will activate add/remove styles based on scrolling. Ej: scrolling-down added class to body. 
		
	*/ 
	?>
	<body class="loading detect-scroll <?php BC_get_body_class(); ?>" data-config='<?php echo $body_data_config; ?>' <?php BC_get_body_data(); ?>>

	<script>var a = document.body; a.classList ? a.classList.add('loading') : a.className += ' loading';g=document.createElement('div'); g.setAttribute("id", "body-loader"); document.body.insertBefore(g,document.body.childNodes[0]);</script>
	
	<div id="main-content" class="content-wrap">
		<?php if( !empty( $theme_root['main-navbar']['enabled'] )) { BC_template('main-navbar'); } ?>
		<div id="main-content-wrap">