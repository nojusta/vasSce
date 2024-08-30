<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Vertical Post Scroller
         * Slug: templategalaxy/avatarnews-vertical-scroller
         * Categories: avatarnews
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"24px","bottom":"24px"}}},"layout":{"type":"constrained","contentSize":"1240px"}} -->
        <div class="wp-block-group" style="padding-top:24px;padding-right:var(--wp--preset--spacing--40);padding-bottom:24px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}}},"layout":{"type":"constrained","contentSize":"400px"}} -->
            <div class="wp-block-group" style="padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"100%"}} -->
                <div class="wp-block-group has-light-color-background-color has-background" style="padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
                    <div class="wp-block-group"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|primary","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","orientation":"vertical"}} -->
                        <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--primary);border-bottom-width:1px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"10px","bottom":"10px","left":"16px","right":"16px"}}},"backgroundColor":"primary","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group has-primary-background-color has-background" style="padding-top:10px;padding-right:16px;padding-bottom:10px;padding-left:16px"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"500"}},"textColor":"light-color"} -->
                                <h2 class="wp-block-heading has-light-color-color has-text-color has-link-color" style="font-size:20px;font-style:normal;font-weight:500"><?php esc_html_e('Latest Post Ticker', 'templategalaxy') ?></h2>
                                <!-- /wp:heading -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"categories":["tg-blocks"],"patternName":"tgpost-newsticker-two","name":"TG BLOCK: News Ticker 2"},"className":"tg-post-slider-holder news-ticker-holderv ticker-2 avatarnews-ticker-1","style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":"470px"}},"layout":{"type":"constrained","contentSize":"100%"}} -->
                    <div id="NEWS-TICKER" class="wp-block-group tg-post-slider-holder news-ticker-holderv ticker-2 avatarnews-ticker-1" style="min-height:470px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-news-ticker-2"} -->
                        <div class="wp-block-query tg-news-ticker-2"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default","columnCount":3}} -->
                            <!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
                            <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"15px","left":"15px"},"margin":{"top":"0","bottom":"0"}}}} -->
                                <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"120px"} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:120px"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","width":"120px","height":"90px","style":{"border":{"radius":"0px"}}} /--></div>
                                    <!-- /wp:column -->

                                    <!-- wp:column {"verticalAlignment":"center","width":""} -->
                                    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                                        <div class="wp-block-group"><!-- wp:post-title {"level":5,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0px","bottom":"0px","left":"0","right":"0"},"padding":{"top":"0","bottom":"0"}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"18px"}}} /-->

                                            <!-- wp:post-date {"className":"is-style-post-date-with-icon"} /-->
                                        </div>
                                        <!-- /wp:group -->
                                    </div>
                                    <!-- /wp:column -->
                                </div>
                                <!-- /wp:columns -->
                            </div>
                            <!-- /wp:group -->
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
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
