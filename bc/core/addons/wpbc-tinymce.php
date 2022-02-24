<?php 

/*
 *
 * Enable bootstrap colors palette on tinymce
 *
*/

add_action('init', 'BC_tiny_mce__init'); 
function BC_tiny_mce__init(){ 
	add_action( 'admin_head', 'WPBC_tiny_mce__palettes', 0 ); // admin_enqueue_scripts is 10
	add_action( 'wp_head', 'WPBC_tiny_mce__palettes', 0 ); 
	function WPBC_tiny_mce__palettes(){
		?><script>
			var wpTinyMce_palettes = [<?php echo __BC_get_root_colors_palette_tiny() ? __BC_get_root_colors_palette_tiny() : 'null'; ?>]; 
		</script>
		<?php
	}
}

add_filter('tiny_mce_before_init', 'BC_tiny_mce_before_init', 99); 
function BC_tiny_mce_before_init($init=array()) { 
	//$init['textcolor_map'] = '['.__BC_get_root_colors_palette_tiny().']';
	//$init['textcolor_rows'] = 3; // expand colour grid to 6 rows
	$json = json_decode( __BC_get_root_colors_palette_tiny(true) );
	//$init['textcolor_map'] = $json;
 

	$init['textcolor_map'] = '['.__BC_get_root_colors_palette_tiny().']';
	$init['setup'] = 'function(ed) { 
		if(wpTinyMce_palettes){  
			//console.log(ed.settings); 
			//var old_mceInit = ed.settings.textcolor_map;
			//var new_mceInit = wpTinyMce_palettes.concat(old_mceInit);
			//ed.settings.textcolor_map = new_mceInit;   
 
			var plugins = ed.plugins; 
			
			/*

			ed.ui.registry.addContextToolbar("textselection", {
	      predicate: function (node) {
	        return !ed.selection.isCollapsed();
	      },
	      items: "bold italic | blockquote",
	      position: "selection",
	      scope: "node"
	    });

			*/

		}  
	}';

	//$custom_css = get_theme_mod( 'custom_css' ); 
  $styles = '.mce-content-body { background:#dbdde0; }';
  $styles = apply_filters('wpbc/filter/tiny_mce/custom_css', $styles);
  if ( !isset( $init['content_style'] ) ) {
    $init['content_style'] = $styles . ' ';
  } else {
    $init['content_style'] .= ' ' . $styles . ' ';
  }  
	return $init;
}

/*
 *
 * Custom block_formats
 * Added Display bootstrap tags for example
 *
 */

$use_wpbc_tinymce_custom_block_formats = apply_filters('wpbc/filter/tinymce/custom_block_formats', 0);

global $WPBC_VERSION;
if ( version_compare( $WPBC_VERSION, '11.9.9', '>' ) ) {

	$use_wpbc_tinymce_custom_block_formats = apply_filters('wpbc/filter/tinymce/custom_block_formats', 1);

}

if($use_wpbc_tinymce_custom_block_formats){

	add_filter( 'tiny_mce_before_init', 'wpbc_tinymce_settings' );

	function wpbc_tinymce_get_block_formats(){
		/*
			ed.formatter.register( 'p-lead', {
		    block : 'p',
		    classes : 'lead'
			});
		*/
		$block_formats_X = array(
			array(
				'key' => 'p',
				'block' => 'p',
				'classes' => '',
				'tinymce' => 'Paragraph=p'
			),
			array(
				'key' => 'p-lead',
				'block' => 'p',
				'classes' => 'lead',
				'tinymce' => 'Paragraph Lead=p-lead'
			),
			array(
				'key' => 'p-small',
				'block' => 'p',
				'classes' => 'small',
				'tinymce' => 'Paragraph Small=p-small'
			),

			array(
				'key' => 'display-1',
				'block' => 'h1',
				'classes' => 'display-1',
				'tinymce' => 'Display 1=display-1'
			),
			array(
				'key' => 'display-2',
				'block' => 'h2',
				'classes' => 'display-2',
				'tinymce' => 'Display 2=display-2'
			),
			array(
				'key' => 'display-3',
				'block' => 'h3',
				'classes' => 'display-3',
				'tinymce' => 'Display 3=display-3'
			),
			array(
				'key' => 'display-4',
				'block' => 'h4',
				'classes' => 'display-4',
				'tinymce' => 'Display 4=display-4'
			),

			array(
				'key' => 'display-4',
				'block' => 'h4',
				'classes' => 'display-4',
				'tinymce' => 'Heading 1=h1'
			),

		);
		$block_formats = [
        'Paragraph=p',
        'Paragraph Lead=p-lead',
        'Paragraph Small=p-small',
        'Display 1=display-1',
        'Display 2=display-2',
        'Display 3=display-3',
        'Display 4=display-4',
        'Heading 1=h1',
        'Heading 2=h2',
        'Heading 3=h3',
        'Heading 4=h4',
        'Heading 5=h5',
        'Heading 6=h6', 
    ];
    $block_formats = apply_filters('wpbc/filter/tinymce/block_formats', $block_formats);
    return $block_formats;
	}
	function wpbc_tinymce_get_font_formats(){
		$font_formats = array();
		/*
			EX:
			$font_formats = array(
				'Spartan=Spartan,sans-serif',
				'Lora=Lora,serif',
			);
		*/
		$font_formats = apply_filters('wpbc/filter/tinymce/font_formats', $font_formats);
		return $font_formats;
	}
	function wpbc_tinymce_settings( $init_array ) {

		$block_formats = wpbc_tinymce_get_block_formats();
	  $init_array['block_formats'] = implode(';', $block_formats);

	  $font_formats = wpbc_tinymce_get_font_formats();
	 
	  if(!empty($font_formats)){
	  	$init_array['font_formats'] = implode(';', $font_formats); 
	  }
		 
		$style_formats = array(  
			// Each array child is a format with it's own settings
			array(  
				'title' => 'Display 1',  
				'block' => 'h1',  
				'classes' => 'display-1',
				'wrapper' => true, 
			),   
		);  
		// Insert the array, JSON ENCODED, into 'style_formats'
		//$init_array['style_formats'] = wp_json_encode( $style_formats ); 
	  
	  return $init_array;
	} 

	add_action('acf/input/admin_footer', 'wpbc_tinymce_acf_admin_footer');
	
	function wpbc_tinymce_acf_admin_footer() {
	    ?> 
	    <script type="text/javascript">
	 

	    (function( $ ){

	    		acf.addAction('wysiwyg_tinymce_init', function( ed, id, mceInit, field ){
				    // ed (object) tinymce object returned by the init function
				    // id (string) identifier for the tinymce instance
				    // mceInit (object) args given to the tinymce function
				    // field (object) field instance 
				    // ed.plugins 

				    var plugins = ed.plugins; 

				    /*
				    ed.ui.registry.addContextToolbar("textselection", {
				      predicate: function (node) {
				        return !ed.selection.isCollapsed();
				      },
				      items: "bold italic | blockquote",
				      position: "selection",
				      scope: "node"
				    });
				    */
				    ed.formatter.register( 'p', {
	            block : 'p',
	            attributes: { class: '' }
	        	});
				    ed.formatter.register( 'p-lead', {
	            block : 'p', 
	            attributes: { class: 'lead' }
	        	});
				    ed.formatter.register( 'p-small', {
	            block : 'p', 
	            attributes: { class: 'small' }
	        	});

				    ed.formatter.register( 'display-1', {
	            block : 'h1', 
	            attributes: { class: 'display-1' }
	        	});
	        	ed.formatter.register( 'display-2', {
	            block : 'h2', 
	            attributes: { class: 'display-2' }
	        	});
	        	ed.formatter.register( 'display-3', {
	            block : 'h3', 
	            attributes: { class: 'display-3' }
	        	});
	        	ed.formatter.register( 'display-4', {
	            block : 'h4', 
	            attributes: { class: 'display-4' }
	        	}); 

	        	for (var i = 1; i < 7; i++) { 
	        		 ed.formatter.register( 'h'+i+'', {
		            block : 'h'+i+'', 
		            attributes: { class: 'h'+i+'' }
		        	});
	        	}

				});

	      acf.add_filter('wysiwyg_tinymce_settings', function( mceInit, id, field ){
	      	
	      	//mceInit.skin = 'wordpress';
	      		//console.log(mceInit);
	      		//console.log(field.attr('data-name'));
	      		//console.log(mceInit.toolbar1);
	      		//console.log(mceInit.toolbar2);
				    
				    // do something to mceInit 
				    
				    // default
				    //mceInit.toolbar1 = 'formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,fullscreen,wp_adv';

				    //mceInit.toolbar1 = 'formatselect,forecolor,bold,italic,bullist,numlist,alignleft,aligncenter,alignright,link,wp_adv';
				    
				    // default
				    //mceInit.toolbar2 = 'strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help';

						//mceInit.toolbar2 = 'blockquote,strikethrough, hr,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help,fullscreen';

				    // custom
				    //mceInit.toolbar3 = 'styleselect';
				    
				    // return
				    return mceInit;

				});
	    })(jQuery);
	    </script>
	    <?php
	}

	add_filter( 'acf/fields/wysiwyg/toolbars' , 'wpbc_tinymce_acf_toolbars');

	function wpbc_tinymce_acf_toolbars( $toolbars ) { 

		// Add a new toolbar called "wpbc-basic"
		// formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,fullscreen,wp_adv
		// strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help

			// fontsizeselect

		$toolbars['wpbc_xxmini'] = array();
			$toolbars['wpbc_xxmini'][1] = array( 
				'formatselect', 'bold', 'italic', 'link',
			);

		$toolbars['wpbc_xmini'] = array();
			$toolbars['wpbc_xmini'][1] = array(
				'forecolor',
				'bold', 'italic', 
				'alignleft', 'aligncenter','alignright', 'link',
			);

		$toolbars['wpbc_mini'] = array();
			$toolbars['wpbc_mini'][1] = array(
				'forecolor', 
				'bold', 'italic', 'underline', 'bullist', 'numlist', 
				'alignleft', 'aligncenter','alignright', 'link', 
			);

		$toolbars['wpbc_basic'] = array();
			$toolbars['wpbc_basic'][1] = array(
				'forecolor', 
				'bold', 'italic', 'underline', 'bullist', 'numlist', 
				'alignleft', 'aligncenter','alignright', 'link', 
				'wp_adv'
			);
			$toolbars['wpbc_basic'][2] = array(
				'strikethrough','hr','blockquote', 
				'pastetext','removeformat','charmap',
				'outdent','indent',
				'fullscreen'
			); 

		$toolbars['wpbc_format'] = array();
			$toolbars['wpbc_format'][1] = array(
				'formatselect', 'forecolor', 
				'bold', 'italic', 'underline', 'bullist', 'numlist', 
				'alignleft', 'aligncenter','alignright', 'link', 
				'wp_adv'
			);
			$toolbars['wpbc_format'][2] = array(
				'strikethrough','hr','blockquote', 
				'pastetext','removeformat','charmap',
				'outdent','indent',
				'fullscreen'
			); 

		$toolbars['wpbc_format_family'] = array();
			$toolbars['wpbc_format_family'][1] = array(
				'formatselect', 'fontselect', 'forecolor',  
				'bold', 'italic', 'underline', 'bullist', 'numlist', 
				'alignleft', 'aligncenter','alignright', 'link', 
				'wp_adv'
			);
			$toolbars['wpbc_format_family'][2] = array(
				'strikethrough','hr','blockquote', 
				'pastetext','removeformat','charmap',
				'outdent','indent',
				'fullscreen'
			); 

		return $toolbars;
	}

}