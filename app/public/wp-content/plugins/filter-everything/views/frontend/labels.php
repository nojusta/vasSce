<?php
/**
 * The Template for displaying filter labels.
 *
 * This template can be overridden by copying it to yourtheme/filters/labels.php.
 *
 * $set - array, with the Filter Set parameters
 * $filter - array, with the Filter parameters
 * $url_manager - object, of the UrlManager PHP class
 * $terms - array, with objects of all filter terms except excluded
 *
 * @see https://filtereverything.pro/resources/templates-overriding/
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

$args = [
    'hide' => $view_args['ask_to_select_parent']
];

$is_brand = ( in_array( $filter['e_name'], flrt_brand_filter_entities() ) );

if ( $is_brand ){
    $image_meta_key = 'image';
    if ( $filter['e_name'] === 'pwb-brand' ) {
        $image_meta_key = 'pwb_brand_image';
    } else if ( $filter['e_name'] === 'yith_product_brand' ) {
        $image_meta_key = 'thumbnail_id';
    }
}

?>
<div class="<?php echo flrt_filter_class( $filter, [], $terms, $args ); // Already escaped ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>">
    <?php flrt_filter_header( $filter, $terms ); // Safe, escaped ?>
    <div class="<?php echo esc_attr( flrt_filter_content_class( $filter ) ); ?>">
        <?php flrt_filter_search_field( $filter, $view_args, $terms ); ?>
        <ul class="wpc-filters-ul-list wpc-filters-labels wpc-filters-list-<?php echo esc_attr( $filter['ID'] ); ?>">
            <?php if( ! empty( $terms ) || $view_args['ask_to_select_parent'] ):
                if( $view_args['ask_to_select_parent'] !== false ) { ?>
                    <li><?php echo esc_html( $view_args['ask_to_select_parent'] ); ?></li>
                <?php } else {
                    foreach ( $terms as $id => $term_object ){
                        $disabled       = 0;
                        $checked        = ( in_array( $term_object->slug, $filter['values'] ) ) ? 1 : 0;
                        $image_class    = '';

                        if( isset( $term_object->wp_queried ) && $term_object->wp_queried ){
                            $checked    = 1;
                            $disabled   = 1;
                        }

                        $active_class    = $checked ? ' wpc-term-selected' : '';
                        $disabled_class  = $disabled ? ' wpc-term-disabled' : '';
                        $link            = $url_manager->getTermUrl( $term_object->slug, $filter['e_name'], $filter['entity'] );
                        $link_attributes = 'href="'.esc_url($link).'"';

                        if ( $is_brand ) {
                            $image_class = '';
                            if ( get_term_meta( $term_object->term_id, $image_meta_key, true ) ){
                                $image_class = ' wpc-term-has-image';
                            }
                        }
                    ?>
                        <li class="wpc-label-item wpc-term-item<?php echo esc_attr( $active_class ); ?><?php echo esc_attr( $disabled_class ); ?><?php echo esc_attr( $image_class ); ?> wpc-term-count-<?php echo esc_attr( $term_object->cross_count ); ?> wpc-term-id-<?php echo esc_attr( $id ); ?>" id="<?php flrt_term_id('term', $filter, $id ); ?>">
                            <div class="wpc-term-item-content-wrapper">
                                <input class="wpc-label-input" <?php checked( 1, $checked ); disabled( 1, $disabled ); ?> type="checkbox" data-wpc-link="<?php echo esc_url( $link ); ?>" id="<?php flrt_term_id('checkbox', $filter, $id); ?>" />
                                <label for="<?php flrt_term_id('checkbox', $filter, $id); ?>">
                                    <span class="wpc-filter-label-wrapper">
                                        <?php
                                        /**
                                         * Allow developers to change filter terms html
                                         */
                                        echo apply_filters( 'wpc_filters_label_term_html', '<a '.$link_attributes.'>'.$term_object->name.'</a>', $link_attributes, $term_object, $filter );

                                        ?>&nbsp;<?php flrt_filter_count( $term_object, $set['show_count']['value'] ); // Safe, escaped?>
                                    </span>
                                </label>
                            </div>
                        </li>
                    <?php } /* end foreach */ ?>
                <?php } /* end if ask to select parent */ ?>
            <?php  else:
                flrt_filter_no_terms_message();
            endif;
?>      </ul>
        <?php flrt_filter_more_less( $filter ); ?>
    </div>
</div>