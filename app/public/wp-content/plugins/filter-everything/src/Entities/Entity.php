<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

interface Entity
{
    function getName();

    function getAllExistingTerms( $force );

    function addTermsToWpQuery($a, $b);

    function populateTermsWithPostIds( $setId, $post_type );

    function getTermId($slug);

    function setExcludedTerms( $excludedTerms, $isInclude );

    public function getTermsForSelect();

    public function getTerms();

    public function setPostTypes( $postTypes );

    /**
     * @feature maybe add function to exclude terms
     *  from WP_Query();
    */
}