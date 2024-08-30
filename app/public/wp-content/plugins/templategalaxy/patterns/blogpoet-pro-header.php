<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Header with News Ticker
         * Slug: templategalaxy/blogpoet-pro-header
         * Categories: blogpoet
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/blogpoet-assets/banner_ads.jpg',
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}},"border":{"bottom":{"width":"0px","style":"none"}}},"className":"blogpoet-header blogpoet-pro-header","layout":{"type":"constrained","contentSize":"100%"}} -->
        <div class="wp-block-group blogpoet-header blogpoet-pro-header" style="border-bottom-style:none;border-bottom-width:0px;padding-right:0;padding-left:0"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"spacing":{"padding":{"top":"15px","bottom":"15px"}}},"backgroundColor":"dark-color","layout":{"type":"constrained","contentSize":"1180px"}} -->
            <div class="wp-block-group has-dark-color-background-color has-background" style="min-height:60px;padding-top:15px;padding-bottom:15px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                <div class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"padding":{"right":"20px"}},"border":{"right":{"color":"var:preset|color|light-color","width":"1px"},"top":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group" style="border-right-color:var(--wp--preset--color--light-color);border-right-width:1px;padding-right:20px"><!-- wp:shortcode -->
                            [TG_CURRENT_DATE_WITH_DAY]
                            <!-- /wp:shortcode -->
                        </div>
                        <!-- /wp:group -->

                        <!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color","fontSize":"normal"} -->
                        <h2 class="wp-block-heading has-light-color-color has-text-color has-link-color has-normal-font-size"><?php esc_html_e('Flash News', 'blogpoet') ?> - </h2>
                        <!-- /wp:heading -->

                        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder news-ticker-holder ticker-1","layout":{"type":"constrained","contentSize":"100%"}} -->
                        <div id="NEWS-TICKER" class="wp-block-group tg-post-slider-holder news-ticker-holder ticker-1" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"4","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-news-ticker"} -->
                            <div class="wp-block-query tg-news-ticker"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                                <!-- wp:group {"layout":{"type":"constrained"}} -->
                                <div class="wp-block-group"><!-- wp:post-title {"level":5,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"top":"0","bottom":"0"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"normal"} /--></div>
                                <!-- /wp:group -->
                                <!-- /wp:post-template -->
                            </div>
                            <!-- /wp:query -->

                            <!-- wp:group {"lock":{"move":false,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                            <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
                                <div class="tg-ticker-navigation">
                                    <div class="swiper-button-next tg-ticker-next"></div>
                                    <div class="swiper-button-prev tg-ticker-prev"></div>
                                </div>
                                <!-- /wp:html -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:social-links {"iconColor":"light-color","iconColorValue":"#ffffff","iconBackgroundColorValue":"#ffffff00","style":{"spacing":{"blockGap":{"left":"6px"}},"layout":{"selfStretch":"fixed","flexSize":"227px"}},"className":"is-style-social-icon-size-small","layout":{"type":"flex","justifyContent":"right"}} -->
                    <ul class="wp-block-social-links has-icon-color has-icon-background-color is-style-social-icon-size-small"><!-- wp:social-link {"url":"#","service":"facebook"} /-->

                        <!-- wp:social-link {"url":"#","service":"x"} /-->

                        <!-- wp:social-link {"url":"#","service":"pinterest"} /-->

                        <!-- wp:social-link {"url":"#","service":"instagram"} /-->

                        <!-- wp:social-link {"url":"#","service":"lastfm"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50","top":"30px","bottom":"30px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
            <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:30px;padding-right:var(--wp--preset--spacing--50);padding-bottom:30px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:site-logo {"shouldSyncIcon":true} /-->

                        <!-- wp:site-title /-->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:image {"id":67,"sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"unset"}}} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-67" /></figure>
                    <!-- /wp:image -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"5px","bottom":"5px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|dark-color","width":"1px"},"right":{"width":"0px","style":"none"},"bottom":{"color":"var:preset|color|dark-color","width":"5px"},"left":{"width":"0px","style":"none"}}},"backgroundColor":"light-color","textColor":"light-color","layout":{"type":"constrained","contentSize":"1180px"}} -->
            <div class="wp-block-group has-light-color-color has-light-color-background-color has-text-color has-background has-link-color" style="border-top-color:var(--wp--preset--color--dark-color);border-top-width:1px;border-right-style:none;border-right-width:0px;border-bottom-color:var(--wp--preset--color--dark-color);border-bottom-width:5px;border-left-style:none;border-left-width:0px;margin-top:0;margin-bottom:0;padding-top:5px;padding-right:var(--wp--preset--spacing--50);padding-bottom:5px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:navigation {"ref":4,"textColor":"dark-color","className":"blogpoet-navigations","style":{"typography":{"lineHeight":"2.7"},"spacing":{"blockGap":"var:preset|spacing|50"}}} /-->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
                    <div class="wp-block-group"><!-- wp:buttons -->
                        <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"transparent","textColor":"primary","style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"border":{"radius":"0px"},"spacing":{"padding":{"left":"0","right":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"className":"is-style-button-hover-primary-color","fontSize":"normal"} -->
                            <div class="wp-block-button has-custom-font-size is-style-button-hover-primary-color has-normal-font-size" style="font-style:normal;font-weight:500"><a class="wp-block-button__link has-primary-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="border-radius:0px;padding-right:0;padding-left:0"><?php esc_html_e('Subscribe', 'blogpoet') ?></a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->

                        <!-- wp:search {"label":"Search","showLabel":false,"widthUnit":"%","buttonText":"Search","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true,"style":{"border":{"radius":"50px","width":"0px","style":"none"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"backgroundColor":"transparent","textColor":"primary","className":"blogpoet-nav-search"} /-->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
