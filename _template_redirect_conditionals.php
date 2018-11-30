<!-- NOT USED ?? --><!DOCTYPE html> 
<html <?php language_attributes(); ?>>
  <head>
	  
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> 
	
    <title><?php wp_title('|', true, 'right'); ?></title>
    
	<?php // get_template_part_layouts('wp_head_favicons'); ?>
	
	<?php do_action('bc_admin_mainteneance_style'); ?>
		
	</head>
	<!-- head END -->
 
 
	<body <?php body_class('coming-soon'); ?>>
		
		<?php echo do_shortcode('[get__bc_admin_mainteneance_html]'); ?>
		 
	</body>
	
</html>