<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://websiteinwp.com/
 * @since      1.0.0
 *
 * @package    Templategalaxy
 * @subpackage Templategalaxy/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Templategalaxy
 * @subpackage Templategalaxy/includes
 * @author     WebsiteinWp <support@websiteinwp.com>
 */
class TemplateGalaxy
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Templategalaxy_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('TEMPLATEGALAXY_VERSION')) {
			$this->version = TEMPLATEGALAXY_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'templategalaxy';
		$this->load_dependencies();
		$this->set_locale();
		$this->load_templategalaxy_files();
		$this->define_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Templategalaxy_Loader. Orchestrates the hooks of the plugin.
	 * - Templategalaxy_i18n. Defines internationalization functionality.
	 * - Templategalaxy_Admin. Defines all hooks for the admin area.
	 * - Templategalaxy_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-templategalaxy-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-templategalaxy-i18n.php';

		/**
		 * including functions of the plugins
		 */
		require_once TEMPLATEGALAXY_PATH . 'includes/functions.php';
		require_once TEMPLATEGALAXY_PATH . 'includes/hooks.php';
		require_once TEMPLATEGALAXY_PATH . 'includes/demo-config.php';
		require_once TEMPLATEGALAXY_PATH . 'includes/admin/register-menu.php';

		$this->loader = new Templategalaxy_Loader();
	}

	private function load_templategalaxy_files()
	{
		require(TEMPLATEGALAXY_PATH . "includes/patterns-category.php");
		require(TEMPLATEGALAXY_PATH . 'includes/block-styles.php');
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Templategalaxy_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Templategalaxy_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}


	private function define_hooks()
	{
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		$check_ai_pluign_status = is_plugin_active('advanced-import/advanced-import.php');
		$plugin_admin = templategalaxy_Demo_Importer_Hooks();
		if ($check_ai_pluign_status) {
			$this->loader->add_action('admin_init', $plugin_admin, 'redirect');
			$this->loader->add_action('advanced_import_demo_lists', $plugin_admin, 'add_demo_lists', 999);
			$this->loader->add_action('wp_ajax_templategalaxy_getting_started', $plugin_admin, 'install_advanced_import');
		}
	}



	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Templategalaxy_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}

	public function templategalaxy_demo_importer_missing_notice()
	{
		$pluginList = templategalaxy_demo_importer_plugin_check_activated();
		if ($pluginList != '1') {
			$fileexists = templategalaxy_demo_importer_plugin_file_exists();
			if ($fileexists == '1') {
				$walker_core_plugin = 'advanced-import/advanced-import.php';
				$activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $walker_core_plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $walker_core_plugin);
				$message = '<p>' . __('TemplateGalaxy Demo Importer Demo Import Feature is not working because you need to activate Advanced Import Plugin.') . '</p>';
				$activate_msg = __('Activate Advanced Import Now');
				$message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, $activate_msg) . '</p>';
				echo '<div class="error"><p>' . $message . '</p></div>';
			}
		}
	}
}
