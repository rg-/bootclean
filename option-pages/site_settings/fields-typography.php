<?php


/*

	This is now going anywhere.... :()

*/

/* ------------------------------------------- */ 
/* ------------------------------------------- */ 
/* TYPOGRAPHY SITE SETTINGS */ 
/* ------------------------------------------- */ 
/* ------------------------------------------- */ 

/* INSERT TAB AND FIELDS INTO SETTINGS GROUP BY FILTER */

add_filter('wpbc/filter/theme_settings/fields', 'wpbc_theme_settings__typography_tab', 0, 1);  

function wpbc_theme_settings__typography_tab($fields){ 

	$fields[] = WPBC_acf_make_tab_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_tab',
			'label' => '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M2.5,4v3h5v12h3V7h5V4H2.5z M21.5,9h-9v3h3v7h3v-7h3V9z"/></g></g></g></svg> '._x('Typography','bootclean'), 
		)
	); 

	$fields[] =  WPBC_acf_make_subtitle_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_subtitle',
			'label' => '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M2.5,4v3h5v12h3V7h5V4H2.5z M21.5,9h-9v3h3v7h3v-7h3V9z"/></g></g></g></svg> '._x('Typography Options','bootclean'),  
		)
	); 

	$fields[] =  WPBC_acf_make_message_field(
		array( 
			'key' => 'field_wpbc_theme_settings__typography_message',
			'label' => '',
			'message' => 'Configure here the fonts enqueued to the site. You can combine Custom and Google fonts.',  
		)
	); 

	/* ADD NEW FILTER FOR ONLY THESE GROUP OF FIELDS */

	$fields = apply_filters('wpbc/filter/theme_settings/fields/typography',$fields);

	return $fields;

}  

/* USE THE NEW FILTER TO ADD THE REST OF FIELDS INTO THIS TAB/GROUP */

include('fields-typography/custom_fonts.php');
include('fields-typography/google_fonts.php'); 

include('fields-typography/settings_fonts.php'); 

/* ------------------------------------------- */ 
/* ------------------------------------------- */ 
/* FRONT END FILTERS/ACTIONS FOR THIS SETTINGS */ 
/* ------------------------------------------- */ 
/* ------------------------------------------- */ 

add_filter('wpbc/body/class', function ($body_class){
	$typography_custom_fonts = WPBC_get_theme_settings('typography_custom_fonts');
	if(!empty($typography_custom_fonts)){
		$body_class .= ' using-custom-fonts';
	} 
	return $body_class;
}, 10, 1); 

add_action('wp_head', function(){
	$typography_custom_fonts = WPBC_get_theme_settings('typography_custom_fonts');
	if(!empty($typography_custom_fonts)){
		?>
<style>
	<?php foreach ($typography_custom_fonts as $key => $value) {

		$sanitize_name = sanitize_title($value['font-family']);

		?>
		@font-face {
	    font-family: <?php echo $value['font-family']; ?>;
	    <?php if(!empty($value['src-eot'])) ?>
	    src: url('<?php echo $value['src-eot']; ?>');
	  	<?php } ?>
	  	<?php
	  	$srcs = array();
	  	if(!empty($value['src-eot'])){
	  		$srcs[] = "url('".$value['src-eot']."?#iefix') format('embedded-opentype')";
	  	}
	  	if(!empty($value['src-woff'])){
	  		$srcs[] = "url('".$value['src-woff']."') format('woff')";
	  	}
	  	if(!empty($value['src-woff2'])){
	  		$srcs[] = "url('".$value['src-woff2']."') format('woff2')";
	  	}
	  	if(!empty($value['src-ttf'])){
	  		$srcs[] = "url('".$value['src-ttf']."') format('ttf')";
	  	}
	  	if(!empty($value['src-ttf'])){
	  		$srcs[] = "url('".$value['src-svg']."#".$sanitize_name."') format('svg')";
	  	} 
	  	$srcs_str = implode (", ", $srcs);
	  	?>
	    
	    src: <?php echo $srcs_str; ?>;
	    font-weight: <?php echo $value['font-weight']; ?>;
	    font-style: <?php echo $value['font-style']; ?>;
	    font-display: swap;
		}
		.font-<?php echo $sanitize_name; ?>{
			font-family: '<?php echo $value['font-family']; ?>', <?php echo $value['font-generic-family']; ?>; 
			font-weight: <?php echo $value['font-weight']; ?>;
		  font-style: <?php echo $value['font-style']; ?>;
		}
		<?php

		// TODO PRIMARY??
		$using_as_primary = false;
		if($using_as_primary){
			?>
			body.using-custom-fonts{
				font-family: '<?php echo $value['font-family']; ?>', <?php echo $value['font-generic-family']; ?>; 
				font-weight: <?php echo $value['font-weight']; ?>;
			  font-style: <?php echo $value['font-style']; ?>;
			}
			<?php
		}

	}?>
</style>
<?php 
}, 0); 

add_action('wpbc/layout/start', function(){

	$typography_custom_fonts = WPBC_get_theme_settings('typography_custom_fonts');

	//echo "ESTOY EN QUE HAGO CON EL PRIMARY PARA EL BODY, LO MEJOR VA A SER USAR OTRO LUGAR DONDE SETEAR EL BODY, TITLES, P, SMALL, BTN, INPUTS... Y YA AHI USAR ESO DE LOS TABS RESPONSIVE Y METER TAMAÑOS EN PX O REM TIPO ONDA EL ELEMENTOR.<BR>";

	//echo "LO OTRO ES ARMAR EL tYPOGRAPHY SETTINGS CON ACCORDIONES ?? <BR>";

	//echo "y lo OTRO ES USAR EN MENSAJE GENERICO MOSTRANDO SI SE ESTAN USANDO FONTS CUSTOM O NO";

	_print_code($typography_custom_fonts); 

 

}, 40 );