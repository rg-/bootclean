<?php

function WPBC_get_theme_settings_custom_login_default_args(){
	$args = array(

		'body' => array(
			'background-color' => '#ffffff',
		),

		'login_brand' => array(
			'background-image' => THEME_URI.'/images/theme/bootclean-logo-color-@2.png',
			'background-size' => '240px auto',
			'width' => '240px',
			'height' => '70px',
		),

		'btn' => array(
			'primary-color' => '#007cba',
			'primary-border' => '#007cba',
			'primary-background' => '#fff',
		),

	);

	$args = apply_filters('wpbc/filter/custom_login/default_args', $args); 
	return $args;
}

add_action( 'login_head', function(){

	$args = WPBC_get_theme_settings_custom_login_default_args(); 
	// _print_code($args);
?>

<style>
	
	body{	
		background-color: <?php echo $args['body']['background-color']; ?>;
	}

	.login h1 a{
		background-image: url(<?php echo $args['login_brand']['background-image']; ?>) !important; 
		background-size: <?php echo $args['login_brand']['background-size']; ?>; 
		width: <?php echo $args['login_brand']['width']; ?>; 
		height: <?php echo $args['login_brand']['height']; ?>; 
		display:block;
	}

	.login #backtoblog a, .login #nav a, a{
		
	}

	.wp-core-ui .button-primary{
		background: <?php echo $args['btn']['primary-background']; ?>;
    border-color: <?php echo $args['btn']['primary-border']; ?>;
    color: <?php echo $args['btn']['primary-color']; ?>;
	}

</style>

<?php

} );

add_filter( 'login_headerurl', function($login_headerurl){
	return get_bloginfo('url');
} );

add_filter( 'login_headertext', function($login_headertitle){
	return __('Back to','bootclean').' '.get_bloginfo('name');
} );