<?php
function templategalaxy_demo_importer_get_templates_lists($theme_slug)
{
    switch ($theme_slug):
        case "blogpoet":
            $demo_templates_lists = array(
                'blogpoet' => array(
                    'title' => esc_html__('Blogpoet', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('Blogpoet', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/blogpoet/free/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/blogpoet/free/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/blogpoet/free/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/blogpoet/free/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/blogpoet/',
                    'plugins' => ''
                ),
                'blogpoet-pro' => array(
                    'title' => esc_html__('Blogpoet Pro', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('Blogpoet pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/blogpoet/pro/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/blogpoet/pro/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/blogpoet/pro/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/blogpoet/pro/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/blogpoet-pro/',
                    'plugins' => ''
                ),
            );
            break;
        case "mediator":
            $demo_templates_lists = array(
                'mediator' => array(
                    'title' => esc_html__('Mediator', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('mediator', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/mediator/free/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/mediator/free/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/mediator/free/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/mediator/free/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/mediator/',
                    'plugins' => ''
                ),
                'mediator-pro' => array(
                    'title' => esc_html__('Mediator Pro', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('mediator pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/mediator/pro/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/mediator/pro/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/mediator/pro/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/mediator/pro/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/mediator-pro/',
                    'plugins' => ''
                ),
            );
            break;
        case "gazettepress":
            $demo_templates_lists = array(
                'gazettepress' => array(
                    'title' => esc_html__('GazettePress', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('gazettepress', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/free/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/free/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/free/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/free/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/gazettepress/',
                    'plugins' => ''
                ),
                'gazettepress-pro' => array(
                    'title' => esc_html__('GazettePress Pro', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('gazettepress pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/gazettepress-pro/',
                    'plugins' => ''
                ),
                'gazettepress-pro-2' => array(
                    'title' => esc_html__('GazettePress Pro 2', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('gazettepress pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/2/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/2/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/2/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/2/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/gazettepress-pro-2/',
                    'plugins' => ''
                ),
                'gazettepress-pro-3' => array(
                    'title' => esc_html__('GazettePress Pro 3', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('gazettepress pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/3/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/3/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/gazettepress/pro/3/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/gazettepress-pro-3/',
                    'plugins' => ''
                )
            );
            break;
        case "millipede":
            $demo_templates_lists = array(
                'millipede' => array(
                    'title' => esc_html__('Millipede', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('millipede', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/millipede/free/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/millipede/free/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/millipede/free/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/millipede/free/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/millipede/',
                    'plugins' => ''
                ),
                'millipede-pro' => array(
                    'title' => esc_html__('Millipede Pro', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('millipede pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/millipede/pro/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/millipede/pro/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/millipede/pro/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/millipede/pro/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/millipede-pro/',
                    'plugins' => ''
                ),
            );
            break;
        case "shopcity":
            $demo_templates_lists = array(
                'shopcity' => array(
                    'title' => esc_html__('Default Demo', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity/',
                    'plugins' => ''
                ),
                'shopcity-2' => array(
                    'title' => esc_html__('Demo 2', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/2/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/2/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/2/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/2/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity-2/',
                    'plugins' => ''
                ),
                'shopcity-3' => array(
                    'title' => esc_html__('Demo 3', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/3/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/3/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/3/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/3/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity-3/',
                    'plugins' => ''
                ),
                'shopcity-4' => array(
                    'title' => esc_html__('Demo 4', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/4/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/4/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/4/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/4/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity-4/',
                    'plugins' => ''
                ),
                'shopcity-5' => array(
                    'title' => esc_html__('Demo 5', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/5/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/5/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/5/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/5/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity-5/',
                    'plugins' => ''
                ),
                'shopcity-6' => array(
                    'title' => esc_html__('Demo 6', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/6/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/6/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/6/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/free/6/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity-6/',
                    'plugins' => ''
                ),
                'shopcity-pro' => array(
                    'title' => esc_html__('Shopcity Pro', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity-pro/',
                    'plugins' => ''
                ),
                'shopcity-pro-2' => array(
                    'title' => esc_html__('Demo Pro', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/2/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/2/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/2/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/2/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity-pro-2/',
                    'plugins' => ''
                ),
                'shopcity-pro-3' => array(
                    'title' => esc_html__('Demo Pro 3', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('shopcity pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/3/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/3/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/3/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/shopcity/pro/3/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/shopcity-pro-3/',
                    'plugins' => ''
                ),
            );
            break;
        case "avatarnews":
            $demo_templates_lists = array(
                'avatarnews' => array(
                    'title' => esc_html__('Default', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('avatarnews', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/free/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/free/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/free/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/free/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/avatarnews/',
                    'plugins' => ''
                ),
                'avatarnews-grid' => array(
                    'title' => esc_html__('Grid Demo', 'templategalaxy'),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('avatarnews', 'templategalaxy'),  /*Search keyword*/
                    'categories' => array('free'), /*Categories*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/free/2/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/free/2/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/free/2/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/free/2/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/avatarnews-grid/',
                    'plugins' => ''
                ),
                'avatarnews-pro' => array(
                    'title' => esc_html__('AvatarNews Pro 3', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('avatarnews pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/1/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/1/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/1/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/1/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/avatarnews-pro-3/',
                    'plugins' => ''
                ),
                'avatarnews-pro-2' => array(
                    'title' => esc_html__('AvatarNews Pro 1', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('avatarnews pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/2/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/2/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/2/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/2/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/avatarnews-pro-1/',
                    'plugins' => ''
                ),
                'avatarnews-pro-3' => array(
                    'title' => esc_html__('AvatarNews Pro 3', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('avatarnews pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/3/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/3/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/3/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/3/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/avatarnews-pro-2/',
                    'plugins' => ''
                ),
                'avatarnews-pro-4' => array(
                    'title' => esc_html__('AvatarNews Minimal Pro', 'templategalaxy'),/*Title*/
                    'is_pro' => true,  /*Premium*/
                    'type' => 'premium',
                    'author' => esc_html__('WebsiteinWP', 'templategalaxy'),    /*Author Name*/
                    'keywords' => array('avatarnews pro', 'multipurpose'),  /*Search keyword*/
                    'template_url' => array(
                        'content' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/4/content.json',
                        'options' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/4/options.json',
                        'widgets' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/4/widgets.json'
                    ),
                    'screenshot_url' => TEMPLATEGALAXY_IMPORTER_SETUP_TEMPLATE_URL . '/avatarnews/pro/4/screenshot.png',
                    'demo_url' => 'https://demos.websiteinwp.com/avatarnews-pro/',
                    'plugins' => ''
                ),
            );
            break;
        default:
            $demo_templates_lists = array();
    endswitch;

    return $demo_templates_lists;
}
