<?php


namespace FilterEverything\Filter;

if ( ! defined('ABSPATH') ) {
    exit;
}

class HelpMeTab extends BaseSettings{

    protected $page = 'wpc-filter-help-me';

    protected $group = 'wpc_filter_help_me';

    protected $optionName = 'wpc_filter_help_me';

    public function init()
    {
        add_action( 'admin_init', array( $this, 'initSettings') );
    }

    public function initSettings()
    {
        register_setting($this->group, $this->optionName);
        add_action('wpc_before_sections_settings_fields', array( $this, 'HelpMeInfo' ) );
    }

    public function HelpMeInfo( $page ){
        if ( $this->page == $page ) {
            $current_user = wp_get_current_user();

            echo '<div class="wpc-help-me-wrapper">';
            echo '<img src="https://demo.filtereverything.pro/wp-content/uploads/2023/01/Me_with_son.jpg" width="300" class="wpc-help-me-image" />';
            echo '<p>'.sprintf( __( 'Howdy, %s' ), '<span class="display-name">' . $current_user->display_name . '.</span>' ).'</p>';
            echo '<p>'.esc_html__("I'm Andrii Stepasiuk, the author of this plugin." , "filter-everything" ).'</p>';
            echo '<p>'.esc_html__('It seems you like how Filter Everything does its job.', 'filter-everything');
            echo '<br />';
            echo esc_html__('Please, help me make the plugin more popular - leave a good review for it.', 'filter-everything').'</p>';
            echo '<p>' . esc_html__('Thank you so much!', 'filter-everything').'</p>';
            echo '<div class="wpc-help-me-buttons">';
            echo '<a href="https://wordpress.org/support/plugin/filter-everything/reviews/?filter=5#new-post" class="button button-primary wpc-leave-review-button" target="_blank">'.esc_html__('Sure, you deserve 5 stars', 'filter-everything').'</a>';
            echo '<a href="https://wordpress.org/support/plugin/filter-everything/#new-topic-0" class="wpc-leave-leave-comment-link" target="_blank"><img draggable="false" role="img" class="emoji" alt="😡" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f621.svg"> '.esc_html__('I have an issue with the plugin', 'filter-everything').'</a>';
            echo '</div>';
            echo '<br class="clear" />';
            echo '<div class="wpc-help-me-remove-tab"><a href="'. admin_url( 'edit.php?post_type=filter-set&page=filters-settings&tab=settings&remove_help_tab=true' ) .'"><span class="wpc-help-me-remove-icon">×</span> ' . esc_html__('Hide this tab forever', 'filter-everything') . '</a></div>';
            echo '</div>';

        }
    }

    public function getLabel()
    {
        return esc_html__('Need Your Help', 'filter-everything');
    }

    public function getName()
    {
        return 'helpme';
    }

    public function valid()
    {
        return true;
    }
}