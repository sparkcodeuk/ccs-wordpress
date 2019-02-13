<?php
/**
 * Plugin Name:     CCS Salesforce Importer
 * Plugin URI:      http://www.studio24.net/
 * Description:     Imports required objects from Salesforce into Wordpress
 * Author:          Studio 24
 * Author URI:      http://www.studio24.net/
 * Text Domain:     ccs-salesforce-import
 * Version:         0.1.0
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    throw new Exception('You cannot access this file directly');
}

/**
 * The base config file that includes the stripe keys and any other
 * relevant config information (email addresses to send to etc.)
 */
require __DIR__ . '/config.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require __DIR__ . '/PluginCore.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_plugin()
{
    $plugin = new PluginCore();

    register_activation_hook(__FILE__, array('PluginCore', 'activate'));
    register_deactivation_hook(__FILE__, array('PluginCore', 'deactivate'));
}

run_plugin();