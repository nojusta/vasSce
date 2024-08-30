<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Single Post Title with Social Media and Breadcrumbs
         * Slug: templategalaxy/gazettepress-single-title-icons
         * Categories: gazettepress
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/icon_meta_user.png',
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/icon_meta_date.png',
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"className":"gazettepress-breadcrumbs","layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group gazettepress-breadcrumbs" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:shortcode -->
            [TG_BREADCRUMBS]
            <!-- /wp:shortcode -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"0"}}},"backgroundColor":"nutral","layout":{"type":"constrained","contentSize":"1300px"}} -->
        <div class="wp-block-group has-nutral-background-color has-background" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:post-title {"textAlign":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"fontSize":"xx-large"} /-->

            <!-- wp:group {"style":{"spacing":{"margin":{"top":"24px"},"padding":{"top":"24px"}},"border":{"top":{"color":"var:preset|color|border-color","width":"1px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border-color);border-top-width:1px;margin-top:24px;padding-top:24px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:image {"id":1754,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|meta-tone"}}} -->
                        <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-1754" style="width:auto;height:16px" /></figure>
                        <!-- /wp:image -->

                        <!-- wp:post-author-name {"style":{"typography":{"textTransform":"capitalize"}}} /-->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group"><!-- wp:image {"id":1750,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|meta-tone"}}} -->
                        <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-1750" style="width:auto;height:16px" /></figure>
                        <!-- /wp:image -->

                        <!-- wp:post-date {"format":"M j, Y","fontSize":"small"} /-->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group"><!-- wp:paragraph -->
                    <p>Share on</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
                    <div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:shortcode -->
                        [TG_SOCIAL_SHARES]
                        <!-- /wp:shortcode -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
