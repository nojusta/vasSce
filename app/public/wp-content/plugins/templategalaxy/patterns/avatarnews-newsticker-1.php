<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: News Ticker 1
         * Slug: templategalaxy/avatarnews-newsticker-1
         * Categories: avatarnews
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"24px","bottom":"24px"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"1240px"}} -->
        <div class="wp-block-group has-light-color-background-color has-background" style="padding-top:24px;padding-right:var(--wp--preset--spacing--40);padding-bottom:24px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
            <div class="wp-block-group"><!-- wp:columns {"verticalAlignment":"center"} -->
                <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"120px"} -->
                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:120px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary","fontSize":"medium"} -->
                        <h4 class="wp-block-heading has-primary-color has-text-color has-link-color has-medium-font-size"><?php esc_html_e('Flash News', 'templategalaxy') ?></h4>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"verticalAlignment":"center","width":""} -->
                    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"categories":["tg-blocks"],"patternName":"tgpost-slider","name":"TG BLOCK: Post Slider"},"className":"tg-post-slider-holder avatarnews-news-ticker","style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"layout":{"type":"constrained","contentSize":"100%"}} -->
                        <div id="POST-SLIDER" class="wp-block-group tg-post-slider-holder avatarnews-news-ticker" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-slider"} -->
                            <div class="wp-block-query tg-post-slider"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                                <!-- wp:post-title {"textAlign":"left","isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"18px","lineHeight":"2"},"spacing":{"margin":{"bottom":"0px"}}}} /-->
                                <!-- /wp:post-template -->

                                <!-- wp:group {"lock":{"move":true,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                                <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
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
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
