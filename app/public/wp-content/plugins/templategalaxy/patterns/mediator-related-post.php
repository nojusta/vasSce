<?php

/**
 * Title: Related Post
 * Slug: templategalaxy/mediator-related-post
 * Categories: mediator
 */
?>
<!-- wp:group {"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"24px","bottom":"0px","left":"24px","right":"24px"}}},"backgroundColor":"light-color","className":"mediator-related-post","layout":{"type":"constrained"}} -->
<div class="wp-block-group mediator-related-post has-light-color-background-color has-background" style="border-radius:12px;padding-top:24px;padding-right:24px;padding-bottom:0px;padding-left:24px"><!-- wp:heading {"level":3} -->
    <h3 class="wp-block-heading"><?php esc_html_e('Related Post', 'templategalaxy') ?></h3>
    <!-- /wp:heading -->

    <!-- wp:shortcode -->
    [TG_RELATED_POSTS]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->