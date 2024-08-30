<?php

namespace WeglotWP\Actions\Front;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Helpers\Helper_API;
use WeglotWP\Helpers\Helper_Is_Admin;
use WeglotWP\Models\Hooks_Interface_Weglot;
use WeglotWP\Services\Language_Service_Weglot;
use WeglotWP\Services\Option_Service_Weglot;
use WeglotWP\Services\Parser_Service_Weglot;
use WeglotWP\Services\Request_Url_Service_Weglot;
use WP_Query;

/**
 * @since 2.4.0
 */
class Search_Weglot implements Hooks_Interface_Weglot {
	protected $old_search = null;

	protected $new_search = null;
	/**
	 * @var Option_Service_Weglot
	 */
	private $option_services;
	/**
	 * @var Parser_Service_Weglot
	 */
	private $parser_services;
	/**
	 * @var Request_Url_Service_Weglot
	 */
	private $request_url_services;
	/**
	 * @var Language_Service_Weglot
	 */
	private $language_services;

	/**
	 * @since 2.4.0
	 */
	public function __construct() {
		$this->option_services      = weglot_get_service( 'Option_Service_Weglot' );
		$this->parser_services      = weglot_get_service( 'Parser_Service_Weglot' );
		$this->request_url_services = weglot_get_service( 'Request_Url_Service_Weglot' );
		$this->language_services    = weglot_get_service( 'Language_Service_Weglot' );
	}

	/**
	 * @return void
	 * @since 2.4.0
	 * @see Hooks_Interface_Weglot
	 *
	 */
	public function hooks() {

		if ( Helper_Is_Admin::is_wp_admin() ) {
			return;
		}

		$search_active = $this->option_services->get_option( 'active_search' );

		if ( $search_active ) {
			add_action( 'pre_get_posts', array( $this, 'pre_get_posts_translate' ) );
			add_filter( 'get_search_query', array( $this, 'get_search_query_translate' ) );
		}
	}

	/**
	 * @param WP_Query $query
	 *
	 * @return void
	 * @since 2.4.0
	 */
	public function pre_get_posts_translate( $query ) {

		if ( ! $query->is_search() ) {
			return;
		}

		$query_vars_check = apply_filters( 'weglot_query_vars_check', 's' );
		if ( empty( $query->query_vars[ $query_vars_check ] ) ) {
			return;
		}

		$original_language = $this->language_services->get_original_language()->getInternalCode();
		$current_language  = $this->request_url_services->get_current_language()->getInternalCode();

		if ( $original_language === $current_language ) {
			return;
		}

		try {
			$api_key_private = $this->option_services->get_api_key_private();
			$this->new_search = $this->reverseTranslate($api_key_private, $current_language, $original_language, home_url('/'), $query->query_vars[ $query_vars_check ], 1);

			if ( empty( $this->new_search ) ) {
				return;
			}

			$query->set( $query_vars_check, $this->new_search ); //phpcs:ignore
		} catch ( \Exception $th ) {
			return;
		}
	}

	/**
	 * @param string $string
	 *
	 * @return string
	 * @since 2.4.0
	 */
	public function get_search_query_translate( $string ) {
		return ( $this->old_search ) ? $this->old_search : $string;
	}

	function reverseTranslate($api_key, $l_from, $l_to, $request_url, $word, $t) {
		// Construct the request body.
		$requestBody = wp_json_encode(array(
			"l_from" => $l_from,
			"l_to" => $l_to,
			"request_url" => $request_url,
			"words" => array(
				array("w" => $word, "t" => $t)
			)
		));

		// Define the API endpoint with the Weglot API key.
		$url = sprintf('%s/translate?api_key=%s', Helper_API::get_api_url(), $api_key);

		// Set up the arguments for the request.
		$args = array(
			'body'        => $requestBody,
			'headers'     => array(
				'Content-Type' => 'application/json',
			),
			'method'      => 'POST',
			'data_format' => 'body',
		);

		// Send the request using wp_remote_post.
		$response = wp_remote_post($url, $args);

		// Check for WP errors.
		if (is_wp_error($response)) {
			return "WP Error: " . $response->get_error_message();
		}

		// Get the response body.
		$response_body = wp_remote_retrieve_body($response);

		// Parse the JSON response.
		$responseData = json_decode($response_body, true);

		// Check if response is successful.
		if (!$responseData || !isset($responseData['ids'])) {
			return "Error: Invalid response from API";
		}

		// Return translated data.
		return $responseData['to_words'][0];
	}

}
