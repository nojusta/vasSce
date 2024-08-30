<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Featured banner layout 3
         * Slug: templategalaxy/gazettepress-featured-banner-layout-3
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
                                    <div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category","textAlign":"center","className":"is-style-categories-background-with-round"} /-->

                                        <!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"x-large"} /-->

                                        <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
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

                <!-- wp:column -->
                <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0px","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1300px"}} -->
                    <div class="wp-block-group" style="margin-top:0px;margin-bottom:0"><!-- wp:query {"queryId":34,"query":{"perPage":"4","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
                        <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":2}} -->
                            <!-- wp:cover {"useFeaturedImage":true,"minHeight":260,"gradient":"dark-gradient","contentPosition":"bottom center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"className":"gazettepress-post-cover","layout":{"type":"constrained"}} -->
                            <div class="wp-block-cover has-custom-content-position is-position-bottom-center gazettepress-post-cover" style="margin-top:0;margin-bottom:0;min-height:260px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient has-dark-gradient-gradient-background"></span>
                                <div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                                    <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"typography":{"fontSize":"20px"}}} /-->

                                    <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
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
                        </div>
                        <!-- /wp:query -->
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
