<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class Chips
{
    public $chips = [];
    
    private $queried;

    private $showReset;

    private $counter = 1;

    private $setFilterKeys = [];

    public function __construct( $showReset = false, $setIds = [] )
    {
        $em                 = Container::instance()->getEntityManager();
        $wpManager          = Container::instance()->getWpManager();

        $this->queried      = $wpManager->getQueryVar('queried_values');
        $sets               = $wpManager->getQueryVar('wpc_page_related_set_ids');

        $this->showReset    = $showReset;

        if( ! $setIds || empty( $setIds ) ){
            foreach ( $sets as $set ){
                $setIds[] = $set['ID'];
            }
        }

        if( $setIds ){
            $this->setFilterKeys = $em->getSetFilterKeys( $setIds );

            foreach ($sets as $set) {
                if( in_array( $set['ID'], $setIds ) ){
                    $postType = $set['filtered_post_type'];
                    $this->fillChips( $postType );
                }
            }
        }

        unset( $em );

    }
    
    private function fillChips( $postType = '' )
    {
        if( $this->queried || ( isset( $_GET['srch'] ) && $_GET['srch'] ) ) {
            $em = Container::instance()->getEntityManager();
            $urlManager = Container::instance()->getUrlManager();

            if ($this->showReset) {

                $toAdd = array(
                    'link' => $urlManager->getResetUrl(),
                    'name' => esc_html__('Reset all', 'filter-everything'),
                    'class' => 'wpc-chip-reset-all'
                );

                if (!in_array($toAdd, $this->chips) ) {
                    $this->chips[$this->counter] = $toAdd;
                    $this->counter++;
                }

            }

            if ( $this->queried ) {
                foreach ($this->queried as $slug => $filter) {

                    if (isset($filter['show_chips']) && ($filter['show_chips'] !== 'yes')) {
                        continue;
                    }

                    if (!empty($this->setFilterKeys)) {
                        $queried_value_key = $filter['entity'] . '#' . $filter['e_name'];
                        if (!in_array($queried_value_key, $this->setFilterKeys)) {
                            continue;
                        }
                    }

                    $entityObj = $em->getEntityByFilter($filter, $postType);

                    foreach ($filter['values'] as $key => $termSlug) {

                        if ( in_array($filter['entity'], ['post_meta_num', 'tax_numeric', 'post_date'] ) ) {
                            $termSlug = $key;
                        }

                        $termId = $entityObj->getTermId( $termSlug );
                        $term = $entityObj->getTerm( $termId );

                        // In case if we have no terms for this post type
                        if (!$term) {
                            continue;
                        }

                        $toAdd = array(
                            'link'  => $urlManager->getTermUrl( $termSlug, $filter['e_name'], $filter['entity'] ),
                            'name'  => apply_filters( 'wpc_chips_term_name', $term->name, $term, $filter ),
                            'class' => 'wpc-chip-' . $filter['e_name'] . '-' . $termId,
                            'label' => $filter['label']
                        );

                        if ( ! in_array( $toAdd, $this->chips ) ) {
                            $this->chips[$this->counter] = $toAdd;
                            $this->counter++;
                        }
                    }
                }
            }

            $srch = isset( $_GET['srch'] ) ? filter_input( INPUT_GET, 'srch', FILTER_SANITIZE_SPECIAL_CHARS ) : '';
            if ( $srch ){

                $clear_search_url = $urlManager->getTermUrl( '', '', '', '', [ 'srch'=> true ] );

                $toAdd = array(
                    'link'  => $clear_search_url,
                    'name'  => sprintf( __( 'search: %s', 'filter-everything' ), $srch ),
                    'class' => 'wpc-chip-search',
                    'label' => $srch,
                );

                if( ! in_array( $toAdd, $this->chips ) ) {
                    $this->chips[$this->counter] = $toAdd;
                    $this->counter++;
                }
            }

            if( count( $this->chips ) === 1 ){
                $singleChip = reset( $this->chips );
                if( $singleChip['class'] === 'wpc-chip-reset-all' ){
                    $this->chips = [];
                }
            }

            unset( $em, $urlManager );

        }
    }

    public function getChips()
    {
        if( ! empty( $this->chips ) ){
            return $this->chips;
        }
        return false;
    }

}