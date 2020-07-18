<?php

/*

	https://codemirror.net/doc/manual.html
	
	https://github.com/ptasker/acf-code-field/blob/master/acf-code-field-v5.php
	
	
	wp_enqueue_style( "codemirror-curr-style-{$field['theme']}", "{$dir}js/" . ACFCF_CODEMIRROR_VERSION . "/theme/{$field['theme']}.css" );
	

'choices'      => array(
	'htmlmixed'               => __( "HTML Mixed", 'acf' ),
	'javascript'              => __( "JavaScript", 'acf' ),
	'text/html'               => __( "HTML", 'acf' ),
	'css'                     => __( "CSS", 'acf' ),
	'application/x-httpd-php' => __( "PHP", 'acf' ),
),

// Apply into ACF textareas by field name
  
*/

$use_wpbc_code_mirror = apply_filters('wpbc/filter/code_mirror/installed', 1);

if(!$use_wpbc_code_mirror) return;


add_filter('wpbc/filter/dashboard/actived_addons',function($addon){

		$addon[] = array(
			'name' => 'code_mirror',
			'title' => __('Code Mirror for fields','bootclean'), 
		);

		return $addon;
	},10,1);

$code_mirror_fields_apply = array(
	'bc_default_code_header' => 'md',
	'bc_default_code_footer' => 'md',
	'raw_html_row_html' => 'md',
	'html_code' => 'md', 

	// 'r_html_code' => 'md',
);

$code_mirror_fields_apply = apply_filters('WPBC_addons__codemirror_fields', $code_mirror_fields_apply);

add_action( 'acf/load_field', function($field) use($code_mirror_fields_apply){
	
	$use_codemirror = false;
	
	$classes = $field['wrapper']['class'];
	$test   = "html_code";
	// test for "html_code" class on field
	if( strpos( $classes, $test ) !== false) {
		$use_codemirror = true;
	}

	// test for any of the field names on te filtereable array above
	if ( array_key_exists( $field['name'] , $code_mirror_fields_apply) ){
		$use_codemirror = true;
	}
	
	if($field['type'] != 'textarea'){
		$use_codemirror = false;
	}
	
	if( $use_codemirror ){  
		$size = !empty($code_mirror_fields_apply[$field['name']]) ? $code_mirror_fields_apply[$field['name']] : 'md';

		$field['wrapper']['class'] = $field['wrapper']['class'] . ' codemirror-custom-field '.$size.' '; 
	}
	
	return $field;
}, 99, 1 );


function WPBC_addons__codemirror_styles(){
	if(is_user_logged_in() && current_user_can( 'manage_options' )){
	?><style>
		.codemirror-btn-change-size{
			cursor:pointer;
		}
		.codemirror-btn-change-size:focus{
			outline:0;
			box-shadow:none;
		}
		.codemirror-btn-change-size.current{
			color:var(--primary)!important;
			text-decoration:underline;
		}
		.CodeMirror-fullscreen{
			z-index: 99999;
		}
		.codemirror-custom-field.sm .CodeMirror{
			height: auto;
		}
		.codemirror-custom-field.md .CodeMirror{
			height: 100px;
		}
		.codemirror-custom-field.lg .CodeMirror{
			height: 200px;
		}
		.codemirror-custom-field.xlg .CodeMirror{
			height: 300px;
		}
		.acf-table {
			table-layout: fixed;
		}
		
		.CodeMirror-wrap{
			opacity:.8;
			border:1px solid transparent;
		}
		.CodeMirror-focused{
			opacity:1;
			border-color:var(--primary);
		}
	</style><?php
	}
}

add_action('wp_head','WPBC_addons__codemirror_styles', 9999);
add_action('admin_head','WPBC_addons__codemirror_styles');

global $WPBC_codemirror_args;
$WPBC_codemirror_args = array(
	'theme' => 'monokai' // night
);

function WPBC_codemirror_enqueue_scripts(){
	global $WPBC_codemirror_args;
	
	if( is_admin() || ( is_user_logged_in() && current_user_can( 'manage_options' ) ) ){
		 
	
	if ( version_compare( $GLOBALS['wp_version'], '4.9', '>=' ) ) {
		wp_enqueue_script( 'wp-codemirror' );
		wp_enqueue_style( 'wp-codemirror' );
		wp_enqueue_script( 'csslint' );
		wp_enqueue_script( 'jshint' );
		wp_enqueue_script( 'jsonlint' );
		wp_enqueue_script( 'htmlhint' );
		wp_enqueue_script( 'htmlhint-kses' );
		//Alias wp.CodeMirror to CodeMirror
		wp_add_inline_script( 'wp-codemirror', 'window.CodeMirror = wp.CodeMirror;' );
		
		$dir = THEME_URI."/bc/core/addons/bc-codemirror";
		
		wp_enqueue_style( 'theme-codemirror-css', $dir."/theme/".$WPBC_codemirror_args ['theme'].".css" );
		
		wp_enqueue_script( 'fullscreen-codemirror-js', $dir."/addon/display/fullscreen.js" );
		wp_enqueue_style( 'fullscreen-codemirror-css', $dir."/addon/display/fullscreen.css" );
		
		wp_enqueue_script( 'acf-input-code-field-codemirror-css', $dir."/mode/css/css.js" );
		wp_enqueue_script( 'acf-input-code-field-codemirror-js', $dir."/mode/javascript/javascript.js" );
		wp_enqueue_script( 'acf-input-code-field-codemirror-xml', $dir."/mode/xml/xml.js" );
		wp_enqueue_script( 'acf-input-code-field-codemirror-clike', $dir."/mode/clike/clike.js" );
		wp_enqueue_script( 'acf-input-code-field-codemirror-php', $dir."/mode/php/php.js" );
		wp_enqueue_script( 'acf-input-code-field-codemirror-htmlmixed', $dir."/mode/htmlmixed/htmlmixed.js" );
		
		wp_enqueue_script( 'acf-input-code-field-codemirror-selection', $dir."/addon/selection/mark-selection.js", array( 'wp-codemirror' ) );
		wp_enqueue_script( 'acf-input-code-field-codemirror-matchbrackets', $dir."/addon/edit/matchbrackets.js", array( 'wp-codemirror' ) );
		wp_enqueue_script( 'acf-input-code-field-codemirror-autorefresh', $dir."/addon/display/autorefresh.js", array( 'wp-codemirror' ) );
	} 
	
	
	}
} 
add_action( 'admin_enqueue_scripts', 'WPBC_codemirror_enqueue_scripts', 10 ); 
add_action( 'wp_enqueue_scripts', 'WPBC_codemirror_enqueue_scripts', 10 ); 

add_action( 'admin_footer', 'WPBC_codemirror_admin_footer_by_class', 10 );
function WPBC_codemirror_admin_footer_by_class(){

	global $WPBC_codemirror_args;
	?>
	<script> 
	
	(function( $ ) {


		function initialize_code_field( $el ) {

			if($el.hasClass('codemirror')){
				var $textarea = $el.find( 'textarea.of-input' ); 
				var $mode = "text/html";
				if($el.hasClass('codemirror-css')){
					$mode = "text/css";
				}
				if($el.hasClass('codemirror-js')){
					$mode = "text/javascript";
				}
			}

			

			var editor = window.CodeMirror.fromTextArea( $textarea[ 0 ], {
				lineNumbers: true,
				fixedGutter: false,
				mode: $mode,
				theme: "<?php echo $WPBC_codemirror_args ['theme']; ?>",
				extraKeys: { "Ctrl-Space": "autocomplete" },
				matchBrackets: true,
				styleSelectedText: true,
				autoRefresh: true,
				value: document.documentElement.innerHTML,
				viewportMargin: 10,
				lineWrapping: true,
				indentUnit: 2,
				
				lint:true,
				autoCloseBrackets:true,
				autoCloseTags: true,
				matchTags: {"bothTags":true},
				
				extraKeys: {
					"F11": function(cm) {
					  cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
					  if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				  },  

			} );
			editor.refresh();
			editor.on("change", function(cm, change) { 
				//console.log(change);
			});

		}

		$( document ).on( 'ready', function( $el ) {
			$( '.section-textarea.codemirror' ).each( function() { 
				initialize_code_field($(this)); 
				//initialize_code_buttons($(this));
			} ); 
		} );

	})( jQuery );
	
	</script>
	<?php

}

// For ACF Fields

add_action( 'acf/input/admin_footer', 'WPBC_codemirror_admin_footer', 10 );
function WPBC_codemirror_admin_footer(){ 
	global $WPBC_codemirror_args; 

	?>
	<script>

	function _getCookie(cname) {
	  var name = cname + "=";
	  var decodedCookie = decodeURIComponent(document.cookie);
	  var ca = decodedCookie.split(';');
	  for(var i = 0; i <ca.length; i++) {
	    var c = ca[i];
	    while (c.charAt(0) == ' ') {
	      c = c.substring(1);
	    }
	    if (c.indexOf(name) == 0) {
	      return c.substring(name.length, c.length);
	    }
	  }
	  return "";
	} 
	
	var wpbc_codemirror_size = _getCookie('wpbc_codemirror_size');  

	(function( $ ) {
		
		function initialize_code_field( $el ) { 
		 	
			//$el.find('.acf-input textarea').attr('id', 'codemirror_field_' + index);
			if($el.hasClass('acf-field-wysiwyg')){
				var $textarea = $el.find( '.acf-input textarea.wp-editor-area' ); 
			}else{
				var $textarea = $el.find( '.acf-input>textarea' ); 
			}  

			if ( $el.parents( ".acf-clone" ).length > 0 ) {
				return;
			} 
			if( $el.hasClass('acf-field-qtranslate-textarea') ){
				//var $textarea = $el.find( '.acf-input .multi-language-field textarea' );
				//return; 
			}

			var $mode = "text/html";
			if($el.hasClass('codemirror-css')){
				$mode = "text/css";
			}
			if($el.hasClass('codemirror-js')){
				$mode = "text/javascript";
			}


			
			var editor = window.CodeMirror.fromTextArea( $textarea[ 0 ], {
				lineNumbers: true,
				fixedGutter: false,
				mode: $mode,
				theme: "<?php echo $WPBC_codemirror_args ['theme']; ?>",
				extraKeys: { "Ctrl-Space": "autocomplete" },
				matchBrackets: true,
				styleSelectedText: true,
				autoRefresh: true,
				value: document.documentElement.innerHTML,
				viewportMargin: 10,
				lineWrapping: true,
				indentUnit: 2,
				
				lint:true,
				autoCloseBrackets:true,
				autoCloseTags: true,
				matchTags: {"bothTags":true},
				
				extraKeys: {
					"F11": function(cm) {
					  cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
					  if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				  },
				/*
				csslint: {"errors":true,"box-model":true,"display-property-grouping":true,"duplicate-properties":true,"known-properties":true,"outline-none":true},
				
				jshint: {"boss":true,"curly":true,"eqeqeq":true,"eqnull":true,"es3":true,"expr":true,"immed":true,"noarg":true,"nonbsp":true,"onevar":true,"quotmark":"single","trailing":true,"undef":true,"unused":true,"browser":true,"globals":{"_":false,"Backbone":false,"jQuery":false,"JSON":false,"wp":false}},
				
				htmlhint: {"error":true, "box-model":true, "tagname-lowercase":true,"attr-lowercase":true,"attr-value-double-quotes":true,"doctype-first":false,"tag-pair":true,"spec-char-escape":true,"id-unique":true,"src-not-empty":true,"attr-no-duplication":true,"alt-require":true,"space-tab-mixed-disabled":"tab","attr-unsafe-chars":true},
				*/ 
 
			} );
			editor.refresh();
			editor.on("change", function(cm, change) { 
				$textarea.val(editor.getValue()); // New since Gutemberg
				//console.log(change);
			}); 
		}

		if ( typeof acf.add_action !== 'undefined' ) {

			acf.add_action( 'ready', function( $el ) {
				
				$el.find('.acf-field').each(function(){
					//console.log($(this).attr('class'));
				});
				if( $el.hasClass('acf-field-qtranslate-textarea') ){

				}else{
					
				}
				$el.find( '.codemirror-custom-field:not(.acf-field-qtranslate-textarea)' ).each( function( index, field ) { 
					initialize_code_field($(field)); 
					initialize_code_buttons($(this));
				} ); 
				$el.find( '.acf-field-qtranslate-textarea' ).each( function( index, field ) { 
					


				} ); 
			} );

			acf.add_action( 'append_field', function( $el ) {
				
				if ( $el.hasClass('codemirror-custom-field') ) {
					initialize_code_field( $el );
					initialize_code_buttons($el);
				}
			} );

		}
		function initialize_code_buttons($el){ 
			
			//console.log('initialize_code_buttons');
			
			var buttons = '<br><small class="codemirror-btns">F11 for Full Screen. F11/Esc to exit. Editor size: <a data-size="sm" class="codemirror-btn-change-size">Auto</a> <a data-size="md" class="current codemirror-btn-change-size">MD</a> <a data-size="lg" class="codemirror-btn-change-size">LG</a> <a data-size="xlg" class="codemirror-btn-change-size">XLG</a></small>';
			
			if($el){ 
				if( $el.find('.codemirror-btns').length == 0 ){
					$el.find('.acf-label').append(buttons);
				}
			}else{
				if( $(this).find('.codemirror-btns').length == 0 ){
					$(this).find('.acf-label').append(buttons);
				} 
			}
			
		
			$('.codemirror-btn-change-size').on('click',function(){
				$('.codemirror-btn-change-size.current').removeClass('current');
				$(this).addClass('current');
				$(this).closest('.codemirror-custom-field').removeClass('sm md lg xlg').addClass($(this).attr('data-size')); 

				document.cookie = "wpbc_codemirror_size="+ $(this).attr('data-size') +"; expires=<?php echo time() + 3600 * 24 * 100; ?>; path=<?php echo COOKIEPATH; ?>";

				return false; 
			});  

			if(wpbc_codemirror_size){
				$el.removeClass('sm md lg xlg').addClass(wpbc_codemirror_size); 
			} 
		}
		//initialize_code_buttons(false);
		
	})( jQuery );
	
	</script>
	<?php
	
};

// Save codemirror size used

add_action( 'init', 'WPBC_codemirror_cookies' );

function WPBC_codemirror_cookies() {
	if( !isset($_COOKIE['wpbc_codemirror_size']) ) {
	 	setcookie( 'wpbc_codemirror_size', 'md', time() + 3600 * 24 * 100, COOKIEPATH, COOKIE_DOMAIN, false );
	 }
}

function WPBC_get_codemirror_cookies(){
	if( isset($_COOKIE['wpbc_codemirror_size']) ) {
		return $_COOKIE['wpbc_codemirror_size'];
	}
}

?>