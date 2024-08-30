<?php
class BRapf_fix_variation_attribute {
    function __construct () {
        add_action('init', array($this, 'init'));
        add_action('wp_ajax_brapf_fix_varattr', array($this, 'ajax_update'));
        add_action('wp_ajax_brapf_fix_varattr_status', array($this, 'ajax_status'));
        add_filter('brfr_data_ajax_filters', array($this, 'settings_page'), 105);
        add_filter('brfr_ajax_filters_fix_varattr', array($this, 'fix_varattr'), 10, 3);
        add_action('woocommerce_rest_insert_system_status_tool', array($this, 'recount_all_attributes'), 10, 1);
        add_action('woocommerce_system_status_tool_executed', array($this, 'recount_all_attributes_admin'), 10, 1);
    }
    function recount_all_attributes_admin($tool) {
        $this->recount_all_attributes($tool['id']);
    }
    function recount_all_attributes($tool) {
        if( $tool == 'recount_terms' ) {
            $attributes = wc_get_attribute_taxonomies();
            if( is_array($attributes) && count($attributes) > 0 ) {
                global $wpdb;
                foreach($attributes as $attribute) {
                    $attribute_name = 'pa_'.$attribute->attribute_name;
                    $attribute_values = get_terms(
                        $attribute_name,
                        array(
                            'hide_empty' => false,
                            'fields'     => 'ids',
                        )
                    );
                    $correct_attributes = array();
                    if( is_array($attribute_values) ) {
                        foreach($attribute_values as $attribute_value) {
                            $attribute_value = intval($attribute_value);
                            if( ! empty($attribute_value) ) {
                                $correct_attributes[] = $attribute_value;
                            }
                        }
                    }
                    if( ! empty($correct_attributes) && count($correct_attributes) > 0 ) {
                        $sql = "UPDATE {$wpdb->term_taxonomy} 
                        JOIN (
                            SELECT count(term_id) as count, term_id
                            FROM {$wpdb->term_relationships} 
                            INNER JOIN {$wpdb->term_taxonomy} using( term_taxonomy_id ) 
                            JOIN {$wpdb->posts} on wp_term_relationships.object_id = wp_posts.ID
                            WHERE term_id IN ( " . implode(',', $correct_attributes) . " ) 
                            AND {$wpdb->posts}.post_type = 'product'
                            GROUP BY term_id
                        ) as new_value ON new_value.term_id = {$wpdb->term_taxonomy}.term_id
                        set {$wpdb->term_taxonomy}.count = new_value.count";
                        $wpdb->query($sql);
                    }
                }
            }
        }
    }
    function init() {
        $isfix = get_option('brapf_variation_attr_fix', false);
        if ( $isfix ) {
            add_action( 'brapf_fix_varattr', array($this, 'cron_callback'), 10, 2 );
            add_filter('cron_schedules', array($this, 'my_cron_schedules'));
            if ( ! wp_next_scheduled( 'brapf_fix_varattr' ) ) {
                wp_schedule_event( time(), 'min', 'brapf_fix_varattr' );
            }
        }
    }
    function ajax_update() {
        $nonce = (empty($_REQUEST['nonce']) ? '' : $_REQUEST['nonce']);
        if( ! wp_verify_nonce($nonce, 'brapf_fix_varattr') ) {
            wp_die();
        }
        global $wpdb;
        $count = $wpdb->get_var("SELECT count(ID) as products FROM `{$wpdb->posts}` WHERE post_type = 'product'");
        update_option('brapf_variation_attr_fix', true);
        update_option('brapf_variation_attr_fix_data', 0);
        update_option('brapf_variation_attr_fix_count', $count);
        wp_die();
    }
    function ajax_status() {
        $nonce = (empty($_REQUEST['nonce']) ? '' : $_REQUEST['nonce']);
        if( ! wp_verify_nonce($nonce, 'brapf_fix_varattr') ) {
            wp_die();
        }
        $isfix = get_option('brapf_variation_attr_fix', false);
        $isfix_data = get_option('brapf_variation_attr_fix_data', false);
        $isfix_count = get_option('brapf_variation_attr_fix_count', false);
        $text = ( $isfix ? $isfix_data . '/' . $isfix_count : 'Ready' );
        echo $text;
        wp_die();
    }
    function cron_callback() {
        $fixdata = get_option('brapf_variation_attr_fix_data', false);
        if( ! $fixdata ) {
            $fixdata = 0;
        }
        global $wpdb;
        $ids = $wpdb->get_col("SELECT ID FROM `{$wpdb->posts}` WHERE post_type = 'product' LIMIT 100 OFFSET {$fixdata}");
        foreach($ids as $id) {
            $product = wc_get_product($id);
            if( 'variable' == $product->get_type() ) {
                $variations = $product->get_children();
                if( ! empty($variations) && is_array($variations) ) {
                    $all_attributes = $product->get_attributes();
                    if( ! empty($all_attributes) && is_array($all_attributes) ) {
                        $attributes = array();
                        foreach($all_attributes as $attribute_name => $attribute) {
                            if( method_exists($attribute, 'get_variation') && ! $attribute->get_variation() ) {
                                $attributes[] = 'attribute_'.$attribute_name;
                            }
                        }
                        if( count($attributes) > 0 ) {
                            global $wpdb;
                            $sql = "DELETE FROM {$wpdb->postmeta} WHERE post_id IN (" . implode(',', $variations) . ") AND meta_key IN ('" . implode("','", $attributes) . "')";
                            $wpdb->query($sql);
                        }
                    }
                }
            }
        }
        if( ! empty($ids) && count($ids) > 0 ) {
            $fixdata += 100;
            update_option('brapf_variation_attr_fix_data', $fixdata);
        } else {
            delete_option('brapf_variation_attr_fix');
            delete_option('brapf_variation_attr_fix_data');
            delete_option('brapf_variation_attr_fix_count');
        }
    }
    function my_cron_schedules($schedules){
        if(!isset($schedules["min"])){
            $schedules["min"] = array(
                'interval' => 10,
                'display' => __('Once every minute'));
        }
        return $schedules;
    }
    function settings_page($data) {
        $data['Advanced'] = berocket_insert_to_array(
            $data['Advanced'],
            'fixed_select2',
            array(
                'fix_varattr' => array(
                    "section"   => "fix_varattr",
                    "value"     => "",
                ),
            ),
            true
        );
        return $data;
    }
    function fix_varattr( $html, $item, $options ) {
        $html = '<tr class="bapf_incompatibility_fixes bapf_incompatibility_fixes_hide">
            <th scope="row">' . __('Remove Incorrect Variation Data', 'BeRocket_AJAX_domain') . '</th>
            <td>';
        $isfix = get_option('brapf_variation_attr_fix', false);
        $isfix_data = get_option('brapf_variation_attr_fix_data', false);
        $isfix_count = get_option('brapf_variation_attr_fix_count', false);
        $nonce = wp_create_nonce('brapf_fix_varattr');
        $class = ( $isfix ? 'berocket_fix_varattr_active' : 'berocket_fix_varattr' );
        $text = ( $isfix ? __('In Progress', 'BeRocket_AJAX_domain') . ' <span>' . $isfix_data . '/' . $isfix_count . '</span>' : __('Fix Variation Attributes', 'BeRocket_AJAX_domain') );
        $html .= '
                <span class="button '.$class.'">
                    ' . $text . '
                </span>
                <p>' . __('Clear all tables from add-on Additional Tables', 'BeRocket_AJAX_domain') . '</p>
                <script>
                    jQuery(".berocket_fix_varattr").click(function() {
                        var $this = jQuery.get(window.ajaxurl, {action:"brapf_fix_varattr",nonce:"' . $nonce . '"}, function() {
                            location.reload();
                        });
                    });';
        if( $isfix ) {
            $html .= 'setInterval(function() {
                    var $this = jQuery.get(window.ajaxurl, {action:"brapf_fix_varattr_status",nonce:"' . $nonce . '"}, function(data) {
                        jQuery(".berocket_fix_varattr_active span").text(data);
                    });
                }, 10000);
                jQuery(".berocket_fix_varattr").click(function() {
                        var $this = jQuery.get(window.ajaxurl, {action:"brapf_fix_varattr",nonce:"' . $nonce . '"}, function() {
                            location.reload();
                        });
                    });';
        }
        $html .= '
                </script>
            </td>
        </tr>';
        return $html;
    }
}
new BRapf_fix_variation_attribute();