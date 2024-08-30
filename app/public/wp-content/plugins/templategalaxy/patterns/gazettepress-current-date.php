<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Current Date
         * Slug: templategalaxy/gazettepress-current-date
         * Categories: gazettepress
         */
?>
        <!-- wp:group {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color","className":"gazettepress-current-date is-style-default","layout":{"type":"constrained"},"fontSize":"normal"} -->
        <div class="wp-block-group gazettepress-current-date is-style-default has-light-color-color has-text-color has-link-color has-normal-font-size"><!-- wp:shortcode -->
            [TG_CURRENT_DATE_WITH_DAY]
            <!-- /wp:shortcode -->
        </div>
        <!-- /wp:group -->
<?php }
}
