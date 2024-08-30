<?php

/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package templategalaxy
 * @since 1.0.0
 */

if (function_exists('register_block_style')) {
    /**
     * Register block styles.
     *
     * @since 0.1
     *
     * @return void
     */
    function templategalaxy_register_block_styles()
    {
        register_block_style(
            'core/group',
            array(
                'name'  => 'templategalaxy-boxshadow',
                'label' => __('TG: Box Shadow', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/group',
            array(
                'name'  => 'templategalaxy-boxshadow-medium',
                'label' => __('TG: Box Shadow Medium', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/group',
            array(
                'name'  => 'templategalaxy-boxshadow-big',
                'label' => __('TG: Box Shadow Big', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/group',
            array(
                'name'  => 'templategalaxy-boxshadow-hover',
                'label' => __('TG: Box Shadow on Hover', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/columns',
            array(
                'name'  => 'templategalaxy-boxshadow',
                'label' => __('TG: Box Shadow', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/column',
            array(
                'name'  => 'templategalaxy-boxshadow',
                'label' => __('TG: Box Shadow', 'templategalaxy'),
            )
        );

        register_block_style(
            'core/columns',
            array(
                'name'  => 'templategalaxy-boxshadow-hover',
                'label' => __('TG: Box Shadow on Hover', 'templategalaxy'),
            )
        );

        register_block_style(
            'core/column',
            array(
                'name'  => 'templategalaxy-boxshadow-hover',
                'label' => __('TG: Box Shadow on Hover', 'templategalaxy'),
            )
        );

        register_block_style(
            'core/image',
            array(
                'name'  => 'templategalaxy-boxshadow',
                'label' => __('TG:Box Shadow', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'templategalaxy-boxshadow-hover',
                'label' => __('TG:Box Shadow on Hover', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'templategalaxy-image-hover-rotate',
                'label' => __('TG: Rotate on Hover', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/image',
            array(
                'name'  => 'templategalaxy-image-hover-zoom',
                'label' => __('TG: Zoom on Hover', 'templategalaxy'),
            )
        );
        register_block_style(
            'core/post-terms',
            array(
                'name'  => 'templategalaxy-categories-with-background',
                'label' => __('TG: Category Background', 'pattenberg')
            )
        );

        register_block_style(
            'core/post-terms',
            array(
                'name'  => 'templategalaxy-categories-with-background-round',
                'label' => __('TG: Category Background with Round Corner', 'pattenberg')
            )
        );
        register_block_style(
            'core/post-terms',
            array(
                'name'  => 'templategalaxy-categories-with-border',
                'label' => __('TG: Category Border', 'pattenberg')
            )
        );

        register_block_style(
            'core/post-terms',
            array(
                'name'  => 'templategalaxy-categories-with-border-round',
                'label' => __('TG: Category border with Round Corner', 'pattenberg')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'templategalaxy-button-hover-black-border',
                'label' => __('TG Button hover: Black Border', 'templategalaxy')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'templategalaxy-button-hover-white-border',
                'label' => __('TG Button hover: White Border', 'templategalaxy')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'templategalaxy-button-hover-neutral-border',
                'label' => __('TG Button hover: Neutral Border', 'templategalaxy')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'templategalaxy-button-hover-black-background',
                'label' => __('TG Button hover: Black Background', 'templategalaxy')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'templategalaxy-button-hover-white-background',
                'label' => __('TG Button hover: White Background', 'templategalaxy')
            )
        );
        register_block_style(
            'core/button',
            array(
                'name'  => 'templategalaxy-button-hover-neutral-background',
                'label' => __('TG Button hover: Neutral Background', 'templategalaxy')
            )
        );

        register_block_style(
            'core/read-more',
            array(
                'name'  => 'templategalaxy-readmore-hover-border-white',
                'label' => __('TG Read More: White border on hover', 'templategalaxy')
            )
        );
        register_block_style(
            'core/read-more',
            array(
                'name'  => 'templategalaxy-readmore-hover-border-neutral',
                'label' => __('TG Read More: Neutral border on hover', 'templategalaxy')
            )
        );
        register_block_style(
            'core/read-more',
            array(
                'name'  => 'templategalaxy-readmore-hover-border-black',
                'label' => __('TG Read More: Black border on hover', 'templategalaxy')
            )
        );
        register_block_style(
            'core/read-more',
            array(
                'name'  => 'templategalaxy-readmore-hover-background-white',
                'label' => __('TG Read More: White background on hover', 'templategalaxy')
            )
        );
        register_block_style(
            'core/read-more',
            array(
                'name'  => 'templategalaxy-readmore-hover-background-neutral',
                'label' => __('TG Read More: Neutral background on hover', 'templategalaxy')
            )
        );
        register_block_style(
            'core/read-more',
            array(
                'name'  => 'templategalaxy-readmore-hover-background-black',
                'label' => __('TG Read More: Black background on hover', 'templategalaxy')
            )
        );

        register_block_style(
            'core/list',
            array(
                'name'  => 'templategalaxy-list-style-no-bullet',
                'label' => __('TG List Style: Hide bullet', 'templategalaxy')
            )
        );
        register_block_style(
            'core/list',
            array(
                'name'  => 'templategalaxy-hide-bullet-list-link-hover-style-white',
                'label' => __('TG List Style: Link hover white color and hide bullet', 'templategalaxy')
            )
        );
        register_block_style(
            'core/list',
            array(
                'name'  => 'templategalaxy-hide-bullet-list-link-hover-style-black',
                'label' => __('TG List Style: Link hover black color and hide bullet', 'templategalaxy')
            )
        );
        register_block_style(
            'core/list',
            array(
                'name'  => 'templategalaxy-hide-bullet-list-link-hover-style-neutral',
                'label' => __('TG List Style: Link hover neutral color and hide bullet', 'templategalaxy')
            )
        );

        register_block_style(
            'core/gallery',
            array(
                'name'  => 'templategalaxy-enable-grayscale-mode-on-image',
                'label' => __('TG: Enable Grayscale Mode on Image', 'templategalaxy')
            )
        );
        register_block_style(
            'core/social-links',
            array(
                'name'  => 'templategalaxy-social-icon-border',
                'label' => __('TG: Border Style', 'templategalaxy')
            )
        );
        register_block_style(
            'core/social-links',
            array(
                'name'  => 'templategalaxy-social-icon-border-round',
                'label' => __('TG: Border Style Round', 'templategalaxy')
            )
        );

        register_block_style(
            'core/page-list',
            array(
                'name'  => 'templategalaxy-page-list-bullet-hide-style',
                'label' => __('TG: Hide Bullet Style', 'templategalaxy')
            )
        );
        register_block_style(
            'core/categories',
            array(
                'name'  => 'templategalaxy-categories-bullet-hide-style',
                'label' => __('TG: Hide Bullet Style', 'templategalaxy')
            )
        );
        register_block_style(
            'core/cover',
            array(
                'name'  => 'templategalaxy-cover-round-style',
                'label' => __('TG: Round Corner Style', 'templategalaxy')
            )
        );
        register_block_style(
            'core/cover',
            array(
                'name'  => 'templategalaxy-cover-medium-round-style',
                'label' => __('TG: Medium Round Corner Style', 'templategalaxy')
            )
        );
        register_block_style(
            'core/cover',
            array(
                'name'  => 'templategalaxy-cover-big-round-style',
                'label' => __('TG: Big Round Corner Style', 'templategalaxy')
            )
        );
        register_block_style(
            'core/cover',
            array(
                'name'  => 'templategalaxy-cover-zoom-onhover',
                'label' => __('TG: Zoom on Hover', 'templategalaxy')
            )
        );
    }
    add_action('init', 'templategalaxy_register_block_styles');
}
