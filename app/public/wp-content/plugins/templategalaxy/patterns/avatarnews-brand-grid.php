<?php
if (tg_fs()->is__premium_only()) {
    if (tg_fs()->can_use_premium_code()) {
        /**
         * Title: PRO: Brands Grid
         * Slug: templategalaxy/avatarnews-brand-grid
         * Categories: avatarnews
         */
        $tg_patterns_images = array(
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_1.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_2.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_3.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_4.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_5.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_6.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_7.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_8.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_9.png',
            TEMPLATEGALAXY_URL . 'assets/images/avatarnews/brand_10.png'
        );
?>
        <!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"60px","bottom":"60px"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group" style="padding-top:60px;padding-right:var(--wp--preset--spacing--40);padding-bottom:60px;padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"textAlign":"center","level":4,"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading-color"}}},"spacing":{"margin":{"bottom":"48px"}}},"textColor":"heading-color","fontSize":"big"} -->
            <h4 class="wp-block-heading has-text-align-center has-heading-color-color has-text-color has-link-color has-big-font-size" style="margin-bottom:48px"><?php esc_html_e('As Seen and Featured On', 'templategalaxy') ?></h4>
            <!-- /wp:heading -->

            <!-- wp:gallery {"columns":5,"imageCrop":false,"linkTo":"none","className":"avatarnews-brands","style":{"spacing":{"blockGap":{"top":"64px","left":"64px"}}}} -->
            <figure class="wp-block-gallery has-nested-images columns-5 avatarnews-brands"><!-- wp:image {"id":4582,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[0]) ?>" alt="" class="wp-image-4582" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4583,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[1]) ?>" alt="" class="wp-image-4583" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4584,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[2]) ?>" alt="" class="wp-image-4584" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4585,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[3]) ?>" alt="" class="wp-image-4585" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4586,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[4]) ?>" alt="" class="wp-image-4586" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4587,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[5]) ?>" alt="" class="wp-image-4587" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4589,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[6]) ?>" alt="" class="wp-image-4589" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4588,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[7]) ?>" alt="" class="wp-image-4588" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4590,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[9]) ?>" alt="" class="wp-image-4590" /></figure>
                <!-- /wp:image -->

                <!-- wp:image {"id":4591,"sizeSlug":"large","linkDestination":"none"} -->
                <figure class="wp-block-image size-large"><img src="<?php echo esc_url($tg_patterns_images[9]) ?>" alt="" class="wp-image-4591" /></figure>
                <!-- /wp:image -->
            </figure>
            <!-- /wp:gallery -->
        </div>
        <!-- /wp:group -->
<?php }
}
