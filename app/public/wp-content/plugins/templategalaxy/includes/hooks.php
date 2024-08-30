<?php

/**
 * templategalaxy_demo_importer hooks callback functionality of the plugin.
 *
 * Since 1.0.0
 *
 * @package    templategalaxy_demo_importer
 */
class templategalaxy_Demo_Importer_Hooks
{

    /**
     * current added Menu hook_suffix
     *
     * @since    1.0.0
     * @access   public
     * @var      array    $logs    Store logs and errors.
     */
    private $hook_suffix;


    /**
     * theme author name
     *
     * @since    1.0.0
     * @access   public
     * @var      array    $logs    Store logs and errors.
     */
    private $theme_author = 'WebsiteinWP';

    /**
     * Main Instance
     *
     * Insures that only one instance of templategalaxy_demo_importer exists in memory at any one
     * time. Also prevents needing to define globals all over the place.
     *
     * @since    1.0.0
     * @access   public
     *
     * @return object
     */
    public static function instance()
    {

        // Store the instance locally to avoid private static replication
        static $instance = null;

        // Only run these methods if they haven't been ran previously
        if (null === $instance) {
            $instance = new self();
        }

        // Always return the instance
        return $instance;
    }

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
    }

    /**
     * Redirect to plugin page when plugin activated
     *
     * @since 1.0.0
     */
    public static function redirect()
    {
        if (get_option('__templategalaxy_demo_importer_do_redirect')) {
            update_option('__templategalaxy_demo_importer_do_redirect', false);
            if (!is_multisite()) {
                exit(wp_redirect(admin_url('themes.php?page=advanced-import')));
            }
        }
    }
    /**
     * Add admin menus
     * @access public
     */
    public function _ct_import_menu()
    {
        if (!class_exists('Advanced_Import')) {
            $this->hook_suffix[] = add_theme_page(esc_html__('Demo Import', 'templategalaxy'), esc_html__('CT Demo Imports'), 'manage_options', 'advanced-import', array($this, 'demo_import_screen'));
        }
    }

    public function _ct_import_menu_custom_label($translated_text, $text, $domain)
    {
        if (class_exists('Advanced_Import')) {
            if ($text === 'Demo Import') { // Check if the original label is 'Demo Import'
                $translated_text = __('CT Demo Importer', 'templategalaxy');
            }
            return $translated_text;
        }
    }

    // Hook into the gettext filter
    //


    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts($hook_suffix)
    {
        if (!is_array($this->hook_suffix) || !in_array($hook_suffix, $this->hook_suffix)) {
            return;
        }

        // wp_enqueue_script( 'templategalaxy', templategalaxy_DEMO_IMPORTER_URL . 'admin/js/WebsiteinWP-demo-importer-admin.js', array( 'jquery'), TEMPLATEGALAXY_VERSION, true );
        wp_localize_script('templategalaxy', 'templategalaxy_demo_importer', array(
            'btn_text' => esc_html__('Processing...', 'templategalaxy'),
            'nonce'    => wp_create_nonce('templategalaxy_demo_importer_nonce')
        ));
    }

    /**
     * Show the plugin recommended screen
     * @access public
     * @return void
     */
    public function demo_import_screen()
    {
?>
        <div id="ads-notice">
            <div class="ads-container">
                <img class="ads-screenshot" src="<?php echo esc_url(templategalaxy_demo_importer_get_theme_screenshot()) ?>" alt="<?php esc_html(templategalaxy_demo_importer_get_theme_name()); ?>" />
                <div class="ads-notice">
                    <h2>
                        <?php
                        printf(
                            /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__('Welcome! Thank you for choosing %1$s! To get started with ready-made starter site templates. Install the Advanced Import plugin and install Demo Starter Site within a single click', 'templategalaxy'),
                            '<strong>' . wp_get_theme()->get('Name') . '</strong>'
                        );
                        ?>
                    </h2>

                    <p class="plugin-install-notice"><?php esc_html_e('Clicking the button below will install and activate the Advanced Import plugin.', 'templategalaxy'); ?></p>

                    <a class="ads-gsm-btn button button-primary button-hero" href="#" data-name="" data-slug="" aria-label="<?php esc_html_e('Get started with the Theme', 'templategalaxy'); ?>">
                        <?php esc_html_e('Get Started', 'templategalaxy'); ?>
                    </a>
                </div>
            </div>
        </div>
<?php

    }



    /**
     * Get Started Notice
     * Active callback of wp_ajax
     * return void
     */
    public function install_advanced_import()
    {

        check_ajax_referer('templategalaxy_demo_importer_nonce', 'security');

        $slug   = 'advanced-import';
        $plugin = 'advanced-import/advanced-import.php';

        $status = array(
            'install' => 'plugin',
            'slug'    => sanitize_key(wp_unslash($slug)),
        );
        $status['redirect'] = admin_url('/themes.php?page=advanced-import&browse=all&at-gsm-hide-notice=welcome');

        if (is_plugin_active_for_network($plugin) || is_plugin_active($plugin)) {
            // Plugin is activated
            wp_send_json_success($status);
        }


        if (!current_user_can('install_plugins')) {
            $status['errorMessage'] = __('Sorry, you are not allowed to install plugins on this site.', 'templategalaxy');
            wp_send_json_error($status);
        }

        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

        // Looks like a plugin is installed, but not active.
        if (file_exists(WP_PLUGIN_DIR . '/' . $slug)) {
            $plugin_data          = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
            $status['plugin']     = $plugin;
            $status['pluginName'] = $plugin_data['Name'];

            if (current_user_can('activate_plugin', $plugin) && is_plugin_inactive($plugin)) {
                $result = activate_plugin($plugin);

                if (is_wp_error($result)) {
                    $status['errorCode']    = $result->get_error_code();
                    $status['errorMessage'] = $result->get_error_message();
                    wp_send_json_error($status);
                }

                wp_send_json_success($status);
            }
        }

        $api = plugins_api(
            'plugin_information',
            array(
                'slug'   => sanitize_key(wp_unslash($slug)),
                'fields' => array(
                    'sections' => false,
                ),
            )
        );

        if (is_wp_error($api)) {
            $status['errorMessage'] = $api->get_error_message();
            wp_send_json_error($status);
        }

        $status['pluginName'] = $api->name;

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader($skin);
        $result   = $upgrader->install($api->download_link);

        if (defined('WP_DEBUG') && WP_DEBUG) {
            $status['debug'] = $skin->get_upgrade_messages();
        }

        if (is_wp_error($result)) {
            $status['errorCode']    = $result->get_error_code();
            $status['errorMessage'] = $result->get_error_message();
            wp_send_json_error($status);
        } elseif (is_wp_error($skin->result)) {
            $status['errorCode']    = $skin->result->get_error_code();
            $status['errorMessage'] = $skin->result->get_error_message();
            wp_send_json_error($status);
        } elseif ($skin->get_errors()->get_error_code()) {
            $status['errorMessage'] = $skin->get_error_messages();
            wp_send_json_error($status);
        } elseif (is_null($result)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
            global $wp_filesystem;

            $status['errorCode']    = 'unable_to_connect_to_filesystem';
            $status['errorMessage'] = __('Unable to connect to the filesystem. Please confirm your credentials.', 'templategalaxy');

            // Pass through the error from WP_Filesystem if one was raised.
            if ($wp_filesystem instanceof WP_Filesystem_Base && is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code()) {
                $status['errorMessage'] = esc_html($wp_filesystem->errors->get_error_message());
            }

            wp_send_json_error($status);
        }

        $install_status = install_plugin_install_status($api);

        if (current_user_can('activate_plugin', $install_status['file']) && is_plugin_inactive($install_status['file'])) {
            $result = activate_plugin($install_status['file']);

            if (is_wp_error($result)) {
                $status['errorCode']    = $result->get_error_code();
                $status['errorMessage'] = $result->get_error_message();
                wp_send_json_error($status);
            }
        }
        wp_send_json_success($status);
    }

    /**
     * Function to fetch templates.
     *
     * @param $current_demo_list array
     * @return array
     */
    public function add_demo_lists($current_demo_list)
    {
        $current_theme = wp_get_theme();
        if ($current_theme == 'newsmaggy') {
            $final_theme_name = __('NewsMaggy', 'templategalaxy');
        } else {
            $final_theme_name = $current_theme;
        }
        echo '<h4 class="importer-notice">' . sprintf(__('Thank you for choosing the %s theme. This quick demo import setup will help you configure your new website like theme demo. It will install the required WordPress plugins, default content and tell you a little about Help & Support options. It should only take less than 5 minutes.', 'templategalaxy'), $final_theme_name) . '</h4>';

        $theme_slug = templategalaxy_demo_importer_get_current_theme_slug();
        $templates = templategalaxy_demo_importer_get_templates_lists($theme_slug);

        return array_merge($current_demo_list, $templates);
    }
}

/**
 * Begins execution of the hooks.
 *
 * @since    1.0.0
 */
function templategalaxy_demo_importer_hooks()
{
    return templategalaxy_Demo_Importer_Hooks::instance();
}
