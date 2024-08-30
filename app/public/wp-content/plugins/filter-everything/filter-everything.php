<?php
/*
Plugin Name: Filter Everything&nbsp;— WooCoomerce Product & WordPress Filter
Plugin URI: https://filtereverything.pro
Description: Filters everything in WordPress & WooCommerce: Products, any Post types, by Any Criteria. Compatible with WPML, ACF and others popular. Supports AJAX.
Version: 1.8.6
Author: Andrii Stepasiuk
Author URI: https://filtereverything.pro/about/
Text Domain: filter-everything
Domain Path: /lang
*/

// If this file is called directly, abort.
if ( ! defined('ABSPATH') ) {
    exit;
}

if( ! class_exists( 'FlrtFilter' ) ):

    class FlrtFilter{

        public function init()
        {
            global $flrt_sets, $wpc_not_fired, $chips_count;

            $chips_count   = 0;
            $wpc_not_fired = true;
            $flrt_sets     = [];

            $this->define( 'FLRT_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
            $this->define( 'FLRT_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
            $this->define( 'FLRT_PLUGIN_BASENAME', plugin_basename(__FILE__) );
            $this->define( 'FLRT_PLUGIN_SLUG', 'filter-everything-pro' );
            $this->define( 'FLRT_PLUGIN_VER', '1.8.6' );
            $this->define( 'FLRT_PLUGIN_URL', 'https://filtereverything.pro' );
            $this->define( 'FLRT_PLUGIN_TESTED_TO', '6.6' );
            $this->define( 'FLRT_PLUGIN_DEBUG', false );
            $this->define( 'FLRT_TEMPLATES_DIR_NAME', 'filters' );

            $this->define( 'FLRT_FILTERS_SET_POST_TYPE', 'filter-set' );
            $this->define( 'FLRT_FILTERS_POST_TYPE', 'filter-field' );
            $this->define( 'FLRT_PREFIX_SEPARATOR', '-' );
            $this->define( 'FLRT_QUERY_TERMS_SEPARATOR', ';' );
            $this->define( 'FLRT_DATE_TIME_SEPARATOR', 't' );
            $this->define( 'FLRT_FOLDING_COOKIE_NAME', 'wpcContainersStatus' );
            $this->define( 'FLRT_MORELESS_COOKIE_NAME', 'wpcMoreLessStatus' );
            $this->define( 'FLRT_HIERARCHY_LIST_COOKIE_NAME', 'wpcHierarchyListStatus' );
            $this->define( 'FLRT_OPEN_CLOSE_BUTTON_COOKIE_NAME', 'wpcWidgetStatus' );
            $this->define( 'FLRT_APPLY_BUTTON_META_KEY', 'wpc_filter_set_apply_button_post_name' );
            $this->define( 'FLRT_TRANSIENT_PERIOD_HOURS', 12 );
            $this->define( 'FLRT_BEAVER_BUILDER_VAR', 'fl_builder' );
            $this->define( 'FLRT_LICENSE_KEY', 'wpc_filter_license' );
            $this->define( 'FLRT_MARKET', 'codecanyon' );
            $this->define( 'FLRT_RELEASER', 'stepasiuk' );
            $this->define( 'FLRT_APPROVED', 'victor' );
            $this->define( 'FLRT_ITERATION', 'first' );

            require_once FLRT_PLUGIN_DIR_PATH . 'src/wpc-helpers.php';

            flrt_include('src/wpc-compat.php');
            flrt_include('src/wpc-default-hooks.php');
            flrt_include('src/wpc-third-party.php');

            flrt_include('src/Plugin.php');
            flrt_include('src/PostTypes.php');
            flrt_include('src/Settings/TabInterface.php');
            flrt_include('src/Settings/BaseSettings.php');
            flrt_include('src/Settings/TabRenderer.php');
            flrt_include('src/Settings/Container.php');

            flrt_include('src/Entities/Entity.php');

            flrt_include('src/Entities/TaxonomyEntity.php');
            flrt_include('src/Entities/PostMetaEntity.php');
            flrt_include('src/Entities/PostMetaNumEntity.php');
            flrt_include('src/Entities/AuthorEntity.php');
            flrt_include('src/Entities/PostDateEntity.php');

            // Include PRO
//            flrt_include('pro/filters-pro.php');

            flrt_include('src/Entities/DefaultEntity.php');
            flrt_include('src/Entities/EntityManager.php');

            flrt_include('src/Settings/Tabs/SettingsTab.php');
            flrt_include('src/Settings/Tabs/PermalinksTab.php');
            flrt_include('src/Settings/Tabs/ExperimentalTab.php');
            flrt_include('src/Settings/Tabs/AboutProTab.php');
            flrt_include('src/Settings/Tabs/HelpMeTab.php');

            flrt_include('src/Settings/Filter.php');

            flrt_include('src/RequestParser.php');
            flrt_include('src/UrlManager.php');
            flrt_include('src/Chips.php');
            flrt_include('src/Sorting.php');
            flrt_include('src/Swatches.php');

            flrt_include('src/Walkers/WalkerCheckbox.php');

            flrt_include('src/TemplateManager.php');
            flrt_include('src/WpManager.php');

            flrt_include('src/Admin/FilterSet.php');
            flrt_include('src/Admin/FilterFields.php');
            flrt_include('src/Admin/Admin.php');
            flrt_include('src/Admin/AdminHooks.php');
            flrt_include('src/Admin/MetaBoxes.php');
            flrt_include('src/Admin/Widgets/FiltersWidget.php');
            flrt_include('src/Admin/Widgets/ChipsWidget.php');
            flrt_include('src/Admin/Widgets/SortingWidget.php');
            flrt_include('src/Admin/Widgets.php');
            flrt_include('src/Admin/Shortcodes.php');
            flrt_include('src/Admin/Validator.php');

            flrt_include('src/FormFields/Input.php');
            flrt_include('src/wpc-api.php');

            $this->registerHooks();

            $this->initSettings();

            if( flrt_get_experimental_option( 'disable_woo_orderby' ) === 'on' ) {
                if( ! function_exists('woocommerce_catalog_ordering') ){
                    function woocommerce_catalog_ordering()
                    {
                        return false;
                    }
                }
            }
        }

        public function registerHooks()
        {
            // Backward compatibility. From v1.3.2
            add_action( 'init', [ $this, 'convertShowChipsInContent' ], -1 );

            add_action( 'init', [ $this, 'oneTwoThreeGo' ] );

            add_action( 'init', [ $this, 'loadTextdomain' ], 0 );

            add_action( 'after_setup_theme', [$this, 'afterSetupTheme'] );

            register_activation_hook(__FILE__, ['FilterEverything\Filter\Plugin', 'activate']);

            register_uninstall_hook(__FILE__, ['FilterEverything\Filter\Plugin', 'uninstall']);

            add_action('after_switch_theme', ['FilterEverything\Filter\Plugin', 'switchTheme'] );
        }

        public function convertShowChipsInContent()
        {
            // Backward compatibility. From v1.3.2
            $filter_settings = get_option('wpc_filter_settings');

            if ( isset( $filter_settings['show_terms_in_content'] ) && $filter_settings['show_terms_in_content'] === 'on' ) {
                $new_chips_hooks = [];
                $theme_dependencies = flrt_get_theme_dependencies();

                if ( flrt_is_woocommerce() ) {
                    $new_chips_hooks[] = 'woocommerce_no_products_found';
                    $new_chips_hooks[] = 'woocommerce_archive_description';
                }

                if ( isset( $theme_dependencies['chips_hook'] ) && is_array($theme_dependencies['chips_hook'] ) ) {
                    foreach ( $theme_dependencies['chips_hook'] as $compat_chips_hook ) {
                        $new_chips_hooks[] = $compat_chips_hook;
                    }
                }

                $filter_settings['show_terms_in_content'] = $new_chips_hooks;
                update_option('wpc_filter_settings', $filter_settings );
            }
        }

        public function loadTextdomain()
        {
            load_plugin_textdomain( 'filter-everything', false, dirname(FLRT_PLUGIN_BASENAME) . '/lang' );
        }

        public function oneTwoThreeGo()
        {
            global $flrt_plugin;
            $flrt_plugin = new \FilterEverything\Filter\Plugin();
        }

        /**
         * @since 1.6.1
         */
        public function afterSetupTheme()
        {
            $this->define( 'FLRT_ALLOW_PLL_TRANSLATIONS', true );
        }

        private function initSettings(){
            $container = \FilterEverything\Filter\Container::instance();

            $settings['php_to_js_date_formats'] = array(
                'Y' => 'yy',
                'y' => 'y',
                'm' => 'mm',
                'n' => 'm',
                'F' => 'MM',
                'M' => 'M',
                'l' => 'DD',
                'D' => 'D',
                'd' => 'dd',
                'j' => 'd',
                'S' => '',
            );

            $settings['php_to_js_time_formats'] = array(
                'a' => 'tt',
                'A' => 'TT',
                'h' => 'hh',
                'g' => 'h',
                'H' => 'HH',
                'G' => 'H',
                'i' => 'mm',
                's' => 'ss',
            );

            foreach ( $settings as $key => $value ) {
                $container->storeParam( $key, $value );
            }
        }

        public function define( $name, $value = true )
        {
            if( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

    }

    function flrt_filter()
    {
        global $wpcFilter;

        if( ! isset( $wpcFilter ) ) {
            $wpcFilter = new FlrtFilter();
            $wpcFilter->init();
        }

        return $wpcFilter;

    }

    flrt_filter();

endif;