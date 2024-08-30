<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

    $set_id    = $post->ID;
    $filters    = flrt_get_configured_filters( $set_id );

    $filterSet  = \FilterEverything\Filter\Container::instance()->getFilterSetService();
    $the_set    = $filterSet->getSet( $set_id );

    $order = 1;

    $search_field_order   = ( isset( $the_set['search_field_menu_order']['value'] ) && $the_set['search_field_menu_order']['value'] > -1 ) ? (int)$the_set['search_field_menu_order']['value'] : (count($filters) + 1);
    // To avoid equal order for both elements
    if ( isset( $the_set['apply_button_menu_order']['value'] ) && $the_set['apply_button_menu_order']['value'] > -1 ){
        $apply_button_order = (int)$the_set['apply_button_menu_order']['value'];
    } else {
        $apply_button_order = ($search_field_order + 1);
    }
    if ( $apply_button_order === $search_field_order ) {
        $apply_button_order++;
    }

    $apply_btn_displayed  = false;
    $search_fld_displayed = false;
    if ( isset( $the_set['use_search_field']['value'] ) && $the_set['use_search_field']['value'] === 'yes' ) {
        $search_fld_displayed = true;
    }

?>
<div class="wpc-filter-set-wrapper">
    <div class="wpc-filter-set-hidden-fields">
        <input type="hidden" id="wpc_set_nonce" name="_flrt_nonce" value="<?php echo esc_attr( flrt_create_filters_nonce() ); ?>" />
    </div>
    <div class="wpc-column-labels-wrapper">
        <table class="wpc-form-fields-table">
            <?php

            $attributes['post_type'] = $the_set['post_type'];
            $post_type  = ( isset( $the_set['post_type']['value'] ) && $the_set['post_type']['value'] ) ? $the_set['post_type']['value'] : $the_set['post_type']['default'];

            flrt_include_admin_view('filter-field', array(
                    'field_key'  => key($attributes),
                    'attributes' =>  reset($attributes)
                )
            );

            ?>
        </table>
    </div>
    <div class="wpc-column-labels-wrapper">
        <div class="wpc-column-labels widget-title">
            <ul class="wpc-custom-row">
                <li class="wpc-filter-order">&nbsp;</li>
                <li class="wpc-filter-label"><?php esc_html_e('Title', 'filter-everything' ); ?></li>
                <li class="wpc-filter-entity"><?php esc_html_e('Filter by', 'filter-everything' ); ?></li>
                <li class="wpc-filter-view"><?php esc_html_e('View', 'filter-everything' ); ?></li>
                <li class="wpc-filter-slug"><?php esc_html_e('URL Prefix', 'filter-everything' ); ?></li>
            </ul>
        </div>
    </div>
    <div class="wpc-no-filters"<?php if( ! $filters && ! $search_fld_displayed ){ echo ' style="display: block;"'; }?>>
        <?php
            echo wp_kses(
                    __('There are no filters yet. Click the <strong>Add Filter</strong> button to create your first one.', 'filter-everything' ),
                    array( 'strong' => array() )
                );
            ?>
    </div>
    <div id="wpc-filters-list" class="wpc-filters-list" data-posttype="<?php echo $post_type; ?>">

        <?php
                $filters_and_fields = [];
                $filters            = array_reverse( $filters, true );
                $to                 = count( $filters ) + 2;

                for ( $i = 1; $i <= $to; $i++ ) {
                    if ( $apply_button_order === $i ) {
                        $filters_and_fields[-1] = array();
                    } else if ( $search_field_order === $i ) {
                        $filters_and_fields[-2] = array();
                    } else {
                        // To avoid "empty" filter
                        if ( ! empty( $filters ) ) {
                            $key    = array_key_last( $filters );
                            $value  = array_pop( $filters );
                            $filters_and_fields[$key] = $value;
                        }
                    }
                }

                if( $filters_and_fields ):

                foreach( $filters_and_fields as $filter_id => $filter ):

                    if ( $filter_id >= 0 ) {
                        flrt_include_admin_view( 'filter-row', array( 'filter' => $filter ) );
                    } else {
                        if ( $search_field_order == $order ) {
                            flrt_include_admin_view( 'filter-search-field', array(
                                    'search_field_order'        => $the_set['search_field_menu_order'],
                                    'use_search_field'          => $the_set['use_search_field'],
                                    'search_field_placeholder'  => $the_set['search_field_placeholder'],
                                    'search_field_label'        => $the_set['search_field_label'],
                                    'post_type_args'            => $the_set['post_type'],
                                )
                            );
                        }

                        if ( $apply_button_order == $order ) {
                            flrt_include_admin_view( 'filter-apply-button', array(
                                    'apply_button'          => $the_set['apply_button_menu_order'],
                                    'use_apply_button'      => $the_set['use_apply_button'],
                                    'apply_button_text'     => $the_set['apply_button_text'],
                                    'reset_button_text'     => $the_set['reset_button_text'],
                                    'apply_button_order'    => $apply_button_order
                                )
                            );
                        }
                    }

                    $order++;
                endforeach;

         endif; ?>
    </div>

    <div class="wpc-add-filter-wrapper">
        <div class="wpc-add-filter-div">
            <a href="javascript:void(0);" class="button button-primary button-large wpc-add-filter"><?php esc_html_e('Add Filter','filter-everything' ); ?></a>
        </div>
    </div>

    <script type="text/html" id="wpc-new-filter">
        <?php
            flrt_include_admin_view( 'filter-row', array( 'filter' => flrt_get_empty_filter( $set_id ) ) );
        ?>
    </script>
</div>