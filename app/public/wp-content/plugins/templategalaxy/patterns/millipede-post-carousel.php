<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Post Carousel
         * Slug: templategalaxy/millipede-post-carousel
         * Categories: millipede
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/icon_meta_date.png',
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"80px","bottom":"100px"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"background-alt","layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group has-background-alt-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:80px;padding-right:var(--wp--preset--spacing--40);padding-bottom:100px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
            <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"32px"}}},"layout":{"type":"constrained","contentSize":"680px"}} -->
                <div class="wp-block-group" style="margin-bottom:32px"><!-- wp:heading {"textAlign":"left","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"48px"}}} -->
                    <h1 class="wp-block-heading has-text-align-left" style="font-size:48px;font-style:normal;font-weight:500"><?php esc_html_e('Latest Posts', 'templategalaxy') ?></h1>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"left"} -->
                    <p class="has-text-align-left"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                <div class="wp-block-buttons"><!-- wp:button {"style":{"spacing":{"padding":{"left":"var:preset|spacing|50","right":"var:preset|spacing|50","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"border":{"radius":"0px"}}} -->
                    <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="border-radius:0px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--50)"><?php esc_html_e('Read More Articles', 'templategalaxy') ?></a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"className":"tg-post-slider-holder","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="POST-CAROUSEL" class="wp-block-group tg-post-slider-holder" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:query {"queryId":13,"query":{"perPage":"4","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"lock":{"move":false,"remove":true},"className":"tg-post-carousel"} -->
                <div class="wp-block-query tg-post-carousel"><!-- wp:post-template {"lock":{"move":false,"remove":true},"className":"tg-swiper-holder swiper-wrapper","layout":{"type":"default","columnCount":1}} -->
                    <!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}},"border":{"radius":"12px","width":"0px","style":"none"}},"backgroundColor":"transparent","className":"millipede-post-box is-style-default millipede-hover-box","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group millipede-post-box is-style-default millipede-hover-box has-transparent-background-color has-background" style="border-style:none;border-width:0px;border-radius:12px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:post-featured-image {"isLink":true,"height":"300px","style":{"border":{"radius":"0px"}}} /-->

                        <!-- wp:post-terms {"term":"category","style":{"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"none"}},"className":"is-style-default","fontSize":"small"} /-->

                        <!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"margin":{"top":"12px"}}}} /-->

                        <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"10px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"id":255,"width":"auto","height":"18px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|meta-white"}}} -->
                            <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-255" style="width:auto;height:18px" /></figure>
                            <!-- /wp:image -->

                            <!-- wp:post-date {"style":{"typography":{"lineHeight":"1.6"}}} /-->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                    <!-- /wp:post-template -->

                    <!-- wp:group {"lock":{"move":true,"remove":true},"style":{"spacing":{"margin":{"top":"44px"}}},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                    <div id="slider-control" class="wp-block-group tg-slider-control" style="margin-top:44px"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
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
