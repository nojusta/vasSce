<?php
/**
 * The Template for displaying Filters widget bottom controls.
 *
 * This template can be overridden by copying it to yourtheme/filters/bottom-controls.php.
 *
 * $action_url - string, URL to the page with filtering results
 * $found_posts - int|NULL, found posts number
 *
 * @see https://filtereverything.pro/resources/templates-overriding/
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

?>
<div class="wpc-filters-widget-controls-item wpc-filters-widget-controls-one">
    <a class="wpc-filters-apply-button wpc-posts-loaded" href="<?php echo esc_url($action_url); ?>"><?php
        echo wp_kses(
            sprintf( __('Show %s', 'filter-everything'),
            '<span class="wpc-filters-found-posts-wrapper">(<span class="wpc-filters-found-posts">'.esc_html($found_posts).'</span>)</span>'),
        array( 'span' => array('class'=>true) )
        );
  ?></a>
</div>
<div class="wpc-filters-widget-controls-item wpc-filters-widget-controls-two">
    <a class="wpc-filters-close-button" href="<?php echo esc_url($action_url); ?>"><?php
        echo esc_html__('Cancel', 'filter-everything');
        ?>
    </a>
</div>