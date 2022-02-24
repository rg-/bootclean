<?php

function WPBC_get_font_family_styles(){  

	/*
	
		ej:

		$styles['CHILD_STYLE']['src'] = get_stylesheet_directory_uri() . '/fonts/theme/CHILD_STYLE.css'; 

	*/

	$styles = apply_filters('wpbc/filter/typography/font_family', array()); 
	return $styles;  
}

function WPBC_get_google_family_styles(){

	/*
	
		ej:

		$styles['google-font-name']['src'] = 'google-font-url'; 

	*/

	$google_family_styles = apply_filters('wpbc/filter/typography/google_family', array()); 
	return $google_family_styles;  
}

function WPBC_get_typography_tags(){

	$commons = array(

		'font-family-base' => "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'", 
 
 		'spacer' => '1', // NOT rem or px just number
		'font-size-base' => '1', // NOT rem or px just number

		'small-font-size' => '80%',

		'font-weight-base' => '400',
		'line-height-base' => '1.5',
 	
 		'display-font-family-base' => 'inherit',
		'display-font-weight' => '300',
		'display-line-height' => '1.2', 
 		
 		'headings-font-family-base' => 'inherit',
		'headings-font-weight' => '500',
		'headings-line-height' => '1.2',

	); 

	$commons['p-margin-top'] = '0';
	$commons['p-margin-bottom'] = ( number_format($commons['spacer']) / 2 ).'rem';
	$commons['display-margin-top'] = '0';
	$commons['display-margin-bottom'] = ( number_format($commons['spacer']) * 2 ).'rem';
	$commons['headings-margin-top'] = '0';
	$commons['headings-margin-bottom'] = ( number_format($commons['spacer']) / 2 ).'rem';

	$commons = apply_filters('wpbc/filter/typography/commons', $commons);

	$tags = array( 

		'body' => array(
			'font-family' => $commons['font-family-base'],
			'font-size' => $commons['font-size-base'].'rem',
			'font-weight' => $commons['font-weight-base'],
			'line-height' => $commons['line-height-base'],
		),

		'p' => array(
			'margin-top' => $commons['p-margin-top'],
			'margin-bottom' => $commons['p-margin-bottom'],
		),
		'.lead' => array(
			'font-size' => ( number_format($commons['font-size-base']) * 1.25 ).'rem',
			'font-weight' => $commons['display-font-weight'],
		),
		'small' => array(
			'font-size' => $commons['small-font-size'],
			'font-weight' => $commons['font-weight-base'],
		),
		'.small' => array(
			'font-size' => $commons['small-font-size'],
			'font-weight' => $commons['font-weight-base'],
		),

		'.display-1' => array(

			'font-family' => $commons['display-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 2 ).'rem',
			'font-weight' => $commons['display-font-weight'],
			'line-height' => $commons['display-line-height'],
			'margin-top' => $commons['display-margin-top'],
			'margin-bottom' => $commons['display-margin-bottom'],

			'responsive' => array(
				'sm' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 3 ).'rem',
				),
				'md' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 4 ).'rem',
				),
				'lg' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 5 ).'rem',
				),
				'xl' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 6 ).'rem',
				),
			)

		),
		'.display-2' => array(
			'font-family' => $commons['display-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 1.5 ).'rem',
			'font-weight' => $commons['display-font-weight'],
			'line-height' => $commons['display-line-height'],
			'margin-top' => $commons['display-margin-top'],
			'margin-bottom' => $commons['display-margin-bottom'],

			'responsive' => array(
				'sm' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 2.5 ).'rem',
				),
				'md' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 3.5 ).'rem',
				),
				'lg' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 4.5 ).'rem',
				),
				'xl' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 5.5 ).'rem',
				),
			)

		),
		'.display-3' => array(
			'font-family' => $commons['display-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 1.2 ).'rem',
			'font-weight' => $commons['display-font-weight'],
			'line-height' => $commons['display-line-height'],
			'margin-top' => $commons['display-margin-top'],
			'margin-bottom' => $commons['display-margin-bottom'],

			'responsive' => array(
				'sm' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 1.5 ).'rem',
				),
				'md' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 2.5 ).'rem',
				),
				'lg' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 3.5 ).'rem',
				),
				'xl' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 4.5 ).'rem',
				),
			)

		),
		'.display-4' => array(
			'font-family' => $commons['display-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 1 ).'rem',
			'font-weight' => $commons['display-font-weight'],
			'line-height' => $commons['display-line-height'],
			'margin-top' => $commons['display-margin-top'],
			'margin-bottom' => $commons['display-margin-bottom'],

			'responsive' => array(
				'sm' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 1 ).'rem',
				),
				'md' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 1.5 ).'rem',
				),
				'lg' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 2.5 ).'rem',
				),
				'xl' => array(
					'font-size' => ( number_format($commons['font-size-base']) * 3.5 ).'rem',
				),
			)

		), 

		'h1,.h1' => array(
			'font-family' => $commons['headings-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 2.5 ).'rem',
			'font-weight' => $commons['headings-font-weight'],
			'line-height' => $commons['headings-line-height'],
			'margin-top' => $commons['headings-margin-top'],
			'margin-bottom' => $commons['headings-margin-bottom'],
		), 

		'h2,.h2' => array(
			'font-family' => $commons['headings-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 2 ).'rem',
			'font-weight' => $commons['headings-font-weight'],
			'line-height' => $commons['headings-line-height'],
			'margin-top' => $commons['headings-margin-top'],
			'margin-bottom' => $commons['headings-margin-bottom'],
		), 

		'h3,.h3' => array(
			'font-family' => $commons['headings-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 1.75 ).'rem',
			'font-weight' => $commons['headings-font-weight'],
			'line-height' => $commons['headings-line-height'],
			'margin-top' => $commons['headings-margin-top'],
			'margin-bottom' => $commons['headings-margin-bottom'],
		), 

		'h4,.h4' => array(
			'font-family' => $commons['headings-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 1.5 ).'rem',
			'font-weight' => $commons['headings-font-weight'],
			'line-height' => $commons['headings-line-height'],
			'margin-top' => $commons['headings-margin-top'],
			'margin-bottom' => $commons['headings-margin-bottom'],
		),

		'h5,.h5' => array(
			'font-family' => $commons['headings-font-family-base'],
			'font-size' => ( number_format($commons['font-size-base']) * 1.25 ).'rem',
			'font-weight' => $commons['headings-font-weight'],
			'line-height' => $commons['headings-line-height'],
			'margin-top' => $commons['headings-margin-top'],
			'margin-bottom' => $commons['headings-margin-bottom'],
		), 

		'h6,.h6' => array(
			'font-family' => $commons['headings-font-family-base'],
			'font-size' => '1rem',
			'font-weight' => $commons['headings-font-weight'],
			'line-height' => $commons['headings-line-height'],
			'margin-top' => $commons['headings-margin-top'],
			'margin-bottom' => $commons['headings-margin-bottom'],
		),  

	);
	
	$arr_fix = array(
		'p','h1','h2','h3','h4','h5','h6','.display-1','.display-2','.display-3','.display-4'
	);
	foreach ($arr_fix as $fix) {
		$tags[$fix.':last-child'] = array(
			//'margin-bottom' => '0',
		);
	}

	$arr_headlines = array(
		'.h1','.h2','.h3','.h4','.h5','.h6','h1','h2','h3','h4','h5','h6','.display-1','.display-2','.display-3','.display-4'
	);

	$tags = apply_filters('wpbc/filter/typography', $tags);

	return $tags;

} 

/*

	Enqueue font-family css front and back end

*/

add_action( 'admin_enqueue_scripts', 'wpbc_font_family_styles', 0 );
add_action( 'wp_enqueue_scripts', 'wpbc_font_family_styles', 0 );
function wpbc_font_family_styles() {

	$styles = WPBC_get_font_family_styles();

	if(!empty($styles)){
		foreach ($styles as $key => $style) {
			
			wp_register_style( 'wpbc-font-family-'.$key, $style['src'], false, (!empty($style['version'])) ? $style['version'] : '' );
	  	wp_enqueue_style( 'wpbc-font-family-'.$key );

		}
	}

	$g_styles = WPBC_get_google_family_styles();
	if(!empty($g_styles)){ 

		// <link rel="preconnect" href="https://fonts.gstatic.com">

		wp_register_style( 'wpbc-google-family-gstatic', 'https://fonts.gstatic.com', false, null );
	  	wp_enqueue_style( 'wpbc-google-family-gstatic' );

		foreach ($g_styles as $key => $style) {
			
			wp_register_style( 'wpbc-google-family-'.$key, $style['src'], false, null );
	  	wp_enqueue_style( 'wpbc-google-family-'.$key );

		}
	}

} 

add_filter('style_loader_tag', 'wpbc_font_family_style_loader_tag', 10, 2);

function wpbc_font_family_style_loader_tag($html, $handle) {
    if ($handle === 'wpbc-google-family-gstatic') {
        $html = str_replace("rel='stylesheet'",
            "rel='preconnect'", $html);
        $html = str_replace("media='all'",
            "", $html);
    }
    return $html;
}

/*

	Enqueue font-family css on MCE editor

*/

add_action( 'admin_init', function(){ 

	$styles = WPBC_get_font_family_styles();

	if(!empty($styles)){
		foreach ($styles as $key => $style) {
			add_editor_style( $style['src'] ); 
		}
	} 

} ); 

add_filter('wpbc/filter/tiny_mce/custom_css', function($styles){

	//$styles .= '.mce-content-body { background:red; }';
	
	$tags = WPBC_get_typography_tags();
	if(!empty($tags)){
		foreach ($tags as $key => $value) {
			$styles .= $key.'{';
			foreach ($value as $k => $v) {
				if($k!='responsive'){
					$styles .= $k . ':' . $v . '!important;';
				}
			}
			$styles .= '}';
		}
	}
	return $styles;

},99,1);

/*

	Render style for front end styles

*/  

function wpbc_typography_make_style(){
	$root_breakpoint = BC_get_root_breakpoint(); 
	$styles = '';
  $tags = WPBC_get_typography_tags();
	if(!empty($tags)){
		foreach ($tags as $key => $value) {
			$styles .= $key.'{'."\n";
			foreach ($value as $k => $v) {
				if($k!='responsive'){
					$styles .= $k . ':' . $v . '!important;'."\n";
				}
			}
			$styles .= '}'."\n"."\n"; 

			foreach ($value as $k => $v) {
				if($k=='responsive'){
					if(!empty($v)){ 
						foreach ($v as $kr => $vr) {
							 
							$styles .= '@media (min-width: '.$root_breakpoint[$kr].'){'."\n";
							$styles .= $key.'{'."\n";
							if(!empty($vr)){ 
								foreach ($vr as $krs => $vrs) {
									$styles .= $krs . ':' . $vrs . '!important;'."\n";
								}
							}
							$styles .= '}'."\n";
							$styles .= '}'."\n"."\n"; 

						}
					} 
				}
			}

		}
	}
	return $styles;
}
 
function wpbc_typography() { 	 
	wp_enqueue_style( 'wpbc_typography', '?wpbc_typography=css', '', __scripts_version());
}
 
add_action( 'wp_enqueue_scripts', 'wpbc_typography', 0 );

function style_options( $wp ) {
    if( !empty( $_GET['wpbc_typography'] ) && $_GET['wpbc_typography'] == 'css' ) { 
    header('Content-type: text/css; charset=utf-8'); 
    echo wpbc_typography_make_style(); 
    exit;
    }
}
add_action( 'parse_request', 'style_options' );

/*

	Render style for back end styles

*/

add_action('admin_head','wpbc_flex_builder_admin_head', 100);
function wpbc_flex_builder_admin_head(){

	$tags = WPBC_get_typography_tags();
	if(!empty($tags)){
		?>
<style id="wpbc_flex_builder_admin_head">
<?php foreach ($tags as $key => $value) { ?>
[data-class-title="<?php echo $key; ?>"]{
<?php foreach ($value as $k => $v) { ?>
<?php if($k!='responsive'){ ?>
<?php echo $k; ?>: <?php echo $v; ?>!important;
<?php } ?>
<?php } ?>
}
<?php } ?>
</style>
		<?php
	}

}

/*

	Back end javascript for MCE editor

*/

add_action('acf/input/admin_footer','wpbc_flex_builder_admin_footer',999);
function wpbc_flex_builder_admin_footer(){ 

	?>
<script id="wpbc_flex_builder_admin_footer">

	(function($) { 

		acf.addAction('load_field', makeSectionTitle ); 
		acf.addAction('append_field', makeSectionTitle );  

		function makeSectionTitle(field){

			var el = field.$el;
			var target_layout = el.parent().parent().parent().parent();
			// heading
			if( el.hasClass('wpbc-section-heading') ){ 
				var current_var = el.find('select').val();
				var ele_to_change = target_layout.find('textarea.wpbc-section-title'); 
				if(current_var){
					ele_to_change.attr('data-class-title',current_var);
				} 
				field.on('change', 'select', function( e ){
		        e.preventDefault(); 
		        ele_to_change.attr('data-class-title',$(this).val());
		    }); 
			}
			// align
			if( el.hasClass('wpbc-section-align') ){ 
				var current_var = el.find('input[checked="checked"]').val(); 
				var ele_to_change = target_layout.find('textarea.wpbc-section-title'); 
				if(current_var){
					ele_to_change.css('text-align',current_var);
				}  
		    field.on('change', 'input', function( e ){
		        e.preventDefault(); 
		        ele_to_change.css('text-align',$(this).val());
		    }); 
			}
			// color
			if( el.hasClass('wpbc-section-color') ){ 
				var current_var = el.find('input[type="hidden"]').val(); 
				var ele_to_change = target_layout.find('textarea.wpbc-section-title');
				if(current_var){
					ele_to_change.css('color',current_var);
				}  
		    field.on('change', 'input', function( e ){
		        e.preventDefault(); 
		        ele_to_change.css('color',$(this).val());
		    });
			}

		}  

	})(jQuery); 

</script>
	<?php
}