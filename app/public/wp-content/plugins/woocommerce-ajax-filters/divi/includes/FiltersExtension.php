<?php

class BAPF_DiviExtension extends DiviExtension {
	public $gettext_domain = 'braapf-my-extension';
	public $name = 'braapf-extension';
	public $version = '1.0.0';
    public $props = array();
	public function __construct( $name = 'braapf-extension', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );

		parent::__construct( $name, $args );
        add_action('wp_ajax_brapf_get_single_filter', array($this, 'get_single_filter'));
        add_action('wp_ajax_brapf_get_group_filter', array($this, 'get_group_filter'));
	}
    public function get_single_filter() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die();
        }
        $atts = berocket_sanitize_array($_POST);
        $atts = self::convert_on_off($atts);
        $this->props = $atts;
        $filter_id = (empty($atts['filter_id']) ? '' : intval($atts['filter_id']));
        add_filter('BeRocket_AAPF_template_full_content', array($this, 'header_replace'), 4000, 1);
        add_filter('BeRocket_AAPF_template_full_element_content', array($this, 'header_replace'), 4000, 1);
        if( ! empty($filter_id) ) {
            $filter = do_shortcode('[br_filter_single filter_id='.$filter_id.']');
            echo $filter;
        }
        remove_filter('BeRocket_AAPF_template_full_content', array($this, 'header_replace'), 4000, 1);
        remove_filter('BeRocket_AAPF_template_full_element_content', array($this, 'header_replace'), 4000, 1);
        wp_die();
    }
    public function get_group_filter() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die();
        }
        $atts = berocket_sanitize_array($_POST);
        $atts = self::convert_on_off($atts);
        $this->props = $atts;
        $args = array();
        if( empty($atts['group_id']) ) {
            $options = array(
                'display_inline',
                'display_inline_count',
                'min_filter_width_inline',
                'hidden_clickable',
                'hidden_clickable_hover',
                'group_is_hide'
            );
            foreach($options as $option) {
                $args[$option] = (empty($atts[$option]) ? '' : $atts[$option]);
            }
        } else {
            $args['group_id'] = $atts['group_id'];
        }
        $correct_filters = array();
        $filters_text = explode(',', $atts['filters']);
        foreach($filters_text as $filter_text) {
            $filter_text = explode(')', $filter_text);
            if( count($filter_text) > 1 ) { 
                $filter_text = $filter_text[0];
                $filter_text = str_replace('(ID:', '', $filter_text);
                $filter_text = trim($filter_text);
                $filter_text = intval($filter_text);
                if( ! empty($filter_text) ) {
                    $correct_filters[] = $filter_text;
                }
            }
        }
        $args['filters'] = $correct_filters;

        add_filter('BeRocket_AAPF_template_full_content', array($this, 'header_replace'), 4000, 1);
        add_filter('BeRocket_AAPF_template_full_element_content', array($this, 'header_replace'), 4000, 1);
        ob_start();
        the_widget( 'BeRocket_new_AAPF_Widget', $args);
        $group = ob_get_clean();
        remove_filter('BeRocket_AAPF_template_full_content', array($this, 'header_replace'), 4000, 1);
        remove_filter('BeRocket_AAPF_template_full_element_content', array($this, 'header_replace'), 4000, 1);
        echo $group;
        wp_die();
    }
	public function wp_hook_enqueue_scripts() {
		if ( $this->_debug ) {
			$this->_enqueue_debug_bundles();
		} else {
			$this->_enqueue_bundles();
		}

		if ( et_core_is_fb_enabled() && ! et_builder_bfb_enabled() ) {
			$this->_enqueue_backend_styles();
		}

		// Normalize the extension name to get actual script name. For example from 'divi-custom-modules' to `DiviCustomModules`.
		$extension_name = str_replace( ' ', '', ucwords( str_replace( '-', ' ', $this->name ) ) );

		// Enqueue frontend bundle's data.
		if ( ! empty( $this->_frontend_js_data ) ) {
			wp_localize_script( "{$this->name}-frontend-bundle", "{$extension_name}FrontendData", $this->_frontend_js_data );
		}

		// Enqueue builder bundle's data.
		if ( et_core_is_fb_enabled() && ! empty( $this->_builder_js_data ) ) {
			wp_localize_script( "{$this->name}-builder-bundle", "{$extension_name}BuilderData", $this->_builder_js_data );
		}
	}
    public static function convert_on_off($atts) {
        foreach($atts as &$attr) {
            if( $attr === 'on' || $attr === 'off' ) {
                $attr = ( $attr === 'on' ? TRUE : FALSE );
            }
        }
        return $atts;
    }
    function header_replace($template_content) {
        $atts = $this->props;
        if( ! empty($atts['title_level']) ) {
            $template_content['template']['content']['header']['content']['title']['tag'] = $atts['title_level'];
        }
        return $template_content;
    }
}

new BAPF_DiviExtension;
