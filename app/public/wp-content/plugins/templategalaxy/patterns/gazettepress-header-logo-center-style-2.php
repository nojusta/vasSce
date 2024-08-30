<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Header with logo center style 2
         * Slug: templategalaxy/gazettepress-header-logo-center-style-2
         * Categories: gazettepress
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/gazettepress-assets/flash_icon.png',
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}},"border":{"bottom":{"width":"0px","style":"none"}}},"className":"gazettepress-header","layout":{"type":"constrained","contentSize":"100%"}} -->
        <div class="wp-block-group gazettepress-header" style="border-bottom-style:none;border-bottom-width:0px;padding-right:0;padding-left:0"><!-- wp:group {"style":{"dimensions":{"minHeight":""},"spacing":{"padding":{"top":"10px","bottom":"10px"}}},"backgroundColor":"dark-color","layout":{"type":"constrained","contentSize":"1300px"}} -->
            <div class="wp-block-group has-dark-color-background-color has-background" style="padding-top:10px;padding-bottom:10px"><!-- wp:columns {"verticalAlignment":"center"} -->
                <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"0"}}}} -->
                        <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"190px"} -->
                            <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:190px"><!-- wp:group {"style":{"spacing":{"blockGap":"13px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                                <div class="wp-block-group"><!-- wp:image {"id":1449,"width":"auto","height":"16px","sizeSlug":"full","linkDestination":"none","className":"gazettepress-flash-icon"} -->
                                    <figure class="wp-block-image size-full is-resized gazettepress-flash-icon"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-1449" style="width:auto;height:16px" /></figure>
                                    <!-- /wp:image -->

                                    <!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"light-color","className":"gazettepress-flashnews-heading","fontSize":"small","fontFamily":"public-sans"} -->
                                    <h3 class="wp-block-heading gazettepress-flashnews-heading has-light-color-color has-text-color has-link-color has-public-sans-font-family has-small-font-size" style="font-style:normal;font-weight:500"><?php esc_html_e('Breaking News', 'templategalaxy') ?></h3>
                                    <!-- /wp:heading -->
                                </div>
                                <!-- /wp:group -->
                            </div>
                            <!-- /wp:column -->

                            <!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
                            <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"30px"}}},"className":"gazettepress-header-ticker","layout":{"type":"constrained"}} -->
                                <div class="wp-block-group gazettepress-header-ticker" style="padding-top:0;padding-bottom:0;padding-left:30px"><!-- wp:query {"queryId":12,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"gazettepress-ticker"} -->
                                    <div class="wp-block-query gazettepress-ticker"><!-- wp:post-template {"className":"gazettepress-swiper-holder swiper-wrapper","layout":{"type":"default"}} -->
                                        <!-- wp:post-title {"textAlign":"left","level":4,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-alt"},":hover":{"color":{"text":"var:preset|color|secondary"}}}},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"typography":{"fontStyle":"normal","fontWeight":"400"}},"backgroundColor":"dark-color","fontSize":"small","fontFamily":"public-sans"} /-->
                                        <!-- /wp:post-template -->

                                        <!-- wp:group {"lock":{"move":true,"remove":true},"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"className":"gazettepress-hticker-controls","layout":{"type":"constrained"}} -->
                                        <div id="ticker-controls" class="wp-block-group gazettepress-hticker-controls" style="margin-top:0;margin-bottom:0"><!-- wp:html -->
                                            <div class="swiper-button-prev gazettepress-ticker-prev"></div>
                                            <div class="swiper-button-next gazettepress-ticker-next"></div>
                                            <!-- /wp:html -->
                                        </div>
                                        <!-- /wp:group -->
                                    </div>
                                    <!-- /wp:query -->
                                </div>
                                <!-- /wp:group -->
                            </div>
                            <!-- /wp:column -->
                        </div>
                        <!-- /wp:columns -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"verticalAlignment":"center","width":"33.33%"} -->
                    <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
                        <div class="wp-block-group"><!-- wp:list {"style":{"spacing":{"padding":{"right":"0","left":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-alt"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"textColor":"foreground-alt","className":"is-style-list-style-no-bullet","fontSize":"small"} -->
                            <ul style="padding-right:0;padding-left:0" class="is-style-list-style-no-bullet has-foreground-alt-color has-text-color has-link-color has-small-font-size"><!-- wp:list-item -->
                                <li><a href="#"><?php esc_html_e('Home', 'templategalaxy') ?></a></li>
                                <!-- /wp:list-item -->
                            </ul>
                            <!-- /wp:list -->

                            <!-- wp:list {"style":{"spacing":{"padding":{"right":"0","left":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-alt"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"textColor":"foreground-alt","className":"is-style-list-style-no-bullet","fontSize":"small"} -->
                            <ul style="padding-right:0;padding-left:0" class="is-style-list-style-no-bullet has-foreground-alt-color has-text-color has-link-color has-small-font-size"><!-- wp:list-item -->
                                <li><a href="#"><?php esc_html_e('Advertisement', 'templategalaxy') ?></a></li>
                                <!-- /wp:list-item -->
                            </ul>
                            <!-- /wp:list -->

                            <!-- wp:list {"style":{"spacing":{"padding":{"right":"0","left":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-alt"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}},"textColor":"foreground-alt","className":"is-style-list-style-no-bullet","fontSize":"small"} -->
                            <ul style="padding-right:0;padding-left:0" class="is-style-list-style-no-bullet has-foreground-alt-color has-text-color has-link-color has-small-font-size"><!-- wp:list-item -->
                                <li><a href="#"><?php esc_html_e('Contact Us', 'templategalaxy') ?></a></li>
                                <!-- /wp:list-item -->
                            </ul>
                            <!-- /wp:list -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"1300px"}} -->
            <div class="wp-block-group has-light-color-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:24px;padding-right:var(--wp--preset--spacing--30);padding-bottom:24px;padding-left:var(--wp--preset--spacing--30)"><!-- wp:columns {"verticalAlignment":"center"} -->
                <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
                    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:social-links {"iconColor":"foreground","iconColorValue":"#47474b","iconBackgroundColor":"border-color","iconBackgroundColorValue":"#E4EBF1","style":{"spacing":{"blockGap":{"left":"6px"}},"layout":{"selfStretch":"fixed","flexSize":"227px"}},"className":"is-style-social-icon-size-small","layout":{"type":"flex","justifyContent":"left"}} -->
                        <ul class="wp-block-social-links has-icon-color has-icon-background-color is-style-social-icon-size-small"><!-- wp:social-link {"url":"#","service":"facebook"} /-->

                            <!-- wp:social-link {"url":"#","service":"x"} /-->

                            <!-- wp:social-link {"url":"#","service":"pinterest"} /-->

                            <!-- wp:social-link {"url":"#","service":"instagram"} /-->

                            <!-- wp:social-link {"url":"#","service":"lastfm"} /-->
                        </ul>
                        <!-- /wp:social-links -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"verticalAlignment":"center"} -->
                    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:site-title {"textAlign":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"},":hover":{"color":{"text":"var:preset|color|secondary"}}}}}} /--></div>
                    <!-- /wp:column -->

                    <!-- wp:column {"verticalAlignment":"center"} -->
                    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
                        <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"dark-color","textColor":"foreground-alt","style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"border":{"radius":"0px","width":"0px","style":"none"},"spacing":{"padding":{"left":"24px","right":"24px","top":"10px","bottom":"10px"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-alt"}}}},"className":"is-style-button-hover-secondary-bgcolor","fontSize":"normal"} -->
                            <div class="wp-block-button has-custom-font-size is-style-button-hover-secondary-bgcolor has-normal-font-size" style="font-style:normal;font-weight:500"><a class="wp-block-button__link has-foreground-alt-color has-dark-color-background-color has-text-color has-background has-link-color wp-element-button" style="border-style:none;border-width:0px;border-radius:0px;padding-top:10px;padding-right:24px;padding-bottom:10px;padding-left:24px"><?php esc_html_e('Subscribe', 'templategalaxy') ?></a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|foreground-alt","width":"1px"},"bottom":{"color":"var:preset|color|foreground-alt","width":"1px"}}},"backgroundColor":"light-color","textColor":"light-color","layout":{"type":"constrained","contentSize":"1300px"}} -->
            <div class="wp-block-group has-light-color-color has-light-color-background-color has-text-color has-background has-link-color" style="border-top-color:var(--wp--preset--color--foreground-alt);border-top-width:1px;border-bottom-color:var(--wp--preset--color--foreground-alt);border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:0px;padding-right:var(--wp--preset--spacing--50);padding-bottom:0px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
                <div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:navigation {"ref":1488,"textColor":"heading-color","overlayBackgroundColor":"primary","overlayTextColor":"light-color","className":"gazettepress-navigation","layout":{"type":"flex","justifyContent":"center"},"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"500","fontSize":"16px"},"spacing":{"blockGap":"var:preset|spacing|50"}}} /-->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
                    <div class="wp-block-group"><!-- wp:search {"label":"Search","showLabel":false,"widthUnit":"%","buttonText":"Search","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true,"style":{"border":{"radius":"50px","width":"0px","style":"none"},"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}}},"backgroundColor":"transparent","textColor":"foreground","className":"gazettepress-nav-search"} /--></div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
<?php  }
}
