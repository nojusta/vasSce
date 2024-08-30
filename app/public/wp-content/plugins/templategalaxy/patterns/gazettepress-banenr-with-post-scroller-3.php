<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Featured banner with featured post scroller 3
         * Slug: templategalaxy/gazettepress-banner-with-post-scroller-3
         * Categories: gazettepress
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/icon_meta_user.png',
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/icon_meta_date.png',
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"1300px"}} -->
        <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"16px"}}}} -->
            <div class="wp-block-columns"><!-- wp:column -->
                <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"constrained","contentSize":"1300px"}} -->
                    <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
                        <div id="POST-SLIDER" class="wp-block-group tg-post-slider-holder" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-slider"} -->
                            <div class="wp-block-query tg-post-slider"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                                <!-- wp:cover {"useFeaturedImage":true,"dimRatio":90,"minHeight":536,"customGradient":"linear-gradient(180deg,rgba(0,0,0,0) 32%,rgb(0,0,0) 100%)","contentPosition":"bottom center","style":{"spacing":{"padding":{"right":"30px","left":"30px","top":"30px","bottom":"80px"}}},"className":"gazettepress-post-cover","layout":{"type":"constrained","contentSize":"100%"}} -->
                                <div class="wp-block-cover has-custom-content-position is-position-bottom-center gazettepress-post-cover" style="padding-top:30px;padding-right:30px;padding-bottom:80px;padding-left:30px;min-height:536px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-90 has-background-dim has-background-gradient" style="background:linear-gradient(180deg,rgba(0,0,0,0) 32%,rgb(0,0,0) 100%)"></span>
                                    <div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category","textAlign":"left","className":"is-style-categories-background-with-round"} /-->

                                        <!-- wp:post-title {"textAlign":"left","level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"x-large"} /-->

                                        <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
                                        <div class="wp-block-group" style="margin-top:10px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                            <div class="wp-block-group"><!-- wp:image {"id":1754,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|meta-tone"}}} -->
                                                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-1754" style="width:auto;height:16px" /></figure>
                                                <!-- /wp:image -->

                                                <!-- wp:post-author-name {"style":{"typography":{"textTransform":"capitalize"}}} /-->
                                            </div>
                                            <!-- /wp:group -->

                                            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                            <div class="wp-block-group"><!-- wp:image {"id":1750,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|meta-tone"}}} -->
                                                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-1750" style="width:auto;height:16px" /></figure>
                                                <!-- /wp:image -->

                                                <!-- wp:post-date {"format":"M j, Y","fontSize":"small"} /-->
                                            </div>
                                            <!-- /wp:group -->
                                        </div>
                                        <!-- /wp:group -->
                                    </div>
                                </div>
                                <!-- /wp:cover -->
                                <!-- /wp:post-template -->

                                <!-- wp:group {"lock":{"move":true,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                                <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
                                    <div class="tgpost-slider-pagination swiper-pagination"></div>
                                    <div class="tg-swiper-navigations">
                                        <div class="swiper-button-next tgpost-slider-next"></div>
                                        <div class="swiper-button-prev tgpost-slider-prev"></div>
                                    </div>
                                    <!-- /wp:html -->
                                </div>
                                <!-- /wp:group -->
                            </div>
                            <!-- /wp:query -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->

                <!-- wp:column {"width":"35%"} -->
                <div class="wp-block-column" style="flex-basis:35%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"16px","bottom":"2px","left":"16px","right":"16px"}}},"backgroundColor":"background-alt","layout":{"type":"constrained","contentSize":"100%"}} -->
                    <div class="wp-block-group has-background-alt-background-color has-background" style="padding-top:16px;padding-right:16px;padding-bottom:2px;padding-left:16px"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border-color","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                        <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border-color);border-bottom-width:1px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"},"margin":{"bottom":"2px"}},"typography":{"fontSize":"20px"}},"backgroundColor":"primary","textColor":"light-color","className":"gazettepress-section-header"} -->
                            <h4 class="wp-block-heading gazettepress-section-header has-light-color-color has-primary-background-color has-text-color has-background has-link-color" style="margin-bottom:2px;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px;font-size:20px"><?php esc_html_e('Featured Articles', 'templategalaxy') ?></h4>
                            <!-- /wp:heading -->
                        </div>
                        <!-- /wp:group -->

                        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"},"margin":{"top":"16px","bottom":"16px"}},"dimensions":{"minHeight":"445px"}},"className":"tg-post-slider-holder news-ticker-holderv ticker-2","layout":{"type":"constrained","contentSize":"100%"}} -->
                        <div id="NEWS-TICKER" class="wp-block-group tg-post-slider-holder news-ticker-holderv ticker-2" style="min-height:445px;margin-top:16px;margin-bottom:16px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-news-ticker-2"} -->
                            <div class="wp-block-query tg-news-ticker-2"><!-- wp:post-template {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":3}} -->
                                <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"15px"}}}} -->
                                <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"33.33%"} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:post-featured-image {"height":"100px"} /--></div>
                                    <!-- /wp:column -->

                                    <!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"blockGap":"10px","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
                                        <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:post-title {"level":5,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"top":"0","bottom":"0"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} /-->

                                            <!-- wp:post-date /-->
                                        </div>
                                        <!-- /wp:group -->
                                    </div>
                                    <!-- /wp:column -->
                                </div>
                                <!-- /wp:columns -->
                                <!-- /wp:post-template -->

                                <!-- wp:group {"lock":{"move":true,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                                <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
                                    <div class="tgv-ticker-navigation">
                                        <div class="swiper-button-next tgv-ticker-next"></div>
                                        <div class="swiper-button-prev tgv-ticker-prev"></div>
                                    </div>
                                    <!-- /wp:html -->
                                </div>
                                <!-- /wp:group -->
                            </div>
                            <!-- /wp:query -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->
        </div>
        <!-- /wp:group -->
<?php }
}
