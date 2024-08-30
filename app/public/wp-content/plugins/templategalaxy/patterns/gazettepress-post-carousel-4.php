<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: 4 Columns Post Carousel
         * Slug: templategalaxy/gazettepress-post-carousel-4
         * Categories: gazettepress
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"1300px"}} -->
        <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"15px","bottom":"50px","left":"15px","right":"15px"}}},"backgroundColor":"background-alt","layout":{"type":"constrained","contentSize":"1300px"}} -->
            <div class="wp-block-group has-background-alt-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:15px;padding-right:15px;padding-bottom:50px;padding-left:15px"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border-color","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border-color);border-bottom-width:1px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"},"margin":{"bottom":"2px"}}},"backgroundColor":"primary","textColor":"light-color","className":"gazettepress-section-header","fontSize":"medium"} -->
                    <h4 class="wp-block-heading gazettepress-section-header has-light-color-color has-primary-background-color has-text-color has-background has-link-color has-medium-font-size" style="margin-bottom:2px;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px"><?php esc_html_e('Must Read Articles', 'templategalaxy') ?></h4>
                    <!-- /wp:heading -->

                    <!-- wp:buttons -->
                    <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"transparent","textColor":"foreground","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"spacing":{"padding":{"left":"0px","right":"0px","top":"0","bottom":"0"}}},"className":"gazettepress-all-btns is-style-button-hover-primary-color","fontSize":"normal"} -->
                        <div class="wp-block-button has-custom-font-size gazettepress-all-btns is-style-button-hover-primary-color has-normal-font-size"><a class="wp-block-button__link has-foreground-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="padding-top:0;padding-right:0px;padding-bottom:0;padding-left:0px"><?php esc_html_e('View All', 'templategalaxy') ?></a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
                <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-carousel-4"} -->
                    <div class="wp-block-query tg-post-carousel-4"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                        <!-- wp:group {"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group"><!-- wp:post-featured-image {"height":"280px"} /-->

                            <!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                            <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"24px"}}} /-->

                            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group"><!-- wp:post-author-name {"textColor":"light-gray"} /-->

                                <!-- wp:post-date {"textColor":"light-gray"} /-->
                            </div>
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
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
