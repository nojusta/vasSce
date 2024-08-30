<?php

/**
 * Title: Homepage Layout 02
 * Slug: templategalaxy/tg-homepage-template-2
 * Categories: templategalaxy-frontpage
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/about_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/thumbnail.png',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/about_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/team_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/team_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/team_3.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_4.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/check_icon.png'
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"100px","bottom":"100px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"color":{"background":"#e1eeee"}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group has-background" style="background-color:#e1eeee;padding-top:100px;padding-right:var(--wp--preset--spacing--50);padding-bottom:100px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"100px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":5,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"500"},"color":{"text":"#11c3b9"}},"fontSize":"small"} -->
            <h5 class="wp-block-heading has-text-color has-small-font-size" style="color:#11c3b9;font-style:normal;font-weight:500;text-transform:uppercase"><?php esc_html_e('Welcome to TemplateGalaxy', 'templategalaxy') ?></h5>
            <!-- /wp:heading -->

            <!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"54px"}},"textColor":"black"} -->
            <h1 class="wp-block-heading has-black-color has-text-color" style="font-size:54px;font-style:normal;font-weight:700"><?php esc_html_e('Let\'s Create Awesome Together!', 'templategalaxy') ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"color":{"text":"#777777"}}} -->
            <p class="has-text-color" style="color:#777777"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:image {"id":477,"width":"15px","sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[9]) ?>" alt="" class="wp-image-477" style="width:15px" /></figure>
                <!-- /wp:image -->

                <!-- wp:list {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"className":"is-style-templategalaxy-list-style-no-bullet"} -->
                <ul class="is-style-templategalaxy-list-style-no-bullet" style="padding-right:0;padding-left:0"><!-- wp:list-item -->
                    <li><?php esc_html_e('100% Performance', 'templategalaxy') ?></li>
                    <!-- /wp:list-item -->
                </ul>
                <!-- /wp:list -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:image {"id":477,"width":"15px","sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[9]) ?>" alt="" class="wp-image-477" style="width:15px" /></figure>
                <!-- /wp:image -->

                <!-- wp:list {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"className":"is-style-templategalaxy-list-style-no-bullet"} -->
                <ul class="is-style-templategalaxy-list-style-no-bullet" style="padding-right:0;padding-left:0"><!-- wp:list-item -->
                    <li><?php esc_html_e('100% Result Driven', 'templategalaxy') ?></li>
                    <!-- /wp:list-item -->
                </ul>
                <!-- /wp:list -->
            </div>
            <!-- /wp:group -->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"32px"}}}} -->
            <div class="wp-block-buttons" style="margin-top:32px"><!-- wp:button {"style":{"spacing":{"padding":{"left":"40px","right":"40px","top":"18px","bottom":"18px"}},"color":{"background":"#11c3b9"}},"className":"is-style-templategalaxy-button-hover-black-background","fontSize":"medium"} -->
                <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-black-background has-medium-font-size"><a class="wp-block-button__link has-background wp-element-button" style="background-color:#11c3b9;padding-top:18px;padding-right:40px;padding-bottom:18px;padding-left:40px"><?php esc_html_e('Request a Quote', 'templategalaxy') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":527,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"30px"}}} -->
            <figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-527" style="border-radius:30px" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"120px","bottom":"120px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:120px;padding-right:var(--wp--preset--spacing--50);padding-bottom:120px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"660px"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"uppercase"},"color":{"text":"#11c3b9"}},"fontSize":"normal"} -->
        <h5 class="wp-block-heading has-text-align-center has-text-color has-normal-font-size" style="color:#11c3b9;font-style:normal;font-weight:500;text-transform:uppercase"><?php esc_html_e('What We Do', 'templategalaxy') ?></h5>
        <!-- /wp:heading -->

        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","textTransform":"none","fontSize":"54px","lineHeight":"1.3"}},"textColor":"black"} -->
        <h1 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-size:54px;font-style:normal;font-weight:600;line-height:1.3;text-transform:none"><?php esc_html_e('Convert More Visitors into Customers', 'templategalaxy') ?></h1>
        <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"42px"},"margin":{"top":"60px"}}}} -->
    <div class="wp-block-columns" style="margin-top:60px"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"}},"border":{"color":"#f0f0f0","width":"1px","radius":"30px"}},"className":"is-style-templategalaxy-boxshadow-hover","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-templategalaxy-boxshadow-hover has-border-color" style="border-color:#f0f0f0;border-width:1px;border-radius:30px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:image {"align":"center","id":487,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-487" style="object-fit:cover;width:80px;height:80px" /></figure>
                <!-- /wp:image -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"50px"}}},"fontSize":"medium"} -->
                <h4 class="wp-block-heading has-text-align-center has-medium-font-size" style="margin-top:50px;font-style:normal;font-weight:500"><?php esc_html_e('Digital Marketing', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#777777"}},"fontSize":"normal"} -->
                <p class="has-text-align-center has-text-color has-normal-font-size" style="color:#777777"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"42px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:42px"><!-- wp:button {"backgroundColor":"background","style":{"color":{"text":"#11c3b9"}},"className":"is-style-templategalaxy-button-hover-black-background","fontSize":"medium"} -->
                    <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-black-background has-medium-font-size"><a class="wp-block-button__link has-background-background-color has-text-color has-background wp-element-button" style="color:#11c3b9"><?php esc_html_e('Read More', 'templategalaxy') ?></a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"}},"border":{"color":"#f0f0f0","width":"1px","radius":"30px"}},"className":"is-style-templategalaxy-boxshadow-hover","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-templategalaxy-boxshadow-hover has-border-color" style="border-color:#f0f0f0;border-width:1px;border-radius:30px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:image {"align":"center","id":487,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-487" style="object-fit:cover;width:80px;height:80px" /></figure>
                <!-- /wp:image -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"50px"}}},"fontSize":"medium"} -->
                <h4 class="wp-block-heading has-text-align-center has-medium-font-size" style="margin-top:50px;font-style:normal;font-weight:500"><?php esc_html_e('Digital Marketing', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#777777"}},"fontSize":"normal"} -->
                <p class="has-text-align-center has-text-color has-normal-font-size" style="color:#777777"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"42px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:42px"><!-- wp:button {"backgroundColor":"background","style":{"color":{"text":"#11c3b9"}},"className":"is-style-templategalaxy-button-hover-black-background","fontSize":"medium"} -->
                    <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-black-background has-medium-font-size"><a class="wp-block-button__link has-background-background-color has-text-color has-background wp-element-button" style="color:#11c3b9"><?php esc_html_e('Read More', 'templategalaxy') ?></a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"}},"border":{"color":"#f0f0f0","width":"1px","radius":"30px"}},"className":"is-style-templategalaxy-boxshadow-hover","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-templategalaxy-boxshadow-hover has-border-color" style="border-color:#f0f0f0;border-width:1px;border-radius:30px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:image {"align":"center","id":487,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-487" style="object-fit:cover;width:80px;height:80px" /></figure>
                <!-- /wp:image -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"50px"}}},"fontSize":"medium"} -->
                <h4 class="wp-block-heading has-text-align-center has-medium-font-size" style="margin-top:50px;font-style:normal;font-weight:500"><?php esc_html_e('Digital Marketing', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#777777"}},"fontSize":"normal"} -->
                <p class="has-text-align-center has-text-color has-normal-font-size" style="color:#777777"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"42px"}}}} -->
                <div class="wp-block-buttons" style="margin-top:42px"><!-- wp:button {"backgroundColor":"background","style":{"color":{"text":"#11c3b9"}},"className":"is-style-templategalaxy-button-hover-black-background","fontSize":"medium"} -->
                    <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-black-background has-medium-font-size"><a class="wp-block-button__link has-background-background-color has-text-color has-background wp-element-button" style="color:#11c3b9"><?php esc_html_e('Read More', 'templategalaxy') ?></a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"120px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="padding-top:0;padding-right:var(--wp--preset--spacing--50);padding-bottom:120px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"100px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:50%"><!-- wp:image {"id":525,"height":"660px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"30px"}}} -->
            <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-525" style="border-radius:30px;height:660px" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"top"} -->
        <div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":5,"style":{"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"uppercase"},"color":{"text":"#11c3b9"}},"fontSize":"normal"} -->
            <h5 class="wp-block-heading has-text-color has-normal-font-size" style="color:#11c3b9;font-style:normal;font-weight:500;text-transform:uppercase"><?php esc_html_e('About Us', 'templategalaxy') ?></h5>
            <!-- /wp:heading -->

            <!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"54px"},"spacing":{"margin":{"top":"20px"}}},"textColor":"black"} -->
            <h2 class="wp-block-heading has-black-color has-text-color" style="margin-top:20px;font-size:54px;font-style:normal;font-weight:600"><?php esc_html_e('Crafting a Legacy of Excellence.', 'templategalaxy') ?></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"color":{"text":"#767575"},"typography":{"lineHeight":"1.5"}}} -->
            <p class="has-text-color" style="color:#767575;line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua sed do eiusmod tempor incididunt ut labore et dolore.', 'templategalaxy') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"40px","margin":{"top":"60px"},"padding":{"bottom":"24px"}},"border":{"bottom":{"color":"#e6e6e6","width":"1px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="border-bottom-color:#e6e6e6;border-bottom-width:1px;margin-top:60px;padding-bottom:24px"><!-- wp:columns -->
                <div class="wp-block-columns"><!-- wp:column {"width":""} -->
                    <div class="wp-block-column"><!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1"}},"textColor":"black","fontSize":"x-large"} -->
                        <h1 class="wp-block-heading has-black-color has-text-color has-x-large-font-size" style="font-style:normal;font-weight:600;line-height:1"><?php esc_html_e('01', 'templategalaxy') ?></h1>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"width":"75%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
                    <div class="wp-block-column" style="flex-basis:75%"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
                        <h4 class="wp-block-heading has-medium-font-size" style="font-style:normal;font-weight:500"><?php esc_html_e('100% Track Record', 'templategalaxy') ?></h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"style":{"color":{"text":"#777777"}}} -->
                        <p class="has-text-color" style="color:#777777"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore', 'templategalaxy') ?></p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->

                <!-- wp:columns -->
                <div class="wp-block-columns"><!-- wp:column {"width":""} -->
                    <div class="wp-block-column"><!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1"}},"textColor":"black","fontSize":"x-large"} -->
                        <h1 class="wp-block-heading has-black-color has-text-color has-x-large-font-size" style="font-style:normal;font-weight:600;line-height:1"><?php esc_html_e('02', 'templategalaxy') ?></h1>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"width":"75%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
                    <div class="wp-block-column" style="flex-basis:75%"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
                        <h4 class="wp-block-heading has-medium-font-size" style="font-style:normal;font-weight:500"><?php esc_html_e('100% Result Driven', 'templategalaxy') ?></h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"style":{"color":{"text":"#777777"}}} -->
                        <p class="has-text-color" style="color:#777777"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore', 'templategalaxy') ?></p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"32px"}}}} -->
            <div class="wp-block-buttons" style="margin-top:32px"><!-- wp:button {"style":{"spacing":{"padding":{"left":"40px","right":"40px","top":"18px","bottom":"18px"}},"color":{"background":"#11c3b9"}},"className":"is-style-templategalaxy-button-hover-black-background","fontSize":"medium"} -->
                <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-black-background has-medium-font-size"><a class="wp-block-button__link has-background wp-element-button" style="background-color:#11c3b9;padding-top:18px;padding-right:40px;padding-bottom:18px;padding-left:40px"><?php esc_html_e('Read More', 'templategalaxy') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"120px","bottom":"120px"}},"color":{"background":"#e1eeee"}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group has-background" style="background-color:#e1eeee;padding-top:120px;padding-bottom:120px"><!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"500"},"color":{"text":"#11c3b9"}},"fontSize":"small"} -->
        <h4 class="wp-block-heading has-text-align-center has-text-color has-small-font-size" style="color:#11c3b9;font-style:normal;font-weight:500;text-transform:uppercase"><?php esc_html_e('Our Achievement Stats', 'templategalaxy') ?></h4>
        <!-- /wp:heading -->

        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"54px"}},"textColor":"black"} -->
        <h1 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-size:54px;font-style:normal;font-weight:600"><?php esc_html_e('Let the speaks number about our success.', 'templategalaxy') ?></h1>
        <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"margin":{"top":"60px"},"blockGap":{"left":"50px"}}}} -->
    <div class="wp-block-columns" style="margin-top:60px"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"30px"},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}}},"backgroundColor":"background","className":"is-style-templategalaxy-boxshadow-hover","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-templategalaxy-boxshadow-hover has-background-background-color has-background" style="border-radius:30px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"64px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"bottom":"32px"}}},"textColor":"black"} -->
                <h1 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="margin-bottom:32px;font-size:64px;font-style:normal;font-weight:700"><?php esc_html_e('100%', 'templategalaxy') ?></h1>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"black"} -->
                <h4 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-style:normal;font-weight:500"><?php esc_html_e('Performance', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}},"fontSize":"normal"} -->
                <p class="has-text-align-center has-normal-font-size" style="line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"30px"},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}}},"backgroundColor":"background","className":"is-style-templategalaxy-boxshadow-hover","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-templategalaxy-boxshadow-hover has-background-background-color has-background" style="border-radius:30px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"64px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"bottom":"32px"}}},"textColor":"black"} -->
                <h1 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="margin-bottom:32px;font-size:64px;font-style:normal;font-weight:700"><?php esc_html_e('100%', 'templategalaxy') ?></h1>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"black"} -->
                <h4 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-style:normal;font-weight:500"><?php esc_html_e('Responsive', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}},"fontSize":"normal"} -->
                <p class="has-text-align-center has-normal-font-size" style="line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"30px"},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}}},"backgroundColor":"background","className":"is-style-templategalaxy-boxshadow-hover","layout":{"type":"constrained"}} -->
            <div class="wp-block-group is-style-templategalaxy-boxshadow-hover has-background-background-color has-background" style="border-radius:30px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"64px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"bottom":"32px"}}},"textColor":"black"} -->
                <h1 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="margin-bottom:32px;font-size:64px;font-style:normal;font-weight:700"><?php esc_html_e('100%', 'templategalaxy') ?></h1>
                <!-- /wp:heading -->

                <!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"black"} -->
                <h4 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-style:normal;font-weight:500"><?php esc_html_e('Speed', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}},"fontSize":"normal"} -->
                <p class="has-text-align-center has-normal-font-size" style="line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"7rem","bottom":"8rem","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:7rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:8rem;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"760px"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"500","textTransform":"uppercase"},"color":{"text":"#11c3b9"}}} -->
        <h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#11c3b9;font-size:14px;font-style:normal;font-weight:500;text-transform:uppercase"><?php esc_html_e('Meet The Team', 'templategalaxy') ?></h2>
        <!-- /wp:heading -->

        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"54px"}},"textColor":"black"} -->
        <h1 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-size:54px;font-style:normal;font-weight:600"><?php esc_html_e('Meet the people who make our agency success', 'templategalaxy') ?></h1>
        <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"80px"},"margin":{"top":"100px"}}}} -->
    <div class="wp-block-columns" style="margin-top:100px"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"0px","width":"0px","style":"none"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="border-style:none;border-width:0px;border-radius:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:image {"align":"center","id":278,"width":"150px","height":"150px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%"}}} -->
                <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[3]) ?>" alt="" class="wp-image-278" style="border-radius:50%;object-fit:cover;width:150px;height:150px" /></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"7px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                    <h4 class="wp-block-heading has-text-align-center" style="font-style:normal;font-weight:500"><?php esc_html_e('George Gerrat', 'templategalaxy') ?></h4>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#8c8a8a"}},"fontSize":"normal"} -->
                    <p class="has-text-align-center has-text-color has-normal-font-size" style="color:#8c8a8a"><?php esc_html_e('Freelancer', 'templategalaxy') ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#777777"},"spacing":{"margin":{"top":"20px"}}}} -->
                    <p class="has-text-align-center has-text-color" style="color:#777777;margin-top:20px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'templategalaxy') ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:social-links {"customIconColor":"#56595c","iconColorValue":"#56595c","style":{"spacing":{"margin":{"top":"24px"}}},"className":"is-style-logos-only"} -->
                    <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:24px"><!-- wp:social-link {"url":"#","service":"dribbble"} /-->

                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                        <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"0px","width":"0px","style":"none"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="border-style:none;border-width:0px;border-radius:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:image {"align":"center","id":283,"width":"150px","height":"150px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%"}}} -->
                <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[4]) ?>" alt="" class="wp-image-283" style="border-radius:50%;object-fit:cover;width:150px;height:150px" /></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"7px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                    <h4 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('Antony Loye', 'templategalaxy') ?></h4>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"style":{"color":{"text":"#8c8a8a"}},"fontSize":"normal"} -->
                    <p class="has-text-color has-normal-font-size" style="color:#8c8a8a"><?php esc_html_e('Freelancer', 'templategalaxy') ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#777777"},"spacing":{"margin":{"top":"20px"}}}} -->
                    <p class="has-text-align-center has-text-color" style="color:#777777;margin-top:20px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'templategalaxy') ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:social-links {"customIconColor":"#56595c","iconColorValue":"#56595c","style":{"spacing":{"margin":{"top":"24px"}}},"className":"is-style-logos-only"} -->
                    <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:24px"><!-- wp:social-link {"url":"#","service":"dribbble"} /-->

                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                        <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"0px","width":"0px","style":"none"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="border-style:none;border-width:0px;border-radius:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:image {"align":"center","id":284,"width":"150px","height":"150px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%"}}} -->
                <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[5]) ?>" alt="" class="wp-image-284" style="border-radius:50%;object-fit:cover;width:150px;height:150px" /></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"7px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                    <h4 class="wp-block-heading has-text-align-center" style="font-style:normal;font-weight:500"><?php esc_html_e('Melinda Madon', 'templategalaxy') ?></h4>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#8c8a8a"}},"fontSize":"normal"} -->
                    <p class="has-text-align-center has-text-color has-normal-font-size" style="color:#8c8a8a"><?php esc_html_e('Freelancer', 'templategalaxy') ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#777777"},"spacing":{"margin":{"top":"20px"}}}} -->
                    <p class="has-text-align-center has-text-color" style="color:#777777;margin-top:20px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'templategalaxy') ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:social-links {"customIconColor":"#56595c","iconColorValue":"#56595c","style":{"spacing":{"margin":{"top":"24px"}}},"className":"is-style-logos-only"} -->
                    <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:24px"><!-- wp:social-link {"url":"#","service":"dribbble"} /-->

                        <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                        <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                    </ul>
                    <!-- /wp:social-links -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
    <div class="wp-block-group"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"80px"},"margin":{"top":"80px"}}}} -->
        <div class="wp-block-columns" style="margin-top:80px"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"0px","width":"0px","style":"none"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="border-style:none;border-width:0px;border-radius:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:image {"align":"center","id":278,"width":"150px","height":"150px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%"}}} -->
                    <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[6]) ?>" alt="" class="wp-image-278" style="border-radius:50%;object-fit:cover;width:150px;height:150px" /></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"7px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                        <h4 class="wp-block-heading has-text-align-center" style="font-style:normal;font-weight:500"><?php esc_html_e('George Gerrat', 'templategalaxy') ?></h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#8c8a8a"}},"fontSize":"normal"} -->
                        <p class="has-text-align-center has-text-color has-normal-font-size" style="color:#8c8a8a"><?php esc_html_e('Freelancer', 'templategalaxy') ?></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#777777"},"spacing":{"margin":{"top":"20px"}}}} -->
                        <p class="has-text-align-center has-text-color" style="color:#777777;margin-top:20px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'templategalaxy') ?></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:social-links {"customIconColor":"#56595c","iconColorValue":"#56595c","style":{"spacing":{"margin":{"top":"24px"}}},"className":"is-style-logos-only"} -->
                        <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:24px"><!-- wp:social-link {"url":"#","service":"dribbble"} /-->

                            <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                            <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                        </ul>
                        <!-- /wp:social-links -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"0px","width":"0px","style":"none"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="border-style:none;border-width:0px;border-radius:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:image {"align":"center","id":283,"width":"150px","height":"150px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%"}}} -->
                    <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[7]) ?>" alt="" class="wp-image-283" style="border-radius:50%;object-fit:cover;width:150px;height:150px" /></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"7px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                        <h4 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('Antony Loye', 'templategalaxy') ?></h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"style":{"color":{"text":"#8c8a8a"}},"fontSize":"normal"} -->
                        <p class="has-text-color has-normal-font-size" style="color:#8c8a8a"><?php esc_html_e('Freelancer', 'templategalaxy') ?></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#777777"},"spacing":{"margin":{"top":"20px"}}}} -->
                        <p class="has-text-align-center has-text-color" style="color:#777777;margin-top:20px"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.', 'templategalaxy') ?></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:social-links {"customIconColor":"#56595c","iconColorValue":"#56595c","style":{"spacing":{"margin":{"top":"24px"}}},"className":"is-style-logos-only"} -->
                        <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:24px"><!-- wp:social-link {"url":"#","service":"dribbble"} /-->

                            <!-- wp:social-link {"url":"#","service":"twitter"} /-->

                            <!-- wp:social-link {"url":"#","service":"instagram"} /-->
                        </ul>
                        <!-- /wp:social-links -->
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
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"7rem","bottom":"8rem","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"color":{"background":"#e1eeee"}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group has-background" style="background-color:#e1eeee;padding-top:7rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:8rem;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"760px"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"54px","fontStyle":"normal","fontWeight":"600"}},"textColor":"black"} -->
        <h2 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-size:54px;font-style:normal;font-weight:600"><?php esc_html_e('What Our Client Says', 'templategalaxy') ?></h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#767676"},"typography":{"lineHeight":"1.5"}},"fontSize":"normal"} -->
        <p class="has-text-align-center has-text-color has-normal-font-size" style="color:#767676;line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"50px"},"margin":{"top":"80px"}}}} -->
    <div class="wp-block-columns" style="margin-top:80px"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"30px","width":"0px","style":"none"},"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"backgroundColor":"background","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-background-background-color has-background" style="border-style:none;border-width:0px;border-radius:30px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":239,"width":"undefinedpx","height":"60px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[6]) ?>" alt="" class="wp-image-239" style="border-radius:50px;width:undefinedpx;height:60px" /></figure>
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
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"30px","width":"0px","style":"none"},"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"backgroundColor":"background","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-background-background-color has-background" style="border-style:none;border-width:0px;border-radius:30px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":241,"width":"undefinedpx","height":"60px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[7]) ?>" alt="" class="wp-image-241" style="border-radius:50px;width:undefinedpx;height:60px" /></figure>
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

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"30px","width":"0px","style":"none"},"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"backgroundColor":"background","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-background-background-color has-background" style="border-style:none;border-width:0px;border-radius:30px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":241,"width":"undefinedpx","height":"60px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[8]) ?>" alt="" class="wp-image-241" style="border-radius:50px;width:undefinedpx;height:60px" /></figure>
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

<!-- wp:group {"style":{"spacing":{"padding":{"top":"120px","bottom":"120px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1000px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:120px;padding-right:var(--wp--preset--spacing--50);padding-bottom:120px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"860px"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"textTransform":"uppercase"},"color":{"text":"#11c3b9"}},"fontSize":"small"} -->
        <h5 class="wp-block-heading has-text-align-center has-text-color has-small-font-size" style="color:#11c3b9;text-transform:uppercase"><?php esc_html_e('Pricing &amp; Plans', 'templategalaxy') ?></h5>
        <!-- /wp:heading -->

        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"54px"}},"textColor":"black","className":"blockpage-heading"} -->
        <h1 class="wp-block-heading has-text-align-center blockpage-heading has-black-color has-text-color" style="font-size:54px;font-style:normal;font-weight:600"><?php esc_html_e('Choose the appropriate pricing for your business.', 'templategalaxy') ?></h1>
        <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"32px"},"margin":{"top":"64px"}}}} -->
    <div class="wp-block-columns" style="margin-top:64px"><!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"60px","bottom":"60px","left":"60px","right":"60px"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"7px","color":"#e9e5e5","width":"1px"}},"className":"blockpage-pricing-box is-style-templategalaxy-boxshadow-hover","layout":{"type":"constrained"}} -->
            <div class="wp-block-group blockpage-pricing-box is-style-templategalaxy-boxshadow-hover has-border-color" style="border-color:#e9e5e5;border-width:1px;border-radius:7px;padding-top:60px;padding-right:60px;padding-bottom:60px;padding-left:60px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
                <div class="wp-block-group"><!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"48px","lineHeight":"0.8","fontStyle":"normal","fontWeight":"600"}},"textColor":"black"} -->
                    <h1 class="wp-block-heading has-black-color has-text-color" style="font-size:48px;font-style:normal;font-weight:600;line-height:0.8"><?php esc_html_e('$49', 'templategalaxy') ?></h1>
                    <!-- /wp:heading -->

                    <!-- wp:heading {"level":6,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                    <h6 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('/per year', 'templategalaxy') ?></h6>
                    <!-- /wp:heading -->
                </div>
                <!-- /wp:group -->

                <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"52px"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"black","fontSize":"large"} -->
                <h3 class="wp-block-heading has-black-color has-text-color has-large-font-size" style="margin-top:52px;font-style:normal;font-weight:500"><?php esc_html_e('Starter Package', 'templategalaxy') ?></h3>
                <!-- /wp:heading -->

                <!-- wp:paragraph -->
                <p><?php esc_html_e('Check out our new font generator and level up your pricing and plans as requirement.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"align":"full","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"42px","bottom":"32px"}}}} -->
                <div class="wp-block-buttons alignfull" style="margin-top:42px;margin-bottom:32px"><!-- wp:button {"backgroundColor":"background","textColor":"black","width":100,"style":{"spacing":{"padding":{"left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"15px","bottom":"15px"}},"border":{"radius":"5px","width":"1px"}},"borderColor":"black","className":"blockpage-pricing-buttons is-style-templategalaxy-button-hover-black-background","fontSize":"medium"} -->
                    <div class="wp-block-button has-custom-width wp-block-button__width-100 has-custom-font-size blockpage-pricing-buttons is-style-templategalaxy-button-hover-black-background has-medium-font-size"><a class="wp-block-button__link has-black-color has-background-background-color has-text-color has-background has-border-color has-black-border-color wp-element-button" style="border-width:1px;border-radius:5px;padding-top:15px;padding-right:var(--wp--preset--spacing--60);padding-bottom:15px;padding-left:var(--wp--preset--spacing--60)"><?php esc_html_e('Get Started', 'templategalaxy') ?></a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->

                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
                <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-medium-font-size"><?php esc_html_e('24/7 Supports', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-medium-font-size"><?php esc_html_e('Social Media Management', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-medium-font-size"><?php esc_html_e('content and Seo Strategy', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-medium-font-size"><?php esc_html_e('Brand Identity', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-medium-font-size"><?php esc_html_e('Visual Identity Solutions', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"blockGap":"0"}}} -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"60px","bottom":"60px","left":"60px","right":"60px"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"7px"},"color":{"background":"#11c3b9"}},"className":"blockpage-pricing-box is-style-templategalaxy-boxshadow-hover","layout":{"type":"constrained"}} -->
            <div class="wp-block-group blockpage-pricing-box is-style-templategalaxy-boxshadow-hover has-background" style="border-radius:7px;background-color:#11c3b9;padding-top:60px;padding-right:60px;padding-bottom:60px;padding-left:60px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
                <div class="wp-block-group"><!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"48px","lineHeight":"0.8","fontStyle":"normal","fontWeight":"600"}},"textColor":"background"} -->
                    <h1 class="wp-block-heading has-background-color has-text-color" style="font-size:48px;font-style:normal;font-weight:600;line-height:0.8"><?php esc_html_e('$249', 'templategalaxy') ?></h1>
                    <!-- /wp:heading -->

                    <!-- wp:heading {"level":6,"textColor":"background"} -->
                    <h6 class="wp-block-heading has-background-color has-text-color"><?php esc_html_e('/per year', 'templategalaxy') ?></h6>
                    <!-- /wp:heading -->
                </div>
                <!-- /wp:group -->

                <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"52px"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"background","fontSize":"large"} -->
                <h3 class="wp-block-heading has-background-color has-text-color has-large-font-size" style="margin-top:52px;font-style:normal;font-weight:500"><?php esc_html_e('Business Package', 'templategalaxy') ?></h3>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"textColor":"background"} -->
                <p class="has-background-color has-text-color"><?php esc_html_e('Check out our new font generator and level up your pricing and plans as requirement.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"align":"full","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"42px","bottom":"32px"}}}} -->
                <div class="wp-block-buttons alignfull" style="margin-top:42px;margin-bottom:32px"><!-- wp:button {"textColor":"heading-color","width":100,"style":{"spacing":{"padding":{"left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"15px","bottom":"15px"}},"border":{"width":"1px","color":"#FFFFFF","radius":"5px"},"color":{"background":"#ffffff00"}},"className":"is-style-button-hover-white-bgcolor blockpage-pricing-buttons","fontSize":"medium"} -->
                    <div class="wp-block-button has-custom-width wp-block-button__width-100 has-custom-font-size is-style-button-hover-white-bgcolor blockpage-pricing-buttons has-medium-font-size"><a class="wp-block-button__link has-heading-color-color has-text-color has-background has-border-color wp-element-button" style="border-color:#FFFFFF;border-width:1px;border-radius:5px;background-color:#ffffff00;padding-top:15px;padding-right:var(--wp--preset--spacing--60);padding-bottom:15px;padding-left:var(--wp--preset--spacing--60)"><?php esc_html_e('Get Started', 'templategalaxy') ?></a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->

                <!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
                <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"textColor":"background","fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-background-color has-text-color has-medium-font-size"><?php esc_html_e('24/7 Supports', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"textColor":"background","fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-background-color has-text-color has-medium-font-size"><?php esc_html_e('Social Media Management', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"textColor":"background","fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-background-color has-text-color has-medium-font-size"><?php esc_html_e('Digital Marketing Strategy', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"textColor":"background","fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-background-color has-text-color has-medium-font-size"><?php esc_html_e('Brand Identity', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":6,"textColor":"background","fontSize":"medium"} -->
                        <h6 class="wp-block-heading has-background-color has-text-color has-medium-font-size"><?php esc_html_e('Visual Identity Solutions', 'templategalaxy') ?></h6>
                        <!-- /wp:heading -->
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

<!-- wp:group {"style":{"spacing":{"padding":{"top":"120px","right":"var:preset|spacing|50","bottom":"120px","left":"var:preset|spacing|50"}},"color":{"background":"#e1eeee"}},"layout":{"type":"constrained","contentSize":"1180px","justifyContent":"center"}} -->
<div class="wp-block-group has-background" style="background-color:#e1eeee;padding-top:120px;padding-right:var(--wp--preset--spacing--50);padding-bottom:120px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"bottom","style":{"spacing":{"margin":{"bottom":"60px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-bottom" style="margin-bottom:60px"><!-- wp:column {"verticalAlignment":"bottom","width":"66.66%"} -->
        <div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:66.66%"><!-- wp:heading {"textAlign":"left","level":1,"style":{"spacing":{"margin":{"bottom":"0px"}},"typography":{"lineHeight":"1.4","fontSize":"54px","fontStyle":"normal","fontWeight":"600"}},"textColor":"black"} -->
            <h1 class="wp-block-heading has-text-align-left has-black-color has-text-color" style="margin-bottom:0px;font-size:54px;font-style:normal;font-weight:600;line-height:1.4"><?php esc_html_e('Latest Articles', 'templategalaxy') ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"color":{"text":"#777777"},"typography":{"lineHeight":"1.5"}}} -->
            <p class="has-text-color" style="color:#777777;line-height:1.5"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'templategalaxy') ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"bottom","width":"33.33%"} -->
        <div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:33.33%"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
            <div class="wp-block-group"><!-- wp:buttons -->
                <div class="wp-block-buttons"><!-- wp:button {"textColor":"background","style":{"color":{"background":"#11c3b9"},"spacing":{"padding":{"left":"40px","right":"40px","top":"18px","bottom":"18px"}}},"className":"is-style-templategalaxy-button-hover-black-background","fontSize":"normal"} -->
                    <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-black-background has-normal-font-size"><a class="wp-block-button__link has-background-color has-text-color has-background wp-element-button" style="background-color:#11c3b9;padding-top:18px;padding-right:40px;padding-bottom:18px;padding-left:40px"><?php esc_html_e('View all Posts', 'templategalaxy') ?></a></div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:query {"queryId":29,"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false}} -->
    <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"50px"}},"layout":{"type":"grid","columnCount":3}} -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"var:preset|spacing|20"}},"layout":{"inherit":false}} -->
        <div class="wp-block-group" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:post-featured-image {"isLink":true,"height":"280px","style":{"border":{"radius":"10px"}}} /-->

            <!-- wp:post-terms {"term":"category","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}},"elements":{"link":{"color":{"text":"#11c3b9"},":hover":{"color":{"text":"#0ca59e"}}}}},"className":"is-style-default","fontSize":"normal"} /-->

            <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|black"},":hover":{"color":{"text":"#11c3b9"}}}},"spacing":{"margin":{"bottom":"var:preset|spacing|40","top":"var:preset|spacing|50"}},"typography":{"fontSize":"32px","lineHeight":"1.2","fontStyle":"normal","fontWeight":"500"}},"className":"is-style-default"} /-->

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"bottom":"var:preset|spacing|20"}}},"layout":{"type":"flex","flexWrap":"nowrap"},"fontSize":"x-small"} -->
            <div class="wp-block-group has-x-small-font-size" style="padding-bottom:var(--wp--preset--spacing--20)"><!-- wp:post-date {"style":{"color":{"text":"#a4a4a4"}},"fontSize":"normal"} /-->

                <!-- wp:paragraph -->
                <p>.</p>
                <!-- /wp:paragraph -->

                <!-- wp:post-author-name {"style":{"typography":{"textTransform":"capitalize"},"color":{"text":"#a4a4a4"}},"fontSize":"normal"} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->
    </div>
    <!-- /wp:query -->
</div>
<!-- /wp:group -->