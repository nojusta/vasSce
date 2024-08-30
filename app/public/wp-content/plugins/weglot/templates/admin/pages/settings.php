<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Helpers\Helper_Tabs_Admin_Weglot;
use WeglotWP\Services\Option_Service_Weglot;

$this->option_services    = weglot_get_service( 'Option_Service_Weglot' );
$organization_slug = $this->option_services->get_option('organization_slug');
$project_slug = $this->option_services->get_option('project_slug');
$project_dashboard_url = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/translations/languages/', 'weglot' );
$project_slug_url = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/translations/slugs/', 'weglot' );
$project_url_exclusions = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/settings/exclusions#excluded-urls', 'weglot' );
$project_blocks_exclusions = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/settings/exclusions#excluded-blocks', 'weglot' );
$project_switcher_editor = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/settings/language-switcher/editor', 'weglot' );
$project_auto_redirect = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/settings/general', 'weglot' );
$project_pageviews = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/statistics/page-views/', 'weglot' );

$url_form = wp_nonce_url(
	add_query_arg(
		[
			'action' => 'weglot_save_settings',
			'tab'    => $this->tab_active,
		],
		admin_url( 'admin-post.php' )
	),
	'weglot_save_settings'
);

?>

<div id="wrap-weglot">
	<?php
	if ( ! $this->options['has_first_settings'] ) :
		?>
		<div id="weglot-wrapper-infobox" class="wrap wrap-left">
			<div class="weglot-infobox weglot-wp-menu">
				<h3><img src="<?php echo esc_url(WEGLOT_DIRURL.'app/images/logo-wg.svg' ); ?>"></h3>
				<div>
					<ul>
						<li><a href="#main_configuration"><?php esc_html_e( 'Main configuration', 'weglot' ) ?></a></li>
						<li><a href="#language_button_position"><?php esc_html_e( 'Language button position', 'weglot' ) ?></a></li>
						<li><a href="#translation_exclusion"><?php esc_html_e( 'Translation Exclusion', 'weglot' ) ?></a></li>
						<li><a href="#other_options"><?php esc_html_e( 'Other options', 'weglot' ) ?></a></li>
					</ul>
				</div>
				<blockquote class="text-cen">Weglot - <?php echo esc_html(WEGLOT_VERSION); ?></blockquote>
			</div>

			<div class="weglot-infobox weglot-info-translation-box">
				<h3><?php esc_html_e( 'Where are my translations?', 'weglot' ); ?></h3>
				<div>
					<p><?php esc_html_e( 'You can find all your translations in your Weglot account:', 'weglot' ); ?></p>
					<a href="<?php echo esc_url( $project_dashboard_url ); ?>"
					   target="_blank" class="weglot-editbtn">
						<?php esc_html_e( 'Edit my translations', 'weglot' ); ?>
					</a>
					<p><span
							class="wp-menu-image dashicons-before dashicons-welcome-comments"></span><?php esc_html_e( 'When you edit your translations in Weglot, remember to clear your cache (if you have a cache plugin) to make sure you see the latest version of your page)', 'weglot' ); ?>
					</p>

				</div>
			</div>
		</div>
	<?php
	endif;
	?>
	<div class="wrap">
		<form method="post" id="mainform" action="<?php echo esc_url( $url_form ); ?>">
			<?php

			switch ( $this->tab_active ) {
				case Helper_Tabs_Admin_Weglot::SETTINGS:
				default:
					include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/settings.php';
					if ( ! $this->options['has_first_settings'] ) {
						include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/appearance.php';
						include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/advanced.php';
					}

					break;
				case Helper_Tabs_Admin_Weglot::STATUS:
					include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/status.php';
					break;
				case Helper_Tabs_Admin_Weglot::SUPPORT:
					include_once WEGLOT_TEMPLATES_ADMIN_PAGES . '/tabs/support.php';
					break;
			}

			if ( ! in_array( $this->tab_active, [ Helper_Tabs_Admin_Weglot::STATUS ], true ) ) {
				submit_button();
			}
			?>
			<input type="hidden" name="tab" value="<?php echo esc_attr( $this->tab_active ); ?>">
		</form>
		<?php if ( ! $this->options['has_first_settings'] ) : ?>
			<hr>
			<span class="dashicons dashicons-heart"></span>&nbsp;
			<a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/weglot?rate=5#postform">
				<?php esc_html_e( 'Love Weglot? Give us 5 stars on WordPress.org', 'weglot' ); ?>
			</a>
			<p class="weglot-five-stars">
				<?php
				// translators: 1 HTML Tag, 2 HTML Tag
				echo sprintf( esc_html__( 'If you need any help, you can contact us via email us at %1$ssupport@weglot.com%2$s.', 'weglot' ), '<a href="mailto:support@weglot.com?subject=Need help from WP plugin admin" target="_blank">', '</a>' );
				echo ' ';
				// translators: 1 HTML Tag, 2 HTML Tag
				echo sprintf( esc_html__( 'You can also check our %1$sFAQ%2$s.', 'weglot' ), '<a href="http://support.weglot.com/" target="_blank">', '</a>' ); ?>
			</p>
			<hr>
		<?php endif; ?>
	</div>

</div>

