<?php
class BeRocket_aapf_filter_add_settings_addon extends BeRocket_framework_addon_lib {
    public $addon_file = __FILE__;
    public $plugin_name = 'ajax_filters';
    public $php_file_name   = 'filter_add_settings_include';
    function get_addon_data() {
        $data = parent::get_addon_data();
        return array_merge($data, apply_filters('bapf_filter_add_settings_addon_data', array(
            'addon_name'    => __('Filter Additional Settings', 'BeRocket_AJAX_domain'),
            'tooltip'       => __('Options for each filter: Hide empty, Enable recount, hide empty after recount etc', 'BeRocket_AJAX_domain'),
            'paid'          => true
        ), $this));
    }
}
new BeRocket_aapf_filter_add_settings_addon();
