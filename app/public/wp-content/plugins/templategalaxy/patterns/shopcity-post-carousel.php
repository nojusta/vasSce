<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Post Carousel (PRO)
         * Slug: templategalaxy/shopcity-post-slider
         * Categories: shopcity
         */
?>
        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"40px"}}}} -->
            <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:40px"><?php esc_html_e('Latest Posts', 'templategalaxy') ?></h2>
            <!-- /wp:heading -->

            <!-- wp:query {"queryId":13,"query":{"perPage":"5","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[]},"lock":{"move":false,"remove":true},"className":"tg-post-carousel"} -->
            <div class="wp-block-query tg-post-carousel"><!-- wp:post-template {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"0"}},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                <!-- wp:group {"layout":{"type":"constrained"}} -->
                <div class="wp-block-group"><!-- wp:post-featured-image {"height":"280px"} /-->

                    <!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"textColor":"foreground","fontSize":"small"} /-->

                    <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"24px"}}} /-->
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
