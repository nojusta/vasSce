<?php

/**
 * Title: Homepage Layout 01
 * Slug: templategalaxy/tg-homepage-template
 * Categories: templategalaxy-frontpage
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/banner_image.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/service_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/service_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/service_3.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/about_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/about_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/cta_bg.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_2.jpg',
);
?>
<!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[0]) ?>","id":184,"dimRatio":50,"customOverlayColor":"#100d1b","minHeight":760,"isDark":false,"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="min-height:760px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim" style="background-color:#100d1b"></span><img class="wp-block-cover__image-background wp-image-184" alt="" src="<?php echo esc_url($tg_patterns_images[0]) ?>" data-object-fit="cover" />
    <div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group"><!-- wp:site-logo {"width":40} /-->

                    <!-- wp:site-title {"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"large"} /-->
                </div>
                <!-- /wp:group -->

                <!-- wp:navigation {"ref":4,"textColor":"background","customOverlayBackgroundColor":"#f1edff","customOverlayTextColor":"#333333"} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"padding":{"top":"140px","bottom":"140px","left":"0","right":"0"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group" style="padding-top:140px;padding-right:0;padding-bottom:140px;padding-left:0"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"54px"},"color":{"text":"#fbfbfb"}}} -->
            <h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#fbfbfb;font-size:54px;font-style:normal;font-weight:600"><?php esc_html_e('Where Ideas Come to Life: Welcome to TemplateGalaxy', 'templategalaxy') ?></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#f1f1f2"}}} -->
            <p class="has-text-align-center has-text-color" style="color:#f1f1f2"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.', 'templategalaxy') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons"><!-- wp:button {"textColor":"background","style":{"color":{"background":"#8573f3"},"spacing":{"padding":{"left":"30px","right":"30px","top":"20px","bottom":"20px"}}},"className":"is-style-templategalaxy-button-hover-white-background","fontSize":"medium"} -->
                <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-white-background has-medium-font-size"><a class="wp-block-button__link has-background-color has-text-color has-background wp-element-button" style="background-color:#8573f3;padding-top:20px;padding-right:30px;padding-bottom:20px;padding-left:30px"><?php esc_html_e('Make an Appointment', 'templategalaxy') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50","top":"60px","bottom":"60px"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="padding-top:60px;padding-right:var(--wp--preset--spacing--50);padding-bottom:60px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"50px"}}}} -->
    <div class="wp-block-columns"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:image {"align":"full","id":206,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image alignfull size-full"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-206" /></figure>
                <!-- /wp:image -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"36px"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"black"} -->
                <h4 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="margin-top:36px;font-style:normal;font-weight:500"><?php esc_html_e('Market Research', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#767575"},"typography":{"lineHeight":"1.5"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#767575;line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:image {"align":"full","id":216,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image alignfull size-full"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-216" /></figure>
                <!-- /wp:image -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"36px"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"black"} -->
                <h4 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="margin-top:36px;font-style:normal;font-weight:500"><?php esc_html_e('Growth Strategy', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#767575"},"typography":{"lineHeight":"1.5"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#767575;line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:image {"align":"full","id":217,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image alignfull size-full"><img src="<?php echo esc_url($tg_patterns_images[3]) ?>" alt="" class="wp-image-217" /></figure>
                <!-- /wp:image -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"36px"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"black"} -->
                <h4 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="margin-top:36px;font-style:normal;font-weight:500"><?php esc_html_e('Business Planning', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#767575"},"typography":{"lineHeight":"1.5"}}} -->
                <p class="has-text-align-center has-text-color" style="color:#767575;line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"70px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
            <h2 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('Crafting a Legacy of Excellence and Innovation', 'templategalaxy') ?></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"color":{"text":"#767575"}}} -->
            <p class="has-text-color" style="color:#767575"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
            <div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background","style":{"color":{"background":"#8573f3"},"spacing":{"padding":{"left":"38px","right":"38px","top":"17px","bottom":"17px"}}},"className":"is-style-templategalaxy-button-hover-neutral-background","fontSize":"medium"} -->
                <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-neutral-background has-medium-font-size"><a class="wp-block-button__link has-background-color has-text-color has-background wp-element-button" style="background-color:#8573f3;padding-top:17px;padding-right:38px;padding-bottom:17px;padding-left:38px"><?php esc_html_e('Read More', 'templategalaxy') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":220,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[4]) ?>" alt="" class="wp-image-220" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|80","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"70px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":225,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[5]) ?>" alt="" class="wp-image-225" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
            <h2 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('Crafting a Legacy of Excellence and Innovation', 'templategalaxy') ?></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"color":{"text":"#767575"}}} -->
            <p class="has-text-color" style="color:#767575"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
            <div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background","style":{"color":{"background":"#8573f3"},"spacing":{"padding":{"left":"38px","right":"38px","top":"17px","bottom":"17px"}}},"className":"is-style-templategalaxy-button-hover-neutral-background","fontSize":"medium"} -->
                <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-neutral-background has-medium-font-size"><a class="wp-block-button__link has-background-color has-text-color has-background wp-element-button" style="background-color:#8573f3;padding-top:17px;padding-right:38px;padding-bottom:17px;padding-left:38px"><?php esc_html_e('Read More', 'templategalaxy') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[6]) ?>","id":227,"dimRatio":50,"minHeight":560,"isDark":false,"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="min-height:560px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-227" alt="" src="<?php echo esc_url($tg_patterns_images[6]) ?>" data-object-fit="cover" />
    <div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"54px"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"background"} -->
        <h2 class="wp-block-heading has-text-align-center has-background-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:54px;font-style:normal;font-weight:600"><?php esc_html_e('Ready to Ignite Your Success?', 'templategalaxy') ?></h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#e6e3e3"},"typography":{"lineHeight":"1.5"}},"fontSize":"medium"} -->
        <p class="has-text-align-center has-text-color has-medium-font-size" style="color:#e6e3e3;line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.', 'templategalaxy') ?></p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
        <div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background","style":{"color":{"background":"#8573f3"},"spacing":{"padding":{"left":"38px","right":"38px","top":"20px","bottom":"20px"}}},"className":"is-style-templategalaxy-button-hover-white-background","fontSize":"medium"} -->
            <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-white-background has-medium-font-size"><a class="wp-block-button__link has-background-color has-text-color has-background wp-element-button" style="background-color:#8573f3;padding-top:20px;padding-right:38px;padding-bottom:20px;padding-left:38px"><?php esc_html_e('Contact Us Today', 'templategalaxy') ?></a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
</div>
<!-- /wp:cover -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"7rem","bottom":"7rem","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1080px"}} -->
<div class="wp-block-group" style="padding-top:7rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:7rem;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"50px"}}}} -->
    <div class="wp-block-columns"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":239,"height":60,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[7]) ?>" alt="" class="wp-image-239" style="border-radius:50px;height:60px" height="60" /></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"7px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                        <h4 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('George Gerrat', 'templategalaxy') ?></h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"style":{"color":{"text":"#8c8a8a"}},"fontSize":"normal"} -->
                        <p class="has-text-color has-normal-font-size" style="color:#8c8a8a"><?php esc_html_e('Freelancer', 'templategalaxy') ?></p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":241,"height":60,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[8]) ?>" alt="" class="wp-image-241" style="border-radius:50px;height:60px" height="60" /></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"7px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                        <h4 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('Manika Lamier', 'templategalaxy') ?></h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"style":{"color":{"text":"#8c8a8a"}},"fontSize":"normal"} -->
                        <p class="has-text-color has-normal-font-size" style="color:#8c8a8a"><?php esc_html_e('Blogger', 'templategalaxy') ?></p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->