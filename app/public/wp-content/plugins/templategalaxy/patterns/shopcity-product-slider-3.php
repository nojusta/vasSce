<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Product Slider Column 4 (PRO)
         * Slug: templategalaxy/shopcity-product-slider-3
         * Categories: shopcity
         */
?>
        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
        <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"5","pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[]},"lock":{"move":false,"remove":true},"className":"tg-post-carousel-4 shopcity-colm-slider"} -->
            <div class="wp-block-query tg-post-carousel-4 shopcity-colm-slider"><!-- wp:post-template {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"0"}},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                <!-- wp:group {"layout":{"type":"constrained"}} -->
                <div class="wp-block-group"><!-- wp:cover {"useFeaturedImage":true,"dimRatio":40,"overlayColor":"dark-color","isUserOverlayColor":true,"minHeight":460,"isDark":false,"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
                    <div class="wp-block-cover is-light" style="min-height:460px"><span aria-hidden="true" class="wp-block-cover__background has-dark-color-background-color has-background-dim-40 has-background-dim"></span>
                        <div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"product_cat","textAlign":"center","style":{"spacing":{"padding":{"top":"13px","bottom":"13px","left":"24px","right":"24px"}},"border":{"radius":"0px"},"elements":{"link":{"color":{"text":"var:preset|color|background"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"textColor":"background","className":"shopcity-slider-cartbtn","fontSize":"small"} /-->

                            <!-- wp:post-title {"textAlign":"center","level":4,"isLink":true,"style":{"spacing":{"padding":{"top":"13px","bottom":"13px","left":"24px","right":"24px"}},"border":{"radius":"0px"},"elements":{"link":{"color":{"text":"var:preset|color|light-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"textColor":"heading-color","className":"shopcity-slider-cartbtn","fontSize":"big"} /-->

                            <!-- wp:group {"style":{"spacing":{"padding":{"top":"13px","bottom":"13px","left":"24px","right":"24px"}},"border":{"radius":"0px"},"elements":{"link":{"color":{"text":"var:preset|color|heading-color"}}}},"textColor":"heading-color","className":"shopcity-slider-cartbtn","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                            <div class="wp-block-group shopcity-slider-cartbtn has-heading-color-color has-text-color has-link-color" style="border-radius:0px;padding-top:13px;padding-right:24px;padding-bottom:13px;padding-left:24px"><!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","textColor":"background","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}}}} /--></div>
                            <!-- /wp:group -->

                            <!-- wp:group {"style":{"spacing":{"padding":{"top":"13px","bottom":"13px","left":"24px","right":"24px"}},"border":{"radius":"0px"},"elements":{"link":{"color":{"text":"var:preset|color|heading-color"}}}},"textColor":"heading-color","className":"shopcity-slider-cartbtn","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                            <div class="wp-block-group shopcity-slider-cartbtn has-heading-color-color has-text-color has-link-color" style="border-radius:0px;padding-top:13px;padding-right:24px;padding-bottom:13px;padding-left:24px"><!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true,"className":"shopcity-slider-cartbtn","backgroundColor":"transparent","textColor":"light-color","style":{"spacing":{"padding":{"top":"13px","bottom":"13px","left":"24px","right":"24px"}},"border":{"radius":"0px"},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}}} /--></div>
                            <!-- /wp:group -->
                        </div>
                    </div>
                    <!-- /wp:cover -->
                </div>
                <!-- /wp:group -->
                <!-- /wp:post-template -->

                <!-- wp:group {"lock":{"move":true,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
                    <div class="swiper-pagination tgpost-carousel-pagination"></div>
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
<?php }
}
