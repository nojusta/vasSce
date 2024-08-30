<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

$css_class    = 'wpc-filter-item wpc-filter-not-listed wpc-filter-item-search-field wpc-filter-' . $search_field_order['value'];
$css_class    .= ( isset( $use_search_field['value'] ) && $use_search_field['value'] === 'yes' ) ? ' wpc-opened' : '';
$search_text  = ( isset( $search_field_placeholder['value'] ) ) ? $search_field_placeholder['value'] : esc_html__('Search ...', 'filter-everything' );
$search_label = ( isset( $search_field_label['value'] ) ) ? $search_field_label['value'] : esc_html__('Search', 'filter-everything' );

?>
<div id="wpc-filter-id-search-field" class="<?php echo esc_attr( $css_class ); ?>" data-fid="search-field">
    <div class="wpc-filter-head">
        <div class="wpc-filter-title ui-sortable-handle">
            <ul class="wpc-custom-row wpc-filter-item-labels">
                <li class="wpc-filter-order" title="<?php echo $search_field_order['value']; ?>"><span class="wpc-filter-sortable-handle dashicons dashicons-menu"></span></li>
                <li class="wpc-filter-label"><?php echo $search_label; ?></li>
                <li class="wpc-filter-entity"><input type="text" class="wpc-text-input-style wpc-text-input-search" placeholder="<?php echo $search_text; ?>" readonly="readonly" /></li>
                <li class="wpc-filter-view">&nbsp;</li>
                <li class="wpc-filter-slug">&nbsp;</li>
            </ul>
        </div>
    </div>
    <div class="wpc-filter-body">
        <div class="wpc-filter-main-fields">
            <table class="wpc-form-fields-table wpc-filter-search-field">
                <tr class="wpc-filter-tr">
                    <td colspan="2">
                        <?php echo flrt_render_input( $search_field_order ); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>