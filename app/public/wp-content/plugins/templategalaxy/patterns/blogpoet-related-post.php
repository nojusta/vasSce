<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Related Post
         * Slug: templategalaxy/blogpoet-related-post
         * Categories: blogpoet
         */
?>
        <!-- wp:group {"style":{"spacing":{"margin":{"top":"30px"}}},"className":"blogpoet-related-posts","layout":{"type":"constrained"}} -->
        <div class="wp-block-group blogpoet-related-posts" style="margin-top:30px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"10px","bottom":"10px"}},"border":{"top":{"color":"var:preset|color|dark-color","width":"1px"},"right":{},"bottom":{"color":"var:preset|color|dark-color","width":"1px"},"left":{}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"},"fontSize":"big"} -->
            <div class="wp-block-group has-big-font-size" style="border-top-color:var(--wp--preset--color--dark-color);border-top-width:1px;border-bottom-color:var(--wp--preset--color--dark-color);border-bottom-width:1px;padding-top:10px;padding-bottom:10px"><!-- wp:heading {"textAlign":"center"} -->
                <h2 class="wp-block-heading has-text-align-center"><?php esc_html_e('Related Posts', 'blogpoet') ?></h2>
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
