<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Breaking News 1
         * Slug: templategalaxy/avatarnews-breaking-news-1
         * Categories: avatarnews
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"16px","bottom":"24px"}}},"layout":{"type":"constrained","contentSize":"1240px"}} -->
        <div class="wp-block-group" style="padding-top:16px;padding-right:var(--wp--preset--spacing--40);padding-bottom:24px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div class="wp-block-group has-light-color-background-color has-background" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"20px","left":"20px"}}}} -->
                <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"150px","style":{"spacing":{"padding":{"top":"25px","bottom":"25px","left":"20px","right":"20px"}}},"backgroundColor":"primary"} -->
                    <div class="wp-block-column is-vertically-aligned-center has-primary-background-color has-background" style="padding-top:25px;padding-right:20px;padding-bottom:25px;padding-left:20px;flex-basis:150px"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"20px"}},"textColor":"light-color"} -->
                        <h2 class="wp-block-heading has-light-color-color has-text-color has-link-color" style="font-size:20px;font-style:normal;font-weight:500"><?php esc_html_e('Breaking News', 'templategalaxy') ?></h2>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"verticalAlignment":"center","width":"","style":{"spacing":{"padding":{"right":"60px"}}}} -->
                    <div class="wp-block-column is-vertically-aligned-center" style="padding-right:60px"><!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"categories":["tg-blocks"],"patternName":"tgpost-carousel","name":"TG BLOCK: Post Carousel"},"className":"tg-post-slider-holder avatarnews-tickers-horizontal style-2","style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"layout":{"type":"constrained","contentSize":"100%"}} -->
                        <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder avatarnews-tickers-horizontal style-2" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"8","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-carousel"} -->
                            <div class="wp-block-query tg-post-carousel"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default","columnCount":1}} -->
                                <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}}}} -->
                                <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"54px"} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:54px"><!-- wp:post-featured-image {"isLink":true,"width":"40px","height":"40px","style":{"border":{"radius":"60px"}}} /--></div>
                                    <!-- /wp:column -->

                                    <!-- wp:column {"verticalAlignment":"center","width":""} -->
                                    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} /--></div>
                                    <!-- /wp:column -->
                                </div>
                                <!-- /wp:columns -->
                                <!-- /wp:post-template -->

                                <!-- wp:group {"lock":{"move":true,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                                <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
                                    <div class="tg-swiper-navigations">
                                        <div class="swiper-button-next tgpost-carousel-next"></div>
                                        <div class="swiper-button-prev tgpost-carousel-prev"></div>
                                    </div>
                                    <!-- /wp:html -->
                                </div>
                                <!-- /wp:group -->
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
        </div>
        <!-- /wp:group -->
<?php }
}
