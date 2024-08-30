<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Multiple Categories Layout
         * Slug: templategalaxy/gazettepress-multiple-categories
         * Categories: gazettepress
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/icon_meta_user.png',
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/icon_meta_date.png',
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50","top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1300px"}} -->
        <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"16px"}}}} -->
            <div class="wp-block-columns"><!-- wp:column -->
                <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"16px","bottom":"16px","left":"16px","right":"16px"}}},"backgroundColor":"background-alt","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-background-alt-background-color has-background" style="padding-top:16px;padding-right:16px;padding-bottom:16px;padding-left:16px"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border-color","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                        <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border-color);border-bottom-width:1px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"},"margin":{"bottom":"2px"}}},"backgroundColor":"primary","textColor":"light-color","className":"gazettepress-section-header","fontSize":"medium"} -->
                            <h4 class="wp-block-heading gazettepress-section-header has-light-color-color has-primary-background-color has-text-color has-background has-link-color has-medium-font-size" style="margin-bottom:2px;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px"><?php esc_html_e('Category 1', 'templategalaxy') ?></h4>
                            <!-- /wp:heading -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"transparent","textColor":"foreground","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"spacing":{"padding":{"left":"0px","right":"0px","top":"0","bottom":"0"}}},"className":"gazettepress-all-btns is-style-button-hover-primary-color","fontSize":"normal"} -->
                                <div class="wp-block-button has-custom-font-size gazettepress-all-btns is-style-button-hover-primary-color has-normal-font-size"><a class="wp-block-button__link has-foreground-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="padding-top:0;padding-right:0px;padding-bottom:0;padding-left:0px"><?php esc_html_e('View All', 'templategalaxy') ?></a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->

                        <!-- wp:query {"queryId":34,"query":{"perPage":"1","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
                        <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"0"}}} -->
                            <!-- wp:post-featured-image {"isLink":true,"align":"wide","style":{"spacing":{"margin":{"bottom":"20px"}}}} /-->

                            <!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                            <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"fontSize":"big"} /-->

                            <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group" style="margin-top:10px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
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

                            <!-- wp:post-excerpt {"excerptLength":23} /-->
                            <!-- /wp:post-template -->
                        </div>
                        <!-- /wp:query -->

                        <!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border-color","width":"1px"}},"spacing":{"padding":{"top":"20px"}}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border-color);border-top-width:1px;padding-top:20px"><!-- wp:query {"queryId":54,"query":{"perPage":"5","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
                            <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"15px"}}} -->
                                <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"15px"},"margin":{"top":"0","bottom":"0"}}}} -->
                                <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"120px"} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:120px"><!-- wp:post-featured-image {"isLink":true,"height":"100px"} /--></div>
                                    <!-- /wp:column -->

                                    <!-- wp:column {"verticalAlignment":"center","width":"75%","style":{"spacing":{"blockGap":"3px"}}} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:75%"><!-- wp:post-terms {"term":"category","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"className":"is-style-categories-background-with-round"} /-->

                                        <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"typography":{"lineHeight":"1.3"}},"fontSize":"normal"} /-->

                                        <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                        <div class="wp-block-group" style="margin-top:10px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                            <div class="wp-block-group"><!-- wp:image {"id":1750,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|meta-tone"}}} -->
                                                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-1750" style="width:auto;height:16px" /></figure>
                                                <!-- /wp:image -->

                                                <!-- wp:post-date {"format":"M j, Y","fontSize":"small"} /-->
                                            </div>
                                            <!-- /wp:group -->
                                        </div>
                                        <!-- /wp:group -->
                                    </div>
                                    <!-- /wp:column -->
                                </div>
                                <!-- /wp:columns -->
                                <!-- /wp:post-template -->
                            </div>
                            <!-- /wp:query -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"16px","bottom":"16px","left":"16px","right":"16px"}}},"backgroundColor":"background-alt","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-background-alt-background-color has-background" style="padding-top:16px;padding-right:16px;padding-bottom:16px;padding-left:16px"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border-color","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                        <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border-color);border-bottom-width:1px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"},"margin":{"bottom":"2px"}}},"backgroundColor":"primary","textColor":"light-color","className":"gazettepress-section-header","fontSize":"medium"} -->
                            <h4 class="wp-block-heading gazettepress-section-header has-light-color-color has-primary-background-color has-text-color has-background has-link-color has-medium-font-size" style="margin-bottom:2px;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px"><?php esc_html_e('Category 2', 'templategalaxy') ?></h4>
                            <!-- /wp:heading -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"transparent","textColor":"foreground","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"spacing":{"padding":{"left":"0px","right":"0px","top":"0","bottom":"0"}}},"className":"gazettepress-all-btns is-style-button-hover-primary-color","fontSize":"normal"} -->
                                <div class="wp-block-button has-custom-font-size gazettepress-all-btns is-style-button-hover-primary-color has-normal-font-size"><a class="wp-block-button__link has-foreground-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="padding-top:0;padding-right:0px;padding-bottom:0;padding-left:0px"><?php esc_html_e('View All', 'templategalaxy') ?></a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->

                        <!-- wp:query {"queryId":34,"query":{"perPage":"1","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
                        <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"0"}}} -->
                            <!-- wp:post-featured-image {"isLink":true,"align":"wide","style":{"spacing":{"margin":{"bottom":"20px"}}}} /-->

                            <!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                            <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"fontSize":"big"} /-->

                            <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group" style="margin-top:10px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
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

                            <!-- wp:post-excerpt {"excerptLength":23} /-->
                            <!-- /wp:post-template -->
                        </div>
                        <!-- /wp:query -->

                        <!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border-color","width":"1px"}},"spacing":{"padding":{"top":"20px"}}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border-color);border-top-width:1px;padding-top:20px"><!-- wp:query {"queryId":54,"query":{"perPage":"5","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
                            <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"15px"}}} -->
                                <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"15px"},"margin":{"top":"0","bottom":"0"}}}} -->
                                <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"120px"} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:120px"><!-- wp:post-featured-image {"isLink":true,"height":"100px"} /--></div>
                                    <!-- /wp:column -->

                                    <!-- wp:column {"verticalAlignment":"center","width":"75%","style":{"spacing":{"blockGap":"3px"}}} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:75%"><!-- wp:post-terms {"term":"category","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"className":"is-style-categories-background-with-round"} /-->

                                        <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"typography":{"lineHeight":"1.3"}},"fontSize":"normal"} /-->

                                        <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                        <div class="wp-block-group" style="margin-top:10px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                            <div class="wp-block-group"><!-- wp:image {"id":1750,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|meta-tone"}}} -->
                                                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-1750" style="width:auto;height:16px" /></figure>
                                                <!-- /wp:image -->

                                                <!-- wp:post-date {"format":"M j, Y","fontSize":"small"} /-->
                                            </div>
                                            <!-- /wp:group -->
                                        </div>
                                        <!-- /wp:group -->
                                    </div>
                                    <!-- /wp:column -->
                                </div>
                                <!-- /wp:columns -->
                                <!-- /wp:post-template -->
                            </div>
                            <!-- /wp:query -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"16px","bottom":"16px","left":"16px","right":"16px"}}},"backgroundColor":"background-alt","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group has-background-alt-background-color has-background" style="padding-top:16px;padding-right:16px;padding-bottom:16px;padding-left:16px"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border-color","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                        <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border-color);border-bottom-width:1px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"},"margin":{"bottom":"2px"}}},"backgroundColor":"primary","textColor":"light-color","className":"gazettepress-section-header","fontSize":"medium"} -->
                            <h4 class="wp-block-heading gazettepress-section-header has-light-color-color has-primary-background-color has-text-color has-background has-link-color has-medium-font-size" style="margin-bottom:2px;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px"><?php esc_html_e('Category 3', 'templategalaxy') ?></h4>
                            <!-- /wp:heading -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"transparent","textColor":"foreground","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"spacing":{"padding":{"left":"0px","right":"0px","top":"0","bottom":"0"}}},"className":"gazettepress-all-btns is-style-button-hover-primary-color","fontSize":"normal"} -->
                                <div class="wp-block-button has-custom-font-size gazettepress-all-btns is-style-button-hover-primary-color has-normal-font-size"><a class="wp-block-button__link has-foreground-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="padding-top:0;padding-right:0px;padding-bottom:0;padding-left:0px"><?php esc_html_e('View All', 'templategalaxy') ?></a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->

                        <!-- wp:query {"queryId":34,"query":{"perPage":"1","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
                        <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"0"}}} -->
                            <!-- wp:post-featured-image {"isLink":true,"align":"wide","style":{"spacing":{"margin":{"bottom":"20px"}}}} /-->

                            <!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                            <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"fontSize":"big"} /-->

                            <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                            <div class="wp-block-group" style="margin-top:10px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
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

                            <!-- wp:post-excerpt {"excerptLength":23} /-->
                            <!-- /wp:post-template -->
                        </div>
                        <!-- /wp:query -->

                        <!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border-color","width":"1px"}},"spacing":{"padding":{"top":"20px"}}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border-color);border-top-width:1px;padding-top:20px"><!-- wp:query {"queryId":54,"query":{"perPage":"5","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
                            <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"15px"}}} -->
                                <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"15px"},"margin":{"top":"0","bottom":"0"}}}} -->
                                <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"120px"} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:120px"><!-- wp:post-featured-image {"isLink":true,"height":"100px"} /--></div>
                                    <!-- /wp:column -->

                                    <!-- wp:column {"verticalAlignment":"center","width":"75%","style":{"spacing":{"blockGap":"3px"}}} -->
                                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:75%"><!-- wp:post-terms {"term":"category","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"className":"is-style-categories-background-with-round"} /-->

                                        <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"typography":{"lineHeight":"1.3"}},"fontSize":"normal"} /-->

                                        <!-- wp:group {"style":{"spacing":{"margin":{"top":"10px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                        <div class="wp-block-group" style="margin-top:10px"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                            <div class="wp-block-group"><!-- wp:image {"id":1750,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|meta-tone"}}} -->
                                                <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-1750" style="width:auto;height:16px" /></figure>
                                                <!-- /wp:image -->

                                                <!-- wp:post-date {"format":"M j, Y","fontSize":"small"} /-->
                                            </div>
                                            <!-- /wp:group -->
                                        </div>
                                        <!-- /wp:group -->
                                    </div>
                                    <!-- /wp:column -->
                                </div>
                                <!-- /wp:columns -->
                                <!-- /wp:post-template -->
                            </div>
                            <!-- /wp:query -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->
        </div>
        <!-- /wp:group -->
<?php }
}
