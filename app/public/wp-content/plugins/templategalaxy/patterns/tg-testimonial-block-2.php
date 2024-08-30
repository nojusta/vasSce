<?php

/**
 * Title: Testimonial Block Layout 2
 * Slug: templategalaxy/tg-testimonials-block-2
 * Categories: templategalaxy-testimonial
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_3.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_4.jpg'
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"7rem","bottom":"7rem","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1080px"}} -->
<div class="wp-block-group" style="padding-top:7rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:7rem;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"760px"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"44px","fontStyle":"normal","fontWeight":"500"}},"textColor":"black"} -->
        <h2 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-size:44px;font-style:normal;font-weight:500"><?php esc_html_e('Testimonials', 'templategalaxy') ?></h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#767676"}}} -->
        <p class="has-text-align-center has-text-color" style="color:#767676"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'templategalaxy') ?></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"50px"},"margin":{"top":"60px"}}}} -->
    <div class="wp-block-columns" style="margin-top:60px"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"5px","color":"#ebebeb","width":"1px"},"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color" style="border-color:#ebebeb;border-width:1px;border-radius:5px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":239,"width":"undefinedpx","height":"60px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-239" style="border-radius:50px;width:undefinedpx;height:60px" /></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"7px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                        <h4 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('George Gerrat', 'templategalacy') ?></h4>
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
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"color":"#ebebeb","width":"1px"},"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color" style="border-color:#ebebeb;border-width:1px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":241,"width":"undefinedpx","height":"60px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-241" style="border-radius:50px;width:undefinedpx;height:60px" /></figure>
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

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"50px"},"margin":{"top":"50px"}}}} -->
    <div class="wp-block-columns" style="margin-top:50px"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"5px","color":"#ebebeb","width":"1px"},"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color" style="border-color:#ebebeb;border-width:1px;border-radius:5px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":239,"width":"undefinedpx","height":"60px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-239" style="border-radius:50px;width:undefinedpx;height:60px" /></figure>
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
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"color":"#ebebeb","width":"1px"},"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-border-color" style="border-color:#ebebeb;border-width:1px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"36px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group" style="margin-top:36px"><!-- wp:image {"id":241,"width":"undefinedpx","height":"60px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50px"}}} -->
                    <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[3]) ?>" alt="" class="wp-image-241" style="border-radius:50px;width:undefinedpx;height:60px" /></figure>
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