<?php
global $wp_version;
define('gonDir',plugin_basename(__FILE__));
define('gonPath',WP_PLUGIN_DIR.'/gon-ads-plugin');
define('gonURL',WP_PLUGIN_URL.'/gon-ads-plugin');
define('gonTemplateURL',gonPath.'/public/email-templates');
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Gon_Classifieds
 *
 * @wordpress-plugin
 * Plugin Name:       New Gon Classifieds
 * Plugin URI:        http://example.com/gon-classifieds-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gon-classifieds
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gon-classifieds-activator.php
 */
function activate_Gon_Classifieds() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gon-classifieds-activator.php';
	Gon_Classifieds_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gon-classifieds-deactivator.php
 */
function deactivate_Gon_Classifieds() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gon-classifieds-deactivator.php';
	Gon_Classifieds_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Gon_Classifieds' );
register_deactivation_hook( __FILE__, 'deactivate_Gon_Classifieds' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gon-classifieds.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Gon_Classifieds() {

	$plugin = new Gon_Classifieds();
	$plugin->run();

}
run_Gon_Classifieds();
