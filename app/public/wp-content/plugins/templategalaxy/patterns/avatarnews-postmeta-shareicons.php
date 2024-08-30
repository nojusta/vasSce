<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Post Meta with Social Shares Icon
         * Slug: templategalaxy/avatarnews-postmeta-shareicons
         * Categories: avatarnews
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"bottom":"0"}},"border":{"bottom":{"width":"0px","style":"none"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group" style="border-bottom-style:none;border-bottom-width:0px;padding-bottom:0"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:post-author-name {"className":"is-style-author-name-with-icon","style":{"typography":{"textTransform":"capitalize"}}} /-->

                <!-- wp:post-date {"className":"is-style-post-date-with-icon"} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"}}},"typography":{"fontStyle":"normal","fontWeight":"400"}},"textColor":"heading-color","fontSize":"normal"} -->
                <h4 class="wp-block-heading has-heading-color-color has-text-color has-link-color has-normal-font-size" style="font-style:normal;font-weight:400"><?php esc_html_e('Share On', 'templategalaxy') ?></h4>
                <!-- /wp:heading -->

                <!-- wp:shortcode {"metadata":{"categories":["tg-blocks"],"patternName":"tg_social_shares","name":"TG BLOCK: Social Shares"}} -->
                [TG_SOCIAL_SHARES]
                <!-- /wp:shortcode -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
