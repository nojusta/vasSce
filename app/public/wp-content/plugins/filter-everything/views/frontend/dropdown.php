<?php
/**
 * The Template for displaying filter dropdown.
 *
 * This template can be overridden by copying it to yourtheme/filters/dropdown.php.
 *
 * $set - array, with the Filter Set parameters
 * $filter - array, with the Filter parameters
 * $url_manager - object, of the UrlManager PHP class
 * $terms - array, with objects of all filter terms except excluded
 * $noSelectUrl - string, URL for default option without selected term
 *
 * @see https://filtereverything.pro/resources/templates-overriding/
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

$noSelectUrl    = ( empty( $filter['values'] ) ) ? $url_manager->getResetUrl() : $url_manager->getTermUrl( reset( $filter['values'] ), $filter['e_name'], $filter['entity'] );
$show_term_name = true;
$is_swatch      = false;
$is_brand       = ( in_array( $filter['e_name'], flrt_brand_filter_entities() ) );
$use_select2    = false;
$data_default   = '';
$preload_html   = '';
$data_color     = '';

if ( flrt_get_experimental_option( 'select2_dropdowns' ) === 'on' ){
    $use_select2 = true;
}

if ( flrt_get_experimental_option('use_color_swatches') === 'on' ) {
    $swatch_taxes   = flrt_get_experimental_option( 'color_swatches_taxonomies', [] );
    $is_swatch      = ( in_array( $filter['e_name'], $swatch_taxes ) );
}

if ( $is_brand && ! $is_swatch ) {
    $data_default = ' data-brand='.FLRT_PLUGIN_DIR_URL.'assets/img/no-image.png';
}

if ( $is_swatch ){
    $data_default = ' data-image='.FLRT_PLUGIN_DIR_URL.'assets/img/no-image.png';
}

?>
<div class="<?php echo flrt_filter_class( $filter ); // Already escaped ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>">
    <?php flrt_filter_header( $filter, $terms ); // Safe, escaped ?>
    <div class="<?php echo esc_attr( flrt_filter_content_class( $filter ) ); ?>">
        <?php if( ! empty( $terms ) || $view_args['ask_to_select_parent'] ): ?>
            <select id="wpc-<?php echo esc_attr( $filter['entity'] ); ?>-<?php echo esc_attr( $filter['e_name'] ); ?>-<?php echo esc_attr( $filter['ID'] ); ?>"
                    aria-label="wpc-<?php echo esc_attr( $filter['entity'] ); ?>-<?php echo esc_attr( $filter['e_name'] ); ?>-<?php echo esc_attr( $filter['ID'] ); ?>"
                    class="wpc-filters-widget-select">
                <?php if( $view_args['ask_to_select_parent'] !== false ) : ?>
                    <option class="wpc-dropdown-default" value="0" data-wpc-link="<?php echo esc_attr( $noSelectUrl ); ?>" id="wpc-option-<?php echo esc_attr( $filter['entity'] ); ?>-<?php echo esc_attr( $filter['e_name'] ); ?>-0"><?php
                    echo esc_html( $view_args['ask_to_select_parent'] );
                    ?></option>
                <?php else: ?>
                    <option<?php echo esc_html( $data_default ); ?> class="wpc-dropdown-default" value="0" data-wpc-link="<?php echo esc_attr( $noSelectUrl ); ?>" id="wpc-option-<?php echo esc_attr( $filter['entity'] ); ?>-<?php echo esc_attr( $filter['e_name'] ); ?>-0"><?php
                        echo esc_html( flrt_dropdown_default_option( $filter ) );
                    ?></option>
                    <?php

                    foreach ( $terms as $id => $term_object ) {
                        $disabled          = 0;
                        $data_image        = '';
                        $selected          = ( in_array( $term_object->slug, $filter['values'] ) ) ? 1 : 0;
                        $term_hidden_class = '';
                        $data_count        = '';

                        if( isset( $term_object->wp_queried ) && $term_object->wp_queried ){
                            $disabled   = 1;
                        }

                        if ( $is_brand && ! $is_swatch ) {
                            $src = flrt_get_term_brand_image( $term_object->term_id, $filter );
                            if ( $src ) {
                                $data_image = ' data-brand=' . $src . '';
                                $preload_html .= '<img class="wpc-preload-img" src='. $src .' />'."\r\n";
                            }

                            if ( $filter['show_term_names'] === 'no' ) {
                                $term_hidden_class = ' wpc-hidden-term-name';
                            }
                        }

                        if ( $is_swatch ) {
                            $src = flrt_get_term_swatch_image( $term_object->term_id, $filter );

                            if ( $src ) {
                                $data_image = ' data-image=' . $src . '';
                                $preload_html .= '<img class="wpc-preload-img" src='. $src .' />'."\r\n";
                            } else {
                                $maybe_color = flrt_get_term_swatch_color( $term_object->term_id, $filter );
                                if ( $maybe_color ) {
                                    $data_color = ' data-color=' . $maybe_color . '';
                                } else {
                                    $data_color = ' data-color=none';
                                }
                            }

                            if ( $filter['show_term_names'] === 'no' ) {
                                $term_hidden_class = ' wpc-hidden-term-name';
                            }
                        }

                        if( $set['show_count']['value'] === 'yes' && $use_select2 ) {
                            $data_count        = ' data-count=' . $term_object->cross_count;
                        }

                        ?>
                        <option<?php echo esc_html( $data_image ); echo esc_html( $data_color ); echo esc_html( $data_count ); ?> class="wpc-term-count-<?php echo esc_attr( $term_object->cross_count ); ?> wpc-term-id-<?php echo esc_attr($term_object->term_id); echo esc_attr( $term_hidden_class ); ?>" value="<?php echo esc_attr( $term_object->term_id ); ?>" <?php selected( 1, $selected ); ?> <?php disabled( 1, $disabled ); ?> data-wpc-link="<?php echo esc_attr( $url_manager->getTermUrl( $term_object->slug, $filter['e_name'], $filter['entity'] ) ); ?>" id="wpc-option-<?php echo esc_attr( $filter['entity'] ); ?>-<?php echo esc_attr($filter['e_name']); ?>-<?php echo esc_attr( $id ); ?>"><?php
                            echo esc_html( $term_object->name );

                            if( $set['show_count']['value'] === 'yes' && ! $use_select2 ) {
                                echo esc_html( ' ('.$term_object->cross_count.')' );
                            }
                        ?></option>
                    <?php } ?><!-- end foreach -->
                <?php endif; ?>
            </select>
            <?php echo $preload_html; ?>
        <?php else:
            flrt_filter_no_terms_message( 'p' );
        endif; ?>
    </div>
</div>