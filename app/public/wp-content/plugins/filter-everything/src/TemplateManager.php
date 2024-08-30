<?php

namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class TemplateManager
{
    private $pluginRootDir;

    private $themeRootDir;

    private $pluginUrl;

    public function __construct( $pluginFilePath )
    {
        $this->pluginRootDir = $pluginFilePath;
        $this->pluginUrl     = plugin_dir_url( $pluginFilePath );
        $this->themeRootDir  = get_stylesheet_directory();
    }

    public function includeAdminView( $path, array $variables = [] )
    {
        $file = $this->pluginRootDir . 'views/admin/' . $path . '.php';

        $file = apply_filters( 'wpc_include_admin_view', $file, $path, $variables );

        if( file_exists( $file ) ){
            extract( $variables );
            include $file;
        }

    }

    public function includeFrontView( $path, $variables = [] )
    {
        $file = locate_template( array( FLRT_TEMPLATES_DIR_NAME . '/' . $path . '.php') );

        if( '' === $file ){
            $file = $this->pluginRootDir . 'views/frontend/' . $path . '.php';
        }

        $file = apply_filters( 'wpc_include_front_view', $file, $path, $variables );

        if( file_exists( $file ) ){
            extract( $variables );
            include $file;
        }
    }
}