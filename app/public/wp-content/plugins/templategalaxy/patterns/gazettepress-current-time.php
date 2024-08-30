<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Current Time
         * Slug: templategalaxy/gazettepress-current-time
         * Categories: gazettepress
         */
?>
        <!-- wp:group {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"2px","bottom":"2px","left":"7px","right":"7px"}}},"backgroundColor":"primary","textColor":"light-color","className":"gazettepress-current-time is-style-default","layout":{"type":"constrained"},"fontSize":"normal"} -->
        <div class="wp-block-group gazettepress-current-time is-style-default has-light-color-color has-primary-background-color has-text-color has-background has-link-color has-normal-font-size" style="padding-top:2px;padding-right:7px;padding-bottom:2px;padding-left:7px"><!-- wp:shortcode -->
            [TG_CURRENT_TIME]
            <!-- /wp:shortcode -->
        </div>
        <!-- /wp:group -->
<?php }
}
