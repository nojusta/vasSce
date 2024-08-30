<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class Swatches
{
    public function __construct()
    {
        if ( flrt_get_experimental_option('use_color_swatches') === 'on' ) {
            $this->init();
        }
    }

    public function init()
    {   //@todo add media uploader for JS https://rudrastyh.com/wordpress/customizable-media-uploader.html
        // add hooks
        add_action( 'admin_init', [ $this, 'admin_init' ], 20 );
        add_action( 'template_redirect', [ $this, 'frontend_init' ] );
    }

    public function admin_init(){
        $taxonomies = flrt_get_experimental_option( 'color_swatches_taxonomies', [] );

        if( ! empty( $taxonomies ) ) {
            foreach ( $taxonomies as $taxonomy ) {
                // to check if this taxonomy already has fields
                // register fields for add new term screen
                // register fields for edit term screen
                // save fields
                $this->register_field( 'color', $taxonomy );
                $this->register_field( 'image', $taxonomy );

                if ( ! $this->field_exists( $taxonomy ) && $taxonomy !== 'product_cat' ) {
                    add_filter( "manage_edit-{$taxonomy}_columns", array( $this, 'columns' ) );

                    if ( strpos( $taxonomy, 'pa_' ) === 0 ) {
                        add_filter( "manage_{$taxonomy}_custom_column", array( $this, 'column_preview_pa' ), 10, 3 );
                    } else {
                        add_filter( "manage_{$taxonomy}_custom_column", array( $this, 'column_preview' ), 10, 3 );
                    }
                }

            }

            add_action( 'current_screen', [ $this, 'maybe_enqueue_media_uploaded' ], 20 );
        }
    }

    public function maybe_enqueue_media_uploaded( $current_screen ){
        $taxonomies = flrt_get_experimental_option( 'color_swatches_taxonomies', [] );

        if ( in_array( $current_screen->taxonomy, $taxonomies ) ) {
            if ( ! did_action( 'wp_enqueue_media' ) ) {
                wp_enqueue_media();
            }
        }

    }

    public function frontend_init(){
        $taxonomies = flrt_get_experimental_option( 'color_swatches_taxonomies', [] );

        if( ! empty( $taxonomies ) ) {
            add_filter( 'wpc_filter_classes', [ $this, 'frontend_filter_classes'], 10, 2 );

            add_filter( 'wpc_filters_radio_term_html', [ $this, 'frontend_display_swatch' ], 10, 4 );
            add_filter( 'wpc_filters_checkbox_term_html', [ $this, 'frontend_display_swatch' ], 10, 4 );
            add_filter( 'wpc_filters_label_term_html', [ $this, 'frontend_display_swatch' ], 10, 4 );
        }

    }

    public function frontend_filter_classes( $classes, $filter ){
        $taxonomies = flrt_get_experimental_option( 'color_swatches_taxonomies', [] );
        if( in_array( $filter['e_name'], $taxonomies ) ) {
            $classes[] = 'wpc-filter-has-swatches';
        }

        return $classes;
    }

    public function frontend_display_swatch( $term_html, $link_attributes, $term_object, $filter ) {

        $taxonomies = flrt_get_experimental_option( 'color_swatches_taxonomies', [] );

        if ( in_array( $filter['e_name'], $taxonomies ) ) {

            $image_src = flrt_get_term_swatch_image( $term_object->term_id, $filter );
            $wrapper_class = '';

            if ( $image_src ) {
                $swatch = '<img src="'.$image_src.'" class="wpc-term-image" />';
                $wrapper_class = ' wpc-term-swatch-image';
            } else {
                $maybe_color = flrt_get_term_swatch_color( $term_object->term_id, $filter );
                if ( $maybe_color ) {
                    $swatch = '<span class="wpc-term-swatch" style="background-color: '.$maybe_color.'"></span>';
                } else {
                    $swatch = '<span class="wpc-term-swatch wpc-no-swatch-yet"></span>';
                }
            }

            $link_attributes .= ' title="'.$term_object->name.'"';
            $term_html = '<a '.$link_attributes.'><span class="wpc-term-swatch-wrapper'.$wrapper_class.'">' . $swatch . '</span> ';
            $term_html .= '<span class="wpc-term-name">' . $term_object->name . '</span></a>';
        }

        return $term_html;
    }

    private function register_field( $field, $taxonomy ) {

        if ( $this->field_exists( $taxonomy, $field ) ) {
            return false;
        }

        switch ( $field ){
            case 'color':
                add_action( "{$taxonomy}_add_form_fields", [ $this, 'add_new_term_color_field' ] );
                add_action( "{$taxonomy}_edit_form_fields", [ $this, 'edit_term_color_field' ], 10, 2 );

                add_action( "edited_term", [ $this, 'save_color_field' ], 10, 3 );
                add_action( "created_term", [ $this, 'save_color_field' ], 10, 3 );
            break;

            case 'image':
                add_action( "{$taxonomy}_add_form_fields", [ $this, 'add_new_term_image_field' ] );
                add_action( "{$taxonomy}_edit_form_fields", [ $this, 'edit_term_image_field' ], 10, 2 );

                add_action( "edited_term", [ $this, 'save_image_field' ], 10, 3 );
                add_action( "created_term", [ $this, 'save_image_field' ], 10, 3 );
            break;

            default:
            //
            break;
        }
    }

    /**
     * Determines if current taxonomy already has Color and Image fields
     * @param $field
     * @param $taxonomy
     * @return bool
     */
    public function field_exists( $taxonomy, $field = '' ) {
        if ( ! $taxonomy ) {
            return false;
        }

        if ( class_exists( 'Woo_Variation_Swatches' ) ) {
            if ( strpos( $taxonomy, 'pa_' ) === 0 ) {
                return true;
            }
        }

        if ( $taxonomy === 'product_cat' && $field === 'image' ) {
            return true;
        }

        // for other plugins

        return false;
    }

    public function add_new_term_color_field( $taxonomy ) {
    ?>
        <div class="form-field wpc-color-picker">
            <label for="wpc_term_color"><?php esc_html_e('Color', 'filter-everything'); ?></label>
            <input type="text" name="wpc_term_color" id="wpc_term_color" />
            <p id="wpc-color-description"><?php esc_html_e('The selected color will be shown in the filter term.', 'filter-everything'); ?></p>
        </div>
    <?php
    }

    public function add_new_term_image_field( $taxonomy ) {
    ?>
        <div class="form-field">
            <label for="wpc_term_img"><?php esc_html_e('Image', 'filter-everything'); ?></label>
            <a href="javascript:void(0);" class="wpc-upload-image-button button wpc-upload"><?php esc_html_e('Upload image', 'filter-everything'); ?></a>
            <a href="javascript:void(0);" class="wpc-remove" style="display:none"><?php esc_html_e('Remove image', 'filter-everything'); ?></a>
            <input type="hidden" name="wpc_term_img" id="wpc_term_img" value="">
            <p id="wpc-image-description"><?php esc_html_e('The image will be shown in the filter term.', 'filter-everything'); ?></p>
        </div>
    <?php
    }

    public function edit_term_color_field( $term, $taxonomy ) {

        $key = 'color';
        if ( strpos( $taxonomy, 'pa_' ) === 0 ) {
            $key = 'product_attribute_color';
        }

        $color = get_term_meta( $term->term_id, $key, true );
        ?>
        <tr class="form-field wpc-color-picker">
            <th><label for="wpc_term_color"><?php esc_html_e('Color', 'filter-everything'); ?></label></th>
            <td>
                <input name="wpc_term_color" id="wpc_term_color" type="text" value="<?php echo esc_attr( $color ) ?>" />
                <p id="wpc-color-description"><?php esc_html_e('The selected color will be shown in the filter term.', 'filter-everything'); ?></p>
            </td>
        </tr>
        <?php
    }

    public function edit_term_image_field( $term, $taxonomy ) {
        $key = 'image';
        if ( strpos( $taxonomy, 'pa_' ) === 0 ) {
            $key = 'product_attribute_image';
        }

        $image_id = get_term_meta( $term->term_id, $key, true );

        ?>
        <tr class="form-field">
        <th>
            <label for="wpc_term_img"><?php esc_html_e('Image', 'filter-everything'); ?></label>
        </th>
        <td>
            <?php if( $image = wp_get_attachment_image_url( $image_id, 'medium' ) ) : ?>
                <a href="javascript:void(0);" class="wpc-upload-image-button wpc-upload">
                    <img src="<?php echo esc_url( $image ) ?>" />
                </a>
                <a href="javascript:void(0);" class="wpc-remove"><?php esc_html_e('Remove image', 'filter-everything'); ?></a>
                <input type="hidden" name="wpc_term_img" id="wpc_term_img" value="<?php echo absint( $image_id ) ?>">
            <?php else : ?>
                <a href="javascript:void(0);" class="wpc-upload-image-button button wpc-upload"><?php esc_html_e('Upload image', 'filter-everything'); ?></a>
                <a href="javascript:void(0);" class="wpc-remove" style="display:none"><?php esc_html_e('Remove image', 'filter-everything'); ?></a>
                <input type="hidden" name="wpc_term_img" id="wpc_term_img" value="">
            <?php endif; ?>
            <p id="wpc-image-description"><?php esc_html_e('The image will be shown in the filter term.', 'filter-everything'); ?></p>
        </td>
        </tr><?php
    }

    public function save_image_field( $term_id, $tt_id, $taxonomy ){
        $image_key = 'image';
        if ( strpos( $taxonomy, 'pa_' ) === 0 ) {
            $image_key = 'product_attribute_image';
        }

        if ( isset( $_POST[ 'wpc_term_img' ] ) ) {
            $image_id = absint( $_POST[ 'wpc_term_img' ] );
            update_term_meta( $term_id, $image_key, $image_id );
        }
    }

    public function save_color_field( $term_id, $tt_id, $taxonomy ){
        $color_key = 'color';
        if ( strpos( $taxonomy, 'pa_' ) === 0 ) {
            $color_key = 'product_attribute_color';
        }

        if ( isset( $_POST[ 'wpc_term_color' ] ) ) {
            $color = sanitize_text_field( $_POST[ 'wpc_term_color' ] );
            update_term_meta( $term_id, $color_key, $color );
        }
    }

    public function columns( $columns ){
        $new_columns = array();

        if ( isset( $columns[ 'cb' ] ) ) {
            $new_columns[ 'cb' ] = $columns[ 'cb' ];
        }

        $new_columns[ 'wpc-term-meta' ] = '';

        if ( isset( $columns[ 'cb' ] ) ) {
            unset( $columns[ 'cb' ] );
        }

        return array_merge( $new_columns, $columns );
    }

    public function column_preview( $columns, $column, $term_id ) {

        if ( 'wpc-term-meta' !== $column ) {
            return $columns;
        }

        $this->_display_preview( $term_id, false );

        return $columns;
    }

    public function column_preview_pa( $columns, $column, $term_id ) {
        if ( 'wpc-term-meta' !== $column ) {
            return $columns;
        }

        $this->_display_preview( $term_id );

        return $columns;
    }

    private function _display_preview( $term_id, $is_pa = true ) {

        $image_key = 'image';
        $color_key = 'color';

        if ( $is_pa ) {
            $image_key = 'product_attribute_' . $image_key;
            $color_key = 'product_attribute_' . $color_key;
        }

        $image_id = get_term_meta( $term_id, $image_key, true );
        if ( $image_id ) {
            $maybe_image = wp_get_attachment_image_url( $image_id, 'thumbnail' );
            if ( $maybe_image ) {
                echo '<img src="'.$maybe_image.'" class="wpc-term-preview" />'."\r\n";
                return true;
            }
        }

        $color = get_term_meta( $term_id, $color_key, true );
        if ( $color ) {
            echo '<div class="wpc-term-preview" style="background-color: '.$color.';"></div>'."\r\n";
            return true;
        } else {
            echo '<div class="wpc-term-preview" style="background-color: transparent;"></div>'."\r\n";
            return true;
        }

        return false;
    }

}

Container::instance()->getSwatches();