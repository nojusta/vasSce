<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

?>
<div class="wpc-filter-set-advices">
    <ul class="wpc-advices">
        <li>
            <div class="wpc-advice-head">
                <span class="wpc-advice-title">Display filters</span>
                <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                    <span class="toggle-indicator" aria-hidden="true"></span>
                </button>
            </div>
            <div class="wpc-advice-body">
                <p>To display filters please put <br /><strong>Filter Everything — Filters</strong> widget in desired widget area or sidebar.<br />Or use shortcode <code>[fe_widget]</code> to display them anywhere on your site.</p>
                <p><blockquote>
                    <strong>Note:</strong> unlike most of widgets, the Filters widget displays filters only if there is a Filter Set configured for the page you currently see. You can set this page in the <strong>Where to filter?</strong> field<?php
                    if ( ! defined( 'FLRT_FILTERS_PRO' ) ) :
                        ?> if you use the <a href="<?php echo FLRT_PLUGIN_URL; ?>" target="_blank" class="wpc-external-link">PRO version</a> of the plugin. In the current Free version it can be a Post type archive page only<?php
                    endif; ?>.</blockquote></p>
                <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                <ol class="wpc-display-widgets">
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>Multiple Filters widget on a page</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>To display several Filter widgets on a page, you need:<br />
                                - create several Filter Sets and to direct them to the desired page<br />
                                - insert several Filter Widgets or their shortcodes on this page. One widget per Filter Set.</p>
                            <p>You can change the display order of Filter Sets using the Priority field.</p>
                        </div>
                    </li>
                </ol>
                <?php endif; ?>
            </div>
        </li>
        <li>
            <div class="wpc-advice-head">
                <span class="wpc-advice-title">Show selected terms (Chips)</span>
                <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                    <span class="toggle-indicator" aria-hidden="true"></span>
                </button>
            </div>
            <div class="wpc-advice-body">
                <p>Please use <strong>Filter Everything — Chips</strong> widget to display selected terms. Or insert shortcode <code>[fe_chips]</code> in the desired place.</p>
                <h4>Display via hook</h4>
                <p>On WooCommerce product pages Chips are displayed automatically.<br />But you can also add your theme hooks (actions) in <em>Filters -> Settings -> Selected Filters (Chips) integration</em> to display Chips in places where these hooks fire.</p>
            </div>
        </li>
        <li>
            <div class="wpc-advice-head">
                <span class="wpc-advice-title">Use Meta keys</span>
                <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                    <span class="toggle-indicator" aria-hidden="true"></span>
                </button>
            </div>
            <div class="wpc-advice-body">
                <ul>
                    <li><h4><?php esc_html_e( 'WooCommerce', 'filter-everything' ); ?>:</h4></li>
                    <?php
                    printf( '<li><code>_price</code> - %s</li>', esc_html__( 'filter by Product price (Custom Field Numeric)', 'filter-everything' ) );
                    printf( '<li><code>_stock_status</code> - %s</li>', esc_html__( 'filter by Product Stock status (Custom Field)', 'filter-everything' ) );
                    printf( '<li><code>_sale_price</code> - %s</li>', esc_html__( 'by Sale Price (Custom Field Numeric) or on Sale Status (Custom Field Exists)', 'filter-everything' ) );
                    printf( '<li><code>total_sales</code> - %s</li>', esc_html__( 'by Sales Count', 'filter-everything' ) );
                    printf( '<li><code>_backorders</code> - %s</li>', esc_html__( 'by Backorders Status (Custom Field)', 'filter-everything' ) );
                    printf( '<li><code>_downloadable</code> - %s</li>', esc_html__( 'by Downloadable Status (Custom Field)', 'filter-everything' ) );
                    printf( '<li><code>_sold_individually</code> - %s</li>', esc_html__( 'by Sold Individually status (Custom Field)', 'filter-everything' ) );
                    printf( '<li><code>_stock</code> - %s</li>', esc_html__( 'by Stock Quantity (Custom Field Numeric)', 'filter-everything' ) );
                    printf( '<li><code>_virtual</code> - %s</li>', esc_html__( 'by Product Virtual status (Custom Field)', 'filter-everything' ) );
                    printf( '<li><code>_length</code> - %s</li>', esc_html__( 'by product Length', 'filter-everything' ) );
                    printf( '<li><code>_width</code> - %s</li>', esc_html__( 'by product Width', 'filter-everything' ) );
                    printf( '<li><code>_height</code> - %s</li>', esc_html__( 'by product Height', 'filter-everything' ) );
                    printf( '<li><code>_weight</code> - %s</li>', esc_html__( 'by product Weight', 'filter-everything' ) );
                    echo wp_kses (
                        sprintf(
                            __( '<li><code>_wc_average_rating</code> - filter by Product Average Rating. Optionally use <a href="%s" target="_blank" class="wpc-external-link">Product Visibility</a> taxonomy instead</li>', 'filter-everything' ),
                            'https://demo.filtereverything.pro/example/by-rating/'
                        ),
                        array(
                            'a' => array( 'href' => true, 'target' => true, 'class' => true ),
                            'li' => array(),
                            'code' => array(),
                        )
                    );
                    ?>
                    <li><h4><?php esc_html_e( 'WordPress', 'filter-everything' ); ?>:</h4></li>
                    <?php
                    printf( '<li><code>_thumbnail_id</code> - %s</li>', esc_html__( 'filter by Featured Image (Custom Field Exists)', 'filter-everything' ) );
                    ?>
                </ul>
            </div>
        </li>
        <li>
            <div class="wpc-advice-head">
                <span class="wpc-advice-title">Setup on mobile</span>
                <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                    <span class="toggle-indicator" aria-hidden="true"></span>
                </button>
            </div>
            <div class="wpc-advice-body">
                <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                    <p>In most cases, the most convenient option will be to use the Pop-up widget on mobile. Just enable this option in <em>Filters -> Settings -> Enable the Pop-up Filters widget</em>. And on mobile devices will appear the button that opens the Pop-up Filters widget.</p>
                <?php else : ?>
                    <p>In the current Free version of the plugin you can enable the option <strong>Collapse the widget and show the Filters opening button</strong> in <em>Filters -> Settings</em>.<br />The <a href="<?php echo FLRT_PLUGIN_URL; ?>" target="_blank" class="wpc-external-link">PRO version</a> allows you to use a more convenient <strong>Pop-up Filters widget</strong> on mobile.<br />After activating any of these options on mobile devices will appear the button that opens Filters widget.</p>
                <?php endif; ?>
                <h4>Typical issues on mobile</h4>
                <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                <p><strong>Pop-up does not appear after clicking on the button.</strong><br />Usually the reason is that it is placed in a block that becomes hidden on mobile. Please make the block visible on mobile devices, or move the Filters widget to another location that is always visible.</p>
                <?php endif; ?>
                <p><strong><?php
                        if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) :
                        ?>How to display the button that opens the Pop-up?<?php
                        else :
                        ?>How to display the button that opens the Filters widget?<?php
                        endif;
                        ?></strong><br /> Usually on mobile devices it is displayed automatically in popular themes. But if it is displayed where it is not needed, you can disable it in <em>Filters -> Settings -> Experimental -> Hide opening widget buttons</em>. And after insert the button with the shortcode <code>[fe_open_button]</code> in desired places. The button is visible only on mobile devices and is hidden on desktop devices by default.</p>
                <p><strong>How do I change the width of the screen that is considered a mobile screen?</strong><br /> In other words, how to change the mobile device breakpoint? The default value is 768px. However, you can change this value with <a href="https://gist.github.com/wpserve/8982d160b58ecd7a174b90fa0f953e44" target="_blank" class="wpc-external-link">this code example</a>, if you need to display the open button and Pop-up widget for example on desktops. You can place the code in the <code>functions.php</code> file of your active theme.</p>
                <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                <p><strong>The Pop-up widget disappears after selecting a filter.</strong><br /> In 99% of cases, the reason is that as the <strong>HTML id or class of the Posts Container</strong> you specified a block that contains both: the filtered Posts list and the Filters widget.<br />By default, the Filters widget is closed, and when the content on the page is updated through AJAX, the Pop-up is also updated and returns to the closed state. Please set the <strong>HTML id or class of the Posts Container</strong> as recommended in <a href="https://filtereverything.pro/resources/plugin-settings/#ajax" target="_blank" class="wpc-external-link">this article</a></p>
                <?php endif; ?>
            </div>
        </li>
        <li>
            <div class="wpc-advice-head">
                <span class="wpc-advice-title">Sort / Search in filtered results</span>
                <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                    <span class="toggle-indicator" aria-hidden="true"></span>
                </button>
            </div>
            <div class="wpc-advice-body">
                <h4>Sort</h4>
                <p>To Sort the filtering results, please use the <strong>Filter Everything — Sorting</strong> widget. It allows you to specify almost any sorting criteria. You can also use the shortcode <code>[fe_sort]</code> to display the sorting widget where a widget area is not available.</p>
                <p><blockquote><strong>Note:</strong> the shortcode that displays the sorting field requires the presence of a real widget in the WordPress dashboard, since the sorting criteria can only be configured in a widget. This widget may be placed in the Inactive widgets area.</blockquote></p>
                <p><blockquote><strong>Note:</strong> Sorting only works for posts for which a Filter Set exists. In other words, only those posts that are filtered can be sorted. At the same time, you don't have to display the Filters widget on the page, just the existence of such a Filter Set is enough.</blockquote></p>
                <h4>Search</h4>
                <p>To Search in filtering results, please enable the <strong>Search Field</strong> in the Filter Set settings and set its position in the Filters widget. Please, remember that the search considers Post titles, their content and excerpt and the SKU field of WooCommerce products.</p>
            </div>
        </li>
        <li>
            <div class="wpc-advice-head">
                <span class="wpc-advice-title">Resolve popular issues</span>
                <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                    <span class="toggle-indicator" aria-hidden="true"></span>
                </button>
            </div>
            <div class="wpc-advice-body">
                <ol>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>Filters Do not appear on the page</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>If nothing at all appears in the place where you expect to see the Filters Widget, then most likely you have added it somewhere else. Please, check where you added your widget and whether it is in the correct Widget area.</p>
                            <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                            <p>If you see the message <em>"No one Filter Set is related to this page..."</em> it means that no Filter Set has been registered for this page yet. Please open the Filter Set you want to use and specify this page in the field called <strong>Where to filter?</strong></p>
                            <?php else: ?>
                            <p>If you've placed the Filters widget or its shortcode in the correct location or widget area, you should at least see a diagnostic message telling you what you need to do to fix the problem.</p>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>I see "There are no filter terms yet" instead of filter terms</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>a) This usually means that you have incorrectly specified the Meta key for your filter by a Custom Field. </p>
                            <p>b) If you are sure that the Meta key is correct, then most likely you have not yet added any values from this meta field to your posts. This often happens with ACF Select type fields, because the Filter Everything does not get values from the ACF field directly, but from the existing values in Post meta fields.<br />Please edit several posts you are going to filter and specify any values for this field.</p>
                        </div>
                    </li>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>I select filter terms but the posts are Not filtered</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                            <p>a) Most often, the reason is that you chose an incorrect WP_Query in the <strong>And what to filter?</strong> field in the Filter Set. Please choose another value. If you are not sure which one to choose, please experiment with different ones until the filter starts working correctly.</p>
                            <?php else : ?>
                                <p>a) Usually it means that you are trying to filter a Custom WP_Query, but not the default Main WP_Query for this archive page. To filter Custom WP_Queries, please use the <a href="<?php echo FLRT_PLUGIN_URL; ?>" target="_blank" class="wpc-external-link">PRO version</a> of the plugin.</p>
                            <?php endif; ?>
                            <p>b) If you have AJAX enabled and the filter is not working, try disabling this option and check again. If the filter starts working with AJAX disabled, it's usually because you specified the wrong value for the <strong>HTML id or class of the Posts Container</strong> option. Please set the correct value for the option as recommended in <a href="https://filtereverything.pro/resources/plugin-settings/#ajax" class="wpc-external-link" target="_blank">this article</a></p>
                            <p>c) Rarely, but sometimes, this behavior can be caused by caching, which is implemented through a plugin or on the server. Please disable or reset the cache and check if the filter has started working.</p>
                        </div>
                    </li>
                    <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>I can not Activate the License</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>a) If you can't activate it at all and get an <strong>Unknown error</strong>, the problem is usually that access between your site and the <em>connect.filtereverything.pro</em> license server is restricted for some reason. You can ask support to activate your license.<br />To do this, please send us two things <a href="https://codecanyon.net/user/fe_support" target="_blank" class="wpc-external-link">via PM</a>:<br />
                                - the address of your website<br />
                                - license key, which you can get on <em>Filters -> Settings -> License</em>.
                            </p>
                                <p>b) If the plugin tells you that your license is already in use on two sites, then deactivate it on one of your sites to activate on the new one.<br />If you have deleted this site and are unable to deactivate the license there, please contact support and ask them to deactivate the license for you.</p>
                        </div>
                    </li>
                    <?php endif; ?>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>I can't Sort the terms the way I need</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>If none of the filter terms sorting options is useful for you, you can always sort the terms exactly the way you want with the hook <code>wpc_terms_before_display</code>. Please, see example how it can be done <a href="https://filtereverything.pro/resources/hooks/#terms-before-display-hook" target="_blank" class="wpc-external-link">here</a></p>
                        </div>
                    </li>
                    <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>404 errors appear</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>a) If, after activating the plugin, you see that many pages are giving 404 errors, then it is usually a conflict with a plugin like Permalink Manager.<br />By default this plugin is not compatible with the Filter Everything and you can use both at the same time only if you disable permalinks for Filters. This can be done by adding the following code to the <code>functions.php</code> file of your active theme:<br /><code>define( 'FLRT_PERMALINKS_ENABLED', false );</code><br /> Or you can deactivate the Permalink Manager plugin.</p>
                            <p>b) If only some filter generates 404 errors usually it means a conflict between the URL prefix you chose for the filter and a post slug or taxonomy term slug. For example, you chose the word <strong>department</strong> as the URL prefix and at the same time a link to the page contains the same word <strong>department</strong> e.g. <em>https://example.com/department</em>. In this case, simply edit the URL prefix in <em>Filters -> Settings -> URL Prefixes</em>.</p>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if( flrt_is_woocommerce() ): ?>
                        <li>
                            <div class="wpc-advice-head">
                                <span class="wpc-advice-title"><strong>I want to hide "Out of stock" products in filtered results</strong></span>
                                <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                    <span class="toggle-indicator" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="wpc-advice-body">
                                <?php if ( defined( 'FLRT_FILTERS_PRO' ) && FLRT_FILTERS_PRO ) : ?>
                                <p>a) You can create a filter by Stock status as shown in <a href="https://demo.filtereverything.pro/example/by-stock/" target="_blank" class="wpc-external-link">this example</a> and your visitors will be able to choose products with the status <strong>In Stock</strong> only.</p>
                                <p>b) You can add <a href="https://gist.github.com/wpserve/6bb6d1c7141f23b058a1ca726ca57372" target="_blank" class="wpc-external-link">this code</a> to your theme's <code>functions.php</code> file so that products with <strong>Out of stock</strong> status are hidden by default when filtering.<br />This code hides both: Simple and Variable products, if the variation matched to selected filters has the status <strong>Out of stock</strong>.</p>
                                <?php else: ?>
                                 <p>You can create a filter by Stock status as shown in <a href="https://demo.filtereverything.pro/example/by-stock/" target="_blank" class="wpc-external-link">this example</a> and your visitors will be able to choose products with the status <strong>In Stock</strong> only.</p>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>Cannot add Two filters by the same criteria to one Filter Set</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>Unfortunately, it is not possible for a technical reasons. But <?php
                                if ( ! defined( 'FLRT_FILTERS_PRO' ) ) :
                                ?>in case of the <a href="<?php echo FLRT_PLUGIN_URL; ?>" target="_blank" class="wpc-external-link">PRO version</a> of the plugin <?php
                                    endif;
                                ?>you can use a trick:<br />
                                - create two Filter Sets<br />
                                - put the filter by the same criteria in them both<br />
                                - add two Filter widgets to the page next to each other.</p>
                            <p>But in any case such solution is poor from the software design point of view. Much better is to create two different taxonomies for example with free <a href="https://wordpress.org/plugins/custom-post-type-ui/" target="_blank" class="wpc-external-link">CPTUI plugin</a> and create two filters by these taxonomies.</p>
                        </div>
                    </li>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>New values in the ACF field does not Appear in the filter</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>The fact is that the Filter Everything plugin selects values for filters directly from the Custom field in posts, and not from the ACF field. And so until you set these values for specific posts, they don't appear in the filter.</p>
                            <p>If you have added new or edited existing options for example in the Select ACF field, please edit the few posts you are going to filter and set these new ACF field values in them. After that, check your filter by this Custom field.</p>
                        </div>
                    </li>
                    <li>
                        <div class="wpc-advice-head">
                            <span class="wpc-advice-title"><strong>Terms show Old counters. Cache issue.</strong></span>
                            <button type="button" class="wpc-action wpc-advice-toggle widget-action hide-if-no-js" aria-expanded="false">
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="wpc-advice-body">
                            <p>If you have updated your posts but counters in the filter terms has not changed, resetting the internal plugin's cache may help in this case.</p>
                            <p>To reset the cache, you need to open any page of your site with the <strong>?reset_filters_cache=true</strong> parameter added to its URL. For example <strong>https://example.com/?reset_filters_cache=true</strong>.</p>
                            <p>After that, all the filter terms cached by the plugin and their counters will be updated and get their current values.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </li>
        <li>
            <p><span>Check out the <a href="https://filtereverything.pro/resources/" target="_blank" class="wpc-external-link">Documentation</a></span></p>
        </li>
            <p><span>Ask for <a href="https://filtereverything.pro/support/" target="_blank" class="wpc-external-link">Support</a></span></p>
        </li>
    </ul>
</div>