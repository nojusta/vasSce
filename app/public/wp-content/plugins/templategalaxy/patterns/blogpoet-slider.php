<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Post Slider
         * Slug: templategalaxy/blogpoet-slider
         * Categories: blogpoet
         */
?>
        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
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
<?php }
}
