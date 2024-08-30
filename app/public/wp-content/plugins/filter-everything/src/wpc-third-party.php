<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

function flrt_is_woocommerce()
{
    if( class_exists('WooCommerce') ){
        return true;
    }
    return false;
}

function flrt_is_acf()
{
    if( class_exists( 'ACF' ) ){
        return true;
    }
    return false;
}

function flrt_get_mobile_width(){
    return apply_filters( 'wpc_mobile_width', 768 );
}

/**
 * @feature for other popular themes there is possibility to add action to hook get_template_part_{$slug}
 * But it seems we need to detect what current theme is enabled
 */
if( ! function_exists('flrt_wp') ){

    function flrt_wp(){
        $theme_dependencies = flrt_get_theme_dependencies();

        if( flrt_get_option('show_bottom_widget') === 'on' ) {

            if( flrt_get_experimental_option('disable_buttons') !== 'on' ) {

                if (flrt_is_woocommerce()) { // It means WooCommerce installed

                    if( is_woocommerce() ){ // It means is a WooCommerce page
                        add_action('woocommerce_before_shop_loop', 'flrt_filters_button', 5);
                        add_action('woocommerce_no_products_found', 'flrt_filters_button', 5);
                    }else{
                        if (isset($theme_dependencies['button_hook']) && is_array($theme_dependencies['button_hook'])) {
                            foreach ($theme_dependencies['button_hook'] as $button_hook) {
                                add_action($button_hook, 'flrt_filters_button', 15);
                            }
                        }
                    }

                } else {
                    if (isset($theme_dependencies['button_hook']) && is_array($theme_dependencies['button_hook'])) {
                        foreach ($theme_dependencies['button_hook'] as $button_hook) {
                            add_action($button_hook, 'flrt_filters_button', 15);
                        }
                    }
                }
            }

        }

        // Add selected terms to the top
        $chips_hooks  = flrt_get_option('show_terms_in_content', []);

        if( $chips_hooks ){
            if( is_array( $chips_hooks ) && ! empty( $chips_hooks ) ){
                foreach ( $chips_hooks as $hook ){
                    add_action( $hook, 'flrt_add_selected_terms_above_the_top' );
                }
            }
        }
    }
}

function wpc_add_selected_terms_above_the_top(){
    _deprecated_function( __FUNCTION__, '1.0.7', 'flrt_add_selected_terms_above_the_top()' );
    flrt_add_selected_terms_above_the_top();
}

function flrt_add_selected_terms_above_the_top()
{
    flrt_show_selected_terms(true);
}

function flrt_get_theme_dependencies(){
    $current_theme = strtolower( get_template() );

    $theme_dependencies = array(
        'storefront'        => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#96588a',
            'button_hook'       => array('storefront_content_top'),
            'chips_hook'        => array('storefront_loop_before')
        ),
        'hello-elementor' => array(
            'posts_container'   => '.page-content',
            'sidebar_container' => '',
            'primary_color'     => '#CC3366',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'astra' => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#0274be',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentyeleven' => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#1982d1',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentytwelve' => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#21759b',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentyfourteen' => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#24890d',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentyfifteen'     => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary', // There are problems on mobile
            // because of sidebar is hidden on mobile until user open header menu.
            'primary_color'     => '#333333',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentysixteen'     => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#007acc',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentyseventeen'   => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#222222',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentynineteen'    => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#0073aa',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentytwenty'      => array(
            'posts_container'   => '#site-content',
            'sidebar_container' => '',
            'primary_color'     => '#cd2653',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'twentytwentyone'      => array(
            'posts_container'   => '#content',
            'sidebar_container' => '.widget-area',
            'primary_color'     => '#28303d',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'popularfx'         => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#0072b7',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'oceanwp'           => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#right-sidebar',
            'primary_color'     => '#13aff0',
            'button_hook'       => array('ocean_before_content'),
            'chips_hook'        => array('ocean_before_content')
        ),
        'kadence'           => array(
            'posts_container'   => '#main',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#3182ce',
            'button_hook'       => array('kadence_before_main_content'),
            'chips_hook'        => array('kadence_before_main_content')
        ),
        'zakra'             => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#269bd1',
            'button_hook'       => array('zakra_before_posts_the_loop'),
            'chips_hook'        => array('zakra_before_posts_the_loop')
        ),
        'neve'              => array(
            'posts_container'   => '.nv-index-posts',
            'sidebar_container' => '#secondary', // '.nv-sidebar-wrap',
            'primary_color'     => '#393939',
            'button_hook'       => array('neve_before_loop'),
            'chips_hook'        => array('neve_before_loop')
        ),
        'hestia'            => array(
            'posts_container'   => '#woo-products-wrap',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#e91e63',
            'button_hook'       => array('hestia_before_index_posts_loop'),
            'chips_hook'        => array('hestia_before_index_posts_loop')
        ),
        'colibri-wp'        => array(
            'posts_container'   => '.main-row-inner .h-col:not(.colibri-sidebar)',
            'sidebar_container' => '.colibri-sidebar',
            'primary_color'     => '#03a9f4',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'teluro'            => array(
            'posts_container'   => '.main-row-inner .h-col:not(.colibri-sidebar)',
            'sidebar_container' => '.colibri-sidebar',
            'primary_color'     => '#f26559',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'numinous'          => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#f4ab00',
            'button_hook'       => array('numinous_content'),
            'chips_hook'        => ''
        ),
        'sydney'            => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#d65050',
            'button_hook'       => array('sydney_before_content'),
            'chips_hook'        => ''
        ),
        // Commercial themes
        'avada' => array(
            'posts_container'   => '#content',
            'sidebar_container' => '#sidebar',
            'primary_color'     => '#65bc7b',
            'button_hook'       => array('avada_before_main_container'),
            'chips_hook'        => ''
        ),
        'generatepress'     => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '.sidebar',
            'primary_color'     => '#1e73be',
            'button_hook'       => array('generate_before_main_content'),
            'chips_hook'        => array('generate_before_main_content')
        ),
        'the7'              => array(
            'posts_container'   => '#content',
            'sidebar_container' => '#sidebar',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'dt-the7'           => array(
            'posts_container'   => '#content',
            'sidebar_container' => '#sidebar',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'flatsome'          => array(
            'posts_container'   => '.shop-container',
            'sidebar_container' => '#shop-sidebar',
            'primary_color'     => '#446084',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'betheme'           => array(
            'posts_container'   => '.sections_group',
            'sidebar_container' => '.sidebar',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'bridge'            => array(
            'posts_container'   => '.container .column1',
            'sidebar_container' => '',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'impreza'           => array(
            'posts_container'   => '#page-content .w-grid-list',
            'sidebar_container' => '',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'enfold'            => array(
            'posts_container'   => 'main.content',
            'sidebar_container' => '',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'porto'             => array(
            'posts_container'   => '#content',
            'sidebar_container' => '',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'genesis'             => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'divi' => array(
            'posts_container'   => '#primary',
            'sidebar_container' => '#secondary',
            'primary_color'     => '',
            'button_hook'       => '',
            'chips_hook'        => ''
        ),
        'woodmart' => array(
            'posts_container'   => '.site-content',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#83b735',
            'button_hook'       => '',
            'chips_hook'        => array( 'woodmart_shop_filters_area', 'woodmart_main_loop')
        )
    );

    $theme_dependencies = apply_filters( 'wpc_theme_dependencies', $theme_dependencies );

    if( isset( $theme_dependencies[ $current_theme ] ) ){
        return $theme_dependencies[ $current_theme ];
    }

    return array(
        'posts_container'   => false,
        'sidebar_container' => false,
        'primary_color'     => false,
        'button_hook'       => array(),
        'chips_hook'        => array()
    );
}

add_action( 'wp', 'flrt_wp' );

if( ! function_exists('flrt_set_posts_container') ){
    function flrt_set_posts_container( $theme_posts_container )
    {
        $theme_dependencies = flrt_get_theme_dependencies();

        if( isset( $theme_dependencies[ 'posts_container' ] ) ){
            return $theme_dependencies[ 'posts_container' ];
        }

        return $theme_posts_container;
    }
}

function flrt_set_theme_color($color ){

    $theme_dependencies = flrt_get_theme_dependencies();

    if( $theme_dependencies['primary_color'] ){
        $color = $theme_dependencies['primary_color'];
    }

    return $color;
}

if( ! function_exists('flrt_init') ){
    function flrt_init()
    {
        // Set correct theme posts container
        add_filter('wpc_theme_posts_container', 'flrt_set_posts_container');

        // Set correct theme color
        add_filter('wpc_theme_color', 'flrt_set_theme_color');

        //
        if( flrt_is_acf() ) {
            add_filter( 'wpc_pre_save_filter', 'flrt_maybe_acf_field' );
            add_filter( 'wpc_default_sorting_terms', 'flrt_acf_terms_order', 10, 2 );
        }
    }
}
add_action('init', 'flrt_init');

/**
 * @todo check the problem with Elementor archive template and different posts queries
 * Different post types, custom and predefined category or custom term
 */
//add_filter( 'elementor/theme/posts_archive/query_posts/query_vars', 'flrt_fix_elementor_query_args' );
//add_filter( 'elementor/query/get_query_args/current_query', 'flrt_fix_elementor_query_args' );
function flrt_fix_elementor_query_args( $query_args ){

    if( isset( $query_args['taxonomy']  ) ){
        unset( $query_args['taxonomy'] );
        unset( $query_args['term'] );
    }

    return $query_args;
}

function flrt_wpml_active(){
    if( defined('WPML_PLUGIN_BASENAME') ){
        return true;
    }
    return false;
}

add_action( 'elementor/editor/before_enqueue_scripts', 'flrt_include_elementor_script' );
function flrt_include_elementor_script(){
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : FLRT_PLUGIN_VER;
    wp_enqueue_script('wpc-widgets', FLRT_PLUGIN_DIR_URL . 'assets/js/wpc-widgets' . $suffix . '.js', ['jquery', 'jquery-ui-sortable'], $ver, true );
    wp_enqueue_style('wpc-widgets', FLRT_PLUGIN_DIR_URL . 'assets/css/wpc-widgets' . $suffix . '.css', [], $ver );

    $l10n = array(
        'wpcItemNum'  => esc_html__( 'Item #', 'filter-everything')
    );
    wp_localize_script( 'wpc-widgets', 'wpcWidgets', $l10n );
}

/*
 * Polylang compatibility functions
 * */
function flrt_maybe_has_translation( $post_id, $lang = '' ){

    if( function_exists( 'pll_get_post' ) ){
        $translation_post_id = pll_get_post( $post_id, $lang );
        if( $translation_post_id ){
            $post_id = $translation_post_id;
        }
    }

    return $post_id;
}

function flrt_pll_pro_active(){
    if ( defined('POLYLANG_PRO') ) {
        return true;
    }
    return false;
}
// Allow Filter Sets to be translatable if Polylang PRO activated
// This make sense for Filter Sets with common locations only
add_action( 'after_setup_theme', 'flrt_pll_init', 20 );
function flrt_pll_init(){
    if( flrt_pll_pro_active() && defined('FLRT_ALLOW_PLL_TRANSLATIONS') && FLRT_ALLOW_PLL_TRANSLATIONS ){
        add_filter( 'pll_get_post_types', 'flrt_add_cpt_to_pll', 10, 2 );
    }
}

function flrt_add_cpt_to_pll( $post_types, $is_settings ) {
    if ( $is_settings ) {
        unset( $post_types[ FLRT_FILTERS_SET_POST_TYPE ], $post_types[ FLRT_FILTERS_SET_POST_TYPE ] );
    } else {
        $post_types[ FLRT_FILTERS_SET_POST_TYPE ] = FLRT_FILTERS_SET_POST_TYPE;
        if( defined('FLRT_FILTERS_PRO') && FLRT_FILTERS_PRO ) {
            $post_types[ FLRT_SEO_RULES_POST_TYPE ] = FLRT_SEO_RULES_POST_TYPE;
        }
    }
    return $post_types;
}

/**
 * Adds compatibility the Price filter with multi-currency plugins WOOCS and CURCY
 * @since  1.7.12
 */
add_action('init', 'flrt_add_currencies_support');
function flrt_add_currencies_support() {
    if ( flrt_is_woocommerce() ) {
        // For the FOX - Currency Switcher Professional for WooCommerce
        if ( defined( 'WOOCS_PLUGIN_NAME' ) && WOOCS_PLUGIN_NAME ) {
            // Converts values into selected currency. Visible in the range slider form
            add_filter( 'wpc_set_num_shift', 'flrt_set_woocs_shift', 10, 2 );
            function flrt_set_woocs_shift( $value, $entity_name ) {
                global $WOOCS;

                if ( $entity_name === '_price' ) {
                    if ( property_exists( $WOOCS, 'default_currency' ) && property_exists( $WOOCS, 'current_currency' ) ) {
                        if ( ! $WOOCS->default_currency || ! $WOOCS->current_currency ) {
                            return $value;
                        }

                        if ( $WOOCS->default_currency !== $WOOCS->current_currency && method_exists( $WOOCS, 'convert_from_to_currency' ) ) {
                            $value = $WOOCS->convert_from_to_currency( $value, $WOOCS->default_currency, $WOOCS->current_currency );
                        }
                    }
                }

                return $value;
            }

            // Converts values back to default currency for WP_Query
            add_filter( 'wpc_unset_num_shift', 'flrt_unset_woocs_shift', 10, 2 );
            function flrt_unset_woocs_shift( $value, $entity_name ) {
                global $WOOCS;

                if ( $entity_name === '_price' ) {
                    if ( property_exists( $WOOCS, 'default_currency' ) && property_exists( $WOOCS, 'current_currency' ) ) {
                        if ( ! $WOOCS->default_currency || ! $WOOCS->current_currency ) {
                            return $value;
                        }

                        $precision = 2;
                        if( method_exists( $WOOCS, 'get_currency_price_num_decimals' ) ) {
                            $precision = $WOOCS->get_currency_price_num_decimals( $WOOCS->current_currency, $WOOCS->price_num_decimals );
                        }

                        if ( $WOOCS->default_currency !== $WOOCS->current_currency && method_exists( $WOOCS, 'convert_from_to_currency' ) ) {
                            $value = $WOOCS->convert_from_to_currency( $value, $WOOCS->current_currency, $WOOCS->default_currency );
                            $value = round( $value, $precision );
                        }
                    }
                }

                return $value;
            }
        }

        // For the CURCY - Multi Currency for WooCommerce
        if ( defined( 'WOOMULTI_CURRENCY_F_VERSION' ) && WOOMULTI_CURRENCY_F_VERSION ) {
            // Converts values into selected currency. Visible in the range slider form
            add_filter( 'wpc_set_num_shift', 'flrt_set_curcy_shift', 10, 2 );
            function flrt_set_curcy_shift( $value, $entity_name ) {

                if ( $entity_name === '_price' ) {
                    if ( method_exists( 'WOOMULTI_CURRENCY_F_Data', 'get_ins' ) && function_exists('wmc_get_price' ) ) {
                        $settings = WOOMULTI_CURRENCY_F_Data::get_ins();

                        if ( ! method_exists( $settings, 'get_current_currency' ) || ! method_exists( $settings, 'get_default_currency' ) ) {
                            return $value;
                        }

                        $currency           = $settings->get_current_currency();
                        $default_currency   = $settings->get_default_currency();

                        if ( $currency !== $default_currency ) {
                            $value = wmc_get_price( $value, $currency );
                        }
                    }
                }

                return $value;
            }

            // Converts values back to default currency for WP_Query
            add_filter( 'wpc_unset_num_shift', 'flrt_unset_curcy_shift', 10, 2 );
            function flrt_unset_curcy_shift( $value, $entity_name ) {

                if ( $entity_name === '_price' ) {
                    if ( method_exists( 'WOOMULTI_CURRENCY_F_Data', 'get_ins' ) && function_exists('wmc_revert_price' ) ) {
                        $settings = WOOMULTI_CURRENCY_F_Data::get_ins();

                        if ( ! method_exists( $settings, 'get_current_currency' ) || ! method_exists( $settings, 'get_default_currency' ) ) {
                            return $value;
                        }

                        $currency           = $settings->get_current_currency();
                        $default_currency   = $settings->get_default_currency();

                        if ( $currency !== $default_currency ) {
                            $value = wmc_revert_price( $value );
                        }
                    }
                }

                return $value;
            }
        }
    }
}

/**
 * Removes WooCommerce Product Query post clauses for the price filter
 * @since  1.7.12
 */
function flrt_remove_product_query_post_clauses( $wp_query, $WC_query ) {
    $wpManager = \FilterEverything\Filter\Container::instance()->getWpManager();

    if ( $wpManager->getQueryVar( 'wpc_is_filter_request' ) ) {
        remove_filter('posts_clauses', array( $WC_query, 'product_query_post_clauses' ), 10, 2);
    }

    return $wp_query;
}

function flrt_is_dokan() {
    return function_exists('dokan');
}

function flrt_maybe_acf_field( $filter ){
    if( $filter['entity'] === 'post_meta' ) {
        global $wpdb;
        // Try to check if this is ACF field
        $sql[] = "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts}";
        $sql[] = "WHERE {$wpdb->posts}.post_excerpt = %s";
        $sql[] = "AND {$wpdb->posts}.post_type = %s";
        $sql[] = "ORDER BY {$wpdb->posts}.ID ASC";

        $sql     = implode(' ', $sql );
        $sql     = $wpdb->prepare( $sql, $filter['e_name'], 'acf-field' );
        $results = $wpdb->get_results( $sql, ARRAY_A );

        if ( ! empty( $results ) ) {
            $ids = [];
            foreach ( $results as $single_result ) {
                if( isset( $single_result['ID'] ) ){
                    $ids[] = $single_result['ID'];
                }
            }
            $acf_field_ids = implode( ',', $ids );

            if( ! empty( $acf_field_ids ) ){
                $filter['acf_fields'] = $acf_field_ids;
            }
        }
    }

    return $filter;
}

function flrt_acf_terms_order( $entity_items, $filter ){

    if( isset( $filter['acf_fields'] ) && $filter['acf_fields'] !== '' ) {
        global $wpdb;
        // Here we have to get ACF fields by their IDs and sort terms in according to
        // the order in the field.
        $sql = [];
        $acf_field_ids = preg_replace( '/^[\d]\,/', '', $filter['acf_fields'] );
        $sql[] = "SELECT {$wpdb->posts}.post_content FROM {$wpdb->posts}";
        $sql[] = "WHERE {$wpdb->posts}.ID IN( {$acf_field_ids} )";
        $sql[] = "ORDER BY {$wpdb->posts}.ID ASC";
        $sql   = implode(' ', $sql );

        $results = $wpdb->get_results( $sql, ARRAY_A );

        if( empty( $results ) ) {
            return $entity_items;
        }

        $field_terms = [];
        foreach ( $results as $acf_field ){
            if( isset( $acf_field['post_content'] ) ) {
                $field_options = maybe_unserialize( $acf_field['post_content'] );

                if( isset( $field_options['choices'] ) && is_array( $field_options['choices'] ) ){
                    foreach ( $field_options['choices'] as $value => $label ){
                        if( ! isset( $field_terms[$value] ) ) {
                            $field_terms[$value] = $label;
                        }
                    }
                }
            }
        }

        $current_items = $entity_items;
        $sorted_items  = [];

        foreach ( $field_terms as $tslug => $tvalue ) {
            $tslug = sanitize_title( $tslug );

            if( isset( $current_items[ $tslug ] ) ) {
                $term_object = $current_items[ $tslug ];
                $term_object->name = $tvalue;
                $sorted_items[ $tslug ] = $term_object;
                unset( $current_items[ $tslug ] );
            }
        }

        if( ! empty( $current_items ) ){
            foreach ( $current_items as $slug => $item ){
                $sorted_items[$slug] = $item;
            }
        }
        $entity_items = $sorted_items;
    }

    return $entity_items;
}

//@todo check this with PLL support
//function flrt_add_cpt_to_pll_tmp( $post_types, $is_settings ) {
//    if ( $is_settings ) {
//        $post_types[ FLRT_FILTERS_SET_POST_TYPE ] = FLRT_FILTERS_SET_POST_TYPE;
//    }
//    return $post_types;
//}