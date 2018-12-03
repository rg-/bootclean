<!DOCTYPE html> 

<html <?php language_attributes(); ?>>
 	
 	<head>
	  
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	    
		<?php // get_template_part_layouts('wp_head_favicons'); ?>
		
		<?php do_action('bc_admin_mainteneance_title'); ?>

		<?php do_action('bc_admin_mainteneance_style'); ?>

		<?php do_action('bc_admin_mainteneance_head'); ?>
		
	</head>
	<!-- head END -->
 
 
	<body <?php body_class('coming-soon'); ?>>
		
		<?php echo do_shortcode('[get__bc_admin_mainteneance_html]'); ?>
		
		<?php do_action('bc_admin_mainteneance_script'); ?>

	</body>
	
</html>