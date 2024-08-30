<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class PostMetaNumEntity implements Entity
{
    public $items           = [];

    public $entityName      = '';

    public $excludedTerms   = [];

    public $isInclude       = false;

    public $new_meta_query  = [];

    public $postTypes       = [];

    public function __construct( $postMetaName, $postType ){
        /**
         * @feature clean code from unused methods
         */

        $this->entityName = $postMetaName;
        $this->setPostTypes( array($postType) );
    }

    public function setPostTypes( $postTypes = false )
    {
        $wpManager          = Container::instance()->getWpManager();
        $wpQueriedObject    = $wpManager->getQueryVar('wp_queried_object');

        if ($postTypes) {
            $this->postTypes = $postTypes;
        }elseif( ! empty( $wpQueriedObject['post_types'] ) ){
            $this->postTypes = $wpQueriedObject['post_types'];
        }else{
            $this->postTypes = array('post');
        }

        if( flrt_is_woocommerce()
            && in_array( 'product', $this->postTypes )
            && ! in_array( 'product_variation', $this->postTypes ) ){
            $this->postTypes[] = 'product_variation';
        }

        $this->getAllExistingTerms();
    }

    public static function inputName( $slug, $edge = 'min' )
    {
        return $edge . '_' . $slug;
    }

    public function setExcludedTerms( $excludedTerms, $isInclude )
    {
        $this->excludedTerms = $excludedTerms;
        $this->isInclude     = $isInclude;
    }

    public function getName()
    {
        return $this->entityName;
    }

    function excludeTerms( $terms )
    {
        return $terms;
    }

    function getTerms()
    {
        return $this->excludeTerms( $this->getAllExistingTerms() );
    }

    /**
     * @param int $id term id
     * @return false|object term object of false
     */
    public function getTerm( $termId ){
        if( ! $termId ){
            return false;
        }

        foreach ( $this->getTerms() as $term ){
            if( $termId == $term->term_id ){
                return $term;
            }
        }

        return false;
    }

    public function getTermId( $slug )
    {
        /**
         * Post meta num value has no typical ID, so slug will be instead
         */
        return $slug . '_' . $this->getName();
    }

    /**
     * @return array list of term_id and names useful to create Select dropdown
     */
    public function getTermsForSelect()
    {
        $toSelect = [];
        foreach ( $this->getTerms() as $term ) {
            $toSelect[$term->slug] = $term->name;
        }

        return $toSelect;
    }

    public function getTermsForSelect2()
    {
        $toSelect = [];
        foreach ( $this->getTerms() as $term ) {
            $toSelect[] = array( 'id' => $term->slug, 'text' =>$term->name );
        }

        return $toSelect;
    }

    function getAllExistingTerms( $force = false )
    {
        if( empty( $this->items ) || $force ) {
            $this->items = $this->selectTerms();
        }
        return $this->items;
    }

    public function isDecimal( $step = 0, $value = 0 )
    {
        if( strpos( $step, '.') !== false ){
            return true;
        }

        if( strpos( $value, '.') !== false ){
            return true;
        }

        return false;
    }

    function populateTermsWithPostIds( $setId, $post_type )
    {
        // Does nothing. It was already done before.
    }

    /**
     * @param array $alreadyFilteredPosts
     * @return array
     */
    public function selectTerms( $alreadyFilteredPosts = [] ) {
        global $wpdb;

        $IN             = false;
        $key_in         = '';
        $new_result     = [];
        $min_and_max    = [
            'min' => 0,
            'max' => 0
        ];
        $post_and_types = [];
        $translatable_post_type_exists = false;

        /**
         * Set Post types
         */
        if( ! empty( $this->postTypes ) && isset($this->postTypes[0]) && $this->postTypes[0] ){
            foreach ( $this->postTypes as $postType ){
                $key_in .= '_' . $postType;
                $pieces[] = $wpdb->prepare( "%s", $postType );
            }

            $IN = implode(", ", $pieces );
        }

        /**
         * Set transient key
         */
        $transient_key = flrt_get_terms_transient_key( 'post_meta_num_'. $this->getName() . $key_in );

        if ( false === ( $result = get_transient( $transient_key ) ) ) {
            // Get all post meta values
            $sql[] = "SELECT {$wpdb->postmeta}.post_id,{$wpdb->postmeta}.meta_value,{$wpdb->posts}.post_type";
            $sql[] = "FROM {$wpdb->postmeta}";
            $sql[] = "LEFT JOIN {$wpdb->posts} ON ({$wpdb->postmeta}.post_id = {$wpdb->posts}.ID)";

            /**
             * If post type is translatable with WPML, get post meta values only with current language
             */
            if( flrt_wpml_active() && defined( 'ICL_LANGUAGE_CODE' ) ){

                $wpml_settings = get_option( 'icl_sitepress_settings' );

                foreach ( $this->postTypes as $type ) {
                    if( isset( $wpml_settings['custom_posts_sync_option'][$type] ) ){
                        if( $wpml_settings['custom_posts_sync_option'][$type] === '1' ){
                            $translatable_post_type_exists = true;
                            break;
                        }
                    }
                }

                if ( $translatable_post_type_exists ) {
                    $sql[] = "LEFT JOIN {$wpdb->prefix}icl_translations AS wpml_translations";
                    $sql[] = "ON {$wpdb->postmeta}.post_id = wpml_translations.element_id";

                    if (!empty($this->postTypes)) {

                        $sql[] = "AND wpml_translations.element_type IN(";

                        foreach ($this->postTypes as $type) {
                            $LANG_IN[] = $wpdb->prepare("CONCAT('post_', '%s')", $type);
                        }
                        $sql[] = implode(",", $LANG_IN);

                        $sql[] = ")";
                    }
                }
            }
            /**
             * There is NULL problem because posts with meta_value = '' are also included in the list
             * And condition (NULL <= 0) is true
             * */
            $sql[] = "WHERE {$wpdb->postmeta}.meta_key = %s";

            if( $IN ){
                $sql[] = "AND {$wpdb->posts}.post_type IN( {$IN} )";
            }

            if( flrt_wpml_active() && defined( 'ICL_LANGUAGE_CODE' ) && $translatable_post_type_exists ){

                $sql[] = $wpdb->prepare("AND wpml_translations.language_code = '%s'", ICL_LANGUAGE_CODE);
            }

            $sql = implode(' ', $sql);

            $e_name     = wp_unslash( $this->entityName );
            $sql        = $wpdb->prepare( $sql, $e_name );

            /**
             * Filters terms SQL-query and allows to modify it
             */
            $sql        = apply_filters( 'wpc_filter_get_post_meta_num_terms_sql', $sql, $e_name );

            $result     = $wpdb->get_results( $sql, ARRAY_A );

            $clean_from_non_numeric = [];
            foreach ( $result as $single_post ) {
                if ( preg_match( '/[^\d\.\-]+/', $single_post['meta_value'] ) ) {
                    continue;
                }

                $clean_from_non_numeric[] = $single_post;
            }
            $result = $clean_from_non_numeric;

            set_transient( $transient_key, $result, FLRT_TRANSIENT_PERIOD_HOURS * HOUR_IN_SECONDS );
        }

        if( ! empty( $result ) ) {

            $postsIn_flipped = array_flip( $alreadyFilteredPosts );
            $wpManager      = Container::instance()->getWpManager();
            $queried_values = $wpManager->getQueryVar( 'queried_values', [] );
            $filter_slug    = false;

            /**
             * Check if this filter was queried
             */
            foreach ( $queried_values as $slug => $filter ) {
                if ( $filter[ 'e_name' ] === $this->getName() ) {
                    $filter_slug = $slug;
                    break;
                }
            }

            $max = false;
            $min = false;

            /**
             * If this filter was queried we have to receive its $max and $min values
             */
            if ( $filter_slug ) {
                if ( isset( $queried_values[ $filter_slug ][ 'values' ][ 'max' ] ) ) {
                    $max  = (float) $queried_values[ $filter_slug ][ 'values' ][ 'max' ];
                    $max  = apply_filters( 'wpc_unset_num_shift', $max, $this->getName() );
                }

                if ( isset( $queried_values[ $filter_slug ][ 'values' ][ 'min' ] ) ) {
                    $min  = (float) $queried_values[ $filter_slug ][ 'values' ][ 'min' ];
                    $min  = apply_filters( 'wpc_unset_num_shift', $min, $this->getName() );
                }
            }

            foreach ( $result as $single_post ) {
                /**
                 * If there are already filtered posts, we have to skip posts
                 * that are out of the queried list
                 */
                if( ! empty( $alreadyFilteredPosts ) ) {
                    if( ! isset( $postsIn_flipped[ $single_post['post_id'] ] ) ) {
                        continue;
                    }
                }

                /**
                 * We have to generate and fill two arrays
                 * First to detect $min and $max values
                 * Second to map post_types with post IDs
                 */
                $new_result[] = (float) $single_post['meta_value'];

                if ( $min !== false && $single_post['meta_value'] < $min ){
                    continue;
                }

                if ( $max !== false && $single_post['meta_value'] > $max ){
                    continue;
                }

                $post_and_types[ $single_post['post_id'] ] = $single_post['post_type'];
            }

        }

        if( ! empty( $new_result ) ){
            $min_and_max = [
                'min' => floor( apply_filters( 'wpc_set_num_shift', min( $new_result ), $this->getName() ) ),
                'max' => ceil( apply_filters( 'wpc_set_num_shift', max( $new_result ), $this->getName() ) ),
            ];
        }

        $min_and_max = apply_filters( 'wpc_set_min_max', $min_and_max, $this->getName() );

        return $this->convertSelectResult( $min_and_max, $post_and_types );
    }

    public function updateMinAndMaxValues( $postsIn )
    {
        if( ! empty( $this->items ) && ! empty( $postsIn ) ){
            $newItems = $this->selectTerms( $postsIn );
            foreach ( $this->items as $index => $term ) {
                if( isset( $this->items[$index]->$index ) ){
                    $this->items[$index]->$index = $newItems[$index]->$index;
                }
            }
        }
    }

    private function createTermName( $edge, $value, $queried_values )
    {
        $name = $edge;
        $queriedFilter = false;

        if( $queried_values ){
            foreach ( $queried_values as $slug => $filter ){
                if( $filter['e_name'] === $this->getName() ){
                    $queriedFilter = $filter;
                    break;
                }
            }

            if ( $queriedFilter ) {
                $name = $name .' '. $slug;
            }
        }

        if( isset( $queriedFilter['values'][$edge] ) ) {
            $name = $name .' '. $queriedFilter['values'][$edge];
        }else{
            $name = $name .' '. $value;
        }

        return apply_filters( 'wpc_filter_post_meta_num_term_name', $name, $this->getName() );
    }

    public function convertSelectResult( $result, $post_and_types = [] ){
        $return = [];

        if( ! is_array( $result ) ){
            return $return;
        }

        // To make standard format for terms array;
        $i = 1;
        $wpManager      = Container::instance()->getWpManager();
        $queried_values = $wpManager->getQueryVar( 'queried_values' );

        foreach ( $result as $edge => $value ){

            $termObject = new \stdClass();
            $termObject->slug = $edge;
            $termObject->name = $this->createTermName( $edge, $value, $queried_values );
            $termObject->term_id = $edge . '_' . $this->getName();
            $termObject->posts = array_keys( $post_and_types );
            $termObject->count = 0;
            $termObject->cross_count = 0;
            $termObject->post_types = $post_and_types; //[];
            $termObject->$edge = $value;
            $termObject->wp_queried  = false;

            $return[ $edge ] = $termObject;

            $i++;
        }

        return $return;
    }

    private function isTermInMetaKey( $queried_value, $wp_query ){
        $duplicate  = [];
        $terms      = $queried_value['values'];
        $meta_key   = $wp_query->get('meta_key');
        $meta_value = $wp_query->get('meta_value');

        foreach ( $terms as $term ) {
            if( $queried_value['e_name'] === $meta_key ){
                if( $meta_value === $term ){
                    $duplicate['post_meta'] = $queried_value['e_name'];
                    $duplicate['term']      = $term;
                    return $duplicate;
                }
            }
        }

        return false;
    }

    private function isTermInMetaQuery( $queried_value, $wp_query ){
        $duplicate  = [];
        $meta_query = $wp_query->get('meta_query');
        $terms      = $queried_value['values'];

        if( ! empty( $meta_query ) ){

            foreach ( $meta_query as $query_array ){
                if( isset( $query_array['key'] ) && $query_array['key'] === $queried_value['e_name'] ){
                    $terms_flipped = array_flip($terms);
                    if( isset( $query_array['value'] ) && isset( $terms_flipped[ $query_array['value'] ] ) ){
                        $duplicate['post_meta'] = $queried_value['e_name'];
                        $duplicate['term']      = $query_array['value'];
                        return $duplicate;
                    }
                }
            }
        }

        return false;
    }

    public function isTermAlreadyInQuery( $queried_value, $wp_query )
    {
        // Is term in Key
        if( $duplicate = $this->isTermInMetaKey( $queried_value, $wp_query ) ){
            return $duplicate;
        }
        // Is term in Query
        if( $duplicate = $this->isTermInMetaQuery( $queried_value, $wp_query ) ){
            return $duplicate;
        }

        return false;
    }

    private function normalizeMetaQueryArray( $meta_query )
    {
        $normalized_meta_query = [];

        if( ! is_array( $meta_query ) || ! isset( $meta_query['key'] ) ){
            return false;
        }
        if( isset( $meta_query['value'] ) ){
            if( is_array( $meta_query['value'] ) ){
                sort( $meta_query['value'] );
                $meta_query['value'] = implode( '-', $meta_query['value'] );
                $normalized_meta_query['value']     = $meta_query['value'];
            }else{
                $normalized_meta_query['value'] = $meta_query['value'];
            }
        }

        $normalized_meta_query['key']       = $meta_query['key'];
        if( isset( $meta_query['compare'] ) ){
            $normalized_meta_query['compare']   = isset( $meta_query['compare'] ) ? $meta_query['compare'] : '';
        }

        return $normalized_meta_query;
    }

    private function isTheSameMetaQuery( $meta_query_1, $meta_query_2 )
    {
        $meta_query_1 = $this->normalizeMetaQueryArray( $meta_query_1 );
        $meta_query_2 = $this->normalizeMetaQueryArray( $meta_query_2 );

        $diff = array_diff( $meta_query_1, $meta_query_2 );

        if ( empty( $diff ) ){
            return true;
        }

        return false;
    }

    public function addMetaQueryArray( $meta_query_array, $relation = false )
    {
        if( ! isset( $meta_query_array['key'] ) ){
            return false;
        }

        $existing_meta_query = $this->new_meta_query;

        foreach ($existing_meta_query as $index => $present_query) {

            if ($this->hasNestedQueries($present_query)) {
                foreach ($present_query as $k => $nested_present_query) {

                    if (!isset($nested_present_query['key'])) {
                        // relation arg
                        continue;
                    }
                    if ($this->isTheSameMetaQuery($nested_present_query, $meta_query_array)) {
                        return false;
                    }
                }
            } else {
                if ($this->isTheSameMetaQuery($present_query, $meta_query_array)) {
                    return false;
                }
            }

        }

        if( $relation && in_array( $relation, array( 'AND', 'OR' ) ) ){
            $nested_index = $this->findNestedIndexForQuery($meta_query_array);
            $this->new_meta_query[$nested_index][] = $meta_query_array;
            $this->new_meta_query[$nested_index]['relation'] = $relation;
        }else{
            $this->new_meta_query[] = $meta_query_array;
        }

    }

    public function findNestedIndexForQuery( $meta_query_array )
    {
        $meta_key = $meta_query_array['key'];

        if( empty( $this->new_meta_query ) ){
            return 0;
        }

        foreach ( $this->new_meta_query as $i_level_1 => $maybe_meta_query ){
            // This subquery already exists
            if( isset( $maybe_meta_query[0]['key'] ) && $maybe_meta_query[0]['key'] === $meta_key ){
                return $i_level_1;
            }
        }

        return count( $this->new_meta_query );
    }

    public function hasNestedQueries( $meta_query )
    {
        if( isset( $meta_query[0]['key'] ) ){
            return true;
        }

        return false;
    }

    public function addMetaKeyToQuery( $wp_query )
    {
        $args = [];

        $args['key']   = $wp_query->get( 'meta_key' );
        if( $wp_query->get( 'meta_value'  ) ){
            $args['value'] = $wp_query->get( 'meta_value' );
            $args['compare'] = ( $compare = $wp_query->get( 'meta_compare' ) ) ? $compare : 'IN';
        }

        $wp_query->set( 'meta_key', '' );
        $wp_query->set( 'meta_value', '' );

        $this->addMetaQueryArray( $args );
    }

    public function importExistingMetaQuery( $wp_query )
    {
        // Try to check if there is meta_key, meta_value and meta_compare
        if( $wp_query->get('meta_key') ){
            $this->addMetaKeyToQuery( $wp_query );
        }

        $already_existing_meta_query = $wp_query->get('meta_query');

        if( is_array( $already_existing_meta_query ) ){
            foreach( $already_existing_meta_query as $value ){
                if( $this->hasNestedQueries( $value ) ){
                    foreach( $value as $n => $nested_meta_query ){
                        $this->addMetaQueryArray( $nested_meta_query, $value['relation'] );
                    }
                }else{
                    $this->addMetaQueryArray( $value );
                }

            }
        }
    }

    /**
     * @return object WP_Query
     */
    public function addTermsToWpQuery( $queried_value, $wp_query )
    {
        $meta_query = [];
        $key        = $queried_value['e_name'];
        // Add existing Meta Query if present
        $this->importExistingMetaQuery( $wp_query );

        /**
         * @bug for Woo Products if we don't specify Max value it makes it 0.0000
         */
        $min = isset( $queried_value['values']['min'] ) ? $queried_value['values']['min'] : false;
        $max = isset( $queried_value['values']['max'] ) ? $queried_value['values']['max'] : false;

        // Compare with false because $min can be 0
        if( $min !== false ){
            $min  = apply_filters( 'wpc_unset_num_shift', $min, $this->getName()  );

            $type = $this->isDecimal( $queried_value['step'], $min ) ? 'DECIMAL(15,6)' : 'NUMERIC';
            $meta_query = array(
                'key'     => $key,
                'value'   => $min,
                'compare' => '>=',
                'type'    => $type
            );
            $this->addMetaQueryArray( $meta_query );
        }

        if( $max !== false ){
            $max  = apply_filters( 'wpc_unset_num_shift', $max, $this->getName()  );

            $type = $this->isDecimal( $queried_value['step'], $max ) ? 'DECIMAL(15,6)' : 'NUMERIC';
            $meta_query = array(
                'key'     => $key,
                'value'   => $max,
                'compare' => '<=',
                'type'    => $type
            );
            $this->addMetaQueryArray( $meta_query );
        }

        $this->addMetaQueryArray( $meta_query );


        if ( count($this->new_meta_query) > 1 ) {
            $this->new_meta_query['relation'] = 'AND';
        }

        $wp_query->set('meta_query', $this->new_meta_query );
        $this->new_meta_query = [];

        return $wp_query;
    }
}