<?php

/**
 * Title: About Block 01
 * Slug: templategalaxy/tg-about-block-one
 * Categories: templategalaxy-about
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/about_1.jpg',
);
?>
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
            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-220" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->