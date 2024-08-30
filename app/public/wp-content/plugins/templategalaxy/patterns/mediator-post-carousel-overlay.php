<?php

/**
 * Title: Post Carousel with Overlay Content
 * Slug: templategalaxy/mediator-post-carousel-overlay
 * Categories: mediator
 */
?>
<!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
<div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"4","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-carousel"} -->
    <div class="wp-block-query tg-post-carousel"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
        <!-- wp:cover {"useFeaturedImage":true,"dimRatio":70,"overlayColor":"dark-color","minHeight":540,"contentPosition":"center center","style":{"spacing":{"padding":{"right":"30px","left":"30px","top":"30px","bottom":"30px"},"margin":{"bottom":"16px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
        <div class="wp-block-cover" style="margin-bottom:16px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;min-height:540px"><span aria-hidden="true" class="wp-block-cover__background has-dark-color-background-color has-background-dim-70 has-background-dim"></span>
            <div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"constrained","contentSize":"1180px"}} -->
                <div class="wp-block-group"><!-- wp:post-terms {"term":"category","textAlign":"center","className":"is-style-categories-background-with-round"} /-->

                    <!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"10px","bottom":"10px"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"large"} /-->

                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                    <div class="wp-block-group"><!-- wp:post-author-name {"textColor":"background"} /-->

                        <!-- wp:post-date {"textColor":"background"} /-->
                    </div>
                    <!-- /wp:group -->
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