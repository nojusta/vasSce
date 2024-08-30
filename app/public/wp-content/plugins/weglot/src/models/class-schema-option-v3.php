<?php

namespace WeglotWP\Models;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WeglotWP\Helpers\Helper_Flag_Type;


class Schema_Option_V3 {

	public $api_key;
	public $api_key_private;
	public $allowed;
	public $original_language;
	public $language_from_custom_flag;
	public $language_from_custom_name;
	public $translation_engine;
	public $destination_language;
	public $private_mode;
	public $auto_redirect;
	public $autoswitch_fallback;
	public $exclude_urls;
	public $exclude_blocks;
	public $custom_settings;
	public $is_dropdown;
	public $is_fullname;
	public $with_name;
	public $with_flags;
	public $type_flags;
	public $override_css;
	public $email_translate;
	public $active_search;
	public $translate_amp;
	public $wp_user_version;
	public $has_first_settings;
	public $show_box_first_settings;
	public $custom_urls;
	public $media_enabled;
	public $external_enabled;
	public $page_views_enabled;
	public $flag_css;
	public $menu_switcher;
	public $active_wc_reload;
	public $versions;
	public $slugTranslation;
	public $translation;
	public $category;
	public $organization_slug;
	public $project_slug;

	/**
	 * @return array
	 * @since 3.0.0
	 */
	public static function get_schema_options_v3_compatible() {
		$schema = array(
			'api_key'                   => 'api_key',
			'api_key_private'           => 'api_key_private',
			'allowed'                   => 'allowed',
			'original_language'         => 'language_from',
			'language_from_custom_flag' => 'language_from_custom_flag',
			'language_from_custom_name' => 'language_from_custom_name',
			'translation_engine'        => 'translation_engine',
			'destination_language'      => (object) array(
				'path' => 'languages',
				'fn'   => function ( $languages ) {
					$destinations = array();
					if ( ! $languages ) {
						return $destinations;
					}
					foreach ( $languages as $item ) {
						$destinations[] = array(
							'language_to'       => $item['language_to'],
							'custom_code'       => $item['custom_code'],
							'custom_name'       => $item['custom_name'],
							'custom_local_name' => $item['custom_local_name'],
							'public'            => $item['enabled'],
						);
					}

					return $destinations;
				},
			),
			'private_mode'              => (object) array(
				'path' => 'languages',
				'fn'   => function ( $languages ) {
					$private = array();
					foreach ( $languages as $item ) {
						if ( ! $item['enabled'] ) {
							$private[ $item['language_to'] ] = true;
						} else {
							$private[ $item['language_to'] ] = false;
						}
					}

					return $private;
				},
			),
			'auto_redirect'             => 'auto_switch',
			'autoswitch_fallback'       => 'auto_switch_fallback',
			'exclude_urls'              => 'excluded_paths',
			'exclude_blocks'            => (object) array(
				'path' => 'excluded_blocks',
				'fn'   => function ( $excluded_blocks ) {
					$excluded = array();
					if ( ! $excluded_blocks ) {
						return $excluded;
					}
					foreach ( $excluded_blocks as $item ) {
						$excluded[] = $item['value'];
					}

					return $excluded;
				},
			),
			'custom_settings'           => 'custom_settings',
			'is_dropdown'               => 'custom_settings.button_style.is_dropdown',
			'is_fullname'               => 'custom_settings.button_style.full_name',
			'with_name'                 => 'custom_settings.button_style.with_name',
			'with_flags'                => 'custom_settings.button_style.with_flags',
			'type_flags'                => (object) array(
				'path' => 'custom_settings.button_style.flag_type',
				'fn'   => function ( $flag_type ) {
					if ( $flag_type ) {
						return $flag_type;
					}

					return Helper_Flag_Type::RECTANGLE_MAT;
				},
			),
			'override_css'              => 'custom_settings.button_style.custom_css',
			'email_translate'           => 'custom_settings.translate_email',
			'active_search'             => 'custom_settings.translate_search',
			'translate_amp'             => 'custom_settings.translate_amp',
			'wp_user_version'           => 'custom_settings.wp_user_version',
			'has_first_settings'        => 'has_first_settings',
			'show_box_first_settings'   => 'show_box_first_settings',
			'custom_urls'               => (object) array(
				'path' => 'custom_urls',
				'fn'   => function ( $custom_urls ) {
					if ( $custom_urls ) {
						return $custom_urls;
					}

					return array();
				},
			),
			'media_enabled'             => 'media_enabled',
			'external_enabled'          => 'external_enabled',
			'page_views_enabled'        => 'page_views_enabled',
			'flag_css'                  => 'flag_css',
			'menu_switcher'             => 'menu_switcher',
			'active_wc_reload'          => 'active_wc_reload',
			'versions'                  => 'versions',
			'slugTranslation'           => 'versions.slugTranslation',
			'translation'               => 'versions.translation',
			'category'               => 'category',
			'organization_slug'               => 'organization_slug',
			'project_slug'               => 'project_slug',
		);

		return $schema;
	}
}
