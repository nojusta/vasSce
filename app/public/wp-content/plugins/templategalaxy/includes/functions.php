<?php
if (!function_exists('templategalaxy_block_assets_loading')) {
    function templategalaxy_block_assets_loading()
    {
        wp_enqueue_style("templategalaxy-swiper-style", TEMPLATEGALAXY_URL . 'assets/css/swiper-bundle.css');
        wp_enqueue_style("templategalaxy-block-style", TEMPLATEGALAXY_URL . 'assets/css/block.css');
        wp_enqueue_script('jquery');
        wp_enqueue_script("templategalaxy-swiper-js", TEMPLATEGALAXY_URL . 'assets/js/swiper-bundle.js', '', '', true);
        wp_enqueue_script("templategalaxy-custom-js", TEMPLATEGALAXY_URL . 'assets/js/templategalaxy-scripts.js', '', '', true);
    }
    add_action('enqueue_block_assets', 'templategalaxy_block_assets_loading');
}
if (!function_exists('templategalaxy_layout_scripts_loading')) {
    function templategalaxy_layout_scripts_loading()
    {
        wp_enqueue_style("templategalaxy-layout-style", TEMPLATEGALAXY_URL . 'assets/css/layout.css');
    }
    add_action('wp_enqueue_scripts', 'templategalaxy_layout_scripts_loading');
}
if (!function_exists('templategalaxy_admin_scripts_loading')) {
    function templategalaxy_admin_scripts_loading()
    {
        wp_enqueue_style("templategalaxy-admin-style", TEMPLATEGALAXY_URL . 'assets/css/admin-style.css');
    }
    add_action('admin_enqueue_scripts', 'templategalaxy_admin_scripts_loading');
}

function tg_display_current_date_day()
{
    $current_datetime = date_i18n('l, M j, Y');
    return $current_datetime;
}
add_shortcode('TG_CURRENT_DATE_WITH_DAY', 'tg_display_current_date_day');
function tg_display_current_date()
{
    $current_datetime = date_i18n('M j, Y');
    return $current_datetime;
}
add_shortcode('TG_CURRENT_DATE', 'tg_display_current_date');

function tg_display_current_time()
{
    $current_time = date_i18n(get_option('time_format'));
    return $current_time;
}
add_shortcode('TG_CURRENT_TIME', 'tg_display_current_time');
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        function templategalaxy_block_pattern()
        {
            $tg_slider_frame_pattern = '
    <!-- wp:group {"lock":{"move":false,"remove":false},"className":"tg-slider"} -->
<div id="TG-SLIDER" class="wp-block-group tg-slider"><!-- wp:group {"lock":{"move":false,"remove":true},"className":"swiper-wrapper"} -->
<div id="slide-holder" class="wp-block-group swiper-wrapper"><!-- wp:cover {"customOverlayColor":"#4361f5","minHeight":560,"contentPosition":"center center","lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"foreground-alt","className":"swiper-slide","layout":{"type":"constrained","contentSize":"660px"}} -->
<div class="wp-block-cover swiper-slide has-foreground-alt-color has-text-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);min-height:560px" id="tg-slide"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim" style="background-color:#4361f5"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"xxx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size" style="font-style:normal;font-weight:500">' . __('Slider One', 'templategalaxy') . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}}} -->
<p class="has-text-align-center" style="line-height:1.5">' . __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
<div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background-alt","style":{"spacing":{"padding":{"left":"35px","right":"35px","top":"17px","bottom":"17px"}},"border":{"radius":"60px"},"color":{"background":"#f9b659"}},"fontSize":"medium"} -->
<div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-background-alt-color has-text-color has-background wp-element-button" style="border-radius:60px;background-color:#f9b659;padding-top:17px;padding-right:35px;padding-bottom:17px;padding-left:35px">' . __('Read More', 'templategalaxy') . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"customOverlayColor":"#4361f5","minHeight":560,"contentPosition":"center center","lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"foreground-alt","className":"swiper-slide","layout":{"type":"constrained","contentSize":"660px"}} -->
<div class="wp-block-cover swiper-slide has-foreground-alt-color has-text-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);min-height:560px" id="tg-slide"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim" style="background-color:#4361f5"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"xxx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-xxx-large-font-size" style="font-style:normal;font-weight:500">' . __('Slider Two', 'templategalaxy') . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}}} -->
<p class="has-text-align-center" style="line-height:1.5">' . __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'templategalaxy') . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
<div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background-alt","style":{"spacing":{"padding":{"left":"35px","right":"35px","top":"17px","bottom":"17px"}},"border":{"radius":"60px"},"color":{"background":"#f9b659"}},"fontSize":"medium"} -->
<div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-background-alt-color has-text-color has-background wp-element-button" style="border-radius:60px;background-color:#f9b659;padding-top:17px;padding-right:35px;padding-bottom:17px;padding-left:35px">' . __('Schedule Appointment', 'templategalaxy') . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<!-- wp:group {"lock":{"move":false,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
<div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
<div class="swiper-pagination tg-slider-pagination"></div>
                                <div class="tg-swiper-navigations">
                                <div class="swiper-button-next tg-slider-next"></div>
                                <div class="swiper-button-prev tg-slider-prev"></div>
                                </div>
<!-- /wp:html --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
    ';
            register_block_pattern(
                'tg-slider',
                array(
                    'title'       => __('TG BLOCK: Slider', 'templategalaxy'),
                    'description' => __('Slider for Template Galaxy', 'templategalaxy'),
                    'content'     => $tg_slider_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );

            $tgpost_slider_frame_pattern = '
            <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="POST-SLIDER" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-slider"} -->
            <div class="wp-block-query tg-post-slider"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
            <!-- wp:cover {"useFeaturedImage":true,"dimRatio":90,"minHeight":540,"customGradient":"linear-gradient(180deg,rgba(0,0,0,0) 32%,rgb(0,0,0) 100%)","contentPosition":"bottom left","style":{"spacing":{"padding":{"right":"30px","left":"30px","top":"30px","bottom":"30px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
            <div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;min-height:540px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-90 has-background-dim has-background-gradient" style="background:linear-gradient(180deg,rgba(0,0,0,0) 32%,rgb(0,0,0) 100%)"></span><div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category"} /-->
            
            <!-- wp:post-title {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"},":hover":{"color":{"text":"#0279be"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"xxx-large"} /-->
            
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:post-author-name {"textColor":"background"} /-->
            
            <!-- wp:post-date {"textColor":"background"} /--></div>
            <!-- /wp:group --></div></div>
            <!-- /wp:cover -->
            <!-- /wp:post-template -->
            
            <!-- wp:group {"lock":{"move":true,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
            <div class="tgpost-slider-pagination swiper-pagination"></div>
                                            <div class="tg-swiper-navigations">
                                            <div class="swiper-button-next tgpost-slider-next"></div>
                                            <div class="swiper-button-prev tgpost-slider-prev"></div>
                                            </div>
            <!-- /wp:html --></div>
            <!-- /wp:group --></div>
            <!-- /wp:query --></div>
            <!-- /wp:group -->
    ';
            register_block_pattern(
                'tgpost-slider',
                array(
                    'title'       => __('TG BLOCK: Post Slider', 'templategalaxy'),
                    'description' => __('Post Slider for Template Galaxy', 'templategalaxy'),
                    'content'     => $tgpost_slider_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );

            $tgpost_carousel_frame_pattern = '
            <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"4","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-carousel"} -->
            <div class="wp-block-query tg-post-carousel"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
            <!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:post-featured-image /-->
            
            <!-- wp:post-terms {"term":"category"} /-->
            
            <!-- wp:post-title {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"},":hover":{"color":{"text":"#0279be"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"large"} /-->
            
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:post-author-name {"textColor":"light-gray"} /-->
            
            <!-- wp:post-date {"textColor":"light-gray"} /--></div>
            <!-- /wp:group --></div>
            <!-- /wp:group -->
            <!-- /wp:post-template -->
            
            <!-- wp:group {"lock":{"move":true,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
            <div class="swiper-pagination tgpost-carousel-pagination"></div>
                                            <div class="tg-swiper-navigations">
                                            <div class="swiper-button-next tgpost-carousel-next"></div>
                                            <div class="swiper-button-prev tgpost-carousel-prev"></div>
                                            </div>
            <!-- /wp:html --></div>
            <!-- /wp:group --></div>
            <!-- /wp:query --></div>
            <!-- /wp:group -->
    ';
            register_block_pattern(
                'tgpost-carousel',
                array(
                    'title'       => __('TG BLOCK: Post Carousel', 'templategalaxy'),
                    'description' => __('Post Carousel for Template Galaxy', 'templategalaxy'),
                    'content'     => $tgpost_carousel_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );

            $tgcontent_carousel_frame_pattern = '
    <!-- wp:group {"lock":{"move":false,"remove":false},"className":"tg-content-carousel"} -->
<div id="CONTENT-CAROUSEL" class="wp-block-group tg-content-carousel"><!-- wp:group {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"0"}},"className":"swiper-wrapper"} -->
<div id="slide-holder" class="wp-block-group swiper-wrapper"><!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:image {"align":"full","id":1113,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image alignfull size-full"><img src="' . esc_url(TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/thumbnail.png') . '" alt="" class="wp-image-1113"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background-alt","fontSize":"xxx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-background-alt-color has-text-color has-xxx-large-font-size" style="font-style:normal;font-weight:500">' . __('Title One', 'templategalaxy') . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}},"textColor":"foreground"} -->
<p class="has-text-align-center has-foreground-color has-text-color" style="line-height:1.5">' . __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
<div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background-alt","style":{"spacing":{"padding":{"left":"35px","right":"35px","top":"17px","bottom":"17px"}},"border":{"radius":"60px"},"color":{"background":"#faa055"}},"fontSize":"medium"} -->
<div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-background-alt-color has-text-color has-background wp-element-button" style="border-radius:60px;background-color:#faa055;padding-top:17px;padding-right:35px;padding-bottom:17px;padding-left:35px">' . __('Read More', 'templategalaxy') . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:image {"align":"full","id":1113,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image alignfull size-full"><img src=" ' . esc_url(TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/thumbnail.png') . ' " alt="" class="wp-image-1113"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background-alt","fontSize":"xxx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-background-alt-color has-text-color has-xxx-large-font-size" style="font-style:normal;font-weight:500">' . __('Title Two', 'templategalaxy') . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}},"textColor":"foreground"} -->
<p class="has-text-align-center has-foreground-color has-text-color" style="line-height:1.5">' . __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
<div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background-alt","style":{"spacing":{"padding":{"left":"35px","right":"35px","top":"17px","bottom":"17px"}},"border":{"radius":"60px"},"color":{"background":"#faa055"}},"fontSize":"medium"} -->
<div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-background-alt-color has-text-color has-background wp-element-button" style="border-radius:60px;background-color:#faa055;padding-top:17px;padding-right:35px;padding-bottom:17px;padding-left:35px">' . __('Read More', 'templategalaxy') . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:image {"align":"full","id":1113,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image alignfull size-full"><img src="' . esc_url(TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/thumbnail.png') . '" alt="" class="wp-image-1113"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background-alt","fontSize":"xxx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-background-alt-color has-text-color has-xxx-large-font-size" style="font-style:normal;font-weight:500">' . __('Title Three', 'templategalaxy') . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}},"textColor":"foreground"} -->
<p class="has-text-align-center has-foreground-color has-text-color" style="line-height:1.5">' . __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
<div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background-alt","style":{"spacing":{"padding":{"left":"35px","right":"35px","top":"17px","bottom":"17px"}},"border":{"radius":"60px"},"color":{"background":"#faa055"}},"fontSize":"medium"} -->
<div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-background-alt-color has-text-color has-background wp-element-button" style="border-radius:60px;background-color:#faa055;padding-top:17px;padding-right:35px;padding-bottom:17px;padding-left:35px">' . __('Read More', 'templategalaxy') . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
<div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:image {"align":"full","id":1113,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image alignfull size-full"><img src="' . esc_url(TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/thumbnail.png') . '" alt="" class="wp-image-1113"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background-alt","fontSize":"xxx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-background-alt-color has-text-color has-xxx-large-font-size" style="font-style:normal;font-weight:500">' . __('Title Four', 'templategalaxy') . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}},"textColor":"foreground"} -->
<p class="has-text-align-center has-foreground-color has-text-color" style="line-height:1.5">' . __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
<div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background-alt","style":{"spacing":{"padding":{"left":"35px","right":"35px","top":"17px","bottom":"17px"}},"border":{"radius":"60px"},"color":{"background":"#faa055"}},"fontSize":"medium"} -->
<div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-background-alt-color has-text-color has-background wp-element-button" style="border-radius:60px;background-color:#faa055;padding-top:17px;padding-right:35px;padding-bottom:17px;padding-left:35px">' . __('Read More', 'templategalaxy') . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"lock":{"move":false,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
<div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
<div class="tgcontent-carousel-pagination swiper-pagination"></div>
                                <div class="tg-swiper-navigations">
                                <div class="swiper-button-next tgcontent-slide-next"></div>
                                <div class="swiper-button-prev tgcontent-slide-prev"></div>
                                </div>
<!-- /wp:html --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
    ';
            register_block_pattern(
                'tgcontent-carousel',
                array(
                    'title'       => __('TG BLOCK: Content Carousel', 'templategalaxy'),
                    'description' => __('Content Carousel for Template Galaxy', 'templategalaxy'),
                    'content'     => $tgcontent_carousel_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );
            $tgpost_newsticker_frame_pattern = '
    <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder news-ticker-holder ticker-1","layout":{"type":"constrained","contentSize":"100%"}} -->
<div id="NEWS-TICKER" class="wp-block-group tg-post-slider-holder news-ticker-holder ticker-1" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"4","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-news-ticker"} -->
<div class="wp-block-query tg-news-ticker"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":5,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"},":hover":{"color":{"text":"#0279be"}}}},"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"top":"0","bottom":"0"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"normal"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:group {"lock":{"move":false,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
<div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
<div class="tg-ticker-navigation"><div class="swiper-button-next tg-ticker-next"></div><div class="swiper-button-prev tg-ticker-prev"></div> </div>
<!-- /wp:html --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
    ';
            register_block_pattern(
                'tgpost-newsticker',
                array(
                    'title'       => __('TG BLOCK: News Ticker', 'templategalaxy'),
                    'description' => __('News Ticker for Template Galaxy', 'templategalaxy'),
                    'content'     => $tgpost_newsticker_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );

            $tgpost_newsticker_vertical_frame_pattern = '
            <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":"460px"}},"className":"tg-post-slider-holder news-ticker-holderv ticker-2","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="NEWS-TICKER" class="wp-block-group tg-post-slider-holder news-ticker-holderv ticker-2" style="min-height:460px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-news-ticker-2"} -->
            <div class="wp-block-query tg-news-ticker-2"><!-- wp:post-template {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":3}} -->
            <!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:post-featured-image {"aspectRatio":"4/3","width":"100px","height":"80px","style":{"border":{"radius":"0px"}}} /-->
            
            <!-- wp:group {"style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
            <div class="wp-block-group"><!-- wp:post-title {"level":5,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"},":hover":{"color":{"text":"#0279be"}}}},"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"top":"0","bottom":"0"}},"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"18px"}}} /-->
            
            <!-- wp:post-date /--></div>
            <!-- /wp:group --></div>
            <!-- /wp:group --></div>
            <!-- /wp:group -->
            <!-- /wp:post-template -->
            
            <!-- wp:group {"lock":{"move":true,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
            <div class="tgv-ticker-navigation"><div class="swiper-button-next tgv-ticker-next"></div><div class="swiper-button-prev tgv-ticker-prev"></div> </div>
            <!-- /wp:html --></div>
            <!-- /wp:group --></div>
            <!-- /wp:query --></div>
            <!-- /wp:group -->
    ';
            register_block_pattern(
                'tgpost-newsticker-two',
                array(
                    'title'       => __('TG BLOCK: News Ticker 2', 'templategalaxy'),
                    'description' => __('News Ticker for Template Galaxy', 'templategalaxy'),
                    'content'     => $tgpost_newsticker_vertical_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );
            $tg_current_date_frame_pattern = '
    <!-- wp:shortcode -->
[TG_CURRENT_DATE_WITH_DAY]
<!-- /wp:shortcode -->
    ';
            register_block_pattern(
                'tg_current_date',
                array(
                    'title'       => __('TG BLOCK: Current Date', 'templategalaxy'),
                    'description' => __('Display Current Date for Template Galaxy', 'templategalaxy'),
                    'content'     => $tg_current_date_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );
            $tg_current_time_frame_pattern = '
    <!-- wp:shortcode -->
[TG_CURRENT_TIME]
<!-- /wp:shortcode -->
    ';
            register_block_pattern(
                'tg_current_time',
                array(
                    'title'       => __('TG BLOCK: Current Time', 'templategalaxy'),
                    'description' => __('Display Current time for Template Galaxy', 'templategalaxy'),
                    'content'     => $tg_current_time_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );


            $tg_breadcrumbs_frame_pattern = '
            <!-- wp:shortcode -->
            [TG_BREADCRUMBS]
            <!-- /wp:shortcode -->
            
    ';
            register_block_pattern(
                'tg_breadcrumbs',
                array(
                    'title'       => __('TG BLOCK: Breadcrumbs', 'templategalaxy'),
                    'description' => __('Display Breadcrumbs for Template Galaxy', 'templategalaxy'),
                    'content'     => $tg_breadcrumbs_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );

            $tg_related_post_frame_pattern = '
            <!-- wp:shortcode -->
            [TG_RELATED_POSTS]
            <!-- /wp:shortcode -->
            ';
            register_block_pattern(
                'tg_related_posts',
                array(
                    'title'       => __('TG BLOCK: Related Posts', 'templategalaxy'),
                    'description' => __('Display Related Post for Template Galaxy', 'templategalaxy'),
                    'content'     => $tg_related_post_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );
            $tg_social_share_frame_pattern = '
            <!-- wp:shortcode -->
            [TG_SOCIAL_SHARES]
            <!-- /wp:shortcode -->
            ';
            register_block_pattern(
                'tg_social_shares',
                array(
                    'title'       => __('TG BLOCK: Social Shares', 'templategalaxy'),
                    'description' => __('Display Share on Social Media Icons for Template Galaxy', 'templategalaxy'),
                    'content'     => $tg_social_share_frame_pattern,
                    'categories'  => array('tg-blocks'),
                )
            );
        }




        add_action('init', 'templategalaxy_block_pattern');
    }
}

function templategalaxy_demo_importer_get_theme_name()
{
    $current_theme = wp_get_theme();
    return $current_theme->get('Name');
}

function templategalaxy_demo_importer_plugin_check_activated()
{
    $pluginList = get_option('active_plugins');
    $templategalaxy_demo_importer_plugin = 'advanced-import/advanced-import.php';
    $checkPlugin = in_array($templategalaxy_demo_importer_plugin, $pluginList);
    return $checkPlugin;
}
function templategalaxy_demo_importer_plugin_file_exists()
{
    $templategalaxy_demo_importer_plugin = 'advanced-import/advanced-import.php';
    $pathpluginurl = WP_PLUGIN_DIR . '/' . $templategalaxy_demo_importer_plugin;
    $isinstalled = file_exists($pathpluginurl);
    return $isinstalled;
}
function templategalaxy_demo_importer_get_theme_screenshot()
{
    $current_theme = wp_get_theme();
    return $current_theme->get_screenshot();
}
function templategalaxy_demo_importer_get_current_theme_slug()
{
    $current_theme = wp_get_theme();
    return $current_theme->stylesheet;
}
function templategalaxy_demo_importer_premium_access()
{
    if (class_exists('TemplateGalaxy')) {
        $premium_status = false;
        if (tg_fs()->is__premium_only()) {
            if (tg_fs()->can_use_premium_code()) {
                $premium_status = true;
            }
        }
        return $premium_status;
    }
}
if (templategalaxy_demo_importer_premium_access()) {
    add_action('advanced_import_is_pro_active', 'templategalaxy_demo_importer_set_premium_active');
    function templategalaxy_demo_importer_set_premium_active($is_pro_active)
    {
        return true;
    }
}

function cdi_check_advanced_import_plugin()
{
    if (!is_plugin_active('advanced-import/advanced-import.php')) {
        add_action('admin_notices', 'tg_display_advanced_import_message');
    }
}

function tg_display_advanced_import_message()
{
    $message = sprintf(
        esc_html__('"%1$s" requires "%2$s" to be installed and activated to use one click demo import feature. (Only for perform demo import)', 'cozy-essential-addons'),
        '<strong>' . esc_html__('Template Galaxy', 'template-galaxy') . '</strong>',
        '<strong><a href="' . get_admin_url() . 'plugin-install.php?tab=plugin-information&plugin=advanced-import&TB_iframe=true&width=600&height=550">' . esc_html__('Advanced Import', 'cozy-essential-addons') . '</a></strong>'
    );
    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
}

add_action('admin_init', 'cdi_check_advanced_import_plugin');



if (!function_exists('tg_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function tg_posted_on()
    {
        $time_format = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

        $time_string = sprintf(
            $time_format,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date())
        );

        $posted_on = sprintf(
            esc_html_x('Posted on %s', 'post date', 'templategalaxy'),
            $time_string
        );

        echo '<span class="posted-on">' . $posted_on . '</span>';
    }



endif;

function tg_display_breadcrumbs()
{
    ob_start();
    if (!is_home()) {
        echo '<p id="breadcrumbs">';
        echo '<a href="' . home_url('/') . '">Home</a> / ';
        if (is_category() || is_single()) {
            the_category(' / ');
            if (is_single()) {
                echo " / " . the_title('', '', false);
            }
        } elseif (is_page()) {
            echo the_title('', '', false);
        }
        echo '</p>';
    }
    return ob_get_clean();
}
add_shortcode('TG_BREADCRUMBS', 'tg_display_breadcrumbs');

function tg_display_related_posts()
{
    ob_start();
    global $post;

    // Get the current post's categories and tags
    $post_categories = wp_get_post_categories($post->ID);
    $post_tags = wp_get_post_tags($post->ID);

    // If the post has categories or tags, fetch related posts
    if ($post_categories || $post_tags) {
        $args = array(
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3, // Number of related posts to display
            'category__in' => $post_categories,
            'tag__in' => wp_get_post_tags($post->ID, array('fields' => 'ids')),
            'orderby' => 'rand', // You can change this to modify the order of related posts
        );

        $query = new WP_Query($args); ?>
        <div class="tg-related-post">
            <?php if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post(); ?>
                    <div class="post-box">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        } ?>
                        <h3 class="title-heading"><a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a></h3>
                        <?php tg_posted_on(); ?>
                    </div>
            <?php }
            } ?>
        </div>

<?php wp_reset_postdata();
    }
    return ob_get_clean();
}

add_shortcode('TG_RELATED_POSTS', 'tg_display_related_posts');

function tg_display_social_sharing_icons()
{
    $current_url = urlencode(get_permalink());

    $social_icons = array(
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $current_url,
        'twitter' => 'https://twitter.com/intent/tweet?url=' . $current_url,
        'linkedin' => 'https://www.linkedin.com/shareArticle?url=' . $current_url,
        'whatsapp' => 'https://api.whatsapp.com/send?text=' . $current_url,
        'reddit' => 'https://www.reddit.com/submit?url=' . $current_url,
        'pinterest' => 'https://pinterest.com/pin/create/button/?url=' . $current_url,
        'telegram' => 'https://t.me/share/url?url=' . $current_url,
        'snapchat' => 'https://www.snapchat.com/add/' . esc_attr(get_bloginfo('name')),
    );

    $facebook_icon = '<svg width="14" height="25" viewBox="0 0 14 25" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.5122 14.0625L13.2065 9.53809H8.86523V6.60205C8.86523 5.36426 9.47168 4.15771 11.416 4.15771H13.3896V0.305664C13.3896 0.305664 11.5986 0 9.88623 0C6.31104 0 3.97412 2.16699 3.97412 6.08984V9.53809H0V14.0625H3.97412V25H8.86523V14.0625H12.5122Z" fill="black"/>
    </svg>';
    $twitter_icon = '<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M13.982 10.622 20.54 3h-1.554l-5.693 6.618L8.745 3H3.5l6.876 10.007L3.5 21h1.554l6.012-6.989L15.868 21h5.245l-7.131-10.378Zm-2.128 2.474-.697-.997-5.543-7.93H8l4.474 6.4.697.996 5.815 8.318h-2.387l-4.745-6.787Z"></path></svg>';
    $linkedin_icon = '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M4.89648 21.8745H0.361328V7.27002H4.89648V21.8745ZM2.62646 5.27783C1.17627 5.27783 0 4.07666 0 2.62646C1.03799e-08 1.92988 0.276716 1.26183 0.769274 0.769274C1.26183 0.276716 1.92988 0 2.62646 0C3.32305 0 3.9911 0.276716 4.48366 0.769274C4.97621 1.26183 5.25293 1.92988 5.25293 2.62646C5.25293 4.07666 4.07617 5.27783 2.62646 5.27783ZM21.8701 21.8745H17.3447V14.7651C17.3447 13.0708 17.3105 10.8979 14.9868 10.8979C12.6289 10.8979 12.2676 12.7388 12.2676 14.6431V21.8745H7.73731V7.27002H12.0869V9.26221H12.1504C12.7559 8.11475 14.2349 6.90381 16.4414 6.90381C21.0313 6.90381 21.875 9.92627 21.875 13.8521V21.8745H21.8701Z" fill="black"/>
    </svg>';
    $whatsapp_icon = '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M18.5986 3.17871C16.5527 1.12793 13.8281 0 10.9326 0C4.95605 0 0.0927734 4.86328 0.0927734 10.8398C0.0927734 12.749 0.59082 14.6143 1.53809 16.2598L0 21.875L5.74707 20.3662C7.3291 21.2305 9.11133 21.6846 10.9277 21.6846H10.9326C16.9043 21.6846 21.875 16.8213 21.875 10.8447C21.875 7.94922 20.6445 5.22949 18.5986 3.17871ZM10.9326 19.8584C9.31152 19.8584 7.72461 19.4238 6.34277 18.6035L6.01562 18.4082L2.60742 19.3018L3.51562 15.9766L3.30078 15.6348C2.39746 14.1992 1.92383 12.5439 1.92383 10.8398C1.92383 5.87402 5.9668 1.83105 10.9375 1.83105C13.3447 1.83105 15.6055 2.76855 17.3047 4.47266C19.0039 6.17676 20.0488 8.4375 20.0439 10.8447C20.0439 15.8154 15.8984 19.8584 10.9326 19.8584ZM15.874 13.1104C15.6055 12.9736 14.2725 12.3193 14.0234 12.2314C13.7744 12.1387 13.5938 12.0947 13.4131 12.3682C13.2324 12.6416 12.7148 13.2471 12.5537 13.4326C12.3975 13.6133 12.2363 13.6377 11.9678 13.501C10.376 12.7051 9.33105 12.0801 8.28125 10.2783C8.00293 9.7998 8.55957 9.83398 9.07715 8.79883C9.16504 8.61816 9.12109 8.46191 9.05273 8.3252C8.98437 8.18848 8.44238 6.85547 8.21777 6.31348C7.99805 5.78613 7.77344 5.85938 7.60742 5.84961C7.45117 5.83984 7.27051 5.83984 7.08984 5.83984C6.90918 5.83984 6.61621 5.9082 6.36719 6.17676C6.11816 6.4502 5.41992 7.10449 5.41992 8.4375C5.41992 9.77051 6.3916 11.0596 6.52344 11.2402C6.66016 11.4209 8.43262 14.1553 11.1523 15.332C12.8711 16.0742 13.5449 16.1377 14.4043 16.0107C14.9268 15.9326 16.0059 15.3564 16.2305 14.7217C16.4551 14.0869 16.4551 13.5449 16.3867 13.4326C16.3232 13.3105 16.1426 13.2422 15.874 13.1104Z" fill="black"/>
    </svg>';
    $reddit_icon = '<svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M20.5834 8.37891C19.8509 8.37891 19.2064 8.68164 18.7328 9.15527C16.9896 7.94922 14.641 7.17285 12.0384 7.08984L13.391 0.996094L17.6976 1.96289C17.6976 3.01758 18.557 3.87695 19.6117 3.87695C20.6859 3.87695 21.5502 2.99316 21.5502 1.93848C21.5502 0.883789 20.6908 0 19.6117 0C18.8597 0 18.2103 0.454102 17.888 1.07422L13.1322 0.0195312C12.8929 -0.0439453 12.6586 0.126953 12.5951 0.366211L11.1107 7.08496C8.52769 7.19238 6.20348 7.96875 4.45543 9.17481C3.9818 8.68164 3.31285 8.37891 2.58043 8.37891C-0.134415 8.37891 -1.02309 12.0215 1.46226 13.2666C1.37437 13.6523 1.33531 14.0625 1.33531 14.4727C1.33531 18.5645 5.94469 21.8799 11.6039 21.8799C17.2875 21.8799 21.8968 18.5645 21.8968 14.4727C21.8968 14.0625 21.8529 13.6328 21.7455 13.2471C24.182 11.9971 23.2836 8.37891 20.5834 8.37891ZM5.40269 13.5254C5.40269 12.4512 6.26207 11.5869 7.34117 11.5869C8.39586 11.5869 9.25523 12.4463 9.25523 13.5254C9.25523 14.5801 8.39586 15.4395 7.34117 15.4395C6.26695 15.4443 5.40269 14.5801 5.40269 13.5254ZM15.8666 18.0908C14.0892 19.8682 9.07457 19.8682 7.29723 18.0908C7.10191 17.9199 7.10191 17.6172 7.29723 17.4219C7.46812 17.251 7.77086 17.251 7.94176 17.4219C9.29918 18.8135 13.8011 18.8379 15.2171 17.4219C15.388 17.251 15.6908 17.251 15.8617 17.4219C16.0619 17.6172 16.0619 17.9199 15.8666 18.0908ZM15.8275 15.4443C14.7728 15.4443 13.9134 14.585 13.9134 13.5303C13.9134 12.4561 14.7728 11.5918 15.8275 11.5918C16.9017 11.5918 17.766 12.4512 17.766 13.5303C17.7611 14.5801 16.9017 15.4443 15.8275 15.4443Z" fill="black"/>
    </svg>';
    $pinterest_icon = '<svg width="19" height="25" viewBox="0 0 19 25" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M9.96094 0C4.95117 0 0 3.33984 0 8.74512C0 12.1826 1.93359 14.1357 3.10547 14.1357C3.58887 14.1357 3.86719 12.7881 3.86719 12.4072C3.86719 11.9531 2.70996 10.9863 2.70996 9.09668C2.70996 5.1709 5.69824 2.3877 9.56543 2.3877C12.8906 2.3877 15.3516 4.27734 15.3516 7.74902C15.3516 10.3418 14.3115 15.2051 10.9424 15.2051C9.72656 15.2051 8.68652 14.3262 8.68652 13.0664C8.68652 11.2207 9.97559 9.43359 9.97559 7.5293C9.97559 4.29688 5.39063 4.88281 5.39063 8.78906C5.39063 9.60937 5.49316 10.5176 5.85938 11.2646C5.18555 14.165 3.80859 18.4863 3.80859 21.4746C3.80859 22.3975 3.94043 23.3057 4.02832 24.2285C4.19434 24.4141 4.11133 24.3945 4.36523 24.3018C6.82617 20.9326 6.73828 20.2734 7.85156 15.8643C8.45215 17.0068 10.0049 17.6221 11.2354 17.6221C16.4209 17.6221 18.75 12.5684 18.75 8.0127C18.75 3.16406 14.5605 0 9.96094 0Z" fill="black"/>
    </svg>';
    $telegram_icon = '<svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M21.8107 1.66995L18.5099 17.2364C18.2609 18.335 17.6115 18.6084 16.6887 18.0908L11.6594 14.3848L9.2326 16.7188C8.96405 16.9873 8.73944 17.2119 8.22186 17.2119L8.58319 12.0899L17.9045 3.66702C18.3098 3.30569 17.8166 3.1055 17.2746 3.46683L5.75116 10.7227L0.790218 9.16995C-0.288883 8.83304 -0.308415 8.09085 1.01483 7.57327L20.4191 0.0976854C21.3176 -0.239229 22.1037 0.297881 21.8107 1.66995Z" fill="black"/>
    </svg>';
    $snapchat_icon = '<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M24.9438 18.4249C24.6893 19.0185 23.6137 19.4546 21.6547 19.7588C21.5539 19.8948 21.4704 20.4759 21.337 20.9285C21.2576 21.2003 21.0624 21.3616 20.7448 21.3616L20.7303 21.3613C20.2715 21.3613 19.7926 21.1502 18.8332 21.1502C17.5382 21.1502 17.0919 21.4453 16.0864 22.1555C15.0204 22.9093 13.998 23.56 12.4718 23.4934C10.9266 23.6073 9.63858 22.6678 8.91368 22.1553C7.90225 21.4403 7.45723 21.1503 6.16753 21.1503C5.24644 21.1503 4.66675 21.3808 4.27046 21.3808C3.87627 21.3808 3.72295 21.1404 3.66392 20.9394C3.53194 20.4907 3.44888 19.9011 3.34541 19.7611C2.3357 19.6044 0.0587936 19.2072 0.000785754 18.1913C-0.00624549 18.0636 0.0341045 17.9379 0.114096 17.8381C0.194088 17.7384 0.308089 17.6717 0.434233 17.6508C3.83184 17.0915 5.36216 13.6029 5.42579 13.4548C5.4294 13.4462 5.43335 13.438 5.43736 13.4297C5.61866 13.0617 5.65923 12.7535 5.55762 12.514C5.31104 11.9332 4.24551 11.7248 3.79722 11.5474C2.63926 11.0901 2.47813 10.5646 2.54664 10.2044C2.66563 9.57769 3.60743 9.19199 4.15806 9.4499C4.59356 9.65405 4.98047 9.75737 5.30782 9.75737C5.55303 9.75737 5.70879 9.69858 5.79415 9.65137C5.69439 7.89668 5.44742 5.38916 6.07183 3.98882C7.7209 0.29165 11.2162 0.00434569 12.2475 0.00434569C12.2936 0.00434569 12.6938 0 12.7411 0C15.2874 0 17.734 1.30762 18.9288 3.98647C19.5526 5.3854 19.3071 7.88257 19.2068 9.65098C19.2841 9.69356 19.4196 9.7458 19.6267 9.75542C19.9391 9.74145 20.3013 9.63877 20.7043 9.4499C21.0014 9.31094 21.4077 9.32974 21.7043 9.45273L21.7057 9.45322C22.1684 9.61851 22.4596 9.952 22.4669 10.3258C22.4759 10.8017 22.0508 11.2127 21.2033 11.5474C21.0999 11.5881 20.9741 11.6282 20.8403 11.6707C20.362 11.8223 19.6392 12.0518 19.4431 12.514C19.3416 12.7534 19.3817 13.0614 19.5632 13.4294C19.5674 13.4376 19.5713 13.4461 19.5749 13.4545C19.6384 13.6025 21.1674 17.0903 24.5666 17.6505C24.8804 17.7022 25.1116 18.0352 24.9438 18.4249Z" fill="black"/>
    </svg>';

    $output = '<div class="tg-social-sharing">';
    foreach ($social_icons as $platform => $link) {
        $share_icon_variable = "{$platform}_icon"; // Dynamically create variable name
        $share_icon_svg = $$share_icon_variable; // Access the variable using variable variables
        $output .= '<a title="Share On ' . $platform . '" class="sharing-icon-' . $platform . '" href="' . esc_url($link) . '" target="_blank" rel="noopener noreferrer" title="Share on ' . ucfirst($platform) . '">' . $share_icon_svg . '</a>';
    }
    $output .= '</div>';

    return $output;
}

add_shortcode('TG_SOCIAL_SHARES', 'tg_display_social_sharing_icons');
