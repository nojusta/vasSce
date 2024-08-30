<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

$css_class  = 'wpc-filter-item wpc-filter-not-listed wpc-filter-item-apply-button wpc-filter-' . $apply_button['value'];
$css_class .= ( isset( $use_apply_button['value'] ) && $use_apply_button['value'] === 'yes' ) ? ' wpc-opened' : '';
$apply_text      = ( isset( $apply_button_text['value'] ) ) ? $apply_button_text['value'] : esc_html__('Apply', 'filter-everything');
$reset_text      = ( isset( $reset_button_text['value'] ) ) ? $reset_button_text['value'] : esc_html__('Reset', 'filter-everything');

?>
<div id="wpc-filter-id-apply-button" class="<?php echo esc_attr( $css_class ); ?>" data-fid="apply-button">
    <div class="wpc-filter-head">
        <div class="wpc-filter-title ui-sortable-handle">
            <ul class="wpc-custom-row wpc-filter-item-labels">
                <li class="wpc-filter-order" title="<?php echo $apply_button_order; ?>"><span class="wpc-filter-sortable-handle dashicons dashicons-menu"></span></li>
                <li class="wpc-filter-label"><span class="wpc-button-style wpc-button-apply"><?php echo $apply_text; ?></span></li>
                <li class="wpc-filter-label"><span class="wpc-button-style wpc-button-reset"><?php echo $reset_text; ?></span></li>
            </ul>
        </div>
    </div>
    <div class="wpc-filter-body">
        <div class="wpc-filter-main-fields">
            <table class="wpc-form-fields-table wpc-filter-apply-button">
                <tr class="wpc-filter-tr">
                    <td colspan="2">
                        <?php echo flrt_render_input( $apply_button ); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>