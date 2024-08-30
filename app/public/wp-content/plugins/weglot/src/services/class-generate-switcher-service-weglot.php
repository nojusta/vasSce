<?php

namespace WeglotWP\Services;

use Weglot\Parser\Formatter\CustomSwitchersFormatter;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * @since 2.3.0
 */
class Generate_Switcher_Service_Weglot {
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
	 * @var Button_Service_Weglot
	 */
	private $button_services;

	/**
	 * @since 2.3.0
	 */
	public function __construct() {
		$this->option_services      = weglot_get_service( 'Option_Service_Weglot' );
		$this->request_url_services = weglot_get_service( 'Request_Url_Service_Weglot' );
		$this->language_services    = weglot_get_service( 'Language_Service_Weglot' );
		$this->button_services      = weglot_get_service( 'Button_Service_Weglot' );
	}

	/**
	 * @param string $dom
	 *
	 * @return string
	 * @since 2.3.0
	 *
	 */
	public function replace_div_id( $dom ) {
		if ( strpos( $dom, '<div id="weglot_here"></div>' ) === false ) {
			return $dom;
		}

		$button_html = $this->button_services->get_html( 'weglot-shortcode' );
		$dom         = str_replace( '<div id="weglot_here"></div>', $button_html, $dom );

		return apply_filters( 'weglot_replace_div_id', $dom );
	}

	/**
	 * @param string $dom
	 *
	 * @return string
	 * @since 2.3.0
	 * @version 3.0.0
	 */
	public function check_weglot_menu( $dom ) {
		return apply_filters( 'weglot_replace_weglot_menu', $dom );
	}

	/**
	 * @param string $dom
	 *
	 * @return string
	 * @since 2.3.0
	 */
	public function render_default_button( $dom ) {
		if ( strpos( $dom, 'weglot-language' ) !== false ) {
			return $dom;
		}

		// Place the button if not in the page.
		$button_html = $this->button_services->get_html( 'weglot-default' );
		$dom         = ( strpos( $dom, '</body>' ) !== false ) ? str_replace( '</body>', $button_html . ' </body>', $dom ) : str_replace( '</footer>', $button_html . ' </footer>', $dom );

		return apply_filters( 'weglot_render_default_button', $dom );
	}

	/**
	 * @param string $dom the final HTML.
	 * @param array $switchers the array of switchers from settings.
	 *
	 * @return string
	 * @since 2.3.0
	 */
	public function render_switcher_editor_button( $dom, $switchers ) {

		// get translate dom and add custom switcher in.
		$dom = \WGSimpleHtmlDom\str_get_html(
			$dom,
			true,
			true,
			WG_DEFAULT_TARGET_CHARSET,
			false
		);

		$custom_switchers = new CustomSwitchersFormatter( $dom, $switchers );
		$dom              = $custom_switchers->getDom();
		$dom              = $dom->save();

		// Place the button if not in the page.
		$find_location = false;
		$responsive_style = "";
		foreach ( $switchers as $key => $switcher ) {
			$responsive_style .= $this->add_responsive_style( $switcher, $key );
			$location = $this->option_services->get_switcher_editor_option( 'location', $switcher );
			if ( ! empty( $location ) && ! isset( $switcher['template'] ) ) {
				$button_html = $this->button_services->get_html( 'weglot-custom-switcher', $switcher, '', '', $key );
				$key         = $location['target'] . ( ! empty( $location['sibling'] ) ? ' ' . $location['sibling'] : '' );
				if ( strpos( $dom, '<div data-wg-position="' . $key . '"></div>' ) !== false ) {
					$dom           = str_replace( '<div data-wg-position="' . $key . '"></div>', $button_html, $dom );
					$find_location = true;
				} elseif ( strpos( $dom, '<div data-wg-position="' . $key . '" data-wg-ajax="true"></div>' ) !== false ) {
					$attr_target      = ! empty( $location['target'] ) ? $location['target'] : '';
					$attr_sibling     = ! empty( $location['sibling'] ) ? $location['sibling'] : '';
					$button_ajax_html = $this->button_services->get_html( 'weglot-custom-switcher-ajax', $switcher, $attr_target, $attr_sibling, $key );
					$dom              = str_replace( '<div data-wg-position="' . $key . '" data-wg-ajax="true"></div>', $button_ajax_html, $dom );
					$find_location    = true;
				} else {
					$button_html   = $this->button_services->get_html( 'weglot-custom-switcher-ajax location-not-found', $switcher, '', '', $key );
					$dom           = str_replace( '</body>', $button_html, $dom );
					$find_location = true;
				}
			} else {
				// if the location is empty we place the button at default position.
				if ( ! isset( $switcher['template'] ) ) {
					$button_html = $this->button_services->get_html( 'weglot-default', $switcher );
					$dom         = str_replace( '</body>', $button_html, $dom );
				}
				$find_location = true;
			}
		}
		if(strlen($responsive_style) > 0){
			$responsive_style = '<style type="text/css">' . $responsive_style . '</style>';
			$dom         = str_replace( '</head>', $responsive_style, $dom );
		}

		if ( ! $find_location ) {
			return false;
		}

		return apply_filters( 'weglot_render_switcher_editor_button', $dom );
	}

	/**
	 * @param array $switcher
	 *
	 * @return string
	 * @since 2.3.0
	 * @version 3.0.0
	 */
	public function add_responsive_style( $switcher = array(), $pos='' ) {
		$style = '';
		if ( ! empty( $switcher['opts'] ) ) {
			$opts                = $switcher['opts'];
			$is_responsive = $this->option_services->get_switcher_editor_option( 'is_responsive', $opts );
			if($is_responsive){
				$display_device = !empty($opts['display_device']) ? $opts['display_device'] : 'desktop';
				$pixel_cutoff = !empty($opts['pixel_cutoff']) ? $opts['pixel_cutoff'] : 450;

				switch ($display_device) {
					case 'mobile':
						$style .= '@media only screen and (max-device-width : '.$pixel_cutoff.'px) { .wg-'.$pos.'{ display:none; } }
						';
						break;
					case 'desktop':
						$style .= '@media only screen and (min-device-width : '.$pixel_cutoff.'px) { .wg-'.$pos.'{ display:none; } }
						';
						break;
				}
			}
		}

		return $style;
	}
	/**
	 * @param string $dom the final HTML.
	 *
	 * @return string
	 * @since 2.3.0
	 */
	public function generate_switcher_from_dom( $dom ) {
		$dom = $this->replace_div_id( $dom );
		$dom = $this->check_weglot_menu( $dom );

		// check if custom switcher(s) exist in settings otherwise return default switcher.
		if ( ! empty( $this->option_services->get_switchers_editor_button() ) ) {
			$dom_with_switchers = $this->render_switcher_editor_button( $dom, $this->option_services->get_switchers_editor_button() );
		}

		$dom = ! empty( $dom_with_switchers ) ? $dom_with_switchers : $this->render_default_button( $dom );

		return apply_filters( 'weglot_generate_switcher_from_dom', $dom );
	}
}
