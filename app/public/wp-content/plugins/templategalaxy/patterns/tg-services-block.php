<?php

/**
 * Title: Service Block
 * Slug: templategalaxy/tg-services-block
 * Categories: templategalaxy-services
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/service_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/service_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/service_3.jpg',
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50","top":"60px","bottom":"60px"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="padding-top:60px;padding-right:var(--wp--preset--spacing--50);padding-bottom:60px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"50px"}}}} -->
    <div class="wp-block-columns"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:image {"align":"full","id":206,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image alignfull size-full"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-206" /></figure>
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
                <figure class="wp-block-image alignfull size-full"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-216" /></figure>
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
                <figure class="wp-block-image alignfull size-full"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-217" /></figure>
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