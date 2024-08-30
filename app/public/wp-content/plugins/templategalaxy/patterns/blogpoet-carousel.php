<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Post Carousel
         * Slug: templategalaxy/blogpoet-carousel
         * Categories: blogpoet
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50","top":"0px","bottom":"0px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0px;padding-right:var(--wp--preset--spacing--50);padding-bottom:0px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"20px"},"padding":{"bottom":"15px","top":"10px"}},"border":{"bottom":{"color":"var:preset|color|dark-color","width":"1px"},"top":{"color":"var:preset|color|dark-color","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
            <div class="wp-block-group" style="border-top-color:var(--wp--preset--color--dark-color);border-top-width:1px;border-bottom-color:var(--wp--preset--color--dark-color);border-bottom-width:1px;margin-bottom:20px;padding-top:10px;padding-bottom:15px"><!-- wp:heading {"textAlign":"center","level":3} -->
                <h3 class="wp-block-heading has-text-align-center"><?php esc_html_e('Top Story', 'blogpoet') ?></h3>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"4","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-carousel"} -->
                <div class="wp-block-query tg-post-carousel"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                    <!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}},"border":{"radius":"20px","top":{"radius":"20px","color":"var:preset|color|dark-color","width":"1px"},"right":{"radius":"20px","color":"var:preset|color|dark-color","width":"5px"},"bottom":{"radius":"20px","color":"var:preset|color|dark-color","width":"5px"},"left":{"radius":"20px","color":"var:preset|color|dark-color","width":"1px"}}},"backgroundColor":"light-color","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-light-color-background-color has-background" style="border-radius:20px;border-top-color:var(--wp--preset--color--dark-color);border-top-width:1px;border-right-color:var(--wp--preset--color--dark-color);border-right-width:5px;border-bottom-color:var(--wp--preset--color--dark-color);border-bottom-width:5px;border-left-color:var(--wp--preset--color--dark-color);border-left-width:1px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:post-featured-image {"height":"280px","style":{"border":{"radius":"17px"}}} /-->

                        <!-- wp:post-terms {"term":"category"} /-->

                        <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|dark-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} /-->

                        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group"><!-- wp:post-author-name {"textColor":"light-gray"} /-->

                            <!-- wp:post-date {"textColor":"light-gray"} /-->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                    <!-- /wp:post-template -->

                    <!-- wp:group {"lock":{"move":true,"remove":true},"style":{"spacing":{"margin":{"top":"40px"}}},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                    <div id="slider-control" class="wp-block-group tg-slider-control" style="margin-top:40px"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
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
        </div>
        <!-- /wp:group -->
<?php }
}
