<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Team Carousel
         * Slug: templategalaxy/millipede-team-carousel
         * Categories: millipede
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/team_1.jpg',
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/team_2.jpg',
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/team_3.jpg'
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"100px","bottom":"100px"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"background-alt","layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group has-background-alt-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:100px;padding-right:var(--wp--preset--spacing--40);padding-bottom:100px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"}} -->
            <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"48px"}}} -->
                <h1 class="wp-block-heading has-text-align-center" style="font-size:48px;font-style:normal;font-weight:500"><?php esc_html_e('Meet Our Team', 'templategalaxy') ?></h1>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":false},"className":"tg-content-carousel","layout":{"type":"default"}} -->
            <div id="CONTENT-CAROUSEL" class="wp-block-group tg-content-carousel"><!-- wp:group {"lock":{"move":false,"remove":true},"style":{"spacing":{"blockGap":"0"}},"className":"swiper-wrapper"} -->
                <div id="slide-holder" class="wp-block-group swiper-wrapper"><!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
                    <div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:group {"className":"millipede-hover-box","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group millipede-hover-box"><!-- wp:image {"id":2882,"sizeSlug":"full","linkDestination":"none"} -->
                            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-2882" /></figure>
                            <!-- /wp:image -->

                            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}}} -->
                                <h3 class="wp-block-heading has-text-align-center" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Marcus Torres', 'templategalaxy') ?></h3>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"align":"center"} -->
                                <p class="has-text-align-center"><?php esc_html_e('Project Manager', 'templategalaxy') ?></p>
                                <!-- /wp:paragraph -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
                    <div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:group {"className":"millipede-hover-box","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group millipede-hover-box"><!-- wp:image {"id":2882,"sizeSlug":"full","linkDestination":"none"} -->
                            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-2882" /></figure>
                            <!-- /wp:image -->

                            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}}} -->
                                <h3 class="wp-block-heading has-text-align-center" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Marcus Torres', 'templategalaxy') ?></h3>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"align":"center"} -->
                                <p class="has-text-align-center"><?php esc_html_e('Project Manager', 'templategalaxy') ?></p>
                                <!-- /wp:paragraph -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
                    <div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:group {"className":"millipede-hover-box","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group millipede-hover-box"><!-- wp:image {"id":2882,"sizeSlug":"full","linkDestination":"none"} -->
                            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-2882" /></figure>
                            <!-- /wp:image -->

                            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}}} -->
                                <h3 class="wp-block-heading has-text-align-center" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Marcus Torres', 'templategalaxy') ?></h3>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"align":"center"} -->
                                <p class="has-text-align-center"><?php esc_html_e('Project Manager', 'templategalaxy') ?></p>
                                <!-- /wp:paragraph -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"className":"swiper-slide","layout":{"type":"constrained"}} -->
                    <div id="TG-SLIDE" class="wp-block-group swiper-slide"><!-- wp:group {"className":"millipede-hover-box","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group millipede-hover-box"><!-- wp:image {"id":2882,"sizeSlug":"full","linkDestination":"none"} -->
                            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-2882" /></figure>
                            <!-- /wp:image -->

                            <!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}}} -->
                                <h3 class="wp-block-heading has-text-align-center" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Marcus Torres', 'templategalaxy') ?></h3>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"align":"center"} -->
                                <p class="has-text-align-center"><?php esc_html_e('Project Manager', 'templategalaxy') ?></p>
                                <!-- /wp:paragraph -->
                            </div>
                            <!-- /wp:group -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"lock":{"move":false,"remove":true},"style":{"spacing":{"margin":{"top":"48px"}}},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
                <div id="slider-control" class="wp-block-group tg-slider-control" style="margin-top:48px"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
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
<?php  }
}
