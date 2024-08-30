<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Related Posts
         * Slug: templategalaxy/gazettepress-related-post
         * Categories: gazettepress
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"15px","bottom":"15px","left":"15px","right":"15px"}}},"backgroundColor":"background-alt","className":"gazettepress-related-post","layout":{"type":"constrained","contentSize":"1300px"}} -->
        <div class="wp-block-group gazettepress-related-post has-background-alt-background-color has-background" style="padding-top:15px;padding-right:15px;padding-bottom:15px;padding-left:15px"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|background","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
            <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--background);border-bottom-width:1px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"},"margin":{"bottom":"2px"}}},"backgroundColor":"primary","textColor":"light-color","className":"gazettepress-section-header","fontSize":"medium"} -->
                <h4 class="wp-block-heading gazettepress-section-header has-light-color-color has-primary-background-color has-text-color has-background has-link-color has-medium-font-size" style="margin-bottom:2px;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px"><?php esc_html_e('Related Posts', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:group -->

            <!-- wp:shortcode -->
            [TG_RELATED_POSTS]
            <!-- /wp:shortcode -->
        </div>
        <!-- /wp:group -->
<?php }
}
