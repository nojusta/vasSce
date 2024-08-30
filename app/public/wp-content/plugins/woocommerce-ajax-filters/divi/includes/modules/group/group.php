<?php

class ET_Builder_Module_br_filters_group extends ET_Builder_Module {

	public $slug       = 'et_pb_br_filters_group';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
        $this->name       = __( 'Group Filter', 'BeRocket_AJAX_domain' );
		$this->child_slug      = 'et_pb_br_filters_group_item';
		$this->folder_name = 'et_pb_berocket_modules';
		$this->child_item_text = esc_html__( 'Filters', 'et_builder' );
		$this->main_css_element = '%%order_class%%';

        $this->whitelisted_fields = array(
            'group_id',
            'display_inline',
            'display_inline_count',
            'min_filter_width_inline',
            'hidden_clickable',
            'hidden_clickable_hover',
            'group_is_hide',
            'group_is_hide_theme',
            'group_is_hide_icon_theme',
        );

        $this->fields_defaults = array(
            'group_id' => array('0'),
            'display_inline' => array('off'),
            'display_inline_count' => array(''),
            'min_filter_width_inline' => array('25'),
            'hidden_clickable' => array('off'),
            'hidden_clickable_hover' => array('off'),
            'group_is_hide' => array('off'),
            'group_is_hide_theme' => array('0'),
            'group_is_hide_icon_theme' => array('0'),
        );

		$this->advanced_fields = array(
			'fonts'           => array(
				'title'   => array(
					'label'        => et_builder_i18n( 'Title' ),
					'css'          => array(
						'main'      => "{$this->main_css_element} h2, {$this->main_css_element} h1, {$this->main_css_element} h3, {$this->main_css_element} h4, {$this->main_css_element} h5, {$this->main_css_element} h6",
						'important' => 'plugin_only',
					),
					'header_level' => false,
				),
				'Body'   => array(
					'css'          => array(
						'main'      => "{$this->main_css_element} .bapf_body, {$this->main_css_element} .bapf_body label a",
						'important' => 'plugin_only',
					),
				),
			),
			'link_options'  => false,
			'visibility'    => false,
			'text'          => false,
			'button'        => false,
			'filters'       => false,
			'max_width'     => false,
		);
	}

    function get_fields() {
        $query = new WP_Query(array('post_type' => 'br_filters_group', 'nopaging' => true, 'fields' => 'ids'));
        $posts = $query->get_posts();
        $filter_list = array('0' => __('Build In Divi', 'BeRocket_AJAX_domain'));
        if ( is_array($posts) && count($posts) ) {
            foreach($posts as $post_id) {
                $filter_list[$post_id] = get_the_title($post_id) . ' (ID:' . $post_id . ')';
            }
        } else {
            $filter_list = array('0' => __('--Please create group first--', 'BeRocket_AJAX_domain'));
        }
        $fields = array(
            'group_id' => array(
                'label'           => esc_html__( 'Group', 'BeRocket_AJAX_domain' ),
                'type'            => 'select',
                'options'         => $filter_list,
            )
        );

        return apply_filters('ET_Builder_Module_br_filters_group_fields', $fields);
    }

    function render( $atts, $content = null, $function_name = '' ) {
        $atts = $this->props;
        $atts = BAPF_DiviExtension::convert_on_off($atts);
        $filters_text = $this->content;
        $filters_text = explode(',', $filters_text);
        $correct_filters = array();
        foreach($filters_text as $filter_text) {
            $filter_text = sanitize_textarea_field($filter_text);
            $filter_text = trim($filter_text);
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
        $args['filters'] = $correct_filters;
        add_filter('BeRocket_AAPF_template_full_content', array($this, 'header_replace'), 4000, 1);
        add_filter('BeRocket_AAPF_template_full_element_content', array($this, 'header_replace'), 4000, 1);
        ob_start();
        the_widget( 'BeRocket_new_AAPF_Widget', $args);
        $html = ob_get_clean();
        remove_filter('BeRocket_AAPF_template_full_content', array($this, 'header_replace'), 4000, 1);
        remove_filter('BeRocket_AAPF_template_full_element_content', array($this, 'header_replace'), 4000, 1);
        return $html;
    }
    function header_replace($template_content) {
        $atts = $this->props;
        if( ! empty($atts['title_level']) ) {
            $template_content['template']['content']['header']['content']['title']['tag'] = $atts['title_level'];
        }
        return $template_content;
    }
}

new ET_Builder_Module_br_filters_group;
