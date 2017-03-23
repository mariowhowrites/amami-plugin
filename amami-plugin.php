<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              ceibaweb.com
 * @since             1.0.0
 * @package           Amami_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       A-MAMI.org Plugin
 * Plugin URI:        ceibaweb.com
 * Description:       This plugin supports the Documents and Services custom post types on A-MAMI.org.
 * Version:           1.0.0
 * Author:            Mario Vega
 * Author URI:        ceibaweb.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       amami-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-amami-plugin-activator.php
 */
function activate_amami_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-amami-plugin-activator.php';
	Amami_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-amami-plugin-deactivator.php
 */
function deactivate_amami_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-amami-plugin-deactivator.php';
	Amami_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_amami_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_amami_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-amami-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_amami_plugin() {

	$plugin = new Amami_Plugin();
	$plugin->run();

}
run_amami_plugin();
