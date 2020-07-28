<?php


add_action( 'login_head', function(){

	$args = array(
		'login_brand' => array(
			'background-image' => THEME_URI.'/images/theme/bootclean-logo-color-@2.png',
			'background-size' => '300px auto',
			'width' => '300px',
			'height' => '70px',
		)
	);

	$args = apply_filters('wpbc/filter/custom_login/args', $args); 

?>

<style>
	
	body{	}

	.login h1 a{
		background-image: url(<?php echo $args['login_brand']['background-image']; ?>) !important; 
		background-size: <?php echo $args['login_brand']['background-size']; ?>; 
		width: <?php echo $args['login_brand']['width']; ?>; 
		height: <?php echo $args['login_brand']['height']; ?>; 
		display:block;
	}

	.login #backtoblog a, .login #nav a, a{
		
	}

</style>

<?php

} );