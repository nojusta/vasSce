<?php

class ET_Builder_Module_br_filter_single extends ET_Builder_Module {

	public $slug       = 'et_pb_br_filter_single';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
        $this->name             = __( 'Single Filter', 'BeRocket_AJAX_domain' );
		$this->child_title_var  = 'filter_id';
		$this->folder_name = 'et_pb_berocket_modules';
		$this->main_css_element            = '%%order_class%%';

        $query = new WP_Query(array('post_type' => 'br_product_filter', 'nopaging' => true, 'fields' => 'ids'));
        $posts = $query->get_posts();

        $filter_id = '0';
        if ( is_array($posts) && count($posts) ) {
            $filter_id = array_shift($posts);
        }
        
        $this->fields_defaults = array(
            'filter_id' => array($filter_id),
        );

		$this->advanced_fields = array(
			'fonts'           => array(
				'title'   => array(
					'label'        => et_builder_i18n( 'Title' ),
					'css'          => array(
						'main'      => "{$this->main_css_element} h2, {$this->main_css_element} h1, {$this->main_css_element} h3, {$this->main_css_element} h4, {$this->main_css_element} h5, {$this->main_css_element} h6",
						'important' => 'plugin_only',
					),
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
        $query = new WP_Query(array('post_type' => 'br_product_filter', 'nopaging' => true, 'fields' => 'ids'));
        $posts = $query->get_posts();
        if ( is_array($posts) && count($posts) ) {
            $filter_list = array();
            foreach($posts as $post_id) {
                $filter_list[$post_id] = get_the_title($post_id) . ' (ID:' . $post_id . ')';
            }
        } else {
            $filter_list = array('0' => __('--Please create filter first--', 'BeRocket_AJAX_domain'));
        }

        $fields = array(
            'filter_id' => array(
                'label'           => esc_html__( 'Filter', 'BeRocket_AJAX_domain' ),
                'type'            => 'select',
                'options'         => $filter_list,
            ),
        );

        return $fields;
    }

    function render( $atts, $content = null, $function_name = '' ) {
        add_filter('BeRocket_AAPF_template_full_content', array($this, 'header_replace'), 4000, 1);
        add_filter('BeRocket_AAPF_template_full_element_content', array($this, 'header_replace'), 4000, 1);
        $html = '';
        if( ! empty($atts['filter_id']) ) {
            $html .= trim(do_shortcode('[br_filter_single filter_id='.$atts['filter_id'].']'));
        }
        if(empty($html) && defined('DOING_AJAX') && in_array(berocket_isset($_REQUEST['action']), array('et_fb_ajax_render_shortcode', 'brapf_get_single_filter', 'brapf_get_group_filter'))) {
            $html .= '<h3 style="background-color:gray;color:white;">'.__('BeRocket Filter', 'BeRocket_AJAX_domain').'</h3>';
        }
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

new ET_Builder_Module_br_filter_single;
