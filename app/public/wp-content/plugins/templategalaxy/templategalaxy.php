<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://websiteinwp.com/
 * @since             1.0.0
 * @package           Templategalaxy
 *
 * @wordpress-plugin
 * Plugin Name:       TemplateGalaxy
 * Plugin URI:        https://websiteinwp.com/templategalaxy/
 * Description:       TemplateGalaxy is a powerful WordPress plugin designed to enhance your block Full Site Editing (FSE) experience by providing an extensive library of patterns and templates. Whether you’re a developer, designer, or content creator, TemplateGalaxy simplifies the process of designing and organizing your website using the block FSE editor.
 * Version:           1.0.9
 * Author:            WebsiteinWP
 * Author URI:        https://websiteinwp.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       templategalaxy
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}
if (!function_exists('tg_fs')) {
	// Create a helper function for easy SDK access.
	function tg_fs()
	{
		global $tg_fs;
		global $tg_paid_status;
		if (!isset($tg_fs)) {
			// Include Freemius SDK.
			require_once dirname(__FILE__) . '/freemius/start.php';

			$tg_fs = fs_dynamic_init(array(
				'id'                  => '14409',
				'slug'                => 'templategalaxy',
				'premium_slug'        => 'templategalaxy-pro',
				'type'                => 'plugin',
				'public_key'          => 'pk_6dfd8a4f333c93c0c624b8433d535',
				'is_premium'          => $tg_paid_status,
				'premium_suffix'      => 'Premium',
				// If your plugin is a serviceware, set this option to false.
				'has_premium_version' => $tg_paid_status,
				'has_addons'          => false,
				'has_paid_plans'      => false,
				'menu'                => array(
					'slug'           => 'templategalaxy',
					'support'        => false,
				),
			));
		}

		return $tg_fs;
	}

	// Init Freemius.
	tg_fs();
	// Signal that SDK was initiated.
	do_action('tg_fs_loaded');
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('TEMPLATEGALAXY_VERSION', '1.0.9');
define('TEMPLATEGALAXY_PATH', plugin_dir_path(__FILE__));
define('TEMPLATEGALAXY_URL', plugin_dir_url(__FILE__));
define('TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL', TEMPLATEGALAXY_URL . 'includes/demos/');
define('TEMPLATEGALAXY_SETUP_SCRIPT_PREFIX', (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : ''));
if (tg_fs()->is_paying()) {
	$tg_paid_status = true;
} else {
	$tg_paid_status = false;
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-templategalaxy-activator.php
 */
function activate_templategalaxy()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-templategalaxy-activator.php';
	Templategalaxy_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-templategalaxy-deactivator.php
 */
function deactivate_templategalaxy()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-templategalaxy-deactivator.php';
	Templategalaxy_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_templategalaxy');
register_deactivation_hook(__FILE__, 'deactivate_templategalaxy');
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-templategalaxy.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_templategalaxy()
{

	$plugin = new TemplateGalaxy();
	$plugin->run();
}
run_templategalaxy();
