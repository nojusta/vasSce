<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Post Carousel Col 4
         * Slug: templategalaxy/avatarnews-carousel-col-4
         * Categories: avatarnews
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"24px","bottom":"24px"}}},"layout":{"type":"constrained","contentSize":"1240px"}} -->
        <div class="wp-block-group" style="padding-top:24px;padding-right:var(--wp--preset--spacing--40);padding-bottom:24px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"48px","left":"24px","right":"24px"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div class="wp-block-group has-light-color-background-color has-background" style="padding-top:24px;padding-right:24px;padding-bottom:48px;padding-left:24px"><!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
                <div class="wp-block-group"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|primary","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--primary);border-bottom-width:1px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"10px","bottom":"10px","left":"16px","right":"16px"}}},"backgroundColor":"primary","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group has-primary-background-color has-background" style="padding-top:10px;padding-right:16px;padding-bottom:10px;padding-left:16px"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}},"textColor":"light-color"} -->
                            <h2 class="wp-block-heading has-light-color-color has-text-color has-link-color" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Carousel Layout 4', 'templategalaxy') ?></h2>
                            <!-- /wp:heading -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"categories":["tg-blocks"],"patternName":"tgpost-carousel","name":"TG BLOCK: Post Carousel"},"className":"tg-post-slider-holder","style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"layout":{"type":"constrained","contentSize":"100%"}} -->
                <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-carousel-4"} -->
                    <div class="wp-block-query tg-post-carousel-4"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default","columnCount":1}} -->
                        <!-- wp:cover {"useFeaturedImage":true,"isUserOverlayColor":true,"minHeight":280,"gradient":"dark-gradient","contentPosition":"bottom left","className":"avatarnews-hover-cover","style":{"spacing":{"padding":{"top":"16px","bottom":"16px","left":"20px","right":"20px"},"blockGap":"var:preset|spacing|30"},"border":{"width":"0px","style":"none"}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-cover has-custom-content-position is-position-bottom-left avatarnews-hover-cover" style="border-style:none;border-width:0px;padding-top:16px;padding-right:20px;padding-bottom:16px;padding-left:20px;min-height:280px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient has-dark-gradient-gradient-background"></span>
                            <div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                                <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"fontSize":"20px"}}} /-->

                                <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                <div class="wp-block-group"><!-- wp:post-author-name {"className":"is-style-author-name-with-white-icon","style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"typography":{"textTransform":"capitalize"}},"textColor":"light-color"} /-->

                                    <!-- wp:post-date {"format":"M j, Y","className":"is-style-post-date-with-white-icon","style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color"} /-->
                                </div>
                                <!-- /wp:group -->
                            </div>
                        </div>
                        <!-- /wp:cover -->
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
