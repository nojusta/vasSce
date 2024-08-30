<?php

/**
 * Title: Header with Hero Section
 * Slug: templategalaxy/tg-header-with-hero
 * Categories: templategalaxy-header, templategalaxy-banner
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/banner_image.jpg',
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