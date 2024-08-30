<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

use \FilterEverything\Filter\PostDateEntity;

// Make post type name lowercase in posts found message
add_filter( 'wpc_label_singular_posts_found_msg', 'mb_strtolower' );
add_filter( 'wpc_label_plural_posts_found_msg', 'mb_strtolower' );

add_action( 'init', 'flrt_initiate_overridden_functions' );
function flrt_initiate_overridden_functions()
{
// All hooks with function wrapper with function_exists()
    add_filter('wpc_filter_post_meta_num_term_name', 'flrt_ucfirst_term_slug_name');
    add_filter('wpc_filter_post_meta_term_name', 'flrt_ucfirst_term_slug_name');
    add_filter('wpc_filter_tax_numeric_term_name', 'flrt_ucfirst_term_slug_name');
    add_filter('wpc_filter_post_meta_exists_term_name', 'flrt_custom_field_exists_name');
    add_filter('wpc_filter_post_meta_term_name', 'flrt_stock_status_term_name', 10, 2);
    add_filter('wpc_filter_post_meta_exists_term_name', 'flrt_on_sale_term_name', 15, 2);
    add_filter('wpc_filter_taxonomy_term_name', 'flrt_modify_taxonomy_term_name', 10, 2);
    add_filter('wpc_filter_term_query_args', 'flrt_exclude_uncategorized_category', 10, 3);
    add_filter('wpc_filter_get_taxonomy_terms', 'flrt_exclude_product_visibility_terms', 10, 2);
    add_filter('wpc_filter_author_query_post_types', 'flrt_remove_author_query_post_types');
    add_filter('wpc_filter_post_types', 'flrt_exclude_post_types');
    add_action('wpc_after_filter_input', 'flrt_after_filter_input');
    add_filter('wpc_filters_checkbox_term_html', 'wpc_term_brand_logo', 5, 4);
    add_filter('wpc_filters_radio_term_html', 'wpc_term_brand_logo', 5, 4);
    add_filter('wpc_filters_label_term_html', 'wpc_term_brand_logo', 5, 4);
    add_filter('wpc_taxonomy_location_terms', 'flrt_remove_default_category_location', 10, 2);

    if (!function_exists('flrt_ucfirst_term_slug_name')) {
        function flrt_ucfirst_term_slug_name($term_name)
        {
            $term_name = flrt_ucfirst($term_name);
            return $term_name;
        }
    }


    if (!function_exists('flrt_custom_field_exists_name')) {
        function flrt_custom_field_exists_name($term_name)
        {
            if ($term_name === 'yes') {
                return esc_html__('Yes', 'filter-everything');
            } else if ($term_name === 'no') {
                return esc_html__('No', 'filter-everything');
            }
            return $term_name;
        }
    }

    if (!function_exists('flrt_stock_status_term_name')) {
        function flrt_stock_status_term_name($term_name, $e_name)
        {
            if ($e_name === '_stock_status') {
                $term_name = strtolower($term_name);
                if ($term_name === "instock") {
                    $term_name = esc_html__('In stock', 'filter-everything');
                }

                if ($term_name === "onbackorder") {
                    $term_name = esc_html__('On backorder', 'filter-everything');
                }

                if ($term_name === "outofstock") {
                    $term_name = esc_html__('Out of stock', 'filter-everything');
                }
            }

            return $term_name;
        }
    }

    if (!function_exists('flrt_on_sale_term_name')) {
        function flrt_on_sale_term_name($term_name, $entity)
        {
            if ($entity === '_sale_price') {
                $check_name = mb_strtolower($term_name);

                if (in_array($check_name, ['yes', 'ja', 'ano', 'sí', 'так'])) {
                    $term_name = esc_html__('On Sale', 'filter-everything');
                }
                if (in_array($check_name, ['no', 'nein', 'ne', 'ні'])) {
                    $term_name = esc_html__('Regular price', 'filter-everything');
                }
            }
            return $term_name;
        }
    }


    if (!function_exists('flrt_modify_taxonomy_term_name')) {
        function flrt_modify_taxonomy_term_name($term_name, $e_name)
        {
            if (in_array($e_name, array('product_type', 'product_visibility'))) {
                $term_name = flrt_ucfirst($term_name);
            }
            return $term_name;
        }
    }


    if (!function_exists('flrt_exclude_uncategorized_category')) {
        function flrt_exclude_uncategorized_category($args, $entity, $e_name)
        {
            if ($e_name === 'category') {
                $args['exclude'] = array(1); // Uncategorized category
            }

            return $args;
        }
    }


    if (!function_exists('flrt_exclude_product_visibility_terms')) {
        function flrt_exclude_product_visibility_terms($terms, $e_name)
        {
            if ($e_name === 'product_visibility') {
                if (is_array($terms)) {
                    foreach ($terms as $index => $term) {

                        if (in_array($term->slug, array('exclude-from-search', 'exclude-from-catalog'))) {
                            unset($terms[$index]);
                        }
                    }
                }
            }

            if ($e_name === 'product_cat') {
                if (is_array($terms)) {
                    foreach ($terms as $index => $term) {
                        if (in_array($term->slug, array('uncategorized'))) {
                            unset($terms[$index]);
                        }
                    }
                }
            }

            return $terms;
        }
    }

    if (!function_exists('flrt_remove_author_query_post_types')) {
        function flrt_remove_author_query_post_types($post_types)
        {
            if (isset($post_types['attachment'])) {
                unset($post_types['attachment']);
            }
            return $post_types;
        }
    }

    if (!function_exists('flrt_exclude_post_types')) {
        function flrt_exclude_post_types($post_types)
        {

            $post_types = array(
                FLRT_FILTERS_POST_TYPE,
                FLRT_FILTERS_SET_POST_TYPE,
                'attachment',
                'elementor_library',
                'e-landing-page',
                'jet-smart-filters',
                'ct_template'
            );

            return $post_types;
        }
    }


    if (!function_exists('flrt_after_filter_input')) {
        function flrt_after_filter_input($attributes)
        {
            if (isset($attributes['class']) && $attributes['class'] === 'wpc-field-slug' && $attributes['value'] === '') {
                echo '<p class="description">' . esc_html__('a-z, 0-9, "_" and "-" symbols supported only', 'filter-everything') . '</p>';
            }

            if (isset($attributes['class']) && $attributes['class'] === 'wpc-field-ename' && $attributes['value'] === '') {
                echo '<p class="description">' . esc_html__('Note: for ACF meta fields, please use names without the "_" character at the beginning', 'filter-everything') . '</p>';
            }

        }
    }

    if (!function_exists('wpc_term_brand_logo')) {
        function wpc_term_brand_logo($html, $link_attributes, $term, $filter)
        {
            if (!in_array($filter['e_name'], flrt_brand_filter_entities())) {
                return $html;
            }
            if (!isset($term->slug)) {
                return $html;
            }
            $src = flrt_get_term_brand_image($term->term_id, $filter);

            $link_attributes .= ' title="' . $term->name . '"';
            if ($src) {
                $img = '<span class="wpc-term-image-wrapper"><img src="' . $src . '" alt="' . $term->name . '" /></span>';
                $html = '<a ' . $link_attributes . '>' . $img . ' <span class="wpc-term-name">' . $term->name . '</span></a>';
            }

            return $html;
        }
    }

    if( !function_exists( 'flrt_remove_default_category_location' ) ) {
        function flrt_remove_default_category_location( $terms, $taxonomy ){
            $default_category = 0;

            if ( $taxonomy === 'product_cat' ) {
                $default_category = get_option( 'default_product_cat' );
            } elseif( $taxonomy === 'category' ) {
                $default_category = get_option('default_category');
            }

            // Remove default category from the list
            if ( $default_category > 0 ) {
                unset( $terms[ $default_category ] );
            }

            return $terms;
        }
    }
}

function flrt_chips( $showReset = false, $setIds = [] ) {
    $templateManager    = \FilterEverything\Filter\Container::instance()->getTemplateManager();
    $wpManager          = \FilterEverything\Filter\Container::instance()->getWpManager();

    if( empty( $setIds ) || ! $setIds || ! is_array( $setIds ) ){
        foreach ( $wpManager->getQueryVar('wpc_page_related_set_ids') as $set ){
            $setIds[] = $set['ID'];
        }
    }

    $chipsObj = new \FilterEverything\Filter\Chips( $showReset, $setIds );
    $chips = $chipsObj->getChips();

    $templateManager->includeFrontView( 'chips', array( 'chips' => $chips, 'setid' => reset($setIds) ) );

}

function flrt_show_selected_terms( $showReset = true, $setIds = [], $class = [] )
{
    $default_class  = array('wpc-custom-selected-terms');

    if(! empty( $class ) && is_array($class) ){
        $default_class = array_merge( $default_class, $class );
    }

    echo '<div class="'.implode(' ', $default_class).'">'."\r\n";
        flrt_chips( $showReset, $setIds );
    echo '</div>'."\r\n";
}

add_filter( 'wpc_dropdown_option_attr', 'flrt_parse_dropdown_value' );
function flrt_parse_dropdown_value( $attr ){
    if( ! is_array( $attr ) ){
        $new_attr = array();
        $new_attr['label'] = $attr;
        return $new_attr;
    }

    return $attr;
}

add_filter( 'wpc_unnecessary_get_parameters', 'flrt_unnecessary_get_parameters' );
function flrt_unnecessary_get_parameters( $params ){
    $unnecessary_params = array(
        'product-page' => true,
        '_pjax' => true,
    );

    return array_merge( $params, $unnecessary_params );
}

add_filter('wpc_posts_containers', 'flrt_convert_posts_container_to_array');
function flrt_convert_posts_container_to_array( $container ){

    if( ! is_array( $container ) ){
        return [ 'default' => trim($container) ];
    }

    return $container;
}

add_filter( 'wpc_seo_title', 'do_shortcode' );
add_filter( 'wpc_seo_description', 'do_shortcode' );
add_filter( 'wpc_seo_h1', 'do_shortcode' );

/**
 * @return int
 * @since 1.7.1
 */
function flrt_more_less_count() {
    return apply_filters( 'wpc_more_less_count', 5 );
}
/**
 * @return mixed|void
 * @since 1.7.1
 */
function flrt_more_less_opened() {
    return apply_filters( 'wpc_more_less_opened', [] );
}
/**
 * @return mixed|void
 * @since 1.7.1
 */
function flrt_folding_opened() {
    return apply_filters( 'wpc_folding_opened', [] );
}
/**
 * @return mixed|void
 * @since 1.7.1
 */
function flrt_hierarchy_opened() {
    return apply_filters( 'wpc_hierarchy_opened', [] );
}
/**
 * @param $filter
 * @return mixed|void
 * @since 1.7.1
 */
function flrt_dropdown_default_option( $filter ) {
    $label = sprintf( __( '- Select %s -', 'filter-everything' ),  $filter['label'] );
    if( isset( $filter['dropdown_label'] ) && $filter['dropdown_label'] ){
        $label = $filter['dropdown_label'];
    }
    return apply_filters( 'wpc_dropdown_default_option', $label, $filter );
}

function flrt_brand_filter_entities(){
    return apply_filters( 'wpc_brand_filter_entities', ['pa_brand', 'pwb-brand', 'yith_product_brand'] );
}

add_filter( 'wpc_filter_classes', 'wpc_frontend_filter_classes', 10, 2 );
function wpc_frontend_filter_classes( $classes, $filter ){
    if( in_array( $filter['e_name'], flrt_brand_filter_entities() ) ) {
        $classes[] = 'wpc-filter-has-brands';
    }

    return $classes;
}

add_filter( 'wpc_filter_classes', 'flrt_frontend_filter_classes', 10, 2 );
function flrt_frontend_filter_classes( $classes, $filter ){
    if ( $filter['show_term_names'] === 'yes' ) {
        $classes[] = 'wpc-filter-visible-term-names';
    } else {
        $classes[] = 'wpc-filter-hidden-term-names';
    }

    return $classes;
}

// Bricks Builder fix for Any Category Filter Set
add_action( 'wpc_all_set_wp_queried_posts', 'flrt_bricks_builder_category_compat', 10, 2 );
function flrt_bricks_builder_category_compat( $set_wp_query, $setId ){

    //to check if there is Bricks Builder
    if ( defined( 'BRICKS_VERSION' ) && BRICKS_VERSION ) {
        $filterSet  = \FilterEverything\Filter\Container::instance()->getFilterSetService();
        $the_set    = $filterSet->getSet( $setId );

        if ( isset( $the_set['wp_page_type']['value'] ) && isset( $the_set['post_name']['value'] ) ){
            if ( strpos( $the_set['wp_page_type']['value'], 'taxonomy_' ) !== false ) {
                if ( strpos( $the_set['post_name']['value'], '-1' ) !== false ) {
                    $queried_object = get_queried_object();
                    if ( property_exists( $queried_object, 'taxonomy' ) ){
                        $set_wp_query->set( $queried_object->taxonomy, $queried_object->slug );
                    }
                }
            }
        }
    }

    return $set_wp_query;
}

add_filter( 'wpc_chips_term_name', 'flrt_chips_labels', 10, 3 );
function flrt_chips_labels( $term_name, $term, $filter ) {
    if ( in_array( $filter['entity'], ['post_meta_num', 'tax_numeric', 'post_date'] ) ) {
        // 'min_num_label'
        // 'max_num_label'

        if( $filter['min_num_label'] !== '' ){
            if( ! is_null( $term ) && property_exists( $term, 'slug' ) && in_array( $term->slug, ['min', 'from'] ) ){
                if( strpos( $filter['min_num_label'], '{value}' ) !== false ){
                    $term_name = str_replace( '{value}', $filter['values'][$term->slug], $filter['min_num_label'] );
                }else {
                    $term_name = $filter['min_num_label'] .' '.$filter['values'][$term->slug];
                }

            }
        }

        if( $filter['max_num_label'] !== '' ){
            if( ! is_null( $term ) && property_exists( $term, 'slug' ) && in_array( $term->slug, ['max', 'to'] ) ){
                if( strpos( $filter['max_num_label'], '{value}' ) !== false ){
                    $term_name = str_replace( '{value}', $filter['values'][$term->slug], $filter['max_num_label'] );
                }else {
                    $term_name = $filter['max_num_label'] .' '.$filter['values'][$term->slug];
                }
            }
        }

    }

    return $term_name;
}