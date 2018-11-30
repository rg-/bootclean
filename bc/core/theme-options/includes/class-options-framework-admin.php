<?php
/**
 * @package   Options_Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2010-2014 WP Theming
 */ 
 
 
function WPBC_force_update_options(){
	return apply_filters('WPBC_force_update_options', false);
}

class Options_Framework_Admin {

	/**
     * Page hook for the options screen
     *
     * @since 1.7.0
     * @type string
     */
    protected $options_screen = null;

    /**
     * Hook in the scripts and styles
     *
     * @since 1.7.0
     */
    public function init() {

		// Gets options to load
    	$options = & Options_Framework::_optionsframework_options();
		
		// Checks if options are available
    	if ( $options ) {
			
			// Import/Export actions
			// toplevel_page_bootclean-theme-options
			$name = 'load-toplevel_page_'.optionsframework_menu_slug();
			add_action( $name, array( &$this, 'actions' ) );
 
			// Add the options page and menu item. Hide menu page on child themes by default or using filter as follows: 
			if( WPBC_is_options_page_enabled() ){
				add_action( 'admin_menu', array( $this, 'add_custom_options_page' ), 9 );
			} 
			// Add the required scripts and styles
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

			// Settings need to be registered after admin_init
			add_action( 'admin_init', array( $this, 'settings_init' ) );

			// Adds options menu to the admin bar
			add_action( 'wp_before_admin_bar_render', array( $this, 'optionsframework_admin_bar' ) ); 
		}
		 
		
    }
	 
	
	
	function _get_options() {
		global $wpdb, $gantry;
		$option_name = optionsframework_option_name();
		return get_option($option_name);
	}
	function actions() {
		
		$option_name = optionsframework_option_name(); 
		
		if( isset( $_GET['action'] ) && $_GET['action'] == 'download' ) { 
			
			header("Cache-Control: public, must-revalidate");
			header("Pragma: hack");
			header("Content-Type: text/plain");
			header('Content-Disposition: attachment; filename="theme-options-'.date("dMy").'.dat"');
			echo serialize( $this->_get_options() );
			die();
		}
		// import settings
		if( isset( $_POST['upload'] ) ) {
			if( $_FILES["file"]["error"] > 0 ) {
				add_settings_error( 'options-framework', 'upload-error', __( 'Options updated falied.', 'bootclean' ), 'error fade' );
			} else {
				add_settings_error( 'options-framework', 'upload-ok', __( 'Options updated.', 'bootclean' ), 'updated fade' );
				$option = unserialize ( WPBC_get_ob_contents( $_FILES["file"]["tmp_name"] ) );  
				update_option( $option_name, $option );
				/*
				$options = unserialize( file_get_contents( $_FILES["file"]["tmp_name"] ) );
				foreach( $options as $option ) {
					update_option( $option->option_name, unserialize( $option->option_value ) );
				}
				*/
			}
		}
	}
	/**
     * Registers the settings
     *
     * @since 1.7.0
     */
    function settings_init() {

		// Get the option name
		$options_framework = new Options_Framework;
	    $name = $options_framework->get_option_name(); 

		// Registers the settings fields and callback
		register_setting( 'optionsframework', $name, array ( $this, 'validate_options' ) );

		// See if options are saved
		$options_test = get_option($name);
		if( empty($options_test) || WPBC_force_update_options() ){ 
			$default_options = WPBC_get_default_options();
			//$default_options = serialize($default_options); 
			update_option( 'WPBC_defaults_saved', '1' );
			update_option( $name, $default_options );
			add_settings_error( 'options-framework', 'defaults', __( 'Options saved for first time! Enjoy it.', 'bootclean' ), 'updated fade' );
		} 
		
		// Displays notice after options save
		add_action( 'optionsframework_after_validate', array( $this, 'save_options_notice' ) ); 

    }

	/*
	 * Define menu options
	 *
	 * Examples usage:
	 *
	 * add_filter( 'optionsframework_menu', function( $menu ) {
	 *     $menu['page_title'] = 'The Options';
	 *	   $menu['menu_title'] = 'The Options';
	 *     return $menu;
	 * });
	 *
	 * @since 1.7.0
	 *
	 */
	static function menu_settings() {

		$menu = array(

			// Modes: menu_page, sub_menu_page, theme_page (default)
            'mode' => 'theme_page',

            // Submenu default settings
            'page_title' => __( 'Theme Options', 'bootclean' ),
			'menu_title' => __( 'Theme Options', 'bootclean' ),
			'capability' => 'edit_theme_options',
			'menu_slug' => 'options-framework',
            'parent_slug' => 'themes.php',

            // Menu default settings
            'icon_url' => 'dashicons-admin-generic',
            'position' => '61'

		);

		return apply_filters( 'optionsframework_menu', $menu );
	}

	/**
     * Add a subpage called "Theme Options" to the appearance menu.
     *
     * @since 1.7.0
     */
	function add_custom_options_page() {

		$menu = $this->menu_settings();

		// If you want a top level menu, see this Gist:
		// https://gist.github.com/devinsays/884d6abe92857a329d99

		// Code removed because it conflicts with .org theme check.
		
		switch( $menu['mode'] ) {
			case 'menu_page':
				$this->options_screen = add_menu_page(
                	$menu['page_title'],
                	$menu['menu_title'],
                	$menu['capability'],
                	$menu['menu_slug'],
                	array( $this, 'options_page' ),
                	$menu['icon_url'],
                	$menu['position']
                );
				break;
			case 'submenu_page':
				$this->options_screen = add_submenu_page(
                	$menu['parent_slug'],
                	$menu['page_title'],
                	$menu['menu_title'],
                	$menu['capability'],
                	$menu['menu_slug'],
                	array( $this, 'options_page' ) );
				break;
			default:
				$this->options_screen = add_theme_page(
					$menu['page_title'],
					$menu['menu_title'],
					$menu['capability'],
					$menu['menu_slug'],
					array( $this, 'options_page' )
				);
				 break;
		}
		
		/*
		$this->options_screen = add_theme_page(
            $menu['page_title'],
            $menu['menu_title'],
            $menu['capability'],
            $menu['menu_slug'],
            array( $this, 'options_page' )
        );
		*/
	}

	/**
     * Loads the required stylesheets
     *
     * @since 1.7.0
     */

	function enqueue_admin_styles( $hook ) {

		if ( $this->options_screen != $hook )
	        return; 
		wp_enqueue_style( 'optionsframework', OPTIONS_FRAMEWORK_DIRECTORY . 'css/optionsframework.css', array(),  Options_Framework::VERSION );
		wp_enqueue_style( 'wp-color-picker' );
	}

	/**
     * Loads the required javascript
     *
     * @since 1.7.0
     */
	function enqueue_admin_scripts( $hook ) {

		if ( $this->options_screen != $hook )
	        return;
		
		add_action( 'admin_head', function(){
			?>
			<script>
				var wpColorPicker_palettes = <?php echo __BC_get_root_colors_palette() ? __BC_get_root_colors_palette() : 'null'; ?>;
			</script>
			<?php
		}, 0 );

		// Enqueue custom option panel JS
		wp_enqueue_script(
			'options-custom',
			OPTIONS_FRAMEWORK_DIRECTORY . 'js/options-custom.js',
			array( 'jquery','wp-color-picker' ),
			Options_Framework::VERSION
		);
		
		// ADDED BC
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');

		// Inline scripts from options-interface.php
		add_action( 'admin_head', array( $this, 'of_admin_head' ) );
	}

	function of_admin_head() {
		// Hook to add custom scripts
		do_action( 'optionsframework_custom_scripts' );
	}

	/**
     * Builds out the options panel.
     *
	 * If we were using the Settings API as it was intended we would use
	 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
	 * we'll call our own custom optionsframework_fields.  See options-interface.php
	 * for specifics on how each individual field is generated.
	 *
	 * Nonces are provided using the settings_fields()
	 *
     * @since 1.7.0
     */
	 function options_page() { ?>
		
		<div id="optionsframework-wrap" class="wrap">

			<?php $menu = $this->menu_settings(); ?>
			
			<h2 class="of-page-title"><?php echo esc_html( $menu['page_title'] ); ?></h2> 
			
			<div class="of-settings-errors">
				<?php settings_errors( 'options-framework' ); ?>
			</div>
			
			<div class="of-right-tabs">
			
				<div class="of-tabs nav-tab-wrapper">
					<?php echo Options_Framework_Interface::optionsframework_tabs(); ?>
				</div>
				
				<div id="optionsframework-metabox" class="of-metabox-holder metabox-holder"> 

					<div id="optionsframework" class="of-postbox postbox">
						
						<form action="options.php" method="post" class="of-form">
							
							<?php settings_fields( 'optionsframework' ); ?>
							
							<div class="of-form-row">
							
								<div id="optionsframework-fields" class="of-form-fields">
									<?php Options_Framework_Interface::optionsframework_fields(); /* Settings */ ?>
								</div><!-- / #optionsframework-fields --> 
								
								<div class="of-form-sidebar">
									<div id="optionsframework-submit" class="of-form-submit">
										<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults', 'bootclean' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!', 'bootclean' ) ); ?>' );" />
										<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options', 'bootclean' ); ?>" />
										<div class="clear ddd"></div>
									</div>
								</div>
							
							</div>
							
						</form>
					
					</div><!-- / #optionsframework -->
				
				</div><!-- / #optionsframework-metabox -->
			
			</div><!-- / .of-right-tabs -->

			<form id="wpbc-import-export" action="" method="POST" enctype="multipart/form-data">
				<table style="width: 100%">
					<tr valign="top">
						<td style="width: 50%">
							<h4>Import Settings</h4>
							<input type="file" name="file" />
							<input type="submit" name="upload" id="upload" class="button-secondary" value=" Upload ">
						</td>
						<td>
							<h4>Export Settings</h4>
							<a href="<?php echo admin_url('admin.php?page='.optionsframework_menu_slug().'&action=download'); ?>" class="button-secondary">Download as file</a>
						</td>
					</tr>
				</table>
			</form>
			
			<?php do_action( 'optionsframework_after' ); ?>
			
		</div> <!-- / .wrap -->

	<?php
	}

	/**
	 * Validate Options.
	 *
	 * This runs after the submit/reset button has been clicked and
	 * validates the inputs.
	 *
	 * @uses $_POST['reset'] to restore default options
	 */
	function validate_options( $input ) {

		/*
		 * Restore Defaults.
		 *
		 * In the event that the user clicked the "Restore Defaults"
		 * button, the options defined in the theme's options.php
		 * file will be added to the option for the active theme.
		 */

		if ( isset( $_POST['reset'] ) ) {
			add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'bootclean' ), 'updated fade' );
			return $this->get_default_values();
		}

		/*
		 * Update Settings
		 *
		 * This used to check for $_POST['update'], but has been updated
		 * to be compatible with the theme customizer introduced in WordPress 3.4
		 */

		$clean = array();
		$options = & Options_Framework::_optionsframework_options();
		foreach ( $options as $option ) {

			if ( ! isset( $option['id'] ) ) {
				continue;
			}

			if ( ! isset( $option['type'] ) ) {
				continue;
			}

			$id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );

			// Set checkbox to false if it wasn't sent in the $_POST
			if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
				$input[$id] = false;
			}

			// Set each item in the multicheck to false if it wasn't sent in the $_POST
			if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
				foreach ( $option['options'] as $key => $value ) {
					$input[$id][$key] = false;
				}
			}

			// For a value to be submitted to database it must pass through a sanitization filter
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
			}
		}

		// Hook to run after validation
		do_action( 'optionsframework_after_validate', $clean );

		return $clean;
	}

	/**
	 * Display message when options have been saved
	 */

	function save_options_notice() {
		add_settings_error( 'options-framework', 'save_options', __( 'Options saved.', 'bootclean' ), 'updated fade' );
	}

	/**
	 * Get the default values for all the theme options
	 *
	 * Get an array of all default values as set in
	 * options.php. The 'id','std' and 'type' keys need
	 * to be defined in the configuration array. In the
	 * event that these keys are not present the option
	 * will not be included in this function's output.
	 *
	 * @return array Re-keyed options configuration array.
	 *
	 */
	function get_default_values() {
		$output = array();
		$config = & Options_Framework::_optionsframework_options();
		foreach ( (array) $config as $option ) {
			if ( ! isset( $option['id'] ) ) {
				continue;
			}
			if ( ! isset( $option['std'] ) ) {
				continue;
			}
			if ( ! isset( $option['type'] ) ) {
				continue;
			}
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
			}
		}
		return $output;
	}

	/**
	 * Add options menu item to admin bar
	 */

	function optionsframework_admin_bar() {

		$menu = $this->menu_settings();

		global $wp_admin_bar;

		if ( 'menu' == $menu['mode'] ) {
			$href = admin_url( 'admin.php?page=' . $menu['menu_slug'] );
		} else {
			$href = admin_url( 'themes.php?page=' . $menu['menu_slug'] );
		}

		$args = array(
			'parent' => 'appearance',
			'id' => 'of_theme_options',
			'title' => $menu['menu_title'],
			'href' => $href
		);

		$wp_admin_bar->add_menu( apply_filters( 'optionsframework_admin_bar', $args ) );
	}

} 
