<?php

namespace WeglotWP\Actions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Models\Hooks_Interface_Weglot;
use WeglotWP\Services\Button_Service_Weglot;

/**
 * Registe widget weglot
 *
 * @since 2.0
 */
class Register_Widget_Weglot implements Hooks_Interface_Weglot {

	/**
	 * @return void
	 * @see HooksInterface
	 */
	public function hooks() {
		add_action( 'widgets_init', array( $this, 'register_a_widget_weglot' ) ); // @phpstan-ignore-line
		add_action( 'init', array( $this, 'weglot_widget_block' ) );
		add_action( 'init', array( $this, 'weglot_menu_block' ) );

		// Hook the enqueue functions into the editor.
		add_action( 'enqueue_block_editor_assets', array( $this, 'my_block_plugin_editor_scripts' ) );
	}

	/**
	 * @return string
	 * @since 2.0
	 */
	public function register_a_widget_weglot() {
		register_widget( 'WeglotWP\Widgets\Widget_Selector_Weglot' ); // @phpstan-ignore-line
	}


	/**
	 * Enqueue block JavaScript and CSS for the editor
	 */
	public function my_block_plugin_editor_scripts() {
		// Enqueue block editor styles.
		wp_enqueue_style( 'weglot-editor-css', WEGLOT_URL_DIST . '/css/front-css.css', array( 'wp-edit-blocks' ), WEGLOT_VERSION );
	}

	/**
	 * @return string
	 * @throws \Exception
	 * @since 2.0
	 */
	public function weglot_widget_block_render_callback( $block_attributes, $content ) {

		$type_block = sanitize_text_field( $block_attributes['type'] );
		/** @var Button_Service_Weglot $button_service */
		$button_service = weglot_get_service( 'Button_Service_Weglot' );
		$class_name = '';
		$button = $button_service->get_html( 'weglot-widget weglot-widget-block' );

		if ( ! empty( $block_attributes['className'] ) ) {
			// Sanitize the className attribute
			$class_name = sanitize_text_field( str_replace( ',', ' ', $block_attributes['className'] ) );
			$class_name = str_replace( '  ', ' ', $class_name );
		}

		if ( 'widget' === $type_block ) {
			$button = $button_service->get_html( esc_attr( $class_name . ' weglot-widget weglot-widget-block ' ) );
			$button = str_replace( 'name="menu" ', 'name="menu" value=""', $button );
		} elseif ( 'menu' === $type_block ) {
			$button = $button_service->get_html( esc_attr( $class_name . ' weglot-menu weglot-menu-block ' ) );
			$button = str_replace( 'name="menu" ', 'name="menu" value=""', $button );
		}

		return $this->sanitize_switcher( $button );
	}

	/**
	 * @return string
	 * @since 2.0
	 */
	public function sanitize_switcher($button_html){

		$active_sanitizer = apply_filters( 'weglot_active_switcher_sanitizer', true );

		if( ! $active_sanitizer ){
			return $button_html;
		}
		// Define allowed HTML elements and attributes.
		$allowed_html = array(
			'aside' => array(
				'class' => array(),
				'data-wg-notranslate' => array(),
				'tabindex' => array(),
				'aria-expanded' => array(),
				'aria-label' => array()
			),
			'input' => array(
				'id' => array(),
				'class' => array(),
				'type' => array(),
				'name' => array()
			),
			'label' => array(
				'data-l' => array(),
				'tabindex' => array(),
				'for' => array(),
				'class' => array(),
				'data-code-language' => array(),
				'data-name-language' => array()
			),
			'ul' => array(
				'role' => array()
			),
			'li' => array(
				'data-l' => array(),
				'class' => array(),
				'data-code-language' => array(),
				'role' => array()
			),
			'a' => array(
				'title' => array(),
				'class' => array(),
				'role' => array(),
				'href' => array(),
				'data-wg-notranslate' => array()
			),
			'span' => array(
				'class' => array()
			)
		);
		$allowed_html = apply_filters('allowed_html_filter', $allowed_html);
		$patterns = [
			'/<script\b[^>]*>(.*?)<\/script>/s', // Detect <script> tags
			'/\bon\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^"\'<>\s]+)/i', // Detect inline event handlers (e.g., onmouseover)
		];
		foreach ($patterns as $pattern) {
			$button_html = preg_replace($pattern, '', $button_html);
		}

		return wp_kses( $button_html, $allowed_html );
	}

	/**
	 * @return void
	 * @since 2.0
	 */
	public function weglot_widget_block() {
		register_block_type(
			WEGLOT_DIR . '/blocks/weglot-widget/build',
			array(
				'api_version'     => 2,
				'attributes'      => array(
					'type' => array(
						'default' => 'widget',
						'type'    => 'string',
					),
				),
				'render_callback' => array( $this, 'weglot_widget_block_render_callback' ),
			)
		);
	}

	/**
	 * @return void
	 * @since 2.0
	 */
	public function weglot_menu_block() {
		register_block_type(
			WEGLOT_DIR . '/blocks/weglot-menu/build',
			array(
				'api_version'     => 2,
				'attributes'      => array(
					'type' => array(
						'default' => 'menu',
						'type'    => 'string',
					),
				),
				'render_callback' => array( $this, 'weglot_widget_block_render_callback' ),
			)
		);
	}
}
