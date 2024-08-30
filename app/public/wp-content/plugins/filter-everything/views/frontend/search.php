<?php

/**
 * The Template for displaying search field in Filters widget.
 *
 * This template can be overridden by copying it to yourtheme/filters/search.php
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
// $value = isset( $_GET[''] ) ?
$placeholder     = isset( $set['search_field_placeholder']['value'] ) ? esc_html( $set['search_field_placeholder']['value'] ) : esc_html__('Search ...', 'filter-everything');
$label           = isset( $set['search_field_label']['value'] ) ? esc_html( $set['search_field_label']['value'] ) : esc_html__('Search', 'filter-everything');
$search          = isset( $_GET['srch'] ) ? filter_input( INPUT_GET, 'srch', FILTER_SANITIZE_SPECIAL_CHARS ) : '';
$search_id       = isset( $set['ID'] ) ? esc_html( $set['ID'] .'s' ) : '0s';
$section_classes = 'wpc-filters-section wpc-filters-section-'.$search_id.' wpc-filter-layout-search-field';
if ( $search !== '' ){
    $section_classes .= ' wpc-search-active';
}

$cancel_url      = $url_manager->getTermUrl( '', '', '', '', [ 'srch'=> true ] );
?>
<div class="<?php echo $section_classes; ?>" data-fid="<?php echo $search_id; ?>">
    <?php if ( $label !== '' ) {
        flrt_filter_header( array( 'label' => $label, 'collapse' => 'no', 'values' => [], 'tooltip' => false ), [] );
    } ?>
    <form action="<?php echo esc_url( $url_manager->getFormActionUrl() ); ?>" role="search" method="GET" class="wpc-filter-search-form">
        <div class="wpc-search-field-wrapper wpc-search-field-wrapper-<?php echo $search_id; ?>">
            <span class="wpc-search-icon"></span>
            <input type="text" class="wpc-search-field" placeholder="<?php echo $placeholder; ?>" value="<?php echo $search; ?>" name="srch">
            <span class="wpc-search-clear-icon-wrapper">
                <a class="wpc-search-clear-icon" href="<?php echo esc_url( $cancel_url ); ?>" title="<?php esc_html_e('Clear search', 'filter-everything' ) ?>">&#215;</a>
            </span>
                <?php
                flrt_query_string_form_fields(
                    flrt_get_query_string_parameters(),
                    ['srch']
                );
            ?>
        </div>
    </form>
</div>