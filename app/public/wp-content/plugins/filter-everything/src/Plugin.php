<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

use FilterEverything\Filter\Pro\Api\ApiRequests;
use FilterEverything\Filter\Shortcodes;
use FilterEverything\Filter\Pro\PluginPro;

class Plugin
{
    private $wpManager;

    public function __construct()
    {
        $this->wpManager = Container::instance()->getWpManager();
        $this->wpManager->init();
        $this->register_hooks();

        new Shortcodes();

        if( defined('FLRT_FILTERS_PRO') && FLRT_FILTERS_PRO ){
            new PluginPro();
        }

        if( is_admin() ){
            new Admin();
        }
    }

    public function register_hooks(){
        /**
         * string
         */
        $getData  = Container::instance()->getTheGet();

        if( ! is_admin() ){
            global $wp_version;

            // Different ParseRequest methods for WP version 6.0 or prior
            if( version_compare( $wp_version, '5.9.3', '>' ) ){
                add_filter( 'do_parse_request', array( $this->wpManager, 'customParseRequest' ), 10, 3 );
            }else{
                add_filter( 'do_parse_request', array( $this->wpManager, 'customParseRequestBefore60' ), 10, 3 );
            }

            add_action( 'parse_request', array( $this->wpManager, 'parseRequest' ) );
            add_action( 'pre_get_posts', array( $this->wpManager, 'addFilterQueryToWpQuery' ), 9999 );

            add_filter( 'posts_where', [ $this->wpManager, 'fixPostsWhereForSearch' ], 10, 2 );
            add_filter( 'post_limits_request', [ $this->wpManager, 'addSQlComment' ], 10, 2 );
            add_action( 'pre_get_posts', array( $this->wpManager, 'fixSearchPostType' ), 9999 );

            add_action( 'template_redirect', [ $this, 'prepareEntities' ] );

            add_action( 'wpc_filtered_query_end', [ $this, 'addSearchArgsToWpQuery' ] );
            add_action( 'wpc_all_set_wp_queried_posts', [ $this, 'addSearchArgsToWpQuery' ] );

            add_filter( 'posts_where', [ $this, 'postDateWhere' ], 10000, 2 );

            if ( flrt_is_woocommerce() ){
                add_action( 'woocommerce_product_query', 'flrt_remove_product_query_post_clauses', 10, 2 );
                add_filter( 'posts_search', [$this, 'addSkuSearchSql'], 10000, 2 );
            }

            $sorting = new Sorting();
            $sorting->registerHooks();
        }

        add_action( 'body_class', array( $this, 'bodyClass' ) );

        add_action( 'admin_print_styles', array( $this, 'includeAdminCss' ) );
        add_action( 'admin_print_scripts', array( $this, 'includeAdminJs' ) );

        // Do not include JS, if this page is admin or can't contain filters
        if( ! is_admin() && ! is_login() ){
            add_action( 'wp_head', [ $this, 'inlineFrontCss' ] );
            add_action( 'wp_print_styles', array( $this, 'includeFrontCss' ) );
            add_action( 'wp_print_scripts', array( $this, 'includeFrontJs' ) );
            add_action( 'wp_print_styles', array( $this, 'dynamicFrontCss' ) );
        }

        add_action( 'wp_footer', [$this, 'footerHtml'] );

        if( ! defined('FLRT_FILTERS_PRO') ) {
            add_action( 'wp_head', array($this, 'noIndexFilterPages'), 1 );
            add_filter( 'wpc_filter_set_default_fields', [ $this, 'addAvailableInProFields' ], 10, 2 );
            add_filter( 'wpc_pre_save_set_fields', [ $this, 'unsetAvailableInProFields' ] );
        }

        add_filter( 'wpc_filter_set_default_fields', [ $this, 'addSetTailFields' ], 20, 2 );

        // Disable single search result redirect
        add_filter( 'woocommerce_redirect_single_search_result', '__return_false' );

        add_action( 'save_post', [$this, 'resetTransitions'] );
        add_action( 'delete_post', [$this, 'resetTransitions'] );
        add_action( 'woocommerce_ajax_save_product_variations', [$this, 'resetTransitions'] );

        if( isset( $getData['reset_filters_cache'] ) && $getData['reset_filters_cache'] == true ){
            $this->resetTransitions();
        }

        add_action( 'wpc_before_filter_set_settings_fields', [$this, 'removeApplyButtonOrderField'] );
        add_filter( 'wpc_filter_set_prepared_values', [$this, 'handleFilterSetFieldsVisibility'] );

        add_action( 'wpc_cycle_filter_fields', [$this, 'showCombinedFields'], 10, 2 );

        $woo_shortcodes = array(
            'products',
            'featured_products',
            'sale_products',
            'best_selling_products',
            'recent_products',
            'product_attribute',
            'top_rated_products'
        );

        // Set first install timestamp
        $first_install = get_option( 'wpc_first_install' );
        if ( ! $first_install ){
            $first_install['install_time']  = time();
            $first_install['rate_disabled'] = false;
            $first_install['rate_delayed']  = false;

            update_option( 'wpc_first_install', $first_install );
        }

        // Fix caching problem for products queried by shortcode
        foreach ( $woo_shortcodes as $woo_shortcode ){
            add_filter( "shortcode_atts_{$woo_shortcode}", [$this, 'disableCacheProductsShortcode'] );
        }
    }

    public function resetTransitions()
    {
        $em = Container::instance()->getEntityManager();
        $all_filters = $em->getGlobalConfiguredSlugs();

        if( is_array( $all_filters ) ){
            foreach ( $all_filters as $entityEname => $slug ){
                // For terms it should be entity name
                $parts = explode( '#', $entityEname, 2 );
                $e_name = isset( $parts[1] ) ? $parts[1] : '';
                $type   = isset( $parts[0] ) ? $parts[0] : '';

                $terms_transient_key = '';

                if ( in_array( $type, [ 'post_meta_num', 'tax_numeric' ] ) ) {
                    global $wpdb;
                    $key = flrt_get_terms_transient_key(  $type . '_'. $e_name, false );

                    $result = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '%{$key}%'", ARRAY_A );

                    if ( isset( $result[0]['option_name'] ) ) {
                        $terms_transient_key = str_replace( '_transient_', '', str_replace( '_transient_timeout_', '', $result[0]['option_name'] ) );
                    }
                }

                if ( in_array( $type, [ 'post_date', 'post_meta_date' ] ) ) {
                    global $wpdb;
                    $key = 'wpc_terms_post_date_';
                    $result = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '%{$key}%'", ARRAY_A );
                    if ( isset( $result[0]['option_name'] ) ) {
                        $terms_transient_key = str_replace( '_transient_', '', str_replace( '_transient_timeout_', '', $result[0]['option_name'] ) );
                    }
                }

                if ( $type === 'post_meta_exists' ) {
                    delete_transient( flrt_get_post_ids_transient_key( $e_name .'_yes' ) );
                    delete_transient( flrt_get_post_ids_transient_key( $e_name .'_no' ) );
                }

                if( ! $terms_transient_key ){
                    $terms_transient_key    = flrt_get_terms_transient_key( $type . '_'. $e_name );
                }

                $post_ids_transient_key = flrt_get_post_ids_transient_key( $slug );
                $var_meta_transient_key = flrt_get_variations_transient_key( 'attribute_'. $e_name );

                delete_transient( $terms_transient_key );
                delete_transient( $post_ids_transient_key );
                delete_transient( $var_meta_transient_key );
            }
        }

        $variations_key = 'wpc_posts_variations';
        $filter_key     = 'wpc_filters_query';

        delete_transient($variations_key);
        delete_transient($filter_key);

        unset( $terms_transient_key, $post_ids_transient_key, $var_meta_transient_key, $all_filters, $em );
    }

    public function prepareEntities()
    {
        $wpManager  = Container::instance()->getWpManager();
        $em         = Container::instance()->getEntityManager();
        $sets       = $wpManager->getQueryVar('wpc_page_related_set_ids');

        if( $sets ){
            foreach( $sets as $set ){
                $em->prepareEntitiesToDisplay( array( $set ) );
            }
        }
    }


    public function addAvailableInProFields( $fields, $filterSet )
    {
        foreach ( $fields as $key => $attributes ){
            // Always insert regular 'old' field
            $new_fields[$key] = $attributes;

            if( $key === 'post_name' ){

                $new_fields['instead_post_name'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('Where to filter?', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('instead_post_name'),
                    'id'            => $filterSet->generateFieldId('instead_post_name'),
                    'class'         => 'wpc-field-instead-of-location',
                    'default'       => '',
                    'readonly'      => 'readonly',
                    'placeholder'   => esc_html__('Available in PRO', 'filter-everything'),
                    'instructions'  => esc_html__('Specify page(s) where the Posts list should be filtered is located', 'filter-everything'),
                    'settings'      => true
                );

                $new_fields['instead_wp_filter_query'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('And what to filter?', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('instead_wp_filter_query'),
                    'id'            => $filterSet->generateFieldId('instead_wp_filter_query'),
                    'class'         => 'wpc-field-instead-wp-filter-query',
                    'default'       => '',
                    'readonly'      => 'readonly',
                    'placeholder'   => esc_html__('Available in PRO', 'filter-everything'),
                    'instructions'  => esc_html__('Determines what exactly the Posts list (WP_Query) on a page should be filtered', 'filter-everything'),
                    'tooltip'       => wp_kses ( __( 'Every Posts list, like "Popular products" or "Recent posts" on a page, is related to some WP_Query. This field allows you to set desired Posts list by choosing its WP_Query.<br /><br />If the filtering process does not change the Posts you need, it means you selected the wrong WP_Query. Please, try to experiment with different ones until it starts to filter.', 'filter-everything' )
                        ,
                        array(
                            'br' => array()
                        )
                    ),
                    'settings' => true
                );

            }

            if( $key === 'show_count' ){

                $new_fields['instead_custom_posts_container'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('HTML id or class of the Posts Container', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('instead_custom_posts_container'),
                    'id'            => $filterSet->generateFieldId('instead_custom_posts_container'),
                    'class'         => 'wpc-field-instead-custom-posts-container',
                    'default'       => '',
                    'readonly'      => 'readonly',
                    'placeholder'   => esc_html__('Available in PRO', 'filter-everything'),
                    'instructions'  => esc_html__('Specify individual HTML selector of Posts Container for AJAX', 'filter-everything'),
                    'settings'      => true
                );

            }

        }

        return $new_fields;
    }

    public function addSetTailFields(  $fields, $filterSet )
    {
        $new_fields     = [];
        $insert_after   = defined('FLRT_FILTERS_PRO') ? 'custom_posts_container' : 'show_count';

        foreach ( $fields as $key => $attributes ){
            // Always insert regular 'old' field
            $new_fields[$key] = $attributes;

            if( $key === $insert_after ){

                $new_fields['use_search_field'] =  array(
                    'type'          => 'Checkbox',
                    'label'         => esc_html__('Search Field', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('use_search_field'),
                    'id'            => $filterSet->generateFieldId('use_search_field'),
                    'class'         => 'wpc-field-use-search-field',
                    'default'       => 'no',
                    'instructions'  => esc_html__('Allows you to search by text among filtered posts', 'filter-everything'),
                    'settings'      => true
                );

                $new_fields['search_field_menu_order'] = array(
                    'type'          => 'Hidden',
                    'label'         => '',
                    'class'         => 'wpc-menu-order-field',
                    'id'            => $filterSet->generateFieldId('search_field_menu_order'),
                    'name'          => $filterSet->generateFieldName('search_field_menu_order'),
                    'default'       => -1,
                    'settings'      => true
                );

                $new_fields['search_field_label'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('Search Field Title', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('search_field_label'),
                    'id'            => $filterSet->generateFieldId('search_field_label'),
                    'class'         => 'wpc-search-field-label',
                    'default'       => esc_html__('Search', 'filter-everything'),
                    'instructions'  => esc_html__('Specify if needed or leave empty', 'filter-everything'),
                    'settings'      => true
                );

                $new_fields['search_field_placeholder'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('Search Field Placeholder', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('search_field_placeholder'),
                    'id'            => $filterSet->generateFieldId('search_field_placeholder'),
                    'class'         => 'wpc-search-field-placeholder',
                    'placeholder'   => esc_html__( 'e.g. Search products, Search posts', 'filter-everything' ),
                    'default'       => '',
                    'settings'      => true
                );

                $new_fields['use_apply_button'] =  array(
                    'type'          => 'Checkbox',
                    'label'         => esc_html__('«Apply Button» mode', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('use_apply_button'),
                    'id'            => $filterSet->generateFieldId('use_apply_button'),
                    'class'         => 'wpc-field-use-apply-button',
                    'default'       => 'no',
                    'instructions'  => esc_html__('Enables filtering by clicking the Apply button', 'filter-everything'),
                    'settings'      => true
                );

                $new_fields['apply_button_menu_order'] = array(
                    'type'          => 'Hidden',
                    'label'         => '',
                    'class'         => 'wpc-menu-order-field',
                    'id'            => $filterSet->generateFieldId('apply_button_menu_order'),
                    'name'          => $filterSet->generateFieldName('apply_button_menu_order'),
                    'default'       => -1,
                    'settings'      => true
                );

                $new_fields['apply_button_text'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('Apply Button label', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('apply_button_text'),
                    'id'            => $filterSet->generateFieldId('apply_button_text'),
                    'class'         => 'wpc-field-apply-button-text',
                    'default'       => esc_html__('Apply', 'filter-everything'),
                    'settings'      => true
                );

                $new_fields['reset_button_text'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('Reset Button label', 'filter-everything'),
                    'name'          => $filterSet->generateFieldName('reset_button_text'),
                    'id'            => $filterSet->generateFieldId('reset_button_text'),
                    'class'         => 'wpc-field-reset-button-text',
                    'default'       => esc_html__('Reset', 'filter-everything'),
                    'settings'      => true
                );
            }
        }

        return $new_fields;
    }

    public function unsetAvailableInProFields( $setFields )
    {
        unset( $setFields['instead_post_name'], $setFields['instead_custom_posts_container'] );

        return $setFields;
    }

    public function noIndexFilterPages()
    {
        if( flrt_is_filter_request() ){
            $robots['index']    = 'noindex';
            $robots['follow']   = 'nofollow';
            $content = implode(', ', $robots );
            echo sprintf('<meta name="robots" content="%s">', $content)."\r\n";
        }
    }

    public function inlineFrontCss()
    {
        $inline = '<style type="text/css" id="filter-everything-inline-css">.wpc-orderby-select{width:100%}.wpc-filters-open-button-container{display:none}.wpc-debug-message{padding:16px;font-size:14px;border:1px dashed #ccc;margin-bottom:20px}.wpc-debug-title{visibility:hidden}.wpc-button-inner,.wpc-chip-content{display:flex;align-items:center}.wpc-icon-html-wrapper{position:relative;margin-right:10px;top:2px}.wpc-icon-html-wrapper span{display:block;height:1px;width:18px;border-radius:3px;background:#2c2d33;margin-bottom:4px;position:relative}span.wpc-icon-line-1:after,span.wpc-icon-line-2:after,span.wpc-icon-line-3:after{content:"";display:block;width:3px;height:3px;border:1px solid #2c2d33;background-color:#fff;position:absolute;top:-2px;box-sizing:content-box}span.wpc-icon-line-3:after{border-radius:50%;left:2px}span.wpc-icon-line-1:after{border-radius:50%;left:5px}span.wpc-icon-line-2:after{border-radius:50%;left:12px}body .wpc-filters-open-button-container a.wpc-filters-open-widget,body .wpc-filters-open-button-container a.wpc-open-close-filters-button{display:inline-block;text-align:left;border:1px solid #2c2d33;border-radius:2px;line-height:1.5;padding:7px 12px;background-color:transparent;color:#2c2d33;box-sizing:border-box;text-decoration:none!important;font-weight:400;transition:none;position:relative}@media screen and (max-width:768px){.wpc_show_bottom_widget .wpc-filters-open-button-container,.wpc_show_open_close_button .wpc-filters-open-button-container{display:block}.wpc_show_bottom_widget .wpc-filters-open-button-container{margin-top:1em;margin-bottom:1em}}</style>'."\r\n";
        echo $inline;
    }

    public function dynamicFrontCss()
    {
        // Do not include plugin CSS if there are no Filter Sets on the page
        $sets = $this->wpManager->getQueryVar( 'wpc_page_related_set_ids', [] );
        if( empty( $sets ) ) {
            return false;
        }

        $maxHeight        = flrt_get_option( 'container_height' );
        $color            = flrt_get_option( 'primary_color', flrt_default_theme_color() );
        $move_to_top      = flrt_get_option( 'try_move_to_top_sidebar' );
        $wpc_mobile_width = flrt_get_mobile_width();

        // Experimental Options
        $custom_css     = flrt_get_experimental_option('custom_css' );
        $use_loader     = flrt_get_experimental_option('use_loader' );
        $dark_overlay   = flrt_get_experimental_option('dark_overlay' );
        $styled_inputs  = flrt_get_experimental_option('styled_inputs' );
        $use_select2    = flrt_get_experimental_option('select2_dropdowns' );
        $contrastColor  = false;
        $swatches       = apply_filters( 'wpc_swatches_width_height', [ 'width' => 25, 'height' => 25 ] );
        $brands         = apply_filters( 'wpc_brands_width_height', [ 'width' => 70, 'height' => 40 ] );

        $css = '';
        $css .= '@media screen and (min-width:'.($wpc_mobile_width+1).'px){.wpc_show_bottom_widget .wpc-filters-widget-content{height:auto!important}body.wpc_show_open_close_button .wpc-filters-widget-content.wpc-closed,body.wpc_show_open_close_button .wpc-filters-widget-content.wpc-opened,body.wpc_show_open_close_button .wpc-filters-widget-content:not(.wpc-opened){display:block!important}}@media screen and (min-width:'.$wpc_mobile_width.'px){.wpc-custom-selected-terms{clear:both;width:100%}.wpc-custom-selected-terms ul.wpc-filter-chips-list{display:flex;overflow-x:auto;padding-left:0}.wpc-filters-main-wrap .wpc-custom-selected-terms ul.wpc-filter-chips-list{display:block;overflow:visible}html.is-active .wpc-filters-overlay{top:0;opacity:.3;background:#fff}.wpc-filters-main-wrap input.wpc-label-input+label:hover{border:1px solid rgba(0,0,0,.25);border-radius:5px}.wpc-filters-main-wrap input.wpc-label-input+label:hover span.wpc-filter-label-wrapper{color:#333;background-color:rgba(0,0,0,.25)}.wpc-filters-main-wrap .wpc-filters-labels li.wpc-term-item input+label:hover a{color:#333}.theme-storefront #primary .storefront-sorting .wpc-custom-selected-terms{font-size:inherit}.theme-storefront #primary .wpc-custom-selected-terms{font-size:.875em}}@media screen and (max-width:'.$wpc_mobile_width.'px){.wpc-filters-labels li.wpc-term-item label:hover .wpc-term-swatch-wrapper:after,.wpc-filters-labels li.wpc-term-item label:hover .wpc-term-swatch-wrapper:before{display:none;}.wpc_show_bottom_widget .wpc-filters-widget-top-container,.wpc_show_open_close_button .wpc-filters-widget-top-container{text-align:center}.wpc_show_bottom_widget .wpc-filters-widget-top-container{position:sticky;top:0;z-index:99999;border-bottom:1px solid #f7f7f7}.wpc-custom-selected-terms:not(.wpc-show-on-mobile),.wpc-edit-filter-set,.wpc_show_bottom_widget .widget_wpc_selected_filters_widget,.wpc_show_bottom_widget .wpc-filters-widget-content .wpc-filter-set-widget-title,.wpc_show_bottom_widget .wpc-filters-main-wrap .widget-title,.wpc_show_bottom_widget .wpc-filters-widget-wrapper .wpc-filter-layout-submit-button,.wpc_show_bottom_widget .wpc-posts-found,body.wpc_show_bottom_widget .wpc-open-close-filters-button,body.wpc_show_open_close_button .wpc-filters-widget-content:not(.wpc-opened){display:none}.wpc_show_bottom_widget .wpc-filters-widget-top-container:not(.wpc-show-on-desktop),.wpc_show_bottom_widget .wpc-spinner.is-active,.wpc_show_bottom_widget .wpc-widget-close-container,html.is-active body:not(.wpc_show_bottom_widget) .wpc-spinner{display:block}body .wpc-filters-main-wrap li.wpc-term-item{padding:2px 0}.wpc-filters-main-wrap ul.wpc-filters-ul-list{padding-left:0}.wpc-chip-empty{width:0;display:list-item;visibility:hidden;margin-right:0!important}.wpc-overlay-visible #secondary{z-index:auto}html.is-active:not(.wpc-overlay-visible) .wpc-filters-overlay{top:0;opacity:.2;background:#fff}.wpc-custom-selected-terms.wpc-show-on-mobile ul.wpc-filter-chips-list{display:flex;overflow-x:auto;padding-left:0}html.is-active body:not(.wpc_show_bottom_widget) .wpc-filters-overlay{top:0;opacity:.3;background:#fff}body.wpc_show_bottom_widget .wpc-filters-widget-content.wpc-closed,body.wpc_show_bottom_widget .wpc-filters-widget-content.wpc-opened,body.wpc_show_bottom_widget .wpc-filters-widget-content:not(.wpc-opened){display:block!important}.wpc-open-close-filters-button{display:block;margin-bottom:20px}.wpc-overlay-visible body,html.wpc-overlay-visible{overflow:hidden!important}.wpc_show_bottom_widget .widget_wpc_filters_widget,.wpc_show_bottom_widget .wpc-filters-main-wrap{padding:0!important;margin:0!important}.wpc_show_bottom_widget .wpc-filters-range-column{width:48%;max-width:none}.wpc_show_bottom_widget .wpc-filters-toolbar{display:flex;margin:1em 0}.wpc_show_bottom_widget .wpc-inner-widget-chips-wrapper{display:block;padding-left:20px;padding-right:20px}.wpc_show_bottom_widget .wpc-filters-main-wrap .widget-title.wpc-filter-title{display:flex}.wpc_show_bottom_widget .wpc-inner-widget-chips-wrapper .wpc-filter-chips-list,.wpc_show_open_close_button .wpc-inner-widget-chips-wrapper .wpc-filter-chips-list{display:flex;-webkit-box-pack:start;place-content:center flex-start;overflow-x:auto;padding-top:5px;padding-bottom:5px;margin-left:0;padding-left:0}.wpc-overlay-visible .wpc_show_bottom_widget .wpc-filters-overlay{top:0;opacity:.4}.wpc_show_bottom_widget .wpc-filters-main-wrap .wpc-spinner.is-active+.wpc-filters-widget-content .wpc-filters-scroll-container .wpc-filters-widget-wrapper{opacity:.6;pointer-events:none}.wpc_show_bottom_widget .wpc-filters-open-button-container{margin-top:1em;margin-bottom:1em}.wpc_show_bottom_widget .wpc-filters-widget-content{position:fixed;bottom:0;right:0;left:0;top:5%;z-index:999999;padding:0;background-color:#fff;margin:0;box-sizing:border-box;border-radius:7px 7px 0 0;transition:transform .25s;transform:translate3d(0,120%,0);-webkit-overflow-scrolling:touch;height:auto}.wpc_show_bottom_widget .wpc-filters-widget-containers-wrapper{padding:0;margin:0;overflow-y:scroll;box-sizing:border-box;position:fixed;top:56px;left:0;right:0;bottom:0}.wpc_show_bottom_widget .wpc-filters-widget-content.wpc-filters-widget-opened{transform:translate3d(0,0,0)}.theme-twentyfourteen .wpc_show_bottom_widget .wpc-filters-widget-content,.theme-twentyfourteen.wpc_show_bottom_widget .wpc-filters-scroll-container{background-color:#000}.wpc_show_bottom_widget .wpc-filters-section:not(.wpc-filter-post_meta_num):not(.wpc-filter-tax_numeric) .wpc-filter-content ul.wpc-filters-ul-list,.wpc_show_open_close_button .wpc-filters-section:not(.wpc-filter-post_meta_num):not(.wpc-filter-tax_numeric) .wpc-filter-content ul.wpc-filters-ul-list{max-height:none}.wpc_show_bottom_widget .wpc-filters-scroll-container{background:#fff;min-height:100%}.wpc_show_bottom_widget .wpc-filters-widget-wrapper{padding:20px 20px 15px}.wpc-filter-everything-dropdown .select2-search--dropdown .select2-search__field,.wpc-sorting-form select,.wpc_show_bottom_widget .wpc-filters-main-wrap input[type=number],.wpc_show_bottom_widget .wpc-filters-main-wrap input[type=text],.wpc_show_bottom_widget .wpc-filters-main-wrap select,.wpc_show_bottom_widget .wpc-filters-main-wrap textarea,.wpc_show_bottom_widget .wpc-search-field,.wpc_show_open_close_button .wpc-search-field,.wpc_show_open_close_button .wpc-filter-search-field{font-size:16px}.wpc-filter-layout-dropdown .select2-container .select2-selection--single,.wpc-sorting-form .select2-container .select2-selection--single{height:auto;padding:6px}.wpc_show_bottom_widget .wpc-filters-section:not(.wpc-filter-post_meta_num):not(.wpc-filter-tax_numeric) .wpc-filter-content ul.wpc-filters-ul-list{overflow-y:visible}.theme-twentyeleven #primary,.theme-twentyeleven #secondary{margin-left:0;margin-right:0;clear:both;float:none}#main>.fusion-row{max-width:100%}.wpc_show_bottom_widget .wpc-filters-open-button-container,.wpc_show_bottom_widget .wpc-filters-widget-controls-container,.wpc_show_bottom_widget .wpc-filters-widget-top-container,.wpc_show_open_close_button .wpc-filters-open-button-container{display:block}}'."\r\n";
        $css .= '.wpc-preload-img{display:none;}';
        // Number of items visible by default in More/Less filters
        $css .= '.wpc-filter-more-less:not(.wpc-search-active) .wpc-filters-ul-list > li:nth-child(-n+'.flrt_more_less_count().'){display: list-item;}'."\r\n";

        $css .= 'li.wpc-term-item label span.wpc-term-swatch,.wpc-term-swatch-wrapper{width:'.$swatches['width'].'px;min-width:'.$swatches['width'].'px;height:'.$swatches['height'].'px;}'."\r\n";
        $css .= '.wpc-term-swatch-wrapper:after{width:'.($swatches['width']/2.5).'px;height:'.($swatches['width']/5).'px;left:'.($swatches['width']/3.5).'px;top:'.($swatches['height']/3.5).'px;}';
        $css .= '.wpc-term-image-wrapper{width:'.$brands['width'].'px;min-width:'.$brands['width'].'px;height:'.$brands['height'].'px;}';

        if( $maxHeight ){
            $css .= '.wpc-filters-section:not(.wpc-filter-more-less):not(.wpc-filter-post_meta_num):not(.wpc-filter-tax_numeric):not(.wpc-filter-layout-dropdown) .wpc-filter-content:not(.wpc-filter-has-hierarchy) ul.wpc-filters-ul-list{
                        max-height: '.$maxHeight.'px;
                        overflow-y: auto;
                }'."\r\n";
        }

        if( $color ){
            $contrastColor = flrt_get_contrast_color($color);
            $css .= '.wpc-filters-range-inputs .ui-slider-horizontal .ui-slider-range{
                        background-color: '.$color.';
                    }
                '."\r\n";

            $css .= '.wpc-spinner:after {
                        border-top-color: '.$color.';
                    }'."\r\n";

            $css .= '.theme-Avada .wpc-filter-product_visibility .star-rating:before,
                .wpc-filter-product_visibility .star-rating span:before{
                    color: '.$color.';
                }'."\r\n";

            $css .= 'body .wpc-filters-main-wrap input.wpc-label-input:checked+label span.wpc-filter-label-wrapper{
                        background-color: '.$color.';
                }'."\r\n";

            $css .= 'body .wpc-filters-main-wrap input.wpc-label-input:checked+label{
                        border-color: '.$color.';
                }'."\r\n";

            // Disabled label
            $css .= 'body .wpc-filters-main-wrap .wpc-term-disabled input.wpc-label-input:checked+label span.wpc-filter-label-wrapper{
                        background-color: #d8d8d8;
                }'."\r\n";

            $css .= 'body .wpc-filters-main-wrap .wpc-term-disabled input.wpc-label-input:checked+label{
                        border-color: #d8d8d8;
                }'."\r\n";

            $css .= 'body .wpc-filters-main-wrap .wpc-term-disabled input.wpc-label-input+label:hover{
                        border-color: #d8d8d8;
                }'."\r\n";

            $css .= 'body .wpc-filters-main-wrap .wpc-term-disabled input.wpc-label-input:checked+label span.wpc-filter-label-wrapper,
                body .wpc-filters-main-wrap .wpc-filters-labels li.wpc-term-item.wpc-term-disabled input:checked+label a{
                        color: #333333;
                }'."\r\n";
            // End of disabled label

            $css .= 'body .wpc-filters-main-wrap input.wpc-label-input:checked+label span.wpc-filter-label-wrapper,
                body .wpc-filters-main-wrap .wpc-filters-labels li.wpc-term-item input:checked+label a{
                        color: '.$contrastColor.';
                }'."\r\n";

            $css .= 'body .wpc-filter-chips-list li.wpc-filter-chip:not(.wpc-chip-reset-all) a{
                    border-color: '.$color.';
                }'."\r\n";

            $css .= 'body .wpc-filters-main-wrap .wpc-filters-widget-controls-container a.wpc-filters-apply-button,
                body .wpc-filters-main-wrap a.wpc-filters-submit-button{
                    border-color: '.$color.';
                    background-color: '.$color.';
                    color: '.$contrastColor.';
                }'."\r\n";

            $css .= 'body .wpc-filter-chips-list li.wpc-filter-chip:not(.wpc-chip-reset-all) a:hover{
                    opacity: 0.9;
                }'."\r\n";

            $css .= 'body .wpc-filter-chips-list li.wpc-filter-chip:not(.wpc-chip-reset-all) a:active{
                    opacity: 0.75;
                }'."\r\n";

            $css .= '.star-rating span,
                .star-rating span:before{
                    color: '.$color.';
                }'."\r\n";

            $css .= 'body a.wpc-filters-open-widget:active, a.wpc-filters-open-widget:active, 
                .wpc-filters-open-widget:active{
                    border-color: '.$color.';
                    background-color: '.$color.';
                    color: '.$contrastColor.';
                }'."\r\n";

            $css .= 'a.wpc-filters-open-widget:active span.wpc-icon-line-1:after,
                a.wpc-filters-open-widget:active span.wpc-icon-line-2:after,
                a.wpc-filters-open-widget:active span.wpc-icon-line-3:after{
                    background-color: '.$color.';
                    border-color: '.$contrastColor.';
                }'."\r\n";

            $css .= 'a.wpc-filters-open-widget:active .wpc-icon-html-wrapper span{
                    background-color: '.$contrastColor.';
                }'."\r\n";

            $css .= '@media screen and (min-width: '.$wpc_mobile_width.'px) {'."\r\n";
            $css .= 'body .wpc-filters-main-wrap input.wpc-label-input+label:hover span.wpc-filter-label-wrapper{
                        color: '.$contrastColor.';
                        background-color: '.$color.';
                    }'."\r\n";

            $css .= 'body .wpc-filters-main-wrap .wpc-filters-labels li.wpc-term-item input+label:hover a{
                        color: '.$contrastColor.';
                    }'."\r\n";
            $css .= 'body .wpc-filters-main-wrap input.wpc-label-input+label:hover{
                        border-color: '.$color.';
                    }'."\r\n";

            $css .= '.wpc-filters-labels li.wpc-term-has-image label:hover .wpc-term-image-wrapper,
                    .wpc-filters-labels li.wpc-term-has-image input[type=checkbox]:checked + label .wpc-term-image-wrapper{
                        border-color: '.$color.';
                    }'."\r\n";

            $css .= '#ui-datepicker-div.wpc-filter-datepicker .ui-state-active, 
            #ui-datepicker-div.ui-widget-content.wpc-filter-datepicker .ui-state-active, 
            #ui-datepicker-div.wpc-filter-datepicker .ui-widget-header .ui-state-active{
                    border-color: '.$color.';
                    background: '.$color.';
                    opacity: 0.95;
            }'."\r\n";

            $css .= '#ui-datepicker-div.wpc-filter-datepicker .ui-state-hover, 
            #ui-datepicker-div.ui-widget-content.wpc-filter-datepicker .ui-state-hover, 
            #ui-datepicker-div.wpc-filter-datepicker .ui-widget-header .ui-state-hover, 
            #ui-datepicker-div.wpc-filter-datepicker .ui-state-focus, 
            #ui-datepicker-div.ui-widget-content.wpc-filter-datepicker .ui-state-focus, 
            #ui-datepicker-div.wpc-filter-datepicker .ui-widget-header .ui-state-focus{
                border-color: '.$color.';
                background: '.$color.';
                opacity: 0.6;
            }';

            $css .= '#ui-datepicker-div.wpc-filter-datepicker .ui-datepicker-close.ui-state-default{
                background: '.$color.';
                color: '.$contrastColor.';
            }'."\r\n";


            $css .= '}'."\r\n";
        }
        if( $styled_inputs ){
            $styled_color   = $color ? $color : '#0570e2';
            $contrastColor  = $contrastColor ? $contrastColor : flrt_get_contrast_color($styled_color);

            $css .= '.wpc-filters-main-wrap input[type=checkbox],
                        .wpc-filters-main-wrap input[type=radio]{
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            position: relative;
                            width: 20px;
                            height: 20px;
                            border: 2px solid #bdbdbd;
                            border: 2px solid #ccd0dc;
                            background: #ffffff;
                            border-radius: 5px;
                            min-width: 20px;
                        }
                        .wpc-filters-main-wrap input[type=checkbox]:after {
                            content: "";
                            opacity: 0;
                            display: block;
                            left: 5px;
                            top: 2px;
                            position: absolute;
                            width: 4px;
                            height: 8px;
                            border: 2px solid '.$styled_color.';
                            border-top: 0;
                            border-left: 0;
                            transform: rotate(45deg);
                            box-sizing: content-box;
                        }
                        .wpc-filters-main-wrap input[type=radio]:after {
                            content: "";
                            opacity: 0;
                            display: block;
                            left: 4px;
                            top: 4px;
                            position: absolute;
                            width: 8px;
                            height: 8px;
                            border-radius: 50%;
                            background: '.$styled_color.';
                            box-sizing: content-box;
                        }
                        .wpc-filters-main-wrap input[type=radio]:checked,
                        .wpc-filters-main-wrap input[type=checkbox]:checked {
                            border-color: '.$styled_color.';
                        }
                        .wpc-filters-main-wrap .wpc-radio-item.wpc-term-disabled input[type=radio],
                        .wpc-filters-main-wrap .wpc-checkbox-item.wpc-term-disabled > div > input[type=checkbox],
                        .wpc-filters-main-wrap .wpc-checkbox-item.wpc-term-disabled > div > input[type=checkbox]:after,
                        .wpc-filters-main-wrap .wpc-term-count-0:not(.wpc-has-not-empty-children) input[type=checkbox]:after,
                        .wpc-filters-main-wrap .wpc-term-count-0:not(.wpc-has-not-empty-children) input[type=checkbox],
                        .wpc-filters-main-wrap .wpc-term-count-0:not(.wpc-has-not-empty-children) input[type=radio]{
                            border-color: #d8d8d8;
                        }
                        .wpc-filters-main-wrap .wpc-radio-item.wpc-term-disabled input[type=radio]:after,
                        .wpc-filters-main-wrap .wpc-term-count-0:not(.wpc-has-not-empty-children) input[type=radio]:after{
                            background-color: #d8d8d8;
                        }
                        .wpc-filters-main-wrap input[type=radio]:checked:after,
                        .wpc-filters-main-wrap input[type=checkbox]:checked:after {
                            opacity: 1;
                        }
                        .wpc-filters-main-wrap input[type=radio] {
                            border-radius: 50%;
                        }
                        
                        @media screen and (min-width: '.$wpc_mobile_width.'px) {
                            .wpc-filters-main-wrap input[type=radio]:hover,
                            .wpc-filters-main-wrap input[type=checkbox]:hover{
                                border-color: '.$styled_color.';
                            }
                            .wpc-filters-main-wrap .wpc-term-count-0:not(.wpc-has-not-empty-children) input[type=radio]:hover,
                            .wpc-filters-main-wrap .wpc-term-count-0:not(.wpc-has-not-empty-children) input[type=checkbox]:hover{
                                border-color: #c3c3c3;
                            }
                        }';
        }

        if( $use_select2 ){
            $styled_color   = $color ? $color : '#0570e2';
            $contrastColor  = $contrastColor ? $contrastColor : flrt_get_contrast_color($styled_color);

            $css .= '.wpc-sorting-form select,
                        .wpc-filter-content select{
                            padding: 2px 8px 2px 10px;
                            border-color: #ccd0dc;
                            border-radius: 3px;
                            color: inherit;
                            -webkit-appearance: none;
                        }
                        .select2-container--default .wpc-filter-everything-dropdown .select2-results__option--highlighted[aria-selected],
                        .select2-container--default .wpc-filter-everything-dropdown .select2-results__option--highlighted[data-selected]{
                            background-color: '.$styled_color.';
                            color: '.$contrastColor.';  
                        }
                        ';
            $css .= '@media screen and (max-width: '.$wpc_mobile_width.'px) {'."\r\n";
            $css .=  '.wpc-sorting-form select,
                        .wpc-filter-content select{
                            padding: 6px 12px 6px 14px;
                        }';

            $css .= '}'."\r\n";
        }

        if( $move_to_top ){
            $css .= '@media screen and (max-width: '.$wpc_mobile_width.'px) {'."\r\n";

            $css .= 'body #main,
                        body #content .col-full,
                        .woocommerce-page .content-has-sidebar,
                        .woocommerce-page .has-one-sidebar,
                        .woocommerce-page #main-sidebar-container,
                        .woocommerce-page .theme-page-wrapper,
                        .woocommerce-page #content-area,
                        .theme-jevelin.woocommerce-page .woocomerce-styling,
                        .woocommerce-page .content_wrapper,
                        .woocommerce-page #col-mask,
                        body #main-content .content-area {
                            -js-display: flex;
                            display: -webkit-box;
                            display: -webkit-flex;
                            display: -moz-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-orient: vertical;
                            -moz-box-orient: vertical;
                            -webkit-flex-direction: column;
                            -ms-flex-direction: column;
                            flex-direction: column;
                        }
                        body #primary,
                        .woocommerce-page .has-one-sidebar > section,
                        .woocommerce-page .theme-content,
                        .woocommerce-page #left-area,
                        .woocommerce-page #content,
                        .woocommerce-page .sections_group,
                        .woocommerce-page .content-box,
                        body #main-sidebar-container #main {
                            -webkit-box-ordinal-group: 2;
                            -moz-box-ordinal-group: 2;
                            -ms-flex-order: 2;
                            -webkit-order: 2;
                            order: 2;
                        }
                        body #secondary,
                        .woocommerce-page .has-one-sidebar > aside,
                        body aside#mk-sidebar,
                        .woocommerce-page #sidebar,
                        .woocommerce-page .sidebar,
                        body #main-sidebar-container #sidebar {
                            -webkit-box-ordinal-group: 1;
                            -moz-box-ordinal-group: 1;
                            -ms-flex-order: 1;
                            -webkit-order: 1;
                            order: 1;
                        }
                    
                        /*second method first method solve issue theme specific*/
                        .woocommerce-page:not(.single,.page) .btWithSidebar.btSidebarLeft .btContentHolder,
                        body .theme-generatepress.woocommerce #content {
                            display: table;
                        }
                        body .btContent,
                        body .theme-generatepress.woocommerce #primary {
                            display: table-footer-group;
                        }
                        body .btSidebar,
                        body .theme-generatepress.woocommerce #left-sidebar {
                            display: table-header-group;
                        }'."\r\n";
                        $css .= '#ui-datepicker-div.wpc-filter-datepicker .ui-datepicker-close.ui-state-default{
                            background: '.$color.';
                            color: '.$contrastColor.';
                        }'."\r\n";
                        $css .= '.wpc-filters-date-range-column{
                            justify-content: left;
                        }'."\r\n";
            $css .= '}'."\r\n";
        }

        if( $use_loader ){
            $css .= '@media screen and (min-width: '.$wpc_mobile_width.'px) {'."\r\n";
            $css .= 'html.is-active .wpc-spinner{
                                display: block;
                            }';
            $css .= '}'."\r\n";
        }

        if( $dark_overlay ){
            $css .= '@media screen and (min-width: '.$wpc_mobile_width.'px) {'."\r\n";
            $css .= 'html.is-active .wpc-filters-overlay{
                            opacity: .15;
                            background: #000000;
                        }';
            $css .= '}'."\r\n";
        }

        if( $custom_css ){
            $css .= $custom_css."\r\n";
        }

        $wp_upload_dir = wp_upload_dir();
        $upload_dir_baseurl = $wp_upload_dir['baseurl'];
        $upload_dir_basepath = $wp_upload_dir['basedir'];

        $cache_dir = $upload_dir_basepath . '/cache/filter-everything/';

        if ( ! file_exists( $cache_dir ) ) {
            mkdir($cache_dir, 0777, true);
            chmod($cache_dir, 0777);
        }

        $filename = md5( $css ) . '.css';

        $fileurl  = $upload_dir_baseurl .'/cache/filter-everything/' . $filename;
        $filepath = $cache_dir . $filename;

        if ( $css !== '' ) {
            if ( ! file_exists( $filepath ) ) {
                file_put_contents( $filepath, $css );
            }

            if( file_exists( $filepath ) ){
                wp_enqueue_style('wpc-filter-everything-custom', $fileurl );
            }
        }

    }

    public function bodyClass( $classes )
    {
        if( flrt_get_option('show_open_close_button') === 'on' ){
            $classes[] = 'wpc_show_open_close_button';
        }

        if( flrt_is_filter_request() ){
            $classes[] = 'wpc_is_filter_request';
        }

        return $classes;
    }

    public static function activate()
    {
        if ( ! get_option('wpc_filter_settings') ) {
            $default_show_terms_in_content  = [];
            $theme_dependencies             = flrt_get_theme_dependencies();

            if( flrt_is_woocommerce() ){
                $default_show_terms_in_content = ['woocommerce_no_products_found', 'woocommerce_archive_description'];
            }

            if ( isset( $theme_dependencies['chips_hook'] ) && is_array( $theme_dependencies['chips_hook'] ) ) {
                foreach ( $theme_dependencies['chips_hook'] as $compat_chips_hook ) {
                    $default_show_terms_in_content[] = $compat_chips_hook;
                }
            }

            $defaultOptions = array(
                'primary_color'              => '#0570e2',
                'container_height'           => '550',
                'show_open_close_button'     => '',
                'show_terms_in_content'      => $default_show_terms_in_content,
                'widget_debug_messages'      => 'on'
            );

            // PRO default options
            if( defined('FLRT_FILTERS_PRO') && FLRT_FILTERS_PRO ){
                $defaultOptions['show_bottom_widget'] = '';
            }

            add_option('wpc_filter_settings', $defaultOptions );
        }

        if( ! get_option( 'wpc_filter_experimental' ) ){

            $defaultExperimentalOptions = array(
                'use_loader'        => 'on',
                'use_wait_cursor'   => 'on',
                'dark_overlay'      => 'on',
                'auto_scroll'       => '',
                'styled_inputs'     => '',
                'select2_dropdowns' => ''
            );

            add_option('wpc_filter_experimental', $defaultExperimentalOptions );
        }
    }

    /**
     * Clears all plugin data: options and posts
     */
    public static function uninstall( $force = false )
    {
        $allow_to_delete = true;

        if( is_multisite() ){
            $active_plugins = get_site_option('active_sitewide_plugins');
            if( is_array( $active_plugins ) ){
                $active_plugins = array_keys( $active_plugins );
            }
        }else{
            $active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
        }

        $fe_active    = [];
        $to_compare   = [
            'filter-everything-pro/filter-everything.php',
            'filter-everything/filter-everything.php'
        ];

        if( ! empty( $active_plugins ) ){
            foreach ( $active_plugins as $plugin_path ){
                if( in_array( $plugin_path, $to_compare ) ){
                    $fe_active[] = $plugin_path;
                }
            }
        }

        if( count( $fe_active ) > 0 ){
            $allow_to_delete = false;
        }

        if ( $force == true ) {
            $allow_to_delete = true;
        }

        if( $allow_to_delete ){

            $options = [
                'wpc_filter_settings',
                'wpc_indexing_deep_settings',
                'wpc_filter_permalinks',
                'wpc_seo_rules_settings',
                'wpc_filter_experimental',
                'widget_wpc_filters_widget',
                'widget_wpc_sorting_widget',
                'widget_wpc_chips_widget',
            ];

            foreach ( $options as $option_name ){
                delete_option( $option_name );
            }

            // Deactivate and erase license if exists
            if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) {
                $to_send             = false;
                $saved_value         = get_option( FLRT_LICENSE_KEY );

                if( isset( $saved_value['license_key'] ) ) {
                    $saved_value_arr = maybe_unserialize( base64_decode( $saved_value['license_key'] ) );
                    $to_send         = $saved_value_arr;
                }

                if ( is_array( $to_send ) ){
                    $to_send['home_url'] = home_url();

                    // Make data suitable to send as GET variables
                    $to_send = array_map( 'urlencode', $to_send );

                    if ( isset( $saved_value_arr['id'] ) && $saved_value_arr['id'] ) {
                        $apiRequest = new ApiRequests();
                        $result     = $apiRequest->sendRequest('DELETE', 'license', $to_send );

                        // If license was deactivated, we have to refresh updates info
                        delete_transient(FLRT_VERSION_TRANSIENT );
                        delete_option( FLRT_LICENSE_KEY );
                    }
                }

            }

            $postTypes = array(
                FLRT_FILTERS_SET_POST_TYPE,
                FLRT_FILTERS_POST_TYPE
            );

            if( defined( 'FLRT_SEO_RULES_POST_TYPE' ) ){
                $postTypes[] = FLRT_SEO_RULES_POST_TYPE;
            }

            $filterPosts = new \WP_Query(
                array(
                    'posts_per_page' => -1,
                    'post_status' => array('any'),
                    'post_type' => $postTypes,
                    'fields' => 'ids',
                    'suppress_filters' => true
                )
            );

            $filterPostsIds = $filterPosts->get_posts();

            if( ! empty( $filterPostsIds ) ){
                foreach ($filterPostsIds as $post_id) {
                    wp_delete_post( $post_id, true );
                }
            }

        }
    }

    public static function switchTheme() {
        flrt_remove_option('posts_container');
        flrt_remove_option('primary_color');
    }

    public function includeAdminCss()
    {
        $screen = get_current_screen();
        if ( ! is_null( $screen ) && property_exists( $screen, 'base' ) ) {
            $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
            $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : FLRT_PLUGIN_VER;

            if ( in_array( $screen->base, [ 'edit', 'post', 'edit-tags', 'term' ] ) || ( strpos( $screen->base, 'filters-settings' ) !== false ) ) {
                wp_enqueue_style( 'wpc-filter-everything-admin', FLRT_PLUGIN_DIR_URL . 'assets/css/filter-everything-admin'.$suffix.'.css', ['wp-color-picker'], $ver );
            }

            if ( $screen->base === 'widgets' ) {
                wp_enqueue_style('wpc-widgets', FLRT_PLUGIN_DIR_URL . 'assets/css/wpc-widgets' . $suffix . '.css', [], $ver );
            }

        }
    }

    public function includeAdminJs()
    {
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : FLRT_PLUGIN_VER;
        $select2ver = '4.1.0';

        wp_register_script( 'jquery-tiptip', FLRT_PLUGIN_DIR_URL . 'assets/js/jquery-tiptip/jquery.tipTip' . $suffix . '.js', array( 'jquery' ), $ver, true );
        wp_enqueue_script('jquery-tiptip');

        wp_enqueue_script('wpc-filters-admin', FLRT_PLUGIN_DIR_URL . 'assets/js/wpc-filters-common-admin' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker', 'select2' ), $ver, true );

        $l10n = array(
            'prefixesOrderAvailableInPro' => esc_html__( 'Editing the order of URL prefixes is available in the PRO version', 'filter-everything' ),
            'chipsPlaceholder'            => esc_html__( 'Select or enter hooks', 'filter-everything' ),
            'colorSwatchesPlaceholder'    => esc_html__( 'Click to select taxonomies', 'filter-everything' ),
        );
        wp_localize_script( 'wpc-filters-admin', 'wpcFiltersAdminCommon', $l10n );

        wp_enqueue_script( 'select2', FLRT_PLUGIN_DIR_URL . "assets/js/select2/select2".$suffix.".js", array('jquery'), $select2ver );
        wp_enqueue_style('select2', FLRT_PLUGIN_DIR_URL . "assets/css/select2/select2".$suffix.".css", '', $select2ver );

        $screen = get_current_screen();

        if( ! is_null( $screen ) && property_exists( $screen, 'base' ) && $screen->base === 'widgets' ){
            wp_enqueue_script('wpc-widgets', FLRT_PLUGIN_DIR_URL . 'assets/js/wpc-widgets' . $suffix . '.js', array('jquery'), $ver );
            $l10n = array(
                'wpcItemNum'  => esc_html__( 'Item #', 'filter-everything')
            );
            wp_localize_script( 'wpc-widgets', 'wpcWidgets', $l10n );
        }
    }

    public function includeFrontCss()
    {
        $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
        $ver = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? rand(0, 1000) : FLRT_PLUGIN_VER;
        /**
         * string
         */
        $getData  = Container::instance()->getTheGet();
        if( isset( $getData[FLRT_BEAVER_BUILDER_VAR] ) ){
            wp_enqueue_style('wpc-widgets', FLRT_PLUGIN_DIR_URL . 'assets/css/wpc-widgets' . $suffix . '.css', [], $ver );
        }

        // Do not include plugin CSS if there are no Filter Sets on the page
        $sets = $this->wpManager->getQueryVar('wpc_page_related_set_ids', []);
        if( empty( $sets ) ) {
            return false;
        }

        wp_enqueue_style('wpc-filter-everything', FLRT_PLUGIN_DIR_URL . 'assets/css/filter-everything' . $suffix . '.css', [], $ver);
    }

    public function footerHtml()
    {
        echo '<div class="wpc-filters-overlay"></div>'."\r\n";
    }

    public function includeFrontJs()
    {
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : FLRT_PLUGIN_VER;
        /**
         * string
         */
        $getData  = Container::instance()->getTheGet();
        $em       = Container::instance()->getEntityManager();

        $wpcFrontJsVariables = [];

        if( isset( $getData[FLRT_BEAVER_BUILDER_VAR] ) ){
            wp_enqueue_script('wpc-widgets', FLRT_PLUGIN_DIR_URL . 'assets/js/wpc-widgets' . $suffix . '.js', array('jquery'), $ver );
            $l10n = array(
                'wpcItemNum'  => esc_html__( 'Item #', 'filter-everything' )
            );
            wp_localize_script( 'wpc-widgets', 'wpcWidgets', $l10n );
        }

        // Do not include plugin JS if there are no Filter Sets on the page
        $sets               = $this->wpManager->getQueryVar( 'wpc_page_related_set_ids', [] );
        $related_filters = $em->getSetsRelatedFilters( $sets );
        $date_filters       = [];
        $include_timepicker = false;

        if ( ! empty( $related_filters ) ) {
            foreach ( $related_filters as $filter ) {
                if ( in_array( $filter['entity'], [ 'post_date', 'post_meta_date' ] ) ) {

                    $date_time = flrt_split_date_time( $filter['date_format'] );

                    global $wp_locale;
                    $date_filters[ $filter['ID'] ] = [
                        'date_type'     => $filter['date_type'],
                        'date_format'   => flrt_convert_date_to_js( $date_time['date'] ),
                        'time_format'   => flrt_convert_time_to_js( $date_time['time'] ),
                    ];

                    if ( in_array( $filter['date_type'], [ 'time', 'datetime' ] ) ) {
                        $include_timepicker = true;
                    }

                }
            }
        }

        /**
         * Do not continue and do not include any assets
         * if this page does not contain Filter Sets
         */
        if ( empty( $sets ) ) {
            return false;
        }

        $showBottomWidget   = 'no';
        $ajaxEnabled        = false;
        $autoScroll         = false;
        $waitCursor         = false;
        $wpcUseSelect2      = false;
        $wpcPopupCompatMode = false;
        $autoScrollOffset   = apply_filters( 'wpc_auto_scroll_offset', 150 );
        $wpc_mobile_width   = flrt_get_mobile_width();
        $per_page           = [];
        $applyButtonSets    = [];
        $queryOnThePageSets = [];
        $filterSetService   = Container::instance()->getFilterSetService();

        if ( flrt_get_option('show_bottom_widget') === 'on' ) {
            $showBottomWidget = 'yes';
        }

        if ( flrt_get_option('enable_ajax') === 'on' ) {
            $ajaxEnabled = true;
        }

        if ( flrt_get_experimental_option('auto_scroll') === 'on' ) {
            $autoScroll = true;
        }

        if ( flrt_get_experimental_option( 'use_wait_cursor' ) === 'on' ) {
            $waitCursor = true;
        }

        if ( flrt_get_option('bottom_widget_compatibility') ) {
            $wpcPopupCompatMode = true;
        }

        //@todo This appears on login page and produce not an array error
        foreach( $sets as $set ){
            if( $set['filtered_post_type'] === 'product' && function_exists('wc_get_default_products_per_row') ){
                $numberposts = apply_filters( 'loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page() );
            }else{
                $numberposts = get_option( 'posts_per_page' );
            }

            $per_page[ $set['ID'] ] = intval($numberposts);
            $theSet = $filterSetService->getSet( $set['ID'] );

            if( isset( $set['query_on_the_page'] ) && $set['query_on_the_page'] ){
                if( (int) $set['ID'] > 0 ) {
                    $queryOnThePageSets[] = (int) $set['ID'];
                }
            }

            if( isset( $theSet['use_apply_button']['value'] ) && $theSet['use_apply_button']['value'] === 'yes' ){
                if( (int) $set['ID'] > 0 ){
                    $applyButtonSets[] = (int) $set['ID'];
                }
            }
        }

        $per_page = apply_filters( 'wpc_filter_sets_posts_per_page', $per_page );

        $wpcPostContainers = apply_filters( 'wpc_posts_containers', flrt_get_option( 'posts_container', flrt_default_posts_container() ) );

        wp_register_script( 'wc-jquery-ui-touchpunch', FLRT_PLUGIN_DIR_URL . 'assets/js/jquery-ui-touch-punch/jquery-ui-touch-punch'.$suffix.'.js', [], $ver, true );

        $wpcFrontJsVariables = array(
            'ajaxUrl'                    => admin_url('admin-ajax.php'),
            'wpcAjaxEnabled'             => $ajaxEnabled,
            'wpcStatusCookieName'        => FLRT_FOLDING_COOKIE_NAME,
            'wpcMoreLessCookieName'      => FLRT_MORELESS_COOKIE_NAME,
            'wpcHierarchyListCookieName' => FLRT_HIERARCHY_LIST_COOKIE_NAME,
            'wpcWidgetStatusCookieName'  => FLRT_OPEN_CLOSE_BUTTON_COOKIE_NAME,
            'wpcMobileWidth'             => $wpc_mobile_width,
            'showBottomWidget'           => $showBottomWidget,
            '_nonce'                     => wp_create_nonce('wpcNonceFront'),
            'wpcPostContainers'          => $wpcPostContainers,
            'wpcAutoScroll'              => $autoScroll,
            'wpcAutoScrollOffset'        => $autoScrollOffset,
            'wpcWaitCursor'              => $waitCursor,
            'wpcPostsPerPage'            => $per_page,
            'wpcUseSelect2'              => $wpcUseSelect2,
            'wpcDateFilters'          => false,
            'wpcPopupCompatMode'         => $wpcPopupCompatMode,
            'wpcApplyButtonSets'         => $applyButtonSets,
            'wpcQueryOnThePageSets'      => $queryOnThePageSets,
            'wpcNoPostsContainerMsg'     => esc_html__('It appears that this page does not contain a container with the specified «HTML id or class of the Posts Container». Try to specify the correct one in the Filter Set settings or the common plugin Settings.', 'filter-everything'),
        );

        /**
         * We includes Flatpickr.js only on pages, where date filter is used.
         */
        if ( ! empty( $date_filters ) ) {

            wp_enqueue_script( 'jquery-ui-datepicker' );
            wp_enqueue_style( 'wpc-datepicker', FLRT_PLUGIN_DIR_URL . 'assets/css/datepicker/jquery-ui'.$suffix.'.css', array(), '1.11.4' );

            if ( $include_timepicker ) {
                wp_enqueue_script( 'wpc-timepicker', FLRT_PLUGIN_DIR_URL . "assets/js/timepicker/jquery-ui-timepicker-addon".$suffix.".js", array( 'jquery-ui-datepicker' ), '1.6.3' );
                wp_enqueue_style( 'wpc-timepicker', FLRT_PLUGIN_DIR_URL . "assets/css/timepicker/jquery-ui-timepicker-addon".$suffix.".css", array(), '1.6.3' );
            }

            $wpcFrontJsVariables['wpcDateFilters'] = $date_filters;
            $wpcFrontJsVariables['wpcDateFiltersLocale'] = determine_locale();
            $wpcFrontJsVariables['wpcDateFiltersL10n'] = array(
                'closeText'       => _x( 'Filter', 'Date Picker closeText', 'filter-everything' ),
                'currentText'     => _x( 'Today', 'Date Picker currentText', 'filter-everything' ),
                'nextText'        => _x( 'Next', 'Date Picker nextText', 'filter-everything' ),
                'prevText'        => _x( 'Prev', 'Date Picker prevText', 'filter-everything' ),
                'weekHeader'      => _x( 'Wk', 'Date Picker weekHeader', 'filter-everything' ),
                'timeOnlyTitle'   => _x( 'Choose Time', 'Date Time Picker timeOnlyTitle', 'filter-everything' ),
                'timeText'        => _x( 'Time', 'Date Time Picker timeText', 'filter-everything' ),
                'hourText'        => _x( 'Hour', 'Date Time Picker hourText', 'filter-everything' ),
                'minuteText'      => _x( 'Minute', 'Date Time Picker minuteText', 'filter-everything' ),
                'secondText'      => _x( 'Second', 'Date Time Picker secondText', 'filter-everything' ),
                'timezoneText'    => _x( 'Time Zone', 'Date Time Picker timezoneText', 'filter-everything' ),
                'selectText'      => _x( 'Select', 'Date Time Picker selectText', 'filter-everything' ),
                'amNames'         => array(
                    _x( 'AM', 'Date Time Picker amText', 'filter-everything' ),
                    _x( 'A', 'Date Time Picker amTextShort', 'filter-everything' ),
                ),
                'pmNames'       => array(
                    _x( 'PM', 'Date Time Picker pmText', 'filter-everything' ),
                    _x( 'P', 'Date Time Picker pmTextShort', 'filter-everything' ),
                ),

                'monthNames'      => array_values( $wp_locale->month ),
                'monthNamesShort' => array_values( $wp_locale->month_abbrev ),
                'dayNames'        => array_values( $wp_locale->weekday ),
                'dayNamesMin'     => array_values( $wp_locale->weekday_initial ),
                'dayNamesShort'   => array_values( $wp_locale->weekday_abbrev ),
                'firstDay'        => get_option( 'start_of_week' ),
            );
        }

        /**
         * Include Main Front filters javascript
         */
        wp_enqueue_script('wpc-filter-everything', FLRT_PLUGIN_DIR_URL . 'assets/js/filter-everything'.$suffix.'.js', array('jquery', 'jquery-ui-slider', 'wc-jquery-ui-touchpunch'), $ver, true );

        if( flrt_get_experimental_option('select2_dropdowns') === 'on' ){
            $select2ver = '4.1.0';
            $wpcUseSelect2 = 'yes';
            wp_enqueue_script( 'select2', FLRT_PLUGIN_DIR_URL . "assets/js/select2/select2".$suffix.".js", array('jquery'), $select2ver );
            wp_enqueue_style('select2', FLRT_PLUGIN_DIR_URL . "assets/css/select2/select2".$suffix.".css", '', $select2ver );
        }

        $wpcFrontJsVariables['wpcUseSelect2'] = $wpcUseSelect2;

        wp_localize_script( 'wpc-filter-everything', 'wpcFilterFront', $wpcFrontJsVariables );

        unset( $filterSetService, $wpcFrontJsVariables );
    }

    public function removeApplyButtonOrderField( &$set_settings_fields )
    {
        unset( $set_settings_fields['apply_button_menu_order'], $set_settings_fields['search_field_menu_order'] );
    }

    public function handleFilterSetFieldsVisibility( $filterSetFields )
    {
        if( isset( $filterSetFields['use_apply_button']['value'] ) && $filterSetFields['use_apply_button']['value'] === 'yes' ) {
            $filterSetFields['apply_button_text']['additional_class'] = 'wpc-opened';
            $filterSetFields['reset_button_text']['additional_class'] = 'wpc-opened';
        }

        if ( isset( $filterSetFields['use_search_field']['value'] ) && $filterSetFields['use_search_field']['value'] === 'yes' ) {
            $filterSetFields['search_field_placeholder']['additional_class'] = 'wpc-opened';
            $filterSetFields['search_field_label']['additional_class']       = 'wpc-opened';
        }

        return $filterSetFields;
    }

    public function disableCacheProductsShortcode( $out )
    {
        $wpManager          = Container::instance()->getWpManager();
        $is_filter_request  = $wpManager->getQueryVar('wpc_is_filter_request');
        $thePost            = Container::instance()->getThePost();
        $action             = isset( $thePost['action'] ) ? $thePost['action'] : false;

        // wpc_get_wp_queries - action to get WP_Queries on a page
        if( isset( $out['cache'] ) && ( $is_filter_request || $action === 'wpc_get_wp_queries' ) ){
            $out['cache'] = false;
        }

        return $out;
    }

    public function showCombinedFields( &$filter, $field_key )
    {
        $includeExclude = flrt_extract_vars( $filter, array('exclude', 'include') );
        if( $includeExclude ):

            ?><tr class="<?php echo esc_attr( flrt_filter_row_class( $includeExclude['exclude'] ) ); ?>"<?php flrt_maybe_hide_row( $includeExclude['exclude'] ); ?>><?php

            flrt_include_admin_view('filter-field-label', array(
                    'field_key'  => 'exclude',
                    'attributes' => $includeExclude['exclude']
                )
            );
            ?>
            <td class="wpc-filter-field-td wpc-filter-field-include-exclude-td">
                <div class="wpc-filter-field-include-exclude-wrap">
                    <div class="wpc-field-wrap wpc-field-exclude-wrap <?php if( isset( $includeExclude['exclude']['id'] ) ){ echo esc_attr( $includeExclude['exclude']['id'] ); } ?>-wrap">
                        <?php echo flrt_render_input( $includeExclude['exclude'] ); // Already escaped in function ?>
                        <?php do_action('wpc_after_filter_input', $includeExclude['exclude'] ); ?>
                    </div>
                    <div class="wpc-field-wrap wpc-field-include-wrap <?php if( isset( $includeExclude['include']['id'] ) ){ echo esc_attr( $includeExclude['include']['id'] ); } ?>-wrap">
                        <?php echo flrt_render_input( $includeExclude['include'] ); // Already escaped in function ?>
                        <?php do_action('wpc_after_filter_input', $includeExclude['include'] ); ?>
                    </div>
                </div>
            </td>
            </tr><?php

        endif;

        if ( $field_key === 'min_num_label' ) {
            $min_max_num_labels = flrt_extract_vars( $filter, array( 'min_num_label', 'max_num_label' ) );

            if( $min_max_num_labels ) :
                $min_field_id = $max_field_id = '';

                if (isset($min_max_num_labels['min_num_label']['id'])) {
                    $min_field_id = esc_attr($min_max_num_labels['min_num_label']['id']);
                }
                if( isset( $min_max_num_labels['max_num_label']['id'] ) ){
                    $max_field_id =  esc_attr( $min_max_num_labels['max_num_label']['id'] );
                }

                if( isset($min_max_num_labels['min_num_label']['value']) ){
                    $min_max_num_labels['min_num_label']['data-caret'] = mb_strlen( $min_max_num_labels['min_num_label']['value'] ) + 1;
                }

                if( isset($min_max_num_labels['max_num_label']['value']) ){
                    $min_max_num_labels['max_num_label']['data-caret'] = mb_strlen( $min_max_num_labels['max_num_label']['value'] ) + 1;
                }

                ?><tr class="<?php echo esc_attr( flrt_filter_row_class( $min_max_num_labels['min_num_label'] ) ); ?>"<?php flrt_maybe_hide_row( $min_max_num_labels['min_num_label'] ); ?>><?php

                flrt_include_admin_view('filter-field-label', array(
                        'field_key'  => 'min_num_label',
                        'attributes' => $min_max_num_labels['min_num_label']
                    )
                );
                ?>
                <td class="wpc-filter-field-td wpc-filter-field-min-max-labels-td">
                    <div class="wpc-filter-field-min-max-labels-wrap">
                        <div class="wpc-field-wrap wpc-field-min_num_label-wrap <?php echo $min_field_id; ?>-wrap">
                            <?php echo flrt_render_input( $min_max_num_labels['min_num_label'] ); // Already escaped in function ?>
                            <?php do_action('wpc_after_filter_input', $min_max_num_labels['min_num_label'] ); ?>
                        </div>
                        <div class="wpc-field-wrap wpc-field-max_num_label-wrap <?php echo $max_field_id; ?>-wrap">
                            <?php echo flrt_render_input( $min_max_num_labels['max_num_label'] ); // Already escaped in function ?>
                            <?php do_action('wpc_after_filter_input', $min_max_num_labels['max_num_label'] ); ?>
                        </div>
                        <p class="description"><?php echo wp_kses(
                                sprintf( __('For example, "Price from <span class="wpc-variable-inserter" data-field="%s" title="Click to insert the variable">{value}</span> $" will be displayed as "Price from 150 $"', 'filter-everything'), $min_field_id ),
                                array( 'span' => array(
                                        'class' => true,
                                        'data-field' => true,
                                        'title' => true,
                                ) )
                            ) ?></p>
                    </div>
                </td>
                </tr><?php

            endif;
        }
    }

    public function addSearchArgsToWpQuery( $wp_query )
    {
        if ( isset( $_GET['srch'] ) && $_GET['srch']  ) {
            $keyword = filter_input( INPUT_GET, 'srch', FILTER_DEFAULT );
            $wp_query->set( 's', $keyword );
        }

        return $wp_query;
    }

    public function addSkuSearchSql( $search, $wp_query )
    {
        if( $wp_query->get('flrt_query_hash') || $wp_query->get('flrt_query_clone') ){

            if ( $wp_query->get('wc_query') === 'product_query' || $wp_query->get('post_type') === 'product' /* || $wp_query->get('post_type') === 'product_variation' */ ) {
                global $wpdb;

                $product_id = wc_get_product_id_by_sku( $wp_query->get('s') );
                if ( ! $product_id ) {
                    return $search;
                }

                $product = wc_get_product( $product_id );
                if ( $product->is_type( 'variation' ) ) {
                    $product_id = $product->get_parent_id();
                }

                $search = str_replace( 'AND (((', "AND (({$wpdb->posts}.ID IN (" . $product_id . ")) OR ((", $search );
                return $search;
            }

        }
        return $search;
    }

    public function postDateWhere( $where, $wp_query )
    {   global $wpdb;
        $sql = [];
        $operator = '';
        $wpc_date_query = $wp_query->get( 'wpc_date_query' );

        if( ! empty( $wpc_date_query ) && is_array( $wpc_date_query ) ) {
                foreach ( $wpc_date_query as $edge => $value ) {
                    if( $edge === 'from' ) {
                        $operator = '>=';
                    } elseif ( $edge === 'to' ) {
                        $operator = '<=';
                    }

                    $sql[] = $wpdb->prepare( "AND {$wpdb->posts}.post_date {$operator} %s ", $value );

                }

                $where = implode( ' ', $sql ) . $where;
        }

        return $where;
    }
}