<?php

/**
 * Title: Team Block with description
 * Slug: templategalaxy/tg-team-with-details
 * Categories: templategalaxy-team
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/team_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/team_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/team_3.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_4.jpg'
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"7rem","bottom":"7rem","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="padding-top:7rem;padding-right:var(--wp--preset--spacing--50);padding-bottom:7rem;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"660px"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"500","textTransform":"uppercase"}},"textColor":"black"} -->
        <h2 class="wp-block-heading has-text-align-center has-black-color has-text-color" style="font-size:14px;font-style:normal;font-weight:500;text-transform:uppercase"><?php esc_html_e('Meet The Team', 'templategalaxy') ?></h2>
        <!-- /wp:heading -->

        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"black","fontSize":"xxx-large"} -->
        <h1 class="wp-block-heading has-text-align-center has-black-color has-text-color has-xxx-large-font-size" style="font-style:normal;font-weight:600"><?php esc_html_e('Meet the people who make our agency success', 'templategalaxy') ?></h1>
        <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"80px"},"margin":{"top":"80px"}}}} -->
    <div class="wp-block-columns" style="margin-top:80px"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"0px","width":"0px","style":"none"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="border-style:none;border-width:0px;border-radius:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:image {"align":"center","id":278,"width":"150px","height":"150px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%"}}} -->
                <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-278" style="border-radius:50%;object-fit:cover;width:150px;height:150px" /></figure>
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
                <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-283" style="border-radius:50%;object-fit:cover;width:150px;height:150px" /></figure>
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
                <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-284" style="border-radius:50%;object-fit:cover;width:150px;height:150px" /></figure>
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

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"80px"},"margin":{"top":"80px"}}}} -->
    <div class="wp-block-columns" style="margin-top:80px"><!-- wp:column -->
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
</div>
<!-- /wp:group -->