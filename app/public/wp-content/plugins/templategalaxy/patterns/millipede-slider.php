<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Slider
         * Slug: templategalaxy/millipede-slider
         * Categories: millipede
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/slider_1.jpg',
            TEMPLATEGALAXY_URL . 'assets/images/millipede-assets/slider_2.jpg'
        );
?>
        <!-- wp:group {"lock":{"move":false,"remove":false},"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"className":"tg-slider"} -->
        <div id="TG-SLIDER" class="wp-block-group tg-slider" style="margin-top:0;margin-bottom:0"><!-- wp:group {"lock":{"move":false,"remove":true},"className":"swiper-wrapper"} -->
            <div id="slide-holder" class="wp-block-group swiper-wrapper"><!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[0]) ?>","id":2809,"dimRatio":30,"minHeight":750,"gradient":"dark-gradient","contentPosition":"center center","isDark":false,"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"foreground-alt","className":"swiper-slide","layout":{"type":"constrained","contentSize":"660px"}} -->
                <div class="wp-block-cover is-light swiper-slide has-foreground-alt-color has-text-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);min-height:750px" id="tg-slide"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim wp-block-cover__gradient-background has-background-gradient has-dark-gradient-gradient-background"></span><img class="wp-block-cover__image-background wp-image-2809" alt="" src="<?php echo esc_url($tg_patterns_images[0]) ?>" data-object-fit="cover" />
                    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"760px"}} -->
                        <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"lineHeight":"1.4","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|heading-color"}}}},"textColor":"heading-color","fontSize":"xxx-large"} -->
                            <h1 class="wp-block-heading has-text-align-center has-heading-color-color has-text-color has-link-color has-xxx-large-font-size" style="font-style:normal;font-weight:500;line-height:1.4"><?php esc_html_e('Your Vision, Our Expertise,', 'templategalaxy') ?> </h1>
                            <!-- /wp:heading -->

                            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"lineHeight":"1.4","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|heading-color"}}}},"textColor":"heading-color","fontSize":"xxx-large"} -->
                            <h1 class="wp-block-heading has-text-align-center has-heading-color-color has-text-color has-link-color has-xxx-large-font-size" style="font-style:normal;font-weight:500;line-height:1.4"><?php esc_html_e('Elevate Your Brands.', 'templategalaxy') ?></h1>
                            <!-- /wp:heading -->

                            <!-- wp:group {"layout":{"type":"constrained","contentSize":"540px"}} -->
                            <div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"24px"}},"elements":{"link":{"color":{"text":"var:preset|color|heading-color"}}}},"textColor":"heading-color"} -->
                                <p class="has-text-align-center has-heading-color-color has-text-color has-link-color" style="margin-top:24px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
                                <!-- /wp:paragraph -->
                            </div>
                            <!-- /wp:group -->

                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"32px"}}}} -->
                            <div class="wp-block-buttons" style="margin-top:32px"><!-- wp:button {"style":{"border":{"width":"0px","style":"none","radius":"0px"},"spacing":{"padding":{"left":"var:preset|spacing|70","right":"var:preset|spacing|70","top":"20px","bottom":"20px"}}}} -->
                                <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="border-style:none;border-width:0px;border-radius:0px;padding-top:20px;padding-right:var(--wp--preset--spacing--70);padding-bottom:20px;padding-left:var(--wp--preset--spacing--70)"><?php esc_html_e('Download', 'templategalaxy') ?></a></div>
                                <!-- /wp:button -->

                                <!-- wp:button {"backgroundColor":"transparent","textColor":"background","style":{"border":{"radius":"0px","width":"2px"},"spacing":{"padding":{"left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"18px","bottom":"18px"}},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"className":"is-style-button-hover-secondary-bgcolor"} -->
                                <div class="wp-block-button is-style-button-hover-secondary-bgcolor"><a class="wp-block-button__link has-background-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="border-width:2px;border-radius:0px;padding-top:18px;padding-right:var(--wp--preset--spacing--60);padding-bottom:18px;padding-left:var(--wp--preset--spacing--60)"><?php esc_html_e('Discover More', 'templategalaxy') ?></a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                </div>
                <!-- /wp:cover -->

                <!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[1]) ?>","id":3085,"dimRatio":50,"minHeight":750,"customGradient":"linear-gradient(180deg,rgba(0,0,0,0) 24%,rgb(6,6,6) 100%)","contentPosition":"center center","isDark":false,"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"foreground-alt","className":"swiper-slide","layout":{"type":"constrained","contentSize":"660px"}} -->
                <div class="wp-block-cover is-light swiper-slide has-foreground-alt-color has-text-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);min-height:750px" id="tg-slide"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(0,0,0,0) 24%,rgb(6,6,6) 100%)"></span><img class="wp-block-cover__image-background wp-image-3085" alt="" src="<?php echo esc_url($tg_patterns_images[1]) ?>" data-object-fit="cover" />
                    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"760px"}} -->
                        <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"lineHeight":"1.4","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","fontSize":"xxx-large"} -->
                            <h1 class="wp-block-heading has-text-align-center has-background-color has-text-color has-link-color has-xxx-large-font-size" style="font-style:normal;font-weight:500;line-height:1.4"><?php esc_html_e('Your Vision, Our Expertise,', 'templategalaxy') ?> </h1>
                            <!-- /wp:heading -->

                            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"lineHeight":"1.4","fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","fontSize":"xxx-large"} -->
                            <h1 class="wp-block-heading has-text-align-center has-background-color has-text-color has-link-color has-xxx-large-font-size" style="font-style:normal;font-weight:500;line-height:1.4"><?php esc_html_e('Elevate Your Brands.', 'templategalaxy') ?> </h1>
                            <!-- /wp:heading -->

                            <!-- wp:group {"layout":{"type":"constrained","contentSize":"540px"}} -->
                            <div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"24px"}},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background"} -->
                                <p class="has-text-align-center has-background-color has-text-color has-link-color" style="margin-top:24px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
                                <!-- /wp:paragraph -->
                            </div>
                            <!-- /wp:group -->

                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"32px"}}}} -->
                            <div class="wp-block-buttons" style="margin-top:32px"><!-- wp:button {"style":{"border":{"width":"0px","style":"none","radius":"0px"},"spacing":{"padding":{"left":"var:preset|spacing|70","right":"var:preset|spacing|70","top":"20px","bottom":"20px"}}}} -->
                                <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="border-style:none;border-width:0px;border-radius:0px;padding-top:20px;padding-right:var(--wp--preset--spacing--70);padding-bottom:20px;padding-left:var(--wp--preset--spacing--70)"><?php esc_html_e('Download', 'templategalaxy') ?></a></div>
                                <!-- /wp:button -->

                                <!-- wp:button {"backgroundColor":"transparent","textColor":"background","style":{"border":{"radius":"0px","width":"2px"},"spacing":{"padding":{"left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"18px","bottom":"18px"}},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"className":"is-style-button-hover-secondary-bgcolor"} -->
                                <div class="wp-block-button is-style-button-hover-secondary-bgcolor"><a class="wp-block-button__link has-background-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="border-width:2px;border-radius:0px;padding-top:18px;padding-right:var(--wp--preset--spacing--60);padding-bottom:18px;padding-left:var(--wp--preset--spacing--60)"><?php esc_html_e('Discover More', 'templategalaxy') ?></a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                </div>
                <!-- /wp:cover -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":true},"className":"tg-slider-control","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div id="slider-control" class="wp-block-group tg-slider-control"><!-- wp:html {"lock":{"move":false,"remove":true}} -->
                <div class="swiper-pagination tg-slider-pagination"></div>
                <div class="tg-swiper-navigations">
                    <div class="swiper-button-next tg-slider-next"></div>
                    <div class="swiper-button-prev tg-slider-prev"></div>
                </div>
                <!-- /wp:html -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
