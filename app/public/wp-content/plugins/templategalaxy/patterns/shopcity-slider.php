<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Slider (PRO)
         * Slug: templategalaxy/shopcity-slider
         * Categories: shopcity
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/shopcity/banner_img.jpg',
            TEMPLATEGALAXY_URL . 'assets/images/shopcity/banner_img_2.jpg',
            TEMPLATEGALAXY_URL . 'assets/images/shopcity/banner_img_3.jpg'
        );
?>
        <!-- wp:group {"lock":{"move":false,"remove":false},"className":"tg-slider"} -->
        <div id="TG-SLIDER" class="wp-block-group tg-slider"><!-- wp:group {"lock":{"move":false,"remove":true},"className":"swiper-wrapper"} -->
            <div id="slide-holder" class="wp-block-group swiper-wrapper"><!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[0]) ?>","id":3406,"dimRatio":30,"overlayColor":"dark-color","isUserOverlayColor":true,"minHeight":700,"contentPosition":"center center","isDark":false,"lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"foreground-alt","className":"swiper-slide","layout":{"type":"constrained","contentSize":"1180px"}} -->
                <div class="wp-block-cover is-light swiper-slide has-foreground-alt-color has-text-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);min-height:700px" id="tg-slide"><span aria-hidden="true" class="wp-block-cover__background has-dark-color-background-color has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-3406" alt="" src="<?php echo esc_url($tg_patterns_images[0]) ?>" data-object-fit="cover" />
                    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"dimensions":{"minHeight":""}},"layout":{"type":"constrained","contentSize":"660px","justifyContent":"left"}} -->
                        <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"left","level":1,"style":{"typography":{"lineHeight":"1.2","fontStyle":"normal","fontWeight":"500","fontSize":"84px"},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color"} -->
                            <h1 class="wp-block-heading has-text-align-left has-light-color-color has-text-color has-link-color" style="font-size:84px;font-style:normal;font-weight:500;line-height:1.2"><?php esc_html_e('Premium &amp; Organic Cosmetic Store', 'shopcity') ?></h1>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"left","style":{"spacing":{"margin":{"top":"24px"}},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color"} -->
                            <p class="has-text-align-left has-light-color-color has-text-color has-link-color" style="margin-top:24px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'shopcity') ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
                            <div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"backgroundColor":"transparent","textColor":"light-color","style":{"border":{"radius":"0px","width":"1px"},"spacing":{"padding":{"left":"var:preset|spacing|70","right":"var:preset|spacing|70","top":"22px","bottom":"22px"}},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"className":"is-style-button-hover-secondary-bgcolor","fontSize":"medium"} -->
                                <div class="wp-block-button has-custom-font-size is-style-button-hover-secondary-bgcolor has-medium-font-size"><a class="wp-block-button__link has-light-color-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="border-width:1px;border-radius:0px;padding-top:22px;padding-right:var(--wp--preset--spacing--70);padding-bottom:22px;padding-left:var(--wp--preset--spacing--70)"><?php esc_html_e('Start Shopping', 'shopcity') ?></a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                </div>
                <!-- /wp:cover -->

                <!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[1]) ?>","id":3918,"dimRatio":30,"overlayColor":"dark-color","isUserOverlayColor":true,"minHeight":700,"contentPosition":"center center","lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"foreground-alt","className":"swiper-slide","layout":{"type":"constrained","contentSize":"1180px"}} -->
                <div class="wp-block-cover swiper-slide has-foreground-alt-color has-text-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);min-height:700px" id="tg-slide"><span aria-hidden="true" class="wp-block-cover__background has-dark-color-background-color has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-3918" alt="" src="<?php echo esc_url($tg_patterns_images[1]) ?>" data-object-fit="cover" />
                    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"dimensions":{"minHeight":""}},"layout":{"type":"constrained","contentSize":"660px","justifyContent":"right"}} -->
                        <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"lineHeight":"1.2","fontStyle":"normal","fontWeight":"500","fontSize":"84px"},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color"} -->
                            <h1 class="wp-block-heading has-text-align-center has-light-color-color has-text-color has-link-color" style="font-size:84px;font-style:normal;font-weight:500;line-height:1.2"><?php esc_html_e('Premium &amp; Organic Cosmetic Store', 'shopcity') ?></h1>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"24px"}},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color"} -->
                            <p class="has-text-align-center has-light-color-color has-text-color has-link-color" style="margin-top:24px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'shopcity') ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
                            <div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"backgroundColor":"transparent","textColor":"light-color","style":{"border":{"radius":"0px","width":"1px"},"spacing":{"padding":{"left":"var:preset|spacing|70","right":"var:preset|spacing|70","top":"22px","bottom":"22px"}},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"className":"is-style-button-hover-secondary-bgcolor","fontSize":"medium"} -->
                                <div class="wp-block-button has-custom-font-size is-style-button-hover-secondary-bgcolor has-medium-font-size"><a class="wp-block-button__link has-light-color-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="border-width:1px;border-radius:0px;padding-top:22px;padding-right:var(--wp--preset--spacing--70);padding-bottom:22px;padding-left:var(--wp--preset--spacing--70)"><?php esc_html_e('Start Shopping', 'shopcity') ?></a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                </div>
                <!-- /wp:cover -->

                <!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[2]) ?>","id":3920,"dimRatio":30,"overlayColor":"dark-color","isUserOverlayColor":true,"minHeight":700,"contentPosition":"center center","lock":{"move":false,"remove":false},"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"foreground-alt","className":"swiper-slide","layout":{"type":"constrained","contentSize":"1180px"}} -->
                <div class="wp-block-cover swiper-slide has-foreground-alt-color has-text-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);min-height:700px" id="tg-slide"><span aria-hidden="true" class="wp-block-cover__background has-dark-color-background-color has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-3920" alt="" src="<?php echo esc_url($tg_patterns_images[2]) ?>" data-object-fit="cover" />
                    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"dimensions":{"minHeight":""}},"layout":{"type":"constrained","contentSize":"660px","justifyContent":"left"}} -->
                        <div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"left","level":1,"style":{"typography":{"lineHeight":"1.2","fontStyle":"normal","fontWeight":"500","fontSize":"84px"},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color"} -->
                            <h1 class="wp-block-heading has-text-align-left has-light-color-color has-text-color has-link-color" style="font-size:84px;font-style:normal;font-weight:500;line-height:1.2"><?php esc_html_e('Premium &amp; Organic Cosmetic Store', 'shopcity') ?></h1>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"left","style":{"spacing":{"margin":{"top":"24px"}},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color"} -->
                            <p class="has-text-align-left has-light-color-color has-text-color has-link-color" style="margin-top:24px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'shopcity') ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
                            <div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"backgroundColor":"transparent","textColor":"light-color","style":{"border":{"radius":"0px","width":"1px"},"spacing":{"padding":{"left":"var:preset|spacing|70","right":"var:preset|spacing|70","top":"22px","bottom":"22px"}},"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"className":"is-style-button-hover-secondary-bgcolor","fontSize":"medium"} -->
                                <div class="wp-block-button has-custom-font-size is-style-button-hover-secondary-bgcolor has-medium-font-size"><a class="wp-block-button__link has-light-color-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="border-width:1px;border-radius:0px;padding-top:22px;padding-right:var(--wp--preset--spacing--70);padding-bottom:22px;padding-left:var(--wp--preset--spacing--70)"><?php esc_html_e('Start Shopping', 'shopcity') ?></a></div>
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
