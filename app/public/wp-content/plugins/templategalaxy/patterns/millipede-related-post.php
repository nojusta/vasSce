<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: Related Posts
         * Slug: templategalaxy/millipede-related-post
         * Categories: millipede
         */
?>
        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group"><!-- wp:heading {"level":3} -->
            <h3 class="wp-block-heading"><?php esc_html_e('Related Posts', 'templategalaxy') ?></h3>
            <!-- /wp:heading -->

            <!-- wp:shortcode -->
            [TG_RELATED_POSTS]
            <!-- /wp:shortcode -->
        </div>
        <!-- /wp:group -->
<?php }
}
