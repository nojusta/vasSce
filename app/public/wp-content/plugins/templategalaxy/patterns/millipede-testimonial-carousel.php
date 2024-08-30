<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Testimonial Carousel
         * Slug: templategalaxy/millipede-testimonial-carousel
         * Categories: millipede
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/testimonial_1.jpg',
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/testimonial_2.jpg',
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/testimonial_3.jpg'
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"100px","bottom":"100px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:100px;padding-right:var(--wp--preset--spacing--40);padding-bottom:100px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"}} -->
            <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"48px"}}} -->
                <h1 class="wp-block-heading has-text-align-center" style="font-size:48px;font-style:normal;font-weight:500"><?php esc_html_e('Testimonials', 'templategalaxy') ?></h1>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"margin":{"top":"48px"}}},"className":"tg-content-carousel"} -->
            <div id="CONTENT-CAROUSEL" class="wp-block-group tg-content-carousel" style="margin-top:48px"><!-- wp:group {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"0"}},"className":"swiper-wrapper"} -->
                <div id="slide-holder" class="wp-block-group swiper-wrapper"><!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
                    <div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:group {"style":{"border":{"radius":"12px","color":"#dadaf2","width":"1px"},"spacing":{"padding":{"top":"32px","bottom":"32px","left":"32px","right":"32px"}}},"className":"millipede-hover-box","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group millipede-hover-box has-border-color" style="border-color:#dadaf2;border-width:1px;border-radius:12px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px"><!-- wp:paragraph -->
                            <p><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'templategalaxy') ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group"><!-- wp:image {"id":2882,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"100px"}}} -->
                                <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-2882" style="border-radius:100px;object-fit:cover;width:80px;height:80px" /></figure>
                                <!-- /wp:image -->

                                <!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                                <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}}} -->
                                    <h3 class="wp-block-heading has-text-align-center" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Marcus Torres', 'templategalaxy') ?></h3>
                                    <!-- /wp:heading -->

                                    <!-- wp:paragraph {"align":"center"} -->
                                    <p class="has-text-align-center"><?php esc_html_e('Product Manager', 'templategalaxy') ?></p>
                                    <!-- /wp:paragraph -->
                                </div>
                                <!-- /wp:group -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
                    <div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:group {"style":{"border":{"radius":"12px","color":"#dadaf2","width":"1px"},"spacing":{"padding":{"top":"32px","bottom":"32px","left":"32px","right":"32px"}}},"className":"millipede-hover-box","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group millipede-hover-box has-border-color" style="border-color:#dadaf2;border-width:1px;border-radius:12px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px"><!-- wp:paragraph -->
                            <p><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'templategalaxy') ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group"><!-- wp:image {"id":2882,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"100px"}}} -->
                                <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-2882" style="border-radius:100px;object-fit:cover;width:80px;height:80px" /></figure>
                                <!-- /wp:image -->

                                <!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                                <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}}} -->
                                    <h3 class="wp-block-heading has-text-align-center" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Marcus Torres', 'templategalaxy') ?></h3>
                                    <!-- /wp:heading -->

                                    <!-- wp:paragraph {"align":"center"} -->
                                    <p class="has-text-align-center"><?php esc_html_e('Product Manager', 'templategalaxy') ?></p>
                                    <!-- /wp:paragraph -->
                                </div>
                                <!-- /wp:group -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
                    <div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:group {"style":{"border":{"radius":"12px","color":"#dadaf2","width":"1px"},"spacing":{"padding":{"top":"32px","bottom":"32px","left":"32px","right":"32px"}}},"className":"millipede-hover-box","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group millipede-hover-box has-border-color" style="border-color:#dadaf2;border-width:1px;border-radius:12px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px"><!-- wp:paragraph -->
                            <p><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'templategalaxy') ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group"><!-- wp:image {"id":2882,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"100px"}}} -->
                                <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-2882" style="border-radius:100px;object-fit:cover;width:80px;height:80px" /></figure>
                                <!-- /wp:image -->

                                <!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                                <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}}} -->
                                    <h3 class="wp-block-heading has-text-align-center" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Marcus Torres', 'templategalaxy') ?></h3>
                                    <!-- /wp:heading -->

                                    <!-- wp:paragraph {"align":"center"} -->
                                    <p class="has-text-align-center"><?php esc_html_e('Product Manager', 'templategalaxy') ?></p>
                                    <!-- /wp:paragraph -->
                                </div>
                                <!-- /wp:group -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
                    <div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:group {"style":{"border":{"radius":"12px","color":"#dadaf2","width":"1px"},"spacing":{"padding":{"top":"32px","bottom":"32px","left":"32px","right":"32px"}}},"className":"millipede-hover-box","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group millipede-hover-box has-border-color" style="border-color:#dadaf2;border-width:1px;border-radius:12px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px"><!-- wp:paragraph -->
                            <p><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 'templategalaxy') ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group"><!-- wp:image {"id":2882,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"100px"}}} -->
                                <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-2882" style="border-radius:100px;object-fit:cover;width:80px;height:80px" /></figure>
                                <!-- /wp:image -->

                                <!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                                <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}}} -->
                                    <h3 class="wp-block-heading has-text-align-center" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Marcus Torres', 'templategalaxy') ?></h3>
                                    <!-- /wp:heading -->

                                    <!-- wp:paragraph {"align":"center"} -->
                                    <p class="has-text-align-center"><?php esc_html_e('Product Manager', 'templategalaxy') ?></p>
                                    <!-- /wp:paragraph -->
                                </div>
                                <!-- /wp:group -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"lock":{"move":false,"remove":true},"style":{"spacing":{"margin":{"top":"54px"}}},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                <div id="slider-control" class="wp-block-group tg-slider-control" style="margin-top:54px"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
                    <div class="tgcontent-carousel-pagination swiper-pagination"></div>
                    <div class="tg-swiper-navigations">
                        <div class="swiper-button-next tgcontent-slide-next"></div>
                        <div class="swiper-button-prev tgcontent-slide-prev"></div>
                    </div>
                    <!-- /wp:html -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
