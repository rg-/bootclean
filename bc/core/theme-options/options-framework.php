<?php
/**
 * Options Framework
 *
 * @package   Options Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2010-2014 WP Theming
 *
 * @wordpress-plugin
 * Plugin Name: Options Framework
 * Plugin URI:  http://wptheming.com
 * Description: A framework for building theme options.
 * Version:     1.9.1
 * Author:      Devin Price
 * Author URI:  http://wptheming.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: optionsframework
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



// Don't load if optionsframework_init is already defined
if (is_admin() && ! function_exists( 'optionsframework_init' ) ) : 

function optionsframework_init() {

	//  If user can't edit theme options, exit
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	
	// filter types easy!!
	// apply_filters( 'optionsframework_' . $value['type'], $option_name, $value, $val )
	// FIELD TYPES here TODO
	require plugin_dir_path( __FILE__ ) . 'fields/test.php';
	require plugin_dir_path( __FILE__ ) . 'fields/repeater.php';	// TODO, this should be "addon" field
	
	// REST
	// Loads the required Options Framework classes.
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-framework.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-framework-admin.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-interface.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-media-uploader.php'; 
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-sanitization.php';
	
	// INIT 
	// Instantiate the options page.
	$options_framework_admin = new Options_Framework_Admin;
	$options_framework_admin->init();

	// Instantiate the media uploader class
	$options_framework_media_uploader = new Options_Framework_Media_Uploader;
	$options_framework_media_uploader->init(); 

}

add_action( 'init', 'optionsframework_init', 20 );

endif; 

function _get_data_condition($value){ 
	$data_condition = '';
	if(isset($value['condition'])){ 
		$s = '';
		$t = '';
		$r = '';
		$conditions = $value['condition'];
		foreach($conditions as $c){
			$show = !empty($c['show']) ? $c['show'] : '';
			$s .= '"'.$show.'",';
			$target = !empty($c['target']) ? $c['target'] : '';
			$t .= '"'.$target.'",';
			$rule = !empty($c['rule']) ? $c['rule'] : '';
			$r .= '"'.$rule.'",';
		} 
		$s = rtrim($s,',');
		$t = rtrim($t,',');
		$r = rtrim($r,',');
		//$data_condition = ' data-condition="['. $s .']" data-target="['. $t .']"'; 
		$data_condition = " data-condition='[". $s ."]' data-target='[". $t ."]' data-rules='[". $r ."]'"; 
	}
	return $data_condition;
}