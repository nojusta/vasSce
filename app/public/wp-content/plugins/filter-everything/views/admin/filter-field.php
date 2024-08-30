<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

?>
<tr class="<?php echo esc_attr( flrt_filter_row_class( $attributes ) ); ?>"<?php flrt_maybe_hide_row( $attributes ); ?>><?php

    flrt_include_admin_view('filter-field-label', array(
            'field_key'  => $field_key,
            'attributes' => $attributes
        )
    );

    flrt_include_admin_view('filter-field-input', array(
            'field_key'  => $field_key,
            'attributes' => $attributes
        )
    );
?>
</tr>