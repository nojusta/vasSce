<?php
/**
 * The Template for displaying filter date range.
 *
 * This template can be overridden by copying it to yourtheme/filters/date.php
 *
 * $filter - array, with the Filter parameters
 * $url_manager - object, of the UrlManager PHP class
 * $terms - array, with objects of all filter terms except excluded
 *
 * @see https://filtereverything.pro/resources/templates-overriding/
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

use \FilterEverything\Filter\PostDateEntity;

/**
 * @todo We have to display UI calendar in any case even there are no available terms
 */
?>
<div class="<?php echo flrt_filter_class( $filter ); // Already escaped ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>">
    <?php flrt_filter_header( $filter, $terms ); // Safe, escaped ?>
    <div class="<?php echo esc_attr( flrt_filter_content_class( $filter ) ); ?>">
        <div class="wpc-filters-range-inputs">
            <?php if( ! empty( $terms ) || $view_args['ask_to_select_parent'] ):

                if( $view_args['ask_to_select_parent'] !== false ) { ?>
                    <div><?php echo esc_html( $view_args['ask_to_select_parent'] ); ?></div>
                <?php } else {

                    $fromName = flrt_range_input_name( $filter['slug'], 'from', 'date' );
                    $toName   = flrt_range_input_name( $filter['slug'], 'to', 'date' );

                    $date_format   = isset( $filter['date_format'] ) ? $filter['date_format'] : flrt_default_date_format( $filter['date_type'] );

                    $absFrom  = $absTo = '';

                    foreach ( $terms as $term ) {
                        foreach( $terms as $term ) {
                            if ( $filter['date_type'] === 'time' ) {
                                if( isset($term->time_from) ) {
                                    $absFrom = $term->time_from;
                                }
                                if( isset( $term->time_to ) ) {
                                    $absTo = $term->time_to;
                                }
                            } else {
                                if( isset($term->from) ) {
                                    $absFrom = flrt_clean_date_time( $term->from, $filter['date_type'] );
                                }
                                if( isset( $term->to ) ) {
                                    $absTo = flrt_clean_date_time( $term->to, $filter['date_type'] );
                                }
                            }
                        }
                    }

                    $to   = $visible_to   = isset( $filter['values']['to'] ) ? $filter['values']['to'] : $absTo;
                    $from = $visible_from = isset( $filter['values']['from'] ) ? $filter['values']['from'] : $absFrom;

                    $visible_to     = flrt_apply_date_format( $to, $date_format );
                    $visible_from   = flrt_apply_date_format( $from, $date_format );

                    //@todo should be changed
                    if ( $filter['date_type'] === 'datetime' ) {
                        $to         = str_replace( ':', '.', str_replace( " ", FLRT_DATE_TIME_SEPARATOR, $to ) );
                        $from       = str_replace( ':', '.', str_replace( " ", FLRT_DATE_TIME_SEPARATOR, $from ) );
                        $absFrom    = str_replace( ':', '.', str_replace( " ", FLRT_DATE_TIME_SEPARATOR, $absFrom ) );
                        $absTo      = str_replace( ':', '.', str_replace( " ", FLRT_DATE_TIME_SEPARATOR, $absTo ) );
                    }

                    ?>
                    <form action="" method="GET" class="wpc-filter-date-range-form-visible" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>">
                        <div class="wpc-filters-date-range-wrapper">
                            <div class="wpc-filters-date-range-column wpc-filters-date-range-from-column">
                                <label for="wpc-filters-alt-date-from-<?php echo esc_attr( $filter['ID'] ); ?>"><?php esc_html_e( 'After', 'filter-everything' ); ?></label>
                                <input type="text" id="wpc-filters-alt-date-from-<?php echo esc_attr( $filter['ID'] ); ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>" class="wpc-filters-range-from" name="alt_<?php echo esc_attr( $fromName ); ?>" value="<?php echo esc_attr( $visible_from ); ?>" />
                            </div>
                            <div class="wpc-filters-date-range-column wpc-filters-date-range-to-column">
                                <label for="wpc-filters-alt-date-to-<?php echo esc_attr( $filter['ID'] ); ?>"><?php esc_html_e( 'Before', 'filter-everything' ); ?></label>
                                <input type="text" id="wpc-filters-alt-date-to-<?php echo esc_attr( $filter['ID'] ); ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>" class="wpc-filters-range-to" name="alt_<?php echo esc_attr( $toName ); ?>" value="<?php echo esc_attr( $visible_to ); ?>" />
                            </div>
                        </div>
                    </form>
                    <!-- Hidden part of the date form -->
                    <form style="display: none;" action="<?php echo esc_url( $url_manager->getFormActionUrl() ); ?>" method="GET" class="wpc-filter-date-range-form" id="wpc-filter-date-range-form-<?php echo esc_attr( $filter['ID'] ); ?>">
                        <div class="wpc-filters-date-range-wrapper">
                            <div class="wpc-filters-date-range-column wpc-filters-date-range-from-column">
                                <input type="text" id="wpc-filters-date-from-<?php echo esc_attr( $filter['ID'] ); ?>" class="wpc-filters-range-from" name="<?php echo esc_attr( $fromName ); ?>" value="<?php echo esc_attr( $from ); ?>" data-from="<?php echo esc_attr( $absFrom ); ?>" />
                            </div>
                            <div class="wpc-filters-date-range-column wpc-filters-date-range-to-column">
                                <input type="text" id="wpc-filters-date-to-<?php echo esc_attr( $filter['ID'] ); ?>" class="wpc-filters-range-to" name="<?php echo esc_attr( $toName ); ?>" value="<?php echo esc_attr( $to ); ?>" data-to="<?php echo esc_attr( $absTo ); ?>" />
                            </div>
                        </div>
                        <?php
                        /**
                         * @bug if $absFrom === $absTo slider freezes
                         */
                        ?>
                        <?php
                        flrt_query_string_form_fields(
                            flrt_get_query_string_parameters(),
                            [$fromName, $toName]
                        );
                        ?>
                    </form>
                <?php } ?>
            <?php  else:  ?>
                <?php esc_html_e('There are no posts with such filtering criteria on this site.', 'filter-everything' ); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
