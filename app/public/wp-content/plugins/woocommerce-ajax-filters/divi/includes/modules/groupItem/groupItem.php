<?php

class ET_Builder_Module_br_filters_group_item extends ET_Builder_Module {
	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);
    function init() {
		$this->name                        = esc_html__( 'Filter', 'et_builder' );
		$this->slug                        = 'et_pb_br_filters_group_item';
		$this->vb_support                  = 'on';
		$this->type                        = 'child';
		$this->child_title_var             = 'filter_id';
		$this->advanced_setting_title_text = esc_html__( 'New Filter', 'et_builder' );
		$this->settings_text               = esc_html__( 'Filter Settings', 'et_builder' );
		$this->main_css_element            = '%%order_class%%';

        $this->whitelisted_fields = array(
            'filter_id',
        );

        $filter_id = '0';
        $query = new WP_Query(array('post_type' => 'br_product_filter', 'nopaging' => true, 'fields' => 'ids'));
        $posts = $query->get_posts();
        if ( is_array($posts) && count($posts) ) {
            $filter_id = array_shift($posts);
        }

        $this->fields_defaults = array(
            'filter_id'                => array($filter_id),
        );
    }

    function get_fields() {
        $query = new WP_Query(array('post_type' => 'br_product_filter', 'nopaging' => true, 'fields' => 'ids'));
        $posts = $query->get_posts();
        if ( is_array($posts) && count($posts) ) {
            $filter_list = array();
            foreach($posts as $post_id) {
                $line = '(ID:' . $post_id . ') ' . get_the_title($post_id);
                $filter_list[$line] = $line;
            }
        } else {
            $filter_list = array('0' => __('--Please create filter--', 'BeRocket_AJAX_domain'));
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
        $props = $this->props;
        return esc_html($props['filter_id']).',';
    }
}

new ET_Builder_Module_br_filters_group_item;
