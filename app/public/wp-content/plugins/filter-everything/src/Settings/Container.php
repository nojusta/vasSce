<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

use FilterEverything\Filter\Pro\SeoFrontend;

class Container
{
    private static $instance;

    private $services = [];

    private $params = [];

    private function __construct()
    {
    }

    public function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function storeParam($key, $value)
    {
        if (!isset($this->params[$key])) {
            $this->params[$key] = $value;
        }
    }

    public function getParam($key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
        return false;
    }

    public function getService($key)
    {
        if (isset($this->services[$key])) {
            return $this->services[$key];
        }
    }

    public function addService($key, $service)
    {
        $this->services[$key] = $service;
    }

    public function getEntityManager()
    {
        if (!isset($this->services['entitymanager'])) {
            $this->addService('entitymanager', new EntityManager());
        }

        return $this->getService('entitymanager');
    }

    public function getFilterService()
    {
        if (!isset($this->services['filterservice'])) {
            $this->addService('filterservice', new Filter() );
        }

        return $this->getService('filterservice');
    }

    public function getUrlManager()
    {
        if ( ! isset( $this->services['urlmanager'] ) ) {
            $this->addService('urlmanager', new UrlManager() );
        }
        return $this->getService('urlmanager');
    }

    public function getTemplateManager()
    {
        if (!isset($this->services['templatemanager'])) {
            $this->addService('templatemanager', new TemplateManager(FLRT_PLUGIN_DIR_PATH));
        }

        return $this->getService('templatemanager');
    }

    public function getFilterSetService()
    {
        if (!isset($this->services['filterset'])) {
            $this->addService('filterset', new FilterSet());
        }

        return $this->getService('filterset');
    }

    public function getFilterFieldsService()
    {
        if (!isset($this->services['filterfields'])) {
            $this->addService('filterfields', new FilterFields());
        }

        return $this->getService('filterfields');
    }

    public function getWpManager()
    {
        if (!isset($this->services['wpmanager'])) {
            $this->addService('wpmanager', new WpManager());
        }

        return $this->getService('wpmanager');
    }

    public function getSeoFrontendService()
    {
        if( class_exists('FilterEverything\Filter\Pro\SeoFrontend') ) {
            if (!isset($this->services['seofrontend'])) {
                $this->addService('seofrontend', new SeoFrontend());
            }

            return $this->getService('seofrontend');
        }

        return new \stdClass();
    }

    public function getTabRenderer()
    {
        if (!isset($this->services['tabrenderer'])) {
            $this->addService('tabrenderer', new TabRenderer());
        }

        return $this->getService('tabrenderer');
    }

    public function getSwatches()
    {
        if ( !isset( $this->services['swatches'] ) ) {
            $this->addService('swatches', new Swatches() );
        }

        return $this->getService('swatches' );
    }

    /**
     * Sanitizes $_GET variables and stores them in the Container
     * @return false|mixed
     */
    public function getTheGet()
    {
        if ( ! $this->getParam('get') ) {
            $clean_get = [];

            if ( is_array( $_GET ) ) {
                foreach ( $_GET as $param => $value ) {
                    $clean_get[ $param ] = flrt_string_polyfill( $value );
                }
            }

            $this->storeParam( 'get', $clean_get );
        }

        return $this->getParam('get');
    }

    public function getThePost()
    {
        if( ! $this->getParam('post') ){
            $this->storeParam( 'post', $_POST );
        }

        return $this->getParam('post');
    }

}