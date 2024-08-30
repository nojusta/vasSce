<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Product Slider (PRO)
         * Slug: templategalaxy/shopcity-product-slider
         * Categories: shopcity
         */
?>
        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
        <div id="POST-SLIDER" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"5","pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[]},"lock":{"move":false,"remove":true},"className":"tg-post-slider"} -->
            <div class="wp-block-query tg-post-slider"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                <!-- wp:cover {"useFeaturedImage":true,"dimRatio":40,"overlayColor":"heading-color","isUserOverlayColor":true,"minHeight":650,"contentPosition":"center center","isDark":false,"style":{"spacing":{"padding":{"right":"30px","left":"30px","top":"30px","bottom":"30px"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
                <div class="wp-block-cover is-light" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;min-height:650px"><span aria-hidden="true" class="wp-block-cover__background has-heading-color-background-color has-background-dim-40 has-background-dim"></span>
                    <div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"product_cat","textAlign":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"className":"is-style-default","fontSize":"small"} /-->

                        <!-- wp:post-title {"textAlign":"center","isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600","textTransform":"uppercase"}},"fontSize":"xxx-large"} /-->

                        <!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","textColor":"background","fontSize":"medium","style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}}} /-->

                        <!-- wp:group {"style":{"spacing":{"margin":{"top":"24px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                        <div class="wp-block-group" style="margin-top:24px"><!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true,"className":"shopcity-slider-cartbtn","backgroundColor":"transparent","textColor":"background","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"spacing":{"padding":{"top":"22px","bottom":"22px","left":"40px","right":"40px"}}}} /--></div>
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
