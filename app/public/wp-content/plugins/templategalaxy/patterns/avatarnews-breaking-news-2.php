<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Breaking News 2
         * Slug: templategalaxy/avatarnews-breaking-news-2
         * Categories: avatarnews
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"16px","bottom":"24px"}}},"layout":{"type":"constrained","contentSize":"1240px"}} -->
        <div class="wp-block-group" style="padding-top:16px;padding-right:var(--wp--preset--spacing--40);padding-bottom:24px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div class="wp-block-group has-light-color-background-color has-background" style="padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"secondary","fontSize":"medium"} -->
                <h2 class="wp-block-heading has-secondary-color has-text-color has-link-color has-medium-font-size" style="font-style:normal;font-weight:500"><?php esc_html_e('Breaking News', 'templategalaxy') ?></h2>
                <!-- /wp:heading -->

                <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"categories":["tg-blocks"],"patternName":"tgpost-carousel","name":"TG BLOCK: Post Carousel"},"className":"tg-post-slider-holder avatarnews-tickers-horizontal","style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"layout":{"type":"constrained","contentSize":"100%"}} -->
                <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder avatarnews-tickers-horizontal" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"8","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-carousel"} -->
                    <div class="wp-block-query tg-post-carousel"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default","columnCount":1}} -->
                        <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}}} -->
                        <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"60px"} -->
                            <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60px"><!-- wp:post-featured-image {"isLink":true,"width":"60px","height":"60px","style":{"border":{"radius":"60px"}}} /--></div>
                            <!-- /wp:column -->

                            <!-- wp:column {"verticalAlignment":"center","width":""} -->
                            <div class="wp-block-column is-vertically-aligned-center"><!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"fontSize":"20px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} /--></div>
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
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
