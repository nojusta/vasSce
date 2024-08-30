<?php


namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class FilterSet
{
    const NONCE_ACTION          = 'wpc-f-set-nonce';

    const FIELD_NAME_PREFIX     = 'wpc_set_fields';

    private $defaultFields      = [];

    private $hooksRegistered    = false;

    private $errors;

    public function __construct()
    {
        $this->registerHooks();
    }

    private function setupDefaultFields()
    {
        // maybe add filter in future to allow change default fields
        $defaultFields = array(
            'wp_page_type' => array(
                'type'          => 'Hidden',
                'label'         => esc_html__('Where to filter?', 'filter-everything'),
                'class'         => 'wpc-field-wp-page-type',
                'id'            => $this->generateFieldId('wp_page_type'),
                'name'          => $this->generateFieldName('wp_page_type'),
                'default'       => 'common___common',
                'instructions'  => esc_html__('Specify page(s) where the Posts list should be filtered is located', 'filter-everything'),
                'settings'      => true
            ),
            'post_type' => array(
                'type'          => 'Select',
                'label'         => esc_html__('Post Type to filter', 'filter-everything'),
                'name'          => $this->generateFieldName('post_type'),
                'id'            => $this->generateFieldId('post_type'),
                'class'         => 'wpc-field-post-type',
                'options'       => $this->getPostTypes(),
                'default'       => 'post',
                'instructions'  => esc_html__('Select the Post Type you need to filter', 'filter-everything'),
                'particular'    => 'post_excerpt' // Determine that this is specific field should be stored in wp_post column
            ),
            'post_name' => array(
                'type'          => 'Hidden',
                'label'         => '',
                'name'          => $this->generateFieldName('post_name'),
                'id'            => $this->generateFieldId('post_name'),
                'class'         => 'wpc-field-location',
                'default'       => '1',
                'instructions'  => esc_html__('Specify page(s) where the Posts list should be filtered is located', 'filter-everything'),
                'particular'    => 'post_name',
                'settings'      => true
            ),
            'wp_filter_query' => array(
                'type'          => 'Hidden',
                'label'         => esc_html__('And what to filter?', 'filter-everything'),
                'class'         => 'wpc-field-wp-filter-query',
                'id'            => $this->generateFieldId('wp_filter_query'),
                'name'          => $this->generateFieldName('wp_filter_query'),
                'options'       => '',
                'default'       => '-1',
                'instructions'  => esc_html__('Determines what exactly the Posts list (WP_Query) on a page should be filtered', 'filter-everything'),
                'settings'      => true
            ),
            'hide_empty' => array(
                'type'          => 'Select',
                'label'         => esc_html__('Empty Terms', 'filter-everything'),
                'name'          => $this->generateFieldName('hide_empty'),
                'id'            => $this->generateFieldId('hide_empty'),
                'class'         => 'wpc-field-hide-empty',
                'options'       => array(
                    'no' => esc_html__('Never hide', 'filter-everything'),
                    'yes' => esc_html__('Always hide', 'filter-everything'),
                    'initial' => esc_html__('Hide in the initial Filter only', 'filter-everything')
                ),
                'default'       => 'no',
                'instructions'  => esc_html__('To hide or not Filter terms that do not contain posts', 'filter-everything'),
                'settings'      => true
            ),
            'show_count' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__('Show counters', 'filter-everything'),
                'name'          => $this->generateFieldName('show_count'),
                'id'            => $this->generateFieldId('show_count'),
                'class'         => 'wpc-field-show-count',
                'default'       => 'yes',
                'instructions'  => esc_html__('Displays the number of posts in a term', 'filter-everything'),
                'settings'      => true
            )

        );

        $this->defaultFields = apply_filters( 'wpc_filter_set_default_fields', $defaultFields, $this );
    }

    private function registerHooks()
    {
        if ( ! $this->hooksRegistered ) {
            add_filter( 'wpc_input_type_select', [ $this, 'addCustomLabel' ], 10, 2 );
            add_action( 'admin_print_scripts', [ $this, 'includeAdminJs' ], 9999 );

            add_filter( 'post_updated_messages', [ $this, 'filterSetActionsMessages' ] );
            add_filter( 'bulk_post_updated_messages', [ $this, 'filterSetBulkActionsMessages' ], 10, 2 );

            add_filter( 'page_row_actions', [ $this, 'filterSetRowActions' ], 10, 2 );

            add_action( 'restrict_manage_posts', [ $this, 'restrictManagePosts' ], 999 );

            $this->hooksRegistered = true;
        }
    }

    public function restrictManagePosts( $post_type )
    {
        if( $post_type === FLRT_FILTERS_SET_POST_TYPE ){
            $output = ob_get_clean();
            ob_start();
        }
    }

    public function filterSetRowActions( $actions, $post )
    {
        if( isset( $post->post_type ) && $post->post_type === FLRT_FILTERS_SET_POST_TYPE ){
            $new_actions = [];
            foreach( $actions as $key => $action ){
                if( in_array( $key, array( 'edit', 'trash', 'untrash', 'delete' ) ) ){
                    $new_actions[$key] = $action;
                }
            }
            return $new_actions;
        }
        return $actions;
    }

    public function filterSetBulkActionsMessages( $messages, $bulk_counts )
    {
        if( ! isset( $messages[ FLRT_FILTERS_SET_POST_TYPE ] ) ){
            $messages[ FLRT_FILTERS_SET_POST_TYPE ] = array(
                /* translators: %s: Number of posts. */
                'updated'   => esc_html( _n( '%s filter set has been updated.', '%s filter sets have been updated.', $bulk_counts['updated'], 'filter-everything' ) ),
                'locked'    => ( 1 === $bulk_counts['locked'] ) ? esc_html__( '1 The filter set has not been updated. Someone is editing it.', 'filter-everything' ) :
                    /* translators: %s: Number of posts. */
                    esc_html( _n( '%s filter set has not been updated. Someone is editing it.', '%s filter sets have not been updated. Someone is editing them.', $bulk_counts['locked'], 'filter-everything' ) ),
                /* translators: %s: Number of posts. */
                'deleted'   => esc_html( _n( '%s filter set has been permanently deleted.', '%s filter sets have been permanently deleted.', $bulk_counts['deleted'], 'filter-everything' ) ),
                /* translators: %s: Number of posts. */
                'trashed'   => esc_html( _n( '%s filter set has been moved to the Trash.', '%s filter sets have been moved to the Trash.', $bulk_counts['trashed'], 'filter-everything' ) ),
                /* translators: %s: Number of posts. */
                'untrashed' => esc_html( _n( '%s filter set has been restored from the Trash.', '%s filter sets have been restored from the Trash.', $bulk_counts['untrashed'], 'filter-everything' ) ),
            );
        }
        return $messages;
    }

    public function filterSetActionsMessages( $messages )
    {
        if( ! isset( $messages[ FLRT_FILTERS_SET_POST_TYPE ] ) ){
            // No need to escape
            $messages[ FLRT_FILTERS_SET_POST_TYPE ] = array(
                0 => '',
                1 => esc_html__( 'The Filter set has been updated.', 'filter-everything' ),
                2 => esc_html__( 'The Custom field has been updated.', 'filter-everything' ),
                3 => esc_html__( 'The Custom field has been deleted.', 'filter-everything' ),
                4 => esc_html__( 'The Filter set has been updated.', 'filter-everything' ),
                5 => false,
                6 => esc_html__( 'The Filter set has been created.', 'filter-everything' ),
                7 => esc_html__( 'The Filter set has been saved.', 'filter-everything' ),
                8 => esc_html__( 'The Filter set has been submitted.', 'filter-everything' ),
                9 => esc_html__( 'The Filter set has been scheduled for', 'filter-everything' ),
                10 => esc_html__( 'The Filter set draft has been updated.', 'filter-everything' ),
                // Errors
                11 => esc_html__('The Filter set has not been updated.', 'filter-everything')
            );
        }

        return $messages;
    }

    /**
     * @return array
     */
    private function getExistingFilterSlugs()
    {
        $existingSlugs = get_option('wpc_filter_permalinks', []);
        $convertedExistingSlugs = [];

        foreach( $existingSlugs as $entityKey => $slug ){
            $parts = explode( '#', $entityKey, 2 );
            $newEntityKey = implode('_', $parts);
            $convertedExistingSlugs[$newEntityKey] = $slug;
        }

        if( isset( $convertedExistingSlugs['post_date_post_date'] ) ){
            $convertedExistingSlugs['post_date'] = $convertedExistingSlugs['post_date_post_date'];
            unset($convertedExistingSlugs['post_date_post_date']);
        }

        return $convertedExistingSlugs;
    }

    /**
     * @return array
     */
    private function getPostTypesTaxList()
    {
        $postTypesTaxList = [];

        $taxonomies = EntityManager::getTaxonomies();
        $postTypes  = array_keys( $this->getPostTypes() );

        foreach ( $postTypes as $postType ){
            foreach ( $taxonomies as $taxonomy) {

                if( in_array( $postType, $taxonomy->object_type ) ){
                    $postTypesTaxList[$postType][] = array(
                        'name'          => 'taxonomy_' . $taxonomy->name,
                        'hierarchical'  => $taxonomy->hierarchical,
                        'label'         => ucwords( flrt_ucfirst( mb_strtolower( $taxonomy->label ) ) ),
                    );
                }
            }
        }

        return $postTypesTaxList;
    }

    public function includeAdminJs()
    {
        $screen = get_current_screen();

        if( isset( $screen->id ) && $screen->id === FLRT_FILTERS_SET_POST_TYPE ){
            global $post_id;

            // Disable autosavings
            wp_dequeue_script( 'autosave' );

            $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
            $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : FLRT_PLUGIN_VER;
//            $select2ver = '4.1.0';

            // Filter Set script
            wp_enqueue_script('wpc-filters-admin-filter-set', FLRT_PLUGIN_DIR_URL . 'assets/js/wpc-filter-set-admin'.$suffix.'.js', array('jquery', 'wp-util', 'jquery-ui-sortable', 'select2'), $ver );

            $l10n = array(
                'filterSlugs'        => $this->getExistingFilterSlugs(),
                'postTypesTaxList'   => $this->getPostTypesTaxList(),
                'swatchesTaxonomies' => flrt_get_experimental_option( 'color_swatches_taxonomies', [] ),
                'brandEntities'      => flrt_brand_filter_entities(),
                'moreOptions'        => esc_html__( 'More options', 'filter-everything' ),
                'lessOptions'        => esc_html__( 'Less options', 'filter-everything' ),
                'filtersPro'         => defined( 'FLRT_FILTERS_PRO' ),
                'wPQuerySelectId'    => $this->generateFieldId('wp_filter_query'),
                'excludePlaceholder' => esc_html__( 'Select terms and', 'filter-everything' ),
                'newFilter'          => esc_html__( 'New Filter', 'filter-everything' ),
                'addFilter'          => esc_html__( 'Please, add filters first', 'filter-everything' ),
                'selectFilter'       => esc_html__( '— Select Filter —', 'filter-everything' ),
                'numFieldNoTaxes'    => esc_html__( 'There are no taxonomies related with the selected post type', 'filter-everything' ),
                'numFieldAttrs'      => [
                    'post_meta_num' => [
                        'label'         => esc_html__(  'Meta Key', 'filter-everything' ),
                        'description'   => esc_html__( 'Name of the Custom Field. Please, see the Popular Meta keys at the bottom', 'filter-everything' ),
                        'notice'        => esc_html__( 'Note: for ACF meta fields, please use names without the "_" character at the beginning', 'filter-everything' ),
                    ],
                    'tax_numeric'   => [
                        'label'         => esc_html__(  'Taxonomy', 'filter-everything' ),
                        'description'   => esc_html__(  'Taxonomy with numeric values you need to filter by', 'filter-everything' ),
                        'notice'        => '',
                    ]
                ]
            );

            wp_localize_script( 'wpc-filters-admin-filter-set', 'wpcSetVars', $l10n );
        }
    }

    public function addCustomLabel( $html, $attributes )
    {
        if( isset( $attributes['id'] ) ){
            if( $attributes['id'] == $this->generateFieldId('post_name') ){

                $spinner        = '<span class="spinner"></span>'."\r\n";
                $openContainer  = '<div id="wpc-field-location-container"><span class="wpc-full-width">&nbsp;</span><div class="wpc-field-location-wrapper">'."\r\n";
                $closeContainer = '</div></div>'."\r\n";
                $link           = '';

                $current_index = isset( $attributes['value'] ) ? $attributes['value'] : '';
                $options = ! empty( $attributes['options'] ) ? $attributes['options'] : [];

                if( isset( $options[ $current_index ]['data-link'] ) ){
                    $link = '<a class="wpc-location-preview" href="'.esc_attr( $options[ $current_index ]['data-link'] ).'" ';
                    $link .= 'title="'.esc_attr( esc_html__('Preview the selected location in a new tab', 'filter-everything') ).'" ';
                    $link .= 'target="_blank">';
                    $link .= '<span class="dashicons dashicons-visibility"></span></a>';
                }
                $html = $spinner . $openContainer . $html . $link . $closeContainer;
            }

            if ( $attributes['id'] == $this->generateFieldId('apply_button_post_name') ) {

                $spinner        = '<span class="spinner"></span>'."\r\n";
                $openContainer  = '<div id="wpc-field-apply-button-location-container"><span class="wpc-full-width">&nbsp;</span>'."\r\n";
                $closeContainer = '</div>'."\r\n";
                $link           = '';

                $html = $spinner . $openContainer . $html . $link . $closeContainer;
            }

            if( $attributes['id'] == $this->generateFieldId('wp_filter_query') ){

                $spinner        = '<span class="spinner"></span>'."\n";
                $openContainer  = '<div id="wpc-field-wp-query-container">&nbsp;'."\n";
                $description    = '<p class="description">'.esc_html__( 'Note: if you modify the selected WP_Query on the page, please update this Filter Set', 'filter-everything' ).'</p>'."\n";
                $closeContainer = '<div id="wpc_query_vars"></div></div>'."\n";

                $html = $spinner . $openContainer . $html . $description . $closeContainer;
            }

            if( $attributes['id'] == $this->generateFieldId('wp_page_type') ){
                $label          = '<label class="wpc-location-label" for="'.esc_attr($attributes['id']).'">'.esc_html__( 'Apply filtering if the page is:', 'filter-everything' ).'</label>'."\r\n";
                $html =  $label . $html;
            }

            if( $attributes['id'] == $this->generateFieldId('apply_button_page_type') ){
                $label          = '<label class="wpc-location-label" for="'.esc_attr($attributes['id']).'">'.esc_html__( 'Show this Filter Set if the page is:', 'filter-everything' ).'</label>'."\r\n";
                $html =  $label . $html;
            }
        }

        return $html;
    }


    private function getSpecificFields( $type )
    {
        $particular = [];

        foreach( $this->getFieldsMapping() as $key => $field ){
            if( isset( $field[$type] ) && ! empty( $field[$type] ) ){
                $particular[ $key ] = $field;
            }
        }

        return $particular;
    }

    public function getPostTypes()
    {
        $allowed_types  = [];
        $post_types     = get_post_types( array( 'public' => true ), 'objects' );
        $exclude        = apply_filters( 'wpc_filter_post_types', [] );

        foreach ( $post_types as $type ){
            if( in_array( $type->name, $exclude ) ){
                continue;
            }
            $allowed_types[$type->name] = isset( $type->labels->name ) ? $type->labels->name : $type->labels->singular_name;
        }

        return $allowed_types;

    }

    public function getFieldsMapping()
    {
        return $this->defaultFields;
    }

    /**
     * @var $queriedObject object
     * @return array (empty array if there is no related set id)
     */
    public function findRelevantSets( $queriedObject )
    {
        // We need to search all relevantSetS
        $filterSets = [];

        $filterSets = apply_filters( 'wpc_relevant_set_ids', $filterSets, $queriedObject );

        if( ! empty( $filterSets ) ){
            foreach ( $filterSets as $set ){
                if( isset( $set['show_on_the_page'] ) && $set['show_on_the_page'] === true ){
                    return $filterSets;
                }
            }
        }

        // Get main filter set for post type
        if( isset( $queriedObject['post_types'] ) && ! isset( $queriedObject['post_id'] ) ){
            foreach( $queriedObject['post_types'] as $post_type ){
                $sets = $this->getSetIdForPostType( $post_type );
                if( $sets !== false ){
                    $filterSets = array_merge( $filterSets, $sets );
                }
            }
        }

        $filterSets = apply_filters( 'wpc_return_relevant_set_ids', $filterSets, $queriedObject );

        return $filterSets;
    }

    /**
     * @var $post_type string - post_type post|product|page|...
     * @return int|false
     */
    public function getSetIdForPostType( $post_type )
    {
        if( ! $post_type ){
            return false;
        }

        $container      = Container::instance();
        $sets           = [];
        $pll_lang_id    = false;

        if ( is_array( $post_type ) ) {
            $post_type = implode( "_", $post_type );
        }

        $key = 'set_' . $post_type;

        if( ! $sets = $container->getParam( $key ) ){
            global $wpdb;
            $is_fitler_set_translatable = false;

            if( flrt_wpml_active() ){
                $wpml_settings = get_option( 'icl_sitepress_settings' );
                if( isset( $wpml_settings['custom_posts_sync_option'][FLRT_FILTERS_SET_POST_TYPE] ) ){
                    if( $wpml_settings['custom_posts_sync_option'][FLRT_FILTERS_SET_POST_TYPE] === '1' ){
                        $is_fitler_set_translatable = true;
                    }
                }
            }

            $sql[] = "SELECT {$wpdb->posts}.ID,{$wpdb->posts}.post_content,{$wpdb->posts}.post_excerpt,{$wpdb->posts}.post_name";
            $sql[] = "FROM {$wpdb->posts}";

            if ( flrt_wpml_active() && defined('ICL_LANGUAGE_CODE') && $is_fitler_set_translatable ) {
                $sql[] = "LEFT JOIN {$wpdb->prefix}icl_translations AS wpml_translations";
                $sql[] = "ON {$wpdb->posts}.ID = wpml_translations.element_id";
                $sql[] = "AND wpml_translations.element_type IN(";
                $sql[] = $wpdb->prepare( "CONCAT('post_', '%s')", FLRT_FILTERS_SET_POST_TYPE );
                $sql[] = ")";
            }

            // Check common if Polylang PRO is active and Filter Set is translatable post type
            if( flrt_pll_pro_active() && defined('FLRT_ALLOW_PLL_TRANSLATIONS') && FLRT_ALLOW_PLL_TRANSLATIONS ){
                if( function_exists('pll_current_language') && function_exists('pll_the_languages') ) {
                    $pll_current_language   = pll_current_language();
                    $pll_languages          = pll_the_languages( array('raw' => 1 ) );
                    if( $pll_current_language && isset( $pll_languages[ $pll_current_language ]['id'] ) ){
                        $pll_lang_id = $pll_languages[ $pll_current_language ]['id'];

                        $sql[] = "LEFT JOIN {$wpdb->term_relationships}";
                        $sql[] = "ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id)";
                    }
                }
            }

            $sql[] = "WHERE 1=1";
            $sql[] = "AND ( {$wpdb->posts}.post_name IN ( '1' )";

            if( defined('FLRT_FILTERS_PRO') && FLRT_FILTERS_PRO ){
                $sql[] = "OR {$wpdb->posts}.ID IN ( ";
                $sql[] = "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts}";
                $sql[] = "LEFT JOIN {$wpdb->postmeta} ON ( {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id )";
                $sql[] = "WHERE 1=1";
                $sql[] = $wpdb->prepare( "AND  {$wpdb->postmeta}.meta_key = %s", FLRT_APPLY_BUTTON_META_KEY);
                $sql[] = "AND {$wpdb->postmeta}.meta_value IN ( '1' )";
                $sql[] = ")";
            }

            $sql[] = ")";
            $sql[] = $wpdb->prepare("AND {$wpdb->posts}.post_type = '%s'", FLRT_FILTERS_SET_POST_TYPE );
            $sql[] = $wpdb->prepare("AND {$wpdb->posts}.post_excerpt = '%s'", $post_type );

            $sql[] = "AND ( ({$wpdb->posts}.post_status = 'publish') )";

            if( flrt_wpml_active() && defined( 'ICL_LANGUAGE_CODE' ) && $is_fitler_set_translatable ){
                $sql[] = $wpdb->prepare("AND wpml_translations.language_code = '%s'", ICL_LANGUAGE_CODE );
            }

            if( flrt_pll_pro_active() && defined('FLRT_ALLOW_PLL_TRANSLATIONS') && FLRT_ALLOW_PLL_TRANSLATIONS ){
                if( $pll_lang_id ){
                    $sql[] = $wpdb->prepare("AND {$wpdb->term_relationships}.term_taxonomy_id IN (%d)", $pll_lang_id );
                }
            }

            $sql[] = "ORDER BY {$wpdb->posts}.menu_order DESC, {$wpdb->posts}.ID ASC";

            if( ! defined('FLRT_FILTERS_PRO') ) {
                $sql[] = "LIMIT 0, 1";
            }

            $sql = implode(' ', $sql );

            $setPosts = $wpdb->get_results( $sql, OBJECT );

            if( ! empty( $setPosts ) ){
                $sets = flrt_is_query_on_page( $setPosts, array( '1' ) );
            }else{
                return false;
            }

            $container->storeParam( $key, $sets );

        }

        return $sets;
    }

    public function validateSets( $sets )
    {
        if( ! is_array( $sets ) || empty( $sets ) ){
            return false;
        }

        foreach ( $sets as $i => $set ){
            if( ! isset( $set['ID'] ) || ! $set['ID'] ){
                return false;
            }
        }

        return true;
    }

    public function preSaveSet( $post_id, $data )
    {
        $postData = Container::instance()->getThePost();

        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if( wp_is_post_revision( $post_id ) ) {
            return $post_id;
        }

        if( $data['post_type'] !== FLRT_FILTERS_SET_POST_TYPE ) {
            return $post_id;
        }

        $nonce = filter_input( INPUT_POST, '_flrt_nonce' );

        if( ! $this->verifyNonce( $nonce ) ) {
            return $post_id;
        }

        if( ! current_user_can( flrt_plugin_user_caps() ) ) {
            return $post_id;
        }

        // Do not fire this function twice, on saving Set Fields action
        remove_action( 'pre_post_update', [$this, 'preSaveSet'], 10 );

        $set_fields_key  = self::FIELD_NAME_PREFIX;

        if( isset( $postData[$set_fields_key] ) &&  ! empty( $postData[$set_fields_key] ) ){
            $setFields          = $postData[$set_fields_key];
            $setFields['ID']    = $post_id;
            $setFields['title'] = isset( $data['post_title'] ) ? $data['post_title'] : '';

            $setFields = apply_filters( 'wpc_pre_save_set_fields', $setFields );

            $setFields = $this->sanitizeSetFields( $setFields );

            if( ! $this->validateSetFields( $setFields ) ){
                flrt_redirect_to_error( $post_id, $this->errors );
            }
        }


        return $post_id;
    }

    public function saveSet( $post_id, $post )
    {
        $postData = Container::instance()->getThePost();
        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if( wp_is_post_revision( $post_id ) ) {
            return $post_id;
        }

        if( $post->post_type !== FLRT_FILTERS_SET_POST_TYPE ) {
            return $post_id;
        }

        $nonce = filter_input( INPUT_POST, '_flrt_nonce' );

        if( ! $this->verifyNonce( $nonce ) ) {
            return $post_id;
        }

        if( ! current_user_can( flrt_plugin_user_caps() ) ) {
            return $post_id;
        }

        remove_action( 'save_post', array( $this, 'saveSet' ), 10, 2 );

        $filterFields = $this->getFilterFieldService();
        $saveFiltersTrigger = true;
        $allFiltersValid    = true;

        // Save filter fields
        if( isset( $postData['wpc_filter_fields'] ) && ! empty( $postData['wpc_filter_fields'] ) ) {

            // Validate filters
            if( ! $filterFields->validateFilters( $postData['wpc_filter_fields'] ) ) {
                $saveFiltersTrigger = false;
            }

            if( $saveFiltersTrigger ) {
                $filtersToSave = [];

                // loop
                $filterConfiguredFields = $filterFields->getFieldsMapping();
                foreach ( $postData['wpc_filter_fields'] as $filterId => $filter ) {

                    // Set up checkbox fields if they are empty
                    $filter = $filterFields->prepareFilterCheckboxFields( $filter, $filterFields->getFieldsByType( 'checkbox', $filterConfiguredFields ) );

                    // set parent
                    if ( ! $filter['parent'] ) {
                        $filter['parent'] = $post_id;
                    }

                    $filter = $filterFields->sanitizeFilterFields( $filter );
                    $filtersToSave[ $filterId ] = $filter;

                    if ( ! $filterFields->validateTheFilter( $filter, $filterId ) ) {
                        $allFiltersValid = false;
                        break;
                    }

                }

                // Loop to save
                if( $allFiltersValid ){

                    $update_after_save = [];
                    $old_new_ids       = [];

                    foreach ( $filtersToSave as $filterId => $filter ){
                        // save filter
                        $saved_filter = $filterFields->saveFilter($filter);

                        if( isset( $saved_filter['parent_filter'] ) && isset( $saved_filter['ID'] ) ){
                            if( strpos( $saved_filter['parent_filter'], 'filter_', 0 ) !== false  ){
                                $update_after_save[ $saved_filter['ID'] ][] = [
                                    'key' => 'parent_filter',
                                    'value' => $saved_filter['parent_filter']
                                ];
                            }
                            $old_new_ids[$filterId] = $saved_filter['ID'];
                        }
                    }

                    // Update data after saving Filters and getting IDs of new ones.
                    if( ! empty( $update_after_save ) ){

                        foreach ( $update_after_save as $filter_post_id => $fields_to_update ){
                            $filter_post_data = get_post( $filter_post_id );
                            $filter_data = maybe_unserialize( $filter_post_data->post_content );

                            if( ! $filter_data ){
                                continue;
                            }

                            foreach ( $fields_to_update as $field_attr ){
                                if( $field_attr['key'] === 'parent_filter' ){
                                    if( isset( $filter_data[ 'parent_filter' ] ) ){
                                        if( isset( $old_new_ids[ $field_attr['value'] ] ) ){
                                            $filter_data[ $field_attr['key'] ] = $old_new_ids[ $field_attr['value'] ];
                                        }
                                    }
                                }
                            }

                            $to_update = array(
                                'ID'			=> $filter_post_id,
                                'post_content'	=> maybe_serialize( $filter_data )
                            );

                            // Unhook wp_targeted_link_rel() filter from WP 5.1 corrupting serialized data.
                            remove_filter( 'content_save_pre', 'wp_targeted_link_rel' );
                            add_filter( 'pre_wp_unique_post_slug', 'flrt_force_non_unique_slug', 10, 2 );

                            // Slash data.
                            // WP expects all data to be slashed and will unslash it (fixes '\' character issues)
                            $to_update = wp_slash( $to_update );

                            wp_update_post( $to_update );

                            remove_filter( 'pre_wp_unique_post_slug', 'flrt_force_non_unique_slug', 10 );
                        }
                    }
                }
            }
        }

        // Save Set fields
        $set_fields_key  = self::FIELD_NAME_PREFIX;

        if( isset( $postData[$set_fields_key] ) &&  ! empty( $postData[$set_fields_key] ) ){
            $setFields          = $postData[$set_fields_key];
            $setFields['ID']    = $post_id;
            $setFields['title'] = isset( $post->post_title ) ? $post->post_title : '';

            $this->saveSetFields( $setFields );
        }

        if( ! $saveFiltersTrigger || ! $allFiltersValid ){
            flrt_redirect_to_error( $post_id, $filterFields->getErrorCodes() );
        }

        add_action( 'save_post', array( $this, 'saveSet' ), 10, 2 );

        return $post_id;
    }



    private function saveSetFields( $setFields ){
        $post_id = $setFields['ID'];

        $setFields = apply_filters( 'wpc_pre_save_set_fields', $setFields );

        $setFields = $this->sanitizeSetFields( $setFields );

        $setFields = wp_unslash( $setFields );

        // Set up checkbox fields if they are empty
        $filterFields = $this->getFilterFieldService();
        /**
         * @feature It seems we need to move methods 'prepareFilterCheckboxFields' and 'getFieldsByType'
         * to one level above to parent class
         */
        $this->setupDefaultFields();
        $setFields = $filterFields->prepareFilterCheckboxFields( $setFields, $filterFields->getFieldsByType( 'checkbox', $this->getFieldsMapping()) );
        $_setFields = $setFields;

        // Remove elements, that shouldn't be serialized
        flrt_extract_vars( $_setFields, array( 'ID', 'title', 'post_type', 'menu_order', 'post_name', 'wp_filter_query_vars' ) );
        $menu_order = isset( $setFields['menu_order'] ) ? $setFields['menu_order'] : 0;

        // Create array of data to save.
        $to_save = array(
            'ID'			    => $setFields['ID'],
            'post_status'	    => 'publish',
            'post_type'		    => FLRT_FILTERS_SET_POST_TYPE,
            'post_title'	    => $setFields['title'],
            'post_content'	    => maybe_serialize( $_setFields ),
            'post_excerpt'      => $setFields['post_type'],
            'menu_order'        => $menu_order,
            'post_name'         => $setFields['post_name']
        );

        // Unhook wp_targeted_link_rel() filter from WP 5.1 corrupting serialized data.
        remove_filter( 'content_save_pre', 'wp_targeted_link_rel' );

        $to_save = wp_slash( $to_save );

        add_filter( 'pre_wp_unique_post_slug', 'flrt_force_non_unique_slug', 10, 2 );

        // Update or Insert.
        if( $setFields['ID'] ) {
            wp_update_post( $to_save );
        } else	{
            $setFields['ID'] = wp_insert_post( $to_save );
        }

        remove_filter( 'pre_wp_unique_post_slug', 'flrt_force_non_unique_slug', 10 );
        // Update meta_fields

        update_post_meta( $setFields['ID'], 'wpc_filter_set_post_type', $setFields['post_type'] );

        $set_query_vars = NULL;
        // Save selected wp_query->query_vars
        if( isset( $setFields['wp_filter_query'] ) ){
            $filterQueryHash = $setFields['wp_filter_query'];
            if( isset( $setFields['wp_filter_query_vars'][$filterQueryHash] ) ){
                $set_query_vars = $setFields['wp_filter_query_vars'][$filterQueryHash];
            }
        }

        update_post_meta( $setFields['ID'], 'wpc_filter_set_query_vars', $set_query_vars );

        if( isset( $setFields['apply_button_post_name'] ) ){
            update_post_meta( $setFields['ID'], FLRT_APPLY_BUTTON_META_KEY, $setFields['apply_button_post_name'] );
        }

        return $setFields['ID'];
    }

    private function sanitizeSetFields( $setFields )
    {
        if( is_array( $setFields ) ){
            $sanitizedFields = [];

            foreach ( $setFields as $key => $setField ) {
                if( is_array( $setField ) ){
                    $sanitizedValue = $setField;
                }else{
                    $sanitizedValue = esc_html( $setField );
                }

                $sanitizedFields[ $key ] = $sanitizedValue;
            }

            if( isset( $sanitizedFields['menu_order'] ) ){
                $sanitizedFields['menu_order'] = flrt_sanitize_int( $sanitizedFields['menu_order'] );
                $sanitizedFields['menu_order'] = $sanitizedFields['menu_order'] ? $sanitizedFields['menu_order'] : 0;
            }

            return $sanitizedFields;
        }

        return $setFields;
    }

    private function prepareSetParameters( $set_post )
    {
        /**
         * @feature this should be not so complex. I'm ashamed of this.
         */
        if( ! isset( $set_post->ID ) ){
            return false;
        }

        $this->setupDefaultFields();
        $defaults = $this->getFieldsMapping();

        $defaults = apply_filters( 'wpc_prepare_filter_set_parameters', $defaults, $set_post );

        $unserialized = maybe_unserialize( $set_post->post_content );

        // For backward compatibility. From v.1.1.24
        if( isset( $unserialized['wp_page_type'] ) ){
            $unserialized['wp_page_type'] = str_replace(":", "___", $unserialized['wp_page_type']);
        }

        if( empty( $unserialized ) ){
            $unserialized = [];
        }

        foreach( $this->getSpecificFields( 'particular' ) as $key => $field ){
            $unserialized[$key] = $set_post->{$field['particular']};
        }

        $populated  = $this->populateValues( $unserialized, $defaults );
        $parsed     = $this->parseValues( $populated, $defaults );

        // In case if some settings field was missing
        $parsed = wp_parse_args( $parsed, $defaults );
        $parsed = apply_filters( 'wpc_filter_before_make_default_set_values', $parsed );

        // Set default values, if there is no saved
        foreach( $parsed as $field => $params ){

            if( isset( $params['particular'] ) && ! defined( 'FLRT_FILTERS_PRO' ) && $params['particular'] === 'post_name' ){
                $parsed[$field]['value'] = $params['default'];
            }

            if( $field === 'wp_page_type' && ! defined( 'FLRT_FILTERS_PRO' ) ){
                $parsed[$field]['value'] = $params['default'];
            }

            if( ! isset( $params['value'] ) && isset( $params['default'] )){
                $parsed[$field]['value'] = $params['default'];
            }
        }

        $parsed['ID'] = $set_post->ID;

        return apply_filters( 'wpc_filter_set_prepared_values', $parsed );
    }

    private function parseValues( $populated, $defaults )
    {
        $parsed = [];

        foreach ( $populated as $field_key => $values_array ){
            // In case if we have saved field, that is absent in fieldsMapping
            if( ! isset( $defaults[$field_key] ) ){
                continue;
            }

            if( isset( $values_array['value'] ) ){
                $parsed[$field_key] = wp_parse_args( $values_array, $defaults[$field_key] );
            }else{
                $parsed[$field_key] = $this->parseValues( $values_array, $defaults[$field_key] );
            }
        }

        return $parsed;
    }

    private function populateValues( $saved_values )
    {
        $transformed = [];

        foreach ( $saved_values as $field_key => $field_value ) {
            if( is_array( $field_value ) ){
                $transformed[ $field_key ] = $this->populateValues( $field_value );
            }else{
                $transformed[ $field_key ] = array( 'value' => $field_value );
            }
        }

        return $transformed;
    }

    public function getSet( $ID )
    {
        $parameters = [];

        if( ! $ID || empty( $ID ) ){
            return $parameters;
        }

        $container = Container::instance();
        $key = 'wpc_set_' . $ID;

        if( ! $set = $container->getParam( $key ) ){
            $set_post = get_post( $ID );
            /**
             * @feature add this post to cache.
             */
            $set = $this->prepareSetParameters( $set_post );
            $container->storeParam( $key, $set );
        }

        return $set;
    }

    public function validateSetFields( $setFields ){

        // Validate post_type
        if( isset( $setFields['post_type'] ) ){
            $postTypes = array_keys( $this->getPostTypes() );
            if( ! in_array( $setFields['post_type'], $postTypes, true ) ){
                $this->errors[] = 21; // Invalid post type
                return false;
            }
        } else {
            $this->errors[] = 21; // Invalid post type
            return false;
        }

        // We have to validate wp_page_type before locations field
        // because the last one expects valid wp_page_type
        if( isset( $setFields['wp_page_type'] ) ){
            $possibleWpPageType = apply_filters( 'wpc_validation_wp_page_type_entities', array('common___common') );

            if( ! in_array( $setFields['wp_page_type'], $possibleWpPageType ) ){
                $this->errors[] = 211; // Invalid WP Page Type
                return false;
            }
        }else{
            $this->errors[] = 211; // Invalid WP Page Type
            return false;
        }

        // Validate post_name aka location
        // We can not forbid to save "No WP Queries..." option
        // Because All archive pages for selected post type may not contain relevant query.
        if( isset( $setFields['post_name'] ) ){
            $flatEntities   = apply_filters( 'wpc_validation_location_entities', array('1'), $setFields );

            if( ! in_array( $setFields['post_name'], $flatEntities ) ){
                $this->errors[] = 22; // Invalid location
                return false;
            }

        } else {
            $this->errors[] = 22; // Invalid location
            return false;
        }

        //Validate wp_filter_query
        if( isset( $setFields['wp_filter_query'] ) ){
            if(
                ! preg_match('/^[a-f0-9]{32}$/', $setFields['wp_filter_query'] )
                &&
                $setFields['wp_filter_query'] !== '-1'
            ){
                $this->errors[] = 221; // Invalid WP Filter Query
                return false;
            }
        }else{
            $this->errors[] = 221; // Invalid WP Filter Query
            return false;
        }

        // Validate hide_empty
        if( isset( $setFields['hide_empty'] ) ){
            if( ! in_array( $setFields['hide_empty'], array( 'yes', 'no', 'initial' ), true ) ){
                $this->errors[] = 23; // Invalid empty field
                return false;
            }
        }

        // Validate show_count
        if( isset( $setFields['show_count'] ) ){
            if( ! in_array( $setFields['show_count'], array( 'yes', 'no' ), true ) ){
                $this->errors[] = 24; // Invalid show count
                return false;
            }
        }

        if( isset( $setFields['wp_filter_query_vars'] ) ){
            if( ! empty( $setFields['wp_filter_query_vars'] ) ){

                foreach ( $setFields['wp_filter_query_vars'] as $query_vars_serialized ){
                    if( ! is_serialized( $query_vars_serialized ) ){
                        $this->errors[] = 20; // Common Error
                        return false;
                    }
                }
            }
        }

        if( isset( $setFields['use_apply_button'] ) ){
            if( ! in_array( $setFields['use_apply_button'], array( 'yes', 'no' ), true ) ){
                $this->errors[] = 242; // Invalid show count
                return false;
            }
        }

        return $setFields;
    }

    private function getFilterFieldService()
    {
        return Container::instance()->getFilterFieldsService();
    }

    public function getPostTypeField( $post_id )
    {
        $set = $this->getSet( $post_id );
        $field['post_type'] = ( $set['post_type'] ) ? $set['post_type'] : NULL;
        return $field;
    }

    public function getSettingsTypeFields( $post_id )
    {
        $set = $this->getSet( $post_id );
        $settings_fields_map = $this->getSpecificFields('settings');

        return flrt_extract_vars($set, array_keys( $settings_fields_map ) );
    }

    public function generateFieldName( $field_name, $sub_name = '', $index = 0 ){
        $attr = self::FIELD_NAME_PREFIX . '['.$field_name.']';
        if( $sub_name ){
            $attr .= '['.$index.']['.$sub_name.']';
        }
        return $attr;
    }

    public function generateFieldId( $field_name, $sub_name = '', $index = 0 ){
        $attr = self::FIELD_NAME_PREFIX . '-' . $field_name;
        if( $sub_name ){
            $attr .= '-' . $sub_name . '-' . $index;
        }
        return $attr;
    }

    public static function createNonce()
    {
        return wp_create_nonce( self::NONCE_ACTION );
    }

    private function verifyNonce( $nonce )
    {
        return wp_verify_nonce( $nonce, self::NONCE_ACTION );
    }
}