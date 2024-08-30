<?php

/**
 * Title: Testimonial Block Signle Review
 * Slug: templategalaxy/tg-testimonial-single
 * Categories: templategalaxy-testimonial
 */
$tg_patterns_images = array(
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/testimonial_2.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/about_1.jpg',
    TEMPLATEGALAXY_URL . 'assets/images/patterns-assets/reviews_star.jpg',
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"100px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":430,"sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":["#F39446","#f97d17"]}}} -->
            <figure class="wp-block-image size-full"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-430" /></figure>
            <!-- /wp:image -->

            <!-- wp:paragraph {"style":{"color":{"text":"#767575"}},"fontSize":"large"} -->
            <p class="has-text-color has-large-font-size" style="color:#767575"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'templategalaxy') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"style":{"spacing":{"margin":{"top":"42px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group" style="margin-top:42px"><!-- wp:image {"id":241,"width":"60px","height":"60px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"width":"0px","style":"none","radius":"60px"}}} -->
                <figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-241" style="border-style:none;border-width:0px;border-radius:60px;object-fit:cover;width:60px;height:60px" /></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                <div class="wp-block-group"><!-- wp:heading {"level":5,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} -->
                    <h5 class="wp-block-heading" style="font-style:normal;font-weight:500"><?php esc_html_e('Loya Mersal', 'templategalaxy') ?></h5>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"style":{"color":{"text":"#929090"}}} -->
                    <p class="has-text-color" style="color:#929090"><?php esc_html_e('Author', 'templategalaxy') ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":445,"width":"750px","aspectRatio":"1","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->
            <figure class="wp-block-image size-large is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-445" style="aspect-ratio:1;object-fit:cover;width:750px" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->