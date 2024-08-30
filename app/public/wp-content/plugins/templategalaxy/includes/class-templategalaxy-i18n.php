<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://websiteinwp.com/
 * @since      1.0.0
 *
 * @package    Templategalaxy
 * @subpackage Templategalaxy/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Templategalaxy
 * @subpackage Templategalaxy/includes
 * @author     WebsiteinWp <support@websiteinwp.com>
 */
class Templategalaxy_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'templategalaxy',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}
}
