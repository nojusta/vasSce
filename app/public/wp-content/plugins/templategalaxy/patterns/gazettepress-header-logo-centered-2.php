<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Header Logo Centered Style 2
         * Slug: templategalaxy/gazettepress-header-logo-centered-2
         * Categories: gazettepress
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/header_bg.jpg',
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}},"border":{"bottom":{"width":"0px","style":"none"}}},"className":"gazettepress-header","layout":{"type":"constrained","contentSize":"100%"}} -->
        <div class="wp-block-group gazettepress-header" style="border-bottom-style:none;border-bottom-width:0px;padding-right:0;padding-left:0"><!-- wp:cover {"url":"<?php echo esc_url($tg_patterns_images[0]) ?>","id":1620,"dimRatio":70,"overlayColor":"dark-shade","focalPoint":{"x":0.65,"y":0.1},"minHeight":240,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
            <div class="wp-block-cover" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:240px"><span aria-hidden="true" class="wp-block-cover__background has-dark-shade-background-color has-background-dim-70 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-1620" alt="" src="<?php echo esc_url($tg_patterns_images[0]) ?>" style="object-position:65% 10%" data-object-fit="cover" data-object-position="65% 10%" />
                <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50","top":"20px","bottom":"20px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1300px"}} -->
                    <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:20px;padding-right:var(--wp--preset--spacing--50);padding-bottom:20px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                        <div class="wp-block-group"><!-- wp:site-logo {"width":350} /--></div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:group -->
                </div>
            </div>
            <!-- /wp:cover -->

            <!-- wp:group {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"2px","bottom":"2px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"dark-shade","textColor":"light-color","className":"gazettepress-simple-nav","layout":{"type":"constrained","contentSize":"1300px"}} -->
            <div class="wp-block-group gazettepress-simple-nav has-light-color-color has-dark-shade-background-color has-text-color has-background has-link-color" style="margin-top:0;margin-bottom:0;padding-top:2px;padding-right:var(--wp--preset--spacing--50);padding-bottom:2px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"padding":{"right":"0","left":"0"}}}} -->
                <div class="wp-block-columns are-vertically-aligned-center" style="padding-right:0;padding-left:0"><!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:social-links {"iconColor":"light-color","iconColorValue":"#ffffff","iconBackgroundColorValue":"#ffffff00","style":{"spacing":{"blockGap":{"left":"6px"}},"layout":{"selfStretch":"fixed","flexSize":"227px"}},"className":"is-style-social-icon-size-small","layout":{"type":"flex","justifyContent":"left"}} -->
                        <ul class="wp-block-social-links has-icon-color has-icon-background-color is-style-social-icon-size-small"><!-- wp:social-link {"url":"#","service":"facebook"} /-->

                            <!-- wp:social-link {"url":"#","service":"x"} /-->

                            <!-- wp:social-link {"url":"#","service":"pinterest"} /-->

                            <!-- wp:social-link {"url":"#","service":"instagram"} /-->

                            <!-- wp:social-link {"url":"#","service":"lastfm"} /-->
                        </ul>
                        <!-- /wp:social-links -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:navigation {"ref":1488,"textColor":"light-shade","overlayBackgroundColor":"primary","overlayTextColor":"light-color","className":"gazettepress-navigation","layout":{"type":"flex","justifyContent":"center"},"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"500","fontSize":"16px"},"spacing":{"blockGap":"var:preset|spacing|50"}}} /--></div>
                    <!-- /wp:column -->

                    <!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:search {"label":"Search","showLabel":false,"width":300,"buttonText":"Search","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true,"align":"right","style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"border":{"radius":"60px"}},"backgroundColor":"transparent","textColor":"light-color"} /--></div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php }
}
