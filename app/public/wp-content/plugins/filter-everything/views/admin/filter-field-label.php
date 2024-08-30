<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

?><td class="wpc-filter-label-td"><?php
    $label = esc_html( $attributes['label'] );
    if( $label ) :
        ?><label <?php if( isset( $attributes['id'] ) && $attributes['type'] !== 'Radio' ){ echo 'for="'. esc_attr( $attributes['id'] ).'"'; } ?> class="wpc-filter-label"><?php
        echo '<span class="wpc-label-text">'.$label.'</span>';
        if( isset( $attributes['required'] ) && $attributes['required'] ){
            echo '<span class="wpc-field-required">*</span>'."\n";
        }
        ?></label>
        <?php echo flrt_field_instructions($attributes); // Already escaped in function ?>
        <?php echo flrt_tooltip($attributes); ?>
    <?php endif; ?>
</td>