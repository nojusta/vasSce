<?php

namespace WeglotWP\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * @since 2.3.0
 */
class Feature_Flags_Service_Weglot {

	/**
	 * @since 2.3.0
	 */
	public function generate_feature_flags($settings) {

		if(isset( $_SERVER['HTTP_USER_AGENT'] ) && strpos( sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ), "Weglot Visual Editor" ) !== false){ // phpcs:ignore
			$settings['feature_flags']['switcher_editor']['is_responsive'] = true;
		}
		return apply_filters( 'weglot_feature_flags', $settings );
	}
}
