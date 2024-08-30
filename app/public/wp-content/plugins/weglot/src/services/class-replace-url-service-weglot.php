<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Weglot\Parser\Parser;
use Weglot\Util\SourceType;
use WeglotWP\Helpers\Helper_Replace_Url_Weglot;


/**
 * Replace URL
 *
 * @since 2.0
 */
class Replace_Url_Service_Weglot {
	/**
	 * @var Request_Url_Service_Weglot
	 */
	private $request_url_services;
	/**
	 * @var Replace_Link_Service_Weglot
	 */
	private $replace_link_service;
	/**
	 * @var Multisite_Service_Weglot
	 */
	private $multisite_service;
	private $multisite_other_paths;
	/**
	 * @var Language_Service_Weglot
	 */
	private $language_services;
	/**
	 * @var Option_Service_Weglot
	 */
	private $option_services;

	/**
	 * @since 2.0
	 */
	public function __construct() {
		$this->request_url_services  = weglot_get_service( 'Request_Url_Service_Weglot' );
		$this->replace_link_service  = weglot_get_service( 'Replace_Link_Service_Weglot' );
		$this->multisite_service     = weglot_get_service( 'Multisite_Service_Weglot' );
		$this->language_services   = weglot_get_service( 'Language_Service_Weglot' );
		$this->option_services   = weglot_get_service( 'Option_Service_Weglot' );
		$this->multisite_other_paths = null;
		if ( is_multisite() ) {
			$this->multisite_other_paths = array_filter(
				$this->multisite_service->get_list_of_network_path(),
				function ( $elem ) {
					return $elem !== $this->request_url_services->get_home_wordpress_directory() . '/';
				}
			);
		}
	}

	/**
	 * @param string $dom
	 *
	 * @return string
	 * @since 2.3.0
	 *
	 */
	public function replace_link_in_dom( $dom ) {

		$data = Helper_Replace_Url_Weglot::get_replace_modify_link();

		foreach ( $data as $key => $value ) {
			$dom = $this->modify_link( $value, $dom, $key );
		}

		$current_language = $this->request_url_services->get_current_language();
		$current_url      = $this->request_url_services->get_weglot_url();

		if ( $current_url->getForLanguage( $current_language, false ) ) {
			if ( $current_language->getExternalCode() !== $current_language->getInternalCode() ) {
				$dom = preg_replace(
					'/<html (.*?)?lang=(\"|\')(\S*)(\"|\')/',
					'<html $1lang=$2' . $current_language->getExternalCode() . '$4 weglot-lang=$2' . $current_language->getInternalCode() . '$4',
					$dom
				);
			} else {
				$dom = preg_replace(
					'/<html (.*?)?lang=(\"|\')(\S*)(\"|\')/',
					'<html $1lang=$2' . $current_language->getExternalCode() . '$4',
					$dom
				);
			}

			$dom = preg_replace(
				'/property="og:locale" content=(\"|\')(\S*)(\"|\')/',
				'property="og:locale" content=$1' . $current_language->getExternalCode() . '$3',
				$dom
			);
		} else {
			$dom = preg_replace(
				'/<html (.*?)?lang=(\"|\')(\S*)(\"|\')/',
				'<html $1lang=$2$3$4 data-excluded-page="true"',
				$dom
			);
		}

		return apply_filters( 'weglot_replace_link', $dom );
	}

	public function replace_link_in_json( $json ) {
		$replace_urls = apply_filters( 'weglot_ajax_replace_urls', [ 'redirecturl', 'url', 'link' ] );
		foreach ( $json as $key => $val ) {
			if ( is_array( $val ) ) {
				$json[ $key ] = $this->replace_link_in_json( $val );
			} else {
				if ( Parser::getSourceType( $val ) === SourceType::SOURCE_HTML ) {
					$json[ $key ] = $this->replace_link_in_dom( $val );
				} else {
					if ( in_array( $key, $replace_urls, true ) && $this->check_link( $val ) ) {
						$json[ $key ] = $this->replace_link_service->replace_url( $val, $this->request_url_services->get_current_language() );
					}
				}
			}
		}

		return $json;
	}

	/**
	 * @param string $dom
	 *
	 * @return string
	 * @since 2.3.0
	 *
	 */
	public function replace_link_in_xml( $dom ) {
		$data = Helper_Replace_Url_Weglot::get_replace_modify_link_in_xml();

		foreach ( $data as $key => $value ) {
			$dom = $this->modify_link_sitemap( $value, $dom, $key );
		}

		return apply_filters( 'weglot_replace_link', $dom );
	}

	/**
	 * @param string $dom
	 *
	 * @return string
	 * @since 2.3.0
	 *
	 */
	public function proxify_url( $dom ) {
		$proxify_urls = apply_filters( 'weglot_proxify_urls', [] );
		$original_language = $this->language_services->get_original_language()->getInternalCode();
		$current_language = $this->request_url_services->get_current_language()->getInternalCode();
		if( $original_language === $current_language){
			return $dom;
		}
		$api_key = $this->option_services->get_api_key( true );
		$api_key = preg_replace('/wg_/', '', $api_key);
		if( !empty($proxify_urls)){
			foreach ($proxify_urls as $url){
				$parsed_url = wp_parse_url($url);
				if( ! empty($parsed_url['path'] ) ){
					$new_proxify_url = 'https://proxy.weglot.com/' . $api_key . '/' . $original_language . '/' . $current_language . '/' . $parsed_url['host'] . $parsed_url['path'];
				}else{
					$new_proxify_url = 'https://proxy.weglot.com/' . $api_key . '/' . $original_language . '/' . $current_language . '/' . $parsed_url['host'];
				}
				$dom = str_replace( $url, $new_proxify_url, $dom);
			}
		}
		return $dom;
	}

	/**
	 * Replace link
	 *
	 * @param string $pattern
	 * @param string $translated_page
	 * @param string $type
	 *
	 * @return string
	 */
	public function modify_link( $pattern, $translated_page, $type ) {
		preg_match_all( $pattern, $translated_page, $out, PREG_PATTERN_ORDER );
		$count_out_0 = count( $out[0] );
		for ( $i = 0; $i < $count_out_0; $i ++ ) {
			$sometags    = ( isset( $out[1] ) ) ? $out[1][ $i ] : null;
			$quote1      = ( isset( $out[2] ) ) ? $out[2][ $i ] : null;
			$current_url = ( isset( $out[3] ) ) ? $out[3][ $i ] : null;
			$quote2      = ( isset( $out[4] ) ) ? $out[4][ $i ] : null;
			$sometags2   = ( isset( $out[5] ) ) ? $out[5][ $i ] : null;

			$length_link = apply_filters( 'weglot_length_replace_a', 1500 ); // Prevent error on long URL (preg_match_all Compilation failed: regular expression is too large at offset).
			if ( strlen( $current_url ) >= $length_link ) {
				continue;
			}

			if ( ! $this->check_link( $current_url, $sometags, $sometags2 ) ) {
				continue;
			}

			$function_name = apply_filters( 'weglot_modify_link_replace_function', 'replace_' . $type, $type );

			if ( method_exists( $this->replace_link_service, $function_name ) ) {
				$translated_page = $this->replace_link_service->$function_name(
					$translated_page,
					$current_url,
					$quote1,
					$quote2,
					$sometags,
					$sometags2
				);
			} else {
				if ( function_exists( $function_name ) ) {
					$translated_page = $function_name( $translated_page, $current_url, $quote1, $quote2, $sometags, $sometags2 );
				}
			}
		}

		return $translated_page;
	}

	/**
	 * Replace link for sitemap xml
	 *
	 * @param string $pattern
	 * @param string $translated_page
	 * @param string $type
	 *
	 * @return string
	 */
	public function modify_link_sitemap( $pattern, $translated_page, $type ) {
		preg_match_all( $pattern, $translated_page, $out, PREG_PATTERN_ORDER );
		$count_out_0 = count( $out[0] );
		for ( $i = 0; $i < $count_out_0; $i ++ ) {

			$current_url = ( isset( $out[1] ) ) ? $out[1][ $i ] : null;
			$length_link = apply_filters( 'weglot_length_replace_a', 1500 ); // Prevent error on long URL (preg_match_all Compilation failed: regular expression is too large at offset).
			if ( strlen( $current_url ) >= $length_link ) {
				continue;
			}

			if ( ! $this->check_link( $current_url ) ) {
				continue;
			}

			$function_name = apply_filters( 'weglot_modify_link_sitemap_replace_function', 'replace_' . $type, $type );

			if ( method_exists( $this->replace_link_service, $function_name ) ) {
				$translated_page = $this->replace_link_service->$function_name( $translated_page, $current_url );
			} else {
				if ( function_exists( $function_name ) ) {
					$translated_page = $function_name( $translated_page, $current_url );
				}
			}
		}

		return $translated_page;
	}

	/**
	 * @param string $current_url
	 * @param string $sometags
	 * @param string $sometags2
	 *
	 * @return string
	 * @since 2.0
	 */
	public function check_link( $current_url, $sometags = '', $sometags2 = '' ) {

		$sometags = !is_null( $sometags ) ? $sometags : '';
		$sometags2 = !is_null( $sometags2 ) ? $sometags2 : '';

		$admin_url          = admin_url();
		$parsed_url         = wp_parse_url( $current_url );
		$server_host        = apply_filters( 'weglot_check_link_server_host', $_SERVER['HTTP_HOST'] ); //phpcs:ignore
		$check_current_url  = $this->request_url_services->create_url_object( $current_url );
		$parsed_url['host'] = ! empty( $parsed_url['host'] ) ? $parsed_url['host'] : '';

		$not_other_site = true;

		$check_multisite_other_paths = apply_filters( 'weglot_check_multisite_other_paths', true );
		if ( $this->multisite_other_paths && $check_multisite_other_paths) {
			if ( isset( $parsed_url['path'] ) ) {
				$paths = explode( '/', $parsed_url['path'] );
				if ( isset( $paths[1] ) ) {
					$not_other_site = ! in_array( '/' . $paths[1] . '/', $this->multisite_other_paths );
				}
				if ( strlen( $this->request_url_services->get_home_wordpress_directory() ) > 1 && ( ! isset( $paths[1] ) || ( '/' . $paths[1] !== $this->request_url_services->get_home_wordpress_directory() ) ) ) {
					$not_other_site = false;
				}
			}
		}

		return (
			(
				( isset( $current_url[0] ) && 'h' === $current_url[0] && $parsed_url['host'] === $server_host ) ||
				( isset( $current_url[0] ) && $current_url[0] === '/' && ( ! isset( $current_url[1] ) || ( isset( $current_url[1] ) ) && '/' !== $current_url[1] ) ) //phpcs:ignore
			)
			&& $not_other_site
			&& strpos( $current_url, $admin_url ) === false
			&& strpos( $current_url, 'wp-login' ) === false
			&& ! $this->is_link_a_file( $current_url )
			&& strpos( $sometags, 'data-wg-notranslate' ) === false
			&& strpos( $sometags2, 'data-wg-notranslate' ) === false
			&& ! $check_current_url->getExcludeOption( $this->request_url_services->get_current_language(), 'exclusion_behavior' )
		);
	}

	/**
	 * @param string $current_url
	 *
	 * @return boolean
	 * @since 2.0
	 *
	 */
	public function is_link_a_file( $current_url ) {

		$files = [
			'pdf',
			'rar',
			'doc',
			'docx',
			'jpg',
			'jpeg',
			'png',
			'svg',
			'ppt',
			'pptx',
			'xls',
			'zip',
			'mp4',
			'xlsx',
			'txt',
			'eps',
		];

		foreach ( $files as $file ) {
			if ( self::ends_with( strtolower( $current_url ), '.' . $file ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * search forward starting from end minus needle length characters
	 *
	 * @param string $haystack
	 * @param string $needle
	 *
	 * @return boolean
	 * @since 2.0
	 *
	 */
	public function ends_with( $haystack, $needle ) {
		$temp       = strlen( $haystack );
		$len_needle = strlen( $needle );

		return '' === $needle ||
		       (
			       ( $temp - $len_needle ) >= 0 && strpos( $haystack, $needle, $temp - $len_needle ) !== false
		       );
	}
}
