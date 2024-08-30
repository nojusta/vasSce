<?php

namespace WeglotWP\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Name pages
 *
 * @since 2.0
 */
abstract class Helper_Tabs_Admin_Weglot {

	/**
	 * @var string
	 */
	const SETTINGS = 'settings';

	/**
	 * @var string
	 */
	const STATUS = 'status';

	/**
	 * @var string
	 */
	const SUPPORT = 'support';

	/**
	 * Get full tabs information
	 * @static
	 * @since 2.0
	 *
	 * @return array
	 */
	public static function get_full_tabs() {
		return array(
			self::SETTINGS    => array(
				'title' => __( 'Settings', 'weglot' ),
				'url'   => get_admin_url( null, sprintf( 'admin.php?page=%s&tab=%s', Helper_Pages_Weglot::SETTINGS, self::SETTINGS ) ),
			),
			self::STATUS      => array(
				'title' => __( 'Status', 'weglot' ),
				'url'   => get_admin_url( null, sprintf( 'admin.php?page=%s&tab=%s', Helper_Pages_Weglot::SETTINGS, self::STATUS ) ),
			),
		);
	}
}
