<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Banner with slider
         * Slug: templategalaxy/blogpoet-banner
         * Categories: blogpoet
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50","top":"40px","bottom":"20px"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group" style="padding-top:40px;padding-right:var(--wp--preset--spacing--50);padding-bottom:20px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns -->
            <div class="wp-block-columns"><!-- wp:column {"width":"66.66%"} -->
                <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
                    <div id="POST-SLIDER" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-slider"} -->
                        <div class="wp-block-query tg-post-slider"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                            <!-- wp:cover {"useFeaturedImage":true,"dimRatio":90,"minHeight":592,"customGradient":"linear-gradient(180deg,rgba(0,0,0,0) 32%,rgb(0,0,0) 100%)","contentPosition":"bottom left","style":{"spacing":{"padding":{"right":"30px","left":"30px","top":"30px","bottom":"30px"}},"border":{"radius":"30px"}},"layout":{"type":"constrained","contentSize":"100%"}} -->
                            <div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="border-radius:30px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;min-height:592px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-90 has-background-dim has-background-gradient" style="background:linear-gradient(180deg,rgba(0,0,0,0) 32%,rgb(0,0,0) 100%)"></span>
                                <div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category"} /-->

                                    <!-- wp:post-title {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"x-large"} /-->

                                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                    <div class="wp-block-group"><!-- wp:post-author-name {"textColor":"background"} /-->

                                        <!-- wp:post-date {"textColor":"background"} /-->
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
                <!-- /wp:column -->

                <!-- wp:column {"width":"33.33%"} -->
                <div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:group {"style":{"border":{"radius":"30px","top":{"radius":"0px","color":"#021614","width":"1px"},"right":{"radius":"0px","color":"#021614","width":"5px"},"bottom":{"radius":"0px","color":"#021614","width":"5px"},"left":{"radius":"0px","color":"#021614","width":"1px"}},"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}},"dimensions":{"minHeight":""}},"backgroundColor":"light-color","className":"blogpoet-featured-posts","layout":{"type":"constrained","contentSize":"100%"}} -->
                    <div class="wp-block-group blogpoet-featured-posts has-light-color-background-color has-background" style="border-radius:30px;border-top-color:#021614;border-top-width:1px;border-right-color:#021614;border-right-width:5px;border-bottom-color:#021614;border-bottom-width:5px;border-left-color:#021614;border-left-width:1px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"10px","bottom":"10px","left":"0px","right":"0px"}},"border":{"radius":"0px","top":{"radius":"0px","width":"0px","style":"none"},"right":{"radius":"0px","width":"0px","style":"none"},"bottom":{"color":"var:preset|color|dark-color","width":"1px"},"left":{"radius":"0px","width":"0px","style":"none"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
                        <div class="wp-block-group" style="border-radius:0px;border-top-style:none;border-top-width:0px;border-right-style:none;border-right-width:0px;border-bottom-color:var(--wp--preset--color--dark-color);border-bottom-width:1px;border-left-style:none;border-left-width:0px;padding-top:10px;padding-right:0px;padding-bottom:10px;padding-left:0px"><!-- wp:heading {"textAlign":"left","level":4,"fontSize":"big"} -->
                            <h4 class="wp-block-heading has-text-align-left has-big-font-size"><?php esc_html_e('Featured Posts', 'blogpoet') ?></h4>
                            <!-- /wp:heading -->
                        </div>
                        <!-- /wp:group -->

                        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":"460px"}},"className":"tg-post-slider-holder news-ticker-holderv ticker-2","layout":{"type":"constrained","contentSize":"100%"}} -->
                        <div id="NEWS-TICKER" class="wp-block-group tg-post-slider-holder news-ticker-holderv ticker-2" style="min-height:460px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-news-ticker-2"} -->
                            <div class="wp-block-query tg-news-ticker-2"><!-- wp:post-template {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":3}} -->
                                <!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
                                <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                    <div class="wp-block-group"><!-- wp:post-featured-image {"aspectRatio":"4/3","width":"100px","height":"90px","style":{"border":{"radius":"12px"}}} /-->

                                        <!-- wp:group {"style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                                        <div class="wp-block-group"><!-- wp:post-title {"level":5,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|dark-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"top":"0","bottom":"0"}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"16px"}}} /-->

                                            <!-- wp:post-date /-->
                                        </div>
                                        <!-- /wp:group -->
                                    </div>
                                    <!-- /wp:group -->
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
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->
        </div>
        <!-- /wp:group -->
<?php }
}
