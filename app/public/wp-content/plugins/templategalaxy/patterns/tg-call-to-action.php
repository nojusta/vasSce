<?php

/**
 * Title: Call to Action
 * Slug: templategalaxy/tg-call-to-action
 * Categories: templategalaxy-cta
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/cta_bg.jpg',
);
?>
<!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[0]) ?>","id":227,"dimRatio":50,"minHeight":560,"isDark":false,"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="min-height:560px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-227" alt="" src="<?php echo esc_url($tg_patterns_images[0]) ?>" data-object-fit="cover" />
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