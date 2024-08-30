<?php

class ET_Builder_Module_braapf_filter_next extends ET_Builder_Module {

	public $slug       = 'et_pb_braapf_filter_next';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
        $this->name       = __( 'BeRocket Filter Next Product', 'BeRocket_AJAX_domain' );
		$this->folder_name = 'et_pb_berocket_modules';
        $this->fields_defaults = array();
		$this->main_css_element = '%%order_class%%';
	}

    function get_fields() {
        $fields = array();
        return $fields;
    }

    function render( $atts, $content = null, $function_name = '' ) {
        add_filter('berocket_aapf_wcshortcode_is_filtering', array($this, 'enable_filtering'));
        return '';
    }
    function enable_filtering($enabled) {
        remove_filter('berocket_aapf_wcshortcode_is_filtering', array($this, 'enable_filtering'));
        return true;
    }
}

new ET_Builder_Module_braapf_filter_next;
