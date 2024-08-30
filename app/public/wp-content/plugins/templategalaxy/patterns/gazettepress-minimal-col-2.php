<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Minimal grid columns 2
         * Slug: templategalaxy/gazettepress-minimal-col-2
         * Categories: gazettepress
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/icon_meta_user.png',
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/icon_meta_date.png',
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"1300px"}} -->
        <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"15px","bottom":"30px","left":"15px","right":"15px"}}},"backgroundColor":"background-alt","layout":{"type":"constrained","contentSize":"1300px"}} -->
            <div class="wp-block-group has-background-alt-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:15px;padding-right:15px;padding-bottom:30px;padding-left:15px"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border-color","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border-color);border-bottom-width:1px"><!-- wp:heading {"level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"},"margin":{"bottom":"2px"}}},"backgroundColor":"primary","textColor":"light-color","className":"gazettepress-section-header","fontSize":"medium"} -->
                    <h4 class="wp-block-heading gazettepress-section-header has-light-color-color has-primary-background-color has-text-color has-background has-link-color has-medium-font-size" style="margin-bottom:2px;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px"><?php esc_html_e('Must Read Articles', 'templategalaxy') ?></h4>
                    <!-- /wp:heading -->

                    <!-- wp:buttons -->
                    <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"transparent","textColor":"foreground","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"spacing":{"padding":{"left":"0px","right":"0px","top":"0","bottom":"0"}}},"className":"gazettepress-all-btns is-style-button-hover-primary-color","fontSize":"normal"} -->
                        <div class="wp-block-button has-custom-font-size gazettepress-all-btns is-style-button-hover-primary-color has-normal-font-size"><a class="wp-block-button__link has-foreground-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="padding-top:0;padding-right:0px;padding-bottom:0;padding-left:0px"><?php esc_html_e('View All', 'templategalaxy') ?></a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"15px","bottom":"15px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
                <div class="wp-block-group" style="margin-top:15px;margin-bottom:15px"><!-- wp:query {"queryId":54,"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
                    <div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"15px"}},"layout":{"type":"grid","columnCount":2}} -->
                        <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"15px"},"margin":{"top":"0","bottom":"0"},"padding":{"top":"15px","bottom":"15px","left":"15px","right":"15px"}},"border":{"width":"1px"}},"borderColor":"border-color"} -->
                        <div class="wp-block-columns are-vertically-aligned-center has-border-color has-border-color-border-color" style="border-width:1px;margin-top:0;margin-bottom:0;padding-top:15px;padding-right:15px;padding-bottom:15px;padding-left:15px"><!-- wp:column {"verticalAlignment":"center","width":"75%","style":{"spacing":{"blockGap":"5px"}}} -->
                            <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:75%"><!-- wp:post-terms {"term":"category","className":"is-style-categories-background-with-round"} /-->

                                <!-- wp:post-title {"level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"typography":{"lineHeight":"1.4"}},"fontSize":"normal"} /-->

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

                            <!-- wp:column {"verticalAlignment":"center","width":"120px"} -->
                            <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:120px"><!-- wp:post-featured-image {"isLink":true,"height":"100px"} /--></div>
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
        <!-- /wp:group -->
<?php }
}
