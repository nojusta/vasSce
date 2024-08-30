<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Product Carousel Column 4 (PRO)
         * Slug: templategalaxy/shopcity-product-carousel-2
         * Categories: shopcity
         */
?>
        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"40px"}}}} -->
            <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:40px"><?php esc_html_e('Featured Products', 'shopcity') ?></h2>
            <!-- /wp:heading -->

            <!-- wp:query {"queryId":13,"query":{"perPage":"5","pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[]},"lock":{"move":false,"remove":true},"className":"tg-post-carousel-4"} -->
            <div class="wp-block-query tg-post-carousel-4"><!-- wp:post-template {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"0"}},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                <!-- wp:group {"layout":{"type":"constrained"}} -->
                <div class="wp-block-group"><!-- wp:post-featured-image {"height":"360px"} /-->

                    <!-- wp:post-terms {"term":"product_cat","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-alt"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"fontSize":"small"} /-->

                    <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"24px"}}} /-->

                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true} /-->

                        <!-- wp:woocommerce/product-rating {"isDescendentOfQueryLoop":true} /-->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true,"className":"shopcity-slider-cartbtn","textColor":"heading-color","style":{"spacing":{"padding":{"top":"13px","bottom":"13px","left":"24px","right":"24px"}},"border":{"radius":"0px"},"elements":{"link":{"color":{"text":"var:preset|color|heading-color"}}}}} /--></div>
                    <!-- /wp:group -->
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
