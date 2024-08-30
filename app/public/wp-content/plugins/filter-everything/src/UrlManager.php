<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class UrlManager
{
    private $separator;

    private $em;

    private $wpManager;

    private $entityAndEnamesOrder;

    private $actualFilters;

    private $enameActualFilters;

    private $resetUrl;

    private $logicParam = 'logic'; // Should be an option

    private $valuesSeparator = FLRT_QUERY_TERMS_SEPARATOR; // Should be an option

    public function __construct()
    {
        $this->separator            = FLRT_PREFIX_SEPARATOR;
        $fse                        = Container::instance()->getFilterService();
        $this->em                   = Container::instance()->getEntityManager();
        $this->wpManager            = Container::instance()->getWpManager();
        $this->entityAndEnamesOrder = $fse->getFiltersOrder();
        $this->actualFilters        = $this->em->getSetsRelatedFilters();

        // E_name actual filters
        foreach ( $this->actualFilters as $actualFilter ) {
            $this->enameActualFilters[ $actualFilter['entity'].'#'.$actualFilter['e_name'] ] = $actualFilter;
        }

        unset( $fse );
    }

    public function getTermUrl( $termSlug = '', $e_name = '', $entity = '', $resetUrl = '', $exclude = [] )
    {
        $fse                 = Container::instance()->getFilterService();
        $e_nameActualFilters = $this->enameActualFilters;
        $url    = $baseUrl   = $resetUrl ? $resetUrl : $this->getResetUrl();
        $parts               = [];
        $entity_and_e_name   = $entity.'#'.$e_name;

        if ( empty( $e_nameActualFilters ) ) {
            $the_filter = $this->getSingleActualFilter( $e_name );
            $entity_and_e_name = $the_filter['entity'].'#'.$the_filter['e_name'];
            $e_nameActualFilters[$entity_and_e_name] = $the_filter;
        }

        foreach( $this->entityAndEnamesOrder as $entityAndEName ) {

            if ( isset( $e_nameActualFilters[$entityAndEName] ) ) {

                $filter = $e_nameActualFilters[$entityAndEName];

                if ( empty( $filter['values'] ) && $entity_and_e_name !== $entityAndEName ) {
                    continue;
                }

                if( $entity_and_e_name === $entityAndEName ){
                    $queriedValues = $filter['values'];
                    // Add only single filter value for views with single selection
                    if( in_array( $filter['view'], array('dropdown', 'radio') ) ){

                        if( in_array( $termSlug, $queriedValues ) ){
                            $position = array_search( $termSlug, $queriedValues );
                            unset( $queriedValues[$position] );
                        }else{
                            $queriedValues = array( $termSlug );
                        }

                    } else {
                        // For Post Meta Num values have array index as termslug
                        if ( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric', 'post_date' ] ) ) {
                            if ( in_array( $termSlug, array_keys( $queriedValues ) ) ) {
                                unset( $queriedValues[$termSlug] );
                            } else {
                                $queriedValues[] = $termSlug;
                            }
                        } else {
                            if ( in_array( $termSlug, $queriedValues ) ) {
                                $position = array_search( $termSlug, $queriedValues );
                                unset( $queriedValues[$position] );
                            } else {
                                $queriedValues[] = $termSlug;
                            }
                        }

                    }

                    $filter['values']     = $queriedValues;
                }

                if( ! empty( $filter['values'] ) ) {
                    $filter['values'] = $fse->sortTerms( $filter['values'] );

                    if ( in_array( $filter['entity'], ['post_meta_num', 'tax_numeric'] ) ) {
                        foreach ($filter['values'] as $edge => $value) {
                            $paramName = $edge . '_' . $filter['slug'];
                            $url = flrt_add_query_arg($this->getParamName($paramName), $value, $url);
                        }
                    } elseif ( in_array($filter['entity'], ['post_date'] ) ) {
                        foreach ($filter['values'] as $edge => $date_value) {
                            $paramName = $filter['slug'] . '_' . $edge;
                            $date_value = str_replace(' ', FLRT_DATE_TIME_SEPARATOR, $date_value);
                            $url = flrt_add_query_arg($this->getParamName($paramName), $date_value, $url);
                        }
                    } else {
                        if ( defined('FLRT_PERMALINKS_ENABLED') && FLRT_PERMALINKS_ENABLED ) {
                            $parts[] = $this->buildFilterSegment( $filter['values'], $filter );
                        } else {
                            $url = flrt_add_query_arg( $this->getParamName($filter['slug'] ), implode($this->getValuesSeparator(), $filter['values']), $url);
                        }
                    }
                }

            }
        }

        // Assembly permalinks
        if ( defined('FLRT_PERMALINKS_ENABLED') && FLRT_PERMALINKS_ENABLED ) {
            $pieces = explode('?', $baseUrl);
            $path   = $pieces[0];
            $path   = trailingslashit( $path ) . implode('/', $parts );
            $path   = user_trailingslashit( $path );
            $url    = str_replace( $pieces[0], $path, $url );
        }

        if ( ! isset( $exclude['srch'] ) ){
            $search = isset( $_GET['srch'] ) ? filter_input( INPUT_GET, 'srch', FILTER_SANITIZE_SPECIAL_CHARS ) : false;
            if ( $search ){
                $url = flrt_add_query_arg( 'srch' , $search, $url );
            }
        }

        return apply_filters( 'wpc_filter_term_url', $url );
    }

    public function getFormActionUrl( $queryParams = false )
    {
        $query          = [];
        $homeUrl        = parse_url(home_url());
        $post           = Container::instance()->getThePost();

        if( isset( $post['flrt_ajax_link'] ) ){
            $requestedUri = $post['flrt_ajax_link'];
        }else{
            $requestedUri = $homeUrl['scheme'].'://'.$homeUrl['host'];
            if( isset( $homeUrl['port'] ) && $homeUrl['port'] ){
                $requestedUri .= ":".$homeUrl['port'];
            }
            $requestedUri .= $_SERVER['REQUEST_URI'];
        }

        $pieces         = parse_url( $requestedUri );
        $fullPath       = $pieces['scheme']."://".$pieces['host'];
        if( isset( $pieces['port'] ) && $pieces['port'] ){
            $fullPath .= ":".$pieces['port'];
        }
        $fullPath .= $pieces['path'];

        if( isset( $pieces['query'] ) ){
            parse_str( $pieces['query'], $query );
        }

        $formAction = $this->removePaginationBase( $fullPath );
        $formAction = FLRT_PERMALINKS_ENABLED ? user_trailingslashit( $formAction ) : rtrim( $formAction, '/' ) . '/';

        // Add GET parameters
        if( $queryParams && ! empty( $query ) ) {
            foreach ($query as $name => $value) {
                $formAction = flrt_add_query_arg($name, $value, $formAction);
            }
        }

        return $formAction;
    }

    private function setCorrectGetKeys( $queried_values )
    {
        $getKeys = [];
        if( ! $queried_values || empty($queried_values) ){
            return apply_filters( 'wpc_unnecessary_get_parameters', $getKeys );
        }

        foreach ( $queried_values as $slug => $filter ){
            if( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) ) {
                $getKeys['max_' . $slug]    = $filter;
                $getKeys['min_' . $slug]    = $filter;
            } else if( in_array( $filter['entity'], [ 'post_date' ] ) ) {
                $getKeys[$slug .'_from']    = $filter;
                $getKeys[$slug . '_to']     = $filter;
            }else{
                $getKeys[$slug] = $filter;
            }
        }

        return apply_filters( 'wpc_unnecessary_get_parameters', $getKeys );
    }

    public function getResetUrl()
    {
        if( ! $this->resetUrl ) {
            $container      = Container::instance();
            $get            = $container->getTheGet();

            // For compatibility with some Nginx configurations
            unset($get['q']);

            $this->resetUrl = home_url( $this->wpManager->getQueryVar('wp_request', '') );
            $requested      = $this->wpManager->getQueryVar('queried_values', [] );

            $this->resetUrl = $this->removePaginationBase( $this->resetUrl );
            $this->resetUrl = FLRT_PERMALINKS_ENABLED ? user_trailingslashit( $this->resetUrl ) : rtrim( $this->resetUrl, '/' ) . '/';

            // Maybe add GET parameters
            $exclude_params   = array_keys( $this->setCorrectGetKeys( $requested ) );
            $exclude_params[] = 'srch';

            if( ! empty( $get ) ){
                foreach ( $get as $name => $value ) {
                    if( ! in_array( $name, $exclude_params ) ){
                        $this->resetUrl = add_query_arg( $name, $value, $this->resetUrl );
                    }
                }
            }
        }

        return $this->resetUrl;
    }

    /**
     * Removes '/page/n' from URL
     * @param $url
     * @return string
     */
    private function removePaginationBase( $url = '' )
    {
        global $wp_rewrite;

        $pagination_base          = str_replace( "-", "\-", $wp_rewrite->pagination_base );
        $comments_pagination_base = str_replace( "-", "\-", $wp_rewrite->comments_pagination_base );

        $url = preg_replace('%\/'.$pagination_base.'/[0-9]+%', '', $url );
        $url = preg_replace('%\/'.$comments_pagination_base.'\-[0-9]+%', '', $url );
        $url = preg_replace('%\/[0-9]+[\/]?$%m', '', $url );

        return $url;
    }

    public function getValuesSeparator()
    {
        return $this->valuesSeparator;
    }

    public function getLogicParamName( $slug )
    {
        return $this->getParamName( $slug ).'_'.$this->logicParam;
    }

    public function getParamName( $slug )
    {
        return sanitize_title( $slug );
    }

    private function getSingleActualFilter( $e_name )
    {
        $filter = $this->em->getFilterByEname( $e_name );
        $filter['values'] = [];
        return $filter;
    }

    private function buildFilterSegment( $termSlugs, $filter ){
        $segment = $filter['slug'] . $this->separator;
        $fse     = Container::instance()->getFilterService();

        if( ! is_array( $termSlugs ) ){
            return false;
        }

        /**
         * @bug if filter is present in two sets logic gets incorrect
         */

        $termSlugs  = $fse->sortTerms( $termSlugs );
        $terms      = implode( $fse->getLogicSeparator( $filter['logic'] ), $termSlugs );
        $segment    .= $terms;

        unset($fse);

        return $segment;
    }
}