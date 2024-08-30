<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class FiltersWidget extends \WP_Widget
{
    public $show_instance_in_rest = false;

    public function __construct() {
        parent::__construct(
            'wpc_filters_widget', // Base ID
            esc_html__( 'Filter Everything &mdash; Filters', 'filter-everything'),
            array(
                'description' => esc_html__( 'Displays filters', 'filter-everything' ),
                'show_instance_in_rest' => false,
            )
        );
    }

    /**
     * Outputs the content for the current Filters widget instance.
     * @since 1.0.0
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Filters widget instance.
     */
    public function widget( $args, $instance ) {
        if ( is_array( $args ) ){
            extract( $args );
        }

        $title               = isset( $instance['title'] ) ? $instance['title'] : '';
        $title               = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $show_selected_class = ( !empty( $instance['chips'] ) ) ? ' wpc-show-on-desktop' : '';
        $show_count          = ( !empty( $instance['show_count'] ) ) ? $instance['show_count'] : '';
        $horizontal          = ( !empty( $instance['horizontal'] ) ) ? $instance['horizontal'] : '';
        $cols_count          = ( isset( $instance['cols_count'] ) && $instance['cols_count'] > 0 ) ? $instance['cols_count'] : 3;

        $set_id              = isset( $instance['id'] ) ? preg_replace('/[^\d]?/', '', $instance['id'] ) : 0;
        $popup_title         = esc_html__('Filters', 'filter-everything');

        if ( ! empty( $title ) ) {
            $popup_title = $title;
        }

        // Display nothing in Page Builders preview mode
        if( isset( $_GET['legacy-widget-preview'] ) || isset( $_GET['_locale'] ) ){
            return;
        }

        if( isset( $_POST['action'] ) && $_POST['action'] === 'elementor_ajax' ){
            echo '<strong>'.esc_html__( 'Filter Everything &mdash; Filters', 'filter-everything' ).'</strong>';
            return;
        }

        if( isset( $_GET['action'] ) && $_GET['action'] === 'elementor' ){
            echo '<strong>'.esc_html__( 'Filter Everything &mdash; Filters', 'filter-everything' ).'</strong>';
            return;
        }

        /**
         * Fires before current widget output
         */
        do_action( 'wpc_before_filters_widget', $args, $instance );

        /**
         * @feature Add ability to choose what filter Set to display in widget settings
         */
        $debug_mode = flrt_is_debug_mode();
        $container  = Container::instance();
        $wpManager  = $container->getWpManager();

        /**
         * Display debug messages in case if the current page has not Filter Set
         */
        if( empty( $wpManager->getQueryVar('wpc_page_related_set_ids') ) ){
            if( $debug_mode ){
                $this->_debug_messages();
            }
            return false;
        }

        $templateManager    = $container->getTemplateManager();
        $em                 = $container->getEntityManager();
        $fss                = $container->getFilterSetService();
        $urlManager         = Container::instance()->getUrlManager();

        $has_not_empty_children = [];
        $theSet                 = flrt_the_set( $set_id );

        // Display or not Filter Set in dependency from the Apply button configuration
        if( isset( $theSet['show_on_the_page'] ) && ! $theSet['show_on_the_page'] ){
            $theSet = flrt_the_set( $set_id );
        }

        if( ! $theSet ){
            return false;
        }

        $setId                  = $theSet['ID'];
        $posType                = $theSet['filtered_post_type'];
        $set                    = $fss->getSet( $theSet['ID'] );

        $chipsObj               = new Chips(true, array($setId) );
        $chips                  = $chipsObj->getChips();

        $set_edit_url           = ( isset( $theSet['ID'] )) ? admin_url('post.php?post='.$theSet['ID'].'&action=edit') : admin_url( 'edit.php?post_type=filter-set' );

        $related_filters        = $em->getSetsRelatedFilters( array( $theSet ) );
        $found_posts            = flrt_posts_found_quantity( $setId, true );
        $actionUrl              = $urlManager->getFormActionUrl(true);
        $view_args              = [ 'ask_to_select_parent' => false ];

        // Apply button preparations
        $filters_counter         = 0;
        $use_apply_button        = ( isset( $set['use_apply_button']['value'] ) && $set['use_apply_button']['value'] === 'yes' );
        $use_search_field        = ( isset( $set['use_search_field']['value'] ) && $set['use_search_field']['value'] === 'yes' );
        $apply_button_menu_order = isset( $set['apply_button_menu_order']['value'] ) ? (int) $set['apply_button_menu_order']['value'] : -1;
        $search_field_menu_order = isset( $set['search_field_menu_order']['value'] ) ? (int) $set['search_field_menu_order']['value'] : -1;

        $has_not_empty_children_flipped = [];
        $wrapper_class           = '';
        if ( flrt_is_filter_request() ) {
            $wrapper_class = ' wpc-filter-request';
        }

        if ( $horizontal ) {
            $wrapper_class .= ' wpc-horizontal-layout';
            $wrapper_class .= ' wpc-horizontal-cols-' . $cols_count;
        }

        if ( $use_apply_button ) {

            $base_permalink = '';

            if ( defined('FLRT_FILTERS_PRO') && FLRT_FILTERS_PRO ) {
                $base_permalink  = flrt_get_location_permalink( $set );
            }

            $apply_url       = $urlManager->getTermUrl( '', '', '', $base_permalink );
            $reset_url       = $urlManager->getResetUrl();
        }

        do_action( 'wpc_before_display_filters_widget', $setId, $args, $instance );

        if ( empty( $related_filters ) && ! $use_search_field ) {
            if ( $debug_mode ) {

                echo '<p class="wpc-debug-message">';
                echo sprintf(
                    wp_kses(
                        __( 'There are no filters in the Filter Set yet. Please add them to the <a href="%s">Filter Set</a> related to this page.', 'filter-everything' ),
                        array( 'a' => array('href' => true) )
                    ),
                    $set_edit_url
                );
                echo '</p>';

                flrt_debug_title();
            }
            return false;
        }

        echo $before_widget;
        echo '<div class="wpc-filters-main-wrap wpc-filter-set-'.esc_attr( $setId ).$wrapper_class.'" data-set="'.esc_attr( $setId ).'">'."\n";
        // Open/Closed status class
        $widgetContentClass = flrt_filters_widget_content_class($setId);
        $widgetContentClass .= ' wpc-show-counts-' . $set['show_count']['value'];

        if ( flrt_get_experimental_option('disable_buttons') !== 'on' ) {
            flrt_filters_button( $setId, $widgetContentClass );
        }

        if ( $use_apply_button ) {
            $widgetContentClass .= ( $theSet['query_on_the_page'] ) ? ' wpc-query-on-the-page' : ' wpc-query-not-on-the-page';
        }

        echo flrt_spinner_html();

        echo '<div class="wpc-filters-widget-content'.esc_attr($widgetContentClass).'">';
        echo '<div class="wpc-widget-close-container">
                            <a class="wpc-widget-close-icon">
                                <span class="wpc-icon-html-wrapper">
                                <span class="wpc-icon-line-1"></span><span class="wpc-icon-line-2"></span><span class="wpc-icon-line-3"></span>
                                </span>
                            </a>';

        echo '<span class="wpc-widget-popup-title">'.$popup_title.'</span>';
        echo '</div>';
        echo '<div class="wpc-filters-widget-containers-wrapper">'."\r\n";

        do_action( 'wpc_before_mobile_filters_widget', $setId, $args, $instance );

        echo '<div class="wpc-filters-widget-top-container'.esc_attr($show_selected_class).'">';
        echo '<div class="wpc-widget-top-inside">';

        // Add selected terms for mobile widget
        echo '<div class="wpc-inner-widget-chips-wrapper">';
        $templateManager->includeFrontView( 'chips', array( 'chips' => $chips, 'setid' => $setId ) );
        echo '</div>';

        echo '</div>';
        echo '</div>';

        if ( ! empty( $title ) ) {
            echo '<div class="wpc-filter-set-widget-title">'."\n";
            echo $before_title . $title . $after_title;
            echo '</div>'."\n";
        }

        echo '<div class="wpc-filters-scroll-container">';
        echo '<div class="wpc-filters-widget-wrapper">'."\r\n";

        if( $show_count ){
            flrt_posts_found( $setId );
        } else {
            echo '<div class="wpc-instead-of-posts-found"></div>';
        }

        $to = count( $related_filters );
        if ( $use_apply_button ) {
            $to += 2;
        }
        if ( $use_search_field ) {
            $to += 2;
        }

        // Add Search field and Apply Button to the array if they enabled
        //@todo if Filter Set in Free version contains filter for PRO counters are incorrect (-1 from filters count)
        // and that's why Apply button or Search field on the last position(s) may not appear
        $filters_and_fields = [];
        $related_filters    = array_reverse( $related_filters, true );
        $search_field_displayed = false;
        $apply_button_displayed = false;

        for ( $i = 1; $i <= $to; $i++ ) {
            if ( $use_apply_button && $apply_button_menu_order === $i ) {
                $filters_and_fields[-1] = array();
            } else if ( $use_search_field && $search_field_menu_order === $i ) {
                $filters_and_fields[-2] = array();
            } else {
                // To avoid "empty" filter
                if ( ! empty( $related_filters ) ) {
                    $key = array_key_last($related_filters);
                    $value = array_pop($related_filters);
                    $filters_and_fields[$key] = $value;
                }
            }
        }

        foreach ( $filters_and_fields as $filter_id => $filter ){
            $filters_counter++;

            if ( $filter_id > 0 ) {
                /**
                 * Allows the developer to modify a filter before output.
                 */
                $filter = apply_filters('wpc_filter_options_before_display', $filter, $set);

                $terms = flrt_get_filter_terms( $filter, $posType, $em );

                // Collect terms for a parent filter, if exists
                if ( $filter['parent_filter'] > 0 ) {
                    // Here we have to calculate all related with the parent filter
                    $parent_filter_id = (int)$filter['parent_filter'];
                    if ( isset( $filters_and_fields[$parent_filter_id] ) ) {
                        $parent_filter       = $filters_and_fields[$parent_filter_id];

                        $parent_filter_terms = flrt_get_filter_terms( $parent_filter, $posType, $em );
                        $wp_queried_term     = flrt_get_wp_queried_term( $parent_filter_terms );

                        if ( $wp_queried_term ) {
                            $parent_filter['values'][] = $wp_queried_term->slug;
                        }

                        if ( empty( $parent_filter['values'] ) ) {

                            // Do not show this filter, until parent is selected
                            if ( $filter['hide_until_parent'] === 'yes' && empty( $filter['values'] ) ) {
                                continue;
                            }

                            if ( ! empty( $filter['values'] ) ) {
                                $actual_filter_terms = [];
                                $filter_values_flipped = array_flip( $filter['values'] );
                                foreach ( $terms as $single_term ) {
                                    if ( isset( $filter_values_flipped[$single_term->slug] ) ) {
                                        $actual_filter_terms[] = $single_term;
                                    }
                                }
                                $terms = $actual_filter_terms;
                            } else {
                                $view_args['ask_to_select_parent'] = sprintf(esc_html__('Select %s first', 'filter-everything'), $parent_filter['label']);
                            }

                            // Here we have to setup signal that forces message "Select parent first"
                        } else {
                            if ( ! in_array( $filter['entity'], ['post_meta_num', 'tax_numeric'] ) ) {
                                // Selected values are term slugs
                                $actual_parent_filter_posts     = [];
                                $parent_filter_values_flipped   = array_flip( $parent_filter['values'] );

                                foreach ( $parent_filter_terms as $parent_filter_term ) {
                                    if ( isset( $parent_filter_values_flipped[$parent_filter_term->slug] ) ) {
                                        $actual_parent_filter_posts = array_merge($actual_parent_filter_posts, $parent_filter_term->posts);
                                    }
                                }

                                $actual_filter_terms = [];
                                // if ! empty( $filter['values'] )
                                foreach ($terms as $single_term) {
                                    $current_intersection = array_intersect($actual_parent_filter_posts, $single_term->posts);
                                    if (!empty($current_intersection)) {
                                        $actual_filter_terms[] = $single_term;
                                    }
                                }

                                $terms = $actual_filter_terms;
                            }
                        }
                    }
                } else {
                    $view_args['ask_to_select_parent'] = false;
                }

                if ( $filter['hierarchy'] === 'yes' ) {
                    $hierarchy_key = 'cross_count';
                    if ($set['hide_empty']['value'] === 'initial') {
                        $hierarchy_key = 'count';
                    }

                    $has_not_empty_children = flrt_get_parents_with_not_empty_children($terms, $hierarchy_key);
                    $has_not_empty_children_flipped = array_flip($has_not_empty_children);
                }

                // Create a list with excluded empty terms
                if (($set['hide_empty']['value'] === 'yes') || ($set['hide_empty']['value'] === 'initial') || (isset($set['hide_empty_filter']) && $set['hide_empty_filter']['value'] === 'yes')) {
                    $allWpQueriedPostIds = $em->getAllSetWpQueriedPostIds($setId);
                    $allWpQueriedPostIds_flipped = array_flip($allWpQueriedPostIds);
                    $checkTerms = $terms;

                    if ( $set['hide_empty']['value'] === 'initial' ) {
                        foreach ( $checkTerms as $index => $term ) {
                            if ($filter['hierarchy'] === 'yes') {

                                $intersection = false;
                                foreach ( $term->posts as $post_id ) {
                                    if ( isset( $allWpQueriedPostIds_flipped[$post_id] ) ) {
                                        $intersection = true;
                                        break;
                                    }
                                }

                                if ( ! $intersection && !isset( $has_not_empty_children_flipped[$term->term_id] ) ) {
                                    unset($checkTerms[$index]);
                                }

                            } else {

                                $intersection = false;
                                foreach ( $term->posts as $post_id ) {
                                    if ( isset( $allWpQueriedPostIds_flipped[$post_id] ) ) {
                                        $intersection = true;
                                        break;
                                    }
                                }

                                if ( ! $intersection ) {
                                    unset( $checkTerms[$index] );
                                }
                            }
                        }
                    } else {
                        $checkTerms = flrt_remove_empty_terms($terms, $filter, $has_not_empty_children_flipped);
                    }
                }

                // Remove empty terms, if such option is enabled
                if (
                    ($set['hide_empty']['value'] === 'yes' || $set['hide_empty']['value'] === 'initial')
                    &&
                    ! in_array( $filter['entity'], ['post_meta_num', 'tax_numeric', 'post_date'] )
                ) {
                    $terms = $checkTerms;
                }
                /**
                 * @todo we have to check this for Dates and consider if we need to hide
                 * filter by dates at all
                 */
                // Hide entire Filter if there are no posts in its terms
                if ( isset( $set['hide_empty_filter'] )
                    &&
                    $set['hide_empty_filter']['value'] === 'yes') {

                    if ( in_array( $filter['entity'], ['post_meta_num', 'tax_numeric'] ) ) {
                        // Temporary not ideal solution
                        // Sometimes it is $terms[0] sometimes $terms['max']
                        if (isset($terms[0])) {
                            if ((int)$terms[0]->max === 0 && (int)$terms[1]->min === 0) {
                                // Huh, finally
                                continue;
                            }
                        }

                        if (isset($terms['min'])) {
                            if ((int)$terms['max']->max === 0 && (int)$terms['min']->min === 0) {
                                // Huh, finally
                                continue;
                            }
                        }

                    } else if ( in_array( $filter['entity'], ['post_date', 'post_meta_date'] ) ) {
                        if ( $found_posts < 1 ) {
                            // Huh, finally
                            continue;
                        }
                    } else {
                        $checkTerms = flrt_remove_empty_terms($terms, $filter, $has_not_empty_children_flipped);
                        if (empty($checkTerms)) {
                            // Huh, finally
                            continue;
                        }
                    }
                }
                /**
                 * Extract only needed values without extra fields
                 */
                $terms = flrt_extract_objects_vars( $terms, array(
                        'term_id',
                        'slug',
                        'name',
                        'count',
                        'cross_count',
                        'max',
                        'min',
                        'from',
                        'to',
                        'time_to',
                        'time_from',
                        'parent',
                        'wp_queried'
                    )
                );

                // Hook terms before display to allow developers modify them.
                $terms = apply_filters('wpc_terms_before_display', $terms, $filter, $set, $urlManager);
                $templateManager->includeFrontView(
                /**
                 * Allows you to include your own filters template
                 */
                    apply_filters('wpc_view_include_filename', $filter['view'], $filter, $set),

                    array(
                        'filter' => $filter,
                        'terms' => $terms,
                        'set' => $set,
                        'url_manager' => $urlManager,
                        'view_args' => $view_args
                    )
                );

            } else {

                // Show Search Field if enabled
                if ( $use_search_field && $search_field_menu_order === $filters_counter) {
                    $templateManager->includeFrontView( 'search', array( 'set' => $set, 'url_manager' => $urlManager, 'wp_manager' => $wpManager ) );
                    $search_field_displayed = true;
                }

                // Show Apply button if configured
                if ( $use_apply_button && $apply_button_menu_order === $filters_counter) {
                    $templateManager->includeFrontView('apply-button', array('set' => $set, 'apply_url' => $apply_url, 'reset_url' => $reset_url));
                    $apply_button_displayed = true;
                }
            }

        } // end $related_filters foreach

        if ( $use_search_field && $search_field_displayed === false ) {
            $templateManager->includeFrontView( 'search', array( 'set' => $set, 'url_manager' => $urlManager, 'wp_manager' => $wpManager ) );
        }

        if ( $use_apply_button && $apply_button_displayed === false ) {
            $templateManager->includeFrontView('apply-button', array('set' => $set, 'apply_url' => $apply_url, 'reset_url' => $reset_url));
        }

        echo '</div>'."\r\n";
        echo '</div>' . "\r\n";
        echo '<div class="wpc-filters-widget-controls-container">
                <div class="wpc-filters-widget-controls-wrapper">';

        $templateManager->includeFrontView( 'bottom-controls', array( 'action_url' => $actionUrl, 'found_posts' => $found_posts ) );

        echo '
                </div>';

        if( $use_apply_button ){
            $templateManager->includeFrontView( 'apply-button', array( 'set' => $set, 'apply_url' => $apply_url, 'reset_url' => $reset_url ) );
        }

        echo '</div>';

        if( current_user_can( flrt_plugin_user_caps() ) ){
            echo '<div class="wpc-edit-filter-set">';
            echo sprintf(
                wp_kses(
                    __( '<a href="%s">Edit</a> Filter Set', 'filter-everything' ),
                    array( 'a' => array('href' => true) )
                ),
                $set_edit_url
            );
            echo '</div>';
        }

        do_action( 'wpc_after_mobile_filters_widget', $setId, $args, $instance );

        echo '</div>' . "\r\n";
        echo '</div>' . "\r\n"; // end .wpc-filters-widget-content
        echo '</div>'."\n"; // <!-- wpc-filters-main-wrap -->
        echo $after_widget;

        do_action( 'wpc_after_filters_widget', $args, $instance );
    }

    /**
     * Outputs the settings form for the Filters widget.
     * @since 1.0.0
     * @param array $instance Current settings.
     */
    public function form( $instance ) {

        $title      = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $show_count = isset( $instance['show_count'] ) ? (bool) $instance['show_count'] : true;
        $chips      = isset( $instance['chips'] ) ? (bool) $instance['chips'] : false;
        $horizontal = isset( $instance['horizontal'] ) ? (bool) $instance['horizontal'] : false;
        $cols_count = isset( $instance['cols_count'] ) ? $instance['cols_count'] : 3;

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>"<?php checked( $show_count ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>"><?php esc_html_e( 'Show the number of posts found', 'filter-everything' ); ?></label>
        </p>
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'chips' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'chips' ) ); ?>"<?php checked( $chips ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'chips' ) ); ?>"><?php esc_html_e( 'Show selected terms (Chips)', 'filter-everything' ); ?></label>
        </p>
        <p>
            <input type="checkbox" class="checkbox wpc-horizontal-checkbox" id="<?php echo esc_attr( $this->get_field_id( 'horizontal' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'horizontal' ) ); ?>"<?php checked( $horizontal ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'horizontal' ) ); ?>"><?php esc_html_e( 'Horizontal layout', 'filter-everything' ); ?>.</label>
            <span class="wpc-columns-wrapper">
                <label for="<?php echo $this->get_field_id( 'cols_count' ); ?>"><?php _e( 'Columns', 'filter-everything' ); ?>:</label>
                <select id="<?php echo $this->get_field_id( 'cols_count' ); ?>" name="<?php echo $this->get_field_name( 'cols_count' ); ?>">
                    <?php for ( $i = 2; $i <= 5; $i++ ) : ?>
                        <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $cols_count, $i ); ?>>
                            <?php echo esc_html( $i ); ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </span>
        </p>

        <?php if( defined('FLRT_FILTERS_PRO') && FLRT_FILTERS_PRO ) { ?>
            <p class="description"><?php esc_html_e( 'Note: filters will only show if there is Filter Set registered for a page(s)', 'filter-everything' ); echo flrt_help_tip( esc_html__('Unlike most widgets, the Filters widget does not always show filters. It is rather a canvas where filters can be displayed if there is a Filter Set registered for the page. You can specify this page or pages in the "Where to filter?" field of a Filter Set.', 'filter-everything' ), true); ?></p>
        <?php } ?>
        <?php
    }

    /**
     * Handles updating settings for the current Filters widget instance.
     * @since 1.0.0
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title']      = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['chips']      = ( !empty( $new_instance['chips'] ) ) ? 1 : 0;
        $instance['show_count'] = ( !empty( $new_instance['show_count'] ) ) ? 1 : 0;
        $instance['horizontal'] = ( !empty( $new_instance['horizontal'] ) ) ? 1 : 0;
        $instance['cols_count'] = ( $new_instance['cols_count'] > 0 ) ? $new_instance['cols_count'] : 3;

        return $instance;
    }

    /**
     * Outputs Filters widget debug messages
     * @since 1.2.2
     */
    private function _debug_messages(){
        if ( defined('FLRT_FILTERS_PRO') ) {
            echo '<p class="wpc-debug-message">';
            echo sprintf(
                wp_kses(
                    __( 'No one Filter Set is related to this page. You can configure it in the <a href="%s">Filter Set</a> -> "Where to filter?" field.', 'filter-everything' ),
                    array( 'a' => array('href' => true) )
                ),
                admin_url( 'edit.php?post_type=filter-set' )
            );
            echo '</p>';
        } else {
            if ( is_singular() ) {
                echo '<p class="wpc-debug-message">';
                echo sprintf(
                    wp_kses(
                        __( 'The free version of the plugin does not support filtering on singular pages. But <a href="%s">PRO version</a> supports.', 'filter-everything' ),
                        array( 'a' => array('href' => true) )
                    ),
                    esc_url(FLRT_PLUGIN_URL .'/?get_pro=true')
                );
                echo '</p>';
            } else {
                echo '<p class="wpc-debug-message">';
                echo sprintf(
                    wp_kses(
                        __( 'No one Filter Set is configured for this post type pages. You can create a new <a href="%s">Filter Set</a> for them.', 'filter-everything' ),
                        array( 'a' => array('href' => true) )
                    ),
                    admin_url( 'edit.php?post_type=filter-set' )
                );
                echo '</p>';
            }
        }
    }
}