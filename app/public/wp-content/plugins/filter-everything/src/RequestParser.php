<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class RequestParser
{
    private $request;

    private $queryVars = [];

    private $separator;

    public function __construct( $request )
    {
        $this->setRequest( $request );
        $this->separator    = FLRT_PREFIX_SEPARATOR;
    }

    private function initQueryVars(){
        // Setup default $queryVars
        $this->queryVars = array(
            'queried_values'        => [],
            'segments_order'        => [],
            'wpc_logic_separators'  => [],
            'non_filter_segments'   => [],
            'error'                 => '',
        );
    }

    public function getQueryVars(){
        $this->initQueryVars();
        $this->parseRequest();
        $this->validateQueryVars();
        return apply_filters( 'wpc_query_vars', $this->queryVars );
    }

    private function isSlugInRequest( $slug ){
        return ( $this->isSlugInQuerySting( $slug ) || $this->isSlugInPath( $slug ) );
    }

    public function detectFilterRequest(){
        $em = Container::instance()->getEntityManager();
        foreach ( $em->getGlobalConfiguredSlugs() as $slug ){
            if( $this->isSlugInRequest( $slug ) ){
                return true;
            }
        }
        return false;
    }

    private function isSlugInPath( $slug ){
        if( mb_strpos( '/' . $this->request, '/' . $slug . $this->separator ) !== false ){
            return true;
        }
        return false;
    }

    /**
     * Checks whether the specified slug exists in the Query String or not
     * @param $slug
     * @return bool
     */
    private function isSlugInQuerySting( $slug ){
        /**
         * This case happens most often and that's why it is first
         */
        if ( $this->extractQueryStringTheParamValues( $slug ) !== false ) {
            return true;
        }

        /**
         * This case happens more rarely
         */
        if (
            ( $this->extractQueryStringTheParamValues( 'max_' . $slug ) !== false )
                ||
            ( $this->extractQueryStringTheParamValues( 'min_' . $slug ) !== false )
            ) {
            return true;
        }

        /**
         * This very rarely
         */
        if (
            ( $this->extractQueryStringTheParamValues( $slug . '_to' ) !== false )
            ||
            ( $this->extractQueryStringTheParamValues( $slug . '_from' ) !== false )
        ) {
            return true;
        }

        return false;
    }

    /**
     * Extracts from the Query String GET value with specified $key if it exists
     * Result always must be checked for !== false because 0 may be returned
     * Examples: 'instock;onbackorder', '118.81', '59.03'
     * @param $key [max_{slug}|min_{slug}|{slug}]
     * @return false|mixed
     */
    public function extractQueryStringTheParamValues( $key )
    {
        $container  = Container::instance();
        $get        = $container->getTheGet();
        $post       = $container->getThePost();

        if( isset( $post['flrt_ajax_link'] ) ){
            $parts = parse_url( $post['flrt_ajax_link'] );

            if( isset( $parts['query'] ) ){
                parse_str( $parts['query'], $output );
                if( isset( $output[$key] ) ){
                    return $this->urlEncodeGetValues( $output[$key] );
                }
            }
        }

        if( isset( $get[$key] ) ){
            return $this->urlEncodeGetValues( $get[$key] );
        }

        return false;
    }

    private function urlEncodeGetValues( $values )
    {
        $queriedValues  = explode( FLRT_QUERY_TERMS_SEPARATOR, $values );
        $queriedValues  = array_map( 'urlencode', $queriedValues );
        $queriedValues  = array_map( 'mb_strtolower', $queriedValues );

        return implode(FLRT_QUERY_TERMS_SEPARATOR, $queriedValues );
    }

    /**
     * Extracts all filter values from the Query String
     * @param $slug string a filter slug
     * @return array
     */
    private function extractValuesFromQueryString( $slug ) {
        $em     = Container::instance()->getEntityManager();
        $filter = $em->getFilterBySlug( $slug /*, array( 'entity' )*/ );

        $values = [];

        /**
         * Numeric filters
         */
        if ( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) ) {
            // Matches numbers and decimal separator
            $regexp = '/^([\-]?\d+(?:[\.\,]\d{1,})?)$/';

            if( $this->extractQueryStringTheParamValues( 'min_' . $slug ) !== false ){
                /**
                 * Safely extract only allowed in numeric filters characters
                 */
                preg_match($regexp, $this->extractQueryStringTheParamValues( 'min_' . $slug ), $output);
                $values['min'] = isset( $output[1] ) ? $output[1] : false;
            }

            if( $this->extractQueryStringTheParamValues( 'max_' . $slug ) !== false ){
                /**
                 * Safely extract only allowed in numeric filters characters
                 */
                preg_match($regexp, $this->extractQueryStringTheParamValues( 'max_' . $slug ), $output);
                $values['max'] = isset( $output[1] ) ? $output[1] : false;
            }
        }

        /**
         * Date filters
         */
        if ( in_array( $filter['entity'], [ 'post_date' ] ) ) {
            // We accept only values that are YYYY-MM-DD or hh.mm.ss or both YYYY-MM-DDthh.mm.ss
            // We do not accept values YYYY-MM, YYYY, hh.mm, mm.ss etc
            if ( $this->extractQueryStringTheParamValues( $slug . '_from' ) !== false ) {
                $from = $this->extractQueryStringTheParamValues( $slug . '_from' );
                $datetime = $this->parseDate( $from );
                if ( $datetime ) {
                    $values['from'] = $datetime;
                } else {
                    $this->set_404( 'Invalid date format' );
                }
            }

            if ( $this->extractQueryStringTheParamValues( $slug . '_to' ) !== false ) {
                $to =  $this->extractQueryStringTheParamValues( $slug . '_to' );
                $datetime = $this->parseDate( $to );
                if ( $datetime ) {
                    $values['to'] = $datetime;
                } else {
                    $this->set_404( 'Invalid date format' );
                }
            }

            /**
             * Check if both datetime values 'from' and 'to' have no different format e.g. 2023-04-12 and 17.23.00
             * simultaneously.
             * We don't need to generate 404 error because they are GET parameters and we can just
             * ignore these parameters and open the same page like without them.
             */
            if ( isset( $values['from'] ) && isset( $values['to'] ) ) {
                if ( ! $this->haveDateValuesEqualFormat( $values ) ) {
                    $values = [];
                    $this->set_404( 'Values have different format' );
                }
            }
            //@todo if from date is bigger than to date it means that it is also invalid format
            // Maybe we have to check this and do not process it.
            //@todo Maybe we have to remove date queried value if they have invalid format
            // to avoid these values processing further
        }

        /**
         * In the Free plugin version without Permalinks
         * All slugs located in the Query String URL part
         */
        if ( ( $this->extractQueryStringTheParamValues( $slug ) !== false ) ) {
            if ( ! in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric', 'post_date' ] ) ) {
                /**
                 * If it is Free version with all filter values in the Query String
                 * we also have to check if terms exists on our site.
                 * Otherwise generate the 404 error.
                 */
                $params = $this->extractQueryStringTheParamValues( $slug );
                $values = $this->safeExtractFilterValuesFromQueryString( $params, $slug );
            } else {
                /**
                 * For numeric filters just extract numeric values
                 */
                $values[] = $this->extractQueryStringTheParamValues( $slug );
            }
        }

        unset($em);

        return $values;
    }

    /**
     * Checks if the date has valid and accepted format and returns
     * @param $date
     * @return string datetime in format YYYY-MM-DDthh.mm.ss OR empty string if date is invalid
     */
    private function parseDate( $date ) {
        $date           = urldecode( $date );
        $maybe_time     = $maybe_date = false;
        $queried_value  = '';
        $valid          = true;

        if ( ! $date ) {
            return $queried_value;
        }

        if ( strpos( $date, FLRT_DATE_TIME_SEPARATOR ) !== false ) {
            $pieces = explode(FLRT_DATE_TIME_SEPARATOR, $date );
            $maybe_date = $pieces[0];
            $maybe_time = $pieces[1];
        } else {
            if ( strpos( $date, '.') !== false ) {
                $maybe_time = $date;
            } else if ( strpos( $date, '-') !== false ) {
                $maybe_date = $date;
            } else {
                $valid = false;
            }
        }

        if ( $maybe_time && ! $this->isValidDate( $maybe_time, "H.i.s" ) ) {
            $valid = false;
        }
        if ( $maybe_date && ! $this->isValidDate( $maybe_date, "Y-m-d") ) {
            $valid = false;
        }

        if ( $valid ) {

            if ( $maybe_date && $maybe_time ) {
                $queried_value = $maybe_date .' '. $maybe_time;
            } else {
                if ($maybe_date) {
                    $queried_value = $maybe_date;
                }

                if ($maybe_time) {
                    $queried_value = $maybe_time;
                }
            }
        }

        return $queried_value;
    }

    private function isValidDate( $date_or_time, $format = 'Y-m-d' ) {
        try{
            $dateObj = new \DateTime( $date_or_time );
            return $dateObj && $dateObj->format( $format ) === $date_or_time;
        } catch ( \Exception $e ){
            return false;
        }
    }

    /**
     * Checks if a given datetime has equal format for both from and to values
     * @param $values
     * @return bool
     */
    private function haveDateValuesEqualFormat( $values ) {
        $valid = true;

        if ( ! isset( $values['from'] ) || ! isset( $values['to'] ) ) {
            return false;
        }

        $date_1 = str_replace( FLRT_DATE_TIME_SEPARATOR, ' ', $values['from']  );
        $date_2 = str_replace( FLRT_DATE_TIME_SEPARATOR, ' ', $values['to'] );

        $pcs_1 = date_parse( $date_1 );
        $pcs_2 = date_parse( $date_2 );

        $parts_1 = [];
        $parts_2 = [];

        foreach ( [ 'year', 'month', 'day', 'hour', 'minute', 'second' ] as $item ) {
            if ( isset( $pcs_1[$item] ) && $pcs_1[$item] !== false ) {
                $parts_1[] =  $item;
            }

            if ( isset( $pcs_2[$item] ) && $pcs_2[$item] !== false ) {
                $parts_2[] =  $item;
            }

        }

        if( count( array_diff( $parts_1, $parts_2 ) ) > 0 ) {
            $valid = false;
        }

        return $valid;
    }

    private function set_404( $message = '' ){
        $this->queryVars['error'] = '404';
        if( $message && FLRT_PLUGIN_DEBUG ){
            echo esc_html( $message );
        }
    }

    public function getRequest(){
        return $this->request;
    }

    public function setRequest( $request ){
        $this->request = strtolower( trim( $request, '/' ) );
    }

    /**
     * @return array
     */
    private function getPathSegments(){
        if( $this->request ){
            return explode('/', $this->request );
        }
        return [];
    }

    public function cleanUpRequestPathFromFilterSegments( $request_path ){
        // Otherwise it will be URL encoded with uppercase characters
        // But tax term slugs always stored lowercase in WordPress DB
        $request_path = strtolower($request_path);

        foreach( $this->getPathSegments() as $segment ){
            if( $this->checkSlugInSegmentForCleaningNativePath( $segment ) ){
                /**
                 *@improvement Maybe remove query_args also
                 */
                $request_path = str_replace('/' . $segment, '', $request_path );
            }
        }

        return $request_path;
    }

    public function parseRequest(){
        /**
         * @bug this method fires twice.
         */

        $pathSegments = apply_filters( 'wpc_filter_path_segments', $this->getPathSegments() );
        $em           = Container::instance()->getEntityManager();
        $fse          = Container::instance()->getFilterService();
        // Path values
        foreach( $pathSegments as $segment ){

            if( $slug = $this->getSlugFromSegment( $segment ) ){
                $segmentParams = $this->cutParamsFromSegment( $segment, $slug );
                // List of entity, e_name, slug should be unique for all filters
                $filter_entity = $em->getFilterBySlug( $slug /*, array( 'entity', 'e_name', 'slug', 'in_path' )*/ );
                $filter_entity['values'] = $this->extractQueriedValuesFromSegment( $segmentParams, $slug );
                $filter_entity['founded_in_path'] = 'yes';
                $this->queryVars['queried_values'][$slug] = $filter_entity;

                $order_element = $fse->getEntityFullName( $filter_entity['entity'], $filter_entity['e_name'] );

                $this->queryVars['segments_order'][] = $order_element;
            } else {
                $this->queryVars['non_filter_segments'][] = $segment;
            }
        }

        // Query string values
        foreach ( $em->getConfiguredQuerySlugs() as $slug ) {
            if ( $this->isSlugInQuerySting( $slug ) ) {
                $filter_entity = $em->getFilterBySlug( $slug /*, array( 'entity', 'e_name', 'slug', 'in_path' ) */ );
                $filter_entity['values'] = $this->extractValuesFromQueryString( $slug );
                $filter_entity['founded_in_path'] = 'no';
                $this->queryVars['queried_values'][$slug] = $filter_entity;
            }
        }

        unset($em, $fse);
    }

    private function checkSlugInSegmentForCleaningNativePath( $segment ){
        $em = Container::instance()->getEntityManager();
        foreach( $em->getConfiguredPathSlugs() as $key => $slug ){
            if( mb_strpos( $segment, $slug . $this->separator ) === 0 ){
                return $slug;
            }
        }
        return false;
    }

    private function getSlugFromSegment( $segment ){
        $em = Container::instance()->getEntityManager();
        foreach( $em->getConfiguredPathSlugs() as $key => $slug ){
            if( mb_strpos( $segment, $slug . $this->separator ) === 0 ){
                return $slug;
            }
        }
        return false;
    }

    private function cutParamsFromSegment( $segment, $slug ){
        return mb_substr( $segment, mb_strlen( $slug . $this->separator ) );
    }

    private function checkValuesOrder( $segmentParams, $sep ){
        $fse   = Container::instance()->getFilterService();
        $terms = explode( $sep, $segmentParams );
        $terms = $fse->sortTerms($terms);
        $sortedParams = implode( $sep, $terms );

        if( $segmentParams !== $sortedParams ){
            return false;
        }

        return true;
    }

    /**
     * @param string $segmentParams specially formatted sting like two#or#or-or-three#and
     * @param array $filters filters arrays with logic value
     */
    private function extractLogicSeparator( $segmentParams, $filters ){
        $fse = Container::instance()->getFilterService();
        foreach( $filters as $filter ){
            $logicSeparator = $fse->getLogicSeparator( $filter['logic'] ); // -or- | -and-
            if( mb_strpos( $segmentParams, $logicSeparator ) !== false ){
                $this->queryVars['wpc_logic_separators'][$filter['slug']] = $filter['logic'];
                return $logicSeparator;
            }
        }

        return false;
    }

    private function safeExtractFilterValuesFromQueryString( $filterParams, $slug ) {
        // $filterParams = accessories;tshirts
        $em             = Container::instance()->getEntityManager();
        $allEntityTerms = $em->getEntityAllTermsSlugs( $slug );
        $queriedValues  = $em->safeExplodeFilterValues( $filterParams, $slug, FLRT_QUERY_TERMS_SEPARATOR );
        $queriedValues  = $em->safeImplodeFilterValues( $queriedValues, FLRT_QUERY_TERMS_SEPARATOR );

        $allEntityTerms_flipped = array_flip( $allEntityTerms );
        foreach ( $queriedValues as $k => $value ) {
            if ( ! isset( $allEntityTerms_flipped[$value] ) ) {
                unset( $queriedValues[$k] );
                $this->set_404( 'Term does not exist - ' . $value );
            }
        }

        // Check duplicates
        if( flrt_array_contains_duplicate( $queriedValues ) ){
            $this->set_404('Param duplicates');
            $queriedValues = array_unique($queriedValues);
        }

        unset( $em );

        return $queriedValues;
    }

    /**
     * @param string $segmentParams
     * @param string $slug
     * @return false|array
     */
    private function extractQueriedValuesFromSegment( $segmentParams, $slug ){

        $em = Container::instance()->getEntityManager();
        $allEntityTerms = $em->getEntityAllTermsSlugs( $slug );

        $filters        = $em->getAllFiltersBySlug( $slug /*, array( 'logic', 'slug' )*/ );

        $segmentParams  = $em->safeExplodeFilterValues( $segmentParams, $slug, $this->separator, false );
        $logicSeparator = $this->extractLogicSeparator( $segmentParams, $filters );

        // $segmentParams = two#or#or-or-three#and
        // $valueSeparator = '-or-'
        if( $logicSeparator ) {

            $queriedValues = explode( $logicSeparator, $segmentParams );

            if ( ! $this->checkValuesOrder($segmentParams, $logicSeparator) ) {
                /**
                 * @feature maybe redirect to URL with correct order of values
                 */
                $this->set_404('Invalid params order');
            }
        }else{
            $queriedValues[0] = $segmentParams;
        }

        $queriedValues = $em->safeImplodeFilterValues( $queriedValues, $this->separator );

        $allEntityTerms_flipped = array_flip( $allEntityTerms );
        foreach ( $queriedValues as $k => $value ) {
            if ( ! isset( $allEntityTerms_flipped[$value] ) ) {
                unset( $queriedValues[$k] );
                $this->set_404( 'Term does not exist - ' . $value );
            }
        }

        // Check duplicates
        if( flrt_array_contains_duplicate( $queriedValues ) ){
            $this->set_404('Param duplicates');
            $queriedValues = array_unique($queriedValues);
        }

        unset($em);

        return $queriedValues;
    }

    private function validateSegmentsOrder( $template = [] ){
        $fse          = Container::instance()->getFilterService();

        if( ! $template ){
            $template = $fse->getFiltersOrder();
        }

        $to_compare = $this->queryVars['segments_order'];

        if( flrt_array_contains_duplicate( $to_compare ) ){
            return false;
        }

        if( ! is_array( $template ) || ! is_array( $to_compare ) ){
            return false;
        }

        $new_template = array_intersect( $template, $to_compare );

        if( empty( $new_template ) ){
            return false;
        }

        $new_template       = array_values( $new_template );
        $already_compared   = [];
        $i = 0;

        foreach ( $to_compare as $index => $value ) {
            if( in_array( $value, $already_compared ) ){
                $existing_index = array_search( $value, $already_compared );
                $existing_index++;
                if( isset( $already_compared[$existing_index] ) ){
                    return false;
                }
            }

            if( $value === $new_template[$i] ){
                $i++;
                $already_compared[] = $value;
            }
        }

        unset( $fse );

        return ( $new_template === $already_compared );

    }

    private function validateQueryVars(){
        // Check for segments duplicates
        $maybe_duplicates = [];
        $fse              = Container::instance()->getFilterService();

        if( ! empty( $this->queryVars['queried_values'] ) ){
            foreach( $this->queryVars['queried_values'] as $filter ){
                $maybe_duplicates[] = $fse->getEntityFullName( $filter['entity'], $filter['e_name'] );
            }

            if( flrt_array_contains_duplicate( $maybe_duplicates ) ){
                $this->set_404( 'Segment duplicates' );
            }
        }

        // Check segments order
        if( ! empty( $this->queryVars['segments_order'] ) ) {
            if (!$this->validateSegmentsOrder()) {
                $this->set_404('Invalid segments order');
            }
        }

        unset( $fse );
        // Check something other
        // If max < than min maybe should be an error
    }
}