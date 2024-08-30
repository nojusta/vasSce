<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class Filter
{
    public $filters = [];

    private $logicSeparators;

    public $sep = '#';

    public function __construct(){
        $this->logicSeparators = array(
            'or'    => '-or-',
            'and'   => '-and-'
        );
    }

    public function getEmptyFilter()
    {
        return apply_filters( 'wpc_filter_defaults', array(
                    'ID'         => '',
                    'parent'     => '',
                    'menu_order' => '',
                    'entity'     => '',
                    'e_name'     => '',
                    'label'      => '',
                    'slug'       => '',
                    'view'       => '',
                    'dropdown_label' => '',
                    'date_type'  => '',
                    'date_format'  => '',
                    'show_term_names' => '',
                    'logic'      => '',
                    'orderby'    => '',
                    'in_path'    => '',
                    'exclude'    => '',
                    'include'    => '',
                    'collapse'   => '',
                    'a_labels'   => '',
                    'hierarchy'  => '',
                    'used_for_variations' => '',
                    'range_slider' => '',
                    'step'       => '',
                    'search'     => '',
                    'parent_filter' => '',
                    'hide_until_parent' => '',
                    'min_num_label' => '',
                    'max_num_label' => '',
                    'tooltip'    => '',
                    'more_less'  => '',
                    'show_chips' => '',
                    'acf_fields'  => '',
            )
        );
    }

    public function getEntityKey( $entity, $e_name = '' )
    {
        if ( $entity === 'post_date' ) {
            return $entity . $this->sep . $entity;
        }

        // Meta field or Tax numeric
        if ( $e_name ) {
            return $entity . $this->sep . $e_name;
        }

        // Replace first "_" with $this->sep in taxonomy entity
        if ( mb_strpos( $entity, '_' ) !== false ) {
            $_position = strpos( $entity, '_' );
            return substr_replace( $entity, $this->sep, $_position, 1 );
        }

        return $entity;
    }

    public function getEntityCanonicalName( $entity )
    {
        if( mb_strpos( $entity, 'post_meta' ) !== false || mb_strpos( $entity, 'tax_numeric' ) !== false || mb_strpos( $entity, 'post_date' ) !== false ){
            $canonical = explode( $this->sep, $entity, 2 );
            return $canonical[0];
        } else {
            return str_replace( $this->sep, '_', $entity );
        }

    }

    public function getEntityFullName( $entity, $e_name )
    {
        if( ! empty( $e_name ) ){
            return $entity . $this->sep . $e_name;
        }
        return $entity;
    }

    public function getEntityEname( $entityFullName )
    {
        if( mb_strpos( $entityFullName, $this->sep ) !== false ){
            $pieces = explode( $this->sep, $entityFullName, 2 );
            return $pieces[1];
        }

        return $entityFullName;
    }

    /**
     * Determines whether to modify or not e_name for a filter
     * @param $filter array with filter properties
     * @return bool
     */
    public function needEntityToModifyEname( $filter )
    {
        // taxonomy_pa_size
        // taxonomy_pa_color
        // author_author || author
        // tax_numeric
        if( mb_strpos( $filter['entity'], 'taxonomy' ) === false
            &&
            mb_strpos( $filter['entity'], 'author' ) === false
            &&
            ! in_array( $filter['entity'], [ 'tax_numeric' , 'post_date' ] ) ){
            return false;
        }
        return true;
    }

    public function splitEntityFullNameInFilter( $filter )
    {
        if ( ! $this->needEntityToModifyEname( $filter ) ) {
            return $filter;
        }

        if ( mb_strpos( $filter['entity'], 'taxonomy' ) !== false ) {
            $filter['e_name'] = mb_strcut( $filter['entity'], strlen( 'taxonomy_' ) );
            $filter['entity'] = 'taxonomy';
            return $filter;
        }

        if ( mb_strpos( $filter['entity'], 'author' ) !== false ) {
            $filter['e_name'] = 'author';
            $filter['entity'] = 'author';
            return $filter;
        }

        if ( mb_strpos( $filter['entity'], 'post_date' ) !== false ) {
            $filter['e_name'] = 'post_date';
            $filter['entity'] = 'post_date';
            return $filter;
        }

        return $filter;
    }

    public function combineEntityNameInFilter( $filter )
    {

        if( ! $this->needEntityToModifyEname( $filter ) ){
            return $filter;
        }

        if( mb_strpos( $filter['entity'], 'taxonomy' ) !== false ){
            $filter['entity'] = $filter['entity'] . '_' . $filter['e_name'];
            $filter['e_name']   = '';
            return $filter;
        }

        if( mb_strpos( $filter['entity'], 'author' ) !== false ){
            $filter['entity'] = 'author_author';
            $filter['e_name'] = '';
            return $filter;
        }

        return $filter;
    }

    public function filterExists( $newFilter ){
        foreach ( $this->filters as $filter ) {
            if( $filter['e_name'] === $newFilter['e_name'] ){
                return true;
            }

            if( $filter['slug'] === $newFilter['slug']  ){
                return true;
            }
        }

        return false;
    }

    public function isFilterInPath( $filter ){
        if( $filter['in_path'] === 'yes' ){
            return true;
        }
        return false;
    }

    public function isFilterInQueryString( $filter ){
        if( $filter['in_path'] === 'no' ){
            return true;
        }
        return false;
    }

    public function getFiltersOrder()
    {
        $permalinksTab = new PermalinksTab();
        return array_keys( get_option( $permalinksTab->optionName, [] ) );
    }

    public function sortTerms( $terms = [] ){
        asort( $terms );
        return $terms;
    }

    public function getLogicSeparator( $logic ){
        return $this->logicSeparators[ $logic ];
    }

}