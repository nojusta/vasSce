<?php


namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class FilterFields
{

    const FLRT_NEW_FILTER_ID = 'wpc_new_id';

    const FILTER_FIELD_KEY = 'wpc_filter_fields';

    private $defaultFields = [];

    private $fse;

    private $em;

    private $hooksRegistered = false;

    private $errors;

    public function __construct()
    {
        $this->fse = Container::instance()->getFilterService();
        $this->em  = Container::instance()->getEntityManager();
        $this->setupDefaultFields();
    }

    public function registerHooks()
    {
        if ( ! $this->hooksRegistered ) {
            add_filter( 'wpc_input_type_select', [ $this, 'addSpinnerToSelect' ], 10, 2 );
            add_filter( 'wpc_input_type_radio', [ $this, 'addSpinnerToDateFormats' ], 10, 2 );

            add_action( 'wp_ajax_wpc-delete-filter',  [ $this, 'ajaxDeleteFilter' ] );
            add_action( 'wp_ajax_wpc-load-exclude-terms', [ $this, 'sendExcludedTerms' ] );
            add_action( 'wp_ajax_wpc_get_date_formats', [ $this, 'sendDateFormats' ] );
            add_action( 'wp_ajax_wpc-validate-filters', [ $this, 'ajaxValidateFilters' ] );
            add_action( 'after_delete_post', [ $this, 'deleteRelatedFilters' ], 10, 2 );

            $this->hooksRegistered = true;
        }
    }

    private function setupDefaultFields()
    {
        // maybe add filter in future to allow change default fields
        do_action( 'wpc_before_setup_filter_fields' );
        $entity     = $this->em->getEntityByFilter( array('entity' => 'taxonomy', 'e_name' => 'category'), 'post' );
        $entityTerms = $entity->getTermsForSelect();
        asort( $entityTerms, SORT_NATURAL );

        $defaultFields = array(
            'ID' => array(
                'type'          => 'Hidden'
            ),
            'parent' => array(
                'type'          => 'Hidden'
            ),
            'menu_order' => array(
                'type'          => 'Hidden',
                'class'         => 'wpc-menu-order-field'
            ),
            'entity' => array(
                'type'          => 'Select',
                'label'         => esc_html__(  'Filter by', 'filter-everything' ),
                'class'         => 'wpc-field-entity',
                'options'       => $this->em->getPossibleEntities(),
                'default'       => 'taxonomy_category',
                'instructions'  => esc_html__(  'A thing by which posts will be filtered', 'filter-everything' ),
                'required'      => true
            ),
            'e_name' => array(
                'type'          => 'Text',
                'label'         => esc_html__(  'Meta Key', 'filter-everything' ),
                'class'         => 'wpc-field-ename',
                'instructions'  => esc_html__( 'Name of the Custom Field. Please, see the Popular Meta keys at the bottom', 'filter-everything'),
                'required'      => true
            ),
            'label' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Filter Title', 'filter-everything' ),
                'class'         => 'wpc-field-label',
                'placeholder'   => esc_html__( 'New Filter', 'filter-everything'),
                'instructions'  => esc_html__(  'Will appear in the Filters widget', 'filter-everything' )
            ),
            'slug' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Var Name for URL', 'filter-everything' ),
                'class'         => 'wpc-field-slug',
                'instructions'  => esc_html__( 'Name of a part of the URL responsible for this filter', 'filter-everything'),
                'tooltip'       => wp_kses(
                    __( 'For example, in the URL path:<br />/?color=blue&size=large<br />"color" and "size" are the names of the URL vars.<br />In the PRO version of the plugin, the URL part after "?" becomes <br />/color-blue/size-large/', 'filter-everything'),
                    array( 'br' => array() )
                ),
                'required'      => true
            ), // Optional
            'view' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'View in Widget', 'filter-everything' ),
                'class'         => 'wpc-field-view',
                'options'       => $this->getViewOptions(),
                'default'       => 'checkboxes',
                'instructions'  => '',
            ),
            'dropdown_label' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Dropdown Label', 'filter-everything' ),
                'class'         => 'wpc-field-dropdown-label',
                'default'       => '',
                'placeholder'   => esc_html__( 'e.g. - Select color -', 'filter-everything' ),
                'instructions'  => esc_html__( 'Label for the default dropdown option', 'filter-everything' ),
            ),
            'date_type'         => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Date Type', 'filter-everything' ),
                'class'         => 'wpc-date-type',
                'options'       => array(
                    'date'      => esc_html__( 'Date', 'filter-everything' ),
                    'datetime'  => esc_html__( 'Date Time', 'filter-everything' ),
                    'time'      => esc_html__( 'Time', 'filter-everything' ),
                ),
                'default'       => 'date',
                'instructions'  => '',
            ),
            'date_format'         => array(
                'type'          => 'Radio',
                'label'         => esc_html__( 'Date Format', 'filter-everything' ),
                'class'         => 'wpc-date-format',
                'options'       => $this->getDateFormatOptions(),
                'default'       => __( 'F j, Y' ),
                'instructions'  => esc_html__(  'How the date will be displayed in the Filters widget', 'filter-everything' ),
                'tooltip'       => wp_kses(
                    sprintf( __( 'More PHP date formats can be found on <a href="%1$s" target="_blank">this page</a>.', 'filter-everything' ), 'https://wordpress.org/documentation/article/customize-date-and-time-format/' ),
                    array(
                        'a' => array(
                            'href'     => true,
                        ) )
                )
            ),
            'show_term_names' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Show Term names', 'filter-everything' ),
                'class'         => 'wpc-field-show-term-names',
                'default'       => 'yes',
                'instructions'  => esc_html__(  'Term names for filters with swatches or brand images may be hidden', 'filter-everything' ),
                'tooltip'       => '',
            ),
            'logic' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Filter Logic', 'filter-everything' ),
                'class'         => 'wpc-field-logic',
                'options'       => array('or' => esc_html__('OR', 'filter-everything' ), 'and' => esc_html__('AND', 'filter-everything') ),
                'default'       => 'or',
                'instructions'  => esc_html__( 'Determines how to select posts when two or more terms of this filter are selected', 'filter-everything' ),
                'tooltip'       => wp_kses(
                    __( '«OR» means to show posts if they are at least in one of the selected terms. <br />«AND» means that posts should belong to all selected terms at the same time.', 'filter-everything' ),
                    array( 'br' => array() )
                ),
            ), // AND
            'orderby' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Sort Terms by', 'filter-everything' ),
                'class'         => 'wpc-field-orderby',
                'options'       => $this->getOrderByOptions(),
                'default'       => 'default',
                'instructions'  => esc_html__('The order in which terms appear in the widget', 'filter-everything'),
                'tooltip'       => wp_kses(
                    __( 'The "Default" option means that terms will be sorted in the order as they were received from the Database<br />The "Menu order" option is available for WooCommerce attributes only.', 'filter-everything' ),
                    array( 'br' => array() )
                )
            ),
            'in_path' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'In URL', 'filter-everything' ),
                'class'         => 'wpc-field-path',
                'default'       => 'yes',
                'instructions'  => ''
            ),
            'exclude' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Include/Exclude Terms', 'filter-everything' ),
                'class'         => 'wpc-field-exclude',
                'options'       => $entityTerms, //$entity->getTermsForSelect(),
                'multiple'      => 'multiple',
                'instructions'  => '',
                'skip_view'     => true
            ),
            'include' => array(
                'type'          => 'Select',
                'label'         => '',
                'class'         => 'wpc-field-include',
                'options'       => [ 'no' => esc_html__( 'exclude', 'filter-everything' ), 'yes' => esc_html__('include', 'filter-everything' ) ],
                'default'       => 'no',
                'instructions'  => esc_html__( 'Include selected terms only', 'filter-everything' ),
                'skip_view'     => true
            ),
            'collapse' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Folding', 'filter-everything' ),
                'class'         => 'wpc-field-collapse',
                'default'       => 'no',
                'instructions'  =>  esc_html__( 'Makes filter collapsible in the widget', 'filter-everything'),
                'tooltip'       => esc_html__( 'Useful in situations when the filter is rarely applied but takes up some space in the widget. Collapsed by default.', 'filter-everything' )
            ),
            'hierarchy' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Show Hierarchy', 'filter-everything' ),
                'class'         => 'wpc-field-hierarchy',
                'default'       => 'no',
                'instructions'  => esc_html__( 'Display the term hierarchy in the filter widget. Child terms will be collapsed by default', 'filter-everything' )
            ),
            'range_slider' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Enable Range Slider?', 'filter-everything' ),
                'class'         => 'wpc-field-range-slider',
                'default'       => 'yes',
                'instructions'  => esc_html__( 'If disabled, visitors must type numeric values in text inputs', 'filter-everything' )
            ),
            'step'      => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Slider Step', 'filter-everything' ),
                'class'         => 'wpc-field-value-step',
                'instructions'  => esc_html__( 'Determines how the numeric value will be changed when you move slider controls', 'filter-everything' ),
                'tooltip'       => wp_kses(
                    __('Step 1 means possible values are 1,2,3,4 ...<br />Step 0.1 means possible values are 5.1, 5.2, 5.3, 5.4 ...<br />Step 15 means possible values are 15, 30, 45, 60...', 'filter-everything'),
                    array( 'br' => array() )
                ),
                'default'       => 1
            ),
            'search' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Terms Search', 'filter-everything' ),
                'class'         => 'wpc-field-search',
                'default'       => 'no',
                'instructions'  => esc_html__( 'Adds a search field that allows you to quickly find filter terms', 'filter-everything' )
            ),
            'parent_filter' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Parent Filter', 'filter-everything' ),
                'class'         => 'wpc-field-parent-filter',
                'options'       => [ 'no' => esc_html__( 'Please, add filters first', 'filter-everything' ) ],
                'instructions'  => esc_html__( 'If specified, current Filter terms become available only after the parent Filter selected', 'filter-everything' )
            ),
            'hide_until_parent' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Hide until the Parent selected', 'filter-everything' ),
                'class'         => 'wpc-field-hide-until-parent',
                'default'       => 'no',
                'instructions'  => esc_html__( 'Do not show this Filter until a parent is selected. Useful for step-by-step filtering', 'filter-everything' )
            ),
            'min_num_label' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Labels for Chips', 'filter-everything' ),
                'class'         => 'wpc-field-min-num-label',
                'default'       => '',
                'placeholder'   => esc_html__( 'e.g. From {value}', 'filter-everything' ),
                'instructions'  => '',
                'skip_view'     => true,
            ),
            'max_num_label' => array(
                'type'          => 'Text',
                'label'         => '',
                'class'         => 'wpc-field-max-num-label',
                'default'       => '',
                'placeholder'   => esc_html__( 'e.g. To {value}', 'filter-everything' ),
                'instructions'  => '',
                'skip_view'     => true,
            ),
            'tooltip' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Tooltip', 'filter-everything' ),
                'class'         => 'wpc-field-tooltip',
                'instructions'  => esc_html__( 'Will appear next to the Filter Title', 'filter-everything' ),
                'default'       => ''
            ),
            'more_less' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'More/Less', 'filter-everything' ),
                'class'         => 'wpc-field-more-less',
                'default'       => 'no',
                'instructions'  => sprintf( esc_html__( 'Show a toggle link after %s terms', 'filter-everything' ), flrt_more_less_count() )
            ),
            'show_chips' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Show in Chips', 'filter-everything' ),
                'class'         => 'wpc-field-show-chips',
                'default'       => 'yes',
                'instructions'  => esc_html__( 'Show filter selected terms in the list of all chosen items', 'filter-everything' )
            ),
            'acf_fields' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'ACF Fields', 'filter-everything' ),
                'class'         => 'wpc-field-acf',
                'default'       => '',
                'instructions'  => esc_html__( 'Contains the IDs of ACF fields that are related to the Custom Field', 'filter-everything' )
            )
        );

        $this->defaultFields = apply_filters( 'wpc_filter_default_fields', $defaultFields, $this );
    }

    public static function getViewOptions()
    {
        $viewOptions = array(
            'checkboxes'    => esc_html__('Checkboxes', 'filter-everything'),
            'radio'         => esc_html__('Radio buttons', 'filter-everything'),
            'labels'        => esc_html__('Labels list', 'filter-everything'),
            'dropdown'      => esc_html__('Dropdown', 'filter-everything'),
            'range'         => esc_html__('Numeric range', 'filter-everything'),
            'date'          => esc_html__('Date range', 'filter-everything'),
        );

        return $viewOptions;
    }

    public static function getDateFormatOptions( $type = 'date' )
    {
        switch( $type ){
            case 'date':
                $F_j_Y = date_i18n( __( 'F j, Y' ) );
                $d_m_Y = date_i18n( 'd/m/Y' );
                $m_d_Y = date_i18n( 'm/d/Y' );

                $formatOptions = array(
                    __( 'F j, Y' ) => '<span>' . $F_j_Y . '</span><code>'.__( 'F j, Y' ).'</code>',
                    'd/m/Y'  => '<span>' . $d_m_Y . '</span><code>d/m/Y</code>',
                    'm/d/Y'  => '<span>' . $m_d_Y . '</span><code>m/d/Y</code>',
                );

                break;
            case 'datetime':
                $F_j_Y = date_i18n( __('F j, Y g:i a') );
                $d_m_Y = date_i18n( 'd/m/Y g:i a' );
                $m_d_Y = date_i18n( 'm/d/Y g:i a' );

                $formatOptions = array(
                    __('F j, Y g:i a') => '<span>' . $F_j_Y . '</span><code>'.__('F j, Y g:i a').'</code>',
                    'd/m/Y g:i a'  => '<span>' . $d_m_Y . '</span><code>d/m/Y g:i a</code>',
                    'm/d/Y g:i a'  => '<span>' . $m_d_Y . '</span><code>m/d/Y g:i a</code>',
                );
                break;
            case 'time':
                $g_i_a = date_i18n( __('g:i a') );
                $H_i_s = date_i18n( 'H:i:s' );

                $formatOptions = array(
                    __('g:i a') => '<span>' . $g_i_a . '</span><code>'.__('g:i a').'</code>',
                    'H:i:s' => '<span>' . $H_i_s . '</span><code>H:i:s</code>',
                );
                break;
        }

        $formatOptions['other'] = '<span>' . esc_html__( 'Custom:', 'filter-everything' ) . '</span>';

        return $formatOptions;
    }

    public function getOrderByOptions()
    {
        $orderBy = array(
            'default'       => esc_html__( 'Default (no sorting)', 'filter-everything' ),
            'nameasc'       => esc_html__( 'Term name &laquo;abc&raquo;', 'filter-everything' ),
            'postcountasc'  => esc_html__( 'Posts count &laquo;123&raquo;', 'filter-everything' ),
            'idasc'         => esc_html__( 'Term ID &laquo;123&raquo;', 'filter-everything' ),
            'menuasc'       => esc_html__( 'Menu order &laquo;123&raquo;', 'filter-everything' ),
            'namedesc'      => esc_html__( 'Term name &laquo;cba&raquo;', 'filter-everything' ),
            'postcountdesc' => esc_html__( 'Posts count &laquo;321&raquo;', 'filter-everything' ),
            'iddesc'        => esc_html__( 'Term ID &laquo;321&raquo;', 'filter-everything' ),
            'menudesc'      => esc_html__( 'Menu order &laquo;321&raquo;', 'filter-everything' )
        );

        return $orderBy;
    }

    public function getFieldsByType($type, $configuredFields = [] )
    {
        $selected = [];
        $type = ucfirst($type);

        foreach ( $configuredFields as $key => $field) {
            if ( isset( $field['type'] ) && ( $field['type'] === $type ) ) {
                $selected[$key] = $field;
            }
        }

        return $selected;

    }

    private function getFilterNames( $set_id )
    {
        $filternames = [];

        if( ! $set_id ){
            return $filternames;
        }

        $filters = $this->em->selectOnlySetFilters( $set_id );

        if( ! empty( $filters ) ) {
            if ( count( $filters ) > 1 ) {
                $filternames['-1'] = esc_html__( '— Select Filter —', 'filter-everything' ) ;
            } else {
                $filternames['no'] = esc_html__( 'Please, add filters first', 'filter-everything' );
            }

            foreach ( $filters as $filter ) {

                if ( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric', 'post_date' ] ) ) {
                    continue;
                }

                if ( isset( $filter['ID'] ) ) {
                    $filternames[ $filter['ID'] ] = $filter['label'] .' (' . $filter['e_name'] .')';
                }
            }
        }

        return $filternames;
    }

    public function getEmptyFilterObject( $set_id )
    {
        $defaults = new \stdClass();
        $defaults->ID = self::FLRT_NEW_FILTER_ID;
        $defaults->post_parent = '';
        $defaults->menu_order = 0;
        $defaults->post_title = '';
        $defaults->post_content = '';
        $defaults->post_name = '';

        $filter = $this->em->prepareFilter( $defaults );

        return $this->prepareFilterInputsToDisplay( $filter, $this->getFilterNames( $set_id ) );
    }

    public function getFiltersInputs( $set_id )
    {
        $preparedFilters = [];

        if( ! $set_id || empty( $set_id ) ){
            return $preparedFilters;
        }

        $filters = $this->em->selectOnlySetFilters( $set_id );
        foreach ( $filters as $field_key => $filter ){
            $preparedFilters[] = $this->prepareFilterInputsToDisplay( $filter, $this->getFilterNames( $set_id ) );
        }

        return $preparedFilters;
    }

    private function prepareFilterInputsToDisplay( $filter, $filternames )
    {
        $postTypes  = false;
        $terms      = [];
        // Used for filter table class in filter set fields.
        // E.g. post_meta, taxonomy, author.

        $short_entity   = $filter['entity'] ? $filter['entity'] : 'taxonomy';

        if ( $short_entity === 'taxonomy' ) {
            // Add hierarchical class
            if ( is_taxonomy_hierarchical( $filter['e_name'] ) ) {
                $short_entity .= ' taxonomy-hierarchical';
            }

            // Add product attribute class
            if ( strpos( $filter['e_name'], 'pa_' ) === 0 ) {
                $short_entity .= ' taxonomy-product-attribute';
            }

            if ( flrt_get_experimental_option('use_color_swatches') === 'on' ) {
                $taxonomies = flrt_get_experimental_option( 'color_swatches_taxonomies', [] );

                if ( in_array( $filter['e_name'], $taxonomies ) ) {
                    $short_entity .= ' taxonomy-has-swatches';
                }
            }
        }

        if ( in_array( $filter['e_name'], flrt_brand_filter_entities() ) ) {
            $short_entity .= ' wpc-filter-has-brands';
        }

        $short_entity .= isset( $filter['view'] ) ? ' wpc-view-'.$filter['view'] : '';

        $belongs = $this->filterBelongsToPostType( $filter['parent'], $filter['entity'], $filter['e_name'] );

        $postType = '';
        // For post_meta_num entity postType is critical value so we have to set it up
        if ( in_array( $filter['entity'], array( 'post_meta_num', 'post_meta_exists' ) ) ) {
            $fss  = Container::instance()->getFilterSetService();
            $set =  $fss->getSet( $filter['parent'] );
            if( isset( $set['post_type']['value'] ) ){
                $postType = $set['post_type']['value'];
            }
        }

        $entity = $this->em->getEntityByFilter( $filter, $postType );

        if( $entity ){
            $terms = $entity->getTermsForSelect();
            asort( $terms, SORT_NATURAL );
        }

        // This is required only for filter fields inputs
        $filter = $this->fse->combineEntityNameInFilter( $filter );

        foreach( $this->getFieldsMapping() as $fieldKey => $fieldData ){

            if ( isset( $filter[$fieldKey] ) ) {

                if ( $fieldKey === 'parent_filter' ) {
                    // Exclude current filter
                    if ( isset( $filternames[ $filter['ID'] ] ) ) {
                        unset( $filternames[ $filter['ID'] ] );
                    }

                    if ( ! empty( $filternames ) ) {
                        $fieldData['options'] = $filternames;
                    }
                }

                $default_value = isset( $fieldData['default'] ) ? $fieldData['default'] : '';

                $multiple = ( $fieldKey === 'exclude' && ! in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric', 'post_date' ] ) );

                $fieldData['name']     = $this->generateInputName( $filter['ID'], $fieldKey, $multiple );
                $fieldData['id']       = $this->generateInputID( $filter['ID'], $fieldKey );

                $fieldData['value']    = ( $filter[$fieldKey] ) ? $filter[$fieldKey] : $default_value;

                if( $fieldKey === 'hide_until_parent' ){
                    if( $filter['parent_filter'] > 0 ){
                        $fieldData['additional_class'] = 'wpc-opened';
                    }
                }

                if ( $fieldKey === 'slug' && $fieldData['value'] ) {
                    $fieldData['readonly'] = 'readonly';
                }

                if ( $fieldKey === 'e_name' && $fieldData['value'] ) {
                    unset( $fieldData['options'] );
                    $fieldData['readonly']  = 'readonly';
                    $fieldData['type']      = 'Text';

                    if ( $filter['entity'] === 'tax_numeric' ) {
                        $fieldData['label']        = esc_html__(  'Taxonomy', 'filter-everything' );
                        $fieldData['instructions'] = esc_html__(  'Taxonomy with numeric values you need to filter by', 'filter-everything' );
                    }
                }

                if( $fieldKey === 'entity' ) {
                    $fieldData['short_entity'] = $short_entity;

                    if ( $filter['ID'] === self::FLRT_NEW_FILTER_ID ) {
                        $fieldData['entity_belongs'] = true;
                    } else {
                        $fieldData['entity_belongs'] = $belongs;
                    }

                    // Add instead-entity field
                    if( $filter['ID'] !== self::FLRT_NEW_FILTER_ID ){

                        /**
                         * @feature maybe move this to separate method
                         * @bug slug wasn't saved for new filter
                         */
                        // For existing filters we need to forbid changing entity value
                        // And we need to show input instead select
                        $fieldData['type'] = 'Text';
                        // To make it compatible with Text field
                        unset( $fieldData['options'] );
                        // Forbid to edit field
                        $fieldData['readonly'] = 'readonly';

                        $flatEntities = $this->em->getFlatEntities();

                        $insteadEntityVal = isset( $flatEntities[ $fieldData['value'] ] ) ? $flatEntities[ $fieldData['value'] ] : '';

                        if( $fieldData['value'] === 'post_meta_exists' && ! defined('FLRT_FILTERS_PRO') ){
                            $insteadEntityVal = esc_html__('Available in PRO', 'filter-everything');
                        }

                        if( $fieldData['value'] === 'tax_numeric' && ! defined('FLRT_FILTERS_PRO') ){
                            $insteadEntityVal = esc_html__('Available in PRO', 'filter-everything');
                        }

                        // Field, that will be visible instead of entity, that will be hidden.
                        $prepared[ 'instead-entity' ] = $this->getInsteadEntityField( $filter['ID'], $insteadEntityVal );

                    }

                    if ( $filter['ID'] === self::FLRT_NEW_FILTER_ID ) {
                        if ( ! defined('FLRT_FILTERS_PRO') ) {
                            $fieldData['disabled'] = array( 'post_meta_exists', 'tax_numeric' );
                        }
                    }

                }

                if( $fieldKey === 'exclude' ){
                    // We always add terms even they are empty array to fill Select2 with related terms.
                    $fieldData['options'] = $terms;

                    if( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric', 'post_date' ] ) ) {
                        $fieldData['options'] = [];
                    }
                }

                // Set disabled fields for some situations
                if( in_array( $filter['entity'], array( 'author_author', 'post_meta_exists' ) ) /* $filter['entity'] === 'author_author'*/ && $fieldKey === 'logic' ){
                    $fieldData['disabled'] = array('and');
                }

                if( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric', 'post_date' ] ) && $fieldKey === 'logic' ){
                    $fieldData['disabled'] = array('or');
                }

                if ( $fieldKey === 'view' ) {
                    if ( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) ) {
                        $fieldData['disabled'] = array(
                            'checkboxes',
                            'dropdown',
                            'radio',
                            'labels',
                            'date',
                            'colors',
                            'image',
                        );
                    } else if ( in_array( $filter['entity'], [ 'post_date' ] ) ) {
                        $fieldData['disabled'] = array(
                            'checkboxes',
                            'dropdown',
                            'radio',
                            'labels',
                            'range',
                            'colors',
                            'image',
                        );
                    } else {
                        $fieldData['disabled'] = array(
                            'range',
                            'date',
                        );
                    }
                }

                if( $fieldKey === 'orderby' ) {
                    if ( $filter['entity'] !== 'taxonomy_product_cat' && ( mb_strpos( $filter['entity'], 'taxonomy_pa' ) === false ) ){
                        $fieldData['disabled'] = ['menuasc', 'menudesc'];
                    }
                }

                if ( ( $filter['ID'] === self::FLRT_NEW_FILTER_ID || $filter['entity'] === 'post_date' ) && $fieldKey === 'date_format' ) {
                    // This can be new filter or existing
                    $date_type         = $filter['date_type'] ? $filter['date_type'] : 'date';
                    $dateFormatOptions = $this->getDateFormatOptions( $date_type );
                    $disabled_custom = true;
                    $value_to_custom = $fieldData['value'];

                    if ( ! in_array( $value_to_custom, self::getPossibleDateFormats( $date_type ) ) ) {
                        $disabled_custom    = false;
                        $fieldData['value'] = 'other';
                    }

                    $customFormatField = '</label><label>' . $this->addCustomDateFormatField( $fieldData['name'], $value_to_custom, $disabled_custom );
                    $dateFormatOptions['other'] = str_replace( '</span>', '</span>' . $customFormatField, $dateFormatOptions['other'] );

                    $fieldData['options'] = $dateFormatOptions;
                }
            }

            $prepared[ $fieldKey ] = $fieldData;
        }

        return $prepared;
    }

    public function sanitizeFilterFields( $filter )
    {
        if( is_array( $filter ) ){
            $sanitizedFilter = [];
            $not_esc_html    = [ 'e_name', 'tooltip' ];

            foreach( $filter as $key => $value ){

                if( in_array( $key, $not_esc_html, true ) ){
                    // Why? because meta_key field can contain any different characters
                    $sanitizedFilter[ $key ] = $value;
                }else{

                    if( is_array( $value ) ){
                        array_map( 'esc_html', $value );
                        $sanitizedFilter[ $key ] = $value;
                    } else {
                        $sanitizedFilter[ $key ] = esc_html( $value );
                    }

                }
            }

            if( isset( $sanitizedFilter['menu_order'] ) ){
                $sanitizedFilter['menu_order'] = flrt_sanitize_int( $sanitizedFilter['menu_order'] );
            }

            if( isset( $sanitizedFilter['label'] ) ){
                $sanitizedFilter['label'] = sanitize_text_field( $sanitizedFilter['label'] );
            }

            if( isset( $sanitizedFilter['slug'] ) ){
                $sanitizedFilter['slug'] = preg_replace( '/[^a-z0-9\-\_]+/', '', mb_strtolower($sanitizedFilter['slug']) );
                $sanitizedFilter['slug'] = trim($sanitizedFilter['slug'], '-');
            }

            if( isset( $sanitizedFilter['step'] ) ){
                $sanitizedFilter['step'] = preg_replace('/[^\d\.]+/', '', $sanitizedFilter['step'] );
                if( ! $sanitizedFilter['step'] ){
                    $sanitizedFilter['step'] = 1;
                }
            }

            if( isset( $sanitizedFilter['tooltip'] ) ){
                $sanitizedFilter['tooltip'] = wp_kses(
                    $sanitizedFilter['tooltip'],
                    array(
                        'br'        => array(),
                        'span'      => array('class' => true, 'id' => true),
                        'em'        => array(),
                        'strong'    => array('class' => true),
                        'i'         => array(),
                        'b'         => array()
                    )
                );
            }

            return $sanitizedFilter;
        }

        return $filter;
    }

    public function validateTheFilter( $filter, $id = false ) {

        $valid          = true;
        $validEntity    = true;
        $validator      = new Validator();

        if( $filter['ID'] === self::FLRT_NEW_FILTER_ID ) {
            $filterID  = $id;
        }else{
            $filterID  = $filter['ID'];
        }

        // Check all fields are our fields
        $defaultFields = $this->getFieldsMapping();
        // To make compatible with this field
        $defaultFields['instead-entity'] = true;

        foreach( $filter as $fieldKey => $fieldValue ){
            if( ! isset( $defaultFields[ $fieldKey ] ) ){
                $this->pushError(32); // Invalid fields present
                $valid = false;
            }
        }

        /**
         * Check required field data, that should be not empty
         */
        if( isset( $filter['ID'] ) ){
            // We need to check post type for current ID otherwise we can override any existing post
            if( $filter['ID'] !== self::FLRT_NEW_FILTER_ID ){
                $savedFilter = get_post( $filter['ID'] );

                // Filter post doesn't exist
                if( ! $savedFilter ){
                    $this->pushError(33); // Invalid filter ID
                    $valid = false;
                }
                // Other post type
                if( ! isset( $savedFilter->post_type ) || $savedFilter->post_type !== FLRT_FILTERS_POST_TYPE ){
                    $this->pushError(33); // Invalid filter ID
                    $valid = false;
                }
            }

        } else {
            $this->pushError(33); // Invalid filter ID
            $valid = false;
        }

        /**
         * Parent field aka Set ID
         */
        if( isset( $filter['parent'] ) ){

            if( $filter['ID'] !== self::FLRT_NEW_FILTER_ID ) {
                $savedSet = get_post($filter['parent']);

                // Set post doesn't exist
                if (!$savedSet) {
                    $this->pushError(34); // Invalid Set ID
                    $valid = false;
                }
                // Other post type
                if ( ! isset( $savedSet->post_type ) || $savedSet->post_type !== FLRT_FILTERS_SET_POST_TYPE) {
                    $this->pushError(34); // Invalid Set ID
                    $valid = false;
                }
            }

        }else{
            $this->pushError( 34); // Invalid Set ID
            $valid = false;
        }

        /**
         * Entity
         */
        if( isset( $filter['entity'] ) ){
            if( ! $validator->validatePossibleEntity( $filter['entity'] ) ){
                $this->pushError( 35, $filterID, 'entity' ); // Invalid Entity
                $this->pushError( 35, $filterID, 'instead-entity' );
                $validEntity = false;
                $valid = false;
            }

        }else{
            $this->pushError( 35, $filterID, 'entity' ); // Invalid Entity
            $this->pushError( 35, $filterID, 'instead-entity' );
            $validEntity = false;
            $valid = false;
        }

        /**
         * Slug validations
         */
        if( isset( $filter['slug'] ) ){
            $existingSlugs = get_option('wpc_filter_permalinks', []);
            $prefix = $filter['slug'];

            // Check this only for new filters
            if( $filter['ID'] === self::FLRT_NEW_FILTER_ID && $validEntity ) {
                $fs = Container::instance()->getFilterService();
                $newEntityKey = $fs->getEntityKey($filter['entity'], $filter['e_name']);
                // Prohibit using the same slug for another entity
                if (!$validator->validateExistingPrefix($prefix, $existingSlugs, $newEntityKey)) {
                    $this->pushError( 36, $filterID, 'slug' ); // Prefix is already used
                    $valid = false;
                }
            }

            // Ensure, that prefix contains at least one alphabetic character
            // Also this prevents from empty prefix
            if ( ! $validator->validateAlphabCharsExists( $prefix ) ) {
                $this->pushError( 37, $filterID, 'slug' ); // Invalid prefix. Has to contain at least one alphabetic symbol
                $valid = false;
            }

            // Check hyphens problem when cat and cat-x exists
            if ( ! $validator->validatePrefixHyphens( $prefix, $existingSlugs ) ) {
                $this->pushError( 39, $filterID, 'slug' ); // Invalid prefix. Incorrect hyphens.
                $valid = false;
            }

            // Check for slugs, that matches with native WP Entities
            if ( ! $validator->validateAllowedPrefixes( $prefix, $filter ) ) {
                $errorCode = 3991;
                if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) {
                    $errorCode = 399;
                }
                $this->pushError( $errorCode, $filterID, 'slug' ); // Invalid prefix. Equal to wp entity.
                $valid = false;
            }

        } else {
            $this->pushError( 38, $filterID, 'slug' ); // Invalid prefix. Empty.
            $valid = false;
        }

        /**
         * E_name validations
         */
        if ( isset( $filter['e_name'] ) ) {

            if( isset( $filter['entity'] ) ) {
                if ( in_array( $filter['entity'], array( 'post_meta', 'post_meta_num', 'post_meta_exists', 'tax_numeric' ) ) ) {
                    $e_name = $filter['e_name'];

                    if ( $e_name === '' ) {
                        $this->pushError( 401, $filterID, 'e_name' ); // Select or Enter meta key.
                        $valid = false;
                    } else {

                        if ( $filter['entity'] === 'tax_numeric' ) {
                            // Validate taxonomy
                            $taxonomies      = $this->em->getPossibleTaxonomies();
                            $taxonomy_e_name = $filter[ 'e_name' ];

                            if( mb_strpos( $filter[ 'e_name' ], 'taxonomy_' ) === false ){
                                $taxonomy_e_name = 'taxonomy_' . $filter[ 'e_name' ];
                            }

                            if ( ! isset( $taxonomies[ $taxonomy_e_name ] ) ) {
                                $this->pushError( 402, $filterID, 'e_name' ); // Invalid E_name.
                                $valid = false;
                            }
                        } else {
                            // Should not be empty and should contain at least one alphabetic character
                            if ( ! $validator->validateAlphabCharsExists( $e_name ) ) {
                                $this->pushError( 40, $filterID, 'e_name' ); // Invalid E_name.
                                $valid = false;
                            }

                            // Should not contain characters that escaped by esc_attr
                            if ( ! $validator->validateEscAttrCharacters( $e_name ) ) {
                                $this->pushError( 40, $filterID, 'e_name' ); // Invalid E_name.
                                $valid = false;
                            }

                            // Some meta keys should be prohibited to use
                            $excludedMetaKeys = flrt_get_forbidden_meta_keys();
                            if ( in_array( $e_name, $excludedMetaKeys, true ) ) {
                                $this->pushError(  40, $filterID, 'e_name' ); // Invalid E_name.
                                $valid = false;
                            }
                        }
                    }
                }

                if ( in_array( $filter['e_name'], array( 'post_date', 'post_meta_date' ) ) ) {

                    if ( isset( $filter['date_format'] ) && isset( $filter['date_type'] ) ) {

                        $date_time = flrt_split_date_time( $filter['date_format'] );

                        switch ( $filter['date_type'] ) {
                            case 'date':
                                // check for date
                                if ( ! $date_time['date'] ) {
                                    $this->pushError(  60, $filterID, 'date_format' ); // Invalid date_format.
                                    $valid = false;
                                }
                                break;
                            case 'datetime':
                                if ( ! $date_time['date'] || ! $date_time['time'] ) {
                                    $this->pushError(  62, $filterID, 'date_format' ); // Invalid date_format.
                                    $valid = false;
                                }
                                break;
                            case 'time':
                                if ( ! $date_time['time'] ) {
                                    $this->pushError(  61, $filterID, 'date_format' ); // Invalid date_format.
                                    $valid = false;
                                }
                                break;
                        }

                    }
                }
            }

        }else{
            $this->pushError( 40, $filterID, 'e_name' ); // Invalid E_name.
            $valid = false;
        }

        /**
         * View validations
         */
        if( isset( $filter['view'] ) ){
            $viewOptions = array_keys( $this->getViewOptions() );

            if( ! $validator->validateView( $filter, $viewOptions ) ){
                $this->pushError( 41, $filterID, 'view' ); // Invalid View.
                $valid = false;
            }

        } else {
            $this->pushError( 41, $filterID, 'view' ); // Invalid View.
            $valid = false;
        }

        /**
         * Date Type validations
         */
        if ( isset( $filter['date_type'] ) ) {
            if( ! in_array( $filter['date_type'], array( 'date', 'datetime', 'time' ), true ) ){
                $this->pushError( 411, $filterID, 'date_type' ); // Invalid Data Type
                $valid = false;
            }
        }

        /**
         * Logic validations
         */
        if( isset( $filter['logic'] ) ){

            if( ! in_array( $filter['logic'], array( 'or', 'and' ), true ) ){
                $this->pushError( 42, $filterID, 'logic' ); // Invalid Logic.
                $valid = false;
            }

            // For author and post_meta_exists entities logic can be only OR
            if( in_array( $filter['entity'], array( 'author_author', 'post_meta_exists' ) )  ){
                if( $filter['logic'] !== 'or' ){
                    $this->pushError( 45, $filterID, 'logic' ); // Not acceptable logic.
                    $valid = false;
                }
            }

            // For author entity logic can be only OR
            if ( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric', 'post_date' ] ) ) {
                if( $filter['logic'] !== 'and' ){
                    $this->pushError( 47, $filterID, 'logic' ); // Not acceptable logic.
                    $valid = false;
                }
            }

        } else {
            $this->pushError( 42, $filterID, 'logic' ); // Invalid Logic.
            $valid = false;
        }

        /**
         * Orderby validations
         */
        if( isset( $filter['orderby'] ) ){
            $orderBy = array_keys( $this->getOrderByOptions() );
            if( ! in_array( $filter['orderby'], $orderBy, true ) ){
                $this->pushError( 43, $filterID, 'orderby' ); // Invalid Orderby.
                $valid = false;
            }
        } else {
            $this->pushError( 43, $filterID, 'orderby' ); // Invalid Orderby.
            $valid = false;
        }

        /**
         * In path and Collapse doesn't require validations
         * because their values are prepended in code
         */

        /**
         * Exclude validations
         */
        if( isset( $filter['exclude'] ) && $validEntity ){
            if( ! $validator->validateExcludeTerms( $filter['exclude'], $filter ) ){
                $this->pushError( 44, $filterID, 'exclude' ); // Invalid Exclude.
                $valid = false;
            }
        }

        if( isset( $filter['include'] ) ){
            if( ! in_array( $filter['include'], ['yes', 'no'] ) ){
                $this->pushError( 441, $filterID, 'exclude' ); // Invalid Exclude.
                $valid = false;
            }
        }

        // In case when checkbox is not checked there is no $_POST['in_path'] parameter
        if( isset( $filter['in_path'] ) ){
            if( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric', 'post_date' ] ) && $filter['in_path'] === 'yes' ){
                $this->pushError( 46, $filterID, 'in_path' ); // Invalid In Path for Post meta num.
                $valid = false;
            }
        }

        // Check data types if they are correct
        /**
         * @todo validate range_slider, show_chips, step fields !!! IMPORTANT
         */

        // Check combinations of different data
        /**
         * The unique slug and entity problem
         */
        // The slug and entity pair should be the same between all filters in all sets!
        // Otherwise we will have different slugs and URLs in different categories for the same Post type.
        // If user adding new slug for the same entity, it should be notified, that this new slug
        // will be changed for all same entities.

        // Obligatorily sanitize all data. Maybe separate method for that.
        // If entity is taxonomy, field e_name should be empty.

        // Filter slugs should not be from blacklist. Blacklist - typical Wordpress entities /categories, tags etc

        // Slugs should be checked for non UTF symbols and maybe converted to latin UTF symbols
        // Because user can add slug = категория and also user can add slug 'cheap' where 'c' will be cyrillic or other.

        return $valid;
    }

    public function validateFilters( $filters ) {

        if ( ! $filters ) {
            return false;
        }
        $valid = true;

        // Check permissions
        if ( ! current_user_can( flrt_plugin_user_caps() ) ) {
            // An error occurred. You do not have permission to edit this.
            $this->pushError(202);
            $valid = false;
        }

        // Check for equal filters
        foreach ( (array) $filters as $filter ) {
            if( isset( $filter['entity'] ) && isset( $filter['e_name'] ) ) {
                // To avoid few filters with the same meta key
                if ( in_array( $filter['entity'], array( 'post_meta', 'post_meta_num', 'post_meta_exists' ), true ) ) {
                    $keys[] = 'post_meta' . $filter['e_name'];
                } elseif ( $filter['entity'] === 'tax_numeric' || $filter['entity'] === 'post_date' ) {
                    $keys[] = $filter['entity'] .'_'. $filter['e_name'];
                } else {
                    $keys[] = $filter['entity'] . $filter['e_name'];
                }
            }
        }

        if ( flrt_array_contains_duplicate( $keys ) ) {
            $this->pushError(31); // Equal filters
            $valid = false;
        }

        return apply_filters( 'wpc_validate_filter_fields', $valid, $this );
    }

    public function ajaxValidateFilters()
    {
        $postData   = Container::instance()->getThePost();
        $data       = isset( $postData['validateData'] ) ? $postData['validateData'] : false;
        $response   = [];

        if( ! $data ){
            $this->pushError(20);
        }

        if( ! isset( $data['_flrt_nonce'] ) || ! wp_verify_nonce( $data['_flrt_nonce'], FilterSet::NONCE_ACTION ) ){
            $this->pushError(20); // Default common error
        }

        // Validate all filters
        // If no one filter it's ok
        if( isset( $data['wpc_filter_fields'] ) ){

            $this->validateFilters( $data['wpc_filter_fields'] );

            // Set up checkbox fields if they are empty
            $filterConfiguredFields = $this->getFieldsMapping();

            // Validate each filter separately
            foreach ( (array) $data['wpc_filter_fields'] as $filterId => $filter ) {
                $filter = $this->prepareFilterCheckboxFields($filter, $this->getFieldsByType('checkbox', $filterConfiguredFields));
                $this->validateTheFilter( $filter, $filterId );
            }

        }


        $this->fillErrorsMessages();
        $errors = $this->getErrors();
        // Send errors if they exist
        if( $errors && ! empty( $errors ) ){
            $response['errors'] = $errors;
            wp_send_json_error($response);
        }

        /**
         * @feature it is better to validate all fields and collect all errors to show them simultaneously.
         */

        wp_send_json_success();
    }

    function saveFilter( $filter ) {
        // May have been posted. Remove slashes.
        $filter = wp_unslash( $filter );

        $filter = apply_filters( 'wpc_pre_save_filter', $filter );

        unset( $filter['instead-entity'] );
        // Make a backup of field data and remove some args.
        $_filter = $filter;
        flrt_extract_vars( $_filter, array( 'ID', 'label', 'parent', 'menu_order', 'slug' ) );

        $_filter = $this->fse->splitEntityFullNameInFilter( $_filter );

        // Create array of data to save.
        $to_save = array(
            'ID'			=> $filter['ID'],
            'post_status'	=> 'publish',
            'post_type'		=> FLRT_FILTERS_POST_TYPE,
            'post_title'	=> $filter['label'],
            'post_content'	=> maybe_serialize( $_filter ),
            'post_parent'	=> $filter['parent'],
            'menu_order'	=> $filter['menu_order'] ? $filter['menu_order'] : 0,
            'post_name'     => $filter['slug'],
            'post_excerpt'  => $filter['entity']
        );

        // Unhook wp_targeted_link_rel() filter from WP 5.1 corrupting serialized data.
        remove_filter( 'content_save_pre', 'wp_targeted_link_rel' );

        do_action( 'wpc_pre_save_post_filter', $to_save, $filter );

        add_filter( 'pre_wp_unique_post_slug', 'flrt_force_non_unique_slug', 10, 2 );

        // Slash data.
        // WP expects all data to be slashed and will unslash it (fixes '\' character issues).
        $to_save = wp_slash( $to_save );

        // Update or Insert.
        if( $filter['ID'] === self::FLRT_NEW_FILTER_ID ){
            $filter['ID'] = wp_insert_post( $to_save );
        }else{
            wp_update_post( $to_save );
        }

        remove_filter( 'pre_wp_unique_post_slug', 'flrt_force_non_unique_slug', 10 );

        // Return field.
        return $filter;
    }

    public function prepareFilterCheckboxFields( $filter, $configuredFields = [] )
    {
        foreach ( $configuredFields as $key => $checkbox ){
            if( ! isset( $filter[ $key ] ) ){
                $filter[ $key ] = 'no';
            }else{
                $filter[ $key ] = 'yes';
            }
        }

        return $filter;
    }

    public function getFieldsMapping()
    {
        return $this->defaultFields;
    }

    public function deleteFilter( $ID, $force = false )
    {
        if( ! $ID ){
            return false;
        }

        if( $force ){
            return wp_delete_post( $ID, true );
        }else{
            return wp_trash_post( $ID );
        }

    }

    public function deleteRelatedFilters( $postid, $post )
    {
        if( $post->post_type !== FLRT_FILTERS_SET_POST_TYPE ){
            return $postid;
        }

        $args = array(
            'post_type'         => FLRT_FILTERS_POST_TYPE,
            'posts_per_page'    => -1,
            'post_parent'       => $postid,
            'post_status'		=> array('any'),
        );

        $setFilters = get_posts( $args );

        if( ! empty( $setFilters ) ){
            foreach ( $setFilters as $filter ) {
                $this->deleteFilter( $filter->ID, true );
            }
        }

        return $postid;
    }

    public function ajaxDeleteFilter()
    {
        $postData   = Container::instance()->getThePost();
        $filterId   = isset( $postData['fid'] ) ? $postData['fid'] : false;
        if( $filterId === self::FLRT_NEW_FILTER_ID ){
            wp_send_json_success();
        }

        $nonce          = isset( $postData['_wpnonce'] ) ? $postData['_wpnonce'] : false;
        $errorResponse  = array(
            'fid' => $filterId,
            'message' => esc_html__('An error occurred. Please, refresh the page and try again.', 'filter-everything')
        );

        if( ! wp_verify_nonce( $nonce, FilterSet::NONCE_ACTION ) ){
            wp_send_json_error( $errorResponse );
        }

        if( ! $filterId ){
            wp_send_json_error( $errorResponse );
        }

        $filter = get_post( $filterId );

        if( ! isset( $filter->post_type ) || ( $filter->post_type !== FLRT_FILTERS_POST_TYPE ) ){
            wp_send_json_error( $errorResponse );
        }

        if( $filterPost = $this->deleteFilter( $filterId, true ) ){
            $response['fid'] = $filterPost->ID;
            wp_send_json_success( $response );
        }else{
            wp_send_json_error( $errorResponse );
        }
    }

    public static function getPossibleDateFormats( $date_type )
    {
        $possibleFormats = [
            'date' => array(
                'd/m/Y',
                'm/d/Y',
                __('F j, Y'),
            ),
            'datetime' => array(
                'd/m/Y g:i a',
                'm/d/Y g:i a',
                __('F j, Y g:i a'),
            ),
            'time' => array(
                __('g:i a'),
                'H:i:s',
            )
        ];

        if ( isset( $possibleFormats[$date_type] ) ) {
            return $possibleFormats[$date_type];
        }

        return [];
    }

    private function addCustomDateFormatField( $name, $value, $disabled = false )
    {
        $html = '<input type="text" name="'.$name.'" value="'.$value.'"';
        if ( $disabled ) {
            $html .= ' disabled="disabled"';
        }

        $html .= ' class="wpc-date-custom-format" />';

        return $html;
    }

    public function sendDateFormats()
    {
        $postData   = Container::instance()->getThePost();
        $filterId   = isset( $postData['fid'] ) ? $postData['fid'] : false;
        $setId      = isset( $postData['setId'] ) ? $postData['setId'] : false;
        $dateType   = isset( $postData['dateType'] ) ? $postData['dateType'] : false;

        $errorResponse  = array(
            'fid' => $filterId,
            'message' => esc_html__('An error occurred. Please, refresh the page and try again.', 'filter-everything')
        );

        if ( ! $filterId || ! $dateType ) {
            wp_send_json_error( $errorResponse );
        }

        $response = [];

//        $savedValue = $this->em->getFilterBy( 'ID', $filterId, array( array( 'ID' => $setId ) ) );
        $savedValue = $this->em->getFilterById( $filterId );
        $formatoptions = self::getDateFormatOptions( $dateType );

        $field = [
            'type'          => 'Radio',
            'class'         => 'wpc-date-format',
            'default'       => __( 'F j, Y' ),
        ];

        $default_formats = [
            'date'     => __( 'F j, Y' ),
            'datetime' => __('F j, Y g:i a'),
            'time'     => __('g:i a'),
        ];

        $disabled_custom = true;
        $value_to_custom = ( $savedValue['date_format'] && $dateType === $savedValue['date_type'] ) ? $savedValue['date_format'] : $default_formats[$dateType];
        if ( $value_to_custom && ! in_array( $value_to_custom, self::getPossibleDateFormats( $dateType ) ) ) {
            $disabled_custom = false;
            $field['value']  = 'other';
        }

        $customFormatField = '</label><label>' . $this->addCustomDateFormatField( $this->generateInputName( $filterId, 'date_format' ), $value_to_custom, $disabled_custom );
        $formatoptions['other'] = str_replace( '</span>', '</span>' . $customFormatField, $formatoptions['other'] );

        $field['name']      = $this->generateInputName( $filterId, 'date_format' );
        $field['id']        = $this->generateInputID( $filterId, 'date_format' );
        $field['options']   = $formatoptions;

        ob_start();

        echo flrt_render_input( $field );

        $response['html'] = ob_get_clean();

        wp_send_json_success( $response );
        die();
    }

    public function sendExcludedTerms()
    {
        $container  = Container::instance();
        $postData   = $container->getThePost();
        $validator  = new Validator();
        $filterId   = isset( $postData['fid'] ) ? $postData['fid'] : false;
        $nonce      = isset( $postData['_wpnonce'] ) ? $postData['_wpnonce'] : false;
        $entity     = isset( $postData['entity'] ) ? $postData['entity'] : false;
        $e_name     = isset( $postData['ename'] ) ? $postData['ename'] : false;

        $errorResponse  = array(
            'fid' => $filterId,
            'message' => esc_html__('An error occurred. Please, refresh the page and try again.', 'filter-everything')
        );

        if( ! wp_verify_nonce( $nonce, FilterSet::NONCE_ACTION ) ){
            wp_send_json_error( $errorResponse );
        }

        if( ! $validator->validatePossibleEntity( $entity ) ){
            wp_send_json_error( $errorResponse );
        }

        $em = $container->getEntityManager();
        if( $e_name ){
            $filterEntity['entity'] = $entity;
            $filterEntity['e_name'] = $e_name;
        }else{
            $fse = $container->getFilterService();
            $filterEntity = $fse->splitEntityFullNameInFilter( array( 'entity' => $entity ) );
        }

        $entity = $em->getEntityByFilter( $filterEntity );
        $terms  = $entity->getTermsForSelect2();

        if( ! empty( $terms ) ){
            $response['terms']  = $terms;
            $response['fid']    = $filterId;
            wp_send_json_success( $response );
        }else{
            wp_send_json_error( $errorResponse );
        }

    }

    public function addSpinnerToDateFormats( $html, $attributes )
    {
        if ( isset( $attributes['class'] ) && $attributes['class'] === 'wpc-date-format' ) {
            $spinner        = '<span class="spinner"></span>'."\r\n";
            $openContainer  = '<div class="wpc-after-spinner-container">'."\r\n";

            $closeContainer = '</div>'."\r\n";

            if ( isset( $attributes['options']['d/m/Y'] ) ) {
                $date_type = 'wpc-type-date';
            }

            if ( isset( $attributes['options']['d/m/Y g:i a'] ) ) {
                $date_type = 'wpc-type-datetime';
            }

            if ( isset( $attributes['options']['H:i:s'] ) ) {
                $date_type = 'wpc-type-time';
            }

            $html = str_replace( 'wpc-radio-list', 'wpc-radio-list ' . $date_type, $html );

            $html = $spinner . $openContainer . $html . $closeContainer;
        }
        return $html;
    }

    public function addSpinnerToSelect( $html, $attributes )
    {
        if( isset( $attributes['class'] ) ){
            $requiredIds = array(
                $this->generateInputID( self::FLRT_NEW_FILTER_ID, 'exclude' ),
            );

            if( in_array( $attributes['id'], $requiredIds ) ){

                $spinner        = '<span class="spinner"></span>'."\r\n";
                $openContainer  = '<div class="wpc-after-spinner-container">'."\r\n";

                $closeContainer = '</div>'."\r\n";

                $html = $spinner . $openContainer . $html . $closeContainer;

            }
        }
        return $html;
    }

    private function getInsteadEntityField( $filterId, $insteadEntityVal )
    {
        $insteadEntity = array(
            'type'          => 'Text',
            'label'         => esc_html__( 'Filter by', 'filter-everything' ),
            'class'         => 'wpc-field-instead-entity',
            'name'          => $this->generateInputName( $filterId, 'instead-entity' ),
            'id'            => $this->generateInputID( $filterId, 'instead-entity' ),
            'value'         => $insteadEntityVal,
            'readonly'      => 'readonly',
            'default'       => '',
            'instructions'  => esc_html__( 'A thing by which posts will be filtered', 'filter-everything'),
            'tooltip'       => esc_html__( 'An already selected value cannot be changed. But you can always delete the current one and create a new filter if you need.', 'filter-everything' ),
            'required'      => true
        );

        return $insteadEntity;
    }


    /**
     * @return true|false
     */
    public function filterBelongsToPostType( $parent, $entity, $e_name )
    {
        if( ! isset( $parent ) ){
            return false;
        }

        $fss  = Container::instance()->getFilterSetService();
        $set =  $fss->getSet( $parent );

        if( ! isset( $set['post_type']['value'] ) ){
            return false;
        }

        $post_type = $set['post_type']['value'];

        return $this->entityBelongsToPostType( $post_type, $entity, $e_name );
    }

    /**
     * @return true|false
     */
    private function entityBelongsToPostType( $post_type, $entity, $e_name )
    {
        if ( empty( $post_type ) ){
            return false;
        }

        if( in_array( $entity, array(
            'author',
            'post_date',
            'post_meta',
            'post_meta_num',
            'post_date',
            ) ) ){
            return true;
        }

        if( in_array( $entity, array( 'post_meta_exists', 'tax_numeric' ) ) && defined( 'FLRT_FILTERS_PRO' ) ){
            return true;
        }

        if( $entity === 'taxonomy' || $entity === 'tax_numeric' ){
            if ( $entity === 'tax_numeric' ) {
                if ( ! defined( 'FLRT_FILTERS_PRO' ) ) {
                    return false;
                }
                // We have to cut e_name to make correct verification
                if ( mb_strpos( $e_name, 'taxonomy_' ) !== false ) {
                    $e_name = mb_strcut( $e_name, strlen( 'taxonomy_' ) );
                }
            }

            return $this->isTaxonomyBelongsToPostType( $post_type, $e_name );
        }

        return false;
    }

    public function getErrorMessage( $code = 20 )
    {
        $messages = $this->getErrorsList();

        if( isset( $messages[$code] ) ){
            return $messages[$code];
        }

        return $messages[20];
    }

    public function pushError( $errorCode, $filterId = false, $filterKey = '' )
    {
        $to_add = true;
        $error  = array(
            'code' => $errorCode
        );

        if( $filterId && $filterKey ){
            $error['id'] = $this->generateInputID( $filterId, $filterKey );
        }

        if ( ! empty( $this->errors ) ) {
            foreach ( $this->errors as $single_error ) {
                if ( isset( $single_error['code'] ) && $single_error['code'] == $errorCode ) {
                    $to_add = false;
                    break;
                }
            }
        }

        if ( $to_add ) {
            $this->errors[] = $error;
            return $error;
        }

        return false;
    }

    public function getErrors()
    {
        if( ! empty( $this->errors ) ) {
            return $this->errors;
        }

        return false;
    }

    public function fillErrorsMessages()
    {
        if( ! empty( $this->errors ) ){
            $errorsWithMessages = [];
            $messagesList = $this->getErrorsList();

            foreach ( $this->errors as $index => $error ){
                if( isset( $error['code'] ) && isset( $messagesList[ $error['code'] ] ) ){
                    $errorsWithMessages[$index] = $error;
                    $errorsWithMessages[$index]['message'] =  $messagesList[ $error['code'] ];
                }
            }

            $this->errors = $errorsWithMessages;
            return true;
        }

        return false;
    }

    public function getErrorCodes()
    {
        $codes = [];

        if( ! empty( $this->errors ) ){
            foreach( $this->errors as $error ){
                $codes[] = $error['code'];
            }
        }

        return $codes;
    }


    /**
     * @return true|false
     */
    private function isTaxonomyBelongsToPostType( $post_type, $taxonomy = null )
    {
        if ( is_object( $post_type ) )
            $post_type = $post_type->post_type;

        if ( empty( $post_type ) ){
            return false;
        }

        $taxonomies = get_object_taxonomies( $post_type );

        return in_array( $taxonomy, $taxonomies );
    }

    public function generateInputID( $ID, $key )
    {
        return self::FILTER_FIELD_KEY . '-' . $ID . '-' . $key;
    }

    public function generateInputName( $ID, $key, $multiple = false )
    {
        $name = self::FILTER_FIELD_KEY . '['. $ID .']['. $key . ']';
        if( $multiple ){
            $name .= '[]';
        }
        return $name;
    }

    public static function getErrorsList()
    {
        $errors = array(
            // Set errors
            20 => esc_html__('An error occurred. Filter Set fields were not saved, please try again.', 'filter-everything'),
            201 => esc_html__('An error occurred. SEO Rule fields were not saved, please try again.', 'filter-everything'),
            202 => esc_html__('An error occurred. You do not have permission to edit this.', 'filter-everything'),
            211 => esc_html__( 'Error: invalid WP Page type.', 'filter-everything' ),
            21 => esc_html__( 'Error: invalid post type.', 'filter-everything' ),
            22 => esc_html__( 'Error: invalid value of the Where to filter? field.', 'filter-everything' ),
            221 => esc_html__( 'Error: invalid query.', 'filter-everything' ),
            23 => esc_html__( 'Error: invalid Hide empty field.', 'filter-everything' ),
            24 => esc_html__( 'Error: invalid Show count field.', 'filter-everything' ),
            242 => esc_html__( 'Error: invalid «Apply Button» mode field.', 'filter-everything' ),
//            241 => esc_html__( 'Error: invalid Order field.', 'filter-everything' ),
            // Filters errors
            31 => esc_html__( 'Error: two or more filters with equal Filter By and Meta key values are forbidden in the same Set. Please, remove or change equal filters.', 'filter-everything' ),
            32 => esc_html__( 'Error: invalid fields present.', 'filter-everything' ),
            33 => esc_html__( 'Error: invalid filter ID.', 'filter-everything' ),
            34 => esc_html__( 'Error: invalid set ID.', 'filter-everything' ),
            35 => esc_html__( 'Error: invalid filter entity.', 'filter-everything' ),
            36 => esc_html__( 'Error: filter prefix is already used for another entity.', 'filter-everything' ),
            37 => esc_html__( 'Error: filter prefix should have at least one alphabetic symbol.', 'filter-everything' ),
            38 => esc_html__( 'Error: filter prefix should not be empty.', 'filter-everything' ),
            39 => esc_html__( 'Error: prefix part before "-" character can not be equal to another existing prefix.', 'filter-everything' ),
            399 => esc_html__( 'Error: this prefix is not allowed because it matches a taxonomy or term name already used on your site. Please use a different prefix.', 'filter-everything' ),
            3991 => esc_html__( 'Error: var name is not allowed because it matches a taxonomy or term name already used on your site.', 'filter-everything' ),
            40 => esc_html__( 'Error: invalid Meta key value', 'filter-everything' ),
            401 => esc_html__( 'Error: you must enter Meta Key', 'filter-everything' ),
            402 => esc_html__( 'Error: invalid Taxonomy', 'filter-everything' ),
            41 => esc_html__( 'Error: invalid View parameter.', 'filter-everything' ),
            411 => esc_html__( 'Error: invalid Date Type parameter.', 'filter-everything' ),
            42 => esc_html__( 'Error: invalid Logic parameter', 'filter-everything' ),
            43 => esc_html__( 'Error: invalid the Sort Terms by parameter', 'filter-everything' ),
            44 => esc_html__( 'Error: invalid exclude terms', 'filter-everything' ),
            441 => esc_html__( 'Error: invalid include checkbox value', 'filter-everything' ),
            45 => esc_html__( 'Error: for filter Post Author logic OR is acceptable only.', 'filter-everything' ),
            46 => esc_html__( 'Error: numeric filter can not be in the URL path.', 'filter-everything' ),
            47 => esc_html__( 'Error: only AND logic is supported for numeric filters.', 'filter-everything' ),
            48 => esc_html__( 'Error: Range slider is acceptable for Post Meta Num filters only.', 'filter-everything' ),
            50 => esc_html__( 'Error: SEO Rule must have specified Post Type.', 'filter-everything' ),
            51 => esc_html__( 'Error: SEO Rule must contain at least one filter.', 'filter-everything' ),
            52 => esc_html__( 'Error: all SEO data fields could not be empty.', 'filter-everything' ),
            53 => esc_html__( 'Error: invalid or forbidden filter presents.', 'filter-everything' ),
            54 => esc_html__( 'Error: invalid SEO Rule ID.', 'filter-everything' ),
            55 => esc_html__( 'Error: SEO rule with selected Filters Combination already exists.', 'filter-everything' ),
            60 => esc_html__( 'Error: Invalid date format.', 'filter-everything' ),
            61 => esc_html__( 'Error: Invalid time format.', 'filter-everything' ),
            62 => esc_html__( 'Error: Invalid date or time format.', 'filter-everything' ),
            90 => wp_kses(
                sprintf(
                    __('Error: you can not update settings because the Filter Everything Pro plugin is locked. Please, enter your <a href="%1$s" target="_blank">license key</a> to unlock it.', 'filter-everything' ),
                    admin_url( 'edit.php?post_type=filter-set&page=filters-settings&tab=license' ) ),
                array(
                    'a' => array(
                        'href'=> true,
                        'target' => true
                    )
                )
            ),
            91 => esc_html__('Error: you can not update settings because the Filter Everything Pro plugin is locked. Please, ask your site Superadmin to enter the plugin license key to unlock it.', 'filter-everything' ),

        );

        return $errors;
    }
}