<?php

namespace WeglotWP\Actions\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Models\Hooks_Interface_Weglot;
use WeglotWP\Helpers\Helper_Post_Meta_Weglot;
use WeglotWP\Services\Language_Service_Weglot;
use WeglotWP\Services\Option_Service_Weglot;
use WeglotWP\Services\Request_Url_Service_Weglot;

/**
 *
 * @since 2.1.0
 */
class Metabox_Visual_Editor_Weglot implements Hooks_Interface_Weglot {
	protected $languages = null;
	/**
	 * @var Option_Service_Weglot
	 */
	private $option_services;

	/**
	 * @var Request_Url_Service_Weglot
	 */
	private $request_url_services;
	/**
	 * @var Language_Service_Weglot
	 */
	private $language_services;

	/**
	 * @since 2.1.0
	 */
	public function __construct() {
		$this->option_services      = weglot_get_service( 'Option_Service_Weglot' );
		$this->request_url_services = weglot_get_service( 'Request_Url_Service_Weglot' );
		$this->language_services    = weglot_get_service( 'Language_Service_Weglot' );
	}

	/**
	 * @return void
	 * @since 2.1.0
	 * @see Hooks_Interface_Weglot
	 *
	 */
	public function hooks() {
		add_action( 'add_meta_boxes', array( $this, 'weglot_visual_editor_add_meta_box' ) );

		$post_type = apply_filters(
			'weglot_column_post_type',
			array(
				'post',
				'page',
			)
		);

		foreach ( $post_type as $pt ) {
			add_filter( "manage_" . $pt . "_posts_columns", array( $this, 'register_column' ) );
			add_action( "manage_" . $pt . "_posts_custom_column", array( $this, 'handle_column_value' ), 10, 2 );
		}
		add_action( 'admin_head', array( $this, 'weglot_admin_print_head' ) );
	}


	public function weglot_visual_editor_add_meta_box() {

		$post_type = apply_filters(
			'weglot_metabox_post_type',
			array(
				'post',
				'page',
			)
		);

		add_meta_box(
			'weglot_visual_editor_meta_box', // Unique ID
			'Weglot URLs', // Title
			array( $this, 'weglot_visual_editor_meta_box_callback' ), // Callback function
			$post_type, // Post type
			'side', // Context
			'high' // Priority
		);
	}


	public function weglot_visual_editor_meta_box_callback( $post ) {
		echo '<ul>';
		$path = get_permalink( $post->ID );
		$this->get_weglot_path_status( $path, true );

		echo '';
	}

	public function weglot_visual_editor_save_meta_box( $post_id ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	public function register_column( $defaults ) {

		$defaults['wg-visual-editor-url'] = '<div class="wg-column-admin tooltip"><span class="tooltiptext">Edit your translations and exclusions</span></div>';

		return $defaults;
	}

	public function handle_column_value( $column_name, $post_id ) {

		if ( $column_name == 'wg-visual-editor-url' ) {
			$path = get_permalink( $post_id );
			$this->get_weglot_path_status( $path, false );
		}
	}

	/**
	 * Print in admin head
	 *
	 * @since 4.1
	 */
	public function weglot_admin_print_head() {
		?>
		<style type="text/css">
			.wg-column-admin.tooltip {
				position: relative;
				display: inline-block;
			}

			.wg-column-admin.tooltip::before {
				background: url('data:image/png;base64,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') no-repeat 0 0;
				background-size: 20px;
				content: " ";
				display: inline-block;
				width: 20px;
				height: 20px;
			}

			.wg-column-admin.tooltip .tooltiptext {
				visibility: hidden;
				width: 120px;
				bottom: 100%;
				left: 50%;
				margin-left: -70px;
				background-color: #18164c;
				color: #fff;
				text-align: center;
				font-size: 14px;
				padding: 10px;
				border-radius: 6px;
				opacity: 0.9;
				position: absolute;
				z-index: 1;
			}

			.wg-column-admin.tooltip .tooltiptext::after {
				content: " ";
				position: absolute;
				top: 100%;
				left: 50%;
				margin-left: -5px;
				border-width: 5px;
				border-style: solid;
				border-color: #18164c transparent transparent transparent;
			}

			.wg-column-admin.tooltip:hover .tooltiptext {
				visibility: visible;
			}

		</style>
		<?php
	}

	/**
	 * @param $path
	 *
	 * @return void
	 */
	public function get_weglot_path_status( $path, $list ): void {
		$wg_path       = $this->request_url_services->create_url_object( $path );
		$organization_slug = $this->option_services->get_option('organization_slug');
		$project_slug = $this->option_services->get_option('project_slug');
		$visual_editor = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/translations/visual-editor/launch?mode=translations&url='.$wg_path->getUrl(), 'weglot' );
		$visual_exclusion = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/translations/visual-editor/launch?mode=exclusions&url='.$wg_path->getUrl(), 'weglot' );
		$url_exclusion = esc_url( 'https://dashboard.weglot.com/workspaces/' . $organization_slug . '/projects/'. $project_slug .'/settings/exclusions#excluded-urls', 'weglot' );

		if ( $list ) {
			echo '<a class="components-button is-secondary" href="' . esc_url( $visual_editor ) . '" target="_blank">Edit translations</a><br /><br />';
			echo '<a class="components-button is-secondary" href="' . esc_url( $visual_exclusion ) . '" target="_blank">Block exclusions</a><br /><br />';
			echo '<a class="components-button is-secondary" href="' . esc_url( $url_exclusion ) . '" target="_blank">Url exclusions</a><br />';
		} else {
			echo '<a target="_blank" href="' . esc_url( $visual_editor ) . '" title="Edit your translations">Edit translations</a>';
			echo '<br /><a target="_blank" href="' . esc_url( $visual_exclusion ) . '" title="Edit exclusions">Block exclusions</a>';
			echo '<br /><a target="_blank" href="' . esc_url( $url_exclusion ) . '" title="Url exclusions">Url exclusions</a>';
		}
	}

}
