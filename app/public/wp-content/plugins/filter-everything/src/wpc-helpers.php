<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

use \FilterEverything\Filter\Container;
use \FilterEverything\Filter\FilterSet;
use \FilterEverything\Filter\FilterFields;
use \FilterEverything\Filter\PostMetaNumEntity;
use \FilterEverything\Filter\PostDateEntity;

/**
 * Returns user's caps level that allows to use the plugin.
 * Developers can modify this level via hook 'wpc_plugin_user_caps' ot their own risk.
 * @return string
 */
function flrt_plugin_user_caps(){
    return apply_filters( 'wpc_plugin_user_caps', 'manage_options' );
}

function flrt_the_set( $set_id = 0 ){
    global $flrt_sets;

    if( function_exists('brizy_load' ) ){
        if( ! did_action('wp_print_scripts') ) {
            return false;
        }
    }

    if( $set_id ){
        foreach ( $flrt_sets as $k => $set ){
            if( $set['ID'] === $set_id ){
                unset( $flrt_sets[$k] );
                return $set;
            }
        }
    }

    return array_shift( $flrt_sets );
}

function flrt_print_filters_for( $hook = '' ) {
    global $wp_filter;
    if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
        return;
    return $wp_filter[$hook];
}

function flrt_is_filter_request()
{
    $wpManager = Container::instance()->getWpManager();
    return $wpManager->getQueryVar('wpc_is_filter_request');
}

function flrt_include($filename )
{
    $path = flrt_get_path( $filename );

    if( file_exists($path) ) {
        include_once( $path );
    }
}

function flrt_get_path($path = '' )
{
    return FLRT_PLUGIN_DIR_PATH . ltrim($path, '/');
}

function flrt_ucfirst( $text )
{
    if( ! is_string( $text ) ){
        return $text;
    }
    return mb_strtoupper( mb_substr( $text, 0, 1 ) ) . mb_substr( $text, 1 );
}

function flrt_sanitize_tooltip($var )
{
    return htmlspecialchars(
        wp_kses(
            html_entity_decode( $var ),
            array(
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
                'small'  => array(),
                'span'   => array(),
                'ul'     => array(),
                'li'     => array(),
                'ol'     => array(),
                'p'      => array(),
                'a'      => array('href'=>true)
            )
        )
    );
}

function flrt_help_tip($tip, $allow_html = false )
{
    if ( $allow_html ) {
        $tip = flrt_sanitize_tooltip( $tip );
    } else {
        $tip = esc_attr( $tip );
    }

    return '<span class="wpc-help-tip" data-tip="' . $tip . '"></span>';
}

function flrt_tooltip($attr )
{
    if( ! isset( $attr['tooltip'] ) || ! $attr['tooltip'] ){
        return false;
    }

    return flrt_help_tip($attr['tooltip'], true);
}

function flrt_field_instructions($attr)
{
    if( ! isset( $attr['instructions'] ) || ! $attr['instructions'] ){
        return false;
    }
    $instructions = wp_kses(
        $attr['instructions'],
        array(
            'br' => array(),
            'span' => array('class'=>true),
            'strong' => array(),
            'a' => array('href'=>true, 'title'=>true)
        )
    );
    return '<p class="wpc-field-description">'.$instructions.'</p>';
}

function flrt_add_query_arg(...$args ) {
    if ( is_array( $args[0] ) ) {
        if ( count( $args ) < 2 || false === $args[1] ) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = $args[1];
        }
    } else {
        if ( count( $args ) < 3 || false === $args[2] ) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = $args[2];
        }
    }

    $frag = strstr( $uri, '#' );
    if ( $frag ) {
        $uri = substr( $uri, 0, -strlen( $frag ) );
    } else {
        $frag = '';
    }

    if ( 0 === stripos( $uri, 'http://' ) ) {
        $protocol = 'http://';
        $uri      = substr( $uri, 7 );
    } elseif ( 0 === stripos( $uri, 'https://' ) ) {
        $protocol = 'https://';
        $uri      = substr( $uri, 8 );
    } else {
        $protocol = '';
    }

    if ( strpos( $uri, '?' ) !== false ) {
        list( $base, $query ) = explode( '?', $uri, 2 );
        $base                .= '?';
    } elseif ( $protocol || strpos( $uri, '=' ) === false ) {
        $base  = $uri . '?';
        $query = '';
    } else {
        $base  = '';
        $query = $uri;
    }

    wp_parse_str( $query, $qs );

    if ( is_array( $args[0] ) ) {
        foreach ( $args[0] as $k => $v ) {
            $qs[ $k ] = $v;
        }
    } else {
        $qs[ $args[0] ] = $args[1];
    }

    foreach ( $qs as $k => $v ) {
        if ( false === $v ) {
            unset( $qs[ $k ] );
        }
    }

    $ret = build_query( $qs );
    $ret = trim( $ret, '?' );
    $ret = preg_replace( '#=(&|$)#', '$1', $ret );
    $ret = $protocol . $base . $ret . $frag;
    $ret = rtrim( $ret, '?' );
    return $ret;
}

/**
 * @param $terms array
 * @param $keys array
 *
 * @return array Array of objects with required keys
 */
function flrt_extract_objects_vars( $terms, $keys = [] )
{
    $required = [];

    foreach ( $terms as $i => $term ) {
        $new_object = new \stdClass();

        foreach( $keys as $key ) {
            if( isset( $term->$key ) ){
                $new_object->$key = $term->$key;
                $required[$term->term_id] = $new_object;
            }
        }
    }

    return $required;
}


function flrt_remove_level_array( $array )
{
    /**
     * @feature maybe rewrite this full of shame code
     */
    if( ! is_array( $array ) ){
        return [];
    }

    $flatten = [];

    array_map( function ($a) use(&$flatten){
        if( is_array( $a ) ){
            $flatten = array_merge($flatten, $a);
        }
    },
        $array );

    return $flatten;
}

/**
 * @return bool whether to ask about rate or not
 */
function flrt_ask_for_help(){
    $to_ask        = false;
    $first_install = get_option( 'wpc_first_install' );
    /**
     * string
     */
    $the_get       = Container::instance()->getTheGet();

    if ( isset( $the_get['remove_help_tab'] ) && $the_get['remove_help_tab'] == 'true' ) {
        $first_install['rate_disabled'] = true;
        update_option( 'wpc_first_install', $first_install );
        return false;
    }

    if ( $first_install ) {
        // Rate is finally disabled
        if ( isset( $first_install['rate_disabled'] ) && $first_install['rate_disabled'] === true ) {
            return false;
        }
        // If delay time has already passed
        $now = time();
        if ( isset( $first_install['rate_delayed'] ) && $first_install['rate_delayed'] > $now ) {
            return true;
        }
        $_30_days_ago = $now - 2592000;
        if ( isset( $first_install['install_time'] ) && $first_install['install_time'] < $_30_days_ago ) {
            return true;
        }
    }

    return $to_ask;
}

function flrt_get_forbidden_prefixes()
{
    //@todo it seems all existing tax prefixes should be there
    // All them actual only when permalinks off
    $forbidden_prefixes = [ 'srch' ];
    $permalinksEnabled = defined('FLRT_PERMALINKS_ENABLED') ? FLRT_PERMALINKS_ENABLED : false;
    if( ! $permalinksEnabled ) {
        $forbidden_prefixes = array_merge( $forbidden_prefixes, array('cat', 'tag', 'page', 'author') );
    }

    if( flrt_wpml_active() ){
        $wpml_url_format = apply_filters( 'wpml_setting', 0, 'language_negotiation_type' );
        if( $wpml_url_format === '3' ){
            $forbidden_prefixes[] = 'lang';
        }
    }

    return apply_filters( 'wpc_forbidden_prefixes', $forbidden_prefixes );
}

function flrt_get_forbidden_meta_keys()
{
    $forbidden_meta_keys = array('wpc_filter_set_post_type', 'wpc_seo_rule_post_type');
    return apply_filters( 'wpc_forbidden_meta_keys', $forbidden_meta_keys );
}

function flrt_array_contains_duplicate($array )
{
    return count($array) != count( array_unique($array) );
}

function flrt_maybe_hide_row( $atts )
{
    if( $atts['type'] === 'Hidden' ){
        echo ' style="display:none;"';
    }
}
function flrt_filter_row_class( $field_atts )
{
    $classes = [ 'wpc-filter-tr' ];

    if( isset( $field_atts['class'] ) ){
        $classes[] = $field_atts['class'] . '-tr';
    }

    if( isset( $field_atts['additional_class'] ) ){
        $classes[] = $field_atts['additional_class'];
    }

    return implode(" ", $classes);
}


function flrt_include_admin_view( $path, $args = [] )
{
    $templateManager = Container::instance()->getTemplateManager();
    $templateManager->includeAdminView( $path, $args );
}

function flrt_include_front_view( $path, $args = [] )
{
    $templateManager = Container::instance()->getTemplateManager();
    $templateManager->includeFrontView( $path, $args );
}

function flrt_create_filters_nonce()
{
    return FilterSet::createNonce();
}

function flrt_get_filter_fields_mapping()
{
    return Container::instance()->getFilterFieldsService()->getFieldsMapping();
}

function flrt_get_configured_filters($post_id )
{
    $filterFields   = Container::instance()->getFilterFieldsService();
    return $filterFields->getFiltersInputs( $post_id );
}

function flrt_get_filter_view_name($view_key )
{
    $view_options = FilterFields::getViewOptions();
    if( isset( $view_options[ $view_key ] ) ){
        return esc_html($view_options[ $view_key ]);
    }

    return esc_html($view_key);
}

function flrt_get_filter_entity_name($entity_key )
{
    $em = Container::instance()->getEntityManager();
    $entities = $em->getPossibleEntities();

    foreach( $entities as $key => $entity_array ){
        if( isset( $entity_array['entities'][ $entity_key ] ) ){
            return esc_html($entity_array['entities'][ $entity_key ]);
        }
    }

    if( $entity_key === 'post_meta_exists' && ! defined('FLRT_FILTERS_PRO') ){
        return esc_html__('Available in PRO', 'filter-everything');
    }

    return esc_html($entity_key);
}

function flrt_get_set_settings_fields($post_id)
{
    $filterSet = Container::instance()->getFilterSetService();
    return $filterSet->getSettingsTypeFields( $post_id );
}

function flrt_render_input( $atts )
{
    $className = isset( $atts['type'] ) ? '\FilterEverything\Filter\\' . $atts['type'] : '\FilterEverything\Filter\Text';

    if( class_exists( $className ) ){
        $input = new $className( $atts );
        return $input->render();
    }

    return false;
}

function flrt_extract_vars(&$array, $keys )
{
    $r = [];
    foreach( $keys as $key ) {
        $var = flrt_extract_var( $array, $key );
        if( $var ){
            $r[ $key ] = $var;
        }
    }
    return $r;
}

function flrt_extract_var(&$array, $key, $default = null )
{
    // check if exists
    // - uses array_key_exists to extract NULL values (isset will fail)
    if( is_array($array) && array_key_exists($key, $array) ) {
        $v = $array[ $key ];
        unset( $array[ $key ] );
        return $v;
    }
    return $default;
}

function flrt_get_empty_filter( $set_id )
{
    $filterFields = Container::instance()->getFilterFieldsService();
    return $filterFields->getEmptyFilterObject( $set_id );
}

function flrt_excluded_taxonomies()
{
    $excluded_taxonomies = array(
        'nav_menu',
        'link_category',
        'post_format',
        'template_category',
        'element_category',
        'fusion_tb_category',
        'slide-page',
        'elementor_font_type',
        'post_translations',
        'term_language',
        'term_translations',
        'wp_theme',
        'wp_template_part_area',
        'wp_pattern_category',
    );

    return apply_filters( 'wpc_excluded_taxonomies', $excluded_taxonomies );
}

function flrt_force_non_unique_slug($notNull, $originalSlug )
{
    return $originalSlug;
}

function flrt_redirect_to_error($post_id, $errors )
{
    $redirect = get_edit_post_link( $post_id, 'url' );
    $error_code = 20; // Default error code

    if( !empty( $errors ) && is_array( $errors ) ){
        $error_code = reset( $errors );
    }

    $redirect = add_query_arg( 'message', $error_code, $redirect );
    wp_redirect( $redirect );
    exit;
}

function flrt_sanitize_int( $var )
{
    return preg_replace('/[^\d]+/', '', $var );
}

function flrt_range_input_name( $slug, $edge = 'min', $type = 'num' )
{
    if ( $type === 'date' ) {
        return PostDateEntity::inputName( $slug, $edge );
    }

    return PostMetaNumEntity::inputName( $slug, $edge );
}

function flrt_query_string_form_fields( $values = null, $exclude = [], $current_key = '', $return = false ) {

    $filter_everything_exclude = array_keys( apply_filters( 'wpc_unnecessary_get_parameters', [] ) );
    $exclude = array_merge( $exclude, $filter_everything_exclude );

    if ( is_null( $values ) ) {
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $values = Container::instance()->getTheGet();
        // For compatibility with some Nginx configurations
        unset($values['q']);
    } elseif ( is_string( $values ) ) {
        $url_parts = wp_parse_url( $values );
        $values    = [];

        if ( ! empty( $url_parts['query'] ) ) {
            // This is to preserve full-stops, pluses and spaces in the query string when ran through parse_str.
            $replace_chars = array(
                '.' => '{dot}',
                '+' => '{plus}',
            );

            $query_string = str_replace( array_keys( $replace_chars ), array_values( $replace_chars ), $url_parts['query'] );

            // Parse the string.
            parse_str( $query_string, $parsed_query_string );

            // Convert the full-stops, pluses and spaces back and add to values array.
            foreach ( $parsed_query_string as $key => $value ) {
                $new_key            = str_replace( array_values( $replace_chars ), array_keys( $replace_chars ), $key );
                $new_value          = str_replace( array_values( $replace_chars ), array_keys( $replace_chars ), $value );
                $values[ $new_key ] = $new_value;
            }
        }
    }
    $html = '';

    foreach ( $values as $key => $value ) {
        if ( in_array( $key, $exclude, true ) ) {
            continue;
        }
        if ( $current_key ) {
            $key = $current_key . '[' . $key . ']';
        }
        if ( is_array( $value ) ) {
            $html .= flrt_query_string_form_fields( $value, $exclude, $key, true );
        } else {
            $html .= '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( wp_unslash( $value ) ) . '" />';
        }
    }

    if ( $return ) {
        return $html;
    }

    echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function flrt_get_query_string_parameters()
{
    $container  = Container::instance();
    $get        = $container->getTheGet();
    $post       = $container->getThePost();

    // For compatibility with some Nginx configurations
    unset($get['q']);

    if( isset( $post['flrt_ajax_link'] ) ){
        $parts = parse_url( $post['flrt_ajax_link'] );
        if( isset( $parts['query'] ) ){
            parse_str( $parts['query'], $output );
            return $output;
        }
    }

    return $get;
}



function flrt_count( $term, $show = 'yes' )
{
    _deprecated_function( 'flrt_count', '1.7.6', 'flrt_filter_count()' );
    flrt_filter_count( $term, $show );
}

if ( ! function_exists( 'flrt_filter_count' ) ){
    function flrt_filter_count( $term, $show = 'yes' )
    {
        if( $show === 'yes' ) :
            echo flrt_filter_get_count( $term );
        endif;
    }
}

/**
 * @since 1.0.5
 * @param $term
 * @return string
 */
function flrt_filter_get_count( $term ){
    return '<span class="wpc-term-count">(<span class="wpc-term-count-value">'.esc_html( $term->cross_count ).'</span>)</span>';
}

if ( ! function_exists( 'flrt_spinner_html' ) ) {
    function flrt_spinner_html()
    {
        return '<div class="wpc-spinner"></div>';
    }
}

function flrt_filters_widget_content_class( $setId )
{
    if ( isset( $_COOKIE[ FLRT_OPEN_CLOSE_BUTTON_COOKIE_NAME ] ) ) {

        if ( $_COOKIE[ FLRT_OPEN_CLOSE_BUTTON_COOKIE_NAME ] === $setId ) {
            return ' wpc-opened';
        }else{
            return ' wpc-closed';
        }
    }
}

function flrt_filters_button( $setId = 0, $class = '' )
{
    /**
     * @feature add nice wrapper to this functions to allow users put it into themes.
     */
    $classes         = [];
    $sets            = [];
    $wpManager       = \FilterEverything\Filter\Container::instance()->getWpManager();
    $templateManager = \FilterEverything\Filter\Container::instance()->getTemplateManager();

    $draft_sets = $wpManager->getQueryVar('wpc_page_related_set_ids');

    foreach ( $draft_sets as $set ){
        if( isset( $set['show_on_the_page'] ) && $set['show_on_the_page'] ){
            $sets[] = $set;
        }
    }

    if( ! $setId && isset( $sets[0]['ID'] ) ){
        $setId = $sets[0]['ID'];
    }

    foreach ( $sets as $set ){
        if( $set['ID'] === $setId ){
            $theSet = $set;
            break;
        }
    }

    if( flrt_get_option('show_bottom_widget') === 'on' ){
        $classes[] = 'wpc-filters-open-widget';
    }else{
        $classes[] = 'wpc-open-close-filters-button';
    }

    if( $class ){
        $classes[] = trim($class);
    }

    $attrClass = implode(" ", $classes);
    $setId = preg_replace('/[^\d]+/', '', $setId);

    $wpc_found_posts = NULL;
    $srch = isset( $_GET['srch'] ) ? filter_input( INPUT_GET, 'srch', FILTER_SANITIZE_SPECIAL_CHARS ) : '';
    $all  = false;
    if ( $srch ) {
        $all = true;
    }

    if( $wpManager->getQueryVar('wpc_is_filter_request' ) || $srch ){
        $wpc_found_posts = flrt_posts_found_quantity( $setId, $all );
    }

    $templateManager->includeFrontView( 'filters-button', array( 'wpc_found_posts' => $wpc_found_posts, 'class' => $attrClass, 'set_id' => $setId ) );
}

function flrt_posts_found( $setid = 0 )
{
    $templateManager = \FilterEverything\Filter\Container::instance()->getTemplateManager();
    $fss             = \FilterEverything\Filter\Container::instance()->getFilterSetService();
    $all             = false;
    if ( isset( $_GET['srch'] ) && $_GET['srch'] ) {
        $all         = true;
    }
    $count           = flrt_posts_found_quantity( $setid, $all );

    $theSet          = $fss->getSet( $setid );
    $postType        = isset( $theSet['post_type']['value'] ) ? $theSet['post_type']['value'] : '';

    $obj             = get_post_type_object($postType);
    $pluralLabel     = isset( $obj->label ) ? apply_filters( 'wpc_label_singular_posts_found_msg', $obj->label ) : esc_html__('items', 'filter-everything');
    $singularLabel   = isset( $obj->labels->singular_name ) ? apply_filters( 'wpc_label_plural_posts_found_msg', $obj->labels->singular_name ) : esc_html__('item', 'filter-everything');

    $templateManager->includeFrontView( 'posts-found', array( 'posts_found_count' => $count, 'singular_label' => $singularLabel, 'plural_label' => $pluralLabel) );
}

function flrt_get_option( $key, $default = false )
{
    $settings = get_option('wpc_filter_settings');

    if( isset( $settings[$key] ) ){
        return apply_filters( 'wpc_get_option', $settings[$key], $key);
    }

    if( $default ){
        return $default;
    }

    return false;

}

function flrt_remove_option($key )
{
    $settings = get_option('wpc_filter_settings');

    if (isset($settings[$key]) && $settings[$key]) {
        unset($settings[$key]);
        return update_option('wpc_filter_settings', $settings);
    }

    return false;
}

function flrt_get_experimental_option($key, $default = false )
{
    /**
     * @todo This should be rewritten
     */
    $settings = get_option('wpc_filter_experimental');

    if( isset( $settings[$key] ) ){
        return apply_filters( 'wpc_get_option', $settings[$key], $key);
    }

    if( $default !== false ){
        return apply_filters( 'wpc_get_option', $default, $key);
    }

    return apply_filters( 'wpc_get_option', false, $key );

}

function flrt_get_status_css_class( $id, $cookieName, $classes = [ 'opened' => 'wpc-opened', 'closed' => 'wpc-closed' ] ){

    if ( isset( $_COOKIE[ $cookieName ] ) ) {
        $openediDs = explode(",", $_COOKIE[ $cookieName ] );

        if ( in_array( $id, $openediDs ) ) {
            return $classes['opened'];
        } elseif ( in_array( -$id, $openediDs ) ) {
            return $classes['closed'];
        } else {
            return '';
        }
    }

    return '';
}

if ( ! function_exists('flrt_filter_header') ) {
    function flrt_filter_header( $filter, $terms )
    {
        $openButton     = ($filter['collapse'] === 'yes') ? '<button><span class="wpc-wrap-icons">' : '';
        $closeButton    = ($filter['collapse'] === 'yes') ? '</span><span class="wpc-open-icon"></span></button>' : '';
        $tooltip        = '';

        if ( $filter['collapse'] === 'yes' && !empty($filter['values']) && !empty($terms) ) {
            $selected = [];
            $list = '<div class="wpc-filter-selected-values">&mdash; ';
            // Does not work for numeric filters
            // @todo
            foreach ( $terms as $id => $term_object ) {

                if ( in_array( $term_object->slug, $filter['values'] ) ) {
                    $selected[] = $term_object->name;
                }
            }

            $list .= implode(", ", $selected) . '</div>';

            $closeButton = $list . $closeButton;
        }

        if ( isset( $filter['tooltip'] ) && $filter['tooltip'] ) {
            $tooltip = flrt_help_tip( $filter['tooltip'], true );
        }

        $filter_label = apply_filters( 'wpc_filter_title', $filter['label'], $filter );

        ?>
        <div class="wpc-filter-header">
            <div class="widget-title wpc-filter-title">
                <?php echo $openButton . esc_html( $filter_label ) . $tooltip . $closeButton;  ?>
            </div>
        </div>
        <?php
    }
}

function flrt_filter_class( $filter, $default_classes = [], $terms = [], $args = [] )
{
    $classes = array(
        'wpc-filters-section',
        'wpc-filters-section-'.esc_attr( $filter['ID'] ),
        'wpc-filter-'.esc_attr( $filter['e_name'] ),
        'wpc-filter-'.esc_attr( $filter['entity'] ),
        'wpc-filter-layout-'.esc_attr( $filter['view'] )
    );

    if ( isset( $filter['values'] ) && ! empty( $filter['values'] ) ) {
        $classes[] = 'wpc-filter-has-selected';
    }

    // Set correct more/less class for specific views
    if ( in_array( $filter['view'], [ 'checkboxes', 'radio', 'labels' ] ) ) {
        if ( isset( $filter['more_less'] ) && $filter['more_less'] === 'yes' ) {

            $classes[] = 'wpc-filter-more-less';

            if ( in_array( $filter['ID'], flrt_more_less_opened() ) ) {
                $classes[] = 'wpc-show-more-reverse';
            }

            $classes[] = flrt_get_status_css_class( $filter['ID'], FLRT_MORELESS_COOKIE_NAME, [ 'opened' => 'wpc-show-more', 'closed' => 'wpc-show-less'] );

            // We have to count only first-level terms if hierarchy is enabled
            if( isset( $filter['hierarchy'] ) && $filter['hierarchy'] === 'yes' ) {
                if ( ! empty( $terms ) ) {
                    $only_parents = [];
                    foreach ( $terms as $term_id => $term ) {
                       if ( $term->parent == 0 ) {
                           $only_parents[ $term_id ] = $term;
                       }
                    }

                    $terms = $only_parents;
                    unset( $only_parents );
                }
            }

            if ( count( $terms ) <= flrt_more_less_count() || $args['hide'] ) {
                $classes[] = 'wpc-filter-few-terms';
            }

        } else {
            $classes[] = 'wpc-filter-full-height';
        }
    }

    if ( isset( $filter['collapse'] ) && $filter['collapse'] === 'yes' ) {
        if ( in_array( $filter['ID'], flrt_folding_opened() ) ) {
            $classes[] = 'wpc-filter-collapsible-reverse';
        }

        $classes[] = 'wpc-filter-collapsible';

        $classes[] = flrt_get_status_css_class( $filter['ID'], FLRT_FOLDING_COOKIE_NAME );
    }

    if ( in_array( $filter['ID'], flrt_hierarchy_opened() ) ) {
        if( isset( $filter['hierarchy'] ) && $filter['hierarchy'] === 'yes' ){
            $classes[] = 'wpc-filter-hierarchy-reverse';
        }
    }

    if ( in_array( $filter['entity'], [ 'post_date', 'post_meta_date' ] ) ) {
        $classes[] = 'wpc-datetype-'.$filter['date_type'];
    }

    if ( ! empty( $default_classes ) ) {
        $classes = array_merge( $classes, $default_classes );
    }

    $classes[] = 'wpc-filter-terms-count-'.count( $terms );
    $classes = apply_filters( 'wpc_filter_classes', $classes, $filter, $default_classes, $terms, $args );

    return implode( " ", $classes );
}

function flrt_filter_content_class( $filter, $default_classes = [] )
{
    $classes = array(
        'wpc-filter-content'
    );

    if( isset( $filter['e_name'] ) ){
        $classes[] = 'wpc-filter-'.$filter['e_name'];
    }

    if( isset( $filter['hierarchy'] ) && $filter['hierarchy'] === 'yes' ){
        $classes[] = 'wpc-filter-has-hierarchy';
    }

    if( ! empty( $default_classes ) ){
        $classes = array_merge( $classes, $default_classes );
    }

    $classes = apply_filters( 'wpc_filter_content_classes', $classes, $default_classes );

    return implode( " ", $classes );

}

if ( ! function_exists( 'flrt_filter_no_terms_message' ) ) {
    /**
     * Outputs "No terms" message
     * @param string  $tag   HTML tag name for the message wrapper
     * @since 1.7.6
     */
    function flrt_filter_no_terms_message( $tag = 'li' ) {
        if ( ! $tag || $tag === '' ) {
            $tag = 'li';
        }

        $srch = isset( $_GET['srch'] ) ? filter_input( INPUT_GET, 'srch', FILTER_SANITIZE_SPECIAL_CHARS ) : '';

        echo '<'.$tag.'>';
            if ( ! flrt_is_filter_request() && ! $srch ) {
                esc_html_e('There are no filter terms yet', 'filter-everything' );
                if( flrt_is_debug_mode() ){
                    echo '&nbsp;'.flrt_help_tip(
                            esc_html__('Possible reasons: 1) Filter\'s criterion doesn\'t contain any terms yet, and you have to add them 2) Terms may be created, but no one post that should be filtered attached to these terms 3) You excluded all possible terms in Filter\'s options.', 'filter-everything')
                        );
                }
            } else {
                esc_html_e('N/A', 'filter-everything' );
            }
        echo '</'.$tag.'>';
    }
}

if ( ! function_exists( 'flrt_filter_more_less' ) ) {
    /**
     * Outputs More/Less toggle link
     * @param array $filter Filter array
     * @since 1.7.6
     */
    function flrt_filter_more_less( $filter ) {
        if ( isset( $filter['more_less'] ) && $filter['more_less'] === 'yes' ): ?>
            <a class="wpc-see-more-control wpc-toggle-a" href="javascript:void(0);" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>"><?php esc_html_e('See more', 'filter-everything' ); ?></a>
            <a class="wpc-see-less-control wpc-toggle-a" href="javascript:void(0);" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>"><?php esc_html_e('See less', 'filter-everything' ); ?></a>
        <?php endif;
    }
}

if ( ! function_exists( 'flrt_filter_search_field' ) ) {
    /**
     * Outputs filter search field
     * @since 1.7.6
     */
    function flrt_filter_search_field( $filter, $view_args, $terms ) {
        if ( empty( $terms ) ) {
            return false;
        }

        if( $filter['search'] === 'yes' && $view_args['ask_to_select_parent'] === false ):  ?>
            <div class="wpc-filter-search-wrapper wpc-filter-search-wrapper-<?php echo esc_attr( $filter['ID'] ); ?>">
                <input class="wpc-filter-search-field" type="text" value="" placeholder="<?php esc_html_e('Search', 'filter-everything' ) ?>" />
                <button class="wpc-search-clear" type="button" title="<?php esc_html_e('Clear search', 'filter-everything' ) ?>"><span class="wpc-search-clear-icon">&#215;</span></button>
            </div>
        <?php endif;
    }
}
function flrt_get_contrast_color($hexColor)
{
    // hexColor RGB
    $R1 = hexdec(substr($hexColor, 1, 2));
    $G1 = hexdec(substr($hexColor, 3, 2));
    $B1 = hexdec(substr($hexColor, 5, 2));

    // Black RGB
    $blackColor = "#000000";
    $R2BlackColor = hexdec(substr($blackColor, 1, 2));
    $G2BlackColor = hexdec(substr($blackColor, 3, 2));
    $B2BlackColor = hexdec(substr($blackColor, 5, 2));

    // Calc contrast ratio
    $L1 = 0.2126 * pow($R1 / 255, 2.2) +
        0.7152 * pow($G1 / 255, 2.2) +
        0.0722 * pow($B1 / 255, 2.2);

    $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
        0.7152 * pow($G2BlackColor / 255, 2.2) +
        0.0722 * pow($B2BlackColor / 255, 2.2);

    $contrastRatio = 0;
    if ($L1 > $L2) {
        $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
    } else {
        $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
    }

    // If contrast is more than 5, return black color

    if ($contrastRatio > 10) {
        return '#333333';
    } else {
        // if not, return white color.
        return '#f5f5f5';
    }
}

function flrt_default_posts_container()
{
    return  apply_filters( 'wpc_theme_posts_container', '#primary' );
}

function flrt_default_theme_color()
{
    return  apply_filters( 'wpc_theme_color', '#0570e2' );
}

function flrt_term_id($name, $filter, $id, $echo = true )
{
    $attr = esc_attr( "wpc-" . $name . "-" . $filter['entity'] . "-" . esc_attr( $filter['e_name'] ) . "-" . $id );
    if( $echo ){
        echo $attr;
    } else {
        return $attr;
    }
}

function flrt_get_icon_svg($color = '#ffffff' )
{
    $svg = '<svg enable-background="new 0 0 26 26" id="Layer_1" version="1.1" viewBox="0 0 26 26" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M1.75,7.75h6.6803589c0.3355713,1.2952271,1.5039063,2.2587891,2.9026489,2.2587891   S13.9000854,9.0452271,14.2356567,7.75H24.25C24.6640625,7.75,25,7.4140625,25,7s-0.3359375-0.75-0.75-0.75H14.2356567   c-0.3355713-1.2952271-1.5039063-2.2587891-2.9026489-2.2587891S8.7659302,4.9547729,8.4303589,6.25H1.75   C1.3359375,6.25,1,6.5859375,1,7S1.3359375,7.75,1.75,7.75z M11.3330078,5.4912109   c0.8320313,0,1.5087891,0.6767578,1.5087891,1.5087891s-0.6767578,1.5087891-1.5087891,1.5087891S9.8242188,7.8320313,9.8242188,7   S10.5009766,5.4912109,11.3330078,5.4912109z" fill="'.$color.'"/><path d="M24.25,12.25h-1.6061401c-0.3355713-1.2952271-1.5039063-2.2587891-2.9026489-2.2587891   S17.1741333,10.9547729,16.838562,12.25H1.75C1.3359375,12.25,1,12.5859375,1,13s0.3359375,0.75,0.75,0.75h15.088562   c0.3355713,1.2952271,1.5039063,2.2587891,2.9026489,2.2587891s2.5670776-0.963562,2.9026489-2.2587891H24.25   c0.4140625,0,0.75-0.3359375,0.75-0.75S24.6640625,12.25,24.25,12.25z M19.7412109,14.5087891   c-0.8320313,0-1.5087891-0.6767578-1.5087891-1.5087891s0.6767578-1.5087891,1.5087891-1.5087891S21.25,12.1679688,21.25,13   S20.5732422,14.5087891,19.7412109,14.5087891z" fill="'.$color.'"/><path d="M24.25,18.25H9.7181396c-0.3355103-1.2952271-1.5037842-2.2587891-2.9017334-2.2587891   c-1.3987427,0-2.5670776,0.963562-2.9026489,2.2587891H1.75C1.3359375,18.25,1,18.5859375,1,19s0.3359375,0.75,0.75,0.75h2.1637573   c0.3355713,1.2952271,1.5039063,2.2587891,2.9026489,2.2587891c1.3979492,0,2.5662231-0.963562,2.9017334-2.2587891H24.25   c0.4140625,0,0.75-0.3359375,0.75-0.75S24.6640625,18.25,24.25,18.25z M6.8164063,20.5087891   c-0.8320313,0-1.5087891-0.6767578-1.5087891-1.5087891s0.6767578-1.5087891,1.5087891-1.5087891   c0.8310547,0,1.5078125,0.6767578,1.5078125,1.5087891S7.6474609,20.5087891,6.8164063,20.5087891z" fill="'.$color.'"/></g></svg>';

    return 'data:image/svg+xml;base64,' . base64_encode( $svg );

}

function flrt_get_icon_html()
{
    ?>
<span class="wpc-icon-html-wrapper">
    <span class="wpc-icon-line-1"></span>
    <span class="wpc-icon-line-2"></span>
    <span class="wpc-icon-line-3"></span>
</span>
    <?php
}

function flrt_get_plugin_name()
{
    if( defined('FLRT_FILTERS_PRO')){
        return esc_html__( 'Filter Everything Pro', 'filter-everything' );
    }else{
        return esc_html__( 'Filter Everything', 'filter-everything' );
    }
}

function flrt_get_plugin_url($type = 'about', $full = false )
{
    if( $full ){
        return esc_url($full);
    }

    return esc_url(FLRT_PLUGIN_URL . '/' . $type );
}

function flrt_get_term_by_slug($prefix ){
    global $wpdb;

    $sql    = "SELECT {$wpdb->terms}.slug FROM {$wpdb->terms} WHERE {$wpdb->terms}.slug = '%s'";
    $sql    = $wpdb->prepare( $sql, $prefix );
    $result = $wpdb->get_row( $sql );

    if( isset($result->slug) && $result->slug ){
        return $result->slug;
    }

    return false;
}

function flrt_walk_terms_tree( $terms, $args  ) {
    _deprecated_function( 'flrt_walk_terms_tree', '1.7.6', 'flrt_filter_walk_terms_tree()' );
    flrt_filter_walk_terms_tree( $terms, $args );
}

function flrt_filter_walk_terms_tree( $terms, $args ) {
    $walker = new \FilterEverything\Filter\WalkerCheckbox();

    $depth = -1;
    if ( isset( $args['filter']['hierarchy'] ) && $args['filter']['hierarchy'] === 'yes' ) {
        $depth = 10;
    }

    return $walker->walk( $terms, $depth, $args );
}

function flrt_get_all_parents($elements, $parent_id, &$ids ){
    if( isset( $elements[$parent_id]->parent ) && $elements[$parent_id]->parent > 0 ){
        $id = $elements[$parent_id]->parent;
        $ids_flipped = array_flip($ids);

        if( ! isset( $ids_flipped[$id] ) ){
            $ids[] = $id;
        }

        flrt_get_all_parents( $elements, $id, $ids );
    }else{
        return $ids;
    }
}

function flrt_get_parents_with_not_empty_children($elements, $key = 'cross_count' ){
    $has_posts_in_children = [];

    if( empty( $elements ) || ! is_array( $elements ) ){
        return $has_posts_in_children;
    }

    $new_elements = [];

    foreach ( $elements as $k => $e ) {
        $new_elements[$e->term_id] = $e;
    }

    $has_posts_in_children_flipped = array_flip( $has_posts_in_children );

    foreach ( $new_elements as $e ) {
        if ( isset( $e->parent ) && ! empty( $e->parent ) && $e->$key > 0 ) {
            // Find all parents for term that contains posts
            if( ! isset( $has_posts_in_children_flipped[ $e->parent ] ) ){
                $has_posts_in_children[] = $e->parent;
            }

            flrt_get_all_parents( $new_elements, $e->parent, $has_posts_in_children );
        }
    }

    return $has_posts_in_children;
}

/**
 * Combines all filter sets for the same WP_Query
 *
 * @param array $all_sets - list of all page related sets
 * @param $current_set
 * @return array $queryRelatedSets IDs of all query related sets
 */
function flrt_get_sets_with_the_same_query( $all_sets, $current_set ){
    $queryRelatedSets = [];
    // First detect desired query index;
    $query      = '';
    $post_type  = '';
    $location   = '';
    $set_id     = $current_set['ID'];

    foreach( $all_sets as $set ){
        if( $set['ID'] === $set_id ){
            // Current Set values
            $query      = $set['query'];
            $post_type  = $set['filtered_post_type'];
            $location   = $set['query_location'];
            break;
        }
    }

    // Then find all sets with such query
    foreach( $all_sets as $set ){
        if( $set['query'] === $query && $post_type === $set['filtered_post_type'] && $location === $set['query_location'] ){
            $queryRelatedSets[] = $set['ID'];
        }
    }

    if( empty( $queryRelatedSets ) ){
        $queryRelatedSets[] = $set_id;
    }

    return $queryRelatedSets;
}

function flrt_find_all_descendants($arr) {
    $all_results = [];

    if( empty( $arr ) || ! is_array( $arr ) ){
        return $all_results;
    }

    foreach ($arr as $k => $v) {
        $curr_result = [];

        for ($stack = [$k]; count($stack);) {
            $el = array_pop($stack);

            if (array_key_exists($el, $arr) && is_array($arr[$el])) {
                foreach ($arr[$el] as $child) {
                    $curr_result []= $child;
                    $stack []= $child;
                }
            }
        }

        if (count($curr_result)) {
            $all_results[$k] = $curr_result;
        }
    }

    return $all_results;
}

function flrt_debug_title(){

    echo '<div class="wpc-debug-title">'.esc_html__('Filter Everything debug', 'filter-everything');
    echo  '&nbsp;'.flrt_help_tip(
            sprintf(
                __('Debug messages are visible for logged in administrators only. You can disable them in Filters -> <a href="%s">Settings</a> -> Debug mode.', 'filter-everything'),
                admin_url( 'edit.php?post_type=filter-set&page=filters-settings' )
            ), true ).'</div>';
}

function flrt_is_debug_mode(){
    $debug_mode = false;
    if( flrt_get_option( 'widget_debug_messages' ) === 'on' ) {
        if( current_user_can( flrt_plugin_user_caps() ) ){
            $debug_mode = true;
        }
    }

    return $debug_mode;
}

function flrt_clean( $var ) {
    if ( is_array( $var ) ) {
        return array_map( 'flrt_clean', $var );
    } else {
        return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
    }
}

function flrt_sorting_option_value(  $order_by_value, $meta_keys, $orders, $i ){
    $meta_key     = isset( $meta_keys[$i] ) ? $meta_keys[$i] : '';
    $order        = isset( $orders[$i] ) ? $orders[$i] : '';

    $option_value = $order_by_value;

    if( in_array( $order_by_value, ['m', 'n'], true ) ){
        $option_value .= $meta_key;
    }

    $option_value .= ( $order === 'desc' ) ? '-'.$order : '';

    return $option_value;
}

function flrt_get_active_plugins(){

    if( is_multisite() ){
        $active_plugins = get_site_option('active_sitewide_plugins');
        if( is_array( $active_plugins ) ){
            $active_plugins = array_keys( $active_plugins );
        }

        $site_active_plugins = apply_filters( 'active_plugins', get_option('active_plugins') );
        $active_plugins      = array_merge( $active_plugins, $site_active_plugins );
    }else{
        $active_plugins = apply_filters( 'active_plugins', get_option('active_plugins') );
    }

    return $active_plugins;
}

function flrt_get_terms_transient_key( $salt, $include_lang = true ){
    $key = 'wpc_terms_' . $salt;
    if ( flrt_wpml_active() && defined( 'ICL_LANGUAGE_CODE' ) && $include_lang ) {
        $key .= '_'.ICL_LANGUAGE_CODE;
    }

    if( function_exists('pll_current_language') && $include_lang ){
        $pll_lang = pll_current_language();
        if( $pll_lang ){
            $key .= '_'.$pll_lang;
        }
    }

    return $key;
}

function flrt_get_post_ids_transient_key( $salt ){
    $key = 'wpc_posts_' . $salt;
    if (flrt_wpml_active() && defined('ICL_LANGUAGE_CODE')) {
        $key .= '_'.ICL_LANGUAGE_CODE;
    }

    if( function_exists('pll_current_language') ){
        $pll_lang = pll_current_language();
        if( $pll_lang ){
            $key .= '_'.$pll_lang;
        }
    }

    return $key;
}

function flrt_get_variations_transient_key( $salt ){
    $key = 'wpc_variations_' . $salt;
    if (flrt_wpml_active() && defined('ICL_LANGUAGE_CODE')) {
        $key .= '_'.ICL_LANGUAGE_CODE;
    }

    if( function_exists('pll_current_language') ){
        $pll_lang = pll_current_language();
        if( $pll_lang ){
            $key .= '_'.$pll_lang;
        }
    }

    return $key;
}

function flrt_is_query_on_page( $setPosts, $searchKey ){
    $sets = [];
    if( ! is_array( $setPosts ) ){
        return $sets;
    }

    foreach ( $setPosts as $set ){

        $parameters = maybe_unserialize( $set->post_content );
        $query      = isset( $parameters['wp_filter_query'] ) ? $parameters['wp_filter_query']: '-1';

        if( isset( $parameters['use_apply_button'] ) && $parameters['use_apply_button'] === 'yes' ){

            $query_on_the_page = false;
            $show_on_the_page  = false;

            if( defined('FLRT_FILTERS_PRO') && FLRT_FILTERS_PRO ) {
                if ( isset( $parameters['apply_button_post_name'] ) ){

                    if( $parameters['apply_button_post_name'] === $set->post_name ||
                        $parameters['apply_button_post_name'] === 'no_page___no_page' ){
                        $query_on_the_page = true;
                    }

                    if( in_array( $parameters['apply_button_post_name'], $searchKey ) || ( $parameters['apply_button_post_name'] === 'no_page___no_page' ) ){
                        $show_on_the_page = true;
                    }
                }

            }else{
                $query_on_the_page = true;
                $show_on_the_page  = true;
            }

            $sets[] = array(
                'ID'                 => (string) $set->ID,
                'filtered_post_type' => $set->post_excerpt,
                'query'              => $query, // query hash
                'query_location'     => $set->post_name,
                'query_on_the_page'  => $query_on_the_page,
                'page_search_keys'   => $searchKey,
                'show_on_the_page'   => $show_on_the_page
            );

        }else{
            if( in_array( $set->post_name, $searchKey ) ){
                $sets[] = array(
                    'ID'                 => (string) $set->ID,
                    'filtered_post_type' => $set->post_excerpt,
                    'query'              => $query, // query hash
                    'query_location'     => $set->post_name,
                    'query_on_the_page'  => true,
                    'page_search_keys'   => $searchKey,
                    'show_on_the_page'   => true
                );
            }else{
                // This set is for another page and was selected by Apply button location but the button disabled
                continue;
            }
        }

    }

    return $sets;
}

function flrt_remove_empty_terms( $checkTerms, $filter, $has_not_empty_children_flipped = [] ){

    foreach ($checkTerms as $index => $term) {
        if( $filter['hierarchy'] === 'yes' ){

            if(  $term->cross_count === 0
                && ! isset( $has_not_empty_children_flipped[$term->term_id] ) ){
                unset($checkTerms[$index]);
            }

        }else{
            if( $term->cross_count === 0 ){
                unset($checkTerms[$index]);
            }
        }
    }

    return $checkTerms;
}

function flrt_get_wp_queried_term($terms ){
    $wp_queried_terms = false;

    foreach ( $terms as $term ) {
        if ( $term->wp_queried === true ){
            $wp_queried_terms = $term;
            break;
        }
    }

    return $wp_queried_terms;
}

function flrt_get_filter_terms( $filter, $posType, $em = false ) {
    if( ! $em ){
        $em = Container::instance()->getEntityManager();
    }

    $entityObj  = $em->getEntityByFilter( $filter, $posType );
    // Exclude or include terms
    $isInclude = ( isset( $filter['include'] ) && $filter['include'] === 'yes' );
    $entityObj->setExcludedTerms( $filter['exclude'], $isInclude );

    $terms = $entityObj->getTerms();

    return apply_filters( 'wpc_items_after_calc_term_count', $terms );
}

function flrt_get_term_brand_image( $term_id, $filter ) {
    $src = false;

    if ( $filter['e_name'] === 'pwb-brand' ) {
        $attachment_id = get_term_meta($term_id, 'pwb_brand_image', true);
        $attachment_props = wp_get_attachment_image_src($attachment_id, 'small');
        $src = isset($attachment_props[0]) ? $attachment_props[0] : false;
    } elseif ( $filter['e_name'] === 'yith_product_brand' ) {
        $attachment_id = get_term_meta($term_id, 'thumbnail_id', true);
        $attachment_props = wp_get_attachment_image_src($attachment_id, 'small');
        $src = isset($attachment_props[0]) ? $attachment_props[0] : false;
    } else {
        // pa_brand
        $src = get_term_meta( $term_id, 'image', true );

        if( intval( $src ) > 0 ){
            $src = wp_get_attachment_image_url( $src,'full' );
        }

        if ( isset( $src['id'] ) && $src['id'] ) {
            $src = wp_get_attachment_image_url( $src['id'],'full' );
        }
    }

    return $src;
}

function flrt_get_term_swatch_image( $term_id, $filter ) {
    $src = false;
    $image_key = 'image';

    if ( strpos( $filter['e_name'], 'pa_' ) === 0 ) {
        $image_key = 'product_attribute_' . $image_key;
    }

    if ( $filter['e_name'] === 'product_cat' ) {
        $image_key = 'thumbnail_id';
    }

    $image_key = apply_filters( 'wpc_image_term_meta_key', $image_key, $filter );

    $image_id = get_term_meta( $term_id, $image_key, true );
    if ( $image_id ) {
        $src = wp_get_attachment_image_url( $image_id, 'thumbnail' );
    }

    return $src;
}

function flrt_get_term_swatch_color( $term_id, $filter ) {
    $color     = false;
    $color_key = 'color';

    if ( strpos( $filter['e_name'], 'pa_' ) === 0 ) {
        $color_key = 'product_attribute_' . $color_key;
    }

    $color_key = apply_filters( 'wpc_color_term_meta_key', $color_key, $filter );
    $color = get_term_meta( $term_id, $color_key, true );

    return $color;
}

/**
 * Checks and returns date format.
 * Does not check if date is valid
 * @param $date
 * @return string|false date, time format or false
 */
function flrt_detect_date_type( $date_or_time )
{
    if ( ! $date_or_time ) {
        return false;
    }
    $format = false;
    $date   = false;
    $time   = false;

    $date_or_time = str_replace( FLRT_DATE_TIME_SEPARATOR, ' ', $date_or_time );

    $pcs = date_parse( $date_or_time );
    if ( $pcs['year'] !== false && $pcs['month'] !== false && $pcs['day'] !== false ) {
        $date = true;
    }

    if ( $pcs['hour'] !== false && $pcs['minute'] !== false && $pcs['second'] !== false ) {
        $time = true;
    }

    if ( $date && $time ) {
        $format = 'datetime';
    } else {
        if ( $date ) {
            $format = 'date';
        }
        if ( $time ) {
            $format = 'time';
        }
    }

    return $format;
}

/**
 * Modifies datetime to the human format
 * @param $datetime
 * @param $date_type
 * @param string $sep
 * @return mixed|string
 */
function flrt_clean_date_time( $datetime, $date_type, $sep = " " )
{
    if ( $date_type === 'date' ) {
        $pieces = explode( $sep, $datetime );
        return $pieces[0]; //date e.g. 2021-05-14
    } else if ( $date_type === 'time' ) {
        $pieces = explode( $sep, $datetime );
        if ( isset( $pieces[1] ) ) {
            return $pieces[1]; //time e.g. 14:15:47
        }
    } else {
        return $datetime; // str_replace( $sep, ' ', $datetime ); //datetime e.g. 2021-05-14 14:15:47
    }
}

function flrt_apply_date_format( $income_date, $format = "Y-m-d H:i:s" )
{
    $timestamp = strtotime( $income_date );
    return flrt_date( $format, $timestamp );
}

function flrt_date( $format, $timestamp = null ) {
    global $wp_locale;

    if ( null === $timestamp ) {
        $timestamp = time();
    } elseif ( ! is_numeric( $timestamp ) ) {
        return false;
    }

    $datetime = date_create( '@' . $timestamp );

    if ( empty( $wp_locale->month ) || empty( $wp_locale->weekday ) ) {
        $date = $datetime->format( $format );
    } else {
        // We need to unpack shorthand `r` format because it has parts that might be localized.
        $format = preg_replace( '/(?<!\\\\)r/', DATE_RFC2822, $format );

        $new_format    = '';
        $format_length = strlen( $format );
        $month         = $wp_locale->get_month( $datetime->format( 'm' ) );
        $weekday       = $wp_locale->get_weekday( $datetime->format( 'w' ) );

        for ( $i = 0; $i < $format_length; $i++ ) {
            switch ( $format[ $i ] ) {
                case 'D':
                    $new_format .= addcslashes( $wp_locale->get_weekday_abbrev( $weekday ), '\\A..Za..z' );
                    break;
                case 'F':
                    $new_format .= addcslashes( $month, '\\A..Za..z' );
                    break;
                case 'l':
                    $new_format .= addcslashes( $weekday, '\\A..Za..z' );
                    break;
                case 'M':
                    $new_format .= addcslashes( $wp_locale->get_month_abbrev( $month ), '\\A..Za..z' );
                    break;
                case 'a':
                    $new_format .= addcslashes( $wp_locale->get_meridiem( $datetime->format( 'a' ) ), '\\A..Za..z' );
                    break;
                case 'A':
                    $new_format .= addcslashes( $wp_locale->get_meridiem( $datetime->format( 'A' ) ), '\\A..Za..z' );
                    break;
                case '\\':
                    $new_format .= $format[ $i ];

                    // If character follows a slash, we add it without translating.
                    if ( $i < $format_length ) {
                        $new_format .= $format[ ++$i ];
                    }
                    break;
                default:
                    $new_format .= $format[ $i ];
                    break;
            }
        }

        $date = date_format( $datetime, $new_format );
    }

    return $date;
}

function flrt_default_date_format( $date_type = 'date' )
{
    /**
     * @todo date format depend from localization and geo settings
     * we have to relate them here
     */
    $date_format = __('F j, Y');

    switch ( $date_type ) {
        case 'date':
            $date_format = __('F j, Y'); //'d-m-Y';
            break;
        case 'datetime':
            $date_format = __('F j, Y g:i a'); //'d-m-Y H:i:s';
            break;
        case 'time':
            $date_format = __('g:i a'); // 'H:i:s';
            break;
    }

    return $date_format;
}

function flrt_convert_date_to_js( $date_or_time ){
    $date_php_to_js = Container::instance()->getParam('php_to_js_date_formats');
    return flrt_str_replace( $date_or_time, $date_php_to_js );
}

function flrt_convert_time_to_js( $date_or_time ){
    $time_php_to_js = Container::instance()->getParam('php_to_js_time_formats');
    return flrt_str_replace( $date_or_time, $time_php_to_js );
}

function flrt_str_replace( $string = '', $search_replace = array() ) {
    $ignore = array();
    unset( $search_replace[''] );

    foreach ( $search_replace as $search => $replace ) {
        if ( in_array( $search, $ignore ) ) {
            continue;
        }
        if ( strpos( $string, $search ) === false ) {
            continue;
        }
        $string = str_replace( $search, $replace, $string );
        $ignore[] = $replace;
    }

    return $string;
}

function flrt_split_date_time( $date_time = '' ) {
    $php_date = Container::instance()->getParam('php_to_js_date_formats');
    $php_time = Container::instance()->getParam('php_to_js_time_formats');
    $chars    = str_split( $date_time );
    $type     = 'date';

    $data = array(
        'date' => '',
        'time' => '',
    );

    foreach ( $chars as $i => $c ) {
        if ( isset( $php_date[ $c ] ) ) {
            $type = 'date';
        } elseif ( isset( $php_time[ $c ] ) ) {
            $type = 'time';
        }
        $data[ $type ] .= $c;
    }

    $data['date'] = trim( $data['date'] );
    $data['time'] = trim( $data['time'] );

    return $data;
}

function flrt_string_polyfill( $string ) {
    $str = preg_replace('/\x00|<[^>]*>?/', '', $string );
    return str_replace( ["'", '"'], ['&#39;', '&#34;'], $str );
}