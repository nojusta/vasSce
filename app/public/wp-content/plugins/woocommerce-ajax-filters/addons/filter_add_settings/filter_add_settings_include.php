<?php
class BeRocket_aapf_filter_add_settings_filters {
    function __construct() {
        add_filter('braapf_new_widget_edit_page_all_steps', array($this, 'new_step'));
        //Filter Additional Settings
        add_action('braapf_single_filter_filter_add_settings', array(__CLASS__, 'options_get_terms'), 50, 2);
        add_action('braapf_single_filter_filter_add_settings', array(__CLASS__, 'options_get_terms_additional'), 100, 2);
        add_action('braapf_single_filter_filter_add_settings', array(__CLASS__, 'options_disable_empty_values'), 150, 2);
        add_action('berocket_aapf_query_var_title_filter', array(__CLASS__, 'add_settings_to_template'), 150, 3);
        add_filter('berocket_aapf_get_terms_args', array(__CLASS__, 'get_terms_args'), 100, 3);
        add_filter('berocket_aapf_get_terms_additional', array(__CLASS__, 'get_terms_additional'), 100, 3);
        add_filter('BeRocket_AAPF_template_single_item', array(__CLASS__, 'disable_empty_values'), 1000, 4);
        add_filter('brapf_paid_recount_filter', array(__CLASS__, 'paid_recount_filter'), 1000, 2);
        add_filter('bapf_paid_stock_sale_terms_ready', array(__CLASS__, 'paid_recount_terms'), 1000, 2);
    }
    function new_step($steps) {
        $steps = berocket_insert_to_array(
            $steps,
            'save',
            array(
                'filter_add_settings' => array(
                    'header' => __('Filter Additional Settings', 'BeRocket_AJAX_domain')
                ),
            ),
            true
        );
        return $steps;
    }
    static function options_get_terms($settings_name, $braapf_filter_settings) {
        echo '<div class="braapf_attribute_setup_flex">';
            $get_terms_hide_empty = br_get_value_from_array($braapf_filter_settings, 'get_terms_hide_empty', '');
            $get_terms_number = br_get_value_from_array($braapf_filter_settings, 'get_terms_number', '');
            echo '<div class="braapf_get_terms_hide_empty_attributes braapf_half_select_full">';
                echo '<label for="braapf_get_terms_hide_empty_attributes">' . __('Hide empty terms', 'BeRocket_AJAX_domain') . '</label>';
                echo '<select id="braapf_get_terms_hide_empty_attributes" name="'.$settings_name.'[get_terms_hide_empty]">';
                    echo '<option value=""'.($get_terms_hide_empty == "" ? ' selected' : '').'>' . __('Default', 'BeRocket_AJAX_domain') . '</option>';
                    echo '<option value="on"'.($get_terms_hide_empty == "on" ? ' selected' : '').'>' . __('Yes', 'BeRocket_AJAX_domain') . '</option>';
                    echo '<option value="off"'.($get_terms_hide_empty == "off" ? ' selected' : '').'>' . __('No', 'BeRocket_AJAX_domain') . '</option>';
                echo '</select>';
            echo '</div>';
            echo '<div class="braapf_get_terms_number_attributes braapf_half_select_full">';
                echo '<label for="braapf_get_terms_number_attributes">' . __('Terms number to get from database', 'BeRocket_AJAX_domain') . '</label>';
                echo '<input placeholder="'.__('Default', 'BeRocket_AJAX_domain').'" type="number" value="'.$get_terms_number.'" id="braapf_get_terms_number_attributes" name="'.$settings_name.'[get_terms_number]">';
            echo '</div>';
        echo '</div>';
        ?>
        <script>
        berocket_show_element('.brsbs_filter_add_settings', '{.braapf_widget_type input[type=radio]} == "filter" && {#braapf_filter_type} != "price" && {#braapf_filter_type} != "date"');
        </script>
        <?php
    }
    static function options_get_terms_additional($settings_name, $braapf_filter_settings) {
        echo '<div class="braapf_attribute_setup_flex">';
            $get_terms_disable_hide_empty = br_get_value_from_array($braapf_filter_settings, 'get_terms_disable_hide_empty', '');
            $get_terms_disable_recount = br_get_value_from_array($braapf_filter_settings, 'get_terms_disable_recount', '');
            echo '<div class="braapf_get_terms_disable_hide_empty braapf_half_select_full">';
                echo '<label for="braapf_get_terms_disable_hide_empty">' . __('Disable Hide Empty after recount', 'BeRocket_AJAX_domain') . '</label>';
                echo '<select id="braapf_get_terms_disable_hide_empty" name="'.$settings_name.'[get_terms_disable_hide_empty]">';
                    echo '<option value=""'.($get_terms_disable_hide_empty == "" ? ' selected' : '').'>' . __('Default', 'BeRocket_AJAX_domain') . '</option>';
                    echo '<option value="on"'.($get_terms_disable_hide_empty == "on" ? ' selected' : '').'>' . __('Yes', 'BeRocket_AJAX_domain') . '</option>';
                    echo '<option value="off"'.($get_terms_disable_hide_empty == "off" ? ' selected' : '').'>' . __('No', 'BeRocket_AJAX_domain') . '</option>';
                echo '</select>';
            echo '</div>';
            echo '<div class="braapf_get_terms_disable_recount braapf_half_select_full">';
                echo '<label for="braapf_get_terms_disable_recount">' . __('Disable Recount Products', 'BeRocket_AJAX_domain') . '</label>';
                echo '<select id="braapf_get_terms_disable_recount" name="'.$settings_name.'[get_terms_disable_recount]">';
                    echo '<option value=""'.($get_terms_disable_recount == "" ? ' selected' : '').'>' . __('Default', 'BeRocket_AJAX_domain') . '</option>';
                    echo '<option value="on"'.($get_terms_disable_recount == "on" ? ' selected' : '').'>' . __('Yes', 'BeRocket_AJAX_domain') . '</option>';
                    echo '<option value="off"'.($get_terms_disable_recount == "off" ? ' selected' : '').'>' . __('No', 'BeRocket_AJAX_domain') . '</option>';
                echo '</select>';
            echo '</div>';
        echo '</div>';
    }
    static function options_disable_empty_values($settings_name, $braapf_filter_settings) {
        echo '<div class="braapf_attribute_setup_flex">';
            $disable_empty_values = br_get_value_from_array($braapf_filter_settings, 'disable_empty_values', '');
            echo '<div class="braapf_disable_empty_values braapf_full_select_full"><p>';
                echo '<input' . ( empty($disable_empty_values) ? '' : ' checked' ) . ' type="checkbox" value="1" id="braapf_disable_empty_values" name="'.$settings_name.'[disable_empty_values]">';
                echo '<label for="braapf_disable_empty_values">' . __('Disable values without products', 'BeRocket_AJAX_domain') . '</label>';
            echo '</p></div>';
        echo '</div>';
    }
    static function add_settings_to_template($set_query_var_title, $instance, $br_options) {
        $set_query_var_title['disable_empty_values'] = ! empty($instance['disable_empty_values']);
        return $set_query_var_title;
    }
    static function get_terms_args($get_terms_args, $instance, $args) {
        if( ! empty($instance['get_terms_hide_empty']) ) {
            if( $instance['get_terms_hide_empty'] == 'on' ) {
                $get_terms_args['hide_empty'] = true;
            } elseif( $instance['get_terms_hide_empty'] == 'off' ) {
                $get_terms_args['hide_empty'] = false;
            }
        }
        if( ! empty($instance['get_terms_number']) ) {
            $number = intval($instance['get_terms_number']);
            if( $number > 0 ) {
                $get_terms_args['number'] = $number;
            }
        }
        return $get_terms_args;
    }
    static function get_terms_additional($get_terms_advanced, $instance, $args) {
        if( ! empty($instance['get_terms_disable_hide_empty']) ) {
            if( $instance['get_terms_disable_hide_empty'] == 'on' ) {
                $get_terms_advanced['disable_hide_empty'] = true;
            } elseif( $instance['get_terms_disable_hide_empty'] == 'off' ) {
                $get_terms_advanced['disable_hide_empty'] = false;
            }
        }
        if( ! empty($instance['get_terms_disable_recount']) ) {
            if( $instance['get_terms_disable_recount'] == 'on' ) {
                $get_terms_advanced['disable_recount'] = true;
            } elseif( $instance['get_terms_disable_recount'] == 'off' ) {
                $get_terms_advanced['disable_recount'] = false;
            }
        }
        return $get_terms_advanced;
    }
    static function disable_empty_values($template, $term, $i, $berocket_query_var_title) {
        if( $berocket_query_var_title['disable_empty_values'] && $term->count == 0 ) {
            if( $berocket_query_var_title['new_template'] == 'checkbox' ) {
                $template['content']['checkbox']['attributes']['disabled'] = 'disabled';
                $template = BeRocket_AAPF_dynamic_data_template::create_element_arrays($template, array('attributes', 'class'));
                $template['attributes']['class']['disabled'] = 'brapf_disabled_checkbox';
            } elseif( $berocket_query_var_title['new_template'] == 'select' ) {
                $template['attributes']['disabled'] = 'disabled';
            }
        }
        return $template;
    }
    static function paid_recount_filter($result, $instance) {
        if( ! empty($instance['get_terms_disable_recount']) ) {
            if( $instance['get_terms_disable_recount'] == 'on' ) {
                return false;
            } elseif( $instance['get_terms_disable_recount'] == 'off' ) {
                return true;
            }
        }
        return $result;
    }
    static function paid_recount_terms($terms, $instance) {
        if( ! empty($instance['get_terms_hide_empty']) || ! empty($instance['get_terms_disable_hide_empty']) ) {
            $terms_correct = array();
            foreach($terms as $term) {
                if( ! ($term->count == 0 
                && ((! empty($instance['get_terms_hide_empty']) && $instance['get_terms_hide_empty'] == 'on')
                || (! empty($instance['get_terms_disable_hide_empty']) && $instance['get_terms_disable_hide_empty'] == 'on')) ) ) {
                    $terms_correct[] = $term;
                }
            }
            $terms = $terms_correct;
        }
        if( ! empty($instance['get_terms_number']) && intval($instance['get_terms_number']) ) {
            if( count($terms) > intval($instance['get_terms_number']) ) {
                $terms = array_slice($terms, 0, intval($instance['get_terms_number']));
            }
        }
        return $terms;
    }
}
new BeRocket_aapf_filter_add_settings_filters();