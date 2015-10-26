<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://heyloyalty.com
 * @since             0.1
 * @package           heyloyalty
 *
 * @wordpress-plugin
 * Plugin Name:       wp-heyloyalty
 * Plugin URI:        http://heyloyalty.com
 * Description:       Plugin for handling integration with heyloyalty email platfom
 * Version:           1.0.0
 * Author:            René Skou
 * Author URI:        http://heyloyalty.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-heyloyalty
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
require 'vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-heyloyalty-activator.php
 */
function activate_wp_heyloyalty() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-heyloyalty-activator.php';
	Wp_Heyloyalty_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-heyloyalty-deactivator.php
 */
function deactivate_wp_heyloyalty() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-heyloyalty-deactivator.php';
	Wp_Heyloyalty_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_heyloyalty' );
register_deactivation_hook( __FILE__, 'deactivate_wp_heyloyalty' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-heyloyalty.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_heyloyalty() {

	$plugin = new Wp_heyloyalty();
	$plugin->run();

}
run_wp_heyloyalty();
