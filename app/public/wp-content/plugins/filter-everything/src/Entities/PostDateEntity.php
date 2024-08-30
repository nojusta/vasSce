<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class PostDateEntity implements Entity
{
    public $items = [];

    public $entityName = '';

    public $excludedTerms = [];

    public $isInclude = false;

    public $new_date_query = [];

    public $postTypes = [];

    public $from = false;

    public $to   = false;

    public $time_from = false;

    public $time_to = false;

    public $date_type = '';

    private $doRecalculate = '';

    private $post_and_types = [];

    public function __construct( $name, $postType )
    {
        /**
         * @feature clean code from unused methods
         */
        // This object is being created two times
        // One time without post type when RequestParser select all filter terms
        // Second time with post type when Filters widget requires filter terms to display them
        $this->entityName = $name;
        $this->setPostTypes( array($postType) );
        $this->setFromAndTo();

        $this->getAllExistingTerms();
    }

    public function setPostTypes( $postTypes = [] )
    {
        if ( isset( $postTypes[0] ) ) {
            $this->postTypes = $postTypes;
        }
    }

    public static function inputName( $slug, $edge = 'from' )
    {
        return $slug . '_' . $edge;
    }

    public function setExcludedTerms($excludedTerms, $isInclude)
    {
        $this->excludedTerms = $excludedTerms;
        $this->isInclude = $isInclude;
    }

    public function getName()
    {
        return $this->entityName;
    }

    function excludeTerms($terms)
    {
        return $terms;
    }

    function getTerms()
    {
        return $this->excludeTerms($this->getAllExistingTerms());
    }

    /**
     * @param int $id term id
     * @return false|object term object of false
     */
    public function getTerm( $termId )
    {
        if (!$termId) {
            return false;
        }

        foreach ($this->getTerms() as $term) {
            if ($termId == $term->term_id) {
                return $term;
            }
        }

        return false;
    }

    public function getTermId($slug)
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
        foreach ($this->getTerms() as $term) {
            $toSelect[$term->slug] = $term->name;
        }

        return $toSelect;
    }

    public function getTermsForSelect2()
    {
        $toSelect = [];
        foreach ($this->getTerms() as $term) {
            $toSelect[] = array( 'id' => $term->slug, 'text' => $term->name );
        }

        return $toSelect;
    }

    function getAllExistingTerms( $force = false )
    {
        if (empty($this->items) || $force) {
            $this->items = $this->selectTerms();
        }
        return $this->items;
    }

    function populateTermsWithPostIds( $setId, $post_type )
    {
        // Does nothing. It was already done before.
    }

    private function queryTerms()
    {   global $wpdb;
        // @todo delete appropriate transient in resetTransitions();
        $IN                            = false;
        $translatable_post_type_exists = false;
        $lang                          = '';
        $key_in                        = '';

        /**
         * Check if any post type is translatable
         */
        if ( flrt_wpml_active() && defined('ICL_LANGUAGE_CODE') ) {
            $lang = ICL_LANGUAGE_CODE;
            $wpml_settings = get_option('icl_sitepress_settings');

            foreach ($this->postTypes as $type) {
                if (isset($wpml_settings['custom_posts_sync_option'][$type])) {
                    if ($wpml_settings['custom_posts_sync_option'][$type] === '1') {
                        $translatable_post_type_exists = true;
                        break;
                    }
                }
            }
        }

        /**
         * Set Post types
         */
        if (!empty($this->postTypes) && isset($this->postTypes[0]) && $this->postTypes[0]) {
            foreach ($this->postTypes as $postType) {
                $key_in .= '_' . $postType;
                $pieces[] = $wpdb->prepare("%s", $postType );
            }

            $IN = implode(", ", $pieces);
        }

        /**
         * Set transient key
         */
        $transient_key = flrt_get_terms_transient_key($this->getName() . $key_in . $lang);

        if ( false === ( $result = get_transient( $transient_key ) ) ) {
            // Get all post meta values
            $sql[] = "SELECT {$wpdb->posts}.ID,{$wpdb->posts}.post_date,{$wpdb->posts}.post_type";
            $sql[] = "FROM {$wpdb->posts}";

            /**
             * If post type is translatable with WPML, get post meta values only with current language
             */
            if (flrt_wpml_active() && $lang && $translatable_post_type_exists) {
                $sql[] = "LEFT JOIN {$wpdb->prefix}icl_translations AS wpml_translations";
                $sql[] = "ON {$wpdb->posts}.ID = wpml_translations.element_id";

                if (!empty($this->postTypes)) {

                    $sql[] = "AND wpml_translations.element_type IN(";

                    foreach ($this->postTypes as $type) {
                        $LANG_IN[] = $wpdb->prepare("CONCAT('post_', '%s')", $type);
                    }
                    $sql[] = implode(",", $LANG_IN);

                    $sql[] = ")";
                }
            }

            $sql[] = "WHERE 1=1";

            if ($IN) {
                $sql[] = "AND {$wpdb->posts}.post_type IN( {$IN} )";
            }

            if (flrt_wpml_active() && $lang && $translatable_post_type_exists) {
                $sql[] = $wpdb->prepare("AND wpml_translations.language_code = '%s'", $lang);
            }

            /**
             * Filters terms SQL-query and allows to modify it
             */
            $sql = apply_filters('wpc_filter_get_post_date_terms_sql', $sql, $this->postTypes);

            $sql = implode(' ', $sql);

            $result = $wpdb->get_results($sql, ARRAY_A);

            set_transient( $transient_key, $result, FLRT_TRANSIENT_PERIOD_HOURS * HOUR_IN_SECONDS );
        }

        return $result;
    }

    /**
     * Selects all post dates within specified post_type.
     * Also generates $min and $max terms with list of posts belong to them.
     * If the $alreadyFilteredPosts specified it limits selected posts to
     * specified in the variable.
     *
     * @param array $alreadyFilteredPosts
     */
    public function selectTerms( $alreadyFilteredPosts = [] )
    {
        /**
         * Do not query post dates from DB without post type
         */
        if ( ! $this->postTypes[0] ) {
            return [];
        }

        $new_result         = [];
        $new_time_result    = [];
//        $from_and_to        = [
//            'from' => 0,
//            'to' => 0
//        ];

        $result = $this->queryTerms();
        $doRecalculate = $this->doRecalculate( $alreadyFilteredPosts );

        if ( ! empty( $result ) && $doRecalculate ) {

            $postsIn_flipped    = array_flip( $alreadyFilteredPosts );

            foreach ( $result as $single_post ) {
                /**
                 * If there are already filtered posts, we have to skip posts
                 * that are out of the queried list
                 */
                if ( ! empty( $alreadyFilteredPosts ) ) {
                    if ( ! isset( $postsIn_flipped[$single_post['ID']] ) ) {
                        continue;
                    }
                }

                /**
                 * We have to generate and fill two arrays
                 * First to detect $min and $max values
                 * Second to map post_types with post IDs
                 */
                $new_result[]      = $single_post['post_date'];
                $new_time_result[] = flrt_clean_date_time( $single_post['post_date'], 'time' );

                if ( $this->from !== false && flrt_clean_date_time( $single_post['post_date'], $this->date_type ) < $this->from ){
                    continue;
                }

                if ( $this->to !== false && flrt_clean_date_time( $single_post['post_date'], $this->date_type ) > $this->to ){
                    continue;
                }

                $this->post_and_types[$single_post['ID']] = $single_post['post_type'];
            }
        }

        if ( ! empty( $new_result ) ) {
            // We need to find minimum and maximum date values
            $from_and_to = [
                'from' => apply_filters( 'wpc_set_date_shift', min( $new_result ), $this->getName() ),
                'to' => apply_filters( 'wpc_set_date_shift', max( $new_result ), $this->getName() ),
            ];

            $time_from_and_to = [
                'from' => apply_filters( 'wpc_set_date_shift', min( $new_time_result ), $this->getName() ),
                'to'   => apply_filters( 'wpc_set_date_shift', max( $new_time_result ), $this->getName() ),
            ];

        } else {
            // if we didn't recalculate items, it means we have them already stored in the object
            return $this->items;
        }

        $from_and_to = apply_filters( 'wpc_set_from_to', $from_and_to, $this->getName() );
        $x = $this->convertSelectResult( $from_and_to, $time_from_and_to );

        return $x;
    }

    public function convertSelectResult( $result, $time_from_and_to ){
        $return = [];

        if( ! is_array( $result ) ){
            return $return;
        }

        // To make standard format for terms array;
        $i = 1;
        $wpManager      = Container::instance()->getWpManager();
        $queried_values = $wpManager->getQueryVar( 'queried_values' );

        foreach ( $result as $edge => $value ){
            $time_edge = 'time_'.$edge;

            $termObject = new \stdClass();
            $termObject->slug = $edge;
            $termObject->name = $this->createTermName( $edge, $value, $queried_values );
            $termObject->term_id = $edge . '_' . $this->getName();
            $termObject->posts = array_keys( $this->post_and_types );
            $termObject->count = 0;
            $termObject->cross_count = 0;
            $termObject->post_types = $this->post_and_types; //[];
            $termObject->$edge = $value;
            $termObject->$time_edge = $time_from_and_to[$edge];
            $termObject->wp_queried  = false;

            $return[ $edge ] = $termObject;

            $i++;
        }

        return $return;
    }

    private function createTermName( $edge, $value, $queried_values )
    {
        $queriedFilter = false;
        if( $edge === 'from' ) {
            $name = esc_html__('After', 'filter-everything' );
        } else if( $edge === 'to' ) {
            $name = esc_html__('Before', 'filter-everything' );
        }

        if( $queried_values ){
            foreach ( $queried_values as $slug => $filter ){
                if( $filter['e_name'] === $this->getName() ){
                    $queriedFilter = $filter;
                    break;
                }
            }
        }

        if( isset( $queriedFilter['values'][$edge] ) ) {
            $format     = $queriedFilter['date_format'];
            $date_type  = false;

            if ( isset( $queriedFilter['values']['from'] ) ) {
                $date_type = flrt_detect_date_type( $queriedFilter['values']['from'] );
            } else if ( isset( $queriedFilter['values']['to'] ) ) {
                $date_type = flrt_detect_date_type($queriedFilter['values']['to']);
            }

            // IN case if we have several date filters on the same page
            if ( in_array( $date_type, [ 'date', 'time' ] ) ) {
                $maybe_split_format = flrt_split_date_time( $format );
                if ( isset( $maybe_split_format[$date_type] ) ) {
                    $format = $maybe_split_format[$date_type];
                }
            }

            $name = $name .' '. flrt_apply_date_format( $queriedFilter['values'][$edge], $format );
        }else{
            $name = $name .' '. $value;
        }

        return apply_filters( 'wpc_filter_post_date_term_name', $name, $this->getName() );
    }

    private function doRecalculate( $alreadyFilteredPosts )
    {
        $do_filtered_posts = md5( json_encode( $alreadyFilteredPosts ) );
        $do_from           = md5( $this->from );
        $do_to             = md5( $this->to );

        $result = md5( $do_filtered_posts . $do_from . $do_to );

        if ( $result === $this->doRecalculate ) {
            return false;
        }

        $this->doRecalculate = $result;
        return true;
    }

    /**
     * Sets $this->from and $this->to values if there are queried date filter(s)
     */
    private function setFromAndTo()
    {
        $wpManager      = Container::instance()->getWpManager();
        $queried_values = $wpManager->getQueryVar( 'queried_values', [] );
        $filter_slug    = false;

        /**
         * Check if this filter was queried
         */
        foreach ( $queried_values as $slug => $filter ) {
            /**
             * At this point we do not know what exactly filter was queired
             * because filters with the same slug can be in multiple Filter Sets with
             * different date_type values.
             */
            if ( $filter['e_name'] === $this->getName() ) {
                $filter_slug = $slug;
                break;
            }
        }

        /**
         * If this filter was queried we have to receive its $from and $to values
         */
        if ( $filter_slug ) {
            if ( isset( $queried_values[$filter_slug]['values']['to'] ) && $this->to === false ) {
                $to           = str_replace( '.', ':', $queried_values[$filter_slug]['values']['to'] );
                $this->date_type = flrt_detect_date_type( $to );
                $this->to = $this->time_to = apply_filters( 'wpc_unset_date_shift', $to, $this->getName(), $this->date_type );
                if ( $this->date_type === 'time' ) {
                    $this->time_to = $this->to;
                }
            }

            if ( isset( $queried_values[$filter_slug]['values']['from'] ) && $this->from === false ) {
                $from         = str_replace( '.', ':', $queried_values[$filter_slug]['values']['from'] );
                $this->date_type = flrt_detect_date_type( $from );
                $this->from = apply_filters( 'wpc_unset_date_shift', $from, $this->getName(), $this->date_type );
                if ( $this->date_type === 'time' ) {
                    $this->time_from = $this->from;
                }
            }
        }
    }

    /**
     * Updates object $this->items in accordance with already queried posts
     * @param $postsIn
     */
    public function updateMinAndMaxValues( $postsIn )
    {
        if ( ! empty( $this->items ) && ! empty( $postsIn ) ) {
            $newItems = $this->selectTerms( $postsIn );

            foreach ( $this->items as $index => $term ) {
                $time_index = 'time_'.$index;
                if ( isset( $this->items[$index]->$index ) ) {
                    $this->items[$index]->$index = $newItems[$index]->$index;
                    $this->items[$index]->$time_index = $newItems[$index]->$time_index;
                }
            }
        }
    }

    /**
     * @return object WP_Query
     */
    public function addTermsToWpQuery( $queried_value, $wp_query )
    {
        $wpc_date_query      = [];
        $possible_date_query = $wp_query->get( 'date_query' );

        if( ! empty( $possible_date_query ) ) {
            $this->new_date_query = $possible_date_query;
        }
        /**
         * @todo Nested date queries?
         */
        $from = isset( $queried_value['values']['from'] ) ? $queried_value['values']['from'] : false;
        $to = isset( $queried_value['values']['to'] ) ? $queried_value['values']['to'] : false;

        if ( $from !== false ) {

            $date_time_pieces = date_parse( $from );

            foreach ( [ 'year', 'month', 'day', 'hour', 'minute', 'second' ] as $item) {
                if ( $date_time_pieces[$item] !== false ) {
                    $date_from_query[$item] = $date_time_pieces[$item];
                }
            }

            // It means datetime query
            if ( count( $date_from_query ) > 3 ) {
                $wpc_date_query['from'] = $from;
            } else {
                // either date or time request
                if( isset( $date_from_query['year'] ) && isset( $date_from_query['month'] ) && isset( $date_from_query['day'] ) ) {
                    $this->new_date_query['after'] = $date_from_query;
                    $this->new_date_query['inclusive'] = true;
                } else {
                    $date_from_query['compare'] = '>=' ;
                    $this->new_date_query[] = $date_from_query;
                }
            }
        }

        if( $to !== false ){
            $date_time_pieces = date_parse( $to );

            foreach ( [ 'year', 'month', 'day', 'hour', 'minute', 'second' ] as $item) {
                if ( $date_time_pieces[$item] !== false ) {
                    $date_to_query[$item] = $date_time_pieces[$item];
                }
            }
            // It means datetime query
            if ( count( $date_to_query ) > 3 ) {
                $wpc_date_query['to'] = $to;
            } else {
                if ( isset( $date_to_query['year'] ) && isset( $date_to_query['month'] ) && isset( $date_to_query['day'] ) ) {
                    $this->new_date_query['before'] = $date_to_query;
                    $this->new_date_query['inclusive'] = true;
                } else {
                    $date_to_query['compare'] = '<=' ;
                    $this->new_date_query[] = $date_to_query;
                }
            }
        }

        if( ! empty( $this->new_date_query ) ) {
            $wp_query->set( 'date_query', $this->new_date_query );
        }

        if ( ! empty( $wpc_date_query ) ) {
            $wp_query->set( 'wpc_date_query', $wpc_date_query );
        }

        $this->new_date_query = [];

        return $wp_query;
    }
}