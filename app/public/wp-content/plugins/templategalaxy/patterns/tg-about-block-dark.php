<?php

/**
 * Title: About Block Dark
 * Slug: templategalaxy/tg-about-block-dark
 * Categories: templategalaxy-about
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/about_2.jpg',
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"80px","bottom":"80px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"color":{"background":"#0f0f0f"}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group has-background" style="background-color:#0f0f0f;padding-top:80px;padding-right:var(--wp--preset--spacing--50);padding-bottom:80px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"100px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"54px"}},"textColor":"background"} -->
            <h1 class="wp-block-heading has-background-color has-text-color" style="font-size:54px;font-style:normal;font-weight:600"><?php esc_html_e('Transform Your Business', 'templategalaxy') ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"color":{"text":"#b2b1b1"}}} -->
            <p class="has-text-color" style="color:#b2b1b1"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"margin":{"top":"40px"}}}} -->
            <div class="wp-block-buttons" style="margin-top:40px"><!-- wp:button {"textColor":"background","style":{"color":{"background":"#8573f3"},"spacing":{"padding":{"left":"38px","right":"38px","top":"17px","bottom":"17px"}}},"className":"is-style-templategalaxy-button-hover-neutral-background","fontSize":"medium"} -->
                <div class="wp-block-button has-custom-font-size is-style-templategalaxy-button-hover-neutral-background has-medium-font-size"><a class="wp-block-button__link has-background-color has-text-color has-background wp-element-button" style="background-color:#8573f3;padding-top:17px;padding-right:38px;padding-bottom:17px;padding-left:38px"><?php esc_html_e('Read More', 'templategalaxy') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

            <!-- wp:group {"style":{"border":{"top":{"color":"#202020","width":"1px"}},"spacing":{"padding":{"top":"32px"},"margin":{"top":"40px"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="border-top-color:#202020;border-top-width:1px;margin-top:40px;padding-top:32px"><!-- wp:heading {"level":5,"style":{"typography":{"lineHeight":"1.6"}},"textColor":"background"} -->
                <h5 class="wp-block-heading has-background-color has-text-color" style="line-height:1.6"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.', 'templategalaxy') ?></h5>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":301,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-301" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->