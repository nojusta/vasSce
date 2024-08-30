<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://websiteinwp.com/
 * @since      1.0.0
 *
 * @package    templategalaxy
 * @subpackage templategalaxy/admin
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('TemplateGalaxy_Menu')) :
    class TemplateGalaxy_Menu
    {
        public function __construct()
        {
            add_action('admin_menu', array($this, 'register_templategalaxy_menus'),    9);
        }

        public function register_templategalaxy_menus()
        {


            add_menu_page('TemplateGalaxy', 'TemplateGalaxy', 'manage_options', 'templategalaxy', array($this, 'templategalaxy_dashboard'), 'dashicons-admin-network', '5');

            add_submenu_page(
                'templategalaxy',
                'Dashboard',
                __('Dashboard', 'templategalaxy'),
                'manage_options',
                'templategalaxy'
            );
        }

        function templategalaxy_dashboard()
        {
            include_once('dashboard.php');
        }
    }

    $Patternberg_Custom_Menu = new TemplateGalaxy_Menu;
endif;

if (!function_exists('templategalaxy_admin_scripts_loading')) {
    function templategalaxy_admin_scripts_loading()
    {
        wp_enqueue_style("templategalaxy-admin-style", TEMPLATEGALAXY_URL . 'assets/css/templategalaxy-admin.css');
    }
    add_action('admin_enqueue_scripts', 'templategalaxy_admin_scripts_loading');
}
