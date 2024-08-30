<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Grid With Featured Post
         * Slug: templategalaxy/avatarnews-featured-grid
         * Categories: avatarnews
         */
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"24px","bottom":"24px"}}},"layout":{"type":"constrained","contentSize":"1240px"}} -->
        <div class="wp-block-group" style="padding-top:24px;padding-right:var(--wp--preset--spacing--40);padding-bottom:24px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"100%"}} -->
            <div class="wp-block-group has-light-color-background-color has-background" style="padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
                <div class="wp-block-group"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|primary","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--primary);border-bottom-width:1px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"10px","bottom":"10px","left":"16px","right":"16px"}}},"backgroundColor":"primary","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group has-primary-background-color has-background" style="padding-top:10px;padding-right:16px;padding-bottom:10px;padding-left:16px"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"500"}},"textColor":"light-color"} -->
                            <h2 class="wp-block-heading has-light-color-color has-text-color has-link-color" style="font-size:24px;font-style:normal;font-weight:500"><?php esc_html_e('Featured Grid Layout 1', 'templategalaxy') ?></h2>
                            <!-- /wp:heading -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

                <!-- wp:columns -->
                <div class="wp-block-columns"><!-- wp:column -->
                    <div class="wp-block-column"><!-- wp:query {"queryId":6,"query":{"perPage":"1","pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false}} -->
                        <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"20px"}},"layout":{"type":"default","columnCount":"3"}} -->
                            <!-- wp:post-featured-image {"isLink":true,"height":"450px"} /-->

                            <!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                            <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"bottom":"12px"}},"typography":{"fontSize":"36px","lineHeight":"1.2"}}} /-->

                            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group"><!-- wp:post-author-name {"className":"is-style-author-name-with-icon","style":{"elements":{"link":{"color":{"text":"var:preset|color|meta-color"}}},"typography":{"textTransform":"capitalize"}},"textColor":"meta-color"} /-->

                                <!-- wp:post-date {"format":"M j, Y","className":"is-style-post-date-with-icon","style":{"elements":{"link":{"color":{"text":"var:preset|color|meta-color"}}}},"textColor":"meta-color"} /-->
                            </div>
                            <!-- /wp:group -->

                            <!-- wp:post-excerpt {"excerptLength":37} /-->
                            <!-- /wp:post-template -->

                            <!-- wp:query-no-results -->
                            <!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
                            <p></p>
                            <!-- /wp:paragraph -->
                            <!-- /wp:query-no-results -->
                        </div>
                        <!-- /wp:query -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column"><!-- wp:query {"queryId":6,"query":{"perPage":"4","pages":0,"offset":"1","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false}} -->
                        <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"20px"}},"layout":{"type":"grid","columnCount":"2"}} -->
                            <!-- wp:post-featured-image {"isLink":true,"height":"240px"} /-->

                            <!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                            <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"fontSize":"20px"},"spacing":{"margin":{"bottom":"12px"}}}} /-->

                            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group"><!-- wp:post-author-name {"className":"is-style-author-name-with-icon","style":{"elements":{"link":{"color":{"text":"var:preset|color|meta-color"}}},"typography":{"textTransform":"capitalize"}},"textColor":"meta-color"} /-->

                                <!-- wp:post-date {"format":"M j, Y","className":"is-style-post-date-with-icon","style":{"elements":{"link":{"color":{"text":"var:preset|color|meta-color"}}}},"textColor":"meta-color"} /-->
                            </div>
                            <!-- /wp:group -->
                            <!-- /wp:post-template -->

                            <!-- wp:query-no-results -->
                            <!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
                            <p></p>
                            <!-- /wp:paragraph -->
                            <!-- /wp:query-no-results -->
                        </div>
                        <!-- /wp:query -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
