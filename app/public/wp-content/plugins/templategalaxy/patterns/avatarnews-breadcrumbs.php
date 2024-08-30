<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Breadcrumbs
         * Slug: templategalaxy/avatarnews-breadcrumbs
         * Categories: avatarnews
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"16px","bottom":"16px","left":"24px","right":"24px"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"100%"}} -->
        <div class="wp-block-group has-light-color-background-color has-background" style="padding-top:16px;padding-right:24px;padding-bottom:16px;padding-left:24px"><!-- wp:shortcode {"metadata":{"categories":["tg-blocks"],"patternName":"tg_breadcrumbs","name":"TG BLOCK: Breadcrumbs"}} -->
            [TG_BREADCRUMBS]
            <!-- /wp:shortcode -->
        </div>
        <!-- /wp:group -->
<?php }
}
