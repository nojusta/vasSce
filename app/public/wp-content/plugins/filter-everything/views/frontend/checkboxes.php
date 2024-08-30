<?php
/**
 * The Template for displaying filter checkboxes.
 *
 * This template can be overridden by copying it to yourtheme/filters/checkboxes.php.
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

?>
<div class="<?php echo flrt_filter_class( $filter, [], $terms, $args ); // Already escaped ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>">
    <?php flrt_filter_header( $filter, $terms ); // Safe, escaped ?>
    <div class="<?php echo esc_attr( flrt_filter_content_class( $filter ) ); ?>">
        <?php flrt_filter_search_field( $filter, $view_args, $terms ); ?>
        <ul class="wpc-filters-ul-list wpc-filters-checkboxes wpc-filters-list-<?php echo esc_attr( $filter['ID'] ); ?>"><?php

            if( ! empty( $terms ) || $view_args['ask_to_select_parent'] ):

                 if( $view_args['ask_to_select_parent'] !== false ) { ?>
                     <li><?php echo esc_html( $view_args['ask_to_select_parent'] ); ?></li>
                <?php } else {

                     $args = array(
                         'url_manager'  => $url_manager,
                         'filter'       => $filter,
                         'show_count'   => $set['show_count']['value'],
                         'set'          => $set
                     );

                     echo flrt_filter_walk_terms_tree( $terms, $args );
                 }
            else:
                flrt_filter_no_terms_message();
            endif;

?>      </ul>
        <?php flrt_filter_more_less( $filter ); ?>
    </div>
</div>