<?php
/**
 * Suggest other relevant free plugins to our users.
 *
 * @package WPCode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WPCode_Suggested_Plugins
 */
class WPCode_Suggested_Plugins {

	/**
	 * WPCode_Suggested_Plugins constructor.
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Hooks for the class.
	 */
	public function hooks() {
		add_action( 'wp_ajax_wpcode_install_plugin', array( $this, 'install_plugin' ) );
		// Maybe suggest plugins to the current user.
		add_action( 'admin_init', array( $this, 'maybe_suggest_plugins' ) );
	}

	/**
	 * Get all plugins that we suggest.
	 *
	 * @return array
	 */
	public static function all_plugins() {
		$plugins = array(
			'duplicator'            => array(
				'name'        => 'Duplicator',
				'description' => esc_html__( 'Easy, Fast and Secure WordPress and Website Migration.', 'insert-headers-and-footers' ),
				'url'         => 'https://downloads.wordpress.org/plugin/duplicator.zip',
				'slug'        => 'duplicator/duplicator.php',
				'pro_slug'    => 'duplicator-pro/duplicator-pro.php',
				'icon'        => 'icon-duplicator.png',
			),
			'search-replace-wpcode' => array(
				'name'        => 'Search & Replace Everything',
				'description' => esc_html__( 'Replace text across your database or media uploads in a single plugin.', 'insert-headers-and-footers' ),
				'url'         => 'https://downloads.wordpress.org/plugin/search-replace-wpcode.zip',
				'slug'        => 'search-replace-wpcode/wsrw.php',
				'pro_slug'    => 'search-replace-wpcode-pro/wsrw-premium.php',
				'icon'        => 'icon-search-replace-wpcode.png',
			),
			'wp-mail-smtp'          => array(
				'name'        => 'WP Mail SMTP',
				'description' => esc_html__( 'Making Email Deliverability Easy for WordPress', 'insert-headers-and-footers' ),
				'url'         => 'https://downloads.wordpress.org/plugin/wp-mail-smtp.zip',
				'slug'        => 'wp-mail-smtp/wp_mail_smtp.php',
				'pro_slug'    => 'wp-mail-smtp-pro/wp_mail_smtp_pro.php',
				'icon'        => 'icon-wp-mail-smtp.png',
			),
			'all-in-one-seo-pack'   => array(
				'name'        => 'All in One SEO Pack',
				'description' => esc_html__( 'Powerful SEO Plugin to Boost SEO Rankings & Increase Traffic.', 'insert-headers-and-footers' ),
				'url'         => 'https://downloads.wordpress.org/plugin/all-in-one-seo-pack.zip',
				'slug'        => 'all-in-one-seo-pack/all_in_one_seo_pack.php',
				'pro_slug'    => 'all-in-one-seo-pack-pro/all_in_one_seo_pack.php',
				'icon'        => 'icon-all-in-one-seo-pack.png',
			),
			'wpforms'               => array(
				'name'        => 'WPForms',
				'description' => esc_html__( 'The Best Drag & Drop WordPress Form Builder.', 'insert-headers-and-footers' ),
				'url'         => 'https://downloads.wordpress.org/plugin/wpforms-lite.zip',
				'slug'        => 'wpforms-lite/wpforms.php',
				'pro_slug'    => 'wpforms/wpforms.php',
				'icon'        => 'icon-wpforms.png',
			),
			'uncanny-automator'     => array(
				'name'        => 'Uncanny Automator',
				'description' => esc_html__( 'Connect your WordPress plugins together and create automated workflows.', 'insert-headers-and-footers' ),
				'url'         => 'https://downloads.wordpress.org/plugin/uncanny-automator.zip',
				'slug'        => 'uncanny-automator/uncanny-automator.php',
				'pro_slug'    => 'uncanny-automator-pro/uncanny-automator-pro.php',
				'icon'        => 'icon-uncanny-automator.png',
			),
		);

		return $plugins;
	}

	/**
	 * Get a list of plugins to suggest.
	 *
	 * @param int $count How many plugins to suggest.
	 *
	 * @return array
	 */
	public function get_suggested_plugins( $count = 3 ) {
		$plugins = self::all_plugins();

		// Let's loop through all the plugins and see which are installed already and only suggest the ones that are not. We should check for the pro version for each one.
		$suggested_plugins = array();
		foreach ( $plugins as $slug => $plugin ) {
			if ( $count <= count( $suggested_plugins ) ) {
				break;
			}

			if ( ! $this->is_plugin_installed( $plugin['slug'] ) && ! $this->is_plugin_installed( $plugin['pro_slug'] ) ) {
				$suggested_plugins[ $slug ] = $plugin;
			}
		}

		return $suggested_plugins;
	}

	/**
	 * Check if a plugin is installed.
	 *
	 * @param string $slug The plugin slug.
	 *
	 * @return bool
	 */
	public function is_plugin_installed( $slug ) {
		$installed_plugins = array_keys( get_plugins() );

		return in_array( $slug, $installed_plugins, true );
	}

	/**
	 * AJAX callback to install a plugin.
	 *
	 * @return void
	 */
	public function install_plugin() {
		check_ajax_referer( 'wpcode_admin' );

		// If the current user can't install plugins they should not be trying this.
		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error();
		}

		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/template.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-screen.php';
		require_once ABSPATH . 'wp-admin/includes/screen.php';

		$allowed_plugins = self::all_plugins();
		$slug            = isset( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';

		if ( ! array_key_exists( $slug, $allowed_plugins ) ) {
			wp_send_json_error();
		}

		$plugin_info = $allowed_plugins[ $slug ];

		// Set the current screen to avoid undefined notices.
		set_current_screen( 'toplevel_page_wpcode' );
		// Do not allow WordPress to search/download translations, as this will break JS output.
		remove_action( 'upgrader_process_complete', array( 'Language_Pack_Upgrader', 'async_upgrade' ), 20 );

		// Let's check if the plugin is already installed.
		if ( is_plugin_active( $plugin_info['slug'] ) ) {
			wp_send_json_success(
				array(
					'msg' => esc_html__( 'Plugin already installed and activated.', 'insert-headers-and-footers' ),
				)
			);
		}

		if ( $this->is_plugin_installed( $plugin_info['slug'] ) ) {
			activate_plugin( $plugin_info['slug'] );
			wp_send_json_success(
				array(
					'msg' => esc_html__( 'Plugin activated.', 'insert-headers-and-footers' ),
				)
			);
		}

		// Also check for the pro version.
		if ( $this->is_plugin_installed( $plugin_info['pro_slug'] ) ) {
			activate_plugin( $plugin_info['pro_slug'] );
			wp_send_json_success(
				array(
					'msg' => esc_html__( 'Plugin activated.', 'insert-headers-and-footers' ),
				)
			);
		}

		wpcode_require_upgrader();

		// Create the plugin upgrader with our custom skin.
		$installer = new Plugin_Upgrader( new WPCode_Skin() );

		$installer->install( $allowed_plugins[ $slug ]['url'] );

		// Flush the cache and return the newly installed plugin basename.
		wp_cache_flush();

		$plugin_basename = $installer->plugin_info();
		if ( ! $plugin_basename ) {
			wp_send_json_error();
		}

		// Activate the plugin silently.
		$activated = activate_plugin( $plugin_basename );

		if ( is_wp_error( $activated ) ) {
			wp_send_json_error();
		}

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Plugin installed and activated.', 'insert-headers-and-footers' ),
			)
		);
	}

	/**
	 * Maybe suggest plugins to the current user.
	 */
	public function maybe_suggest_plugins() {
		if ( ! is_super_admin() || ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		// Verify that we can do a check to suggest plugins.
		$notices = get_option( 'wpcode_admin_notices', array() );
		$time    = time();
		$load    = false;

		if ( empty( $notices['suggest_plugins'] ) ) {
			$notices['suggest_plugins'] = array(
				'time'      => $time,
				'dismissed' => false,
			);

			update_option( 'wpcode_admin_notices', $notices );

			return;
		}

		// Check if it has been dismissed or not.
		if (
			( isset( $notices['suggest_plugins']['dismissed'] ) &&
			  ! $notices['suggest_plugins']['dismissed'] ) &&
			(
				isset( $notices['suggest_plugins']['time'] ) &&
				( ( $notices['suggest_plugins']['time'] + DAY_IN_SECONDS ) <= $time )
			)
		) {
			$load = true;
		}

		// If we cannot load, return early.
		if ( ! $load ) {
			return;
		}

		add_action( 'admin_head', array( $this, 'suggest_plugins' ) );
	}

	/**
	 * Suggest plugins to the current user.
	 */
	public function suggest_plugins() {
		// Let's make sure we are on a wpcode screen using get_current_screen.
		$screen = get_current_screen();

		if ( ! $screen || false === strpos( $screen->id, 'wpcode' ) ) {
			return;
		}
		// Fetch when plugin was initially installed.
		$activated = get_option( 'ihaf_activated', array() );

		if ( ! empty( $activated['wpcode'] ) ) {
			// Only continue if plugin has been installed for at least 21 days.
			if ( ( $activated['wpcode'] + ( DAY_IN_SECONDS * 21 ) ) > time() ) {
				return;
			}
		} else {
			$activated['wpcode'] = time();

			update_option( 'ihaf_activated', $activated );

			return;
		}

		$suggested_plugins = $this->get_suggested_plugins();

		if ( empty( $suggested_plugins ) ) {
			return;
		}

		ob_start();
		?>
		<p class="wpcode-suggestions-title"><?php esc_html_e( 'Enjoying WPCode? Check out some of our other top-rated FREE plugins:', 'insert-headers-and-footers' ); ?></p>
		<div class="wpcode-plugin-suggestions">
			<?php foreach ( $suggested_plugins as $slug => $plugin ) { ?>
				<div class="wpcode-plugin-suggestion-plugin">
					<div class="wpcode-plugin-suggestion-plugin-icon">
						<img width="72" src="<?php echo esc_url( WPCODE_PLUGIN_URL . 'admin/images/' . $plugin['icon'] ); ?>" alt="<?php echo esc_attr( $plugin['name'] ); ?>"/>
					</div>
					<div class="wpcode-plugin-suggesion-plugin-text">
						<h3><?php echo esc_html( $plugin['name'] ); ?></h3>
						<p><?php echo esc_html( $plugin['description'] ); ?></p>
						<button type=" button" class="wpcode-button wpcode-button-secondary wpcode-button-install-plugin" data-slug="<?php echo esc_attr( $slug ); ?>"><?php esc_html_e( 'Install Plugin', 'insert-headers-and-footers' ); ?></button>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php

		WPCode_Notice::info(
			ob_get_clean(),
			array(
				'dismiss' => WPCode_Notice::DISMISS_GLOBAL,
				'slug'    => 'suggest_plugins',
				'autop'   => false,
				'class'   => 'wpcode-suggest-plugins-notice',
			)
		);
	}
}
