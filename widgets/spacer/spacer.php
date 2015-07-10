<?php

/*
Widget Name: Spacer
Description: Spacer.
Author: Ingenious Solutions
Author URI: http://ingenious-web.com/
*/

class Spacer extends SiteOrigin_Widget
{
    function __construct()
    {

        parent::__construct(
            'spacer',
            __('Spacer', 'spacer-text-domain'),
            array(
                'description' => __('Spacer.', 'addon-so-widgets-bundle'),
                'panels_groups' => array('addonso')
            ),
            array(),
            array(
                'widget_title' => array(
                    'type' => 'text',
                    'label' => __('Widget Title.', 'addon-so-widgets-bundle'),
                    'default' => ''
                ),

                'spacer' => array(
                    'type' => 'number',
                    'label' => __( 'Height Without px', 'addon-so-widgets-bundle' ),
                    'default' => '10'
                ),

            ),
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance)
    {
        return 'spacer-template';
    }

    function get_style_name($instance)
    {
        return 'spacer-style';
    }

}

siteorigin_widget_register('spacer', __FILE__, 'Spacer');